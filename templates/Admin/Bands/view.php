<?php // Baked at 2021.10.29. 10:29:45  ?>
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Band $band
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

	if(!isset($layoutBandsLastId)){
		$layoutBandsLastId = 0;
	}
	
?>
		<div class="view col-sm-10 bands">
			<div class="card card-lightblue">
				<div class="card-header">
					<h3 class="card-title"><?= $title ?>: <?= h($band->name) ?></h3>
				</div><!-- /.card-header -->
				<div class="card-body">
				
					<div class="form-group row">
						<label for="name" class="col-sm-2 col-form-label"><?= __('id') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field non-associated">
								<?= $band->id ?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 2. -->
						<label for="name" class="col-sm-2 col-form-label"><?= __('Name') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field non-associated">
								<?php 
									if(!empty($band->name)){
										echo h($band->name);
									}else{
										echo "&nbsp;";
									}
								?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 2. -->
						<label for="band" class="col-sm-2 col-form-label"><?= __('Band') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field non-associated">
								<?php 
									if(!empty($band->band)){
										echo h($band->band);
									}else{
										echo "&nbsp;";
									}
								?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 2. -->
						<label for="type" class="col-sm-2 col-form-label"><?= __('Type') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field non-associated">
								<?php 
									if(!empty($band->type)){
										echo h($band_types[$band->type]);
									}else{
										echo "&nbsp;";
									}
								?>&nbsp;
								(<?php 
									if(!empty($band->broadcast)){
										echo h($band->broadcast);
									}else{
										echo "&nbsp;";
									}
								?>)
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 4. -->
						<label for="frequency" class="col-sm-2 col-form-label"><?= __('Video Frequency') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field number">
								<?php
									if(!empty($band->frequency)){
										echo $this->Number->format($band->frequency);
									}else{
										echo "&nbsp;";
									}
								?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 4. -->
						<label for="bandwidth" class="col-sm-2 col-form-label"><?= __('Band width') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field number">
								<?php
									if(!empty($band->bandwidth)){
										echo $this->Number->format($band->bandwidth);
									}else{
										echo "&nbsp;";
									}
								?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 4. -->
						<label for="audio-frequency" class="col-sm-2 col-form-label"><?= __('Audio Frequency') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field number">
								<?php
									if(!empty($band->audio_frequency)){
										echo $this->Number->format($band->audio_frequency);
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
									if(!empty($band->pos)){
										echo $this->Number->format($band->pos);
									}else{
										echo "&nbsp;";
									}
								?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 4. -->
						<label for="packages-programs-count" class="col-sm-2 col-form-label"><?= __('Packages Programs Count') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field number">
								<?php
									if(!empty($band->packages_programs_count)){
										echo $this->Number->format($band->packages_programs_count);
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
									if(!empty($band->modified)){
										echo h($band->modified);
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
									if(!empty($band->created)){
										echo h($band->created);
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
<?php if (!empty($band->packages_programs_analogs)) : ?>
						<li class="nav-item view-tab">
							<a class="nav-link active" id="related-tab-packages_programs_analogs" data-toggle="pill" href="#tab-packages_programs_analogs" role="tab" aria-controls="aria-tab-packages_programs_analogs" aria-selected="true"><?= __('Packages Programs Analogs') ?></a>
						</li>
<?php endif; ?>
					</ul>
				</div>


				<div class="card-body p-0">
					<div class="tab-content" id="custom-tabs-four-tabContent">
<?php if (!empty($band->packages_programs_analogs)) : ?>
						<div class="tab-pane fade active show" id="tab-packages_programs_analogs" role="tabpanel" aria-labelledby="aria-tab-packages_programs_analogs">
<?php /* */ ?>



							<div class="col-12 table-responsive p-0">

								<table class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th class="lcn text-center"><?= __('Lcn') ?></th>
											<th class="Name"><?= __('Name') ?></th>
<?php /*
											<th class="Channel text-center"><?= __('Channel') ?></th>
											<th class="Frequency text-center"><?= __('Frequency') ?></th>
*/ ?>
											<th class="Comment text-center"><?= __('Comment') ?></th>
											<th class="Changed"><?= __('Changed') ?></th>
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
										<?php foreach ($band->packages_programs_analogs as $packagesProgramsAnalogs) : ?>
										<tr aria-expanded="true">
											<td class="lcn text-center"><?= h($packagesProgramsAnalogs->lcn) ?></td>
											<td class="name"><?= h($packagesProgramsAnalogs->name) ?></td>
<?php /*
											<td class="channel"><?= h($packagesProgramsAnalogs->channel) ?></td>
											<td class="frequency"><?= h($packagesProgramsAnalogs->frequency) ?></td>
*/ ?>
											<td class="comment"><?= h($packagesProgramsAnalogs->comment) ?></td>
											<td class="changed"><?= h($packagesProgramsAnalogs->changed) ?></td>
											<td class="boolean to-delete" to-delete="<?= h($packagesProgramsAnalogs->to_delete) ?>"><?= h($packagesProgramsAnalogs->to_delete) ?></td>
											<td class="boolean visible" visible="<?= h($packagesProgramsAnalogs->visible) ?>"><?= h($packagesProgramsAnalogs->visible) ?></td>
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
												<?php //= $this->Form->postLink('<i class="fas fa-remove"></i>', ['action' => 'delete', $band->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $band->id), 'class' => 'btn btn-sm bg-gradient-danger action-button-delete']) ?>						
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

					</div>
				</div><!-- /.card -->
			</div>
		</div>

<!-- ######################################################################################################################## -->
<!-- ######################################################################################################################## -->
<!-- ######################################################################################################################## -->
<?php //NINCS TEXT ?>
