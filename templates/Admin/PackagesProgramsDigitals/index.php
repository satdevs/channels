<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PackagesProgramsDigital[]|\Cake\Collection\CollectionInterface $packagesProgramsDigitals
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

	if(!isset($layoutPackagesProgramsDigitalsLastId)){
		$layoutPackagesProgramsDigitalsLastId = 0;
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
			  
				<?php //= __('PackagesProgramsDigitals') ?>	
				<div class="card-body table-responsive p-0 packagesProgramsDigitals">
<?php //debug($session->read()); ?>
					<table class="table table-hover table-striped table-bordered text-nowrap">
						<thead>
							<tr>
								<th class="row-id-anchor"></th>
<?php if(isset($config['index_show_id']) && $config['index_show_id']){ ?>
								<th class="id integer"><?= $this->Paginator->sort('id') ?></th>
<?php } ?>
								<th class="integer text-center" style="width: 60px;"><?= __('Row') ?></th>
								<th class="lcn integer" style="width: 70px;"><?= $this->Paginator->sort('lcn') ?></th>
								<th class="package-id integer"><?= $this->Paginator->sort('package_id') ?></th>
								<th class="program-id integer"><?= $this->Paginator->sort('program_id') ?></th>
								<th class="ackey-id integer"><?= $this->Paginator->sort('ackey_id') ?></th>
								<th class="name string"><?= $this->Paginator->sort('name') ?></th>
								<th class="short-name string"><?= $this->Paginator->sort('short_name') ?></th>
								<th class="qam string"><?= $this->Paginator->sort('qam') ?></th>
								<th class="sid integer"><?= $this->Paginator->sort('sid') ?></th>
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
<?php $i = 1; ?>
					<?php foreach ($packagesProgramsDigitals as $packagesProgramsDigital): ?>
							<tr row-id="<?= $packagesProgramsDigital->id ?>"<?php if($packagesProgramsDigital->id == $layoutPackagesProgramsDigitalsLastId){ echo ' class="table-tr-last-id"'; } ?>  prefix="<?= $prefix ?>" controller="<?= $controller ?>" action="<?= $action ?>" aria-expanded="true">
								<td class="row-id-anchor" value="<?= $packagesProgramsDigital->id ?>"><a class="anchor" name="<?= $packagesProgramsDigital->id ?>"></a></td><!-- bake-0 -->
<?php if(isset($config['index_show_id']) && $config['index_show_id']){ ?>
								<td class="id integer" name="id" value="<?= $this->Number->format($packagesProgramsDigital->id) ?>"><?= $this->Number->format($packagesProgramsDigital->id) ?></td><!-- bake-3 -->
<?php } ?>
								<td class="integer text-center" name="row" value="<?= $i ?>"><?= $i++ ?>.</td>
								<td class="lcn integer" name="lcn" value="<?= $this->Number->format($packagesProgramsDigital->lcn) ?>"><?= $this->Number->format($packagesProgramsDigital->lcn) ?></td><!-- bake-3 -->
								<td class="package-id integer link text-left" value="<?= $packagesProgramsDigital->package_id ?>"><?= $packagesProgramsDigital->has('package') ? $this->Html->link($packagesProgramsDigital->package->popular_name, ['controller' => 'Packages', 'action' => 'view', $packagesProgramsDigital->package->id]) : '' ?></td><!-- bake-1 -->
								<td class="program-id integer link text-left" value="<?= $packagesProgramsDigital->program_id ?>"><?= $packagesProgramsDigital->has('program') ? $this->Html->link($packagesProgramsDigital->program->name, ['controller' => 'Programs', 'action' => 'view', $packagesProgramsDigital->program->id]) : '' ?></td><!-- bake-1 -->
								<td class="ackey-id integer link text-left" value="<?= $packagesProgramsDigital->ackey_id ?>"><?= $packagesProgramsDigital->has('ackey') ? $this->Html->link($packagesProgramsDigital->ackey->name, ['controller' => 'Ackeys', 'action' => 'view', $packagesProgramsDigital->ackey->id]) : '' ?></td><!-- bake-1 -->
								<td class="name string" name="name" value="<?= $packagesProgramsDigital->name ?>"><?= h($packagesProgramsDigital->name) ?></td><!-- bake-2 -->
								<td class="short-name string" name="short-name" value="<?= $packagesProgramsDigital->short_name ?>"><?= h($packagesProgramsDigital->short_name) ?></td><!-- bake-2 -->
								<td class="qam string" name="qam" value="<?= $packagesProgramsDigital->qam ?>"><?= h($packagesProgramsDigital->qam) ?></td><!-- bake-2 -->
								<td class="sid integer" name="sid" value="<?= $this->Number->format($packagesProgramsDigital->sid) ?>"><?= $this->Number->format($packagesProgramsDigital->sid) ?></td><!-- bake-3 -->
								<td class="to-delete boolean" name="to-delete" to-delete="<?= $packagesProgramsDigital->to_delete ?>"><?= h($packagesProgramsDigital->to_delete) ?></td><!-- bake-2 -->
<?php if(isset($config['index_show_visible']) && $config['index_show_visible']){ ?>
								<td class="visible boolean" name="visible" visible="<?= $packagesProgramsDigital->visible ?>"><?= h($packagesProgramsDigital->visible) ?></td><!-- bake-2 -->
<?php } ?><?php if(isset($config['index_show_pos']) && $config['index_show_pos']){ ?>
								<td class="pos integer" name="pos" value="<?= $this->Number->format($packagesProgramsDigital->pos) ?>"><?= $this->Number->format($packagesProgramsDigital->pos) ?></td><!-- bake-3 -->
<?php } ?>


<?php if(isset($config['index_show_created']) && $config['index_show_created'] || isset($config['index_show_modified']) && $config['index_show_modified']){ ?>
								<td class="datetime created-modified">
<?php 	if(isset($config['index_show_created']) && $config['index_show_created']){ ?>
									<?= h($packagesProgramsDigital->created) ?>
<?php 	} ?>
<?php 	if(isset($config['index_show_created']) && $config['index_show_created'] && isset($config['index_show_modified']) && $config['index_show_modified']){ ?>
									<br>
<?php 	} ?>
<?php 	if(isset($config['index_show_modified']) && $config['index_show_modified']){ ?>
									<?= h($packagesProgramsDigital->modified) ?>
<?php 	} ?>
								</td>
<?php } ?>


<?php if(isset($config['index_show_actions']) && $config['index_show_actions']){ ?>
								<td class="actions text-center">
<?php 	if(isset($config['index_enable_view']) && $config['index_enable_view']){ ?>					  
									<?= $this->Html->link('<i class="fas fa-eye"></i>', ['action' => 'view', $packagesProgramsDigital->id], ['escape' => false, 'class' => 'btn btn-sm bg-gradient-warning action-button-view', 'data-bs-tooltip'=>'tooltip', 'data-bs-placement'=>'top', 'title' => __('View this record')]) ?>
<?php 	} ?>
<?php 	if(isset($config['index_enable_edit']) && $config['index_enable_edit']){ ?>					  
									<?= $this->Html->link('<i class="fas fa-edit"></i>', ['action' => 'edit', $packagesProgramsDigital->id], ['escape' => false, 'class' => 'btn btn-sm bg-gradient-success action-button-edit', 'data-bs-tooltip'=>'tooltip', 'data-bs-placement'=>'top', 'title' => __('Edit this record')]) ?>
<?php 	} ?>			
<?php 	if(isset($config['index_enable_delete']) && $config['index_enable_delete']){ ?>					  
									<?php //= $this->Form->postLink('<i class="fas fa-remove"></i>', ['action' => 'delete', $packagesProgramsDigital->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $packagesProgramsDigital->id), 'class' => 'btn btn-sm bg-gradient-danger action-button-delete']) ?>						
									<?= $this->Form->postLink('', ['action' => 'delete', $packagesProgramsDigital->id], ['class'=>'crose-btn hide-postlink action-button-delete']) ?>
									<a href="javascript:;" class="btn btn-sm btn-danger delete postlink-delete" data-bs-tooltip="tooltip" data-bs-placement="top" title="<?= __("Delete this record!") ?>" text="<?= h($packagesProgramsDigital->name) ?>" subText="<?= __("You will not be able to revert this!") ?>" confirmButtonText="<?= __("Yes, delete it!") ?>" cancelButtonText="<?= __("Cancel") ?>"><i class="icon-minus"></i></a>
									
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
<?php $url = $this->Url->build(['controller' => 'PackagesProgramsDigitals', 'action' => $config['index_db_click_action']]); ?>
		$('tr').dblclick( function(){
<?php /* window.location.href = '/<?= $prefix ?>/packagesProgramsDigitals/<?= $config['index_db_click_action'] ?>/'+$(this).attr('row-id'); */ ?>
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
		$(".pagination a[href^='<?= $base ?>/<?= $prefix ?>/packagesProgramsDigitals?sort=']").each(function(){ 
			this.href = this.href.replace("<?= $base ?>/<?= $prefix ?>/packagesProgramsDigitals?sort=", "<?= $base ?>/<?= $prefix ?>/packagesProgramsDigitals?page=1&sort=");
		});
		$(".pagination a[href='<?= $base ?>/<?= $prefix ?>/packagesProgramsDigitals']").each(function(){ 
			this.href = this.href.replace("<?= $base ?>/<?= $prefix ?>/packagesProgramsDigitals", "<?= $base ?>/<?= $prefix ?>/packagesProgramsDigitals?page=1");
		});
<?php } ?>

	});
	<?php $this->Html->scriptEnd(); ?>
