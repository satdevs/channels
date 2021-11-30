<?php // Baked at 2021.10.29. 11:23:04  ?>
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Program $program
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

	if(!isset($layoutProgramsLastId)){
		$layoutProgramsLastId = 0;
	}
	
?>
		<div class="view col-sm-10 programs">
			<div class="card card-lightblue">
				<div class="card-header">
					<h3 class="card-title"><?= $title ?>: <?= h($program->name) ?></h3>
				</div><!-- /.card-header -->
				<div class="card-body">
				
					<div class="form-group row">
						<label for="name" class="col-sm-2 col-form-label"><?= __('id') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field non-associated">
								<?= $program->id ?>
							</div>
						</div>
					</div>
					<div class="form-group row"><!-- 1. -->
						<label for="name" class="col-sm-2 col-form-label"><?= __('Version') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field associated">
								<?= $program->has('version') ? $this->Html->link($program->version->name, ['controller' => 'Versions', 'action' => 'view', $program->version->id], ['escape' => false, 'class' => 'btn btn-sm btn-default']) : '' ?>
							</div>
						</div>
					</div>
					<div class="form-group row"><!-- 1. -->
						<label for="name" class="col-sm-2 col-form-label"><?= __('Feature') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field associated">
								<?= $program->has('feature') ? $this->Html->link($program->feature->name, ['controller' => 'Features', 'action' => 'view', $program->feature->id], ['escape' => false, 'class' => 'btn btn-sm btn-default']) : '' ?>
							</div>
						</div>
					</div>
					<div class="form-group row"><!-- 1. -->
						<label for="name" class="col-sm-2 col-form-label"><?= __('Language') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field associated">
								<?= $program->has('language') ? $this->Html->link($program->language->name, ['controller' => 'Languages', 'action' => 'view', $program->language->id], ['escape' => false, 'class' => 'btn btn-sm btn-default']) : '' ?>
							</div>
						</div>
					</div>
					<div class="form-group row"><!-- 1. -->
						<label for="name" class="col-sm-2 col-form-label"><?= __('MulticastSource') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field associated">
								<?= $program->has('multicast_source') ? $this->Html->link($program->multicast_source->name, ['controller' => 'MulticastSources', 'action' => 'view', $program->multicast_source->id], ['escape' => false, 'class' => 'btn btn-sm btn-default']) : '' ?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 2. -->
						<label for="name" class="col-sm-2 col-form-label"><?= __('Name') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field non-associated">
								<?php 
									if(!empty($program->name)){
										echo h($program->name);
									}else{
										echo "&nbsp;";
									}
								?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 2. -->
						<label for="short-name" class="col-sm-2 col-form-label"><?= __('Short Name') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field non-associated">
								<?php 
									if(!empty($program->short_name)){
										echo h($program->short_name);
									}else{
										echo "&nbsp;";
									}
								?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 2. -->
						<label for="logo-file" class="col-sm-2 col-form-label"><?= __('Logo File') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field non-associated">
								<?php 
									if(!empty($program->logo_file)){
										echo h($program->logo_file);
									}else{
										echo "&nbsp;";
									}
								?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 2. -->
						<label for="logo-url" class="col-sm-2 col-form-label"><?= __('Logo Url') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field non-associated">
								<?php 
									if(!empty($program->logo_url)){
										echo h($program->logo_url);
									}else{
										echo "&nbsp;";
									}
								?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 2. -->
						<label for="url" class="col-sm-2 col-form-label"><?= __('Url') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field non-associated">
								<?php 
									if(!empty($program->url)){
										echo h($program->url);
									}else{
										echo "&nbsp;";
									}
								?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 2. -->
						<label for="programs-url" class="col-sm-2 col-form-label"><?= __('Programs Url') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field non-associated">
								<?php 
									if(!empty($program->programs_url)){
										echo h($program->programs_url);
									}else{
										echo "&nbsp;";
									}
								?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 2. -->
						<label for="email" class="col-sm-2 col-form-label"><?= __('Email') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field non-associated">
								<?php 
									if(!empty($program->email)){
										echo h($program->email);
									}else{
										echo "&nbsp;";
									}
								?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 2. -->
						<label for="address" class="col-sm-2 col-form-label"><?= __('Address') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field non-associated">
								<?php 
									if(!empty($program->address)){
										echo h($program->address);
									}else{
										echo "&nbsp;";
									}
								?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 2. -->
						<label for="phone" class="col-sm-2 col-form-label"><?= __('Phone') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field non-associated">
								<?php 
									if(!empty($program->phone)){
										echo h($program->phone);
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
									if(!empty($program->pos)){
										echo $this->Number->format($program->pos);
									}else{
										echo "&nbsp;";
									}
								?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 4. -->
						<label for="packages-count" class="col-sm-2 col-form-label"><?= __('Packages Count') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field number">
								<?php
									if(!empty($program->packages_count)){
										echo $this->Number->format($program->packages_count);
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
									if(!empty($program->created)){
										echo h($program->created);
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
									if(!empty($program->modified)){
										echo h($program->modified);
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
								<?php // $this->Text->autoParagraph(h($program->comment)); ?>
								<?php
									if(!empty($program->comment)){
										//echo $this->Text->autoParagraph($program->comment) . "<br>";
										echo $program->comment . "<br>";
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

		<?php //debug($program->toArray()); ?>

		<!-- ################################################################################################################ -->
		<div class="col-12">
			<div class="card card-primary card-outline card-outline-tabs">

				<div class="card-header p-0 border-bottom-0">
					<ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
						<li class="pt-2 px-3">
							<h3 class="card-title" style="font-size: 22px;"><?= __('Related tables') ?></h3>
						</li>
<?php if (!empty($program->packages)) : ?>
						<li class="nav-item view-tab">
							<a class="nav-link active" id="related-tab-packages" data-toggle="pill" href="#tab-packages" role="tab" aria-controls="aria-tab-packages" aria-selected="true"><?= __('Packages') ?></a>
						</li>
<?php endif; ?>
<?php if (!empty($program->packages_programs_analogs)) : ?>
						<li class="nav-item view-tab">
							<a class="nav-link" id="related-tab-packages_programs_analogs" data-toggle="pill" href="#tab-packages_programs_analogs" role="tab" aria-controls="aria-tab-packages_programs_analogs" aria-selected="false"><?= __('Packages Programs Analogs') ?></a>
						</li>
<?php endif; ?>
<?php if (!empty($program->packages_programs_digitals)) : ?>
						<li class="nav-item view-tab">
							<a class="nav-link" id="related-tab-packages_programs_digitals" data-toggle="pill" href="#tab-packages_programs_digitals" role="tab" aria-controls="aria-tab-packages_programs_digitals" aria-selected="false"><?= __('Packages Programs Digitals') ?></a>
						</li>
<?php endif; ?>
					</ul>
				</div>


				<div class="card-body p-0">
					<div class="tab-content" id="custom-tabs-four-tabContent">
<?php if (!empty($program->packages)) : ?>
						<div class="tab-pane fade active show" id="tab-packages" role="tabpanel" aria-labelledby="aria-tab-packages">
<?php /* */ ?>



							<div class="col-12 table-responsive p-0">

								<table class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th class="Broadcast"><?= __('Broadcast') ?></th>
											<th class="Name"><?= __('Name') ?></th>
											<th class="Shortname"><?= __('Shortname') ?></th>
											<th class="Popular Name"><?= __('Popular Name') ?></th>
											<th class="Price text-center"><?= __('Price') ?></th>
											<th class="boolean visible"><?= __('Visible') ?></th>
											<th class="pos"><?= __('Pos') ?></th>
											<th class="Created">
												<?= __('Created') ?><br>
												<?= __('Modified') ?>
											</th>
<?php if(isset($config['index_show_actions']) && $config['index_show_actions']){ ?>
											<th class="actions"><?= __('Actions') ?></th>
<?php } ?>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($program->packages as $packages) : ?>
										<tr aria-expanded="true">
											<td class="broadcast"><?= $broadcasts[$packages->broadcast] ?></td>
											<td class="name"><?= h($packages->name) ?></td>
											<td class="shortname"><?= h($packages->shortname) ?></td>
											<td class="popular-name"><?= h($packages->popular_name) ?></td>
											<td class="price text-center"><?= h($packages->price) ?></td>
											<td class="boolean visible" visible="<?= h($packages->visible) ?>"><?= h($packages->visible) ?></td>
											<td class="pos"><?= h($packages->pos) ?></td>
											<td class="created modified">
												<?= h($packages->created) ?><br>
												<?= h($packages->modified) ?>
											</td>
<?php if($config['index_show_actions'] !== null && $config['index_show_actions']){ ?>
											<td class="actions text-center">
<?php 	if($config['index_enable_view'] !== null && $config['index_enable_view']){ ?>					  
												<?= $this->Html->link('<i class="fas fa-eye"></i>', ['controller' => 'Packages', 'action' => 'view', $packages->id], ['escape' => false, 'class' => 'btn btn-sm bg-gradient-warning action-button-view', 'data-bs-tooltip'=>'tooltip', 'data-bs-placement'=>'top', 'title' => __('View this record')]) ?>
<?php 	} ?>
<?php 	if($config['index_enable_edit'] !== null && $config['index_enable_edit']){ ?>					  
												<?= $this->Html->link('<i class="fas fa-edit"></i>', ['controller' => 'Packages', 'action' => 'edit', $packages->id], ['escape' => false, 'class' => 'btn btn-sm bg-gradient-success action-button-edit', 'data-bs-tooltip'=>'tooltip', 'data-bs-placement'=>'top', 'title' => __('Edit this record')]) ?>
<?php 	} ?>			
<?php 	if($config['index_enable_delete'] !== null && $config['index_enable_delete']){ ?>					  
												<?php //= $this->Form->postLink('<i class="fas fa-remove"></i>', ['action' => 'delete', $program->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $program->id), 'class' => 'btn btn-sm bg-gradient-danger action-button-delete']) ?>						
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
<?php if (!empty($program->packages_programs_analogs)) : ?>
						<div class="tab-pane fade" id="tab-packages_programs_analogs" role="tabpanel" aria-labelledby="aria-tab-packages_programs_analogs">

							<div class="col-12 table-responsive p-0">

								<table class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th class="Name"><?= __('Name') ?></th>
											<th class="Lcn"><?= __('Lcn') ?></th>
											<th class="Channel"><?= __('Channel') ?></th>
											<th class="Frequency"><?= __('Frequency') ?></th>
											<th class="Comment"><?= __('Comment') ?></th>
											<th class="Public Comment"><?= __('Public Comment') ?></th>
											<th class="Changed"><?= __('Changed') ?></th>
											<th class="boolean to-delete"><?= __('To Delete') ?></th>
											<th class="boolean visible"><?= __('Visible') ?></th>
											<th class="pos"><?= __('Pos') ?></th>
											<th class="created modified">
												<?= __('Created') ?><br>
												<?= __('Modified') ?>
											</th>
<?php if(isset($config['index_show_actions']) && $config['index_show_actions']){ ?>
											<th class="actions"><?= __('Actions') ?></th>
<?php } ?>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($program->packages_programs_analogs as $packagesProgramsAnalogs) : ?>
										<tr aria-expanded="true">
											<td class="name"><?= h($packagesProgramsAnalogs->name) ?></td>
											<td class="lcn"><?= h($packagesProgramsAnalogs->lcn) ?></td>
											<td class="channel"><?= h($packagesProgramsAnalogs->channel) ?></td>
											<td class="frequency"><?= h($packagesProgramsAnalogs->frequency) ?></td>
											<td class="comment"><?= h($packagesProgramsAnalogs->comment) ?></td>
											<td class="public-comment"><?= h($packagesProgramsAnalogs->public_comment) ?></td>
											<td class="changed"><?= h($packagesProgramsAnalogs->changed) ?></td>
											<td class="boolean to-delete" to-delete="<?= h($packagesProgramsAnalogs->to_delete) ?>"><?= h($packagesProgramsAnalogs->to_delete) ?></td>
											<td class="boolean visible" visible="<?= h($packagesProgramsAnalogs->visible) ?>"><?= h($packagesProgramsAnalogs->visible) ?></td>
											<td class="pos"><?= h($packagesProgramsAnalogs->pos) ?></td>
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
												<?php //= $this->Form->postLink('<i class="fas fa-remove"></i>', ['action' => 'delete', $program->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $program->id), 'class' => 'btn btn-sm bg-gradient-danger action-button-delete']) ?>						
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
<?php if (!empty($program->packages_programs_digitals)) : ?>
						<div class="tab-pane fade" id="tab-packages_programs_digitals" role="tabpanel" aria-labelledby="aria-tab-packages_programs_digitals">
<?php /* */ ?>



							<div class="col-12 table-responsive p-0">

								<table class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th class="Name"><?= __('Name') ?></th>
											<th class="Short Name"><?= __('Short Name') ?></th>
											<th class="Ackey Id"><?= __('Ackey Id') ?></th>
											<th class="Lcn"><?= __('Lcn') ?></th>
											<th class="Channel"><?= __('Channel') ?></th>
											<th class="Qam"><?= __('Qam') ?></th>
											<th class="Sid"><?= __('Sid') ?></th>
											<th class="Comment"><?= __('Comment') ?></th>
											<th class="Public Comment"><?= __('Public Comment') ?></th>
											<th class="boolean to-delete"><?= __('To Delete') ?></th>
											<th class="boolean visible"><?= __('Visible') ?></th>
											<th class="pos"><?= __('Pos') ?></th>
											<th class="created modified">
												<?= __('Created') ?><br>
												<?= __('Modified') ?>
											</th>
<?php if(isset($config['index_show_actions']) && $config['index_show_actions']){ ?>
											<th class="actions"><?= __('Actions') ?></th>
<?php } ?>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($program->packages_programs_digitals as $packagesProgramsDigitals) : ?>
										<tr aria-expanded="true">
											<td class="name"><?= h($packagesProgramsDigitals->name) ?></td>
											<td class="short-name"><?= h($packagesProgramsDigitals->short_name) ?></td>
											<td class="ackey-id"><?= h($packagesProgramsDigitals->ackey_id) ?></td>
											<td class="lcn"><?= h($packagesProgramsDigitals->lcn) ?></td>
											<td class="channel"><?= h($packagesProgramsDigitals->channel) ?></td>
											<td class="qam"><?= h($packagesProgramsDigitals->qam) ?></td>
											<td class="sid"><?= h($packagesProgramsDigitals->sid) ?></td>
											<td class="comment"><?= h($packagesProgramsDigitals->comment) ?></td>
											<td class="public-comment"><?= h($packagesProgramsDigitals->public_comment) ?></td>
											<td class="boolean to-delete" to-delete="<?= h($packagesProgramsDigitals->to_delete) ?>"><?= h($packagesProgramsDigitals->to_delete) ?></td>
											<td class="boolean visible" visible="<?= h($packagesProgramsDigitals->visible) ?>"><?= h($packagesProgramsDigitals->visible) ?></td>
											<td class="pos"><?= h($packagesProgramsDigitals->pos) ?></td>
											<td class="created">
												<?= h($packagesProgramsDigitals->created) ?><br>
												<?= h($packagesProgramsDigitals->modified) ?>
											</td>
<?php if($config['index_show_actions'] !== null && $config['index_show_actions']){ ?>
											<td class="actions text-center">
<?php 	if($config['index_enable_view'] !== null && $config['index_enable_view']){ ?>					  
												<?= $this->Html->link('<i class="fas fa-eye"></i>', ['controller' => 'PackagesProgramsDigitals', 'action' => 'view', $packagesProgramsDigitals->id], ['escape' => false, 'class' => 'btn btn-sm bg-gradient-warning action-button-view', 'data-bs-tooltip'=>'tooltip', 'data-bs-placement'=>'top', 'title' => __('View this record')]) ?>
<?php 	} ?>
<?php 	if($config['index_enable_edit'] !== null && $config['index_enable_edit']){ ?>					  
												<?= $this->Html->link('<i class="fas fa-edit"></i>', ['controller' => 'PackagesProgramsDigitals', 'action' => 'edit', $packagesProgramsDigitals->id], ['escape' => false, 'class' => 'btn btn-sm bg-gradient-success action-button-edit', 'data-bs-tooltip'=>'tooltip', 'data-bs-placement'=>'top', 'title' => __('Edit this record')]) ?>
<?php 	} ?>			
<?php 	if($config['index_enable_delete'] !== null && $config['index_enable_delete']){ ?>					  
												<?php //= $this->Form->postLink('<i class="fas fa-remove"></i>', ['action' => 'delete', $program->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $program->id), 'class' => 'btn btn-sm bg-gradient-danger action-button-delete']) ?>						
												<?= $this->Form->postLink('', ['controller' => 'PackagesProgramsDigitals', 'action' => 'delete', $packagesProgramsDigitals->id], ['class'=>'crose-btn hide-postlink action-button-delete']) ?>
												<a href="javascript:;" class="btn btn-sm btn-danger delete postlink-delete" data-bs-tooltip="tooltip" data-bs-placement="top" title="<?= __("Delete this record!") ?>" text="<?= h($packagesProgramsDigitals->name) ?>" subText="<?= __("You will not be able to revert this!") ?>" confirmButtonText="<?= __("Yes, delete it!") ?>" cancelButtonText="<?= __("Cancel") ?>"><i class="icon-minus"></i></a>
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

