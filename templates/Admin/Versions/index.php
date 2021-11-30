<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Version[]|\Cake\Collection\CollectionInterface $versions
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
	$config['index_show_id'] 			= true;
	$config['index_show_visible'] 	= true;
	$config['index_show_pos'] 		= true;
	$config['index_show_created'] 	= true;
	$config['index_show_modified'] 	= true;
	//$config['index_show_actions'] 	= true;
	//$config['index_enable_view'] 		= true;
	//$config['index_enable_edit'] 		= true;
	//$config['index_enable_delete'] 	= true;
	//$config['index_enable_db_click'] 	= true;
	//$config['index_db_click_action'] 	= 'edit';	// edit, view
	//
	//$url = $this->Url->build(['prefix' => $prefix, 'controller' => $controller , 'action' => $config['index_db_click_action']]);

	if(!isset($layoutVersionsLastId)){
		$layoutVersionsLastId = 0;
	}

?>
		<div class="index col-12">
            <div class="card card-lightblue">
				<div class="card-header">
					<h4 class="card-title">
					<?= __('Index') ?>: <?= $title ?><?php
					if(isset($search) && $search != ''){
						echo " &rarr; " . __('filter') . ": <b>" . $search . "</b>";
					}
				?></h4>
					<div class="card-tools">
						<?= $this->element('JeffAdmin.paginateTop') ?>
					</div>				
				</div><!-- ./card-header -->
			  
				<?php //= __('Versions') ?>	
				<div class="card-body table-responsive p-0 versions">
<?php //debug($session->read()); ?>
					<table class="table table-hover table-striped table-bordered text-nowrap">
						<thead>
							<tr>
								<th class="row-id-anchor"></th>
								<th class="text-center" style="width: 120px;"><?= __('Work') ?></th>
<?php if(isset($config['index_show_id']) && $config['index_show_id']){ ?>
								<th class="id integer"><?= $this->Paginator->sort('id') ?></th>
<?php } ?>
								<th class="headstation-id integer"><?= $this->Paginator->sort('headstation_id') ?></th>
								<th class="name string"><?= $this->Paginator->sort('name') ?></th>
								<th class="broadcast string"><?= $this->Paginator->sort('broadcast') ?></th>
								<th class="current boolean"><?= $this->Paginator->sort('current') ?></th>
								
								<th class="print_image boolean"><?= $this->Paginator->sort('print_image') ?></th>
<?php /*
								<th class="date-from date"><?= $this->Paginator->sort('date_from') ?></th>
								<th class="date-to date"><?= $this->Paginator->sort('date_to') ?></th>
*/ ?>
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
					<?php foreach ($versions as $version): ?>
<?php
	$currentVersionClass = '';
	if(isset($version_id) && $version_id == $version->id){
		$currentVersionClass = ' current-version';	
	}
?>
							<tr row-id="<?= $version->id ?>"<?php if($version->id == $layoutVersionsLastId){ echo ' class="table-tr-last-id"'; } ?>  prefix="<?= $prefix ?>" controller="<?= $controller ?>" action="<?= $action ?>" aria-expanded="true">
								<td class="row-id-anchor<?= $currentVersionClass ?>" value="<?= $version->id ?>"><a class="anchor" name="<?= $version->id ?>"></a></td><!-- bake-0 -->
								<td class="text-center setCurrentVersion<?= $currentVersionClass ?>">
									<?php if($version_id == $version->id){ ?>
										<span style="font-weight: bold; color: red;"><?= __('Work') ?></span>
									<?php }else{ ?>
									<?= $this->Html->link('Választ <i class="fas icon-right-big"></i>', ['action' => 'setVersionToSession', $version->id], ['escape' => false, 'class' => 'btn btn-sm bg-gradient-success action-button-view', 'data-bs-tooltip'=>'tooltip', 'data-bs-placement'=>'top', 'title' => __('Set current version to session')]) ?>
									<?php } ?>
								</td><!-- bake-0 -->
<?php if(isset($config['index_show_id']) && $config['index_show_id']){ ?>
								<td class="id integer text-center<?= $currentVersionClass ?>" name="id" value="<?= $this->Number->format($version->id) ?>"><?= $this->Number->format($version->id) ?></td><!-- bake-3 -->
<?php } ?>
								<td class="headstation-id integer link text-left<?= $currentVersionClass ?>" value="<?= $version->headstation_id ?>"><?= $version->has('headstation') ? $this->Html->link($version->headstation->name, ['controller' => 'Headstations', 'action' => 'view', $version->headstation->id]) : '' ?></td><!-- bake-1 -->
								<td class="name string<?= $currentVersionClass ?>" name="name" value="<?= $version->name ?>"><?= h($version->name) ?></td><!-- bake-2 -->
								<td class="broadcast string<?= $currentVersionClass ?>" name="broadcast" value="<?= $version->broadcast ?>"><?= $broadcasts[$version->broadcast] ?></td><!-- bake-2 -->
								<td class="current<?= $currentVersionClass ?>" name="current" value="<?= $version->current ?>">
									<?php if($version->current){ ?>
										<span style="font-weight: bold; color: red;"><?= __('Current') ?></span>
									<?php }else{ ?>
									<?php 	if($version->id != 1){ ?>
										<?= $this->Html->link(__('Select') . "!", ['action' => 'setCurrentVersion', $version->broadcast, $version->id, $version->headstation_id], ['escape' => false, 'class' => 'btn btn-sm bg-gradient-success action-button-view', 'data-bs-tooltip'=>'tooltip', 'data-bs-placement'=>'top', 'title' => __('Set current version to channels'), 'confirm' => __('Are you sure you want to set this version for the current version?')]) ?>
									<?php 	} ?>
									<?php } ?>
								</td><!-- bake-2 -->
								<td class="boolean<?= $currentVersionClass ?>" name="print_image" value="<?= $version->print_image ?>"><?= $version->print_image ?></td>
<?php /*
								<td class="date-from date<?= $currentVersionClass ?>" name="date-from" value="<?= $version->date_from ?>"><?= h($version->date_from) ?></td><!-- bake-2 -->
								<td class="date-to date<?= $currentVersionClass ?>" name="date-to" value="<?= $version->date_to ?>"><?= h($version->date_to) ?></td><!-- bake-2 -->
*/ ?>
<?php if(isset($config['index_show_visible']) && $config['index_show_visible']){ ?>
								<td class="visible boolean<?= $currentVersionClass ?>" name="visible" visible="<?= $version->visible ?>"><?= h($version->visible) ?></td><!-- bake-2 -->

<?php } ?><?php if(isset($config['index_show_pos']) && $config['index_show_pos']){ ?>
								<td class="pos integer<?= $currentVersionClass ?>" name="pos" value="<?= $this->Number->format($version->pos) ?>"><?= $this->Number->format($version->pos) ?></td><!-- bake-3 -->
<?php } ?>


<?php if(isset($config['index_show_created']) && $config['index_show_created'] || isset($config['index_show_modified']) && $config['index_show_modified']){ ?>
								<td class="datetime created-modified<?= $currentVersionClass ?>">
<?php 	if(isset($config['index_show_created']) && $config['index_show_created']){ ?>
									<?= h($version->created) ?>
<?php 	} ?>
<?php 	if(isset($config['index_show_created']) && $config['index_show_created'] && isset($config['index_show_modified']) && $config['index_show_modified']){ ?>
									<br>
<?php 	} ?>
<?php 	if(isset($config['index_show_modified']) && $config['index_show_modified']){ ?>
									<?= h($version->modified) ?>
<?php 	} ?>
								</td>
<?php } ?>


<?php if(isset($config['index_show_actions']) && $config['index_show_actions']){ ?>
								<td class="actions text-center<?= $currentVersionClass ?>">
<?php 	if(isset($config['index_enable_view']) && $config['index_enable_view']){ ?>					  
									<?= $this->Html->link('<i class="fas fa-eye"></i>', ['action' => 'view', $version->id], ['escape' => false, 'class' => 'btn btn-sm bg-gradient-warning action-button-view', 'data-bs-tooltip'=>'tooltip', 'data-bs-placement'=>'top', 'title' => __('View this record')]) ?>
<?php 	} ?>
<?php 	if(isset($config['index_enable_edit']) && $config['index_enable_edit']){ ?>					  
									<?= $this->Html->link('<i class="fas fa-edit"></i>', ['action' => 'edit', $version->id], ['escape' => false, 'class' => 'btn btn-sm bg-gradient-success action-button-edit', 'data-bs-tooltip'=>'tooltip', 'data-bs-placement'=>'top', 'title' => __('Edit this record')]) ?>
<?php 	} ?>
<?php 	if(false && $version_id != $version->id && !$version->current && isset($config['index_enable_delete']) && $config['index_enable_delete']){ ?>					  
									<?php //= $this->Form->postLink('<i class="fas fa-remove"></i>', ['action' => 'delete', $version->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $version->id), 'class' => 'btn btn-sm bg-gradient-danger action-button-delete']) ?>						
									<?= $this->Form->postLink('', ['action' => 'delete', $version->id], ['class'=>'crose-btn hide-postlink action-button-delete']) ?>
									<a href="javascript:;" class="btn btn-sm btn-danger delete postlink-delete" data-bs-tooltip="tooltip" data-bs-placement="top" title="<?= __("Delete this record!") ?>" text="<?= h($version->name) ?>" subText="<?= __("You will not be able to revert this!") ?>" confirmButtonText="<?= __("Yes, delete it!") ?>" cancelButtonText="<?= __("Cancel") ?>"><i class="icon-minus"></i></a>
									
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
<?php $url = $this->Url->build(['controller' => 'Versions', 'action' => $config['index_db_click_action']]); ?>
		$('tr').dblclick( function(){
<?php /* window.location.href = '/<?= $prefix ?>/versions/<?= $config['index_db_click_action'] ?>/'+$(this).attr('row-id'); */ ?>
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
		$(".pagination a[href^='<?= $base ?>/<?= $prefix ?>/versions?sort=']").each(function(){ 
			this.href = this.href.replace("<?= $base ?>/<?= $prefix ?>/versions?sort=", "<?= $base ?>/<?= $prefix ?>/versions?page=1&sort=");
		});
		$(".pagination a[href='<?= $base ?>/<?= $prefix ?>/versions']").each(function(){ 
			this.href = this.href.replace("<?= $base ?>/<?= $prefix ?>/versions", "<?= $base ?>/<?= $prefix ?>/versions?page=1");
		});
<?php } ?>

	});
	<?php $this->Html->scriptEnd(); ?>
