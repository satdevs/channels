<?php
// Baked at 2021.11.10. 07:44:55
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;

/**
 * Trackings Controller
 *
 * @property \App\Model\Table\TrackingsTable $Trackings
 * @method \App\Model\Entity\Tracking[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TrackingsController extends AppController
{

    /**
     * Initialize controller
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
		$this->set('title', __('Trackings'));
		
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
		$trackings = null;
		
		$this->set('title', __('Trackings'));

		$this->config['index_number_of_rows'] = 1000;
		if($this->config['index_number_of_rows'] === null){
			$this->config['index_number_of_rows'] = 20;
		}
		
		// Clear filter from session
		if($param !== null && $param == 'clear-filter'){
			$this->session->delete('Layout.' . $this->controller . '.Search');
			$this->redirect( $this->request->referer() );
		}		
		
        $this->paginate = [
            'contain' => ['Versions'],
			'conditions' => [
				//'Trackings.name' 		=> 1,
				//'Trackings.visible' 		=> 1,
				//'Trackings.created >= ' 	=> new \DateTime('-10 days'),
				//'Trackings.modified >= '	=> new \DateTime('-10 days'),
			],
			/*
			// Nem tanácsos az order-t itt használni, mert pl az edit után az utolsó  ordert ugyan beálíltja, de
			// kiegészíti ezzel s így az utoljára mentett rekord nem lesz megtalálható az X-edik oldalon, mert az az elsőre kerül.
			// A felhasználó állítson be rendezettséget magának! Kivételes esetek persze lehetnek!
			*/
			'order' => [
				//'Trackings.id' 			=> 'desc',
				//'Trackings.name' 		=> 'asc',
				//'Trackings.visible' 		=> 'desc',
				//'Trackings.pos' 			=> 'desc',
				//'Trackings.rank' 		=> 'asc',
				//'Trackings.created' 		=> 'desc',
				//'Trackings.modified' 	=> 'desc',
			],
			'limit' => $this->config['index_number_of_rows'],
			'maxLimit' => $this->config['index_number_of_rows'],
			//'sortableFields' => ['id', 'name', 'created', '...'],
			//'paramType' => 'querystring',
			//'fields' => ['Trackings.id', 'Trackings.name', ...],
			//'finder' => 'published',
        ];

		//$this->paging = $this->session->read('Layout.' . $this->controller . '.Paging');

		if( $this->paging === null){
			$this->paginate['order'] = [
				//'Trackings.id' 			=> 'desc',
				//'Trackings.name' 		=> 'asc',
				//'Trackings.visible' 		=> 'desc',
				//'Trackings.pos' 			=> 'desc',
				//'Trackings.rank' 		=> 'asc',
				//'Trackings.created' 		=> 'desc',
				//'Trackings.modified' 	=> 'desc',
			];
		}else{
			if($this->request->getQuery('sort') === null && $this->request->getQuery('direction') === null){
				$this->paginate['order'] = [
					// If not in URL-ben, then come from sessinon...
					$this->paging['Trackings']['sort'] => $this->paging['Trackings']['direction']	
				];
			}
		}

		if($this->request->getQuery('page') === null && !isset($this->paging['Trackings']['page']) ){
			$this->paginate['page'] = 1;
		}else{
			$this->paginate['page'] = (isset($this->paging['Trackings']['page'])) ? $this->paging['Trackings']['page'] : 1;
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
						//	'page'		=> $this->paging['Trackings']['page'], 	// Vagy 1
						//	'sort'		=> $this->paging['Trackings']['sort'], 
						//	'direction'	=> $this->paging['Trackings']['direction'],
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
			//$this->paginate['conditions'] = ['Trackings.name LIKE' => $q ];
			$this->paginate['conditions'][] = [
				'OR' => [
					['Trackings.name LIKE' => $search['s'] ],
					//['Trackings.title LIKE' => $search['s'] ], // ... just add more fields
				]
			];
			
		}
		// -- /.Filter --
		
		try {
			$trackings = $this->paginate($this->Trackings);
		} catch (NotFoundException $e) {
			$paging = $this->request->getAttribute('paging');
			if($paging['Trackings']['prevPage'] !== null && $paging['Trackings']['prevPage']){
				if($paging['Trackings']['page'] !== null && $paging['Trackings']['page'] > 0){
					return $this->redirect([
						'controller' => $this->controller, 
						'action' => 'index', 
						'?' => [
							'page'		=> 1,	//$this->paging['Trackings']['page'],
							'sort'		=> $this->paging['Trackings']['sort'],
							'direction'	=> $this->paging['Trackings']['direction'],
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
		$this->set(compact('trackings'));
		
	}


    /**
     * View method
     *
     * @param string|null $id Tracking id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$this->set('title', __('Tracking'));
		
        $tracking = $this->Trackings->get($id, [
            'contain' => ['Versions'],
        ]);

		$this->session->write('Layout.' . $this->controller . '.LastId', $id);

		$name = $tracking->name;

        $this->set(compact('tracking', 'id', 'name'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->set('title', __('Tracking'));
        $tracking = $this->Trackings->newEmptyEntity();
        if ($this->request->is('post')) {
            $tracking = $this->Trackings->patchEntity($tracking, $this->request->getData());
            if ($this->Trackings->save($tracking)) {
                //$this->Flash->success(__('The tracking has been saved.'));
                $this->Flash->success(__('Has been saved.'));

				$this->session->write('Layout.' . $this->controller . '.LastId', $tracking->id);
	
                //return $this->redirect(['action' => 'index']);
                return $this->redirect([
					'controller' => $this->controller, 
					'action' => 'index', 
					'?' => [
						'page'		=> 1,
						'sort'		=> 'id',
						'direction'	=> 'desc',
					],
					'#' => $tracking->id	// Az állandó header miatt takarásban van még. Majd...
				]);

                return $this->redirect(['action' => 'index']);
            }
            //$this->Flash->error(__('The tracking could not be saved. Please, try again.'));
			$this->Flash->error(__('Could not be saved. Please, try again.'));
        }
        //$versions = $this->Trackings->Versions->find('list', ['limit' => 200]);	// Original
		//$versions = $this->Trackings->Versions->find('list', ['limit' => 200, 'conditions'=>['Versions.visible' => 1], 'order'=>['Versions.pos' => 'asc', 'Versions.name' => 'asc']]);
		$versions = $this->Trackings->Versions->find('list', ['limit' => 200, 'order'=>['Versions.pos' => 'asc', 'Versions.name' => 'asc']]);
        //$olds = $this->Trackings->Olds->find('list', ['limit' => 200]);	// Original
		//$olds = $this->Trackings->Olds->find('list', ['limit' => 200, 'conditions'=>['Olds.visible' => 1], 'order'=>['Olds.pos' => 'asc', 'Olds.name' => 'asc']]);
		$olds = $this->Trackings->Olds->find('list', ['limit' => 200, 'order'=>['Olds.pos' => 'asc', 'Olds.name' => 'asc']]);
        //$news = $this->Trackings->News->find('list', ['limit' => 200]);	// Original
		//$news = $this->Trackings->News->find('list', ['limit' => 200, 'conditions'=>['News.visible' => 1], 'order'=>['News.pos' => 'asc', 'News.name' => 'asc']]);
		$news = $this->Trackings->News->find('list', ['limit' => 200, 'order'=>['News.pos' => 'asc', 'News.name' => 'asc']]);
        $this->set(compact('tracking', 'versions', 'olds', 'news'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Tracking id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->set('title', __('Tracking'));
        $tracking = $this->Trackings->get($id, [
            'contain' => [],
        ]);
		
		$this->session->write('Layout.' . $this->controller . '.LastId', $id);
		
        if ($this->request->is(['patch', 'post', 'put'])) {
			//debug($this->request->getData()); //die();
            $tracking = $this->Trackings->patchEntity($tracking, $this->request->getData());
            //debug($tracking); //die();
			if ($this->Trackings->save($tracking)) {
                //$this->Flash->success(__('The tracking has been saved.'));
                $this->Flash->success(__('Has been saved.'));
				
                
				//return $this->redirect(['action' => 'index']);
                return $this->redirect([
					'controller' => $this->controller, 
					'action' => 'index', 
					'?' => [
						'page'		=> (isset($this->paging['Trackings']['page'])) ? $this->paging['Trackings']['page'] : 1, 		// or 1
						'sort'		=> (isset($this->paging['Trackings']['sort'])) ? $this->paging['Trackings']['sort'] : 'created', 
						'direction'	=> (isset($this->paging['Trackings']['direction'])) ? $this->paging['Trackings']['direction'] : 'desc',
					],
					'#' => $id
				]);
				
            }
            //$this->Flash->error(__('The tracking could not be saved. Please, try again.'));
            $this->Flash->error(__('Could not be saved. Please, try again.'));
        }
        //$versions = $this->Trackings->Versions->find('list', ['limit' => 200]);
		//$versions = $this->Trackings->Versions->find('list', ['limit' => 200, 'conditions'=>['Versions.visible' => 1], 'order'=>['Versions.pos' => 'asc', 'Versions.name' => 'asc']]);
		$versions = $this->Trackings->Versions->find('list', ['limit' => 200, 'order'=>['Versions.pos' => 'asc', 'Versions.name' => 'asc']]);
        //$olds = $this->Trackings->Olds->find('list', ['limit' => 200]);
		//$olds = $this->Trackings->Olds->find('list', ['limit' => 200, 'conditions'=>['Olds.visible' => 1], 'order'=>['Olds.pos' => 'asc', 'Olds.name' => 'asc']]);
		$olds = $this->Trackings->Olds->find('list', ['limit' => 200, 'order'=>['Olds.pos' => 'asc', 'Olds.name' => 'asc']]);
        //$news = $this->Trackings->News->find('list', ['limit' => 200]);
		//$news = $this->Trackings->News->find('list', ['limit' => 200, 'conditions'=>['News.visible' => 1], 'order'=>['News.pos' => 'asc', 'News.name' => 'asc']]);
		$news = $this->Trackings->News->find('list', ['limit' => 200, 'order'=>['News.pos' => 'asc', 'News.name' => 'asc']]);

		$name = $tracking->name;

        $this->set(compact('tracking', 'versions', 'olds', 'news', 'id', 'name'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Tracking id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tracking = $this->Trackings->get($id);
        if ($this->Trackings->delete($tracking)) {
            //$this->Flash->success(__('The tracking has been deleted.'));
            $this->Flash->success(__('Has been deleted.'));
        } else {
            //$this->Flash->error(__('The tracking could not be deleted. Please, try again.'));
            $this->Flash->error(__('Could not be deleted. Please, try again.'));
        }

        //return $this->redirect(['action' => 'index']);
		return $this->redirect([
			'controller' => $this->controller, 
			'action' => 'index', 
			'?' => [
				'page'		=> $this->paging['Trackings']['page'], 
				'sort'		=> $this->paging['Trackings']['sort'], 
				'direction'	=> $this->paging['Trackings']['direction'],
			]
		]);
		
    }

}

