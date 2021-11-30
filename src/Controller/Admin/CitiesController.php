<?php
// Baked at 2021.10.28. 15:29:10
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;

/**
 * Cities Controller
 *
 * @property \App\Model\Table\CitiesTable $Cities
 * @method \App\Model\Entity\City[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CitiesController extends AppController
{

    /**
     * Initialize controller
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
		$this->set('title', __('Cities'));
		
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
		$cities = null;
		
		$this->set('title', __('Cities'));

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
            'contain' => ['Headstations'],
			'conditions' => [
				//'Cities.name' 		=> 1,
				//'Cities.visible' 		=> 1,
				//'Cities.created >= ' 	=> new \DateTime('-10 days'),
				//'Cities.modified >= '	=> new \DateTime('-10 days'),
			],
			/*
			// Nem tanácsos az order-t itt használni, mert pl az edit után az utolsó  ordert ugyan beálíltja, de
			// kiegészíti ezzel s így az utoljára mentett rekord nem lesz megtalálható az X-edik oldalon, mert az az elsőre kerül.
			// A felhasználó állítson be rendezettséget magának! Kivételes esetek persze lehetnek!
			*/
			'order' => [
				//'Cities.id' 			=> 'desc',
				'Cities.name' 		=> 'asc',
				//'Cities.visible' 		=> 'desc',
				//'Cities.pos' 			=> 'desc',
				//'Cities.rank' 		=> 'asc',
				//'Cities.created' 		=> 'desc',
				//'Cities.modified' 	=> 'desc',
			],
			'limit' => $this->config['index_number_of_rows'],
			'maxLimit' => $this->config['index_number_of_rows'],
			//'sortableFields' => ['id', 'name', 'created', '...'],
			//'paramType' => 'querystring',
			//'fields' => ['Cities.id', 'Cities.name', ...],
			//'finder' => 'published',
        ];

		//$this->paging = $this->session->read('Layout.' . $this->controller . '.Paging');

		if( $this->paging === null){
			$this->paginate['order'] = [
				//'Cities.id' 			=> 'desc',
				'Cities.name' 		=> 'asc',
				//'Cities.visible' 		=> 'desc',
				//'Cities.pos' 			=> 'desc',
				//'Cities.rank' 		=> 'asc',
				//'Cities.created' 		=> 'desc',
				//'Cities.modified' 	=> 'desc',
			];
		}else{
			if($this->request->getQuery('sort') === null && $this->request->getQuery('direction') === null){
				$this->paginate['order'] = [
					// If not in URL-ben, then come from sessinon...
					$this->paging['Cities']['sort'] => $this->paging['Cities']['direction']	
				];
			}
		}

		if($this->request->getQuery('page') === null && !isset($this->paging['Cities']['page']) ){
			$this->paginate['page'] = 1;
		}else{
			$this->paginate['page'] = (isset($this->paging['Cities']['page'])) ? $this->paging['Cities']['page'] : 1;
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
						//	'page'		=> $this->paging['Cities']['page'], 	// Vagy 1
						//	'sort'		=> $this->paging['Cities']['sort'], 
						//	'direction'	=> $this->paging['Cities']['direction'],
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
			//$this->paginate['conditions'] = ['Cities.name LIKE' => $q ];
			$this->paginate['conditions'][] = [
				'OR' => [
					['Cities.name LIKE' => $search['s'] ],
					//['Cities.title LIKE' => $search['s'] ], // ... just add more fields
				]
			];
			
		}
		// -- /.Filter --
		
		try {
			$cities = $this->paginate($this->Cities);
		} catch (NotFoundException $e) {
			$paging = $this->request->getAttribute('paging');
			if($paging['Cities']['prevPage'] !== null && $paging['Cities']['prevPage']){
				if($paging['Cities']['page'] !== null && $paging['Cities']['page'] > 0){
					return $this->redirect([
						'controller' => $this->controller, 
						'action' => 'index', 
						'?' => [
							'page'		=> 1,	//$this->paging['Cities']['page'],
							'sort'		=> $this->paging['Cities']['sort'],
							'direction'	=> $this->paging['Cities']['direction'],
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
		$this->set(compact('cities'));
		
	}


    /**
     * View method
     *
     * @param string|null $id City id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$this->set('title', __('City'));
		
        $city = $this->Cities->get($id, [
            'contain' => ['Headstations'],
        ]);

		$this->session->write('Layout.' . $this->controller . '.LastId', $id);

		$name = $city->name;

        $this->set(compact('city', 'id', 'name'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->set('title', __('City'));
        $city = $this->Cities->newEmptyEntity();
        if ($this->request->is('post')) {
            $city = $this->Cities->patchEntity($city, $this->request->getData());
            if ($this->Cities->save($city)) {
                //$this->Flash->success(__('The city has been saved.'));
                $this->Flash->success(__('Has been saved.'));

				$this->session->write('Layout.' . $this->controller . '.LastId', $city->id);
	
                //return $this->redirect(['action' => 'index']);
                return $this->redirect([
					'controller' => $this->controller, 
					'action' => 'index', 
					'?' => [
						'page'		=> 1,
						'sort'		=> 'id',
						'direction'	=> 'desc',
					],
					'#' => $city->id	// Az állandó header miatt takarásban van még. Majd...
				]);

                return $this->redirect(['action' => 'index']);
            }
            //$this->Flash->error(__('The city could not be saved. Please, try again.'));
			$this->Flash->error(__('Could not be saved. Please, try again.'));
        }
        //$headstations = $this->Cities->Headstations->find('list', ['limit' => 200]);	// Original
		//$headstations = $this->Cities->Headstations->find('list', ['limit' => 200, 'conditions'=>['Headstations.visible' => 1], 'order'=>['Headstations.pos' => 'asc', 'Headstations.name' => 'asc']]);
		$headstations = $this->Cities->Headstations->find('list', ['limit' => 200, 'order'=>['Headstations.pos' => 'asc', 'Headstations.name' => 'asc']]);
        $this->set(compact('city', 'headstations'));
    }


    /**
     * Edit method
     *
     * @param string|null $id City id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->set('title', __('City'));
        $city = $this->Cities->get($id, [
            'contain' => [],
        ]);
		
		$this->session->write('Layout.' . $this->controller . '.LastId', $id);
		
        if ($this->request->is(['patch', 'post', 'put'])) {
			//debug($this->request->getData()); //die();
            $city = $this->Cities->patchEntity($city, $this->request->getData());
            //debug($city); //die();
			if ($this->Cities->save($city)) {
                //$this->Flash->success(__('The city has been saved.'));
                $this->Flash->success(__('Has been saved.'));
				
                
				//return $this->redirect(['action' => 'index']);
                return $this->redirect([
					'controller' => $this->controller, 
					'action' => 'index', 
					'?' => [
						'page'		=> (isset($this->paging['Cities']['page'])) ? $this->paging['Cities']['page'] : 1, 		// or 1
						'sort'		=> (isset($this->paging['Cities']['sort'])) ? $this->paging['Cities']['sort'] : 'created', 
						'direction'	=> (isset($this->paging['Cities']['direction'])) ? $this->paging['Cities']['direction'] : 'desc',
					],
					'#' => $id
				]);
				
            }
            //$this->Flash->error(__('The city could not be saved. Please, try again.'));
            $this->Flash->error(__('Could not be saved. Please, try again.'));
        }
        //$headstations = $this->Cities->Headstations->find('list', ['limit' => 200]);
		//$headstations = $this->Cities->Headstations->find('list', ['limit' => 200, 'conditions'=>['Headstations.visible' => 1], 'order'=>['Headstations.pos' => 'asc', 'Headstations.name' => 'asc']]);
		$headstations = $this->Cities->Headstations->find('list', ['limit' => 200, 'order'=>['Headstations.pos' => 'asc', 'Headstations.name' => 'asc']]);

		$name = $city->name;

        $this->set(compact('city', 'headstations', 'id', 'name'));
    }


    /**
     * Delete method
     *
     * @param string|null $id City id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $city = $this->Cities->get($id);
        //if ($this->Cities->delete($city)) {
        //    //$this->Flash->success(__('The city has been deleted.'));
        //    $this->Flash->success(__('Has been deleted.'));
        //} else {
        //    //$this->Flash->error(__('The city could not be deleted. Please, try again.'));
			$this->Flash->error(__('You can not delete city!'));
        //    $this->Flash->error(__('Could not be deleted. Please, try again.'));
        //}

        //return $this->redirect(['action' => 'index']);
		return $this->redirect([
			'controller' => $this->controller, 
			'action' => 'index', 
			'?' => [
				'page'		=> $this->paging['Cities']['page'], 
				'sort'		=> $this->paging['Cities']['sort'], 
				'direction'	=> $this->paging['Cities']['direction'],
			]
		]);
		
    }

}

