<?php
// Baked at 2021.10.28. 15:29:10
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;

/**
 * Bands Controller
 *
 * @property \App\Model\Table\BandsTable $Bands
 * @method \App\Model\Entity\Band[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BandsController extends AppController
{

    /**
     * Initialize controller
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
		$this->set('title', __('Bands'));
		
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
		$bands = null;
		
		$this->set('title', __('Bands'));

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
				//'Bands.name' 		=> 1,
				//'Bands.visible' 		=> 1,
				//'Bands.created >= ' 	=> new \DateTime('-10 days'),
				//'Bands.modified >= '	=> new \DateTime('-10 days'),
			],
			/*
			// Nem tanácsos az order-t itt használni, mert pl az edit után az utolsó  ordert ugyan beálíltja, de
			// kiegészíti ezzel s így az utoljára mentett rekord nem lesz megtalálható az X-edik oldalon, mert az az elsőre kerül.
			// A felhasználó állítson be rendezettséget magának! Kivételes esetek persze lehetnek!
			*/
			'order' => [
				//'Bands.id' 			=> 'desc',
				//'Bands.name' 		=> 'asc',
				//'Bands.visible' 		=> 'desc',
				//'Bands.pos' 			=> 'desc',
				//'Bands.rank' 		=> 'asc',
				//'Bands.created' 		=> 'desc',
				//'Bands.modified' 	=> 'desc',
			],
			'limit' => $this->config['index_number_of_rows'],
			'maxLimit' => $this->config['index_number_of_rows'],
			//'sortableFields' => ['id', 'name', 'created', '...'],
			//'paramType' => 'querystring',
			//'fields' => ['Bands.id', 'Bands.name', ...],
			//'finder' => 'published',
        ];

		//$this->paging = $this->session->read('Layout.' . $this->controller . '.Paging');

		if( $this->paging === null){
			$this->paginate['order'] = [
				//'Bands.id' 			=> 'desc',
				//'Bands.name' 		=> 'asc',
				//'Bands.visible' 		=> 'desc',
				//'Bands.pos' 			=> 'desc',
				//'Bands.rank' 		=> 'asc',
				//'Bands.created' 		=> 'desc',
				//'Bands.modified' 	=> 'desc',
			];
		}else{
			if($this->request->getQuery('sort') === null && $this->request->getQuery('direction') === null){
				$this->paginate['order'] = [
					// If not in URL-ben, then come from sessinon...
					$this->paging['Bands']['sort'] => $this->paging['Bands']['direction']	
				];
			}
		}

		if($this->request->getQuery('page') === null && !isset($this->paging['Bands']['page']) ){
			$this->paginate['page'] = 1;
		}else{
			$this->paginate['page'] = (isset($this->paging['Bands']['page'])) ? $this->paging['Bands']['page'] : 1;
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
						//	'page'		=> $this->paging['Bands']['page'], 	// Vagy 1
						//	'sort'		=> $this->paging['Bands']['sort'], 
						//	'direction'	=> $this->paging['Bands']['direction'],
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
			//$this->paginate['conditions'] = ['Bands.name LIKE' => $q ];
			$this->paginate['conditions'][] = [
				'OR' => [
					['Bands.name LIKE' => $search['s'] ],
					//['Bands.title LIKE' => $search['s'] ], // ... just add more fields
				]
			];
			
		}
		// -- /.Filter --
		
		try {
			$bands = $this->paginate($this->Bands);
		} catch (NotFoundException $e) {
			$paging = $this->request->getAttribute('paging');
			if($paging['Bands']['prevPage'] !== null && $paging['Bands']['prevPage']){
				if($paging['Bands']['page'] !== null && $paging['Bands']['page'] > 0){
					return $this->redirect([
						'controller' => $this->controller, 
						'action' => 'index', 
						'?' => [
							'page'		=> 1,	//$this->paging['Bands']['page'],
							'sort'		=> $this->paging['Bands']['sort'],
							'direction'	=> $this->paging['Bands']['direction'],
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
		$this->set(compact('bands'));
		
	}


    /**
     * View method
     *
     * @param string|null $id Band id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$this->set('title', __('Band'));
		
        $band = $this->Bands->get($id, [
            'contain' => ['PackagesProgramsAnalogs'],
        ]);

		$this->session->write('Layout.' . $this->controller . '.LastId', $id);

		$name = $band->name;

        $this->set(compact('band', 'id', 'name'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->set('title', __('Band'));
        $band = $this->Bands->newEmptyEntity();
        if ($this->request->is('post')) {
			//debug($this->request->getData());
            $band = $this->Bands->patchEntity($band, $this->request->getData());
			$band->broadcast = $this->band_type_broadcast[$band->type];
			//debug($band); die();
            if ($this->Bands->save($band)) {
                //$this->Flash->success(__('The band has been saved.'));
                $this->Flash->success(__('Has been saved.'));

				$this->session->write('Layout.' . $this->controller . '.LastId', $band->id);
	
                //return $this->redirect(['action' => 'index']);
                return $this->redirect([
					'controller' => $this->controller, 
					'action' => 'index', 
					'?' => [
						'page'		=> 1,
						'sort'		=> 'id',
						'direction'	=> 'desc',
					],
					'#' => $band->id	// Az állandó header miatt takarásban van még. Majd...
				]);

                return $this->redirect(['action' => 'index']);
            }
            //$this->Flash->error(__('The band could not be saved. Please, try again.'));
			$this->Flash->error(__('Could not be saved. Please, try again.'));
        }
        $this->set(compact('band'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Band id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->set('title', __('Band'));
        $band = $this->Bands->get($id, [
            'contain' => [],
        ]);
		
		$this->session->write('Layout.' . $this->controller . '.LastId', $id);
		
        if ($this->request->is(['patch', 'post', 'put'])) {
			//debug($this->request->getData()); //die();
            $band = $this->Bands->patchEntity($band, $this->request->getData());
			$band->broadcast = $this->band_type_broadcast[$band->type];
            //debug($band); //die();
			if ($this->Bands->save($band)) {
                //$this->Flash->success(__('The band has been saved.'));
                $this->Flash->success(__('Has been saved.'));
				
                
				//return $this->redirect(['action' => 'index']);
                return $this->redirect([
					'controller' => $this->controller, 
					'action' => 'index', 
					'?' => [
						'page'		=> (isset($this->paging['Bands']['page'])) ? $this->paging['Bands']['page'] : 1, 		// or 1
						'sort'		=> (isset($this->paging['Bands']['sort'])) ? $this->paging['Bands']['sort'] : 'created', 
						'direction'	=> (isset($this->paging['Bands']['direction'])) ? $this->paging['Bands']['direction'] : 'desc',
					],
					'#' => $id
				]);
				
            }
            //$this->Flash->error(__('The band could not be saved. Please, try again.'));
            $this->Flash->error(__('Could not be saved. Please, try again.'));
        }

		$name = $band->name;

        $this->set(compact('band', 'id', 'name'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Band id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $band = $this->Bands->get($id);
        //if ($this->Bands->delete($band)) {
        //    //$this->Flash->success(__('The band has been deleted.'));
        //    $this->Flash->success(__('Has been deleted.'));
        //} else {
        //    //$this->Flash->error(__('The band could not be deleted. Please, try again.'));
            $this->Flash->error(__('You can not delete band!'));
        //    $this->Flash->error(__('Could not be deleted. Please, try again.'));
        //}

        //return $this->redirect(['action' => 'index']);
		return $this->redirect([
			'controller' => $this->controller, 
			'action' => 'index', 
			'?' => [
				'page'		=> $this->paging['Bands']['page'], 
				'sort'		=> $this->paging['Bands']['sort'], 
				'direction'	=> $this->paging['Bands']['direction'],
			]
		]);
		
    }

}

