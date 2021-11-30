<?php
// Baked at 2021.10.28. 15:29:10
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;

use Cake\Validation\Validator;

/**
 * PackagesProgramsDigitals Controller
 *
 * @property \App\Model\Table\PackagesProgramsDigitalsTable $PackagesProgramsDigitals
 * @method \App\Model\Entity\PackagesProgramsDigital[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PackagesProgramsDigitalsController extends AppController
{

    /**
     * Initialize controller
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
		$this->set('title', __('PackagesProgramsDigitals'));
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
		$packagesProgramsDigitals = null;
		
		$this->set('title', __('PackagesProgramsDigitals'));

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
            'contain' => ['Versions', 'Packages', 'Programs', 'Ackeys'],
            //'contain' => ['Versions', 'Packages', 'Programs'],
			'conditions' => [
				'PackagesProgramsDigitals.version_id' 		=> $this->version_id,
				//'PackagesProgramsDigitals.visible' 		=> 1,
				//'PackagesProgramsDigitals.created >= ' 	=> new \DateTime('-10 days'),
				//'PackagesProgramsDigitals.modified >= '	=> new \DateTime('-10 days'),
			],
			/*
			// Nem tanácsos az order-t itt használni, mert pl az edit után az utolsó  ordert ugyan beálíltja, de
			// kiegészíti ezzel s így az utoljára mentett rekord nem lesz megtalálható az X-edik oldalon, mert az az elsőre kerül.
			// A felhasználó állítson be rendezettséget magának! Kivételes esetek persze lehetnek!
			*/
			'order' => [
				//'PackagesProgramsDigitals.id' 			=> 'desc',
				//'PackagesProgramsDigitals.name' 		=> 'asc',
				//'PackagesProgramsDigitals.visible' 		=> 'desc',
				//'PackagesProgramsDigitals.pos' 			=> 'desc',
				//'PackagesProgramsDigitals.rank' 		=> 'asc',
				//'PackagesProgramsDigitals.created' 		=> 'desc',
				//'PackagesProgramsDigitals.modified' 	=> 'desc',
			],
			'limit' => $this->config['index_number_of_rows'],
			'maxLimit' => $this->config['index_number_of_rows'],
			//'sortableFields' => ['id', 'name', 'created', '...'],
			//'paramType' => 'querystring',
			//'fields' => ['PackagesProgramsDigitals.id', 'PackagesProgramsDigitals.name', ...],
			//'finder' => 'published',
        ];

		//$this->paging = $this->session->read('Layout.' . $this->controller . '.Paging');

		if( $this->paging === null){
			$this->paginate['order'] = [
				//'PackagesProgramsDigitals.id' 			=> 'desc',
				//'PackagesProgramsDigitals.name' 		=> 'asc',
				//'PackagesProgramsDigitals.visible' 		=> 'desc',
				//'PackagesProgramsDigitals.pos' 			=> 'desc',
				//'PackagesProgramsDigitals.rank' 		=> 'asc',
				//'PackagesProgramsDigitals.created' 		=> 'desc',
				//'PackagesProgramsDigitals.modified' 	=> 'desc',
			];
		}else{
			if($this->request->getQuery('sort') === null && $this->request->getQuery('direction') === null){
				$this->paginate['order'] = [
					// If not in URL-ben, then come from sessinon...
					$this->paging['PackagesProgramsDigitals']['sort'] => $this->paging['PackagesProgramsDigitals']['direction']	
				];
			}
		}

		if($this->request->getQuery('page') === null && !isset($this->paging['PackagesProgramsDigitals']['page']) ){
			$this->paginate['page'] = 1;
		}else{
			$this->paginate['page'] = (isset($this->paging['PackagesProgramsDigitals']['page'])) ? $this->paging['PackagesProgramsDigitals']['page'] : 1;
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
						//	'page'		=> $this->paging['PackagesProgramsDigitals']['page'], 	// Vagy 1
						//	'sort'		=> $this->paging['PackagesProgramsDigitals']['sort'], 
						//	'direction'	=> $this->paging['PackagesProgramsDigitals']['direction'],
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
			//$this->paginate['conditions'] = ['PackagesProgramsDigitals.name LIKE' => $q ];
			$this->paginate['conditions'][] = [
				'OR' => [
					['PackagesProgramsDigitals.id' => (integer) $search['s'] ],
					['PackagesProgramsDigitals.program_id' => (integer) $search['s'] ],
					['PackagesProgramsDigitals.package_id' => (integer) $search['s'] ],
					['PackagesProgramsDigitals.name LIKE' => $search['s'] ],
					['Programs.name LIKE' => $search['s'] ],
					//['PackagesProgramsDigitals.title LIKE' => $search['s'] ], // ... just add more fields
				],
				[
					'PackagesProgramsDigitals.version_id' 		=> $this->version_id,
				]
			];
			
		}
		// -- /.Filter --
		
		try {
			$packagesProgramsDigitals = $this->paginate($this->PackagesProgramsDigitals);
		} catch (NotFoundException $e) {
			$paging = $this->request->getAttribute('paging');
			if($paging['PackagesProgramsDigitals']['prevPage'] !== null && $paging['PackagesProgramsDigitals']['prevPage']){
				if($paging['PackagesProgramsDigitals']['page'] !== null && $paging['PackagesProgramsDigitals']['page'] > 0){
					return $this->redirect([
						'controller' => $this->controller, 
						'action' => 'index', 
						'?' => [
							'page'		=> 1,	//$this->paging['PackagesProgramsDigitals']['page'],
							'sort'		=> $this->paging['PackagesProgramsDigitals']['sort'],
							'direction'	=> $this->paging['PackagesProgramsDigitals']['direction'],
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
		$this->set(compact('packagesProgramsDigitals'));
		
	}


    /**
     * View method
     *
     * @param string|null $id Packages Programs Digital id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		if( !isset($this->version_id) ){
			$this->Flash->error(__('Please choose version!'));
			return $this->redirect( ['controller' => 'Versions', 'action' => 'index'] );
		}

		$this->set('title', __('PackagesProgramsDigital'));
		
        $packagesProgramsDigital = $this->PackagesProgramsDigitals->get($id, [
            'contain' => ['Versions', 'Packages', 'Programs' => ['MulticastSources'], 'Ackeys'],
        ]);

		$this->session->write('Layout.' . $this->controller . '.LastId', $id);

		$name = $packagesProgramsDigital->name;

        $this->set(compact('packagesProgramsDigital', 'id', 'name'));
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

		$this->set('title', __('PackagesProgramsDigital'));
        $packagesProgramsDigital = $this->PackagesProgramsDigitals->newEmptyEntity();
        if ($this->request->is('post')) {
            $packagesProgramsDigital = $this->PackagesProgramsDigitals->patchEntity($packagesProgramsDigital, $this->request->getData());
			$packagesProgramsDigital->version_id = $this->version_id;
			//debug($packagesProgramsDigital->getErrors()); die();			
            if ($this->PackagesProgramsDigitals->save($packagesProgramsDigital)) {
                //$this->Flash->success(__('The packages programs digital has been saved.'));
                $this->Flash->success(__('Has been saved.'));

				$this->session->write('Layout.' . $this->controller . '.LastId', $packagesProgramsDigital->id);
	
                //return $this->redirect(['action' => 'index']);
                return $this->redirect([
					'controller' => $this->controller, 
					'action' => 'index', 
					'?' => [
						'page'		=> 1,
						'sort'		=> 'id',
						'direction'	=> 'desc',
					],
					'#' => $packagesProgramsDigital->id	// Az állandó header miatt takarásban van még. Majd...
				]);

                return $this->redirect(['action' => 'index']);
            }
            //$this->Flash->error(__('The packages programs digital could not be saved. Please, try again.'));
			$this->Flash->error(__('Could not be saved. Please, try again.'));
        }
		$packages = $this->PackagesProgramsDigitals->Packages->find('list', ['limit' => 1000, 'conditions' => ['Packages.visible' => 1, 'Packages.version_id' => $this->version_id], 'order'=>['Packages.pos' => 'asc', 'Packages.name' => 'asc']]);
		$programs = $this->PackagesProgramsDigitals->Programs->find('list', ['limit' => 1000, 'conditions' => ['Programs.visible' => 1, 'Programs.version_id' => $this->version_id], 'order'=>['Programs.pos' => 'asc', 'Programs.name' => 'asc']]);
		$ackeys = $this->PackagesProgramsDigitals->Ackeys->find('list', ['limit' => 1000, 'conditions'=>['Ackeys.visible' => 1], 'order'=>['Ackeys.pos' => 'asc', 'Ackeys.name' => 'asc']]);
        $this->set(compact('packagesProgramsDigital', 'packages', 'programs', 'ackeys'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Packages Programs Digital id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
		if( !isset($this->version_id) ){
			$this->Flash->error(__('Please choose version!'));
			return $this->redirect( ['controller' => 'Versions', 'action' => 'index'] );
		}

		$this->set('title', __('PackagesProgramsDigital'));
        $packagesProgramsDigital = $this->PackagesProgramsDigitals->get($id, [
            'contain' => [],
        ]);
		
		$this->session->write('Layout.' . $this->controller . '.LastId', $id);
				
        if ($this->request->is(['patch', 'post', 'put'])) {
			//debug($this->request->getData()); //die();
            $packagesProgramsDigital = $this->PackagesProgramsDigitals->patchEntity($packagesProgramsDigital, $this->request->getData());
            //debug($packagesProgramsDigital); 
			//debug($packagesProgramsDigital->getErrors()); die();
			if ($this->PackagesProgramsDigitals->save($packagesProgramsDigital)) {
                //$this->Flash->success(__('The packages programs digital has been saved.'));
                $this->Flash->success(__('Has been saved.'));
				
                
				//return $this->redirect(['action' => 'index']);
                return $this->redirect([
					'controller' => $this->controller, 
					'action' => 'index', 
					'?' => [
						'page'		=> (isset($this->paging['PackagesProgramsDigitals']['page'])) ? $this->paging['PackagesProgramsDigitals']['page'] : 1, 		// or 1
						'sort'		=> (isset($this->paging['PackagesProgramsDigitals']['sort'])) ? $this->paging['PackagesProgramsDigitals']['sort'] : 'created', 
						'direction'	=> (isset($this->paging['PackagesProgramsDigitals']['direction'])) ? $this->paging['PackagesProgramsDigitals']['direction'] : 'desc',
					],
					'#' => $id
				]);
				
            }
            //$this->Flash->error(__('The packages programs digital could not be saved. Please, try again.'));
            $this->Flash->error(__('Could not be saved. Please, try again.'));
        }
		$packages = $this->PackagesProgramsDigitals->Packages->find('list', ['limit' => 1000, 'conditions' => ['Packages.visible' => 1, 'Packages.version_id' => $this->version_id], 'order'=>['Packages.pos' => 'asc', 'Packages.name' => 'asc']]);
		$programs = $this->PackagesProgramsDigitals->Programs->find('list', ['limit' => 1000, 'conditions' => ['Programs.visible' => 1, 'Programs.version_id' => $this->version_id], 'order'=>['Programs.pos' => 'asc', 'Programs.name' => 'asc']]);
		$ackeys = $this->PackagesProgramsDigitals->Ackeys->find('list', ['limit' => 1000, 'conditions'=>['Ackeys.visible' => 1], 'order'=>['Ackeys.pos' => 'asc', 'Ackeys.name' => 'asc']]);

		$name = $packagesProgramsDigital->name;

        $this->set(compact('packagesProgramsDigital', 'packages', 'programs', 'ackeys', 'id', 'name'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Packages Programs Digital id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $packagesProgramsDigital = $this->PackagesProgramsDigitals->get($id);
        if ($this->PackagesProgramsDigitals->delete($packagesProgramsDigital)) {
            //$this->Flash->success(__('The packages programs digital has been deleted.'));
            $this->Flash->success(__('Has been deleted.'));
        } else {
            //$this->Flash->error(__('The packages programs digital could not be deleted. Please, try again.'));
            $this->Flash->error(__('Could not be deleted. Please, try again.'));
        }

        //return $this->redirect(['action' => 'index']);
		return $this->redirect([
			'controller' => $this->controller, 
			'action' => 'index', 
			'?' => [
				'page'		=> $this->paging['PackagesProgramsDigitals']['page'], 
				'sort'		=> $this->paging['PackagesProgramsDigitals']['sort'], 
				'direction'	=> $this->paging['PackagesProgramsDigitals']['direction'],
			]
		]);
		
    }

}

