<?php
// Baked at 2021.10.28. 15:29:10
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;

/**
 * Headstations Controller
 *
 * @property \App\Model\Table\HeadstationsTable $Headstations
 * @method \App\Model\Entity\Headstation[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class HeadstationsController extends AppController
{

    /**
     * Initialize controller
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
		$this->set('title', __('Headstations'));
		
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
		$headstations = null;
		
		$this->set('title', __('Headstations'));

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
				//'Headstations.name' 		=> 1,
				//'Headstations.visible' 		=> 1,
				//'Headstations.created >= ' 	=> new \DateTime('-10 days'),
				//'Headstations.modified >= '	=> new \DateTime('-10 days'),
			],
			/*
			// Nem tanácsos az order-t itt használni, mert pl az edit után az utolsó  ordert ugyan beálíltja, de
			// kiegészíti ezzel s így az utoljára mentett rekord nem lesz megtalálható az X-edik oldalon, mert az az elsőre kerül.
			// A felhasználó állítson be rendezettséget magának! Kivételes esetek persze lehetnek!
			*/
			'order' => [
				//'Headstations.id' 			=> 'desc',
				//'Headstations.name' 		=> 'asc',
				//'Headstations.visible' 		=> 'desc',
				//'Headstations.pos' 			=> 'desc',
				//'Headstations.rank' 		=> 'asc',
				//'Headstations.created' 		=> 'desc',
				//'Headstations.modified' 	=> 'desc',
			],
			'limit' => $this->config['index_number_of_rows'],
			'maxLimit' => $this->config['index_number_of_rows'],
			//'sortableFields' => ['id', 'name', 'created', '...'],
			//'paramType' => 'querystring',
			//'fields' => ['Headstations.id', 'Headstations.name', ...],
			//'finder' => 'published',
        ];

		//$this->paging = $this->session->read('Layout.' . $this->controller . '.Paging');

		if( $this->paging === null){
			$this->paginate['order'] = [
				//'Headstations.id' 			=> 'desc',
				//'Headstations.name' 		=> 'asc',
				//'Headstations.visible' 		=> 'desc',
				//'Headstations.pos' 			=> 'desc',
				//'Headstations.rank' 		=> 'asc',
				//'Headstations.created' 		=> 'desc',
				//'Headstations.modified' 	=> 'desc',
			];
		}else{
			if($this->request->getQuery('sort') === null && $this->request->getQuery('direction') === null){
				$this->paginate['order'] = [
					// If not in URL-ben, then come from sessinon...
					$this->paging['Headstations']['sort'] => $this->paging['Headstations']['direction']	
				];
			}
		}

		if($this->request->getQuery('page') === null && !isset($this->paging['Headstations']['page']) ){
			$this->paginate['page'] = 1;
		}else{
			$this->paginate['page'] = (isset($this->paging['Headstations']['page'])) ? $this->paging['Headstations']['page'] : 1;
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
						//	'page'		=> $this->paging['Headstations']['page'], 	// Vagy 1
						//	'sort'		=> $this->paging['Headstations']['sort'], 
						//	'direction'	=> $this->paging['Headstations']['direction'],
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
			//$this->paginate['conditions'] = ['Headstations.name LIKE' => $q ];
			$this->paginate['conditions'][] = [
				'OR' => [
					['Headstations.name LIKE' => $search['s'] ],
					//['Headstations.title LIKE' => $search['s'] ], // ... just add more fields
				]
			];
			
		}
		// -- /.Filter --
		
		try {
			$headstations = $this->paginate($this->Headstations);
		} catch (NotFoundException $e) {
			$paging = $this->request->getAttribute('paging');
			if($paging['Headstations']['prevPage'] !== null && $paging['Headstations']['prevPage']){
				if($paging['Headstations']['page'] !== null && $paging['Headstations']['page'] > 0){
					return $this->redirect([
						'controller' => $this->controller, 
						'action' => 'index', 
						'?' => [
							'page'		=> 1,	//$this->paging['Headstations']['page'],
							'sort'		=> $this->paging['Headstations']['sort'],
							'direction'	=> $this->paging['Headstations']['direction'],
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
		$this->set(compact('headstations'));
		
	}


    /**
     * View method
     *
     * @param string|null $id Headstation id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$this->set('title', __('Headstation'));
		
        $headstation = $this->Headstations->get($id, [
            'contain' => ['Cities', 'Packages' => ['Packagegroups', 'conditions' => ['Packages.version_id' => $this->version_id]], 'Versions'],
        ]);

		$this->session->write('Layout.' . $this->controller . '.LastId', $id);

		$name = $headstation->name;

        $this->set(compact('headstation', 'id', 'name'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->set('title', __('Headstation'));
        $headstation = $this->Headstations->newEmptyEntity();
        if ($this->request->is('post')) {
            $headstation = $this->Headstations->patchEntity($headstation, $this->request->getData());
            if ($this->Headstations->save($headstation)) {
                //$this->Flash->success(__('The headstation has been saved.'));
                $this->Flash->success(__('Has been saved.'));

				$this->session->write('Layout.' . $this->controller . '.LastId', $headstation->id);
	
                //return $this->redirect(['action' => 'index']);
                return $this->redirect([
					'controller' => $this->controller, 
					'action' => 'index', 
					'?' => [
						'page'		=> 1,
						'sort'		=> 'id',
						'direction'	=> 'desc',
					],
					'#' => $headstation->id	// Az állandó header miatt takarásban van még. Majd...
				]);

                return $this->redirect(['action' => 'index']);
            }
            //$this->Flash->error(__('The headstation could not be saved. Please, try again.'));
			$this->Flash->error(__('Could not be saved. Please, try again.'));
        }
        $this->set(compact('headstation'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Headstation id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->set('title', __('Headstation'));
        $headstation = $this->Headstations->get($id, [
            'contain' => [],
        ]);
		
		$this->session->write('Layout.' . $this->controller . '.LastId', $id);
		
        if ($this->request->is(['patch', 'post', 'put'])) {
			//debug($this->request->getData()); //die();
            $headstation = $this->Headstations->patchEntity($headstation, $this->request->getData());
            //debug($headstation); //die();
			if ($this->Headstations->save($headstation)) {
                //$this->Flash->success(__('The headstation has been saved.'));
                $this->Flash->success(__('Has been saved.'));
				
                
				//return $this->redirect(['action' => 'index']);
                return $this->redirect([
					'controller' => $this->controller, 
					'action' => 'index', 
					'?' => [
						'page'		=> (isset($this->paging['Headstations']['page'])) ? $this->paging['Headstations']['page'] : 1, 		// or 1
						'sort'		=> (isset($this->paging['Headstations']['sort'])) ? $this->paging['Headstations']['sort'] : 'created', 
						'direction'	=> (isset($this->paging['Headstations']['direction'])) ? $this->paging['Headstations']['direction'] : 'desc',
					],
					'#' => $id
				]);
				
            }
            //$this->Flash->error(__('The headstation could not be saved. Please, try again.'));
            $this->Flash->error(__('Could not be saved. Please, try again.'));
        }

		$name = $headstation->name;

        $this->set(compact('headstation', 'id', 'name'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Headstation id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $headstation = $this->Headstations->get($id);
        //if ($this->Headstations->delete($headstation)) {
        //    //$this->Flash->success(__('The headstation has been deleted.'));
        //    $this->Flash->success(__('Has been deleted.'));
        //} else {
            //$this->Flash->error(__('The headstation could not be deleted. Please, try again.'));
            $this->Flash->error(__('You cannot delete headstation!'));
            //$this->Flash->error(__('Could not be deleted. Please, try again.'));
        //}

        //return $this->redirect(['action' => 'index']);
		return $this->redirect([
			'controller' => $this->controller, 
			'action' => 'index', 
			'?' => [
				'page'		=> $this->paging['Headstations']['page'], 
				'sort'		=> $this->paging['Headstations']['sort'], 
				'direction'	=> $this->paging['Headstations']['direction'],
			]
		]);
		
    }

}

