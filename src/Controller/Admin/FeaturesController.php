<?php
// Baked at 2021.10.28. 15:29:10
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;

/**
 * Features Controller
 *
 * @property \App\Model\Table\FeaturesTable $Features
 * @method \App\Model\Entity\Feature[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FeaturesController extends AppController
{

    /**
     * Initialize controller
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
		$this->set('title', __('Features'));
		
	}
	
    /**
     * Index method
     *
	 * @param string|null $param: if($param !== null && $param == 'clear-filter')...
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index($param = null)
    {
		if( !isset($this->version_id) ){
			$this->Flash->error(__('Please choose version!'));
			return $this->redirect( ['controller' => 'Versions', 'action' => 'index'] );
		}

		$search = null;
		$features = null;
		
		$this->set('title', __('Features'));

		//$this->config['index_number_of_rows'] = 10;
		if($this->config['index_number_of_rows'] === null){
			$this->config['index_number_of_rows'] = 20;
		}
		
		// Clear filter from session
		if($param !== null && $param == 'clear-filter'){
			$this->session->delete('Layout.' . $this->controller . '.Search');
			$this->redirect( $this->request->referer() );
		}		
		
        $this->paginate = [
		
            'contain' => [
				'Programs' => [
					'PackagesProgramsAnalogs' => [
						'Packages', 
						'conditions' => [
							//'PackagesProgramsAnalogs.version_id' => $this->version_id
						]
					],
					'PackagesProgramsDigitals' => [
						'Packages', 
						'conditions' => [
							//'PackagesProgramsDigitals.version_id' => $this->version_id
						]
					],
					'conditions' => [
					//	'Programs.version_id' =>$this->version_id
					]
				]
			],
		
			'conditions' => [
				'Features.version_id' 		=> $this->version_id,
				//'Features.visible' 		=> 1,
				//'Features.created >= ' 	=> new \DateTime('-10 days'),
				//'Features.modified >= '	=> new \DateTime('-10 days'),
			],
			/*
			// Nem tanácsos az order-t itt használni, mert pl az edit után az utolsó  ordert ugyan beálíltja, de
			// kiegészíti ezzel s így az utoljára mentett rekord nem lesz megtalálható az X-edik oldalon, mert az az elsőre kerül.
			// A felhasználó állítson be rendezettséget magának! Kivételes esetek persze lehetnek!
			*/
			'order' => [
				//'Features.id' 			=> 'desc',
				//'Features.name' 		=> 'asc',
				//'Features.visible' 		=> 'desc',
				//'Features.pos' 			=> 'desc',
				//'Features.rank' 		=> 'asc',
				//'Features.created' 		=> 'desc',
				//'Features.modified' 	=> 'desc',
			],
			'limit' => $this->config['index_number_of_rows'],
			'maxLimit' => $this->config['index_number_of_rows'],
			//'sortableFields' => ['id', 'name', 'created', '...'],
			//'paramType' => 'querystring',
			//'fields' => ['Features.id', 'Features.name', ...],
			//'finder' => 'published',
        ];

		//$this->paging = $this->session->read('Layout.' . $this->controller . '.Paging');

		if( $this->paging === null){
			$this->paginate['order'] = [
				//'Features.id' 			=> 'desc',
				//'Features.name' 		=> 'asc',
				//'Features.visible' 		=> 'desc',
				//'Features.pos' 			=> 'desc',
				//'Features.rank' 		=> 'asc',
				//'Features.created' 		=> 'desc',
				//'Features.modified' 	=> 'desc',
			];
		}else{
			if($this->request->getQuery('sort') === null && $this->request->getQuery('direction') === null){
				$this->paginate['order'] = [
					// If not in URL-ben, then come from sessinon...
					$this->paging['Features']['sort'] => $this->paging['Features']['direction']	
				];
			}
		}

		if($this->request->getQuery('page') === null && !isset($this->paging['Features']['page']) ){
			$this->paginate['page'] = 1;
		}else{
			$this->paginate['page'] = (isset($this->paging['Features']['page'])) ? $this->paging['Features']['page'] : 1;
		}
		
		// -- Filter --
		if ($this->request->is('post') || $this->session->read('Layout.' . $this->controller . '.Search') !== null && $this->session->read('Layout.' . $this->controller . '.Search') !== []) {
				
			if( $this->request->is('post') ){
				$search = $this->request->getData();
				$this->session->write('Layout.' . $this->controller . '.Search', $search);
				if($search !== null && $search['s'] !== null && $search['s'] == ''){
					$this->session->delete('Layout.' . $this->controller . '.Search');
					return $this->redirect([
						'controller' => $this->controller, 
						'action' => 'index', 
						//'?' => [			// Not tested!!!
						//	'page'		=> $this->paging['Features']['page'], 	// Vagy 1
						//	'sort'		=> $this->paging['Features']['sort'], 
						//	'direction'	=> $this->paging['Features']['direction'],
						//]
					]);
				}
			}else{
				if($this->session->check('Layout.' . $this->controller . '.Search')){
					$search = $this->session->read('Layout.' . $this->controller . '.Search');
				}
			}

			$this->set('search', $search['s']);
			
			$search['s'] = '%'.str_replace(' ', '%', $search['s']).'%';
			//$this->paginate['conditions'] = ['Features.name LIKE' => $q ];
			$this->paginate['conditions'][] = [
				'OR' => [
					['Features.name LIKE' => $search['s'] ],
					//['Features.title LIKE' => $search['s'] ], // ... just add more fields
				],[
					'Features.version_id' 		=> $this->version_id,
				]
			];
			
		}
		// -- /.Filter --
		
		try {
			$features = $this->paginate($this->Features);
		} catch (NotFoundException $e) {
			$paging = $this->request->getAttribute('paging');
			if($paging['Features']['prevPage'] !== null && $paging['Features']['prevPage']){
				if($paging['Features']['page'] !== null && $paging['Features']['page'] > 0){
					return $this->redirect([
						'controller' => $this->controller, 
						'action' => 'index', 
						'?' => [
							'page'		=> 1,	//$this->paging['Features']['page'],
							'sort'		=> $this->paging['Features']['sort'],
							'direction'	=> $this->paging['Features']['direction'],
						],
					]);			
				}
			}
			
		}
		
		//debug($features->toArray()); die();

		$paging = $this->request->getAttribute('paging');

		if($this->paging !== $paging){
			$this->paging = $paging;
			$this->session->write('Layout.' . $this->controller . '.Paging', $paging);
		}

		$this->set('paging', $this->paging);
		$this->set('layout' . $this->controller . 'LastId', $this->session->read('Layout.' . $this->controller . '.LastId'));
		$this->set(compact('features'));
		
	}


    /**
     * View method
     *
     * @param string|null $id Feature id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		if( !isset($this->version_id) ){
			$this->Flash->error(__('Please choose version!'));
			return $this->redirect( ['controller' => 'Versions', 'action' => 'index'] );
		}

		$this->set('title', __('Feature'));
		
        $feature = $this->Features->get($id, [
            'contain' => [
				'Programs' => [
					'PackagesProgramsAnalogs' => [
						'Packages', 
						'conditions' => [
							//'PackagesProgramsAnalogs.version_id' => $this->version_id
						]
					],
					'PackagesProgramsDigitals' => [
						'Packages', 
						'conditions' => [
							//'PackagesProgramsDigitals.version_id' => $this->version_id
						]
					],
					'conditions' => [
					//	'Programs.version_id' =>$this->version_id
					]
				]
			],
        ]);
		
		//debug($feature->toArray()); die();

		$this->session->write('Layout.' . $this->controller . '.LastId', $id);

		$name = $feature->name;

        $this->set(compact('feature', 'id', 'name'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		if( !isset($this->version_id) ){
			$this->Flash->error(__('Please choose version!'));
			return $this->redirect( ['controller' => 'Versions', 'action' => 'index'] );
		}

		$this->set('title', __('Feature'));
        $feature = $this->Features->newEmptyEntity();
        if ($this->request->is('post')) {
            $feature = $this->Features->patchEntity($feature, $this->request->getData());
			$feature->version_id = $this->version_id;
            if ($this->Features->save($feature)) {
                //$this->Flash->success(__('The feature has been saved.'));
                $this->Flash->success(__('Has been saved.'));

				$this->session->write('Layout.' . $this->controller . '.LastId', $feature->id);
	
                //return $this->redirect(['action' => 'index']);
                return $this->redirect([
					'controller' => $this->controller, 
					'action' => 'index', 
					'?' => [
						'page'		=> 1,
						'sort'		=> 'id',
						'direction'	=> 'desc',
					],
					'#' => $feature->id	// Az állandó header miatt takarásban van még. Majd...
				]);

                return $this->redirect(['action' => 'index']);
            }
            //$this->Flash->error(__('The feature could not be saved. Please, try again.'));
			$this->Flash->error(__('Could not be saved. Please, try again.'));
        }
        $this->set(compact('feature'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Feature id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
		if( !isset($this->version_id) ){
			$this->Flash->error(__('Please choose version!'));
			return $this->redirect( ['controller' => 'Versions', 'action' => 'index'] );
		}

		$this->set('title', __('Feature'));
        $feature = $this->Features->get($id, [
            'contain' => [],
        ]);
		
		$this->session->write('Layout.' . $this->controller . '.LastId', $id);
		
        if ($this->request->is(['patch', 'post', 'put'])) {
			//debug($this->request->getData()); //die();
            $feature = $this->Features->patchEntity($feature, $this->request->getData());
            //debug($feature); //die();
			if ($this->Features->save($feature)) {
                //$this->Flash->success(__('The feature has been saved.'));
                $this->Flash->success(__('Has been saved.'));
				
                
				//return $this->redirect(['action' => 'index']);
                return $this->redirect([
					'controller' => $this->controller, 
					'action' => 'index', 
					'?' => [
						'page'		=> (isset($this->paging['Features']['page'])) ? $this->paging['Features']['page'] : 1, 		// or 1
						'sort'		=> (isset($this->paging['Features']['sort'])) ? $this->paging['Features']['sort'] : 'created', 
						'direction'	=> (isset($this->paging['Features']['direction'])) ? $this->paging['Features']['direction'] : 'desc',
					],
					'#' => $id
				]);
				
            }
            //$this->Flash->error(__('The feature could not be saved. Please, try again.'));
            $this->Flash->error(__('Could not be saved. Please, try again.'));
        }

		$name = $feature->name;

        $this->set(compact('feature', 'id', 'name'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Feature id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $feature = $this->Features->get($id);
		if($feature->progam_count == 0){
			if ($this->Features->delete($feature)) {
				//$this->Flash->success(__('The feature has been deleted.'));
				$this->Flash->success(__('Has been deleted.'));
			} else {
				//$this->Flash->error(__('The feature could not be deleted. Please, try again.'));
				$this->Flash->error(__('Could not be deleted. Please, try again.'));
			}
		}else{
			$this->Flash->error(__("Could not be deleted. The source has it's programs."));
		}

        //return $this->redirect(['action' => 'index']);
		return $this->redirect([
			'controller' => $this->controller, 
			'action' => 'index', 
			'?' => [
				'page'		=> $this->paging['Features']['page'], 
				'sort'		=> $this->paging['Features']['sort'], 
				'direction'	=> $this->paging['Features']['direction'],
			]
		]);
		
    }

}

