<?php // Baked at 2021.10.29. 10:29:45  ?>
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ackey $ackey
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

	if(!isset($layoutAckeysLastId)){
		$layoutAckeysLastId = 0;
	}
	
?>
		<div class="view col-sm-10 ackeys">
			<div class="card card-lightblue">
				<div class="card-header">
					<h3 class="card-title"><?= $title ?>: <?= h($ackey->name) ?></h3>
				</div><!-- /.card-header -->
				<div class="card-body">
				
					<div class="form-group row">
						<label for="name" class="col-sm-2 col-form-label"><?= __('id') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field non-associated">
								<?= $ackey->id ?>
							</div>
						</div>
					</div>
					<div class="form-group row"><!-- 1. -->
						<label for="name" class="col-sm-2 col-form-label"><?= __('Version') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field associated">
								<?= $ackey->has('version') ? $this->Html->link($ackey->version->name, ['controller' => 'Versions', 'action' => 'view', $ackey->version->id], ['escape' => false, 'class' => 'btn btn-sm btn-default']) : '&nbsp;' ?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 2. -->
						<label for="name" class="col-sm-2 col-form-label"><?= __('Name') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field non-associated">
								<?php 
									if(!empty($ackey->name)){
										echo h($ackey->name);
									}else{
										echo "&nbsp;";
									}
								?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 2. -->
						<label for="value" class="col-sm-2 col-form-label"><?= __('Value') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field non-associated">
								<?php 
									if(!empty($ackey->value)){
										echo h($ackey->value);
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
									if(!empty($ackey->pos)){
										echo $this->Number->format($ackey->pos);
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
									if(!empty($ackey->created)){
										echo h($ackey->created);
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
									if(!empty($ackey->modified)){
										echo h($ackey->modified);
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
<?php if (!empty($ackey->packages_programs_digitals)) : ?>
						<li class="nav-item view-tab">
							<a class="nav-link active" id="related-tab-packages_programs_digitals" data-toggle="pill" href="#tab-packages_programs_digitals" role="tab" aria-controls="aria-tab-packages_programs_digitals" aria-selected="true"><?= __('Packages Programs Digitals') ?></a>
						</li>
<?php endif; ?>
					</ul>
				</div>


				<div class="card-body p-0">
					<div class="tab-content" id="custom-tabs-four-tabContent">
<?php if (!empty($ackey->packages_programs_digitals)) : ?>
						<div class="tab-pane fade active show" id="tab-packages_programs_digitals" role="tabpanel" aria-labelledby="aria-tab-packages_programs_digitals">
<?php /* */ ?>



							<div class="col-12 table-responsive p-0">

								<table class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th class="lcn text-center"><?= __('Lcn') ?></th>
											<th class="name"><?= __('Name') ?></th>
											<th class="qam text-center"><?= __('Qam') ?></th>
											<th class="sid text-center"><?= __('Sid') ?></th>
											<th class="comment"><?= __('Comment') ?></th>
											<th class="changed"><?= __('Changed') ?></th>
											<th class="boolean to-delete"><?= __('To Delete') ?></th>
											<th class="boolean visible"><?= __('Visible') ?></th>
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
										<?php foreach ($ackey->packages_programs_digitals as $packagesProgramsDigitals) : ?>
										<tr aria-expanded="true">
											<td class="lcn text-center"><?= h($packagesProgramsDigitals->lcn) ?></td>
											<td class="name"><?= h($packagesProgramsDigitals->program->name) ?></td>
											<td class="qam text-center"><?= h($packagesProgramsDigitals->qam) ?></td>
											<td class="sid text-center"><?= h($packagesProgramsDigitals->sid) ?></td>
											<td class="comment"><?= h($packagesProgramsDigitals->comment) ?></td>
											<td class="changed"><?= h($packagesProgramsDigitals->changed) ?></td>
											<td class="boolean to-delete" to-delete="<?= h($packagesProgramsDigitals->to_delete) ?>"><?= h($packagesProgramsDigitals->to_delete) ?></td>
											<td class="boolean visible" visible="<?= h($packagesProgramsDigitals->visible) ?>"><?= h($packagesProgramsDigitals->visible) ?></td>
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
												<?php //= $this->Form->postLink('<i class="fas fa-remove"></i>', ['action' => 'delete', $ackey->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $ackey->id), 'class' => 'btn btn-sm bg-gradient-danger action-button-delete']) ?>						
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
<?php //NINCS TEXT ?>
