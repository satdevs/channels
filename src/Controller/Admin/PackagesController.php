<?php
// Baked at 2021.10.29. 11:22:47
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;

/**
 * Packages Controller
 *
 * @property \App\Model\Table\PackagesTable $Packages
 * @method \App\Model\Entity\Package[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PackagesController extends AppController
{

    /**
     * Initialize controller
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
		$this->set('title', __('Packages'));
		
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
		$packages = null;
		
		$this->set('title', __('Packages'));

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
            'contain' => ['Headstations', 'Packagegroups', 'Versions'],
			'conditions' => [
				'Packages.version_id' 		=> $this->version_id,
				//'Packages.name' 		=> 1,
				//'Packages.visible' 		=> 1,
				//'Packages.created >= ' 	=> new \DateTime('-10 days'),
				//'Packages.modified >= '	=> new \DateTime('-10 days'),
			],
			/*
			// Nem tanácsos az order-t itt használni, mert pl az edit után az utolsó  ordert ugyan beálíltja, de
			// kiegészíti ezzel s így az utoljára mentett rekord nem lesz megtalálható az X-edik oldalon, mert az az elsőre kerül.
			// A felhasználó állítson be rendezettséget magának! Kivételes esetek persze lehetnek!
			*/
			'order' => [
				//'Packages.id' 			=> 'desc',
				//'Packages.name' 		=> 'asc',
				//'Packages.visible' 		=> 'desc',
				//'Packages.pos' 			=> 'desc',
				//'Packages.rank' 		=> 'asc',
				//'Packages.created' 		=> 'desc',
				//'Packages.modified' 	=> 'desc',
			],
			'limit' => $this->config['index_number_of_rows'],
			'maxLimit' => $this->config['index_number_of_rows'],
			//'sortableFields' => ['id', 'name', 'created', '...'],
			//'paramType' => 'querystring',
			//'fields' => ['Packages.id', 'Packages.name', ...],
			//'finder' => 'published',
        ];

		//$this->paging = $this->session->read('Layout.' . $this->controller . '.Paging');

		if( $this->paging === null){
			$this->paginate['order'] = [
				//'Packages.id' 			=> 'desc',
				//'Packages.name' 		=> 'asc',
				//'Packages.visible' 		=> 'desc',
				//'Packages.pos' 			=> 'desc',
				//'Packages.rank' 		=> 'asc',
				//'Packages.created' 		=> 'desc',
				//'Packages.modified' 	=> 'desc',
			];
		}else{
			if($this->request->getQuery('sort') === null && $this->request->getQuery('direction') === null){
				$this->paginate['order'] = [
					// If not in URL-ben, then come from sessinon...
					$this->paging['Packages']['sort'] => $this->paging['Packages']['direction']	
				];
			}
		}

		if($this->request->getQuery('page') === null && !isset($this->paging['Packages']['page']) ){
			$this->paginate['page'] = 1;
		}else{
			$this->paginate['page'] = (isset($this->paging['Packages']['page'])) ? $this->paging['Packages']['page'] : 1;
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
						//	'page'		=> $this->paging['Packages']['page'], 	// Vagy 1
						//	'sort'		=> $this->paging['Packages']['sort'], 
						//	'direction'	=> $this->paging['Packages']['direction'],
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
			//$this->paginate['conditions'] = ['Packages.name LIKE' => $q ];
			$this->paginate['conditions'][] = [
				'OR' => [
					['Packages.name LIKE' => $search['s'] ],
					['Packages.broadcast LIKE' => $search['s'] ],
					//['Packages.broadcast LIKE' => $this->broadcasts[$search['s']] ],
					//['Packages.title LIKE' => $search['s'] ], // ... just add more fields
				],
				[
					'Packages.version_id' 		=> $this->version_id,
				]
			];
			
		}
		// -- /.Filter --
		
		//debug($this->paginate); die();
		
		try {
			$packages = $this->paginate($this->Packages);
		} catch (NotFoundException $e) {
			$paging = $this->request->getAttribute('paging');
			if($paging['Packages']['prevPage'] !== null && $paging['Packages']['prevPage']){
				if($paging['Packages']['page'] !== null && $paging['Packages']['page'] > 0){
					return $this->redirect([
						'controller' => $this->controller, 
						'action' => 'index', 
						'?' => [
							'page'		=> 1,	//$this->paging['Packages']['page'],
							'sort'		=> $this->paging['Packages']['sort'],
							'direction'	=> $this->paging['Packages']['direction'],
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
		$this->set(compact('packages'));
		
	}


    /**
     * View method
     *
     * @param string|null $id Package id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		if( !isset($this->version_id) ){
			$this->Flash->error(__('Please choose version!'));
			return $this->redirect( ['controller' => 'Versions', 'action' => 'index'] );
		}

		$this->set('title', __('Package'));
		
        $package = $this->Packages->get($id, [
            'contain' => [
				'Headstations', 
				'Packagegroups', 
				'Programs', 
				'PackagesProgramsAnalogs' => [
					'sort' => [
						'PackagesProgramsAnalogs.lcn' => 'asc'
					], 'Bands', 
					'Programs'
				],
				'PackagesProgramsDigitals' => [
					'Programs' => ['MulticastSources']
				], 
				'Versions'
			],
        ]);

		//debug($package->toArray()); die();

		$this->session->write('Layout.' . $this->controller . '.LastId', $id);

		$name = $package->name;

        $this->set(compact('package', 'id', 'name'));
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

		$this->set('title', __('Package'));
        $package = $this->Packages->newEmptyEntity();
        if ($this->request->is('post')) {
            $package = $this->Packages->patchEntity($package, $this->request->getData());
			$package->version_id 	 = $this->version_id;
			$package->headstation_id = $this->headstation_id;			
			//debug($package); die();
            if ($this->Packages->save($package)) {
                //$this->Flash->success(__('The package has been saved.'));
                $this->Flash->success(__('Has been saved.'));

				$this->session->write('Layout.' . $this->controller . '.LastId', $package->id);
	
                //return $this->redirect(['action' => 'index']);
                return $this->redirect([
					'controller' => $this->controller, 
					'action' => 'index', 
					'?' => [
						'page'		=> 1,
						'sort'		=> 'id',
						'direction'	=> 'desc',
					],
					'#' => $package->id	// Az állandó header miatt takarásban van még. Majd...
				]);

                return $this->redirect(['action' => 'index']);
            }
            //$this->Flash->error(__('The package could not be saved. Please, try again.'));
			$this->Flash->error(__('Could not be saved. Please, try again.'));
        }
		$headstations = $this->Packages->Headstations->find('list', ['limit' => 200, 'order'=>['Headstations.pos' => 'asc', 'Headstations.name' => 'asc']]);
		$packagegroups = $this->Packages->Packagegroups->find('list', ['limit' => 200, 'order'=>['Packagegroups.pos' => 'asc', 'Packagegroups.name' => 'asc']]);
		$programs = $this->Packages->Programs->find('list', ['limit' => 200, 'conditions' => ['Programs.version_id' => $this->version_id], 'order'=>['Programs.pos' => 'asc', 'Programs.name' => 'asc']]);
        $this->set(compact('headstations', 'package', 'packagegroups', 'programs'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Package id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
		if( !isset($this->version_id) ){
			$this->Flash->error(__('Please choose version!'));
			return $this->redirect( ['controller' => 'Versions', 'action' => 'index'] );
		}

		$this->set('title', __('Package'));
        $package = $this->Packages->get($id, [
            'contain' => ['Packagegroups', 'Programs'],
        ]);
				
		$this->session->write('Layout.' . $this->controller . '.LastId', $id);
		
        if ($this->request->is(['patch', 'post', 'put'])) {
			//debug($this->request->getData()); //die();
            $package = $this->Packages->patchEntity($package, $this->request->getData());
            //debug($package); //die();
			if ($this->Packages->save($package)) {
                //$this->Flash->success(__('The package has been saved.'));
                $this->Flash->success(__('Has been saved.'));
                
				//return $this->redirect(['action' => 'index']);
                return $this->redirect([
					'controller' => $this->controller, 
					'action' => 'index', 
					'?' => [
						'page'		=> (isset($this->paging['Packages']['page'])) ? $this->paging['Packages']['page'] : 1, 		// or 1
						'sort'		=> (isset($this->paging['Packages']['sort'])) ? $this->paging['Packages']['sort'] : 'created', 
						'direction'	=> (isset($this->paging['Packages']['direction'])) ? $this->paging['Packages']['direction'] : 'desc',
					],
					'#' => $id
				]);
				
            }
            //$this->Flash->error(__('The package could not be saved. Please, try again.'));
            $this->Flash->error(__('Could not be saved. Please, try again.'));
        }
		$headstations = $this->Packages->Headstations->find('list', ['limit' => 200, 'order'=>['Headstations.pos' => 'asc', 'Headstations.name' => 'asc']]);
		$packagegroups = $this->Packages->Packagegroups->find('list', ['limit' => 200, 'order'=>['Packagegroups.pos' => 'asc', 'Packagegroups.name' => 'asc']]);
		$programs = $this->Packages->Programs->find('list', ['limit' => 200, 'conditions' => ['Programs.version_id' => $this->version_id], 'order'=>['Programs.pos' => 'asc', 'Programs.name' => 'asc']]);

		$name = $package->name;

        $this->set(compact('package', 'packagegroups', 'headstations', 'programs', 'id', 'name'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Package id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $package = $this->Packages->get($id);
		//if($package->packages_programs_analog_count == 0 && $package->packages_programs_digital_count == 0){
			if ($this->Packages->delete($package)) {
				//$this->Flash->success(__('The package has been deleted.'));
				$this->Flash->success(__('Has been deleted.'));
				
				/*
				Azért nem a modelben van a kaszkádiolt törlés, mert az analóg és a digitális tábla két tábla
				és nem kell az alaptábla tartalom összeállításánál mindkettőből törölni.
				
				*/
				if($package->broadcast == 'analog'){
					$this->Flash->info(__('Analogs has been deleted.'));
					$this->loadModel('PackagesProgramsAnalogs');
					$this->PackagesProgramsAnalogs->deleteAll(['PackagesProgramsAnalogs.package_id' => $id]);
				}
				if($package->broadcast == 'digital'){
					$this->Flash->info(__('Digitals has been deleted.'));
					$this->loadModel('PackagesProgramsDigitals');
					$this->PackagesProgramsDigitals->deleteAll(['PackagesProgramsDigitals.package_id' => $id]);
				}				
			} else {
				//$this->Flash->error(__('The package could not be deleted. Please, try again.'));
				$this->Flash->error(__('Could not be deleted. Please, try again.'));
			}
		//}else{
		//	$this->Flash->error(__("Could not be deleted. The source has it's analog program(s) or digital program(s)."));
		//}


        //return $this->redirect(['action' => 'index']);
		return $this->redirect([
			'controller' => $this->controller, 
			'action' => 'index', 
			'?' => [
				'page'		=> $this->paging['Packages']['page'], 
				'sort'		=> $this->paging['Packages']['sort'], 
				'direction'	=> $this->paging['Packages']['direction'],
			]
		]);
		
    }

}

