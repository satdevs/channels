<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Program $program
 */
?>
<?php // Baked at 2021.10.29. 11:23:04  ?>
<?php use Cake\Core\Configure; ?>
<?php use Cake\I18n\FrozenTime; ?>
<?php use Cake\I18n\I18n; ?>
<?php 
	$prefix = strtolower( $this->request->getParam('prefix') );	
	$config = Configure::read('Theme.' . $prefix);	
	$config['form_show_counts'] = false;
?>
<?php $locale = I18n::getLocale(); ?>
<?php //$formats = Configure::read('Formats'); ?>
<?php //$format = $formats[$locale]; ?>
		<div class="add col-sm-10">
		
			<div class="card card-lightblue card-tabs">
				<div class="card-header p-0 pt-1">
					<ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
						<li class="pt-2 px-3">
							<h3 class="card-title"><?= __('Edit') ?>: <?= $title ?><i id="card-loader-icon" class="icon-spin4 animate-spin" style="font-size: 24px; opacity: 1; color: white; font-weight: bold;"></i></h3>
						</li>
						<li class="nav-item">
							<a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true"><?= __('Basic') ?></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false"><?= __('More') ?></a>
						</li>
					</ul>
				</div>
				
				<!-- form start -->
				<?= $this->Form->create($program, ['id' => 'main-form', 'class'=>'form-horizontal']) ?>
					<div class="card-body" style="opacity: 0;">
				
						<div class="tab-content" id="custom-tabs-two-tabContent">
							<div class="tab-pane fade active show" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">

								<!-- 6. string -->
								<div class="form-group row">
									<label for="name" class="col-sm-2 col-form-label"><?= __('Name') ?>:</label>
									<div class="col-sm-9">
										<?= $this->Form->control('name', ['placeholder' => __(''), 'type'=>'text', 'class'=>'form-control', 'label' => false, 'empty' => true, 'autofocus' => true, "required" => true]) ?>
									</div>
								</div>

								<!-- 6. string -->
								<div class="form-group row">
									<label for="short-name" class="col-sm-2 col-form-label"><?= __('Short Name') ?>:</label>
									<div class="col-sm-9">
										<?= $this->Form->control('short_name', ['placeholder' => __(''), 'type'=>'text', 'class'=>'form-control', 'label' => false, 'autofocus' => false, "required" => false]) ?>
									</div>
								</div>

								<!-- 1. integer -->
								<div class="form-group row">
									<label for="feature_id" class="col-sm-2 col-form-label"><?= __('Feature Id') ?>:</label>
									<div class="col-sm-4">
										<?php echo $this->Form->control('feature_id', ['options' => $features, 'class' => 'selectpicker form-control integer', 'title' => 'Kérem válasszon...', 'data-live-search' => 'true', 'data-actions-box' => 'true', 'label' => false]); ?>
									</div>										
								</div>

								<!-- 1. integer -->
								<div class="form-group row">
									<label for="language_id" class="col-sm-2 col-form-label"><?= __('Language Id') ?>:</label>
									<div class="col-sm-4">
										<?php echo $this->Form->control('language_id', ['options' => $languages, 'class' => 'selectpicker form-control integer', 'title' => 'Kérem válasszon...', 'data-live-search' => 'true', 'data-actions-box' => 'true', 'label' => false]); ?>
									</div>										
								</div>
								
								<!-- 2. integer -->
								<div class="form-group row">
									<label for="multicast_source_id" class="col-sm-2 col-form-label"><?= __('Multicast Source Id') ?>:</label>
									<div class="col-sm-4">
										<?php echo $this->Form->control('multicast_source_id', ['options' => $multicastSources, 'class' => 'selectpicker form-control integer', 'title' => 'Kérem válasszon...', 'data-live-search' => 'true', 'data-actions-box' => 'true', 'label' => false]); ?>
									</div>										
								</div>

								<!-- 5. boolean -->
								<div class="form-group row">
									<div class="offset-sm-2 col-sm-10">
										<?= $this->Form->control('new', ['id'=>'new', 'div'=>false, 'type'=>'checkbox', 'class'=>'flat', 'label'=>false, 'templates'=>[ 'inputContainer' => '{{content}}', 'inputContainerError' => '{{content}}{{error}}' ], "required" => false ]); ?>
										<label class="checkbox" for="new"><?= __('New') ?>&nbsp;<i class="icon-info-circled" style="color: gray;" data-bs-tooltip="tooltip" data-bs-placement="top" title="<?= __('When a new program is added, the x-principle will be marked as new in the channel list.') ?>"></i></label>
									</div>
								</div>

								<!-- 8.  -->
								<div class="form-group row">
									<label for="" class="col-sm-2 col-form-label"><?= __('Packages') ?>:</label>
									<div class="col-sm-9">
										<?php echo $this->Form->control('packages._ids', ['options' => $packages, 'class' => 'selectpicker form-control ', 'title' => 'Kérem válasszon...', 'data-live-search' => 'true', 'data-actions-box' => 'true', 'label' => false, 'empty' => true, 'multiple'=>true]) ?>

									</div>
								</div>



								<hr>
								
								<!-- 5. boolean -->
								<div class="form-group row">
									<div class="offset-sm-2 col-sm-10">
										<?= $this->Form->control('visible', ['id'=>'visible', 'div'=>false, 'type'=>'checkbox', 'class'=>'flat', 'label'=>false, 'checked' => true, 'templates'=>[ 'inputContainer' => '{{content}}', 'inputContainerError' => '{{content}}{{error}}' ], "required" => false ]); ?>
										<label class="checkbox" for="visible"><?= __('Visible') ?></label>
									</div>
								</div>

								<!-- 4.a. integer -->
								<div class="form-group row">
									<label for="pos" class="col-sm-2 col-form-label"><?= __('Pos') ?>:</label>
									<div class="input-group col-xs-12 col-sm-10 col-md-8 col-lg-4 col-xl-3">
										<?= $this->Form->control('pos', ['type' => 'number', 'class' => 'form-control number spinner', 'label' => false, 'templates'=>[ 'inputContainer' => '{{content}}', 'inputContainerError' => '{{content}}{{error}}'], 'step' => '10', "required" => false]) ?>
									</div>
								</div>

<?php if(isset($config['form_show_counts']) && $config['form_show_counts']){ ?>
								<!-- 4.b. integer -->
								<div class="form-group row">
									<label for="packages-count" class="col-sm-2 col-form-label"><?= __('Packages Count') ?>:</label>
									<div class="input-group col-xs-12 col-sm-10 col-md-8 col-lg-4 col-xl-4">
										<div class="count"><?= $program->packages_count ?></div>
									</div>
								</div>
<?php } ?>


							</div>
							<div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">

								<!-- 6. string -->
								<div class="form-group row">
									<label for="logo-file" class="col-sm-2 col-form-label"><?= __('Logo File') ?>:</label>
									<div class="col-sm-9">
										<?= $this->Form->control('logo_file', ['placeholder' => __(''), 'type'=>'text', 'class'=>'form-control', 'label' => false, 'autofocus' => false, "required" => false]) ?>
									</div>
								</div>

								<!-- 6. string -->
								<div class="form-group row">
									<label for="logo-url" class="col-sm-2 col-form-label"><?= __('Logo Url') ?>:</label>
									<div class="col-sm-9">
										<?= $this->Form->control('logo_url', ['placeholder' => __(''), 'type'=>'text', 'class'=>'form-control', 'label' => false, 'autofocus' => false, "required" => false]) ?>
									</div>
								</div>

								<!-- 6. string -->
								<div class="form-group row">
									<label for="url" class="col-sm-2 col-form-label"><?= __('Url') ?>:</label>
									<div class="col-sm-9">
										<?= $this->Form->control('url', ['placeholder' => __(''), 'type'=>'text', 'class'=>'form-control', 'label' => false, 'autofocus' => false, "required" => false]) ?>
									</div>
								</div>

								<!-- 6. string -->
								<div class="form-group row">
									<label for="programs-url" class="col-sm-2 col-form-label"><?= __('Programs Url') ?>:</label>
									<div class="col-sm-9">
										<?= $this->Form->control('programs_url', ['placeholder' => __(''), 'type'=>'text', 'class'=>'form-control', 'label' => false, 'autofocus' => false, "required" => false]) ?>
									</div>
								</div>

								<!-- 6. string -->
								<div class="form-group row">
									<label for="email" class="col-sm-2 col-form-label"><?= __('Email') ?>:</label>
									<div class="col-sm-9">
										<?= $this->Form->control('email', ['placeholder' => __(''), 'type'=>'email', 'class'=>'form-control', 'label' => false, 'autofocus' => false, "required" => false]) ?>
									</div>
								</div>

								<!-- 6. string -->
								<div class="form-group row">
									<label for="address" class="col-sm-2 col-form-label"><?= __('Address') ?>:</label>
									<div class="col-sm-9">
										<?= $this->Form->control('address', ['placeholder' => __(''), 'type'=>'text', 'class'=>'form-control', 'label' => false, 'autofocus' => false, "required" => false]) ?>
									</div>
								</div>

								<!-- 6. string -->
								<div class="form-group row">
									<label for="phone" class="col-sm-2 col-form-label"><?= __('Phone') ?>:</label>
									<div class="col-sm-9">
										<?= $this->Form->control('phone', ['placeholder' => __(''), 'type'=>'tel', 'class'=>'form-control', 'label' => false, 'autofocus' => false, "required" => false]) ?>
									</div>
								</div>

								<!-- 7. text -->
								<div class="form-group row">
									<label for="comment" class="col-sm-2 col-form-label"><?= __('Comment') ?>:</label>
									<div class="col-sm-10">
										<?= $this->Form->textarea('comment', ['type'=>'textarea', 'class'=>'summernote', 'label' => false, 'placeholder'=>__('Place some text here'), 'style'=>'width: 100%; height: 249px;', "required" => false ]) ?>
									</div>
								</div>


							</div>
						</div>
					
					</div>

					<div class="card-footer">
						<button type="submit" class="offset-sm-2 btn btn-info" data-bs-tooltip="tooltip" data-bs-placement="top" title="<?= __('Save and back to list') ?>" ><span class="btn-label"><i class="fa fa-save"></i></span> <?= __('Save') ?></button>
						<?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class'=>'btn btn-default', 'role'=>'button', 'escape'=>false, 'data-bs-tooltip'=>'tooltip', 'data-bs-placement'=>'top', 'title' => __('Back to list without save') ] ) ?>
					</div><!-- /.card-footer -->

				<?= $this->Form->end() ?>
				
				<!-- /.card -->
			</div>

        </div>

<?php
	$this->Html->css(
		[
			"JeffAdmin./plugins/fontello/css/animation",
			"JeffAdmin./plugins/icheck-bootstrap/icheck-bootstrap.min",
			"JeffAdmin./plugins/icheck-1.x/skins/flat/blue",
			"JeffAdmin./plugins/bootstrap-select-1.13.14/dist/css/bootstrap-select.min",
			"JeffAdmin./plugins/summernote/summernote-bs4.min",
		],
		['block' => true]);


	$this->Html->script(
		[
			"JeffAdmin./plugins/icheck-1.x/icheck.min",
			"JeffAdmin./plugins/bootstrap-select-1.13.14/dist/js/bootstrap-select.min",
			"JeffAdmin./plugins/bootstrap-input-spinner-master/src/bootstrap-input-spinner",
			"JeffAdmin./plugins/summernote/summernote-bs4.min",
			"JeffAdmin./plugins/summernote/lang/summernote-hu-HU.min",
		],
		['block' => 'scriptBottom']
	);
?>

<?php $this->Html->scriptStart(['block' => 'javaScriptBottom']); ?>
		
		$(document).ready( function(){

			$('input[type="checkbox"]').iCheck({
				handle: 'checkbox',
				checkboxClass: 'icheckbox_flat-blue'
			});
			$('.summernote').summernote({
				height: 180,
				lang: 'hu-HU'
			});



<?php 		/* //$("input[type='number']").inputSpinner({ */ ?>
			$(".spinner").inputSpinner({
				decrementButton: "<strong>-</strong>",
				incrementButton: "<strong>+</strong>",
				groupClass: "", 						// css class of the resulting input-group
				buttonsClass: "btn-outline-secondary",
				buttonsWidth: "2.5rem",
				textAlign: "center",
				autoDelay: 500, 						// ms holding before auto value change
				autoInterval: 100, 						// speed of auto value change
				boostThreshold: 10, 					// boost after these steps
				boostMultiplier: "auto" 				// you can also set a constant number as multiplier
			});
<?php /*	// ----------- talán ----------
			$("input[data-bootstrap-switch]").each(function(){
				$(this).bootstrapSwitch('state', $(this).prop('checked'));
			});
*/ ?>

			$('#button-submit').click( function(){
				$('#main-form').submit();
			});			

			// --- to bottom ---
			$('.card-body').animate({opacity: '1'}, 500, 'linear');
			$('#card-loader-icon').animate({opacity: '0'}, 1000, 'linear');
			
		});
		
<?php $this->Html->scriptEnd(); ?>

