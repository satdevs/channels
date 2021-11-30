<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Package[]|\Cake\Collection\CollectionInterface $packages
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
	//$config['index_show_visible'] 	= true;
	$config['index_show_pos'] 		= true;
	//$config['index_show_counts'] 		= true;	// Nem működik a dupla kapcsolat maiott egyelőre. Na majd legközelebb...
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

	if(!isset($layoutPackagesLastId)){
		$layoutPackagesLastId = 0;
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
			  
				<?php //= __('Packages') ?>	
				<div class="card-body table-responsive p-0 packages">
<?php //debug($session->read()); ?>
					<table class="table table-hover table-striped table-bordered text-nowrap">
						<thead>
							<tr>
								<th class="row-id-anchor"></th>
<?php if(isset($config['index_show_id']) && $config['index_show_id']){ ?>
								<th class="id integer"><?= $this->Paginator->sort('id') ?></th>
<?php } ?>
								<!--th class="headstation-name string"><?= $this->Paginator->sort('headstation_id') ?></th-->
								<th class="packagegroup-id integer" style="width: 165px;"><?= $this->Paginator->sort('packagegroup_id') ?></th>
<?php /*
								<th class="encoded string"><?= $this->Paginator->sort('encoded') ?></th>
*/ ?>
								<th class="broadcast string text-center"><?= $this->Paginator->sort('broadcast') ?></th>
								<th class="name string"><?= $this->Paginator->sort('name') ?></th>
								<th class="shortname string"><?= $this->Paginator->sort('shortname') ?></th>
								<th class="popular-name string"><?= $this->Paginator->sort('popular_name') ?></th>
<?php /*		
								<th class="external-name string"><?= $this->Paginator->sort('external_name') ?></th>
								<th class="popular-comment-analog string"><?= $this->Paginator->sort('popular_comment_analog') ?></th>
								<th class="popular-comment-digital string"><?= $this->Paginator->sort('popular_comment_digital') ?></th>
*/ ?>
								<th class="price integer"><?= $this->Paginator->sort('price') ?></th>
<?php if(isset($config['index_show_visible']) && $config['index_show_visible']){ ?>
								<th class="visible boolean"><?= $this->Paginator->sort('visible') ?></th>
<?php } ?>
<?php if(isset($config['index_show_pos']) && $config['index_show_pos']){ ?>
								<th class="pos integer"><?= $this->Paginator->sort('pos') ?></th>
<?php } ?>
<?php if(isset($config['index_show_counts']) && $config['index_show_counts']){ ?>
								<th class="program-count integer text-center"><?= $this->Paginator->sort('program_count') ?></th>
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
					<?php foreach ($packages as $package): ?>
							<tr row-id="<?= $package->id ?>"<?php if($package->id == $layoutPackagesLastId){ echo ' class="table-tr-last-id"'; } ?>  prefix="<?= $prefix ?>" controller="<?= $controller ?>" action="<?= $action ?>" aria-expanded="true">
								<td class="row-id-anchor" value="<?= $package->id ?>"><a class="anchor" name="<?= $package->id ?>"></a></td><!-- bake-0 -->
<?php if(isset($config['index_show_id']) && $config['index_show_id']){ ?>
								<td class="id integer" name="id" value="<?= $this->Number->format($package->id) ?>"><?= $this->Number->format($package->id) ?></td><!-- bake-3 -->
<?php } ?>
								<!--td class="headstation-name string link text-left" value="<?= $package->headstation->name ?>"><?= $package->has('headstation') ? $this->Html->link($package->headstation->name, ['controller' => 'Headstations', 'action' => 'view', $package->headstation->id]) : '' ?></td-->
								<td class="packagegroup-id integer link text-left" value="<?= $package->packagegroup_id ?>"><?= $package->has('packagegroup') ? $this->Html->link($package->packagegroup->name, ['controller' => 'Packagegroups', 'action' => 'view', $package->packagegroup->id]) : '' ?></td><!-- bake-1 -->
<?php /*
								<td class="encoded string" name="encoded" value="<?= $package->encoded ?>"><?= h($package->encoded) ?></td><!-- bake-2 -->
*/ ?>
								<td class="broadcast string text-center" name="broadcast" value="<?= $package->broadcast ?>"><?= $broadcasts[$package->broadcast] ?></td><!-- bake-2 -->
								<td class="name string" name="name" value="<?= $package->name ?>"><?= h($package->name) ?></td><!-- bake-2 -->
								<td class="shortname string" name="shortname" value="<?= $package->shortname ?>"><?= h($package->shortname) ?></td><!-- bake-2 -->
								<td class="popular-name string" name="popular-name" value="<?= $package->popular_name ?>"><?= h($package->popular_name) ?></td><!-- bake-2 -->
<?php /*
								<td class="external-name string" name="external-name" value="<?= $package->external_name ?>"><?= h($package->external_name) ?></td><!-- bake-2 -->
								<td class="popular-comment-analog string" name="popular-comment-analog" value="<?= $package->popular_comment_analog ?>"><?= h($package->popular_comment_analog) ?></td><!-- bake-2 -->
								<td class="popular-comment-digital string" name="popular-comment-digital" value="<?= $package->popular_comment_digital ?>"><?= h($package->popular_comment_digital) ?></td><!-- bake-2 -->
*/ ?>								
								<td class="price integer" name="price" value="<?= $this->Number->format($package->price) ?>"><?= $this->Number->format($package->price) ?></td><!-- bake-3 -->
<?php if(isset($config['index_show_visible']) && $config['index_show_visible']){ ?>
								<td class="visible boolean" name="visible" value="<?= $package->visible ?>"><?= h($package->visible) ?></td><!-- bake-2 -->
<?php } ?>
<?php if(isset($config['index_show_pos']) && $config['index_show_pos']){ ?>
								<td class="pos integer" name="pos" value="<?= $this->Number->format($package->pos) ?>"><?= $this->Number->format($package->pos) ?></td><!-- bake-3 -->
<?php } ?>
<?php if(isset($config['index_show_counts']) && $config['index_show_counts']){ ?>
								<td class="program-count integer text-center" name="program-count" value="<?= $this->Number->format($package->program_count) ?>"><?= $this->Number->format($package->program_count) ?></td><!-- bake-3 -->
<?php } ?>


<?php if(isset($config['index_show_created']) && $config['index_show_created'] || isset($config['index_show_modified']) && $config['index_show_modified']){ ?>
								<td class="datetime created-modified">
<?php 	if(isset($config['index_show_created']) && $config['index_show_created']){ ?>
									<?= h($package->created) ?>
<?php 	} ?>
<?php 	if(isset($config['index_show_created']) && $config['index_show_created'] && isset($config['index_show_modified']) && $config['index_show_modified']){ ?>
									<br>
<?php 	} ?>
<?php 	if(isset($config['index_show_modified']) && $config['index_show_modified']){ ?>
									<?= h($package->modified) ?>
<?php 	} ?>
								</td>
<?php } ?>


<?php if(isset($config['index_show_actions']) && $config['index_show_actions']){ ?>
								<td class="actions text-center">
<?php 	if(isset($config['index_enable_view']) && $config['index_enable_view']){ ?>					  
									<?= $this->Html->link('<i class="fas fa-eye"></i>', ['action' => 'view', $package->id], ['escape' => false, 'class' => 'btn btn-sm bg-gradient-warning action-button-view', 'data-bs-tooltip'=>'tooltip', 'data-bs-placement'=>'top', 'title' => __('View this record')]) ?>
<?php 	} ?>
<?php 	if(isset($config['index_enable_edit']) && $config['index_enable_edit']){ ?>					  
									<?= $this->Html->link('<i class="fas fa-edit"></i>', ['action' => 'edit', $package->id], ['escape' => false, 'class' => 'btn btn-sm bg-gradient-success action-button-edit', 'data-bs-tooltip'=>'tooltip', 'data-bs-placement'=>'top', 'title' => __('Edit this record')]) ?>
<?php 	} ?>			
<?php 	if(isset($config['index_enable_delete']) && $config['index_enable_delete']){ ?>					  
									<?php //= $this->Form->postLink('<i class="fas fa-remove"></i>', ['action' => 'delete', $package->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $package->id), 'class' => 'btn btn-sm bg-gradient-danger action-button-delete']) ?>						
									<?= $this->Form->postLink('', ['action' => 'delete', $package->id], ['class'=>'crose-btn hide-postlink action-button-delete']) ?>
									<a href="javascript:;" class="btn btn-sm btn-danger delete postlink-delete" data-bs-tooltip="tooltip" data-bs-placement="top" title="<?= __("Delete this record!") ?>" text="<?= h($package->name) ?>" subText="<?= __("You will not be able to revert this!") ?>" confirmButtonText="<?= __("Yes, delete it!") ?>" cancelButtonText="<?= __("Cancel") ?>"><i class="icon-minus"></i></a>
									
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
<?php $url = $this->Url->build(['controller' => 'Packages', 'action' => $config['index_db_click_action']]); ?>
		$('tr').dblclick( function(){
<?php /* window.location.href = '/<?= $prefix ?>/packages/<?= $config['index_db_click_action'] ?>/'+$(this).attr('row-id'); */ ?>
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
		$(".pagination a[href^='<?= $base ?>/<?= $prefix ?>/packages?sort=']").each(function(){ 
			this.href = this.href.replace("<?= $base ?>/<?= $prefix ?>/packages?sort=", "<?= $base ?>/<?= $prefix ?>/packages?page=1&sort=");
		});
		$(".pagination a[href='<?= $base ?>/<?= $prefix ?>/packages']").each(function(){ 
			this.href = this.href.replace("<?= $base ?>/<?= $prefix ?>/packages", "<?= $base ?>/<?= $prefix ?>/packages?page=1");
		});
<?php } ?>

	});
	<?php $this->Html->scriptEnd(); ?>
