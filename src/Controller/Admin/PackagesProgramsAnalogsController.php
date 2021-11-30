<?php
// Baked at 2021.10.28. 15:29:10
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;

/**
 * PackagesProgramsAnalogs Controller
 *
 * @property \App\Model\Table\PackagesProgramsAnalogsTable $PackagesProgramsAnalogs
 * @method \App\Model\Entity\PackagesProgramsAnalog[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PackagesProgramsAnalogsController extends AppController
{

    /**
     * Initialize controller
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
		$this->set('title', __('PackagesProgramsAnalogs'));
		
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
		$packagesProgramsAnalogs = null;
		
		$this->set('title', __('PackagesProgramsAnalogs'));

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
            'contain' => ['Versions', 'Packages', 'Programs', 'Bands'],
			'conditions' => [
				'PackagesProgramsAnalogs.version_id' 		=> $this->version_id,
				//'PackagesProgramsAnalogs.visible' 		=> 1,
				//'PackagesProgramsAnalogs.created >= ' 	=> new \DateTime('-10 days'),
				//'PackagesProgramsAnalogs.modified >= '	=> new \DateTime('-10 days'),
			],
			/*
			// Nem tanácsos az order-t itt használni, mert pl az edit után az utolsó  ordert ugyan beálíltja, de
			// kiegészíti ezzel s így az utoljára mentett rekord nem lesz megtalálható az X-edik oldalon, mert az az elsőre kerül.
			// A felhasználó állítson be rendezettséget magának! Kivételes esetek persze lehetnek!
			*/
			'order' => [
				//'PackagesProgramsAnalogs.id' 			=> 'desc',
				//'PackagesProgramsAnalogs.name' 		=> 'asc',
				//'PackagesProgramsAnalogs.visible' 		=> 'desc',
				//'PackagesProgramsAnalogs.pos' 			=> 'desc',
				//'PackagesProgramsAnalogs.rank' 		=> 'asc',
				//'PackagesProgramsAnalogs.created' 		=> 'desc',
				//'PackagesProgramsAnalogs.modified' 	=> 'desc',
			],
			'limit' => $this->config['index_number_of_rows'],
			'maxLimit' => $this->config['index_number_of_rows'],
			//'sortableFields' => ['id', 'name', 'created', '...'],
			//'paramType' => 'querystring',
			//'fields' => ['PackagesProgramsAnalogs.id', 'PackagesProgramsAnalogs.name', ...],
			//'finder' => 'published',
        ];

		//$this->paging = $this->session->read('Layout.' . $this->controller . '.Paging');

		if( $this->paging === null){
			$this->paginate['order'] = [
				//'PackagesProgramsAnalogs.id' 			=> 'desc',
				//'PackagesProgramsAnalogs.name' 		=> 'asc',
				//'PackagesProgramsAnalogs.visible' 		=> 'desc',
				//'PackagesProgramsAnalogs.pos' 			=> 'desc',
				//'PackagesProgramsAnalogs.rank' 		=> 'asc',
				//'PackagesProgramsAnalogs.created' 		=> 'desc',
				//'PackagesProgramsAnalogs.modified' 	=> 'desc',
			];
		}else{
			if($this->request->getQuery('sort') === null && $this->request->getQuery('direction') === null){
				$this->paginate['order'] = [
					// If not in URL-ben, then come from sessinon...
					$this->paging['PackagesProgramsAnalogs']['sort'] => $this->paging['PackagesProgramsAnalogs']['direction']	
				];
			}
		}

		if($this->request->getQuery('page') === null && !isset($this->paging['PackagesProgramsAnalogs']['page']) ){
			$this->paginate['page'] = 1;
		}else{
			$this->paginate['page'] = (isset($this->paging['PackagesProgramsAnalogs']['page'])) ? $this->paging['PackagesProgramsAnalogs']['page'] : 1;
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
						//	'page'		=> $this->paging['PackagesProgramsAnalogs']['page'], 	// Vagy 1
						//	'sort'		=> $this->paging['PackagesProgramsAnalogs']['sort'], 
						//	'direction'	=> $this->paging['PackagesProgramsAnalogs']['direction'],
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
			//$this->paginate['conditions'] = ['PackagesProgramsAnalogs.name LIKE' => $q ];
			$this->paginate['conditions'][] = [
				'OR' => [
					['PackagesProgramsAnalogs.name LIKE' => $search['s'] ],
					//['PackagesProgramsAnalogs.title LIKE' => $search['s'] ], // ... just add more fields
				],
				[
					'PackagesProgramsAnalogs.version_id' 		=> $this->version_id,
				]
			];
			
		}
		// -- /.Filter --
		
		try {
			$packagesProgramsAnalogs = $this->paginate($this->PackagesProgramsAnalogs);
		} catch (NotFoundException $e) {
			$paging = $this->request->getAttribute('paging');
			if($paging['PackagesProgramsAnalogs']['prevPage'] !== null && $paging['PackagesProgramsAnalogs']['prevPage']){
				if($paging['PackagesProgramsAnalogs']['page'] !== null && $paging['PackagesProgramsAnalogs']['page'] > 0){
					return $this->redirect([
						'controller' => $this->controller, 
						'action' => 'index', 
						'?' => [
							'page'		=> 1,	//$this->paging['PackagesProgramsAnalogs']['page'],
							'sort'		=> $this->paging['PackagesProgramsAnalogs']['sort'],
							'direction'	=> $this->paging['PackagesProgramsAnalogs']['direction'],
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
		$this->set(compact('packagesProgramsAnalogs'));
		
	}


    /**
     * View method
     *
     * @param string|null $id Packages Programs Analog id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		if( !isset($this->version_id) ){
			$this->Flash->error(__('Please choose version!'));
			return $this->redirect( ['controller' => 'Versions', 'action' => 'index'] );
		}

		$this->set('title', __('PackagesProgramsAnalog'));
		
        $packagesProgramsAnalog = $this->PackagesProgramsAnalogs->get($id, [
            'contain' => ['Versions', 'Packages', 'Programs', 'Bands'],
        ]);

		$this->session->write('Layout.' . $this->controller . '.LastId', $id);

		$name = $packagesProgramsAnalog->name;

        $this->set(compact('packagesProgramsAnalog', 'id', 'name'));
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

		$this->set('title', __('PackagesProgramsAnalog'));
        $packagesProgramsAnalog = $this->PackagesProgramsAnalogs->newEmptyEntity();
        if ($this->request->is('post')) {
            $packagesProgramsAnalog = $this->PackagesProgramsAnalogs->patchEntity($packagesProgramsAnalog, $this->request->getData());
			$packagesProgramsAnalog->version_id = $this->version_id;
            if ($this->PackagesProgramsAnalogs->save($packagesProgramsAnalog)) {
                //$this->Flash->success(__('The packages programs analog has been saved.'));
                $this->Flash->success(__('Has been saved.'));

				$this->session->write('Layout.' . $this->controller . '.LastId', $packagesProgramsAnalog->id);
	
                //return $this->redirect(['action' => 'index']);
                return $this->redirect([
					'controller' => $this->controller, 
					'action' => 'index', 
					'?' => [
						'page'		=> 1,
						'sort'		=> 'id',
						'direction'	=> 'desc',
					],
					'#' => $packagesProgramsAnalog->id	// Az állandó header miatt takarásban van még. Majd...
				]);

                return $this->redirect(['action' => 'index']);
            }
            //$this->Flash->error(__('The packages programs analog could not be saved. Please, try again.'));
			$this->Flash->error(__('Could not be saved. Please, try again.'));
        }
		$packages = $this->PackagesProgramsAnalogs->Packages->find('list', ['limit' => 1000, 'conditions'=>['Packages.visible' => 1, 'Packages.version_id' => $this->version_id], 'order'=>['Packages.pos' => 'asc', 'Packages.name' => 'asc']]);
		$programs = $this->PackagesProgramsAnalogs->Programs->find('list', ['limit' => 1000, 'conditions'=>['Programs.visible' => 1, 'Programs.version_id' => $this->version_id], 'order'=>['Programs.pos' => 'asc', 'Programs.name' => 'asc']]);
		$bands = $this->PackagesProgramsAnalogs->Bands->find('list', ['limit' => 1000, 'conditions'=>['Bands.visible' => 1], 'order'=>['Bands.pos' => 'asc', 'Bands.name' => 'asc']]);
		$this->set(compact('packagesProgramsAnalog', 'packages', 'programs', 'bands'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Packages Programs Analog id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
		if( !isset($this->version_id) ){
			$this->Flash->error(__('Please choose version!'));
			return $this->redirect( ['controller' => 'Versions', 'action' => 'index'] );
		}

		$this->set('title', __('PackagesProgramsAnalog'));
        $packagesProgramsAnalog = $this->PackagesProgramsAnalogs->get($id, [
            'contain' => [],
        ]);
		
		$this->session->write('Layout.' . $this->controller . '.LastId', $id);
		
        if ($this->request->is(['patch', 'post', 'put'])) {
			//debug($this->request->getData()); //die();
            $packagesProgramsAnalog = $this->PackagesProgramsAnalogs->patchEntity($packagesProgramsAnalog, $this->request->getData());
            //debug($packagesProgramsAnalog); //die();
			if ($this->PackagesProgramsAnalogs->save($packagesProgramsAnalog)) {
                //$this->Flash->success(__('The packages programs analog has been saved.'));
                $this->Flash->success(__('Has been saved.'));
				
                
				//return $this->redirect(['action' => 'index']);
                return $this->redirect([
					'controller' => $this->controller, 
					'action' => 'index', 
					'?' => [
						'page'		=> (isset($this->paging['PackagesProgramsAnalogs']['page'])) ? $this->paging['PackagesProgramsAnalogs']['page'] : 1, 		// or 1
						'sort'		=> (isset($this->paging['PackagesProgramsAnalogs']['sort'])) ? $this->paging['PackagesProgramsAnalogs']['sort'] : 'created', 
						'direction'	=> (isset($this->paging['PackagesProgramsAnalogs']['direction'])) ? $this->paging['PackagesProgramsAnalogs']['direction'] : 'desc',
					],
					'#' => $id
				]);
				
            }
            //$this->Flash->error(__('The packages programs analog could not be saved. Please, try again.'));
            $this->Flash->error(__('Could not be saved. Please, try again.'));
        }
		$packages = $this->PackagesProgramsAnalogs->Packages->find('list', ['limit' => 1000, 'conditions'=>['Packages.visible' => 1, 'Packages.version_id' => $this->version_id], 'order'=>['Packages.pos' => 'asc', 'Packages.name' => 'asc']]);
		$programs = $this->PackagesProgramsAnalogs->Programs->find('list', ['limit' => 1000, 'conditions'=>['Programs.visible' => 1, 'Programs.version_id' => $this->version_id], 'order'=>['Programs.pos' => 'asc', 'Programs.name' => 'asc']]);
		$bands = $this->PackagesProgramsAnalogs->Bands->find('list', ['limit' => 1000, 'conditions'=>['Bands.visible' => 1], 'order'=>['Bands.pos' => 'asc', 'Bands.name' => 'asc']]);

		$name = $packagesProgramsAnalog->name;

        $this->set(compact('packagesProgramsAnalog', 'packages', 'programs', 'bands', 'id', 'name'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Packages Programs Analog id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $packagesProgramsAnalog = $this->PackagesProgramsAnalogs->get($id);

		if ($this->PackagesProgramsAnalogs->delete($packagesProgramsAnalog)) {
			//$this->Flash->success(__('The packages programs analog has been deleted.'));
			$this->Flash->success(__('Has been deleted.'));
		} else {
			//$this->Flash->error(__('The packages programs analog could not be deleted. Please, try again.'));
			$this->Flash->error(__('Could not be deleted. Please, try again.'));
		}

        //return $this->redirect(['action' => 'index']);
		return $this->redirect([
			'controller' => $this->controller, 
			'action' => 'index', 
			'?' => [
				'page'		=> $this->paging['PackagesProgramsAnalogs']['page'], 
				'sort'		=> $this->paging['PackagesProgramsAnalogs']['sort'], 
				'direction'	=> $this->paging['PackagesProgramsAnalogs']['direction'],
			]
		]);
		
    }

}

