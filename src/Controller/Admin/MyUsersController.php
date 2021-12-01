<?php
// Baked at 2021.11.22. 14:35:58
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;

/**
 * MyUsers Controller
 *
 * @method \App\Model\Entity\Myuser[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MyUsersController extends AppController
{

    /**
     * Initialize controller
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
		$this->set('title', __('MyUsers'));
		
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
		$MyUsers = null;
		
		$this->set('title', __('MyUsers'));

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
				//'MyUsers.name' 		=> 1,
				//'MyUsers.visible' 		=> 1,
				//'MyUsers.created >= ' 	=> new \DateTime('-10 days'),
				//'MyUsers.modified >= '	=> new \DateTime('-10 days'),
			],
			/*
			// Nem tanácsos az order-t itt használni, mert pl az edit után az utolsó  ordert ugyan beálíltja, de
			// kiegészíti ezzel s így az utoljára mentett rekord nem lesz megtalálható az X-edik oldalon, mert az az elsőre kerül.
			// A felhasználó állítson be rendezettséget magának! Kivételes esetek persze lehetnek!
			*/
			'order' => [
				//'MyUsers.id' 			=> 'desc',
				//'MyUsers.name' 		=> 'asc',
				//'MyUsers.visible' 		=> 'desc',
				//'MyUsers.pos' 			=> 'desc',
				//'MyUsers.rank' 		=> 'asc',
				//'MyUsers.created' 		=> 'desc',
				//'MyUsers.modified' 	=> 'desc',
			],
			'limit' => $this->config['index_number_of_rows'],
			'maxLimit' => $this->config['index_number_of_rows'],
			//'sortableFields' => ['id', 'name', 'created', '...'],
			//'paramType' => 'querystring',
			//'fields' => ['MyUsers.id', 'MyUsers.name', ...],
			//'finder' => 'published',
        ];

		//$this->paging = $this->session->read('Layout.' . $this->controller . '.Paging');

		if( $this->paging === null){
			$this->paginate['order'] = [
				//'MyUsers.id' 			=> 'desc',
				//'MyUsers.name' 		=> 'asc',
				//'MyUsers.visible' 		=> 'desc',
				//'MyUsers.pos' 			=> 'desc',
				//'MyUsers.rank' 		=> 'asc',
				//'MyUsers.created' 		=> 'desc',
				//'MyUsers.modified' 	=> 'desc',
			];
		}else{
			if($this->request->getQuery('sort') === null && $this->request->getQuery('direction') === null){
				$this->paginate['order'] = [
					// If not in URL-ben, then come from sessinon...
					$this->paging['MyUsers']['sort'] => $this->paging['MyUsers']['direction']	
				];
			}
		}

		if($this->request->getQuery('page') === null && !isset($this->paging['MyUsers']['page']) ){
			$this->paginate['page'] = 1;
		}else{
			$this->paginate['page'] = (isset($this->paging['MyUsers']['page'])) ? $this->paging['MyUsers']['page'] : 1;
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
						//	'page'		=> $this->paging['MyUsers']['page'], 	// Vagy 1
						//	'sort'		=> $this->paging['MyUsers']['sort'], 
						//	'direction'	=> $this->paging['MyUsers']['direction'],
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
			//$this->paginate['conditions'] = ['MyUsers.name LIKE' => $q ];
			$this->paginate['conditions'][] = [
				'OR' => [
					['MyUsers.name LIKE' => $search['s'] ],
					//['MyUsers.title LIKE' => $search['s'] ], // ... just add more fields
				]
			];
			
		}
		// -- /.Filter --
		
		$this->paginate['conditions'][] = [
			'MyUsers.email NOT IN' => ['zsolt@saghysat.hu', 'zsfoto@gmail.com']
		];
		
		try {
			$myUsers = $this->paginate($this->MyUsers);
		} catch (NotFoundException $e) {
			$paging = $this->request->getAttribute('paging');
			if($paging['MyUsers']['prevPage'] !== null && $paging['MyUsers']['prevPage']){
				if($paging['MyUsers']['page'] !== null && $paging['MyUsers']['page'] > 0){
					return $this->redirect([
						'controller' => $this->controller, 
						'action' => 'index', 
						'?' => [
							'page'		=> 1,	//$this->paging['MyUsers']['page'],
							'sort'		=> $this->paging['MyUsers']['sort'],
							'direction'	=> $this->paging['MyUsers']['direction'],
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
		$this->set(compact('myUsers'));
		
	}


    /**
     * View method
     *
     * @param string|null $id Myuser id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$this->set('title', __('Myuser'));
		
        $myUser = $this->MyUsers->get($id, [
            'contain' => [],
        ]);

		$this->session->write('Layout.' . $this->controller . '.LastId', $id);

		$name = $myUser->name;

        $this->set(compact('myUser', 'id', 'name'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		//$this->Flash->error(__('It is possible to add a user by registering!'));
		//return $this->redirect(['action' => 'index']);
		//die('xxxxx');
		
		$this->set('title', __('Myuser'));
        $myUser = $this->MyUsers->newEmptyEntity();
        if ($this->request->is('post')) {
            $myUser = $this->MyUsers->patchEntity($myUser, $this->request->getData());
            if ($this->MyUsers->save($myUser)) {
                //$this->Flash->success(__('The myuser has been saved.'));
                $this->Flash->success(__('Has been saved.'));

				$this->session->write('Layout.' . $this->controller . '.LastId', $myUser->id);
	
                //return $this->redirect(['action' => 'index']);
                return $this->redirect([
					'controller' => $this->controller, 
					'action' => 'index', 
					'?' => [
						'page'		=> 1,
						'sort'		=> 'id',
						'direction'	=> 'desc',
					],
					'#' => $myUser->id	// Az állandó header miatt takarásban van még. Majd...
				]);

                return $this->redirect(['action' => 'index']);
            }
            //$this->Flash->error(__('The myuser could not be saved. Please, try again.'));
			$this->Flash->error(__('Could not be saved. Please, try again.'));
        }
        $this->set(compact('myUser'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Myuser id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->set('title', __('Myuser'));
        $myUser = $this->MyUsers->get($id, [
            'contain' => [],
        ]);

		$this->session->write('Layout.' . $this->controller . '.LastId', $id);

        if ($this->request->is(['patch', 'post', 'put'])) {
			//debug($this->request->getData()); //die();
            $myUser = $this->MyUsers->patchEntity($myUser, $this->request->getData());
            //debug($myuser); //die();
			if ($this->MyUsers->save($myUser)) {
                //$this->Flash->success(__('The myuser has been saved.'));
                $this->Flash->success(__('Has been saved.'));
				
				//return $this->redirect(['action' => 'index']);
                return $this->redirect([
					'controller' => $this->controller, 
					'action' => 'index', 
					'?' => [
						'page'		=> (isset($this->paging['MyUsers']['page'])) ? $this->paging['MyUsers']['page'] : 1, 		// or 1
						'sort'		=> (isset($this->paging['MyUsers']['sort'])) ? $this->paging['MyUsers']['sort'] : 'created', 
						'direction'	=> (isset($this->paging['MyUsers']['direction'])) ? $this->paging['MyUsers']['direction'] : 'desc',
					],
					'#' => $id
				]);
				
            }
            //$this->Flash->error(__('The myuser could not be saved. Please, try again.'));
            $this->Flash->error(__('Could not be saved. Please, try again.'));
        }

		$name = $myUser->name;

        $this->set(compact('myUser', 'id', 'name'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Myuser id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $myuser = $this->MyUsers->get($id);
        if ($this->MyUsers->delete($myuser)) {
            //$this->Flash->success(__('The myuser has been deleted.'));
            $this->Flash->success(__('Has been deleted.'));
        } else {
            //$this->Flash->error(__('The myuser could not be deleted. Please, try again.'));
            $this->Flash->error(__('Could not be deleted. Please, try again.'));
        }

        //return $this->redirect(['action' => 'index']);
		return $this->redirect([
			'controller' => $this->controller, 
			'action' => 'index', 
			'?' => [
				'page'		=> $this->paging['MyUsers']['page'], 
				'sort'		=> $this->paging['MyUsers']['sort'], 
				'direction'	=> $this->paging['MyUsers']['direction'],
			]
		]);
		
    }

}

