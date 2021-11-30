<?php
// Baked at 2021.10.28. 15:29:10
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;
use Cake\ORM\Locator\LocatorAwareTrait;
use Cake\Validation\Validator;
use Cake\Log\Engine\FileLog;
use Cake\Log\Log;

/**
 * Versions Controller
 *
 * @property \App\Model\Table\VersionsTable $Versions
 * @method \App\Model\Entity\Version[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VersionsController extends AppController
{

    /**
     * Initialize controller
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
		$this->set('title', __('Versions'));

		Log::setConfig('check', [
			'className' => FileLog::class,
			'path' => LOGS,
			'levels' => ['info', 'debug'],
			'file' => 'clone',
		]);		
		
	}

	// nincs használva, mert később került ide. Az ellenőrző fg()-nél marad a loggolás ahogy van.
	public function mylog($message = null, $level = 'info')
	{
		if($message == null){
			return false;
		}
		
		Log::write($level, $message, 'check');
		
		return true;
	}
	
	
	public function add()
	{		
		// TESZT
		//$this->mylog('Valami D', 'debug');
		//$this->mylog('Valami I', 'info');
		//die();
		
		$this->set('title', __('Version'));
        $version = $this->Versions->newEmptyEntity();
        if ($this->request->is('post')) {
            $version = $this->Versions->patchEntity($version, $this->request->getData());
			$version->current = false;			// Az új automatán ne legyen current
			$source_id = $version->version_id;	// Old ID

			$src_version = $this->Versions->get($source_id);
			$version->broadcast = $src_version->broadcast;
			
			// ----------------------------- Konzisztencia ellenőrzés --------------------------
			$consistency = $this->consistencyCheck($source_id);
			if($consistency != 0){
				echo "<center>";
				echo "<h1>Az adott verzió inkonzisztens, nem klónozható!</h1>";
				echo "<p align='center'>Nézze át a <b>clone.log</b> fáljt!</p>";
				echo "Hibák száma: <b>" . $consistency . "</b><br>";
				echo "Az adott verzió nem klónozható, mert az adatbázis nem konzisztens!";
				echo "</center>";
				die('----------------------------------');
			}
			// ----------------------------- /.Konzisztencia ellenőrzés ------------------------
			
			//debug($version->getErrors()); die();
			
            if ($this->Versions->save($version)) {
				
				//debug($version->toArray()); die();
				
				// #############################################################################
				// ## BEGIN CLONE ## BEGIN CLONE ## BEGIN CLONE ## BEGIN CLONE ## BEGIN CLONE ##
				// #############################################################################

				Log::write('info', '####################################################################################');
				Log::write('info', '################# START CLONE ######################################################');
				Log::write('info', '####################################################################################');
				Log::write('info', '');

				$this->loadModel('Trackings');	// Véltozások követése az ID-k miatt

				// ------------------- MulticastSources ---------------------
				$this->loadModel('MulticastSources');
				$count = 0;
				$error = 0;
				$records = $this->MulticastSources->find('all', ['conditions' => ['MulticastSources.version_id' => $source_id]]);
				foreach($records as $record){
					$old_id = $record->id;
					unset($record->id);
					unset($record->created);
					unset($record->modified);
					$record->version_id = $version->id;
					$new = $record->toArray();
					$newRecord = $this->MulticastSources->newEmptyEntity();
					$newRecord = $this->MulticastSources->patchEntity($newRecord, $new);

					if(!$newRecord->getErrors()){
						//Log::write('info', 'PackagesProgramsDigitals clone test #id: ' . $record->id . " - OK");
						if ($this->MulticastSources->save($newRecord)) {
							$count++;
							
							//------------------- Nyomkövetés ---------------------
							$newTrack = ['name' => 'MulticastSource.id', 'version_id' => $version->id, 'old_id' => $old_id, 'new_id' => $newRecord->id];
							$newTrackRecord = $this->Trackings->newEmptyEntity();
							$newTrackRecord = $this->Trackings->patchEntity($newTrackRecord, $newTrack);
							$this->Trackings->save($newTrackRecord);
							//----------------- /.Nyomkövetés ---------------------
							
						}else{
							$error++;
						}

					}else{
						$error++;
						Log::write('info', 'MulticastSources validation: ' . print_r($newRecord->getErrors(), true));
						Log::write('info', 'MulticastSources new: ' . print_r($new, true));
						Log::write('info', '------------------------------------------------------------------------------------');
					}

					$new = [];
				}
				$this->Flash->success($count . " " . __("multicast source") . " " . __('has been saved.'));
				if($error >0){
					$this->Flash->error($error . " " . __("multicast source") . " " . __('could not be saved.'));
				}
				// ----------------- /.MulticastSources ---------------------


				// ------------------- Features ---------------------
				$this->loadModel('Features');
				$count = 0;
				$error = 0;
				$records = $this->Features->find('all', ['conditions' => ['Features.version_id' => $source_id]]);
				foreach($records as $record){
					$old_id = $record->id;
					unset($record->id);
					unset($record->created);
					unset($record->modified);
					$record->version_id = $version->id;
					$new = $record->toArray();
					$newRecord = $this->Features->newEmptyEntity();
					$newRecord = $this->Features->patchEntity($newRecord, $new);

					if(!$newRecord->getErrors()){
						//Log::write('info', 'PackagesProgramsDigitals clone test #id: ' . $record->id . " - OK");

						if ($this->Features->save($newRecord)) {
							$count++;

							//------------------- Nyomkövetés ---------------------
							$newTrack = ['name' => 'Feature.id', 'version_id' => $version->id, 'old_id' => $old_id, 'new_id' => $newRecord->id];
							$newTrackRecord = $this->Trackings->newEmptyEntity();
							$newTrackRecord = $this->Trackings->patchEntity($newTrackRecord, $newTrack);
							$this->Trackings->save($newTrackRecord);
							//----------------- /.Nyomkövetés ---------------------

						}else{
							$error++;
						}

					}else{
						$error++;
						Log::write('info', 'Features validation: ' . print_r($newRecord->getErrors(), true));
						Log::write('info', 'Features new: ' . print_r($new, true));
						Log::write('info', '------------------------------------------------------------------------------------');
					}

					$new = [];
				}
				$this->Flash->success($count . " " . __("feature") . " " . __('has been saved.'));
				if($error >0){
					$this->Flash->error($error . " " . __("feature") . " " . __('could not be saved.'));
				}
				// ----------------- /.Features ---------------------


				// ------------------- Languages ---------------------
				$this->loadModel('Languages');
				$count = 0;
				$error = 0;
				$records = $this->Languages->find('all', ['conditions' => ['Languages.version_id' => $source_id]]);
				foreach($records as $record){
					$old_id = $record->id;
					unset($record->id);
					unset($record->created);
					unset($record->modified);
					$record->version_id = $version->id;
					$new = $record->toArray();
					$newRecord = $this->Languages->newEmptyEntity();
					$newRecord = $this->Languages->patchEntity($newRecord, $new);

					if(!$newRecord->getErrors()){
						//Log::write('info', 'PackagesProgramsDigitals clone test #id: ' . $record->id . " - OK");

						if ($this->Languages->save($newRecord)) {
							$count++;
							//------------------- Nyomkövetés ---------------------
							$newTrack = ['name' => 'Language.id', 'version_id' => $version->id, 'old_id' => $old_id, 'new_id' => $newRecord->id];
							$newTrackRecord = $this->Trackings->newEmptyEntity();
							$newTrackRecord = $this->Trackings->patchEntity($newTrackRecord, $newTrack);
							$this->Trackings->save($newTrackRecord);
							//----------------- /.Nyomkövetés ---------------------

						}else{
							$error++;
						}

					}else{
						$error++;
						Log::write('info', 'Languages validation: ' . print_r($newRecord->getErrors(), true));
						Log::write('info', 'Languages new: ' . print_r($new, true));
						Log::write('info', '------------------------------------------------------------------------------------');
					}

					$new = [];
				}
				$this->Flash->success($count . " " . __("language") . " " . __('has been saved.'));
				if($error >0){
					$this->Flash->error($error . " " . __("language") . " " . __('could not be saved.'));
				}
				// ----------------- /.Languages ---------------------

				// ------------------- Packages ---------------------
				$this->loadModel('Packages');
				$count = 0;
				$error = 0;
				$records = $this->Packages->find('all', ['conditions' => ['Packages.version_id' => $source_id]]);
				foreach($records as $record){
					$old_id = $record->id;
					unset($record->id);
					unset($record->created);
					unset($record->modified);
					$record->version_id = $version->id;
					$new = $record->toArray();
					$newRecord = $this->Packages->newEmptyEntity();
					$newRecord = $this->Packages->patchEntity($newRecord, $new);
					
					if(!$newRecord->getErrors()){
						//Log::write('info', 'PackagesProgramsDigitals clone test #id: ' . $record->id . " - OK");

						if ($this->Packages->save($newRecord)) {
							$count++;
							//------------------- Nyomkövetés ---------------------
							$newTrack = ['name' => 'Package.id', 'version_id' => $version->id, 'old_id' => $old_id, 'new_id' => $newRecord->id];
							$newTrackRecord = $this->Trackings->newEmptyEntity();
							$newTrackRecord = $this->Trackings->patchEntity($newTrackRecord, $newTrack);
							$this->Trackings->save($newTrackRecord);
							//----------------- /.Nyomkövetés ---------------------

						}else{
							$error++;
						}

					}else{
						$error++;
						Log::write('info', 'Packages validation: ' . print_r($newRecord->getErrors(), true));
						Log::write('info', 'Packages new: ' . print_r($new, true));
						Log::write('info', '------------------------------------------------------------------------------------');
					}
					
					$new = [];
				}
				$this->Flash->success($count . " " . __("package") . " " . __('has been saved.'));
				if($error >0){
					$this->Flash->error($error . " " . __("package") . " " . __('could not be saved.'));
				}
				// ----------------- /.Packages ---------------------


				// ------------------- Programs ---------------------
				$this->loadModel('Programs');
				$count = 0;
				$error = 0;
				$records = $this->Programs->find('all', ['conditions' => ['Programs.version_id' => $source_id], 'order' => ['id' => 'asc']]);
				
				// https://book.cakephp.org/4/en/core-libraries/validation.html
				
				foreach($records as $record){
					$old_id = $record->id;
					unset($record->id);
					unset($record->created);
					unset($record->modified);
					$record->version_id = $version->id;

					//------------ Új multicast forrás id beállítása -----------
					$track = $this->Trackings->find('all', [
						'conditions' => [
							'name' => 'MulticastSource.id', 
							'version_id' => $version->id, 
							'old_id' => $record->multicast_source_id
						]
					])->first();
					$record->multicast_source_id = $track->new_id;

					//------------ Új multicast forrás id beállítása -----------
					$track = $this->Trackings->find('all', [
						'conditions' => [
							'name' => 'Feature.id', 
							'version_id' => $version->id, 
							'old_id' => $record->feature_id
						]
					])->first();
					$record->feature_id = $track->new_id;

					//------------ Új multicast forrás id beállítása -----------
					$track = $this->Trackings->find('all', [
						'conditions' => [
							'name' => 'Language.id', 
							'version_id' => $version->id, 
							'old_id' => $record->language_id
						]
					])->first();
					$record->language_id = $track->new_id;

					$new = $record->toArray();
					
					$newRecord = $this->Programs->newEmptyEntity();
					$newRecord = $this->Programs->patchEntity($newRecord, $new);

					if(!$newRecord->getErrors()){
						//Log::write('info', 'PackagesProgramsDigitals clone test #id: ' . $record->id . " - OK");

						if ($this->Programs->save($newRecord)) {
							$count++;
							//------------------- Nyomkövetés ---------------------
							$newTrack = ['name' => 'Program.id', 'version_id' => $version->id, 'old_id' => $old_id, 'new_id' => $newRecord->id];
							$newTrackRecord = $this->Trackings->newEmptyEntity();
							$newTrackRecord = $this->Trackings->patchEntity($newTrackRecord, $newTrack);
							$this->Trackings->save($newTrackRecord);
							//----------------- /.Nyomkövetés ---------------------
						}else{
							$error++;
						}

					}else{
						$error++;
						Log::write('info', 'Programs validation: ' . print_r($newRecord->getErrors(), true));
						Log::write('info', 'Programs new: ' . print_r($new, true));
						Log::write('info', '------------------------------------------------------------------------------------');
					}
					
					$new = [];
				}
				$this->Flash->success($count . " " . __("program") . " " . __('has been saved.'));
				if($error >0){
					$this->Flash->error($error . " " . __("program") . " " . __('could not be saved.'));
				}
				// ----------------- /.Programs ---------------------


				// ------------------- PackagesProgramsAnalogs ---------------------
				$this->loadModel('PackagesProgramsAnalogs');
				$count = 0;
				$error = 0;
				$records = $this->PackagesProgramsAnalogs->find('all', ['conditions' => ['PackagesProgramsAnalogs.version_id' => $source_id], 'order' => ['id' => 'asc']]);
				
				foreach($records as $record){
					unset($record->id);
					unset($record->created);
					unset($record->modified);
					$record->version_id = $version->id;

					//------------ Új csomag id beállítása -----------
					$track = $this->Trackings->find('all', [
						'conditions' => [
							'name' => 'Package.id', 
							'version_id' => $version->id, 
							'old_id' => $record->package_id
						]
					])->first();
					$record->package_id = $track->new_id;

					//------------ Új műsor id beállítása -----------
					$track = $this->Trackings->find('all', [
						'conditions' => [
							'name' => 'Program.id', 
							'version_id' => $version->id, 
							'old_id' => $record->program_id
						]
					])->first();
					$record->program_id = $track->new_id;

					$new = $record->toArray();
					$newRecord = $this->PackagesProgramsAnalogs->newEmptyEntity();
					$newRecord = $this->PackagesProgramsAnalogs->patchEntity($newRecord, $new);

					if(!$newRecord->getErrors()){
						//Log::write('info', 'PackagesProgramsDigitals clone test #id: ' . $record->id . " - OK");

						if ($this->PackagesProgramsAnalogs->save($newRecord)) {
							$count++;
						}else{
							$error++;
						}

					}else{
						$error++;
						Log::write('info', 'PackagesProgramsAnalogs validation: ' . print_r($newRecord->getErrors(), true));
						Log::write('info', 'PackagesProgramsAnalogs new: ' . print_r($new, true));
						Log::write('info', '------------------------------------------------------------------------------------');
					}

					$new = [];
				}
				$this->Flash->success($count . " " . __("analog package program") . " " . __('has been saved.'));
				if($error >0){
					$this->Flash->error($error . " " . __("analog package program") . " " . __('could not be saved.'));
				}
				// ----------------- /.PackagesProgramsAnalogs ---------------------

				// ------------------- PackagesProgramsDigitals ---------------------
				$this->loadModel('PackagesProgramsDigitals');
				$count = 0;
				$error = 0;
				$records = $this->PackagesProgramsDigitals->find('all', ['conditions' => ['PackagesProgramsDigitals.version_id' => $source_id]]);
				foreach($records as $record){
					unset($record->id);
					unset($record->created);
					unset($record->modified);
					$record->version_id = $version->id;
					
					//------------ Új csomag id beállítása -----------
					$track = $this->Trackings->find('all', [
						'conditions' => [
							'name' => 'Package.id', 
							'version_id' => $version->id, 
							'old_id' => $record->package_id
						]
					])->first();
					$record->package_id = $track->new_id;

					//------------ Új műsor id beállítása -----------
					$track = $this->Trackings->find('all', [
						'conditions' => [
							'name' => 'Program.id', 
							'version_id' => $version->id, 
							'old_id' => $record->program_id
						]
					])->first();
					$record->program_id = $track->new_id;					
					
					$new = $record->toArray();
					$newRecord = $this->PackagesProgramsDigitals->newEmptyEntity();
					$newRecord = $this->PackagesProgramsDigitals->patchEntity($newRecord, $new);

					if(!$newRecord->getErrors()){
						//Log::write('info', 'PackagesProgramsDigitals clone test #id: ' . $record->id . " - OK");

						if ($this->PackagesProgramsDigitals->save($newRecord)) {
							$count++;
						}else{
							$error++;
							Log::write('info', 'PackagesProgramsDigitals validation 1: ' . print_r($newRecord->getErrors(), true));
							Log::write('info', 'PackagesProgramsDigitals new 1: ' . print_r($new, true));
							Log::write('info', '------------------------------------------------------------------------------------');
						}

					}else{
						$error++;
						Log::write('info', 'PackagesProgramsDigitals validation 2: ' . print_r($newRecord->getErrors(), true));
						Log::write('info', 'PackagesProgramsDigitals new 2: ' . print_r($new, true));
						Log::write('info', '------------------------------------------------------------------------------------');
					}

					$new = [];
				}
				$this->Flash->success($count . " " . __("digital package program") . " " . __('has been saved.'));
				if($error >0){
					$this->Flash->error($error . " " . __("digital package program") . " " . __('could not be saved.'));
				}
				// ----------------- /.PackagesProgramsDigitals ---------------------

				Log::write('info', '####################################################################################');
				Log::write('info', '#################  END CLONE #######################################################');
				Log::write('info', '####################################################################################');
				Log::write('info', '');


				// ################################################################################
				// ## END CLONE ## END CLONE ## END CLONE ## END CLONE ## END CLONE ## END CLONE ##
				// ################################################################################

				$this->session->write('Layout.' . $this->controller . '.LastId', $version->id);

                return $this->redirect([
					'controller' => $this->controller, 
					'action' => 'index', 
					'?' => [
						'page'		=> 1,
						'sort'		=> 'id',
						'direction'	=> 'desc',
					],
					'#' => $version->id	// Az állandó header miatt takarásban van még. Majd...
				]);

				//$this->Trackings->deleteAll(['Trackings.version_id' => $version->id]);	// Ha kellene setleg, akkor mehet...

                return $this->redirect(['action' => 'index']);
            }	// Save
			//$this->Flash->error(__('Could not be saved. Please, try again.'));
			
        }
		
		$headstations = $this->Versions->Headstations->find('list', ['limit' => 1000, 'conditions'=>['Headstations.visible' => 1], 'order'=>['Headstations.pos' => 'asc', 'Headstations.created' => 'desc']]);
		$versions = $this->Versions->find('list', ['limit' => 1000, 'conditions'=>['Versions.visible' => 1], 'order'=>['Versions.pos' => 'asc', 'Versions.created' => 'desc']]);
        $this->set(compact('version', 'versions', 'headstations'));

	}


	public function setCurrentVersion($broadcast = null, $id = null, $headstation_id = null)
	{
		
		if($id == null || $headstation_id == null){
			$this->Flash->error(__('Wrong parameters'));
			$this->redirect( ['controller' => 'Versions', 'action' => 'index'] );
		}

		// Az össes current flag törlése az adott fejállomáson
		$this->Versions->query()->update()->set(['current' => false])->where(['broadcast' => $broadcast, 'current' => true, 'headstation_id' => $headstation_id])->execute();
		
		//Az aktuális current flag beállítása az ID szerint
		$this->Versions->query()->update()->set(['current' => true])->where(['id' => $id])->execute();

		$this->Flash->success(__('The current version has been set.'));
		return $this->redirect( ['controller' => 'Versions', 'action' => 'index'] );
	
	}
	
	public function setVersionToSession($id = null)
	{
		if($id == null){
			$this->Flash->warning(__('Please select version.'));
			$this->redirect( ['controller' => 'Versions', 'action' => 'index'] );
		}
		
		$version = $this->Versions->get($id, [ 'contain' => ['Headstations'] ]);
		
		$this->session->write('version_id', $version->id);
		//$this->session->write('version_name', '<span style="color: yellow;">[' . $version->headstation->name . ': ' . $version->name .']</span>&nbsp;');
		$this->session->write('version_name', '<span style="font-weight: bold;">' . $version->headstation->name . '</span>: ' . $version->name .'');
		$this->session->write('headstation_id', $version->headstation_id) ;
		return $this->redirect( ['controller' => 'Versions', 'action' => 'index'] );
		
	}

	public function consistencyCheck($version_id = null)
	{
		if($version_id == null){
			return -1;
		}
		
		$count = 0;
		$error = 0;
		
		$this->set('title', __('Version'));
        $version = $this->Versions->newEmptyEntity();

            $version = $this->Versions->patchEntity($version, $this->request->getData());
			$version->current = false;
			$source_id = $version->version_id;	// Old ID

			Log::write('info', '####################################################################################');
			Log::write('info', '################# START CHECK ######################################################');
			Log::write('info', '####################################################################################');
			Log::write('info', '');
			
			Log::write('info', '================= Start MulticastSources consistency check =========================');
			$this->loadModel('MulticastSources');
			$records = $this->MulticastSources->find('all', ['conditions' => ['MulticastSources.version_id' => $source_id]]);
			foreach($records as $record){
				//unset($record->id);
				unset($record->created);
				unset($record->modified);
				$record->version_id = $version_id;
				$new = $record->toArray();
				$newRecord = $this->MulticastSources->newEmptyEntity();
				$newRecord = $this->MulticastSources->patchEntity($newRecord, $new);
				if(!$newRecord->getErrors()){
					$count++;
					//Log::write('info', 'MulticastSources clone test #id: ' . $record->id . " - OK");
				}else{
					$error++;
					Log::write('info', 'MulticastSources validation: ' . print_r($newRecord->getErrors(), true));
					Log::write('info', 'MulticastSources new: ' . print_r($new, true));
					Log::write('info', '------------------------------------------------------------------------------------');
				}
			}
			Log::write('info', '================= End MulticastSources consistency check ===========================');
			Log::write('info', '');



			Log::write('info', '================= Start Features consistency check =================================');
			$this->loadModel('Features');
			$records = $this->Features->find('all', ['conditions' => ['Features.version_id' => $source_id]]);
			foreach($records as $record){
				//unset($record->id);
				unset($record->created);
				unset($record->modified);
				$record->version_id = $version_id;
				$new = $record->toArray();
				$newRecord = $this->Features->newEmptyEntity();
				$newRecord = $this->Features->patchEntity($newRecord, $new);
				if(!$newRecord->getErrors()){
					$count++;
					//Log::write('info', 'Features clone test #id: ' . $record->id . " - OK");
				}else{
					$error++;
					Log::write('info', 'Features validation: ' . print_r($newRecord->getErrors(), true));
					Log::write('info', 'Features new: ' . print_r($new, true));
					Log::write('info', '------------------------------------------------------------------------------------');
				}
			}
			Log::write('info', '================= End Features consistency check ===================================');
			Log::write('info', '');


			Log::write('info', '================= Start Languages consistency check ================================');
			$this->loadModel('Languages');
			$records = $this->Languages->find('all', ['conditions' => ['Languages.version_id' => $source_id]]);
			foreach($records as $record){
				//unset($record->id);
				unset($record->created);
				unset($record->modified);
				$record->version_id = $version_id;
				$new = $record->toArray();
				$newRecord = $this->Languages->newEmptyEntity();
				$newRecord = $this->Languages->patchEntity($newRecord, $new);
				if(!$newRecord->getErrors()){
					$count++;
					//Log::write('info', 'Languages clone test #id: ' . $record->id . " - OK");
				}else{
					$error++;
					Log::write('info', 'Languages validation: ' . print_r($newRecord->getErrors(), true));
					Log::write('info', 'Languages new: ' . print_r($new, true));
					Log::write('info', '------------------------------------------------------------------------------------');
				}
			}
			Log::write('info', '================= End Languages consistency check ==================================');
			Log::write('info', '');


			Log::write('info', '================= Start Packages consistency check =================================');
			$this->loadModel('Packages');
			$records = $this->Packages->find('all', ['conditions' => ['Packages.version_id' => $source_id]]);
			foreach($records as $record){
				//unset($record->id);
				unset($record->created);
				unset($record->modified);
				$record->version_id = $version_id;
				$new = $record->toArray();
				$newRecord = $this->Packages->newEmptyEntity();
				$newRecord = $this->Packages->patchEntity($newRecord, $new);
				if(!$newRecord->getErrors()){
					$count++;
					//Log::write('info', 'Packages clone test #id: ' . $record->id . " - OK");
				}else{
					$error++;
					Log::write('info', 'Packages validation: ' . print_r($newRecord->getErrors(), true));
					Log::write('info', 'Packages new: ' . print_r($new, true));
					Log::write('info', '------------------------------------------------------------------------------------');
				}
			}
			Log::write('info', '================= End Packages consistency check ===================================');
			Log::write('info', '');



			Log::write('info', '================= Start Programs consistency check =================================');
			$this->loadModel('Programs');
			$records = $this->Programs->find('all', ['conditions' => ['Programs.version_id' => $source_id]]);
			foreach($records as $record){
				//unset($record->id);
				unset($record->created);
				unset($record->modified);
				$record->version_id = $version_id;
				$new = $record->toArray();
				$newRecord = $this->Programs->newEmptyEntity();
				$newRecord = $this->Programs->patchEntity($newRecord, $new);
				if(!$newRecord->getErrors()){
					$count++;
					//Log::write('info', 'Programs clone test #id: ' . $record->id . " - OK");
				}else{
					$error++;
					Log::write('info', 'Programs validation: ' . print_r($newRecord->getErrors(), true));
					Log::write('info', 'Programs new: ' . print_r($new, true));
					Log::write('info', '------------------------------------------------------------------------------------');
				}
			}
			Log::write('info', '================= End Programs consistency check ===================================');
			Log::write('info', '');


			Log::write('info', '================= Start PackagesProgramsAnalogs consistency check ==================');
			$this->loadModel('PackagesProgramsAnalogs');
			$records = $this->PackagesProgramsAnalogs->find('all', ['conditions' => ['PackagesProgramsAnalogs.version_id' => $source_id]]);
			foreach($records as $record){
				//unset($record->id);
				unset($record->created);
				unset($record->modified);
				$record->version_id = $version_id;
				$new = $record->toArray();
				$newRecord = $this->PackagesProgramsAnalogs->newEmptyEntity();
				$newRecord = $this->PackagesProgramsAnalogs->patchEntity($newRecord, $new);
				if(!$newRecord->getErrors()){
					$count++;
					//Log::write('info', 'PackagesProgramsAnalogs clone test #id: ' . $record->id . " - OK");
				}else{
					$error++;
					Log::write('info', 'PackagesProgramsAnalogs validation: ' . print_r($newRecord->getErrors(), true));
					Log::write('info', 'PackagesProgramsAnalogs new: ' . print_r($new, true));
					Log::write('info', '------------------------------------------------------------------------------------');
				}
			}
			Log::write('info', '================= End PackagesProgramsAnalogs consistency check ====================');
			Log::write('info', '');



			Log::write('info', '================= Start PackagesProgramsDigitals consistency check =================');
			$this->loadModel('PackagesProgramsDigitals');
			$records = $this->PackagesProgramsDigitals->find('all', ['conditions' => ['PackagesProgramsDigitals.version_id' => $source_id]]);
			foreach($records as $record){
				//unset($record->id);
				unset($record->created);
				unset($record->modified);
				$record->version_id = $version_id;
				$new = $record->toArray();
				$newRecord = $this->PackagesProgramsDigitals->newEmptyEntity();
				$newRecord = $this->PackagesProgramsDigitals->patchEntity($newRecord, $new);
				if(!$newRecord->getErrors()){
					$count++;
					//Log::write('info', 'PackagesProgramsDigitals clone test #id: ' . $record->id . " - OK");
				}else{
					$error++;
					Log::write('info', 'PackagesProgramsDigitals validation: ' . print_r($newRecord->getErrors(), true));
					Log::write('info', 'PackagesProgramsDigitals new: ' . print_r($new, true));
					Log::write('info', '------------------------------------------------------------------------------------');
				}
			}
			Log::write('info', '================= End PackagesProgramsDigitals consistency check ===================');
			Log::write('info', '');


			Log::write('info', '####################################################################################');
			Log::write('info', '#################  END CHECK #######################################################');
			Log::write('info', '####################################################################################');
			Log::write('info', '');



		return $error;

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
		$versions = null;
		
		$this->set('title', __('Versions'));

		//$this->config['index_number_of_rows'] = 100;
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
				//'Versions.id !=' 		=> 1,
				//'Versions.name' 		=> 1,
				//'Versions.visible' 		=> 1,
				//'Versions.created >= ' 	=> new \DateTime('-10 days'),
				//'Versions.modified >= '	=> new \DateTime('-10 days'),
			],
			/*
			// Nem tanácsos az order-t itt használni, mert pl az edit után az utolsó  ordert ugyan beálíltja, de
			// kiegészíti ezzel s így az utoljára mentett rekord nem lesz megtalálható az X-edik oldalon, mert az az elsőre kerül.
			// A felhasználó állítson be rendezettséget magának! Kivételes esetek persze lehetnek!
			*/
			'order' => [
				//'Versions.id' 			=> 'desc',
				//'Versions.name' 		=> 'asc',
				//'Versions.visible' 		=> 'desc',
				//'Versions.pos' 			=> 'desc',
				//'Versions.rank' 		=> 'asc',
				//'Versions.created' 		=> 'desc',
				//'Versions.modified' 	=> 'desc',
			],
			'limit' => $this->config['index_number_of_rows'],
			'maxLimit' => $this->config['index_number_of_rows'],
			//'sortableFields' => ['id', 'name', 'created', '...'],
			//'paramType' => 'querystring',
			//'fields' => ['Versions.id', 'Versions.name', ...],
			//'finder' => 'published',
        ];

		//$this->paging = $this->session->read('Layout.' . $this->controller . '.Paging');

		if( $this->paging === null){
			$this->paginate['order'] = [
				//'Versions.id' 			=> 'desc',
				//'Versions.name' 		=> 'asc',
				//'Versions.visible' 		=> 'desc',
				//'Versions.pos' 			=> 'desc',
				//'Versions.rank' 		=> 'asc',
				//'Versions.created' 		=> 'desc',
				//'Versions.modified' 	=> 'desc',
			];
		}else{
			if($this->request->getQuery('sort') === null && $this->request->getQuery('direction') === null){
				$this->paginate['order'] = [
					// If not in URL-ben, then come from sessinon...
					$this->paging['Versions']['sort'] => $this->paging['Versions']['direction']	
				];
			}
		}

		if($this->request->getQuery('page') === null && !isset($this->paging['Versions']['page']) ){
			$this->paginate['page'] = 1;
		}else{
			$this->paginate['page'] = (isset($this->paging['Versions']['page'])) ? $this->paging['Versions']['page'] : 1;
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
						//	'page'		=> $this->paging['Versions']['page'], 	// Vagy 1
						//	'sort'		=> $this->paging['Versions']['sort'], 
						//	'direction'	=> $this->paging['Versions']['direction'],
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
			//$this->paginate['conditions'] = ['Versions.name LIKE' => $q ];
			$this->paginate['conditions'][] = [
				'OR' => [
					['Versions.name LIKE' => $search['s'] ],
					//['Versions.title LIKE' => $search['s'] ], // ... just add more fields
				]
			];
			
		}
		// -- /.Filter --
		
		
		if(!$this->currentUser->is_superuser){
			$this->paginate['conditions'][] = ['Versions.id !=' => 1];
		}
		
		try {
			$versions = $this->paginate($this->Versions);
		} catch (NotFoundException $e) {
			$paging = $this->request->getAttribute('paging');
			if($paging['Versions']['prevPage'] !== null && $paging['Versions']['prevPage']){
				if($paging['Versions']['page'] !== null && $paging['Versions']['page'] > 0){
					return $this->redirect([
						'controller' => $this->controller, 
						'action' => 'index', 
						'?' => [
							'page'		=> 1,	//$this->paging['Versions']['page'],
							'sort'		=> $this->paging['Versions']['sort'],
							'direction'	=> $this->paging['Versions']['direction'],
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
		$this->set(compact('versions'));
		
	}


    /**
     * View method
     *
     * @param string|null $id Version id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$this->set('title', __('Version'));
		
        $version = $this->Versions->get($id, [
            'contain' => ['Headstations', 'MulticastSources', 'Packages', 'PackagesProgramsAnalogs' => ['Programs'], 'PackagesProgramsDigitals' => ['Ackeys', 'Programs'], 'Programs'],
        ]);

		$this->session->write('Layout.' . $this->controller . '.LastId', $id);

		//$this->loadModel('');

		$name = $version->name;

        $this->set(compact('version', 'id', 'name'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function old_add()
    {
		$this->set('title', __('Version'));
        $version = $this->Versions->newEmptyEntity();
        if ($this->request->is('post')) {
            $version = $this->Versions->patchEntity($version, $this->request->getData());
            if ($this->Versions->save($version)) {
                //$this->Flash->success(__('The version has been saved.'));
                $this->Flash->success(__('Has been saved.'));

				$this->session->write('Layout.' . $this->controller . '.LastId', $version->id);
	
                //return $this->redirect(['action' => 'index']);
                return $this->redirect([
					'controller' => $this->controller, 
					'action' => 'index', 
					'?' => [
						'page'		=> 1,
						'sort'		=> 'id',
						'direction'	=> 'desc',
					],
					'#' => $version->id	// Az állandó header miatt takarásban van még. Majd...
				]);

                return $this->redirect(['action' => 'index']);
            }
            //$this->Flash->error(__('The version could not be saved. Please, try again.'));
			$this->Flash->error(__('Could not be saved. Please, try again.'));
        }
        //$headstations = $this->Versions->Headstations->find('list', ['limit' => 200]);	// Original
		//$headstations = $this->Versions->Headstations->find('list', ['limit' => 200, 'conditions'=>['Headstations.visible' => 1], 'order'=>['Headstations.pos' => 'asc', 'Headstations.name' => 'asc']]);
		$headstations = $this->Versions->Headstations->find('list', ['limit' => 200, 'order'=>['Headstations.pos' => 'asc', 'Headstations.name' => 'asc']]);
        $this->set(compact('version', 'headstations'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Version id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->set('title', __('Version'));
        $version = $this->Versions->get($id, [
            'contain' => [],
        ]);
		
		$this->session->write('Layout.' . $this->controller . '.LastId', $id);
		
        if ($this->request->is(['patch', 'post', 'put'])) {
			//debug($this->request->getData()); //die();
            $version = $this->Versions->patchEntity($version, $this->request->getData());
            //debug($version); //die();
			if ($this->Versions->save($version)) {
                //$this->Flash->success(__('The version has been saved.'));
                $this->Flash->success(__('Has been saved.'));
				
                
				//return $this->redirect(['action' => 'index']);
                return $this->redirect([
					'controller' => $this->controller, 
					'action' => 'index', 
					'?' => [
						'page'		=> (isset($this->paging['Versions']['page'])) ? $this->paging['Versions']['page'] : 1, 		// or 1
						'sort'		=> (isset($this->paging['Versions']['sort'])) ? $this->paging['Versions']['sort'] : 'created', 
						'direction'	=> (isset($this->paging['Versions']['direction'])) ? $this->paging['Versions']['direction'] : 'desc',
					],
					'#' => $id
				]);
				
            }
            //$this->Flash->error(__('The version could not be saved. Please, try again.'));
            $this->Flash->error(__('Could not be saved. Please, try again.'));
        }
        //$headstations = $this->Versions->Headstations->find('list', ['limit' => 200]);
		//$headstations = $this->Versions->Headstations->find('list', ['limit' => 200, 'conditions'=>['Headstations.visible' => 1], 'order'=>['Headstations.pos' => 'asc', 'Headstations.name' => 'asc']]);
		$headstations = $this->Versions->Headstations->find('list', ['limit' => 200, 'order'=>['Headstations.pos' => 'asc', 'Headstations.name' => 'asc']]);

		$name = $version->name;

        $this->set(compact('version', 'headstations', 'id', 'name'));
    }




    /**
     * Delete method
     *
     * @param string|null $id Version id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		
		$version = $this->Versions->get($id);
		
		if($version->current){
			$this->Flash->error(__('This is the current version! Could not be deleted.'));
			return $this->redirect([
				'controller' => $this->controller, 
				'action' => 'index', 
				'?' => [
					'page'		=> $this->paging['Versions']['page'], 
					'sort'		=> $this->paging['Versions']['sort'], 
					'direction'	=> $this->paging['Versions']['direction'],
				],
				'#' => $id
			]);
		}
		
		// A modellben a CASCADE törlés beállítva
		
		//$this->loadModel('Ackeys');
		//$this->loadModel('MulticastSources');
		//$this->loadModel('Features');
		//$this->loadModel('Languages');
		//$this->loadModel('Packages');
		//$this->loadModel('Programs');
		//$this->loadModel('PackagesProgramsAnalogs');
		//$this->loadModel('PackagesProgramsDigitals');
		
        $this->request->allowMethod(['post', 'delete']);
		
        //$version = $this->Versions->get($id);
		//$this->Ackeys->deleteAll(['version_id' => $id]);
		//$this->MulticastSources->deleteAll(['version_id' => $id]);
		//$this->Features->deleteAll(['version_id' => $id]);
		//$this->Languages->deleteAll(['version_id' => $id]);
		//$this->Packages->deleteAll(['version_id' => $id]);
		//$this->Programs->deleteAll(['version_id' => $id]);
		//$this->PackagesProgramsAnalogs->deleteAll(['version_id' => $id]);
		//$this->PackagesProgramsDigitals->deleteAll(['version_id' => $id]);

        if ($this->Versions->delete($version)) {
            //$this->Flash->success(__('The version has been deleted.'));
            $this->Flash->success(__('Has been deleted.'));
        } else {
            //$this->Flash->error(__('The version could not be deleted. Please, try again.'));
            $this->Flash->error(__('Could not be deleted. Please, try again.'));
        }

        //return $this->redirect(['action' => 'index']);
		return $this->redirect([
			'controller' => $this->controller, 
			'action' => 'index', 
			'?' => [
				'page'		=> $this->paging['Versions']['page'], 
				'sort'		=> $this->paging['Versions']['sort'], 
				'direction'	=> $this->paging['Versions']['direction'],
			]
		]);
		
    }

}