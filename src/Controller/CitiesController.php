<?php
// Baked at 2021.10.27. 11:30:08
declare(strict_types=1);

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Helper\UrlHelper;

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

		$this->config['index_number_of_rows'] = 100;
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


###############################################################################################################################
###############################################################################################################################
###############################################################################################################################
###############################################################################################################################
###############################################################################################################################

	public function digitals($target='html', $city_id = null)
	{
		$print_city_name = true;
		if($city_id == null){
			$print_city_name = false;
			$city_id = 72;
		}
		
		//Configure::write('debug', false);
		
		$channels = null;
		
		$this->session->write('Layout.' . $this->controller . '.LastId', $city_id);
		
		if($target == 'html'){
			$this->viewBuilder()->setLayout('html');
			$this->viewBuilder()->setTemplatePath('Cities' . DS . 'pdf');	// Itt vannak a template-k, hogy egy fájlt kelljen módosítani, ha ...
		}
		if($target == 'pdf'){
			$this->viewBuilder()->enableAutoLayout(false); 
			$this->viewBuilder()->setClassName('CakePdf.Pdf');
		}
		

		$this->loadModel('Cities');
		$this->loadModel('Versions');
		$this->loadModel('PackagesProgramsDigitals');

		try {
			$city = $this->Cities->find('all', ['contain' => ['Headstations'], 'conditions' => ['Cities.id' => $city_id]])->first();
			if(empty($city)){
				$this->Flash->error(__('No city found.'));
				return $this->redirect($this->referer());
			}
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

		try {
			$version = $this->Versions->find('all', ['conditions' => ['Versions.headstation_id' => $city->headstation_id, 'Versions.current' => true, 'broadcast' => 'digital']])->first();
			if(empty($version)){
				$this->Flash->error(__('No active version found for city.'));
				return $this->redirect($this->referer());
			}
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

		$channels = $this->PackagesProgramsDigitals->find('all', [
			'contain' => [
				'Ackeys',
				'Packages' => ['Packagegroups'],
				'Programs' => ['Features', 'Languages']
			],
			'conditions' => [
				'PackagesProgramsDigitals.version_id' 	=> $version->id,
				'PackagesProgramsDigitals.to_delete' 	=> false,
				'PackagesProgramsDigitals.visible' 		=> true,
				'Packagegroups.id <= 3',	// Mini, Családi és a Bővített
			],
			'order' => [
				'PackagesProgramsDigitals.lcn' => 'asc',
			]
		
		]);

		$digitals = $this->PackagesProgramsDigitals->find('all', [
			'contain' => [
				'Ackeys',
				'Packages' => ['Packagegroups'],
				'Programs' => ['Features', 'Languages']
			],
			'conditions' => [
				'PackagesProgramsDigitals.version_id' 	=> $version->id,
				'PackagesProgramsDigitals.to_delete' 	=> false,
				'PackagesProgramsDigitals.visible' 		=> true,
				'Packagegroups.id > 3',			// Havidíjasok
			],
			'order' => [
				'Packages.pos' => 'asc',
				'PackagesProgramsDigitals.lcn' => 'asc',
			]
		
		]);
		
		
		//debug($digitals->toArray()); die();
		
		if($target == 'pdf'){
			$this->viewBuilder()->setOption(
				'pdfConfig',
				[
					'orientation' => 'portrait',
					'download' => true,
					'filename' => $city->name . '_' . date('Ymd_His') . '.pdf',

					'margin' => [
						'bottom' => 60,
						'left' => 60,
						'right' => 60,
						'top' => 60
					],
					
				]
			);
			//'templatepath' =>'asasa',
		}
		
		$print_image = $version->print_image;
		
		$this->set(compact('channels', 'digitals', 'city', 'print_city_name', 'print_image'));
		
		//return $this->redirect([
		//	'action' => 'index', 
		//	'#' => $city_id
		//]);
		
	}


    public function photo($filename = 'advertising.jpg')
    {
		
		header('Content-Type: image/jpg;');
		if(file_exists(Configure::read('UploadDir') . $filename)){
			$fh = fopen( Configure::read('UploadDir') . $filename, "r" );
			if ($fh) {
				while (($buffer = fgets($fh, 4096)) !== false) {
					echo $buffer;
				}
				fclose($fh);
			}
		}else{
			echo "error";
		}

	}

/*
	public function download($hash=Null) {
		Configure::write('debug', 0); //it will avoid any extra output		
		$this->autoRender = false;
		if(!$hash){
			$this->redirect('/');
		}
		$this->loadModel('Uploads');
		$file = $this->Uploads->find()->select(['id','ext','filename'])->where(['hash'=>$hash])->toArray();
		
		if(!$file[0]['id']){
			$this->redirect('/');
		}else{
			$id         = $file[0]['id'];
			$ext        = $file[0]['ext'];
			$filename   = str_replace(" ","_",$file[0]['filename']);
			
			$path       = WWW_ROOT.'files'.DS;
			$src_filename_with_path = $path.$id.'_'.$this->My->normalizeString($filename);
			
			header('Content-Type: multipart/mixed;');
			header('Content-Disposition: attachment; filename='.$filename);
			if(file_exists($src_filename_with_path)){
				$fh = fopen( $src_filename_with_path, "r" );
				if ($fh) {
					while (($buffer = fgets($fh, 4096)) !== false) {
						echo $buffer;
					}
					fclose($fh);
				}
			}
			die();	//Ez kell, mert az autoRender nem működik sajna...
		}
	}

*/
	
	
}
