<?php
// Baked at 2021.10.28. 15:39:54
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;

/**
 * Ackeys Controller
 *
 * @property \App\Model\Table\AckeysTable $Ackeys
 * @method \App\Model\Entity\Ackey[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AckeysController extends AppController
{

    /**
     * Initialize controller
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
		$this->set('title', __('Ackeys'));
		
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
		$ackeys = null;
		
		$this->set('title', __('Ackeys'));

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
				//'Ackeys.name' 		=> 1,
				//'Ackeys.visible' 		=> 1,
				//'Ackeys.created >= ' 	=> new \DateTime('-10 days'),
				//'Ackeys.modified >= '	=> new \DateTime('-10 days'),
			],
			/*
			// Nem tanácsos az order-t itt használni, mert pl az edit után az utolsó  ordert ugyan beálíltja, de
			// kiegészíti ezzel s így az utoljára mentett rekord nem lesz megtalálható az X-edik oldalon, mert az az elsőre kerül.
			// A felhasználó állítson be rendezettséget magának! Kivételes esetek persze lehetnek!
			*/
			'order' => [
				//'Ackeys.id' 			=> 'desc',
				//'Ackeys.name' 		=> 'asc',
				//'Ackeys.visible' 		=> 'desc',
				'Ackeys.pos' 			=> 'asc',
				//'Ackeys.rank' 		=> 'asc',
				//'Ackeys.created' 		=> 'desc',
				//'Ackeys.modified' 	=> 'desc',
			],
			'limit' => $this->config['index_number_of_rows'],
			'maxLimit' => $this->config['index_number_of_rows'],
			//'sortableFields' => ['id', 'name', 'created', '...'],
			//'paramType' => 'querystring',
			//'fields' => ['Ackeys.id', 'Ackeys.name', ...],
			//'finder' => 'published',
        ];

		//$this->paging = $this->session->read('Layout.' . $this->controller . '.Paging');

		if( $this->paging === null){
			$this->paginate['order'] = [
				//'Ackeys.id' 			=> 'desc',
				//'Ackeys.name' 		=> 'asc',
				//'Ackeys.visible' 		=> 'desc',
				'Ackeys.pos' 			=> 'asc',
				//'Ackeys.rank' 		=> 'asc',
				//'Ackeys.created' 		=> 'desc',
				//'Ackeys.modified' 	=> 'desc',
			];
		}else{
			if($this->request->getQuery('sort') === null && $this->request->getQuery('direction') === null){
				$this->paginate['order'] = [
					// If not in URL-ben, then come from sessinon...
					$this->paging['Ackeys']['sort'] => $this->paging['Ackeys']['direction']	
				];
			}
		}

		if($this->request->getQuery('page') === null && !isset($this->paging['Ackeys']['page']) ){
			$this->paginate['page'] = 1;
		}else{
			$this->paginate['page'] = (isset($this->paging['Ackeys']['page'])) ? $this->paging['Ackeys']['page'] : 1;
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
						//	'page'		=> $this->paging['Ackeys']['page'], 	// Vagy 1
						//	'sort'		=> $this->paging['Ackeys']['sort'], 
						//	'direction'	=> $this->paging['Ackeys']['direction'],
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
			//$this->paginate['conditions'] = ['Ackeys.name LIKE' => $q ];
			$this->paginate['conditions'][] = [
				'OR' => [
					['Ackeys.name LIKE' => $search['s'] ],
					//['Ackeys.title LIKE' => $search['s'] ], // ... just add more fields
				]
			];
			
		}
		// -- /.Filter --
		
		try {
			$ackeys = $this->paginate($this->Ackeys);
		} catch (NotFoundException $e) {
			$paging = $this->request->getAttribute('paging');
			if($paging['Ackeys']['prevPage'] !== null && $paging['Ackeys']['prevPage']){
				if($paging['Ackeys']['page'] !== null && $paging['Ackeys']['page'] > 0){
					return $this->redirect([
						'controller' => $this->controller, 
						'action' => 'index', 
						'?' => [
							'page'		=> 1,	//$this->paging['Ackeys']['page'],
							'sort'		=> $this->paging['Ackeys']['sort'],
							'direction'	=> $this->paging['Ackeys']['direction'],
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
		$this->set(compact('ackeys'));
		
	}


    /**
     * View method
     *
     * @param string|null $id Ackey id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$this->set('title', __('Ackey'));
		
        $ackey = $this->Ackeys->get($id, [
            'contain' => ['PackagesProgramsDigitals' => ['Programs']],
        ]);

		$this->session->write('Layout.' . $this->controller . '.LastId', $id);

		$name = $ackey->name;

        $this->set(compact('ackey', 'id', 'name'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->set('title', __('Ackey'));
        $ackey = $this->Ackeys->newEmptyEntity();
        if ($this->request->is('post')) {
            $ackey = $this->Ackeys->patchEntity($ackey, $this->request->getData());
            if ($this->Ackeys->save($ackey)) {
                //$this->Flash->success(__('The ackey has been saved.'));
                $this->Flash->success(__('Has been saved.'));
				$this->session->write('Layout.' . $this->controller . '.LastId', $ackey->id);
                //return $this->redirect(['action' => 'index']);
                return $this->redirect([
					'controller' => $this->controller, 
					'action' => 'index', 
					'?' => [
						'page'		=> 1,
						'sort'		=> 'id',
						'direction'	=> 'desc',
					],
					'#' => $ackey->id	// Az állandó header miatt takarásban van még. Majd...
				]);

                return $this->redirect(['action' => 'index']);
            }
            //$this->Flash->error(__('The ackey could not be saved. Please, try again.'));
			$this->Flash->error(__('Could not be saved. Please, try again.'));
        }
        $this->set(compact('ackey'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Ackey id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->set('title', __('Ackey'));
        $ackey = $this->Ackeys->get($id, [
            'contain' => [],
        ]);
		
		$this->session->write('Layout.' . $this->controller . '.LastId', $id);
				
        if ($this->request->is(['patch', 'post', 'put'])) {
			//debug($this->request->getData()); //die();
            $ackey = $this->Ackeys->patchEntity($ackey, $this->request->getData());
            //debug($ackey); //die();
			if ($this->Ackeys->save($ackey)) {
                //$this->Flash->success(__('The ackey has been saved.'));
                $this->Flash->success(__('Has been saved.'));
				
                
				//return $this->redirect(['action' => 'index']);
                return $this->redirect([
					'controller' => $this->controller, 
					'action' => 'index', 
					'?' => [
						'page'		=> (isset($this->paging['Ackeys']['page'])) ? $this->paging['Ackeys']['page'] : 1, 		// or 1
						'sort'		=> (isset($this->paging['Ackeys']['sort'])) ? $this->paging['Ackeys']['sort'] : 'created', 
						'direction'	=> (isset($this->paging['Ackeys']['direction'])) ? $this->paging['Ackeys']['direction'] : 'desc',
					],
					'#' => $id
				]);
				
            }
            //$this->Flash->error(__('The ackey could not be saved. Please, try again.'));
            $this->Flash->error(__('Could not be saved. Please, try again.'));
        }

		$name = $ackey->name;

        $this->set(compact('ackey', 'id', 'name'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Ackey id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ackey = $this->Ackeys->get($id);
        //if ($this->Ackeys->delete($ackey)) {
        //    //$this->Flash->success(__('The ackey has been deleted.'));
        //    $this->Flash->success(__('Has been deleted.'));
        //} else {
        //    //$this->Flash->error(__('The ackey could not be deleted. Please, try again.'));
            $this->Flash->error(__('You can not delete ackey!'));
        //    $this->Flash->error(__('Could not be deleted. Please, try again.'));
        //}

        //return $this->redirect(['action' => 'index']);
		return $this->redirect([
			'controller' => $this->controller, 
			'action' => 'index', 
			'?' => [
				'page'		=> $this->paging['Ackeys']['page'], 
				'sort'		=> $this->paging['Ackeys']['sort'], 
				'direction'	=> $this->paging['Ackeys']['direction'],
			]
		]);
		
    }

}

