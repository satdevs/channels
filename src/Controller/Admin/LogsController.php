<?php
// Baked at 2021.10.28. 15:29:10
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;

/**
 * Logs Controller
 *
 * @property \App\Model\Table\LogsTable $Logs
 * @method \App\Model\Entity\Log[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LogsController extends AppController
{

    /**
     * Initialize controller
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
		$this->set('title', __('Logs'));
		
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
		$logs = null;
		
		$this->set('title', __('Logs'));

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
            'contain' => ['Users', 'Models'],
			'conditions' => [
				//'Logs.name' 		=> 1,
				//'Logs.visible' 		=> 1,
				//'Logs.created >= ' 	=> new \DateTime('-10 days'),
				//'Logs.modified >= '	=> new \DateTime('-10 days'),
			],
			/*
			// Nem tanácsos az order-t itt használni, mert pl az edit után az utolsó  ordert ugyan beálíltja, de
			// kiegészíti ezzel s így az utoljára mentett rekord nem lesz megtalálható az X-edik oldalon, mert az az elsőre kerül.
			// A felhasználó állítson be rendezettséget magának! Kivételes esetek persze lehetnek!
			*/
			'order' => [
				//'Logs.id' 			=> 'desc',
				//'Logs.name' 		=> 'asc',
				//'Logs.visible' 		=> 'desc',
				//'Logs.pos' 			=> 'desc',
				//'Logs.rank' 		=> 'asc',
				//'Logs.created' 		=> 'desc',
				//'Logs.modified' 	=> 'desc',
			],
			'limit' => $this->config['index_number_of_rows'],
			'maxLimit' => $this->config['index_number_of_rows'],
			//'sortableFields' => ['id', 'name', 'created', '...'],
			//'paramType' => 'querystring',
			//'fields' => ['Logs.id', 'Logs.name', ...],
			//'finder' => 'published',
        ];

		//$this->paging = $this->session->read('Layout.' . $this->controller . '.Paging');

		if( $this->paging === null){
			$this->paginate['order'] = [
				//'Logs.id' 			=> 'desc',
				//'Logs.name' 		=> 'asc',
				//'Logs.visible' 		=> 'desc',
				//'Logs.pos' 			=> 'desc',
				//'Logs.rank' 		=> 'asc',
				//'Logs.created' 		=> 'desc',
				//'Logs.modified' 	=> 'desc',
			];
		}else{
			if($this->request->getQuery('sort') === null && $this->request->getQuery('direction') === null){
				$this->paginate['order'] = [
					// If not in URL-ben, then come from sessinon...
					$this->paging['Logs']['sort'] => $this->paging['Logs']['direction']	
				];
			}
		}

		if($this->request->getQuery('page') === null && !isset($this->paging['Logs']['page']) ){
			$this->paginate['page'] = 1;
		}else{
			$this->paginate['page'] = (isset($this->paging['Logs']['page'])) ? $this->paging['Logs']['page'] : 1;
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
						//	'page'		=> $this->paging['Logs']['page'], 	// Vagy 1
						//	'sort'		=> $this->paging['Logs']['sort'], 
						//	'direction'	=> $this->paging['Logs']['direction'],
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
			//$this->paginate['conditions'] = ['Logs.name LIKE' => $q ];
			$this->paginate['conditions'][] = [
				'OR' => [
					['Logs.name LIKE' => $search['s'] ],
					//['Logs.title LIKE' => $search['s'] ], // ... just add more fields
				]
			];
			
		}
		// -- /.Filter --
		
		try {
			$logs = $this->paginate($this->Logs);
		} catch (NotFoundException $e) {
			$paging = $this->request->getAttribute('paging');
			if($paging['Logs']['prevPage'] !== null && $paging['Logs']['prevPage']){
				if($paging['Logs']['page'] !== null && $paging['Logs']['page'] > 0){
					return $this->redirect([
						'controller' => $this->controller, 
						'action' => 'index', 
						'?' => [
							'page'		=> 1,	//$this->paging['Logs']['page'],
							'sort'		=> $this->paging['Logs']['sort'],
							'direction'	=> $this->paging['Logs']['direction'],
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
		$this->set(compact('logs'));
		
	}


    /**
     * View method
     *
     * @param string|null $id Log id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$this->set('title', __('Log'));
		
        $log = $this->Logs->get($id, [
            'contain' => ['Users', 'Models'],
        ]);

		$this->session->write('Layout.' . $this->controller . '.LastId', $id);

		$name = $log->name;

        $this->set(compact('log', 'id', 'name'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->set('title', __('Log'));
        $log = $this->Logs->newEmptyEntity();
        if ($this->request->is('post')) {
            $log = $this->Logs->patchEntity($log, $this->request->getData());
            if ($this->Logs->save($log)) {
                //$this->Flash->success(__('The log has been saved.'));
                $this->Flash->success(__('Has been saved.'));

				$this->session->write('Layout.' . $this->controller . '.LastId', $log->id);
	
                //return $this->redirect(['action' => 'index']);
                return $this->redirect([
					'controller' => $this->controller, 
					'action' => 'index', 
					'?' => [
						'page'		=> 1,
						'sort'		=> 'id',
						'direction'	=> 'desc',
					],
					'#' => $log->id	// Az állandó header miatt takarásban van még. Majd...
				]);

                return $this->redirect(['action' => 'index']);
            }
            //$this->Flash->error(__('The log could not be saved. Please, try again.'));
			$this->Flash->error(__('Could not be saved. Please, try again.'));
        }
        //$users = $this->Logs->Users->find('list', ['limit' => 200]);	// Original
		//$users = $this->Logs->Users->find('list', ['limit' => 200, 'conditions'=>['Users.visible' => 1], 'order'=>['Users.pos' => 'asc', 'Users.name' => 'asc']]);
		$users = $this->Logs->Users->find('list', ['limit' => 200, 'order'=>['Users.pos' => 'asc', 'Users.name' => 'asc']]);
        //$models = $this->Logs->Models->find('list', ['limit' => 200]);	// Original
		//$models = $this->Logs->Models->find('list', ['limit' => 200, 'conditions'=>['Models.visible' => 1], 'order'=>['Models.pos' => 'asc', 'Models.name' => 'asc']]);
		$models = $this->Logs->Models->find('list', ['limit' => 200, 'order'=>['Models.pos' => 'asc', 'Models.name' => 'asc']]);
        $this->set(compact('log', 'users', 'models'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Log id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->set('title', __('Log'));
        $log = $this->Logs->get($id, [
            'contain' => [],
        ]);
		
		$this->session->write('Layout.' . $this->controller . '.LastId', $id);
		
        if ($this->request->is(['patch', 'post', 'put'])) {
			//debug($this->request->getData()); //die();
            $log = $this->Logs->patchEntity($log, $this->request->getData());
            //debug($log); //die();
			if ($this->Logs->save($log)) {
                //$this->Flash->success(__('The log has been saved.'));
                $this->Flash->success(__('Has been saved.'));
				
                
				//return $this->redirect(['action' => 'index']);
                return $this->redirect([
					'controller' => $this->controller, 
					'action' => 'index', 
					'?' => [
						'page'		=> (isset($this->paging['Logs']['page'])) ? $this->paging['Logs']['page'] : 1, 		// or 1
						'sort'		=> (isset($this->paging['Logs']['sort'])) ? $this->paging['Logs']['sort'] : 'created', 
						'direction'	=> (isset($this->paging['Logs']['direction'])) ? $this->paging['Logs']['direction'] : 'desc',
					],
					'#' => $id
				]);
				
            }
            //$this->Flash->error(__('The log could not be saved. Please, try again.'));
            $this->Flash->error(__('Could not be saved. Please, try again.'));
        }
        //$users = $this->Logs->Users->find('list', ['limit' => 200]);
		//$users = $this->Logs->Users->find('list', ['limit' => 200, 'conditions'=>['Users.visible' => 1], 'order'=>['Users.pos' => 'asc', 'Users.name' => 'asc']]);
		$users = $this->Logs->Users->find('list', ['limit' => 200, 'order'=>['Users.pos' => 'asc', 'Users.name' => 'asc']]);
        //$models = $this->Logs->Models->find('list', ['limit' => 200]);
		//$models = $this->Logs->Models->find('list', ['limit' => 200, 'conditions'=>['Models.visible' => 1], 'order'=>['Models.pos' => 'asc', 'Models.name' => 'asc']]);
		$models = $this->Logs->Models->find('list', ['limit' => 200, 'order'=>['Models.pos' => 'asc', 'Models.name' => 'asc']]);

		$name = $log->name;

        $this->set(compact('log', 'users', 'models', 'id', 'name'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Log id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $log = $this->Logs->get($id);
        if ($this->Logs->delete($log)) {
            //$this->Flash->success(__('The log has been deleted.'));
            $this->Flash->success(__('Has been deleted.'));
        } else {
            //$this->Flash->error(__('The log could not be deleted. Please, try again.'));
            $this->Flash->error(__('Could not be deleted. Please, try again.'));
        }

        //return $this->redirect(['action' => 'index']);
		return $this->redirect([
			'controller' => $this->controller, 
			'action' => 'index', 
			'?' => [
				'page'		=> $this->paging['Logs']['page'], 
				'sort'		=> $this->paging['Logs']['sort'], 
				'direction'	=> $this->paging['Logs']['direction'],
			]
		]);
		
    }

}

