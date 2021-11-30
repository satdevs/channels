<?php // Baked at 2021.10.29. 10:29:45  ?>
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PackagesProgramsDigital $packagesProgramsDigital
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

	if(!isset($layoutPackagesProgramsDigitalsLastId)){
		$layoutPackagesProgramsDigitalsLastId = 0;
	}
	
?>
		<div class="view col-sm-10 packagesProgramsDigitals">
			<div class="card card-lightblue">
				<div class="card-header">
					<h3 class="card-title"><?= $title ?>: <?= h($packagesProgramsDigital->name) ?></h3>
				</div><!-- /.card-header -->
				<div class="card-body">
				
					<div class="form-group row">
						<label for="name" class="col-sm-2 col-form-label"><?= __('id') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field non-associated">
								<?= $packagesProgramsDigital->id ?>
							</div>
						</div>
					</div>
					<div class="form-group row"><!-- 1. -->
						<label for="name" class="col-sm-2 col-form-label"><?= __('Version') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field associated">
								<?= $packagesProgramsDigital->has('version') ? $this->Html->link($packagesProgramsDigital->version->name, ['controller' => 'Versions', 'action' => 'view', $packagesProgramsDigital->version->id], ['escape' => false, 'class' => 'btn btn-sm btn-default']) : '' ?>&nbsp;
							</div>
						</div>
					</div>
					<div class="form-group row"><!-- 1. -->
						<label for="name" class="col-sm-2 col-form-label"><?= __('Package') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field associated">
								<?= $packagesProgramsDigital->has('package') ? $this->Html->link($packagesProgramsDigital->package->name, ['controller' => 'Packages', 'action' => 'view', $packagesProgramsDigital->package->id], ['escape' => false, 'class' => 'btn btn-sm btn-default']) : '' ?>&nbsp;
							</div>
						</div>
					</div>
					<div class="form-group row"><!-- 1. -->
						<label for="name" class="col-sm-2 col-form-label"><?= __('Program') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field associated">
								<?= $packagesProgramsDigital->has('program') ? $this->Html->link($packagesProgramsDigital->program->name, ['controller' => 'Programs', 'action' => 'view', $packagesProgramsDigital->program->id], ['escape' => false, 'class' => 'btn btn-sm btn-default']) : '' ?>&nbsp;
							</div>
						</div>
					</div>
					<div class="form-group row"><!-- 1. -->
						<label for="name" class="col-sm-2 col-form-label"><?= __('Multicast Source') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field associated">
							
								<?php
									//debug($packagesProgramsDigital->program);
								?>
							
								<?= $packagesProgramsDigital->has('program') ? $this->Html->link($packagesProgramsDigital->program->multicast_source->name, ['controller' => 'MulticastSources', 'action' => 'view', $packagesProgramsDigital->program->multicast_source->id], ['escape' => false, 'class' => 'btn btn-sm btn-default']) : '' ?>&nbsp;
							</div>
						</div>
					</div>
					<div class="form-group row"><!-- 1. -->
						<label for="name" class="col-sm-2 col-form-label"><?= __('Ackey') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field associated">
								<?= $packagesProgramsDigital->has('ackey') ? $this->Html->link($packagesProgramsDigital->ackey->name, ['controller' => 'Ackeys', 'action' => 'view', $packagesProgramsDigital->ackey->id], ['escape' => false, 'class' => 'btn btn-sm btn-default']) : '' ?>&nbsp;
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 2. -->
						<label for="name" class="col-sm-2 col-form-label"><?= __('Name') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field non-associated">
								<?php 
									if(!empty($packagesProgramsDigital->name)){
										echo h($packagesProgramsDigital->name);
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
									if(!empty($packagesProgramsDigital->short_name)){
										echo h($packagesProgramsDigital->short_name);
									}else{
										echo "&nbsp;";
									}
								?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 2. -->
						<label for="channel" class="col-sm-2 col-form-label"><?= __('Channel') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field non-associated">
								<?php 
									if(!empty($packagesProgramsDigital->channel)){
										echo h($packagesProgramsDigital->channel);
									}else{
										echo "&nbsp;";
									}
								?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 2. -->
						<label for="qam" class="col-sm-2 col-form-label"><?= __('Qam') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field non-associated">
								<?php 
									if(!empty($packagesProgramsDigital->qam)){
										echo h($packagesProgramsDigital->qam);
									}else{
										echo "&nbsp;";
									}
								?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 2. -->
						<label for="public-comment" class="col-sm-2 col-form-label"><?= __('Public Comment') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field non-associated">
								<?php 
									if(!empty($packagesProgramsDigital->public_comment)){
										echo h($packagesProgramsDigital->public_comment);
									}else{
										echo "&nbsp;";
									}
								?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 2. -->
						<label for="changed" class="col-sm-2 col-form-label"><?= __('Changed') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field non-associated">
								<?php 
									if(!empty($packagesProgramsDigital->changed)){
										echo h($packagesProgramsDigital->changed);
									}else{
										echo "&nbsp;";
									}
								?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 4. -->
						<label for="packageorder" class="col-sm-2 col-form-label"><?= __('Packageorder') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field number">
								<?php
									if(!empty($packagesProgramsDigital->packageorder)){
										echo $this->Number->format($packagesProgramsDigital->packageorder);
									}else{
										echo "&nbsp;";
									}
								?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 4. -->
						<label for="lcn" class="col-sm-2 col-form-label"><?= __('Lcn') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field number">
								<?php
									if(!empty($packagesProgramsDigital->lcn)){
										echo $this->Number->format($packagesProgramsDigital->lcn);
									}else{
										echo "&nbsp;";
									}
								?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 4. -->
						<label for="frequency" class="col-sm-2 col-form-label"><?= __('Frequency') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field number">
								<?php
									if(!empty($packagesProgramsDigital->frequency)){
										echo $this->Number->format($packagesProgramsDigital->frequency);
									}else{
										echo "&nbsp;";
									}
								?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 4. -->
						<label for="sid" class="col-sm-2 col-form-label"><?= __('Sid') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field number">
								<?php
									if(!empty($packagesProgramsDigital->sid)){
										echo $this->Number->format($packagesProgramsDigital->sid);
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
									if(!empty($packagesProgramsDigital->pos)){
										echo $this->Number->format($packagesProgramsDigital->pos);
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
									if(!empty($packagesProgramsDigital->created)){
										echo h($packagesProgramsDigital->created);
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
									if(!empty($packagesProgramsDigital->modified)){
										echo h($packagesProgramsDigital->modified);
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
								<?php // $this->Text->autoParagraph(h($packagesProgramsDigital->comment)); ?>
								<?php
									if(!empty($packagesProgramsDigital->comment)){
										//echo $this->Text->autoParagraph($packagesProgramsDigital->comment) . "<br>";
										echo $packagesProgramsDigital->comment . "<br>";
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
					</ul>
				</div>


				<div class="card-body p-0">
					<div class="tab-content" id="custom-tabs-four-tabContent">

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

