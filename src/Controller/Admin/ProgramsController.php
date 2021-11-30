<?php
// Baked at 2021.10.29. 11:22:35
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;

/**
 * Programs Controller
 *
 * @property \App\Model\Table\ProgramsTable $Programs
 * @method \App\Model\Entity\Program[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProgramsController extends AppController
{

    /**
     * Initialize controller
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
		$this->set('title', __('Programs'));
		
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
		$programs = null;
		
		$this->set('title', __('Programs'));

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
            'contain' => ['Versions', 'Features', 'Languages', 'MulticastSources', 
				'PackagesProgramsAnalogs' => [
					'Packages' => [
						'conditions' => [
							'PackagesProgramsAnalogs.version_id' => $this->version_id,
							'Packages.version_id' => $this->version_id,
						],
					]
				],
				'PackagesProgramsDigitals' => [
					'Packages' => [
						'conditions' => [
							'PackagesProgramsDigitals.version_id' => $this->version_id,
							'Packages.version_id' => $this->version_id,
						],
					],				
					//'conditions' => ['PackagesProgramsDigitals.version_id' => $this->version_id]]
				]
			],
			'conditions' => [
				'Programs.version_id' 		=> $this->version_id,
				//'Programs.visible' 		=> 1,
				//'Programs.created >= ' 	=> new \DateTime('-10 days'),
				//'Programs.modified >= '	=> new \DateTime('-10 days'),
			],
			/*
			// Nem tanácsos az order-t itt használni, mert pl az edit után az utolsó  ordert ugyan beálíltja, de
			// kiegészíti ezzel s így az utoljára mentett rekord nem lesz megtalálható az X-edik oldalon, mert az az elsőre kerül.
			// A felhasználó állítson be rendezettséget magának! Kivételes esetek persze lehetnek!
			*/
			'order' => [
				//'Programs.id' 			=> 'desc',
				//'Programs.name' 		=> 'asc',
				//'Programs.visible' 		=> 'desc',
				//'Programs.pos' 			=> 'desc',
				//'Programs.rank' 		=> 'asc',
				//'Programs.created' 		=> 'desc',
				//'Programs.modified' 	=> 'desc',
			],
			'limit' => $this->config['index_number_of_rows'],
			'maxLimit' => $this->config['index_number_of_rows'],
			//'sortableFields' => ['id', 'name', 'created', '...'],
			//'paramType' => 'querystring',
			//'fields' => ['Programs.id', 'Programs.name', ...],
			//'finder' => 'published',
        ];

		//$this->paging = $this->session->read('Layout.' . $this->controller . '.Paging');

		if( $this->paging === null){
			$this->paginate['order'] = [
				//'Programs.id' 			=> 'desc',
				//'Programs.name' 		=> 'asc',
				//'Programs.visible' 		=> 'desc',
				//'Programs.pos' 			=> 'desc',
				//'Programs.rank' 		=> 'asc',
				//'Programs.created' 		=> 'desc',
				//'Programs.modified' 	=> 'desc',
			];
		}else{
			if($this->request->getQuery('sort') === null && $this->request->getQuery('direction') === null){
				$this->paginate['order'] = [
					// If not in URL-ben, then come from sessinon...
					$this->paging['Programs']['sort'] => $this->paging['Programs']['direction']	
				];
			}
		}

		if($this->request->getQuery('page') === null && !isset($this->paging['Programs']['page']) ){
			$this->paginate['page'] = 1;
		}else{
			$this->paginate['page'] = (isset($this->paging['Programs']['page'])) ? $this->paging['Programs']['page'] : 1;
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
						//	'page'		=> $this->paging['Programs']['page'], 	// Vagy 1
						//	'sort'		=> $this->paging['Programs']['sort'], 
						//	'direction'	=> $this->paging['Programs']['direction'],
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
			//$this->paginate['conditions'] = ['Programs.name LIKE' => $q ];
			$this->paginate['conditions'][] = [
				'OR' => [
					['Programs.name LIKE' => $search['s'] ],
					['Languages.name LIKE' => $search['s'] ],
					['Features.name LIKE' => $search['s'] ],
					//['Package.name LIKE' => $search['s'] ],
					//['Programs.title LIKE' => $search['s'] ], // ... just add more fields
				],
				[
					'Programs.version_id' 		=> $this->version_id,
				]
			];
			
		}
		// -- /.Filter --
		
		try {
			$programs = $this->paginate($this->Programs);
		} catch (NotFoundException $e) {
			$paging = $this->request->getAttribute('paging');
			if($paging['Programs']['prevPage'] !== null && $paging['Programs']['prevPage']){
				if($paging['Programs']['page'] !== null && $paging['Programs']['page'] > 0){
					return $this->redirect([
						'controller' => $this->controller, 
						'action' => 'index', 
						'?' => [
							'page'		=> 1,	//$this->paging['Programs']['page'],
							'sort'		=> $this->paging['Programs']['sort'],
							'direction'	=> $this->paging['Programs']['direction'],
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
		$this->set(compact('programs'));
		
	}


    /**
     * View method
     *
     * @param string|null $id Program id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		if( !isset($this->version_id) ){
			$this->Flash->error(__('Please choose version!'));
			return $this->redirect( ['controller' => 'Versions', 'action' => 'index'] );
		}

		$this->set('title', __('Program'));
		
        $program = $this->Programs->get($id, [
            'contain' => [
				'Versions', 'Features', 'Languages', 'MulticastSources', 
				'Packages' => [
					//'conditions' => ['Packages.version_id' => $this->version]
				], 
				'PackagesProgramsAnalogs' => [
					//'conditions' => ['PackagesProgramsAnalogs.version_id' => $this->version]
				], 
				'PackagesProgramsDigitals' => [
					'conditions' => [
						'PackagesProgramsDigitals.to_delete' 	=> false,
						'PackagesProgramsDigitals.visible' 		=> true,
					]
					//'conditions' => ['PackagesProgramsDigitals.version_id' => $this->version]
				]
			],
        ]);
		
		//debug($program->toArray()); die();

		$this->session->write('Layout.' . $this->controller . '.LastId', $id);

		$name = $program->name;

        $this->set(compact('program', 'id', 'name'));
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

		$this->set('title', __('Program'));
        $program = $this->Programs->newEmptyEntity();
        if ($this->request->is('post')) {
            $program = $this->Programs->patchEntity($program, $this->request->getData());
			$program->version_id = $this->version_id;
            if ($this->Programs->save($program)) {
                //$this->Flash->success(__('The program has been saved.'));
                $this->Flash->success(__('Has been saved.'));

				$this->session->write('Layout.' . $this->controller . '.LastId', $program->id);
	
                //return $this->redirect(['action' => 'index']);
                return $this->redirect([
					'controller' => $this->controller, 
					'action' => 'index', 
					'?' => [
						'page'		=> 1,
						'sort'		=> 'id',
						'direction'	=> 'desc',
					],
					'#' => $program->id	// Az állandó header miatt takarásban van még. Majd...
				]);

                return $this->redirect(['action' => 'index']);
            }
            //$this->Flash->error(__('The program could not be saved. Please, try again.'));
			$this->Flash->error(__('Could not be saved. Please, try again.'));
        }
		$features = $this->Programs->Features->find('list', ['limit' => 1000, 'conditions'=>['Features.visible' => true, 'Features.version_id' => $this->version_id], 'order'=>['Features.pos' => 'asc', 'Features.name' => 'asc']]);
		$languages = $this->Programs->Languages->find('list', ['limit' => 1000, 'conditions'=>['Languages.visible' => true, 'Languages.version_id' => $this->version_id], 'order'=>['Languages.pos' => 'asc', 'Languages.name' => 'asc']]);
		$packages = $this->Programs->Packages->find('list', ['limit' => 1000, 'conditions'=>['Packages.visible' => true, 'Packages.version_id' => $this->version_id], 'order'=>['Packages.pos' => 'asc', 'Packages.name' => 'asc']]);
		$multicastSources = $this->Programs->MulticastSources->find('list', ['limit' => 1000, 'conditions' => ['MulticastSources.version_id' => $this->version_id, 'MulticastSources.visible' => true], 'order'=>['MulticastSources.pos' => 'asc', 'MulticastSources.name' => 'asc']]);
        $this->set(compact('program', 'features', 'languages', 'multicastSources', 'packages'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Program id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
		if( !isset($this->version_id) ){
			$this->Flash->error(__('Please choose version!'));
			return $this->redirect( ['controller' => 'Versions', 'action' => 'index'] );
		}

		$this->set('title', __('Program'));
        $program = $this->Programs->get($id, [
            'contain' => ['Packages', 'MulticastSources'],
        ]);
		
		$this->session->write('Layout.' . $this->controller . '.LastId', $id);
				
        if ($this->request->is(['patch', 'post', 'put'])) {
			//debug($this->request->getData()); //die();
            $program = $this->Programs->patchEntity($program, $this->request->getData());
            //debug($program); //die();
			if ($this->Programs->save($program)) {
                //$this->Flash->success(__('The program has been saved.'));
                $this->Flash->success(__('Has been saved.'));
				
                
				//return $this->redirect(['action' => 'index']);
                return $this->redirect([
					'controller' => $this->controller, 
					'action' => 'index', 
					'?' => [
						'page'		=> (isset($this->paging['Programs']['page'])) ? $this->paging['Programs']['page'] : 1, 		// or 1
						'sort'		=> (isset($this->paging['Programs']['sort'])) ? $this->paging['Programs']['sort'] : 'created', 
						'direction'	=> (isset($this->paging['Programs']['direction'])) ? $this->paging['Programs']['direction'] : 'desc',
					],
					'#' => $id
				]);
				
            }
            //$this->Flash->error(__('The program could not be saved. Please, try again.'));
            $this->Flash->error(__('Could not be saved. Please, try again.'));
        }
		$features = $this->Programs->Features->find('list', ['limit' => 1000, 'conditions'=>['Features.visible' => true, 'Features.version_id' => $this->version_id], 'order'=>['Features.pos' => 'asc', 'Features.name' => 'asc']]);
		$languages = $this->Programs->Languages->find('list', ['limit' => 1000, 'conditions'=>['Languages.visible' => true, 'Languages.version_id' => $this->version_id], 'order'=>['Languages.pos' => 'asc', 'Languages.name' => 'asc']]);
		$packages = $this->Programs->Packages->find('list', ['limit' => 1000, 'conditions'=>['Packages.visible' => true, 'Packages.version_id' => $this->version_id], 'order'=>['Packages.pos' => 'asc', 'Packages.name' => 'asc']]);
		$multicastSources = $this->Programs->MulticastSources->find('list', ['limit' => 1000, 'conditions' => ['MulticastSources.version_id' => $this->version_id, 'MulticastSources.visible' => true], 'order'=>['MulticastSources.pos' => 'asc', 'MulticastSources.name' => 'asc']]);

		$name = $program->name;

        $this->set(compact('program', 'features', 'languages', 'multicastSources', 'packages', 'id', 'name'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Program id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $program = $this->Programs->get($id);
		//if($program->package_count == 0 && $program->packages_programs_analog_count == 0 && $program->packages_programs_digital_count == 0){
		//if($program->packages_programs_analog_count == 0 && $program->packages_programs_digital_count == 0){
			if ($this->Programs->delete($program)) {
				//$this->Flash->success(__('The program has been deleted.'));
				$this->Flash->success(__('Has been deleted.'));
			} else {
				//$this->Flash->error(__('The program could not be deleted. Please, try again.'));
				$this->Flash->error(__('Could not be deleted. Please, try again.'));
			}
		//}else{
		//	$this->Flash->error(__("Could not be deleted. The source has it's analog package(s) or digital package(s)."));
		//}

        //return $this->redirect(['action' => 'index']);
		return $this->redirect([
			'controller' => $this->controller, 
			'action' => 'index', 
			'?' => [
				'page'		=> $this->paging['Programs']['page'], 
				'sort'		=> $this->paging['Programs']['sort'], 
				'direction'	=> $this->paging['Programs']['direction'],
			]
		]);
		
    }


    public function del()
	{
		$this->Flash->error(__('Out of order ;-)!'));
		return $this->redirect( ['controller' => 'Programs', 'action' => 'index'] );
		die('xXx');
		
		$programs = $this->Programs->find('all',[
            'contain' => ['Versions', 'Features', 'Languages', 'MulticastSources', 
				'PackagesProgramsAnalogs' => [
					'Packages' => [
						'conditions' => [
							'PackagesProgramsAnalogs.version_id' => $this->version_id,
							'Packages.version_id' => $this->version_id,
						],
					]
				],
				'PackagesProgramsDigitals' => [
					'Packages' => [
						'conditions' => [
							'PackagesProgramsDigitals.version_id' => $this->version_id,
							'Packages.version_id' => $this->version_id,
						],
					],				
					//'conditions' => ['PackagesProgramsDigitals.version_id' => $this->version_id]]
				]
			],
			'conditions' => [
				'Programs.version_id' 		=> $this->version_id,
				//'Programs.visible' 		=> 1,
				//'Programs.created >= ' 	=> new \DateTime('-10 days'),
				//'Programs.modified >= '	=> new \DateTime('-10 days'),
			],
		]);
		
		foreach($programs as $program){
			//echo "<br>";
			
			if(count($program->packages_programs_analogs) == 0 && count($program->packages_programs_digitals) == 0){
				echo count($program->packages_programs_digitals);
				echo " -- ";
				echo count($program->packages_programs_analogs);
				echo " -- ";

				echo $program->id;
				echo "<br>";
				
				//$d = $this->Programs->get($program->id);
				//$this->Programs->delete($d);
				
			}
			
			//debug($program->toArray());
		}
		die();		
	}

}

