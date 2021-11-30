<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PackagesProgramsDigital $packagesProgramsDigital
 */
?>
<?php // Baked at 2021.10.29. 10:29:45  ?>
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
			<div class="card card-lightblue">
				<div class="card-header">
					<h3 class="card-title"><?= __('Add') ?>: <?= $title ?><i id="card-loader-icon" class="icon-spin4 animate-spin" style="font-size: 24px; opacity: 1; color: white; font-weight: bold;"></i></h3>
				</div><!-- /.card-header -->

				<!-- form start -->
				<?= $this->Form->create($packagesProgramsDigital, ['id' => 'main-form', 'class'=>'form-horizontal']) ?>
			  
					<!-- card-body -->
					<div class="card-body" style="opacity: 0;">

						<!-- 1. integer -->
						<div class="form-group row">
							<label for="package_id" class="col-sm-2 col-form-label"><?= __('Package Id') ?>:</label>
							<div class="col-sm-4">
								<?php echo $this->Form->control('package_id', ['options' => $packages, 'class' => 'selectpicker form-control integer', 'title' => 'Kérem válasszon...', 'data-live-search' => 'true', 'data-actions-box' => 'true', 'label' => false, 'empty' => false]); ?>
							</div>										
						</div>

						<!-- 1. integer -->
						<div class="form-group row">
							<label for="program_id" class="col-sm-2 col-form-label"><?= __('Program Id') ?>:</label>
							<div class="col-sm-4">
								<?php echo $this->Form->control('program_id', ['options' => $programs, 'class' => 'selectpicker form-control integer', 'title' => 'Kérem válasszon...', 'data-live-search' => 'true', 'data-actions-box' => 'true', 'label' => false, 'empty' => false]); ?>
							</div>										
						</div>

						<!-- 1. integer -->
						<div class="form-group row">
							<label for="ackey_id" class="col-sm-2 col-form-label"><?= __('Ackey Id') ?>:</label>
							<div class="col-sm-4">
								<?php echo $this->Form->control('ackey_id', ['options' => $ackeys, 'class' => 'selectpicker form-control integer', 'title' => 'Kérem válasszon...', 'data-live-search' => 'true', 'data-actions-box' => 'true', 'label' => false, 'empty' => false, 'value'=>1]); ?>
							</div>										
						</div>

<?php /*
						<!-- 4.a. tinyinteger -->
						<div class="form-group row">
							<label for="packageorder" class="col-sm-2 col-form-label"><?= __('Packageorder') ?>:</label>
							<div class="input-group col-xs-12 col-sm-10 col-md-8 col-lg-4 col-xl-3">
								<?= $this->Form->control('packageorder', ['type' => 'number', 'class' => 'form-control number', 'label' => false, 'templates'=>[ 'inputContainer' => '{{content}}', 'inputContainerError' => '{{content}}{{error}}'], "required" => false]) ?>
							</div>
						</div>
*/ ?>

						<!-- 6. string -->
						<div class="form-group row">
							<label for="name" class="col-sm-2 col-form-label"><?= __('Name') ?>:</label>
							<div class="col-sm-9">
								<?= $this->Form->control('name', ['placeholder' => __(''), 'type'=>'text', 'class'=>'form-control', 'label' => false, 'autofocus' => false, "required" => false]) ?>
							</div>
						</div>

						<!-- 6. string -->
						<div class="form-group row">
							<label for="short-name" class="col-sm-2 col-form-label"><?= __('Short Name') ?>:</label>
							<div class="col-sm-9">
								<?= $this->Form->control('short_name', ['placeholder' => __(''), 'type'=>'text', 'class'=>'form-control', 'label' => false, 'autofocus' => false, "required" => false]) ?>
							</div>
						</div>

						<!-- 4.a. integer -->
						<div class="form-group row">
							<label for="lcn" class="col-sm-2 col-form-label"><?= __('Lcn') ?>:</label>
							<div class="input-group col-xs-12 col-sm-10 col-md-8 col-lg-4 col-xl-3">
								<?= $this->Form->control('lcn', ['type' => 'number', 'class' => 'form-control number', 'label' => false, 'templates'=>[ 'inputContainer' => '{{content}}', 'inputContainerError' => '{{content}}{{error}}'], "required" => true]) ?>
							</div>
						</div>
<?php /*
						<!-- 6. string -->
						<div class="form-group row">
							<label for="channel" class="col-sm-2 col-form-label"><?= __('Channel') ?>:</label>
							<div class="col-sm-9">
								<?= $this->Form->control('channel', ['placeholder' => __(''), 'type'=>'text', 'class'=>'form-control', 'label' => false, 'autofocus' => false, "required" => false]) ?>
							</div>
						</div>

						<!-- 4.a. decimal -->
						<div class="form-group row">
							<label for="frequency" class="col-sm-2 col-form-label"><?= __('Frequency') ?>:</label>
							<div class="input-group col-xs-12 col-sm-10 col-md-8 col-lg-4 col-xl-3">
								<?= $this->Form->control('frequency', ['type' => 'number', 'class' => 'form-control number', 'label' => false, 'templates'=>[ 'inputContainer' => '{{content}}', 'inputContainerError' => '{{content}}{{error}}'], "required" => false]) ?>
							</div>
						</div>
*/ ?>
						<!-- 6. string -->
						<div class="form-group row">
							<label for="qam" class="col-sm-2 col-form-label"><?= __('Qam') ?>:</label>
							<div class="input-group col-xs-12 col-sm-10 col-md-8 col-lg-4 col-xl-3">
								<?= $this->Form->control('qam', ['placeholder' => __(''), 'type'=>'text', 'class'=>'form-control', 'label' => false, 'autofocus' => false, "required" => true]) ?>
							</div>
						</div>

						<!-- 4.a. integer -->
						<div class="form-group row">
							<label for="sid" class="col-sm-2 col-form-label"><?= __('Sid') ?>:</label>
							<div class="input-group col-xs-12 col-sm-10 col-md-8 col-lg-4 col-xl-3">
								<?= $this->Form->control('sid', ['type' => 'number', 'class' => 'form-control number', 'label' => false, 'templates'=>[ 'inputContainer' => '{{content}}', 'inputContainerError' => '{{content}}{{error}}'], "required" => true]) ?>
							</div>
						</div>

						<!-- 7. text -->
						<div class="form-group row">
							<label for="comment" class="col-sm-2 col-form-label"><?= __('Comment') ?>:</label>
							<div class="col-sm-10">
								<?= $this->Form->textarea('comment', ['type'=>'textarea', 'class'=>'summernote', 'label' => false, 'placeholder'=>__('Place some text here'), 'style'=>'width: 100%; height: 249px;', "required" => false ]) ?>
							</div>
						</div>

						<!-- 6. string -->
						<div class="form-group row">
							<label for="public-comment" class="col-sm-2 col-form-label"><?= __('Public Comment') ?>:</label>
							<div class="col-sm-9">
								<?= $this->Form->control('public_comment', ['placeholder' => __('For example: PLANNED'), 'type'=>'text', 'class'=>'form-control', 'label' => false, 'autofocus' => false, "required" => false]) ?>
							</div>
						</div>

						<!-- 6. string -->
						<div class="form-group row">
							<label for="changed" class="col-sm-2 col-form-label"><?= __('Changed') ?>:</label>
							<div class="col-sm-9">
								<?= $this->Form->control('changed', ['placeholder' => __(''), 'type'=>'text', 'class'=>'form-control', 'label' => false, 'autofocus' => false, "required" => false]) ?>
							</div>
						</div>

						<!-- 5. boolean -->
						<div class="form-group row">
							<div class="offset-sm-2 col-sm-10">
								<?= $this->Form->control('to_delete', ['id'=>'to_delete', 'div'=>false, 'type'=>'checkbox', 'class'=>'flat', 'label'=>false, 'templates'=>[ 'inputContainer' => '{{content}}', 'inputContainerError' => '{{content}}{{error}}' ], "required" => false ]); ?>
								<label class="checkbox" for="to-delete"><?= __('To Delete') ?>&nbsp;<i class="icon-info-circled" style="color: gray;" data-bs-tooltip="tooltip" data-bs-placement="top" title="<?= __('Mark for deletion. It will not be deleted immediately, but will be deleted for group deletions.') ?>"></i></label>
							</div>
						</div>

						<!-- 5. boolean -->
						<div class="form-group row">
							<div class="offset-sm-2 col-sm-10">
								<?= $this->Form->control('visible', ['id'=>'visible', 'div'=>false, 'type'=>'checkbox', 'class'=>'flat', 'label'=>false, 'templates'=>[ 'inputContainer' => '{{content}}', 'inputContainerError' => '{{content}}{{error}}' ], "required" => false ]); ?>
								<label class="checkbox" for="visible"><?= __('Visible') ?>&nbsp;<i class="icon-info-circled" style="color: gray;" data-bs-tooltip="tooltip" data-bs-placement="top" title="<?= __('Whether the channel list is displayed when printing') ?>"></i></label>								
							</div>
						</div>

						<!-- 4.a. integer -->
						<div class="form-group row">
							<label for="pos" class="col-sm-2 col-form-label"><?= __('Pos') ?>:</label>
							<div class="input-group col-xs-12 col-sm-10 col-md-8 col-lg-4 col-xl-3">
								<?= $this->Form->control('pos', ['type' => 'number', 'class' => 'form-control number spinner', 'label' => false, 'templates'=>[ 'inputContainer' => '{{content}}', 'inputContainerError' => '{{content}}{{error}}'], 'step' => '10', "required" => false]) ?>
							</div>
						</div>

					</div><!-- /.card-body -->
				
					<div class="card-footer">
						<button type="submit" class="offset-sm-2 btn btn-info" data-bs-tooltip="tooltip" data-bs-placement="top" title="<?= __('Save and back to list') ?>" ><span class="btn-label"><i class="fa fa-save"></i></span> <?= __('Save') ?></button>
						<?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class'=>'btn btn-default', 'role'=>'button', 'escape'=>false, 'data-bs-tooltip'=>'tooltip', 'data-bs-placement'=>'top', 'title' => __('Back to list without save') ] ) ?>
					</div><!-- /.card-footer -->

				<?= $this->Form->end() ?>

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
			});			$('.summernote').summernote({
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

