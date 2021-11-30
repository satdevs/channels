<?php // Baked at 2021.10.29. 10:29:45  ?>
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Headstation $headstation
 */
	use Cake\Core\Configure;

	$session 			= $this->getRequest()->getSession();
	$prefix 			= strtolower( $this->request->getParam('prefix') );	
	$controller 		= $this->request->getParam('controller');	// for DB click on <tr>
	$action 			= $this->request->getParam('action');		// for DB click on <tr>
	//$passedArgs 		= $this->request->getParam('pass');			// for DB click on <tr>
	
	$config = Configure::read('Theme.' . $prefix);	
	//-------> More config from \config\jeffadmin.php <------
	//$config['index_show_id'] 			= true;
	//
	//$url = $this->Url->build(['prefix' => $prefix, 'controller' => $controller , 'action' => $config['index_db_click_action']]);

	if(!isset($layoutHeadstationsLastId)){
		$layoutHeadstationsLastId = 0;
	}
	
?>
		<div class="view col-sm-10 headstations">
			<div class="card card-lightblue">
				<div class="card-header">
					<h3 class="card-title"><?= $title ?>: <?= h($headstation->name) ?></h3>
				</div><!-- /.card-header -->
				<div class="card-body">
				
					<div class="form-group row">
						<label for="name" class="col-sm-2 col-form-label"><?= __('id') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field non-associated">
								<?= $headstation->id ?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 2. -->
						<label for="name" class="col-sm-2 col-form-label"><?= __('Name') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field non-associated">
								<?php 
									if(!empty($headstation->name)){
										echo h($headstation->name);
									}else{
										echo "&nbsp;";
									}
								?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 2. -->
						<label for="place" class="col-sm-2 col-form-label"><?= __('Place') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field non-associated">
								<?php 
									if(!empty($headstation->place)){
										echo h($headstation->place);
									}else{
										echo "&nbsp;";
									}
								?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 2. -->
						<label for="last-sentence" class="col-sm-2 col-form-label"><?= __('Last Sentence') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field non-associated">
								<?php 
									if(!empty($headstation->last_sentence)){
										echo h($headstation->last_sentence);
									}else{
										echo "&nbsp;";
									}
								?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 2. -->
						<label for="last-digital-sentence" class="col-sm-2 col-form-label"><?= __('Last Digital Sentence') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field non-associated">
								<?php 
									if(!empty($headstation->last_digital_sentence)){
										echo h($headstation->last_digital_sentence);
									}else{
										echo "&nbsp;";
									}
								?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 4. -->
						<label for="package-count" class="col-sm-2 col-form-label"><?= __('Package Count') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field number">
								<?php
									if(!empty($headstation->package_count)){
										echo $this->Number->format($headstation->package_count);
									}else{
										echo "&nbsp;";
									}
								?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 4. -->
						<label for="city-count" class="col-sm-2 col-form-label"><?= __('City Count') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field number">
								<?php
									if(!empty($headstation->city_count)){
										echo $this->Number->format($headstation->city_count);
									}else{
										echo "&nbsp;";
									}
								?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 4. -->
						<label for="pos" class="col-sm-2 col-form-label"><?= __('Pos') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field number">
								<?php
									if(!empty($headstation->pos)){
										echo $this->Number->format($headstation->pos);
									}else{
										echo "&nbsp;";
									}
								?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 5. -->
						<label for="created" class="col-sm-2 col-form-label"><?= __('Created') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field date">
								<?php
									if(!empty($headstation->created)){
										echo h($headstation->created);
									}else{
										echo "&nbsp;";
									}
								?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 5. -->
						<label for="modified" class="col-sm-2 col-form-label"><?= __('Modified') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field date">
								<?php
									if(!empty($headstation->modified)){
										echo h($headstation->modified);
									}else{
										echo "&nbsp;";
									}
								?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 7. -->
						<label for="comment" class="col-sm-2 col-form-label"><?= __('Comment') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field text show-more">
								<?php // $this->Text->autoParagraph(h($headstation->comment)); ?>
								<?php
									if(!empty($headstation->comment)){
										//echo $this->Text->autoParagraph($headstation->comment) . "<br>";
										echo $headstation->comment . "<br>";
									}else{
										echo "&nbsp;";
									}
								?>
							</div>
						</div>
					</div>
	
				</div><!-- /.card-body -->
				
				<div class="card-footer">
					<?= $this->Html->link('<span class="btn-label"><i class="fa fa-arrow-left"></i></span>' . __('Back to list'), ['action' => 'index', '#' => $id], ['class'=>'offset-sm-2 btn btn-info', 'role'=>'button', 'escape'=>false,  'data-bs-tooltip'=>'tooltip', 'data-bs-placement'=>'top', 'title' => __('Back to list') ] ) ?>
				</div><!-- /.card-footer -->
				
			</div><!-- /. card -->
		</div><!-- /. col-sm-10 -->
		<!-- ################################################################################################################ -->

		<!-- ################################################################################################################ -->
		<div class="col-12">
			<div class="card card-primary card-outline card-outline-tabs">

				<div class="card-header p-0 border-bottom-0">
					<ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
						<li class="pt-2 px-3">
							<h3 class="card-title" style="font-size: 22px;"><?= __('Related tables') ?></h3>
						</li>
<?php if (!empty($headstation->cities)) : ?>
						<li class="nav-item view-tab">
							<a class="nav-link active" id="related-tab-cities" data-toggle="pill" href="#tab-cities" role="tab" aria-controls="aria-tab-cities" aria-selected="true"><?= __('Cities') ?></a>
						</li>
<?php endif; ?>
<?php if (!empty($headstation->packages)) : ?>
						<li class="nav-item view-tab">
							<a class="nav-link" id="related-tab-packages" data-toggle="pill" href="#tab-packages" role="tab" aria-controls="aria-tab-packages" aria-selected="false"><?= __('Packages') ?></a>
						</li>
<?php endif; ?>
<?php if (!empty($headstation->versions)) : ?>
						<li class="nav-item view-tab">
							<a class="nav-link" id="related-tab-versions" data-toggle="pill" href="#tab-versions" role="tab" aria-controls="aria-tab-versions" aria-selected="false"><?= __('Versions') ?></a>
						</li>
<?php endif; ?>
					</ul>
				</div>


				<div class="card-body p-0">
					<div class="tab-content" id="custom-tabs-four-tabContent">
<?php if (!empty($headstation->cities)) : ?>
						<div class="tab-pane fade active show" id="tab-cities" role="tabpanel" aria-labelledby="aria-tab-cities">
<?php /* */ ?>



							<div class="col-12 table-responsive p-0">

								<table class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th class="Name"><?= __('Name') ?></th>
											<th class="Comment"><?= __('Comment') ?></th>
											<th class="boolean visible"><?= __('Visible') ?></th>
											<th class="integer pos"><?= __('Pos') ?></th>
											<th class="created"><?= __('Created') ?></th>
											<th class="modified"><?= __('Modified') ?></th>
<?php if(isset($config['index_show_actions']) && $config['index_show_actions']){ ?>
											<th class="actions"><?= __('Actions') ?></th>
<?php } ?>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($headstation->cities as $cities) : ?>
										<tr aria-expanded="true">
											<td class="name"><?= h($cities->name) ?></td>
											<td class="comment"><?= h($cities->comment) ?></td>
											<td class="boolean visible" visible="<?= h($cities->visible) ?>"><?= h($cities->visible) ?></td>
											<td class="pos"><?= h($cities->pos) ?></td>
											<td class="created"><?= h($cities->created) ?></td>
											<td class="modified"><?= h($cities->modified) ?></td>
<?php if($config['index_show_actions'] !== null && $config['index_show_actions']){ ?>
											<td class="actions text-center">
<?php 	if($config['index_enable_view'] !== null && $config['index_enable_view']){ ?>					  
												<?= $this->Html->link('<i class="fas fa-eye"></i>', ['controller' => 'Cities', 'action' => 'view', $cities->id], ['escape' => false, 'class' => 'btn btn-sm bg-gradient-warning action-button-view', 'data-bs-tooltip'=>'tooltip', 'data-bs-placement'=>'top', 'title' => __('View this record')]) ?>
<?php 	} ?>
<?php 	if($config['index_enable_edit'] !== null && $config['index_enable_edit']){ ?>					  
												<?= $this->Html->link('<i class="fas fa-edit"></i>', ['controller' => 'Cities', 'action' => 'edit', $cities->id], ['escape' => false, 'class' => 'btn btn-sm bg-gradient-success action-button-edit', 'data-bs-tooltip'=>'tooltip', 'data-bs-placement'=>'top', 'title' => __('Edit this record')]) ?>
<?php 	} ?>			
<?php 	if($config['index_enable_delete'] !== null && $config['index_enable_delete']){ ?>					  
												<?php //= $this->Form->postLink('<i class="fas fa-remove"></i>', ['action' => 'delete', $headstation->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $headstation->id), 'class' => 'btn btn-sm bg-gradient-danger action-button-delete']) ?>						
												<?= $this->Form->postLink('', ['controller' => 'Cities', 'action' => 'delete', $cities->id], ['class'=>'crose-btn hide-postlink action-button-delete']) ?>
												<a href="javascript:;" class="btn btn-sm btn-danger delete postlink-delete" data-bs-tooltip="tooltip" data-bs-placement="top" title="<?= __("Delete this record!") ?>" text="<?= h($cities->name) ?>" subText="<?= __("You will not be able to revert this!") ?>" confirmButtonText="<?= __("Yes, delete it!") ?>" cancelButtonText="<?= __("Cancel") ?>"><i class="icon-minus"></i></a>
<?php 	} ?>
											</td>					  
<?php } ?>	
										</tr>
										<?php endforeach; ?>
									</tbody>
								</table>

								<div class="card-footer clearfix">
									&nbsp;
								</div>			  

							</div><!-- /.card -->

						</div>
<?php endif; ?>
<?php if (!empty($headstation->packages)) : ?>
						<div class="tab-pane fade" id="tab-packages" role="tabpanel" aria-labelledby="aria-tab-packages">
<?php /* */ ?>



							<div class="col-12 table-responsive p-0">

								<table class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th class="Broadcast"><?= __('Broadcast') ?></th>
											<th class="PackageGroup"><?= __('PackageGroup') ?></th>
											<th class="Name"><?= __('Name') ?></th>
											<th class="Popular Name"><?= __('Popular Name') ?></th>
											<th class="Price"><?= __('Price') ?></th>
											<th class="boolean visible"><?= __('Visible') ?></th>
											<th class="pos"><?= __('Pos') ?></th>
											<th class="integer"><?= __('Programs Count') ?></th>
											<th class="created"><?= __('Created') ?></th>
											<th class="modified"><?= __('Modified') ?></th>
<?php if(isset($config['index_show_actions']) && $config['index_show_actions']){ ?>
											<th class="actions"><?= __('Actions') ?></th>
<?php } ?>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($headstation->packages as $packages) : ?>
										<tr aria-expanded="true">
											<td class="broadcast"><?= $broadcasts[$packages->broadcast] ?></td>
											<td class="packageGroup"><?= h($packages->packagegroup->name) ?></td>
											<td class="name"><?= h($packages->name) ?></td>
											<td class="popular-name"><?= h($packages->popular_name) ?></td>
											<td class="price"><?= h($packages->price) ?></td>
											<td class="boolean visible" visible="<?= h($packages->visible) ?>"><?= h($packages->visible) ?></td>
											<td class="integer pos"><?= h($packages->pos) ?></td>
											<td class="integer programs-count"><?= h($packages->programs_count) ?></td>
											<td class="created"><?= h($packages->created) ?></td>
											<td class="modified"><?= h($packages->modified) ?></td>
<?php if($config['index_show_actions'] !== null && $config['index_show_actions']){ ?>
											<td class="actions text-center">
<?php 	if($config['index_enable_view'] !== null && $config['index_enable_view']){ ?>					  
												<?= $this->Html->link('<i class="fas fa-eye"></i>', ['controller' => 'Packages', 'action' => 'view', $packages->id], ['escape' => false, 'class' => 'btn btn-sm bg-gradient-warning action-button-view', 'data-bs-tooltip'=>'tooltip', 'data-bs-placement'=>'top', 'title' => __('View this record')]) ?>
<?php 	} ?>
<?php 	if($config['index_enable_edit'] !== null && $config['index_enable_edit']){ ?>					  
												<?= $this->Html->link('<i class="fas fa-edit"></i>', ['controller' => 'Packages', 'action' => 'edit', $packages->id], ['escape' => false, 'class' => 'btn btn-sm bg-gradient-success action-button-edit', 'data-bs-tooltip'=>'tooltip', 'data-bs-placement'=>'top', 'title' => __('Edit this record')]) ?>
<?php 	} ?>			
<?php 	if($config['index_enable_delete'] !== null && $config['index_enable_delete']){ ?>					  
												<?php //= $this->Form->postLink('<i class="fas fa-remove"></i>', ['action' => 'delete', $headstation->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $headstation->id), 'class' => 'btn btn-sm bg-gradient-danger action-button-delete']) ?>						
												<?= $this->Form->postLink('', ['controller' => 'Packages', 'action' => 'delete', $packages->id], ['class'=>'crose-btn hide-postlink action-button-delete']) ?>
												<a href="javascript:;" class="btn btn-sm btn-danger delete postlink-delete" data-bs-tooltip="tooltip" data-bs-placement="top" title="<?= __("Delete this record!") ?>" text="<?= h($packages->name) ?>" subText="<?= __("You will not be able to revert this!") ?>" confirmButtonText="<?= __("Yes, delete it!") ?>" cancelButtonText="<?= __("Cancel") ?>"><i class="icon-minus"></i></a>
<?php 	} ?>
											</td>					  
<?php } ?>	
										</tr>
										<?php endforeach; ?>
									</tbody>
								</table>

								<div class="card-footer clearfix">
									&nbsp;
								</div>			  

							</div><!-- /.card -->

						</div>
<?php endif; ?>
<?php if (!empty($headstation->versions)) : ?>
						<div class="tab-pane fade" id="tab-versions" role="tabpanel" aria-labelledby="aria-tab-versions">
<?php /* */ ?>



							<div class="col-12 table-responsive p-0">

								<table class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th class="Id"><?= __('Id') ?></th>
											<th class="Headstation Id"><?= __('Headstation Id') ?></th>
											<th class="Name"><?= __('Name') ?></th>
											<th class="Comment"><?= __('Comment') ?></th>
											<th class="Current"><?= __('Current') ?></th>
											<th class="Date From"><?= __('Date From') ?></th>
											<th class="Date To"><?= __('Date To') ?></th>
											<th class="Visible"><?= __('Visible') ?></th>
											<th class="Pos"><?= __('Pos') ?></th>
											<th class="Created"><?= __('Created') ?></th>
											<th class="Modified"><?= __('Modified') ?></th>
<?php if(isset($config['index_show_actions']) && $config['index_show_actions']){ ?>
											<th class="actions"><?= __('Actions') ?></th>
<?php } ?>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($headstation->versions as $versions) : ?>
										<tr aria-expanded="true">
											<td class="id"><?= h($versions->id) ?></td>
											<td class="headstation-id"><?= h($versions->headstation_id) ?></td>
											<td class="name"><?= h($versions->name) ?></td>
											<td class="comment"><?= h($versions->comment) ?></td>
											<td class="boolean current" value="<?= h($versions->current) ?>"><?= h($versions->current) ?></td>
											<td class="date-from"><?= h($versions->date_from) ?></td>
											<td class="date-to"><?= h($versions->date_to) ?></td>
											<td class="boolean visible" visible="<?= h($versions->visible) ?>"><?= h($versions->visible) ?></td>
											<td class="pos"><?= h($versions->pos) ?></td>
											<td class="created"><?= h($versions->created) ?></td>
											<td class="modified"><?= h($versions->modified) ?></td>
<?php if($config['index_show_actions'] !== null && $config['index_show_actions']){ ?>
											<td class="actions text-center">
<?php 	if($config['index_enable_view'] !== null && $config['index_enable_view']){ ?>					  
												<?= $this->Html->link('<i class="fas fa-eye"></i>', ['controller' => 'Versions', 'action' => 'view', $versions->id], ['escape' => false, 'class' => 'btn btn-sm bg-gradient-warning action-button-view', 'data-bs-tooltip'=>'tooltip', 'data-bs-placement'=>'top', 'title' => __('View this record')]) ?>
<?php 	} ?>
<?php 	if($config['index_enable_edit'] !== null && $config['index_enable_edit']){ ?>					  
												<?= $this->Html->link('<i class="fas fa-edit"></i>', ['controller' => 'Versions', 'action' => 'edit', $versions->id], ['escape' => false, 'class' => 'btn btn-sm bg-gradient-success action-button-edit', 'data-bs-tooltip'=>'tooltip', 'data-bs-placement'=>'top', 'title' => __('Edit this record')]) ?>
<?php 	} ?>			
<?php 	if($config['index_enable_delete'] !== null && $config['index_enable_delete']){ ?>					  
												<?php //= $this->Form->postLink('<i class="fas fa-remove"></i>', ['action' => 'delete', $headstation->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $headstation->id), 'class' => 'btn btn-sm bg-gradient-danger action-button-delete']) ?>						
												<?= $this->Form->postLink('', ['controller' => 'Versions', 'action' => 'delete', $versions->id], ['class'=>'crose-btn hide-postlink action-button-delete']) ?>
												<a href="javascript:;" class="btn btn-sm btn-danger delete postlink-delete" data-bs-tooltip="tooltip" data-bs-placement="top" title="<?= __("Delete this record!") ?>" text="<?= h($versions->name) ?>" subText="<?= __("You will not be able to revert this!") ?>" confirmButtonText="<?= __("Yes, delete it!") ?>" cancelButtonText="<?= __("Cancel") ?>"><i class="icon-minus"></i></a>
<?php 	} ?>
											</td>					  
<?php } ?>	
										</tr>
										<?php endforeach; ?>
									</tbody>
								</table>

								<div class="card-footer clearfix">
									&nbsp;
								</div>			  

							</div><!-- /.card -->

						</div>
<?php endif; ?>

					</div>
				</div><!-- /.card -->
			</div>
		</div>

<!-- ######################################################################################################################## -->
<!-- ######################################################################################################################## -->
<!-- ######################################################################################################################## -->

<?php
	$this->Html->css(
		[
			'JeffAdmin./plugins/multiline-truncation-ellipsis-toggle/src/index',
			'JeffAdmin./plugins/Collapse-Long-Content-View-More-jQuery/showmore-default',
		],
		['block' => true]
	);

	$this->Html->script(
		[
			'JeffAdmin./plugins/multiline-truncation-ellipsis-toggle/src/jquery.multiTextToggleCollapse',
			'JeffAdmin./plugins/Collapse-Long-Content-View-More-jQuery/jquery.show-more',			
			'JeffAdmin./dist/js/sweetalert_delete',
		],
		['block' => 'scriptBottom']
	);
?>

<?php $this->Html->scriptStart(['block' => 'javaScriptBottom']); ?>

	$(document).ready( function(){
		//$(".view .text").multiTextToggleCollapse({
		//	line:4
		//});
		
		$('.show-more').showMore({
			minheight: 100,
			buttontxtmore: '<?= __('&darr;&nbsp;more content&nbsp;&darr;') ?>',
			buttontxtless: '<?= __('&uarr;&nbsp;less content&nbsp;&uarr;') ?>',
			//buttoncss: 'my-button-css',
			animationspeed: 250
		});
		
	});

<?php $this->Html->scriptEnd(); ?>

