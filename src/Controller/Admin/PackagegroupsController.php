<?php
// Baked at 2021.11.04. 09:59:42
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;

/**
 * Packagegroups Controller
 *
 * @property \App\Model\Table\PackagegroupsTable $Packagegroups
 * @method \App\Model\Entity\Packagegroup[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PackagegroupsController extends AppController
{

    /**
     * Initialize controller
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
		$this->set('title', __('Packagegroups'));
		
	}
	
    /**
     * Index method
     *
	 * @param string|null $param: if($param !== null && $param == 'clear-filter')...
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index($param = null)
    {
		$search = null;
		$packagegroups = null;
		
		$this->set('title', __('Packagegroups'));

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
			'conditions' => [
				//'Packagegroups.name' 		=> 1,
				//'Packagegroups.visible' 		=> 1,
				//'Packagegroups.created >= ' 	=> new \DateTime('-10 days'),
				//'Packagegroups.modified >= '	=> new \DateTime('-10 days'),
			],
			/*
			// Nem tanácsos az order-t itt használni, mert pl az edit után az utolsó  ordert ugyan beálíltja, de
			// kiegészíti ezzel s így az utoljára mentett rekord nem lesz megtalálható az X-edik oldalon, mert az az elsőre kerül.
			// A felhasználó állítson be rendezettséget magának! Kivételes esetek persze lehetnek!
			*/
			'order' => [
				//'Packagegroups.id' 			=> 'desc',
				//'Packagegroups.name' 		=> 'asc',
				//'Packagegroups.visible' 		=> 'desc',
				'Packagegroups.pos' 			=> 'asc',
				//'Packagegroups.rank' 		=> 'asc',
				//'Packagegroups.created' 		=> 'desc',
				//'Packagegroups.modified' 	=> 'desc',
			],
			'limit' => $this->config['index_number_of_rows'],
			'maxLimit' => $this->config['index_number_of_rows'],
			//'sortableFields' => ['id', 'name', 'created', '...'],
			//'paramType' => 'querystring',
			//'fields' => ['Packagegroups.id', 'Packagegroups.name', ...],
			//'finder' => 'published',
        ];

		//$this->paging = $this->session->read('Layout.' . $this->controller . '.Paging');

		if( $this->paging === null){
			$this->paginate['order'] = [
				//'Packagegroups.id' 			=> 'desc',
				//'Packagegroups.name' 		=> 'asc',
				//'Packagegroups.visible' 		=> 'desc',
				'Packagegroups.pos' 			=> 'asc',
				//'Packagegroups.rank' 		=> 'asc',
				//'Packagegroups.created' 		=> 'desc',
				//'Packagegroups.modified' 	=> 'desc',
			];
		}else{
			if($this->request->getQuery('sort') === null && $this->request->getQuery('direction') === null){
				$this->paginate['order'] = [
					// If not in URL-ben, then come from sessinon...
					$this->paging['Packagegroups']['sort'] => $this->paging['Packagegroups']['direction']	
				];
			}
		}

		if($this->request->getQuery('page') === null && !isset($this->paging['Packagegroups']['page']) ){
			$this->paginate['page'] = 1;
		}else{
			$this->paginate['page'] = (isset($this->paging['Packagegroups']['page'])) ? $this->paging['Packagegroups']['page'] : 1;
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
						//	'page'		=> $this->paging['Packagegroups']['page'], 	// Vagy 1
						//	'sort'		=> $this->paging['Packagegroups']['sort'], 
						//	'direction'	=> $this->paging['Packagegroups']['direction'],
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
			//$this->paginate['conditions'] = ['Packagegroups.name LIKE' => $q ];
			$this->paginate['conditions'][] = [
				'OR' => [
					['Packagegroups.name LIKE' => $search['s'] ],
					//['Packagegroups.title LIKE' => $search['s'] ], // ... just add more fields
				]
			];
			
		}
		// -- /.Filter --
		
		try {
			$packagegroups = $this->paginate($this->Packagegroups);
		} catch (NotFoundException $e) {
			$paging = $this->request->getAttribute('paging');
			if($paging['Packagegroups']['prevPage'] !== null && $paging['Packagegroups']['prevPage']){
				if($paging['Packagegroups']['page'] !== null && $paging['Packagegroups']['page'] > 0){
					return $this->redirect([
						'controller' => $this->controller, 
						'action' => 'index', 
						'?' => [
							'page'		=> 1,	//$this->paging['Packagegroups']['page'],
							'sort'		=> $this->paging['Packagegroups']['sort'],
							'direction'	=> $this->paging['Packagegroups']['direction'],
						],
					]);			
				}
			}
			
		}

		$paging = $this->request->getAttribute('paging');

		if($this->paging !== $paging){
			$this->paging = $paging;
			$this->session->write('Layout.' . $this->controller . '.Paging', $paging);
		}

		$this->set('paging', $this->paging);
		$this->set('layout' . $this->controller . 'LastId', $this->session->read('Layout.' . $this->controller . '.LastId'));
		$this->set(compact('packagegroups'));
		
	}


    /**
     * View method
     *
     * @param string|null $id Packagegroup id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$this->set('title', __('Packagegroup'));
		
        $packagegroup = $this->Packagegroups->get($id, [
            'contain' => [],
        ]);

		$this->session->write('Layout.' . $this->controller . '.LastId', $id);

		$name = $packagegroup->name;

        $this->set(compact('packagegroup', 'id', 'name'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->set('title', __('Packagegroup'));
        $packagegroup = $this->Packagegroups->newEmptyEntity();
        if ($this->request->is('post')) {
            $packagegroup = $this->Packagegroups->patchEntity($packagegroup, $this->request->getData());
            if ($this->Packagegroups->save($packagegroup)) {
                //$this->Flash->success(__('The packagegroup has been saved.'));
                $this->Flash->success(__('Has been saved.'));

				$this->session->write('Layout.' . $this->controller . '.LastId', $packagegroup->id);
	
                //return $this->redirect(['action' => 'index']);
                return $this->redirect([
					'controller' => $this->controller, 
					'action' => 'index', 
					'?' => [
						'page'		=> 1,
						'sort'		=> 'id',
						'direction'	=> 'desc',
					],
					'#' => $packagegroup->id	// Az állandó header miatt takarásban van még. Majd...
				]);

                return $this->redirect(['action' => 'index']);
            }
            //$this->Flash->error(__('The packagegroup could not be saved. Please, try again.'));
			$this->Flash->error(__('Could not be saved. Please, try again.'));
        }
        $this->set(compact('packagegroup'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Packagegroup id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->set('title', __('Packagegroup'));
        $packagegroup = $this->Packagegroups->get($id, [
            'contain' => [],
        ]);
		
		$this->session->write('Layout.' . $this->controller . '.LastId', $id);
		
        if ($this->request->is(['patch', 'post', 'put'])) {
			//debug($this->request->getData()); //die();
            $packagegroup = $this->Packagegroups->patchEntity($packagegroup, $this->request->getData());
            //debug($packagegroup); //die();
			if ($this->Packagegroups->save($packagegroup)) {
                //$this->Flash->success(__('The packagegroup has been saved.'));
                $this->Flash->success(__('Has been saved.'));
				
                
				//return $this->redirect(['action' => 'index']);
                return $this->redirect([
					'controller' => $this->controller, 
					'action' => 'index', 
					'?' => [
						'page'		=> (isset($this->paging['Packagegroups']['page'])) ? $this->paging['Packagegroups']['page'] : 1, 		// or 1
						'sort'		=> (isset($this->paging['Packagegroups']['sort'])) ? $this->paging['Packagegroups']['sort'] : 'created', 
						'direction'	=> (isset($this->paging['Packagegroups']['direction'])) ? $this->paging['Packagegroups']['direction'] : 'desc',
					],
					'#' => $id
				]);
				
            }
            //$this->Flash->error(__('The packagegroup could not be saved. Please, try again.'));
            $this->Flash->error(__('Could not be saved. Please, try again.'));
        }

		$name = $packagegroup->name;

        $this->set(compact('packagegroup', 'id', 'name'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Packagegroup id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $packagegroup = $this->Packagegroups->get($id);
        if ($this->Packagegroups->delete($packagegroup)) {
            //$this->Flash->success(__('The packagegroup has been deleted.'));
            $this->Flash->success(__('Has been deleted.'));
        } else {
            //$this->Flash->error(__('The packagegroup could not be deleted. Please, try again.'));
            $this->Flash->error(__('Could not be deleted. Please, try again.'));
        }

        //return $this->redirect(['action' => 'index']);
		return $this->redirect([
			'controller' => $this->controller, 
			'action' => 'index', 
			'?' => [
				'page'		=> $this->paging['Packagegroups']['page'], 
				'sort'		=> $this->paging['Packagegroups']['sort'], 
				'direction'	=> $this->paging['Packagegroups']['direction'],
			]
		]);
		
    }

}

