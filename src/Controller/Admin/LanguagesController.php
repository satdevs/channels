<?php
// Baked at 2021.10.28. 15:29:10
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;

/**
 * Languages Controller
 *
 * @property \App\Model\Table\LanguagesTable $Languages
 * @method \App\Model\Entity\Language[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LanguagesController extends AppController
{

    /**
     * Initialize controller
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
		$this->set('title', __('Languages'));
		
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
		$languages = null;
		
		$this->set('title', __('Languages'));

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
				'Languages.version_id' 		=> $this->version_id,
				//'Languages.visible' 		=> 1,
				//'Languages.created >= ' 	=> new \DateTime('-10 days'),
				//'Languages.modified >= '	=> new \DateTime('-10 days'),
			],
			/*
			// Nem tanácsos az order-t itt használni, mert pl az edit után az utolsó  ordert ugyan beálíltja, de
			// kiegészíti ezzel s így az utoljára mentett rekord nem lesz megtalálható az X-edik oldalon, mert az az elsőre kerül.
			// A felhasználó állítson be rendezettséget magának! Kivételes esetek persze lehetnek!
			*/
			'order' => [
				//'Languages.id' 			=> 'desc',
				//'Languages.name' 		=> 'asc',
				//'Languages.visible' 		=> 'desc',
				//'Languages.pos' 			=> 'desc',
				//'Languages.rank' 		=> 'asc',
				//'Languages.created' 		=> 'desc',
				//'Languages.modified' 	=> 'desc',
			],
			'limit' => $this->config['index_number_of_rows'],
			'maxLimit' => $this->config['index_number_of_rows'],
			//'sortableFields' => ['id', 'name', 'created', '...'],
			//'paramType' => 'querystring',
			//'fields' => ['Languages.id', 'Languages.name', ...],
			//'finder' => 'published',
        ];

		//$this->paging = $this->session->read('Layout.' . $this->controller . '.Paging');

		if( $this->paging === null){
			$this->paginate['order'] = [
				//'Languages.id' 			=> 'desc',
				//'Languages.name' 		=> 'asc',
				//'Languages.visible' 		=> 'desc',
				//'Languages.pos' 			=> 'desc',
				//'Languages.rank' 		=> 'asc',
				//'Languages.created' 		=> 'desc',
				//'Languages.modified' 	=> 'desc',
			];
		}else{
			if($this->request->getQuery('sort') === null && $this->request->getQuery('direction') === null){
				$this->paginate['order'] = [
					// If not in URL-ben, then come from sessinon...
					$this->paging['Languages']['sort'] => $this->paging['Languages']['direction']	
				];
			}
		}

		if($this->request->getQuery('page') === null && !isset($this->paging['Languages']['page']) ){
			$this->paginate['page'] = 1;
		}else{
			$this->paginate['page'] = (isset($this->paging['Languages']['page'])) ? $this->paging['Languages']['page'] : 1;
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
						//	'page'		=> $this->paging['Languages']['page'], 	// Vagy 1
						//	'sort'		=> $this->paging['Languages']['sort'], 
						//	'direction'	=> $this->paging['Languages']['direction'],
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
			//$this->paginate['conditions'] = ['Languages.name LIKE' => $q ];
			$this->paginate['conditions'][] = [
				'OR' => [
					['Languages.name LIKE' => $search['s'] ],
					//['Languages.title LIKE' => $search['s'] ], // ... just add more fields
				],[
					'Languages.version_id' 		=> $this->version_id,
				]
			];
			
		}
		// -- /.Filter --
		
		try {
			$languages = $this->paginate($this->Languages);
		} catch (NotFoundException $e) {
			$paging = $this->request->getAttribute('paging');
			if($paging['Languages']['prevPage'] !== null && $paging['Languages']['prevPage']){
				if($paging['Languages']['page'] !== null && $paging['Languages']['page'] > 0){
					return $this->redirect([
						'controller' => $this->controller, 
						'action' => 'index', 
						'?' => [
							'page'		=> 1,	//$this->paging['Languages']['page'],
							'sort'		=> $this->paging['Languages']['sort'],
							'direction'	=> $this->paging['Languages']['direction'],
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
		$this->set(compact('languages'));
		
	}


    /**
     * View method
     *
     * @param string|null $id Language id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		if( !isset($this->version_id) ){
			$this->Flash->error(__('Please choose version!'));
			return $this->redirect( ['controller' => 'Versions', 'action' => 'index'] );
		}

		$this->set('title', __('Language'));
		
        $language = $this->Languages->get($id, [
            //'contain' => ['Programs' => ['conditions' => ['Programs.version_id' =>$this->version_id]]],
            'contain' => ['Programs' => ['PackagesProgramsAnalogs' => ['Packages'], 'PackagesProgramsDigitals' => ['Packages'], 'conditions' => ['Programs.version_id' =>$this->version_id]]],
        ]);
		
		//debug($language->toArray()); die();

		$this->session->write('Layout.' . $this->controller . '.LastId', $id);

		$name = $language->name;

        $this->set(compact('language', 'id', 'name'));
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

		$this->set('title', __('Language'));
        $language = $this->Languages->newEmptyEntity();
		$language->version_id  = $this->version_id;
        if ($this->request->is('post')) {
            $language = $this->Languages->patchEntity($language, $this->request->getData());
			$language->version_id = $this->version_id;
            if ($this->Languages->save($language)) {
                //$this->Flash->success(__('The language has been saved.'));
                $this->Flash->success(__('Has been saved.'));

				$this->session->write('Layout.' . $this->controller . '.LastId', $language->id);
	
                //return $this->redirect(['action' => 'index']);
                return $this->redirect([
					'controller' => $this->controller, 
					'action' => 'index', 
					'?' => [
						'page'		=> 1,
						'sort'		=> 'id',
						'direction'	=> 'desc',
					],
					'#' => $language->id	// Az állandó header miatt takarásban van még. Majd...
				]);

                return $this->redirect(['action' => 'index']);
            }
            //$this->Flash->error(__('The language could not be saved. Please, try again.'));
			$this->Flash->error(__('Could not be saved. Please, try again.'));
        }
        $this->set(compact('language'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Language id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
		if( !isset($this->version_id) ){
			$this->Flash->error(__('Please choose version!'));
			return $this->redirect( ['controller' => 'Versions', 'action' => 'index'] );
		}

		$this->set('title', __('Language'));
        $language = $this->Languages->get($id, [
            'contain' => [],
        ]);

		$this->session->write('Layout.' . $this->controller . '.LastId', $id);

        if ($this->request->is(['patch', 'post', 'put'])) {
			//debug($this->request->getData()); //die();
            $language = $this->Languages->patchEntity($language, $this->request->getData());
            //debug($language); //die();
			if ($this->Languages->save($language)) {
                //$this->Flash->success(__('The language has been saved.'));
                $this->Flash->success(__('Has been saved.'));
				
                
				//return $this->redirect(['action' => 'index']);
                return $this->redirect([
					'controller' => $this->controller, 
					'action' => 'index', 
					'?' => [
						'page'		=> (isset($this->paging['Languages']['page'])) ? $this->paging['Languages']['page'] : 1, 		// or 1
						'sort'		=> (isset($this->paging['Languages']['sort'])) ? $this->paging['Languages']['sort'] : 'created', 
						'direction'	=> (isset($this->paging['Languages']['direction'])) ? $this->paging['Languages']['direction'] : 'desc',
					],
					'#' => $id
				]);
				
            }
            //$this->Flash->error(__('The language could not be saved. Please, try again.'));
            $this->Flash->error(__('Could not be saved. Please, try again.'));
        }

		$name = $language->name;

        $this->set(compact('language', 'id', 'name'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Language id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $language = $this->Languages->get($id);
		if($language->program_count == 0){
			if ($this->Languages->delete($language)) {
				//$this->Flash->success(__('The language has been deleted.'));
				$this->Flash->success(__('Has been deleted.'));
			} else {
				//$this->Flash->error(__('The language could not be deleted. Please, try again.'));
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
				'page'		=> $this->paging['Languages']['page'], 
				'sort'		=> $this->paging['Languages']['sort'], 
				'direction'	=> $this->paging['Languages']['direction'],
			]
		]);
		
    }

}

