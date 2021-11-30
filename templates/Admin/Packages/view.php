<?php // Baked at 2021.11.04. 11:30:15  ?>
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Package $package
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

	if(!isset($layoutPackagesLastId)){
		$layoutPackagesLastId = 0;
	}
	
?>
		<div class="view col-sm-10 packages">
			<div class="card card-lightblue">
				<div class="card-header">
					<h3 class="card-title"><?= $title ?>: <?= h($package->name) ?></h3>
				</div><!-- /.card-header -->
				<div class="card-body">
				
					<div class="form-group row">
						<label for="name" class="col-sm-2 col-form-label"><?= __('id') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field non-associated">
								<?= $package->id ?>
							</div>
						</div>
					</div>
					<div class="form-group row"><!-- 1. -->
						<label for="name" class="col-sm-2 col-form-label"><?= __('Version') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field associated">
								<?= $package->has('version') ? $this->Html->link($package->version->name, ['controller' => 'Versions', 'action' => 'view', $package->version->id], ['escape' => false, 'class' => 'btn btn-sm btn-default']) : '&nbsp;' ?>
							</div>
						</div>
					</div>
					<div class="form-group row"><!-- 1. -->
						<label for="name" class="col-sm-2 col-form-label"><?= __('Headstation') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field associated">
								<?= $package->has('headstation') ? $this->Html->link($package->headstation->name, ['controller' => 'Headstations', 'action' => 'view', $package->headstation->id], ['escape' => false, 'class' => 'btn btn-sm btn-default']) : '&nbsp;' ?>
							</div>
						</div>
					</div>
					<div class="form-group row"><!-- 1. -->
						<label for="name" class="col-sm-2 col-form-label"><?= __('Packagegroup') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field associated">
								<?= $package->has('packagegroup') ? $this->Html->link($package->packagegroup->name, ['controller' => 'Packagegroups', 'action' => 'view', $package->packagegroup->id], ['escape' => false, 'class' => 'btn btn-sm btn-default']) : '&nbsp;' ?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 2. -->
						<label for="broadcast" class="col-sm-2 col-form-label"><?= __('Broadcast') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field non-associated">
								<?php 
									if(!empty($package->broadcast)){
										echo h($package->broadcast);
									}else{
										echo "&nbsp;";
									}
								?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 2. -->
						<label for="name" class="col-sm-2 col-form-label"><?= __('Name') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field non-associated">
								<?php 
									if(!empty($package->name)){
										echo h($package->name);
									}else{
										echo "&nbsp;";
									}
								?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 2. -->
						<label for="shortname" class="col-sm-2 col-form-label"><?= __('Shortname') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field non-associated">
								<?php 
									if(!empty($package->shortname)){
										echo h($package->shortname);
									}else{
										echo "&nbsp;";
									}
								?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 2. -->
						<label for="popular-name" class="col-sm-2 col-form-label"><?= __('Popular Name') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field non-associated">
								<?php 
									if(!empty($package->popular_name)){
										echo h($package->popular_name);
									}else{
										echo "&nbsp;";
									}
								?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 2. -->
						<label for="external-name" class="col-sm-2 col-form-label"><?= __('External Name') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field non-associated">
								<?php 
									if(!empty($package->external_name)){
										echo h($package->external_name);
									}else{
										echo "&nbsp;";
									}
								?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 2. -->
						<label for="popular-comment-analog" class="col-sm-2 col-form-label"><?= __('Popular Comment Analog') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field non-associated">
								<?php 
									if(!empty($package->popular_comment_analog)){
										echo h($package->popular_comment_analog);
									}else{
										echo "&nbsp;";
									}
								?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 2. -->
						<label for="popular-comment-digital" class="col-sm-2 col-form-label"><?= __('Popular Comment Digital') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field non-associated">
								<?php 
									if(!empty($package->popular_comment_digital)){
										echo h($package->popular_comment_digital);
									}else{
										echo "&nbsp;";
									}
								?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 4. -->
						<label for="price" class="col-sm-2 col-form-label"><?= __('Price') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field number">
								<?php
									if(!empty($package->price)){
										echo $this->Number->format($package->price);
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
									if(!empty($package->pos)){
										echo $this->Number->format($package->pos);
									}else{
										echo "&nbsp;";
									}
								?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 4. -->
						<label for="program-count" class="col-sm-2 col-form-label"><?= __('Program Count') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field number">
								<?php
									if(!empty($package->program_count)){
										echo $this->Number->format($package->program_count);
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
									if(!empty($package->created)){
										echo h($package->created);
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
									if(!empty($package->modified)){
										echo h($package->modified);
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
								<?php // $this->Text->autoParagraph(h($package->comment)); ?>
								<?php
									if(!empty($package->comment)){
										//echo $this->Text->autoParagraph($package->comment) . "<br>";
										echo $package->comment . "<br>";
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
<?php if (!empty($package->programs)): ?>
						<li class="nav-item view-tab">
							<a class="nav-link active" id="related-tab-programs" data-toggle="pill" href="#tab-programs" role="tab" aria-controls="aria-tab-programs" aria-selected="true"><?= __('Programs') ?></a>
						</li>
<?php endif; ?>
<?php if (!empty($package->packages_programs_analogs)): ?>
						<li class="nav-item view-tab">
							<a class="nav-link" id="related-tab-packages-programs-analogs" data-toggle="pill" href="#tab-packages-programs-analogs" role="tab" aria-controls="aria-tab-packages-programs-analogs" aria-selected="false"><?= __('Packages Programs Analogs') ?></a>
						</li>
<?php endif; ?>
<?php if (!empty($package->packages_programs_digitals)): ?>
						<li class="nav-item view-tab">
							<a class="nav-link" id="related-tab-packages-programs-digitals" data-toggle="pill" href="#tab-packages-programs-digitals" role="tab" aria-controls="aria-tab-packages-programs-digitals" aria-selected="false"><?= __('Packages Programs Digitals') ?></a>
						</li>
<?php endif; ?>
					</ul>
				</div>


				<div class="card-body p-0">
					<div class="tab-content" id="custom-tabs-four-tabContent">
<?php if (!empty($package->programs)): ?>
						<div class="tab-pane fade active show" id="tab-programs" role="tabpanel" aria-labelledby="aria-tab-programs">
<?php /* */ ?>



							<div class="col-12 table-responsive p-0">

								<table class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th class="name"><?= __('Name') ?></th>
											<th class="short-name"><?= __('Short Name') ?></th>
											<th class="new boolean text-center"><?= __('New') ?></th>
											<th class="visible boolean text-center"><?= __('Visible') ?></th>
											<th class="pos text-center"><?= __('Pos') ?></th>
											<th class="created">
												<?= __('Created') ?><br>
												<?= __('Modified') ?>
											</th>
<?php if(isset($config['index_show_actions']) && $config['index_show_actions']){ ?>
											<th class="actions"><?= __('Actions') ?></th>
<?php } ?>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($package->programs as $programs): ?>
										<tr aria-expanded="true">
											<td class="name"><?= h($programs->name) ?></td>
											<td class="short-name"><?= h($programs->short_name) ?></td>
											<td class="new boolean text-center" value="<?= h($programs->new) ?>"><?= h($programs->new) ?></td>
											<td class="visible boolean text-center" visible="<?= h($programs->visible) ?>"><?= h($programs->visible) ?></td>
											<td class="pos"><?= h($programs->pos) ?></td>
											<td class="created">
												<?= h($programs->created) ?><br>
												<?= h($programs->modified) ?>
											</td>
<?php if($config['index_show_actions'] !== null && $config['index_show_actions']){ ?>
											<td class="actions text-center">
<?php 	if($config['index_enable_view'] !== null && $config['index_enable_view']){ ?>					  
												<?= $this->Html->link('<i class="fas fa-eye"></i>', ['controller' => 'Programs', 'action' => 'view', $programs->id], ['escape' => false, 'class' => 'btn btn-sm bg-gradient-warning action-button-view', 'data-bs-tooltip'=>'tooltip', 'data-bs-placement'=>'top', 'title' => __('View this record')]) ?>
<?php 	} ?>
<?php 	if($config['index_enable_edit'] !== null && $config['index_enable_edit']){ ?>					  
												<?= $this->Html->link('<i class="fas fa-edit"></i>', ['controller' => 'Programs', 'action' => 'edit', $programs->id], ['escape' => false, 'class' => 'btn btn-sm bg-gradient-success action-button-edit', 'data-bs-tooltip'=>'tooltip', 'data-bs-placement'=>'top', 'title' => __('Edit this record')]) ?>
<?php 	} ?>			
<?php 	if($config['index_enable_delete'] !== null && $config['index_enable_delete']){ ?>					  
												<?php //= $this->Form->postLink('<i class="fas fa-remove"></i>', ['action' => 'delete', $package->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $package->id), 'class' => 'btn btn-sm bg-gradient-danger action-button-delete']) ?>						
												<?= $this->Form->postLink('', ['controller' => 'Programs', 'action' => 'delete', $programs->id], ['class'=>'crose-btn hide-postlink action-button-delete']) ?>
												<a href="javascript:;" class="btn btn-sm btn-danger delete postlink-delete" data-bs-tooltip="tooltip" data-bs-placement="top" title="<?= __("Delete this record!") ?>" text="<?= h($programs->name) ?>" subText="<?= __("You will not be able to revert this!") ?>" confirmButtonText="<?= __("Yes, delete it!") ?>" cancelButtonText="<?= __("Cancel") ?>"><i class="icon-minus"></i></a>
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
<?php if (!empty($package->packages_programs_analogs)): ?>
						<div class="tab-pane fade" id="tab-packages-programs-analogs" role="tabpanel" aria-labelledby="aria-tab-packages-programs-analogs">

							<div class="col-12 table-responsive p-0">

								<table class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th class="lcn text-center"><?= __('Lcn') ?></th>
											<th class="program-id"><?= __('Program') ?></th>
											<th class="band-id"><?= __('Band') ?></th>
											<th class="name"><?= __('Name') ?></th>
											<th class="comment"><?= __('Comment') ?></th>
											<th class="to-delete boolean"><?= __('To Delete') ?></th>
											<th class="visible boolean"><?= __('Visible') ?></th>
											<th class="pos text-center"><?= __('Pos') ?></th>
											<th class="created">
												<?= __('Created') ?><br>
												<?= __('Modified') ?>
											</th>
<?php if(isset($config['index_show_actions']) && $config['index_show_actions']){ ?>
											<th class="actions"><?= __('Actions') ?></th>
<?php } ?>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($package->packages_programs_analogs as $packagesProgramsAnalogs): ?>
										<tr aria-expanded="true">
											<td class="lcn text-center"><?= h($packagesProgramsAnalogs->lcn) ?></td>
											<td class="program-id"><?php
												echo h($packagesProgramsAnalogs->program->name);
												//h($packagesProgramsAnalogs->program->name)
											?></td>
											<td class="band-id"><?php
												echo h($packagesProgramsAnalogs->band->name)
												. ' • ' . h($packagesProgramsAnalogs->band->band)
												. ' • ' . h($packagesProgramsAnalogs->band->type)
												. ' • ' . $packagesProgramsAnalogs->band->frequency . ' Mhz ' 
												. ' • ' . h($packagesProgramsAnalogs->band->bandwidth) . ' Mhz ' ;
											?></td>
											<td class="name"><?= h($packagesProgramsAnalogs->name) ?></td>
											<td class="changed"><?= h($packagesProgramsAnalogs->changed) ?></td>
											<td class="to-delete boolean" to-delete="<?= h($packagesProgramsAnalogs->to_delete) ?>"><?= h($packagesProgramsAnalogs->to_delete) ?></td>
											<td class="visible boolean" visible="<?= h($packagesProgramsAnalogs->visible) ?>"><?= h($packagesProgramsAnalogs->visible) ?></td>
											<td class="pos text-center"><?= h($packagesProgramsAnalogs->pos) ?></td>
											<td class="created">
												<?= h($packagesProgramsAnalogs->created) ?><br>
												<?= h($packagesProgramsAnalogs->modified) ?>
											</td>
<?php if($config['index_show_actions'] !== null && $config['index_show_actions']){ ?>
											<td class="actions text-center">
<?php 	if($config['index_enable_view'] !== null && $config['index_enable_view']){ ?>					  
												<?= $this->Html->link('<i class="fas fa-eye"></i>', ['controller' => 'PackagesProgramsAnalogs', 'action' => 'view', $packagesProgramsAnalogs->id], ['escape' => false, 'class' => 'btn btn-sm bg-gradient-warning action-button-view', 'data-bs-tooltip'=>'tooltip', 'data-bs-placement'=>'top', 'title' => __('View this record')]) ?>
<?php 	} ?>
<?php 	if($config['index_enable_edit'] !== null && $config['index_enable_edit']){ ?>					  
												<?= $this->Html->link('<i class="fas fa-edit"></i>', ['controller' => 'PackagesProgramsAnalogs', 'action' => 'edit', $packagesProgramsAnalogs->id], ['escape' => false, 'class' => 'btn btn-sm bg-gradient-success action-button-edit', 'data-bs-tooltip'=>'tooltip', 'data-bs-placement'=>'top', 'title' => __('Edit this record')]) ?>
<?php 	} ?>			
<?php 	if($config['index_enable_delete'] !== null && $config['index_enable_delete']){ ?>					  
												<?php //= $this->Form->postLink('<i class="fas fa-remove"></i>', ['action' => 'delete', $package->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $package->id), 'class' => 'btn btn-sm bg-gradient-danger action-button-delete']) ?>						
												<?= $this->Form->postLink('', ['controller' => 'PackagesProgramsAnalogs', 'action' => 'delete', $packagesProgramsAnalogs->id], ['class'=>'crose-btn hide-postlink action-button-delete']) ?>
												<a href="javascript:;" class="btn btn-sm btn-danger delete postlink-delete" data-bs-tooltip="tooltip" data-bs-placement="top" title="<?= __("Delete this record!") ?>" text="<?= h($packagesProgramsAnalogs->name) ?>" subText="<?= __("You will not be able to revert this!") ?>" confirmButtonText="<?= __("Yes, delete it!") ?>" cancelButtonText="<?= __("Cancel") ?>"><i class="icon-minus"></i></a>
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


<?php if (!empty($package->packages_programs_digitals)): ?>
						<div class="tab-pane fade" id="tab-packages-programs-digitals" role="tabpanel" aria-labelledby="aria-tab-packages-programs-digitals">

							<div class="col-12 table-responsive p-0">

								<table class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th class="lcn"><?= __('Lcn') ?></th>
											<th class="program"><?= __('Program') ?></th>
											<th class="multicast-source"><?= __('Band') ?></th>
											<th class="name"><?= __('Name') ?></th>
											<th class="comment"><?= __('Comment') ?></th>
											<th class="changed"><?= __('Changed') ?></th>
											<th class="to-delete boolean"><?= __('To Delete') ?></th>
											<th class="visible boolean"><?= __('Visible') ?></th>
											<th class="pos"><?= __('Pos') ?></th>
											<th class="created">
												<?= __('Created') ?><br>
												<?= __('Modified') ?>
											</th>
<?php if(isset($config['index_show_actions']) && $config['index_show_actions']){ ?>
											<th class="actions"><?= __('Actions') ?></th>
<?php } ?>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($package->packages_programs_digitals as $packagesProgramsDigitals): ?>
										<tr aria-expanded="true">
											<td class="lcn"><?= h($packagesProgramsDigitals->lcn) ?></td>
											<td class="program"><?= h($packagesProgramsDigitals->program->name) ?></td>
											<td class="multicast-source"><?= h($packagesProgramsDigitals->program->multicast_source->name) ?></td>
											<td class="name"><?= h($packagesProgramsDigitals->name) ?></td>
											<td class="comment"><?= h($packagesProgramsDigitals->comment) ?></td>
											<td class="changed"><?= h($packagesProgramsDigitals->changed) ?></td>
											<td class="to-delete boolean" to-delete="<?= $packagesProgramsDigitals->to_delete ?>"><?= h($packagesProgramsDigitals->to_delete) ?></td>
											<td class="visible boolean" visible="<?= $packagesProgramsDigitals->visible ?>"><?= h($packagesProgramsDigitals->visible) ?></td>
											<td class="pos"><?= h($packagesProgramsDigitals->pos) ?></td>
											<td class="created">
												<?= h($packagesProgramsDigitals->created) ?><br>
												<?= h($packagesProgramsDigitals->modified) ?>
											</td>
<?php if($config['index_show_actions'] !== null && $config['index_show_actions']){ ?>
											<td class="actions text-center">
<?php 	if($config['index_enable_view'] !== null && $config['index_enable_view']){ ?>					  
												<?= $this->Html->link('<i class="fas fa-eye"></i>', ['controller' => 'packagesProgramsDigitals', 'action' => 'view', $packagesProgramsDigitals->id], ['escape' => false, 'class' => 'btn btn-sm bg-gradient-warning action-button-view', 'data-bs-tooltip'=>'tooltip', 'data-bs-placement'=>'top', 'title' => __('View this record')]) ?>
<?php 	} ?>
<?php 	if($config['index_enable_edit'] !== null && $config['index_enable_edit']){ ?>					  
												<?= $this->Html->link('<i class="fas fa-edit"></i>', ['controller' => 'packagesProgramsDigitals', 'action' => 'edit', $packagesProgramsDigitals->id], ['escape' => false, 'class' => 'btn btn-sm bg-gradient-success action-button-edit', 'data-bs-tooltip'=>'tooltip', 'data-bs-placement'=>'top', 'title' => __('Edit this record')]) ?>
<?php 	} ?>			
<?php 	if($config['index_enable_delete'] !== null && $config['index_enable_delete']){ ?>					  
												<?php //= $this->Form->postLink('<i class="fas fa-remove"></i>', ['action' => 'delete', $package->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $package->id), 'class' => 'btn btn-sm bg-gradient-danger action-button-delete']) ?>						
												<?= $this->Form->postLink('', ['controller' => 'packagesProgramsDigitals', 'action' => 'delete', $packagesProgramsDigitals->id], ['class'=>'crose-btn hide-postlink action-button-delete']) ?>
												<a href="javascript:;" class="btn btn-sm btn-danger delete postlink-delete" data-bs-tooltip="tooltip" data-bs-placement="top" title="<?= __("Delete this record!") ?>" text="<?= h($packagesProgramsDigitals->program->name) ?>" subText="<?= __("You will not be able to revert this!") ?>" confirmButtonText="<?= __("Yes, delete it!") ?>" cancelButtonText="<?= __("Cancel") ?>"><i class="icon-minus"></i></a>
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

