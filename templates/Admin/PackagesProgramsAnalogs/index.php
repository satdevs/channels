<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PackagesProgramsAnalog[]|\Cake\Collection\CollectionInterface $packagesProgramsAnalogs
 */
?>
<?php 
	use Cake\Core\Configure;
	
	//$session 			= $this->getRequest()->getSession();
	//$prefix 			= strtolower( $this->request->getParam('prefix') );	
	//$controller 		= $this->request->getParam('controller');	// for DB click on <tr>
	//$action 			= $this->request->getParam('action');		// for DB click on <tr>
	//$passedArgs 		= $this->request->getParam('pass');			// for DB click on <tr>
	
	$config = Configure::read('Theme.' . $prefix);	
	//-------> More config from \config\jeffadmin.php <------
	//$config['index_show_id'] 			= true;
	$config['index_show_visible'] 	= true;
	//$config['index_show_pos'] 		= true;
	//$config['index_show_created'] 	= true;
	//$config['index_show_modified'] 	= true;
	//$config['index_show_actions'] 	= true;
	//$config['index_enable_view'] 		= true;
	//$config['index_enable_edit'] 		= true;
	//$config['index_enable_delete'] 	= true;
	//$config['index_enable_db_click'] 	= true;
	//$config['index_db_click_action'] 	= 'edit';	// edit, view
	//
	//$url = $this->Url->build(['prefix' => $prefix, 'controller' => $controller , 'action' => $config['index_db_click_action']]);

	if(!isset($layoutPackagesProgramsAnalogsLastId)){
		$layoutPackagesProgramsAnalogsLastId = 0;
	}

?>
		<div class="index col-12">
            <div class="card card-lightblue">
				<div class="card-header">
					<h4 class="card-title"><?= __('Index') ?>: <?= $title ?><?php
					if(isset($search) && $search != ''){
						echo " &rarr; " . __('filter') . ": <b>" . $search . "</b>";
					}
				?></h4>
					<div class="card-tools">
						<?= $this->element('JeffAdmin.paginateTop') ?>
					</div>				
				</div><!-- ./card-header -->
			  
				<?php //= __('PackagesProgramsAnalogs') ?>	
				<div class="card-body table-responsive p-0 packagesProgramsAnalogs">
<?php //debug($session->read()); ?>
					<table class="table table-hover table-striped table-bordered text-nowrap">
						<thead>
							<tr>
								<th class="row-id-anchor"></th>
<?php if(isset($config['index_show_id']) && $config['index_show_id']){ ?>
								<th class="id integer"><?= $this->Paginator->sort('id') ?></th>
<?php } ?>
								<th class="lcn integer"><?= $this->Paginator->sort('lcn') ?></th>
								<th class="package-id integer"><?= $this->Paginator->sort('package_id') ?></th>
								<th class="program-id integer"><?= $this->Paginator->sort('program_id') ?></th>
								<th class="band-id integer"><?= $this->Paginator->sort('band_id') ?></th>
								<th class="name string"><?= $this->Paginator->sort('name') ?></th>
								<th class="changed string"><?= $this->Paginator->sort('changed') ?></th>
								<th class="to-delete boolean"><?= $this->Paginator->sort('to_delete') ?></th>
<?php if(isset($config['index_show_visible']) && $config['index_show_visible']){ ?>

								<th class="visible boolean"><?= $this->Paginator->sort('visible') ?></th>
<?php } ?>
<?php if(isset($config['index_show_pos']) && $config['index_show_pos']){ ?>

								<th class="pos integer"><?= $this->Paginator->sort('pos') ?></th>
<?php } ?>
<?php if(isset($config['index_show_created']) && $config['index_show_created'] || isset($config['index_show_modified']) && $config['index_show_modified']){ ?>
								<th class="datetime created-modified">
<?php 	if(isset($config['index_show_created']) && $config['index_show_created']){ ?>
									<?= $this->Paginator->sort('created') ?>
<?php 	} ?>
<?php 	if(isset($config['index_show_created']) && $config['index_show_created'] && isset($config['index_show_modified']) && $config['index_show_modified']){ ?>
									<br>
<?php 	} ?>
<?php 	if(isset($config['index_show_modified']) && $config['index_show_modified']){ ?>
									<?= $this->Paginator->sort('modified') ?>
<?php 	} ?>
								</th>
<?php } ?>



<?php if(isset($config['index_show_actions']) && $config['index_show_actions']){ ?>
								<th class="actions"><?= __('Actions') ?></th>
<?php } ?>
							</tr>
						</thead>
						<tbody>
					<?php foreach ($packagesProgramsAnalogs as $packagesProgramsAnalog): ?>
							<tr row-id="<?= $packagesProgramsAnalog->id ?>"<?php if($packagesProgramsAnalog->id == $layoutPackagesProgramsAnalogsLastId){ echo ' class="table-tr-last-id"'; } ?>  prefix="<?= $prefix ?>" controller="<?= $controller ?>" action="<?= $action ?>" aria-expanded="true">
								<td class="row-id-anchor" value="<?= $packagesProgramsAnalog->id ?>"><a class="anchor" name="<?= $packagesProgramsAnalog->id ?>"></a></td><!-- bake-0 -->
<?php if(isset($config['index_show_id']) && $config['index_show_id']){ ?>
								<td class="id integer" name="id" value="<?= $this->Number->format($packagesProgramsAnalog->id) ?>"><?= $this->Number->format($packagesProgramsAnalog->id) ?></td><!-- bake-3 -->
<?php } ?>
								<td class="lcn integer" name="lcn" value="<?= $this->Number->format($packagesProgramsAnalog->lcn) ?>"><?= $this->Number->format($packagesProgramsAnalog->lcn) ?></td><!-- bake-3 -->
								<td class="package-id integer link text-left" value="<?= $packagesProgramsAnalog->package_id ?>"><?= $packagesProgramsAnalog->has('package') ? $this->Html->link($packagesProgramsAnalog->package->name, ['controller' => 'Packages', 'action' => 'view', $packagesProgramsAnalog->package->id]) : '' ?></td><!-- bake-1 -->
								<td class="program-id integer link text-left" value="<?= $packagesProgramsAnalog->program_id ?>"><?= $packagesProgramsAnalog->has('program') ? $this->Html->link($packagesProgramsAnalog->program->name, ['controller' => 'Programs', 'action' => 'view', $packagesProgramsAnalog->program->id]) : '' ?></td><!-- bake-1 -->
								<td class="band-id integer link text-left" value="<?= $packagesProgramsAnalog->band_id ?>"><?= 
									$packagesProgramsAnalog->has('band') ? $this->Html->link(
									h($packagesProgramsAnalog->band->name)
									. ' • ' . h($packagesProgramsAnalog->band->band)
									. ' • ' . h($packagesProgramsAnalog->band->type)
									. ' • ' . $packagesProgramsAnalog->band->frequency . ' Mhz ' 
									. ' • ' . h($packagesProgramsAnalog->band->bandwidth) . ' Mhz ',
									['controller' => 'Bands', 'action' => 'view', $packagesProgramsAnalog->band->id]) : '' ?>
								</td><!-- bake-1 -->
								<td class="name string" name="name" value="<?= $packagesProgramsAnalog->name ?>"><?= h($packagesProgramsAnalog->name) ?></td><!-- bake-2 -->
								<td class="changed string" name="changed" value="<?= $packagesProgramsAnalog->changed ?>"><?= h($packagesProgramsAnalog->changed) ?></td><!-- bake-2 -->
								<td class="to-delete boolean" name="to-delete" to-delete="<?= $packagesProgramsAnalog->to_delete ?>"><?= h($packagesProgramsAnalog->to_delete) ?></td><!-- bake-2 -->
<?php if(isset($config['index_show_visible']) && $config['index_show_visible']){ ?>
								<td class="visible boolean" name="visible" visible="<?= $packagesProgramsAnalog->visible ?>"><?= h($packagesProgramsAnalog->visible) ?></td><!-- bake-2 -->
<?php } ?><?php if(isset($config['index_show_pos']) && $config['index_show_pos']){ ?>
								<td class="pos integer" name="pos" value="<?= $this->Number->format($packagesProgramsAnalog->pos) ?>"><?= $this->Number->format($packagesProgramsAnalog->pos) ?></td><!-- bake-3 -->
<?php } ?>


<?php if(isset($config['index_show_created']) && $config['index_show_created'] || isset($config['index_show_modified']) && $config['index_show_modified']){ ?>
								<td class="datetime created-modified">
<?php 	if(isset($config['index_show_created']) && $config['index_show_created']){ ?>
									<?= h($packagesProgramsAnalog->created) ?>
<?php 	} ?>
<?php 	if(isset($config['index_show_created']) && $config['index_show_created'] && isset($config['index_show_modified']) && $config['index_show_modified']){ ?>
									<br>
<?php 	} ?>
<?php 	if(isset($config['index_show_modified']) && $config['index_show_modified']){ ?>
									<?= h($packagesProgramsAnalog->modified) ?>
<?php 	} ?>
								</td>
<?php } ?>


<?php if(isset($config['index_show_actions']) && $config['index_show_actions']){ ?>
								<td class="actions text-center">
<?php 	if(isset($config['index_enable_view']) && $config['index_enable_view']){ ?>					  
									<?= $this->Html->link('<i class="fas fa-eye"></i>', ['action' => 'view', $packagesProgramsAnalog->id], ['escape' => false, 'class' => 'btn btn-sm bg-gradient-warning action-button-view', 'data-bs-tooltip'=>'tooltip', 'data-bs-placement'=>'top', 'title' => __('View this record')]) ?>
<?php 	} ?>
<?php 	if(isset($config['index_enable_edit']) && $config['index_enable_edit']){ ?>					  
									<?= $this->Html->link('<i class="fas fa-edit"></i>', ['action' => 'edit', $packagesProgramsAnalog->id], ['escape' => false, 'class' => 'btn btn-sm bg-gradient-success action-button-edit', 'data-bs-tooltip'=>'tooltip', 'data-bs-placement'=>'top', 'title' => __('Edit this record')]) ?>
<?php 	} ?>			
<?php 	if(isset($config['index_enable_delete']) && $config['index_enable_delete']){ ?>					  
									<?php //= $this->Form->postLink('<i class="fas fa-remove"></i>', ['action' => 'delete', $packagesProgramsAnalog->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $packagesProgramsAnalog->id), 'class' => 'btn btn-sm bg-gradient-danger action-button-delete']) ?>						
									<?= $this->Form->postLink('', ['action' => 'delete', $packagesProgramsAnalog->id], ['class'=>'crose-btn hide-postlink action-button-delete']) ?>
									<a href="javascript:;" class="btn btn-sm btn-danger delete postlink-delete" data-bs-tooltip="tooltip" data-bs-placement="top" title="<?= __("Delete this record!") ?>" text="<?= h($packagesProgramsAnalog->name) ?>" subText="<?= __("You will not be able to revert this!") ?>" confirmButtonText="<?= __("Yes, delete it!") ?>" cancelButtonText="<?= __("Cancel") ?>"><i class="icon-minus"></i></a>
									
<?php 	} ?>
								</td>					  
<?php } ?>
							</tr>
						<?php endforeach; ?>
						</tbody>
                </table>
              </div>
              <!-- /.card-body -->
			  
			  <div class="card-footer clearfix">
				<?= $this->element('JeffAdmin.paginateBottom') ?>
				<?php //= $this->Paginator->counter(__('Page  of , showing  record(s) out of  total')) ?>
              </div>			  
			  
            </div>
            <!-- /.card -->
        </div>

	<?php
	if(isset($config['index_show_actions']) && $config['index_show_actions'] && isset($config['index_enable_delete']) && $config['index_enable_delete']){ 
		$this->Html->script(
			[
				'JeffAdmin./dist/js/sweetalert_delete',
			],
			['block' => 'scriptBottom']
		);
	}	
	?>

<?php $this->Html->scriptStart(['block' => 'javaScriptBottom']); ?>

	$(document).ready( function(){
		
<?php //if(isset($config['index_enable_db_click']) && $config['index_enable_db_click'] && isset($config['index_enable_edit']) && $config['index_enable_edit'] && $config['index_db_click_action'] && isset($config['index_db_click_action']) ){ ?>
<?php 	if(isset($prefix) && isset($config['index_db_click_action']) && $config['index_db_click_action'] !== ''){ ?>
<?php $url = $this->Url->build(['controller' => 'PackagesProgramsAnalogs', 'action' => $config['index_db_click_action']]); ?>
		$('tr').dblclick( function(){
<?php /* window.location.href = '/<?= $prefix ?>/packagesProgramsAnalogs/<?= $config['index_db_click_action'] ?>/'+$(this).attr('row-id'); */ ?>
			window.location.href = '<?= $url . '/' ?>' + $(this).attr('row-id');
		});
<?php 	} ?>
<?php //} ?>

<?php /*
	https://stackoverflow.com/questions/179713/how-to-change-the-href-attribute-for-a-hyperlink-using-jquery  -->
	A pagináció, ha a routerben szerepel az oldal főoldalként, akkor kell mert sessionben tárolódik néhány dolog és...
*/ ?>
<?php 
	$base = '';
	if($this->request->getAttribute('base') != '/'){
		$base = $this->request->getAttribute('base');
	}
?>
		$(".pagination a[href^='<?= $base ?>/<?= $prefix ?>?sort=']").each(function(){
			this.href = this.href.replace("<?= $base ?>/<?= $prefix ?>", "<?= $base ?>/<?= $prefix ?>?page=1&sort=");
		});
		$(".pagination a[href='<?= $base ?>/<?= $prefix ?>']").each(function(){ 
			this.href = this.href.replace("<?= $base ?>/<?= $prefix ?>", "<?= $base ?>/<?= $prefix ?>?page=1");
		});
<?php if(isset($controller)){ ?>
		$(".pagination a[href^='<?= $base ?>/<?= $prefix ?>/packagesProgramsAnalogs?sort=']").each(function(){ 
			this.href = this.href.replace("<?= $base ?>/<?= $prefix ?>/packagesProgramsAnalogs?sort=", "<?= $base ?>/<?= $prefix ?>/packagesProgramsAnalogs?page=1&sort=");
		});
		$(".pagination a[href='<?= $base ?>/<?= $prefix ?>/packagesProgramsAnalogs']").each(function(){ 
			this.href = this.href.replace("<?= $base ?>/<?= $prefix ?>/packagesProgramsAnalogs", "<?= $base ?>/<?= $prefix ?>/packagesProgramsAnalogs?page=1");
		});
<?php } ?>

	});
	<?php $this->Html->scriptEnd(); ?>
