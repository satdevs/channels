<?php
// Baked at 2021.10.28. 15:29:10
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;

/**
 * MulticastSources Controller
 *
 * @property \App\Model\Table\MulticastSourcesTable $MulticastSources
 * @method \App\Model\Entity\MulticastSource[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MulticastSourcesController extends AppController
{

    /**
     * Initialize controller
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
		$this->set('title', __('MulticastSources'));
		
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
		$multicastSources = null;
		
		$this->set('title', __('MulticastSources'));

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
            'contain' => ['Versions'],
			'conditions' => [
				'MulticastSources.version_id' 		=> $this->version_id,
				//'MulticastSources.visible' 		=> 1,
				//'MulticastSources.created >= ' 	=> new \DateTime('-10 days'),
				//'MulticastSources.modified >= '	=> new \DateTime('-10 days'),
			],
			/*
			// Nem tanácsos az order-t itt használni, mert pl az edit után az utolsó  ordert ugyan beálíltja, de
			// kiegészíti ezzel s így az utoljára mentett rekord nem lesz megtalálható az X-edik oldalon, mert az az elsőre kerül.
			// A felhasználó állítson be rendezettséget magának! Kivételes esetek persze lehetnek!
			*/
			'order' => [
				//'MulticastSources.id' 			=> 'desc',
				//'MulticastSources.name' 		=> 'asc',
				//'MulticastSources.visible' 		=> 'desc',
				//'MulticastSources.pos' 			=> 'desc',
				//'MulticastSources.rank' 		=> 'asc',
				//'MulticastSources.created' 		=> 'desc',
				//'MulticastSources.modified' 	=> 'desc',
			],
			'limit' => $this->config['index_number_of_rows'],
			'maxLimit' => $this->config['index_number_of_rows'],
			//'sortableFields' => ['id', 'name', 'created', '...'],
			//'paramType' => 'querystring',
			//'fields' => ['MulticastSources.id', 'MulticastSources.name', ...],
			//'finder' => 'published',
        ];

		//$this->paging = $this->session->read('Layout.' . $this->controller . '.Paging');

		if( $this->paging === null){
			$this->paginate['order'] = [
				//'MulticastSources.id' 			=> 'desc',
				//'MulticastSources.name' 		=> 'asc',
				//'MulticastSources.visible' 		=> 'desc',
				//'MulticastSources.pos' 			=> 'desc',
				//'MulticastSources.rank' 		=> 'asc',
				//'MulticastSources.created' 		=> 'desc',
				//'MulticastSources.modified' 	=> 'desc',
			];
		}else{
			if($this->request->getQuery('sort') === null && $this->request->getQuery('direction') === null){
				$this->paginate['order'] = [
					// If not in URL-ben, then come from sessinon...
					$this->paging['MulticastSources']['sort'] => $this->paging['MulticastSources']['direction']	
				];
			}
		}

		if($this->request->getQuery('page') === null && !isset($this->paging['MulticastSources']['page']) ){
			$this->paginate['page'] = 1;
		}else{
			$this->paginate['page'] = (isset($this->paging['MulticastSources']['page'])) ? $this->paging['MulticastSources']['page'] : 1;
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
						//	'page'		=> $this->paging['MulticastSources']['page'], 	// Vagy 1
						//	'sort'		=> $this->paging['MulticastSources']['sort'], 
						//	'direction'	=> $this->paging['MulticastSources']['direction'],
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
			//$this->paginate['conditions'] = ['MulticastSources.name LIKE' => $q ];
			$this->paginate['conditions'][] = [
				'OR' => [
					['MulticastSources.name LIKE' => $search['s'] ],
					//['MulticastSources.title LIKE' => $search['s'] ], // ... just add more fields
				],
				[
					'MulticastSources.version_id' 		=> $this->version_id,
				]
			];
			
		}
		// -- /.Filter --
		
		try {
			$multicastSources = $this->paginate($this->MulticastSources);
		} catch (NotFoundException $e) {
			$paging = $this->request->getAttribute('paging');
			if($paging['MulticastSources']['prevPage'] !== null && $paging['MulticastSources']['prevPage']){
				if($paging['MulticastSources']['page'] !== null && $paging['MulticastSources']['page'] > 0){
					return $this->redirect([
						'controller' => $this->controller, 
						'action' => 'index', 
						'?' => [
							'page'		=> 1,	//$this->paging['MulticastSources']['page'],
							'sort'		=> $this->paging['MulticastSources']['sort'],
							'direction'	=> $this->paging['MulticastSources']['direction'],
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
		$this->set(compact('multicastSources'));
		
	}


    /**
     * View method
     *
     * @param string|null $id Multicast Source id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		if( !isset($this->version_id) ){
			$this->Flash->error(__('Please choose version!'));
			return $this->redirect( ['controller' => 'Versions', 'action' => 'index'] );
		}

		$this->set('title', __('MulticastSource'));
		
        $multicastSource = $this->MulticastSources->get($id, [
            //'contain' => ['Versions', 'PackagesProgramsDigitals' => ['conditions' => ['PackagesProgramsDigitals.version_id' => $this->version_id]]],
            'contain' => ['Versions', 'Programs' => ['conditions' => ['Programs.version_id' => $this->version_id]]],
            //'contain' => ['Versions', 'Programs' =>['PackagesProgramsDigitals']],
        ]);

		$this->session->write('Layout.' . $this->controller . '.LastId', $id);

		$name = $multicastSource->name;

        $this->set(compact('multicastSource', 'id', 'name'));
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

		$this->set('title', __('MulticastSource'));
        $multicastSource = $this->MulticastSources->newEmptyEntity();
		$multicastSource->version_id = $this->version_id;
        if ($this->request->is('post')) {
            $multicastSource = $this->MulticastSources->patchEntity($multicastSource, $this->request->getData());
			$multicastSource->version_id = $this->version_id;
            if ($this->MulticastSources->save($multicastSource)) {
                //$this->Flash->success(__('The multicast source has been saved.'));
                $this->Flash->success(__('Has been saved.'));

				$this->session->write('Layout.' . $this->controller . '.LastId', $multicastSource->id);
	
                //return $this->redirect(['action' => 'index']);
                return $this->redirect([
					'controller' => $this->controller, 
					'action' => 'index', 
					'?' => [
						'page'		=> 1,
						'sort'		=> 'id',
						'direction'	=> 'desc',
					],
					'#' => $multicastSource->id	// Az állandó header miatt takarásban van még. Majd...
				]);

                return $this->redirect(['action' => 'index']);
            }
            //$this->Flash->error(__('The multicast source could not be saved. Please, try again.'));
			$this->Flash->error(__('Could not be saved. Please, try again.'));
        }
        //$versions = $this->MulticastSources->Versions->find('list', ['limit' => 200]);	// Original
		//$versions = $this->MulticastSources->Versions->find('list', ['limit' => 200, 'conditions'=>['Versions.visible' => 1], 'order'=>['Versions.pos' => 'asc', 'Versions.name' => 'asc']]);
		$versions = $this->MulticastSources->Versions->find('list', ['limit' => 200, 'order'=>['Versions.pos' => 'asc', 'Versions.name' => 'asc']]);
        $this->set(compact('multicastSource', 'versions'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Multicast Source id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
		if( !isset($this->version_id) ){
			$this->Flash->error(__('Please choose version!'));
			return $this->redirect( ['controller' => 'Versions', 'action' => 'index'] );
		}

		$this->set('title', __('MulticastSource'));
        $multicastSource = $this->MulticastSources->get($id, [
            'contain' => [],
        ]);
		
		$this->session->write('Layout.' . $this->controller . '.LastId', $id);
		
        if ($this->request->is(['patch', 'post', 'put'])) {
			//debug($this->request->getData()); //die();
            $multicastSource = $this->MulticastSources->patchEntity($multicastSource, $this->request->getData());
            //debug($multicastSource); //die();
			if ($this->MulticastSources->save($multicastSource)) {
                //$this->Flash->success(__('The multicast source has been saved.'));
                $this->Flash->success(__('Has been saved.'));
				
                
				//return $this->redirect(['action' => 'index']);
                return $this->redirect([
					'controller' => $this->controller, 
					'action' => 'index', 
					'?' => [
						'page'		=> (isset($this->paging['MulticastSources']['page'])) ? $this->paging['MulticastSources']['page'] : 1, 		// or 1
						'sort'		=> (isset($this->paging['MulticastSources']['sort'])) ? $this->paging['MulticastSources']['sort'] : 'created', 
						'direction'	=> (isset($this->paging['MulticastSources']['direction'])) ? $this->paging['MulticastSources']['direction'] : 'desc',
					],
					'#' => $id
				]);
				
            }
            //$this->Flash->error(__('The multicast source could not be saved. Please, try again.'));
            $this->Flash->error(__('Could not be saved. Please, try again.'));
        }
        //$versions = $this->MulticastSources->Versions->find('list', ['limit' => 200]);
		//$versions = $this->MulticastSources->Versions->find('list', ['limit' => 200, 'conditions'=>['Versions.visible' => 1], 'order'=>['Versions.pos' => 'asc', 'Versions.name' => 'asc']]);
		$versions = $this->MulticastSources->Versions->find('list', ['limit' => 200, 'order'=>['Versions.pos' => 'asc', 'Versions.name' => 'asc']]);

		$name = $multicastSource->name;

        $this->set(compact('multicastSource', 'versions', 'id', 'name'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Multicast Source id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $multicastSource = $this->MulticastSources->get($id);
		if($multicastSource->program_count == 0){
			if ($this->MulticastSources->delete($multicastSource)) {
				//$this->Flash->success(__('The multicast source has been deleted.'));
				$this->Flash->success(__('Has been deleted.'));
			} else {
				//$this->Flash->error(__('The multicast source could not be deleted. Please, try again.'));
				$this->Flash->error(__('Could not be deleted. Please, try again.'));
			}
		}else{
			$this->Flash->error(__("Could not be deleted. The source has it's programs."));
		}		

		return $this->redirect([
			'controller' => $this->controller, 
			'action' => 'index', 
			'?' => [
				'page'		=> $this->paging['MulticastSources']['page'], 
				'sort'		=> $this->paging['MulticastSources']['sort'], 
				'direction'	=> $this->paging['MulticastSources']['direction'],
			]
		]);
		
    }

}

