<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MulticastSource[]|\Cake\Collection\CollectionInterface $multicastSources
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
	$config['index_show_pos'] 		= true;
	$config['index_show_counts'] 		= true;
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

	if(!isset($layoutMulticastSourcesLastId)){
		$layoutMulticastSourcesLastId = 0;
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
			  
				<?php //= __('MulticastSources') ?>	
				<div class="card-body table-responsive p-0 multicastSources">
<?php //debug($session->read()); ?>
					<table class="table table-hover table-striped table-bordered text-nowrap">
						<thead>
							<tr>
								<th class="row-id-anchor"></th>
<?php if(isset($config['index_show_id']) && $config['index_show_id']){ ?>
								<th class="id integer"><?= $this->Paginator->sort('id') ?></th>
<?php } ?>
								<th class="name string" style="width: 300px;"><?= $this->Paginator->sort('name') ?></th>
								<th class="src-ip string text-center" style="width: 160px;"><?= $this->Paginator->sort('src_ip') ?></th>
								<th class="dest-ip string text-center" style="width: 160px;"><?= $this->Paginator->sort('dest_ip') ?></th>
								<th class="port string text-center" style="width: 160px;"><?= $this->Paginator->sort('port') ?></th>
								<th class="interface string text-center" style="width: 160px;"><?= $this->Paginator->sort('interface') ?></th>
								<th class="provider string"><?= $this->Paginator->sort('provider') ?></th>
<?php if(isset($config['index_show_counts']) && $config['index_show_counts']){ ?>
								<th class="packages-programs-digital-count integer"><?= $this->Paginator->sort('packages_programs_digital_count') ?></th>
<?php } ?>
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
					<?php foreach ($multicastSources as $multicastSource): ?>
							<tr row-id="<?= $multicastSource->id ?>"<?php if($multicastSource->id == $layoutMulticastSourcesLastId){ echo ' class="table-tr-last-id"'; } ?>  prefix="<?= $prefix ?>" controller="<?= $controller ?>" action="<?= $action ?>" aria-expanded="true">
								<td class="row-id-anchor" value="<?= $multicastSource->id ?>"><a class="anchor" name="<?= $multicastSource->id ?>"></a></td><!-- bake-0 -->
<?php if(isset($config['index_show_id']) && $config['index_show_id']){ ?>
								<td class="id integer" name="id" value="<?= $this->Number->format($multicastSource->id) ?>"><?= $this->Number->format($multicastSource->id) ?></td><!-- bake-3 -->
<?php } ?>
								<td class="name string" name="name" value="<?= $multicastSource->name ?>"><?= h($multicastSource->name) ?></td><!-- bake-2 -->
								<td class="src-ip string text-center" name="src-ip" value="<?= $multicastSource->src_ip ?>"><?= h($multicastSource->src_ip) ?></td><!-- bake-2 -->
								<td class="dest-ip string text-center" name="dest-ip" value="<?= $multicastSource->dest_ip ?>"><?= h($multicastSource->dest_ip) ?></td><!-- bake-2 -->
								<td class="port string text-center" name="port" value="<?= $multicastSource->port ?>"><?= h($multicastSource->port) ?></td><!-- bake-2 -->
								<td class="interface string text-center" name="interface" value="<?= $multicastSource->interface ?>"><?= h($multicastSource->interface) ?></td><!-- bake-2 -->
								<td class="provider string" name="provider" value="<?= $multicastSource->provider ?>"><?= h($multicastSource->provider) ?></td><!-- bake-2 -->
<?php if(isset($config['index_show_counts']) && $config['index_show_counts']){ ?>
								<td class="programs-count integer" name="programs-count" value="<?= $this->Number->format($multicastSource->programs_count) ?>"><?= $this->Number->format($multicastSource->programs_count) ?></td><!-- bake-3 -->
<?php } ?>
<?php if(isset($config['index_show_visible']) && $config['index_show_visible']){ ?>
								<td class="visible boolean" name="visible" visible="<?= $multicastSource->visible ?>"><?= h($multicastSource->visible) ?></td><!-- bake-2 -->
<?php } ?><?php if(isset($config['index_show_pos']) && $config['index_show_pos']){ ?>
								<td class="pos integer" name="pos" value="<?= $this->Number->format($multicastSource->pos) ?>"><?= $this->Number->format($multicastSource->pos) ?></td><!-- bake-3 -->
<?php } ?>


<?php if(isset($config['index_show_created']) && $config['index_show_created'] || isset($config['index_show_modified']) && $config['index_show_modified']){ ?>
								<td class="datetime created-modified">
<?php 	if(isset($config['index_show_created']) && $config['index_show_created']){ ?>
									<?= h($multicastSource->created) ?>
<?php 	} ?>
<?php 	if(isset($config['index_show_created']) && $config['index_show_created'] && isset($config['index_show_modified']) && $config['index_show_modified']){ ?>
									<br>
<?php 	} ?>
<?php 	if(isset($config['index_show_modified']) && $config['index_show_modified']){ ?>
									<?= h($multicastSource->modified) ?>
<?php 	} ?>
								</td>
<?php } ?>


<?php if(isset($config['index_show_actions']) && $config['index_show_actions']){ ?>
								<td class="actions text-center">
<?php 	if(isset($config['index_enable_view']) && $config['index_enable_view']){ ?>					  
									<?= $this->Html->link('<i class="fas fa-eye"></i>', ['action' => 'view', $multicastSource->id], ['escape' => false, 'class' => 'btn btn-sm bg-gradient-warning action-button-view', 'data-bs-tooltip'=>'tooltip', 'data-bs-placement'=>'top', 'title' => __('View this record')]) ?>
<?php 	} ?>
<?php 	if(isset($config['index_enable_edit']) && $config['index_enable_edit']){ ?>					  
									<?= $this->Html->link('<i class="fas fa-edit"></i>', ['action' => 'edit', $multicastSource->id], ['escape' => false, 'class' => 'btn btn-sm bg-gradient-success action-button-edit', 'data-bs-tooltip'=>'tooltip', 'data-bs-placement'=>'top', 'title' => __('Edit this record')]) ?>
<?php 	} ?>			
<?php 	if($multicastSource->programs_count == 0 && $multicastSource->packages_programs_digital_count == 0 && isset($config['index_enable_delete']) && $config['index_enable_delete']){ ?>					  
									<?php //= $this->Form->postLink('<i class="fas fa-remove"></i>', ['action' => 'delete', $multicastSource->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $multicastSource->id), 'class' => 'btn btn-sm bg-gradient-danger action-button-delete']) ?>						
									<?= $this->Form->postLink('', ['action' => 'delete', $multicastSource->id], ['class'=>'crose-btn hide-postlink action-button-delete']) ?>
									<a href="javascript:;" class="btn btn-sm btn-danger delete postlink-delete" data-bs-tooltip="tooltip" data-bs-placement="top" title="<?= __("Delete this record!") ?>" text="<?= h($multicastSource->name) ?>" subText="<?= __("You will not be able to revert this!") ?>" confirmButtonText="<?= __("Yes, delete it!") ?>" cancelButtonText="<?= __("Cancel") ?>"><i class="icon-minus"></i></a>
									
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
<?php $url = $this->Url->build(['controller' => 'MulticastSources', 'action' => $config['index_db_click_action']]); ?>
		$('tr').dblclick( function(){
<?php /* window.location.href = '/<?= $prefix ?>/multicastSources/<?= $config['index_db_click_action'] ?>/'+$(this).attr('row-id'); */ ?>
			window.location.href = '<?= $url . '/' ?>' + $(this).attr('row-id');
		});
<?php 	} ?>
<?php //} ?>

<?php /*
	https://stackoverflow.com/questions/179713/how-to-change-the-href-attribute-for-a-hyperlink-using-jquery  -->
	A pagin??ci??, ha a routerben szerepel az oldal f??oldalk??nt, akkor kell mert sessionben t??rol??dik n??h??ny dolog ??s...
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
		$(".pagination a[href^='<?= $base ?>/<?= $prefix ?>/multicastSources?sort=']").each(function(){ 
			this.href = this.href.replace("<?= $base ?>/<?= $prefix ?>/multicastSources?sort=", "<?= $base ?>/<?= $prefix ?>/multicastSources?page=1&sort=");
		});
		$(".pagination a[href='<?= $base ?>/<?= $prefix ?>/multicastSources']").each(function(){ 
			this.href = this.href.replace("<?= $base ?>/<?= $prefix ?>/multicastSources", "<?= $base ?>/<?= $prefix ?>/multicastSources?page=1");
		});
<?php } ?>

	});
	<?php $this->Html->scriptEnd(); ?>
