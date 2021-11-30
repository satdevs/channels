<?php // Baked at 2021.10.29. 10:30:13  ?>
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Version $version
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

	if(!isset($layoutVersionsLastId)){
		$layoutVersionsLastId = 0;
	}
	
?>
		<div class="view col-sm-10 versions">
			<div class="card card-lightblue">
				<div class="card-header">
					<h3 class="card-title"><?= $title ?>: <?= h($version->name) ?></h3>
				</div><!-- /.card-header -->
				<div class="card-body">
				
					<div class="form-group row">
						<label for="name" class="col-sm-2 col-form-label"><?= __('id') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field non-associated">
								<?= $version->id ?>
							</div>
						</div>
					</div>
					<div class="form-group row"><!-- 1. -->
						<label for="name" class="col-sm-2 col-form-label"><?= __('Headstation') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field associated">
								<?= $version->has('headstation') ? $this->Html->link($version->headstation->name, ['controller' => 'Headstations', 'action' => 'view', $version->headstation->id], ['escape' => false, 'class' => 'btn btn-sm btn-default']) : '' ?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 2. -->
						<label for="name" class="col-sm-2 col-form-label"><?= __('Name') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field non-associated">
								<?php 
									if(!empty($version->name)){
										echo h($version->name);
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
									if(!empty($version->pos)){
										echo $this->Number->format($version->pos);
									}else{
										echo "&nbsp;";
									}
								?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 5. -->
						<label for="date-from" class="col-sm-2 col-form-label"><?= __('Date From') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field date">
								<?php
									if(!empty($version->date_from)){
										echo h($version->date_from);
									}else{
										echo "&nbsp;";
									}
								?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 5. -->
						<label for="date-to" class="col-sm-2 col-form-label"><?= __('Date To') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field date">
								<?php
									if(!empty($version->date_to)){
										echo h($version->date_to);
									}else{
										echo "&nbsp;";
									}
								?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 5. -->
						<label for="created" class="col-sm-2 col-form-label"><?= __('Print image') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field date">
								<?php
									if(!empty($version->print_image) && $version->print_image){
										echo __('Yes');
									}else{
										echo __('No');
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
									if(!empty($version->created)){
										echo h($version->created);
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
									if(!empty($version->modified)){
										echo h($version->modified);
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
								<?php // $this->Text->autoParagraph(h($version->comment)); ?>
								<?php
									if(!empty($version->comment)){
										//echo $this->Text->autoParagraph($version->comment) . "<br>";
										echo $version->comment . "<br>";
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
<?php /* if (!empty($version->ackeys)) : ?>
						<li class="nav-item view-tab">
							<a class="nav-link active" id="related-tab-ackeys" data-toggle="pill" href="#tab-ackeys" role="tab" aria-controls="aria-tab-ackeys" aria-selected="true"><?= __('Ackeys') ?></a>
						</li>
<?php endif; */ ?>
<?php if (!empty($version->multicast_sources)) : ?>
						<li class="nav-item view-tab">
							<a class="nav-link active" id="related-tab-multicast_sources" data-toggle="pill" href="#tab-multicast_sources" role="tab" aria-controls="aria-tab-multicast_sources" aria-selected="false"><?= __('Multicast Sources') ?></a>
						</li>
<?php endif; ?>
<?php if (!empty($version->packages)) : ?>
						<li class="nav-item view-tab">
							<a class="nav-link" id="related-tab-packages" data-toggle="pill" href="#tab-packages" role="tab" aria-controls="aria-tab-packages" aria-selected="false"><?= __('Packages') ?></a>
						</li>
<?php endif; ?>
<?php if (!empty($version->programs)) : ?>
						<li class="nav-item view-tab">
							<a class="nav-link" id="related-tab-programs" data-toggle="pill" href="#tab-programs" role="tab" aria-controls="aria-tab-programs" aria-selected="false"><?= __('Programs') ?></a>
						</li>
<?php endif; ?>
<?php if (!empty($version->packages_programs_analogs)) : ?>
						<li class="nav-item view-tab">
							<a class="nav-link" id="related-tab-packages_programs_analogs" data-toggle="pill" href="#tab-packages_programs_analogs" role="tab" aria-controls="aria-tab-packages_programs_analogs" aria-selected="false"><?= __('Packages Programs Analogs') ?></a>
						</li>
<?php endif; ?>
<?php if (!empty($version->packages_programs_digitals)) : ?>
						<li class="nav-item view-tab">
							<a class="nav-link" id="related-tab-packages_programs_digitals" data-toggle="pill" href="#tab-packages_programs_digitals" role="tab" aria-controls="aria-tab-packages_programs_digitals" aria-selected="false"><?= __('Packages Programs Digitals') ?></a>
						</li>
<?php endif; ?>
					</ul>
				</div>


				<div class="card-body p-0">
					<div class="tab-content" id="custom-tabs-four-tabContent">
<?php if (!empty($version->ackeys)) : ?>
						<div class="tab-pane fade active show" id="tab-ackeys" role="tabpanel" aria-labelledby="aria-tab-ackeys">
<?php /* */ ?>



							<div class="col-12 table-responsive p-0">

								<table class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th class="Name"><?= __('Name') ?></th>
											<th class="Value"><?= __('Value') ?></th>
<?php if(isset($config['index_show_actions']) && $config['index_show_actions']){ ?>
											<th class="actions"><?= __('Actions') ?></th>
<?php } ?>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($version->ackeys as $ackeys) : ?>
										<tr aria-expanded="true">
											<td class="name"><?= h($ackeys->name) ?></td>
											<td class="value"><?= h($ackeys->value) ?></td>
<?php if($config['index_show_actions'] !== null && $config['index_show_actions']){ ?>
											<td class="actions text-center">
<?php 	if($config['index_enable_view'] !== null && $config['index_enable_view']){ ?>					  
												<?= $this->Html->link('<i class="fas fa-eye"></i>', ['controller' => 'Ackeys', 'action' => 'view', $ackeys->id], ['escape' => false, 'class' => 'btn btn-sm bg-gradient-warning action-button-view', 'data-bs-tooltip'=>'tooltip', 'data-bs-placement'=>'top', 'title' => __('View this record')]) ?>
<?php 	} ?>
<?php 	if($config['index_enable_edit'] !== null && $config['index_enable_edit']){ ?>					  
												<?= $this->Html->link('<i class="fas fa-edit"></i>', ['controller' => 'Ackeys', 'action' => 'edit', $ackeys->id], ['escape' => false, 'class' => 'btn btn-sm bg-gradient-success action-button-edit', 'data-bs-tooltip'=>'tooltip', 'data-bs-placement'=>'top', 'title' => __('Edit this record')]) ?>
<?php 	} ?>			
<?php 	if($config['index_enable_delete'] !== null && $config['index_enable_delete']){ ?>					  
												<?php //= $this->Form->postLink('<i class="fas fa-remove"></i>', ['action' => 'delete', $version->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $version->id), 'class' => 'btn btn-sm bg-gradient-danger action-button-delete']) ?>						
												<?= $this->Form->postLink('', ['controller' => 'Ackeys', 'action' => 'delete', $ackeys->id], ['class'=>'crose-btn hide-postlink action-button-delete']) ?>
												<a href="javascript:;" class="btn btn-sm btn-danger delete postlink-delete" data-bs-tooltip="tooltip" data-bs-placement="top" title="<?= __("Delete this record!") ?>" text="<?= h($ackeys->name) ?>" subText="<?= __("You will not be able to revert this!") ?>" confirmButtonText="<?= __("Yes, delete it!") ?>" cancelButtonText="<?= __("Cancel") ?>"><i class="icon-minus"></i></a>
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
<?php if (!empty($version->multicast_sources)) : ?>
						<div class="tab-pane fade active show" id="tab-multicast_sources" role="tabpanel" aria-labelledby="aria-tab-multicast_sources">
<?php /* */ ?>



							<div class="col-12 table-responsive p-0">

								<table class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th class="Name"><?= __('Name') ?></th>
											<th class="Dest Ip"><?= __('Dest Ip') ?></th>
											<th class="Src Ip"><?= __('Src Ip') ?></th>
											<th class="Port"><?= __('Port') ?></th>
											<th class="Interface"><?= __('Interface') ?></th>
											<th class="Provider"><?= __('Provider') ?></th>
<?php if(isset($config['index_show_actions']) && $config['index_show_actions']){ ?>
											<th class="actions"><?= __('Actions') ?></th>
<?php } ?>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($version->multicast_sources as $multicastSources) : ?>
										<tr aria-expanded="true">
											<td class="name"><?= h($multicastSources->name) ?></td>
											<td class="src-ip"><?= h($multicastSources->src_ip) ?></td>
											<td class="dest-ip"><?= h($multicastSources->dest_ip) ?></td>
											<td class="port"><?= h($multicastSources->port) ?></td>
											<td class="interface"><?= h($multicastSources->interface) ?></td>
											<td class="provider"><?= h($multicastSources->provider) ?></td>
<?php if($config['index_show_actions'] !== null && $config['index_show_actions']){ ?>
											<td class="actions text-center">
<?php 	if($config['index_enable_view'] !== null && $config['index_enable_view']){ ?>					  
												<?= $this->Html->link('<i class="fas fa-eye"></i>', ['controller' => 'MulticastSources', 'action' => 'view', $multicastSources->id], ['escape' => false, 'class' => 'btn btn-sm bg-gradient-warning action-button-view', 'data-bs-tooltip'=>'tooltip', 'data-bs-placement'=>'top', 'title' => __('View this record')]) ?>
<?php 	} ?>
<?php 	if($config['index_enable_edit'] !== null && $config['index_enable_edit']){ ?>					  
												<?= $this->Html->link('<i class="fas fa-edit"></i>', ['controller' => 'MulticastSources', 'action' => 'edit', $multicastSources->id], ['escape' => false, 'class' => 'btn btn-sm bg-gradient-success action-button-edit', 'data-bs-tooltip'=>'tooltip', 'data-bs-placement'=>'top', 'title' => __('Edit this record')]) ?>
<?php 	} ?>			
<?php 	if($config['index_enable_delete'] !== null && $config['index_enable_delete']){ ?>					  
												<?php //= $this->Form->postLink('<i class="fas fa-remove"></i>', ['action' => 'delete', $version->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $version->id), 'class' => 'btn btn-sm bg-gradient-danger action-button-delete']) ?>						
												<?= $this->Form->postLink('', ['controller' => 'MulticastSources', 'action' => 'delete', $multicastSources->id], ['class'=>'crose-btn hide-postlink action-button-delete']) ?>
												<a href="javascript:;" class="btn btn-sm btn-danger delete postlink-delete" data-bs-tooltip="tooltip" data-bs-placement="top" title="<?= __("Delete this record!") ?>" text="<?= h($multicastSources->name) ?>" subText="<?= __("You will not be able to revert this!") ?>" confirmButtonText="<?= __("Yes, delete it!") ?>" cancelButtonText="<?= __("Cancel") ?>"><i class="icon-minus"></i></a>
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
<?php if (!empty($version->packages)) : ?>
						<div class="tab-pane fade" id="tab-packages" role="tabpanel" aria-labelledby="aria-tab-packages">

							<div class="col-12 table-responsive p-0">

								<table class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th class="Broadcast"><?= __('Broadcast') ?></th>
											<th class="Name"><?= __('Name') ?></th>
											<th class="Shortname"><?= __('Shortname') ?></th>
											<th class="Popular Name"><?= __('Popular Name') ?></th>
											<th class="External Name"><?= __('External Name') ?></th>
											<th class="Price"><?= __('Price') ?></th>
<?php if(isset($config['index_show_actions']) && $config['index_show_actions']){ ?>
											<th class="actions"><?= __('Actions') ?></th>
<?php } ?>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($version->packages as $packages) : ?>
										<tr aria-expanded="true">
											<td class="broadcast"><?= h($packages->broadcast) ?></td>
											<td class="name"><?= h($packages->name) ?></td>
											<td class="shortname"><?= h($packages->shortname) ?></td>
											<td class="popular-name"><?= h($packages->popular_name) ?></td>
											<td class="external-name"><?= h($packages->external_name) ?></td>
											<td class="price"><?= h($packages->price) ?></td>
<?php if($config['index_show_actions'] !== null && $config['index_show_actions']){ ?>
											<td class="actions text-center">
<?php 	if($config['index_enable_view'] !== null && $config['index_enable_view']){ ?>					  
												<?= $this->Html->link('<i class="fas fa-eye"></i>', ['controller' => 'Packages', 'action' => 'view', $packages->id], ['escape' => false, 'class' => 'btn btn-sm bg-gradient-warning action-button-view', 'data-bs-tooltip'=>'tooltip', 'data-bs-placement'=>'top', 'title' => __('View this record')]) ?>
<?php 	} ?>
<?php 	if($config['index_enable_edit'] !== null && $config['index_enable_edit']){ ?>					  
												<?= $this->Html->link('<i class="fas fa-edit"></i>', ['controller' => 'Packages', 'action' => 'edit', $packages->id], ['escape' => false, 'class' => 'btn btn-sm bg-gradient-success action-button-edit', 'data-bs-tooltip'=>'tooltip', 'data-bs-placement'=>'top', 'title' => __('Edit this record')]) ?>
<?php 	} ?>			
<?php 	if($config['index_enable_delete'] !== null && $config['index_enable_delete']){ ?>					  
												<?php //= $this->Form->postLink('<i class="fas fa-remove"></i>', ['action' => 'delete', $version->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $version->id), 'class' => 'btn btn-sm bg-gradient-danger action-button-delete']) ?>						
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


<?php if (!empty($version->programs)): ?>
						<div class="tab-pane fade" id="tab-programs" role="tabpanel" aria-labelledby="aria-tab-programs">
<?php /* */ ?>



							<div class="col-12 table-responsive p-0">

								<table class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th class="Name"><?= __('Name') ?></th>
											<th class="Short Name"><?= __('Short Name') ?></th>
											<th class="New"><?= __('New') ?></th>
<?php if(isset($config['index_show_actions']) && $config['index_show_actions']){ ?>
											<th class="actions"><?= __('Actions') ?></th>
<?php } ?>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($version->programs as $programs) : ?>
										<tr aria-expanded="true">
											<td class="name"><?= h($programs->name) ?></td>
											<td class="short-name"><?= h($programs->short_name) ?></td>
											<td class="new"><?= h($programs->new) ?></td>
<?php if($config['index_show_actions'] !== null && $config['index_show_actions']){ ?>
											<td class="actions text-center">
<?php 	if($config['index_enable_view'] !== null && $config['index_enable_view']){ ?>					  
												<?= $this->Html->link('<i class="fas fa-eye"></i>', ['controller' => 'Programs', 'action' => 'view', $programs->id], ['escape' => false, 'class' => 'btn btn-sm bg-gradient-warning action-button-view', 'data-bs-tooltip'=>'tooltip', 'data-bs-placement'=>'top', 'title' => __('View this record')]) ?>
<?php 	} ?>
<?php 	if($config['index_enable_edit'] !== null && $config['index_enable_edit']){ ?>					  
												<?= $this->Html->link('<i class="fas fa-edit"></i>', ['controller' => 'Programs', 'action' => 'edit', $programs->id], ['escape' => false, 'class' => 'btn btn-sm bg-gradient-success action-button-edit', 'data-bs-tooltip'=>'tooltip', 'data-bs-placement'=>'top', 'title' => __('Edit this record')]) ?>
<?php 	} ?>			
<?php 	if($config['index_enable_delete'] !== null && $config['index_enable_delete']){ ?>					  
												<?php //= $this->Form->postLink('<i class="fas fa-remove"></i>', ['action' => 'delete', $version->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $version->id), 'class' => 'btn btn-sm bg-gradient-danger action-button-delete']) ?>						
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


<?php if (!empty($version->packages_programs_analogs)) : ?>
						<div class="tab-pane fade" id="tab-packages_programs_analogs" role="tabpanel" aria-labelledby="aria-tab-packages_programs_analogs">
<?php /* */ ?>



							<div class="col-12 table-responsive p-0">

								<table class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th class="Packageorder"><?= __('Packageorder') ?></th>
											<th class="Name"><?= __('Name') ?></th>
											<th class="Lcn"><?= __('Lcn') ?></th>
											<th class="To Delete"><?= __('To Delete') ?></th>
<?php if(isset($config['index_show_actions']) && $config['index_show_actions']){ ?>
											<th class="actions"><?= __('Actions') ?></th>
<?php } ?>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($version->packages_programs_analogs as $packagesProgramsAnalogs) : ?>
										<tr aria-expanded="true">
											<td class="packageorder"><?= h($packagesProgramsAnalogs->packageorder) ?></td>
											<td class="name"><?= h($packagesProgramsAnalogs->program->name) ?></td>
											<td class="lcn"><?= h($packagesProgramsAnalogs->lcn) ?></td>
											<td class="to-delete"><?= $packagesProgramsAnalogs->to_delete ?></td>
<?php if($config['index_show_actions'] !== null && $config['index_show_actions']){ ?>
											<td class="actions text-center">
<?php 	if($config['index_enable_view'] !== null && $config['index_enable_view']){ ?>					  
												<?= $this->Html->link('<i class="fas fa-eye"></i>', ['controller' => 'PackagesProgramsAnalogs', 'action' => 'view', $packagesProgramsAnalogs->id], ['escape' => false, 'class' => 'btn btn-sm bg-gradient-warning action-button-view', 'data-bs-tooltip'=>'tooltip', 'data-bs-placement'=>'top', 'title' => __('View this record')]) ?>
<?php 	} ?>
<?php 	if($config['index_enable_edit'] !== null && $config['index_enable_edit']){ ?>					  
												<?= $this->Html->link('<i class="fas fa-edit"></i>', ['controller' => 'PackagesProgramsAnalogs', 'action' => 'edit', $packagesProgramsAnalogs->id], ['escape' => false, 'class' => 'btn btn-sm bg-gradient-success action-button-edit', 'data-bs-tooltip'=>'tooltip', 'data-bs-placement'=>'top', 'title' => __('Edit this record')]) ?>
<?php 	} ?>			
<?php 	if($config['index_enable_delete'] !== null && $config['index_enable_delete']){ ?>					  
												<?php //= $this->Form->postLink('<i class="fas fa-remove"></i>', ['action' => 'delete', $version->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $version->id), 'class' => 'btn btn-sm bg-gradient-danger action-button-delete']) ?>						
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
<?php if (!empty($version->packages_programs_digitals)) : ?>
						<div class="tab-pane fade" id="tab-packages_programs_digitals" role="tabpanel" aria-labelledby="aria-tab-packages_programs_digitals">
<?php /* */ ?>



							<div class="col-12 table-responsive p-0">

								<table class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th class="Multicast Source Id"><?= __('Multicast Source Id') ?></th>
											<th class="Ackey Id"><?= __('Ackey Id') ?></th>
											<th class="Packageorder"><?= __('Packageorder') ?></th>
											<th class="Name"><?= __('Name') ?></th>
											<th class="Short Name"><?= __('Short Name') ?></th>
											<th class="Lcn"><?= __('Lcn') ?></th>
											<th class="Channel"><?= __('Channel') ?></th>
											<th class="Frequency"><?= __('Frequency') ?></th>
											<th class="Qam"><?= __('Qam') ?></th>
											<th class="Sid"><?= __('Sid') ?></th>
<?php if(isset($config['index_show_actions']) && $config['index_show_actions']){ ?>
											<th class="actions"><?= __('Actions') ?></th>
<?php } ?>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($version->packages_programs_digitals as $packagesProgramsDigitals) : ?>
										<tr aria-expanded="true">
											<td class="multicast-source-id"><?= h($packagesProgramsDigitals->multicast_source_id) ?></td>
											<td class="ackey-id"><?= h($packagesProgramsDigitals->ackey->value) ?></td>
											<td class="packageorder"><?= h($packagesProgramsDigitals->packageorder) ?></td>
											<td class="name"><?= h($packagesProgramsDigitals->program->name) ?></td>
											<td class="short-name"><?= h($packagesProgramsDigitals->short_name) ?></td>
											<td class="lcn"><?= h($packagesProgramsDigitals->lcn) ?></td>
											<td class="channel"><?= h($packagesProgramsDigitals->channel) ?></td>
											<td class="frequency"><?= h($packagesProgramsDigitals->frequency) ?></td>
											<td class="qam"><?= h($packagesProgramsDigitals->qam) ?></td>
											<td class="sid"><?= h($packagesProgramsDigitals->sid) ?></td>
<?php if($config['index_show_actions'] !== null && $config['index_show_actions']){ ?>
											<td class="actions text-center">
<?php 	if($config['index_enable_view'] !== null && $config['index_enable_view']){ ?>					  
												<?= $this->Html->link('<i class="fas fa-eye"></i>', ['controller' => 'PackagesProgramsDigitals', 'action' => 'view', $packagesProgramsDigitals->id], ['escape' => false, 'class' => 'btn btn-sm bg-gradient-warning action-button-view', 'data-bs-tooltip'=>'tooltip', 'data-bs-placement'=>'top', 'title' => __('View this record')]) ?>
<?php 	} ?>
<?php 	if($config['index_enable_edit'] !== null && $config['index_enable_edit']){ ?>					  
												<?= $this->Html->link('<i class="fas fa-edit"></i>', ['controller' => 'PackagesProgramsDigitals', 'action' => 'edit', $packagesProgramsDigitals->id], ['escape' => false, 'class' => 'btn btn-sm bg-gradient-success action-button-edit', 'data-bs-tooltip'=>'tooltip', 'data-bs-placement'=>'top', 'title' => __('Edit this record')]) ?>
<?php 	} ?>			
<?php 	if($config['index_enable_delete'] !== null && $config['index_enable_delete']){ ?>					  
												<?php //= $this->Form->postLink('<i class="fas fa-remove"></i>', ['action' => 'delete', $version->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $version->id), 'class' => 'btn btn-sm bg-gradient-danger action-button-delete']) ?>						
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

