<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Package $package
 */
?>
<?php // Baked at 2021.10.29. 11:23:10  ?>
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
				<?= $this->Form->create($package, ['id' => 'main-form', 'class'=>'form-horizontal']) ?>
			  
					<!-- card-body -->
					<div class="card-body" style="opacity: 0;">

						<!-- 6. string -->
						<div class="form-group row">
							<label for="name" class="col-sm-2 col-form-label"><?= __('Internal name') ?>:</label>
							<div class="col-sm-9">
								<?= $this->Form->control('name', ['placeholder' => __('Name for internal use'), 'type'=>'text', 'class'=>'form-control', 'label' => false, 'empty' => true, 'autofocus' => true, "required" => true]) ?>
							</div>
						</div>

						<!-- 6. string -->
						<div class="form-group row">
							<label for="shortname" class="col-sm-2 col-form-label"><?= __('Shortname') ?>:</label>
							<div class="col-sm-9">
								<?= $this->Form->control('shortname', ['placeholder' => __('For example: F.P.'), 'type'=>'text', 'class'=>'form-control', 'label' => false, 'autofocus' => false, "required" => true]) ?>
							</div>
						</div>

						<!-- 6. string -->
						<div class="form-group row">
							<label for="popular-name" class="col-sm-2 col-form-label"><?= __('Popular Name') ?>:</label>
							<div class="col-sm-9">
								<?= $this->Form->control('popular_name', ['placeholder' => __('For example: Family Package'), 'type'=>'text', 'class'=>'form-control', 'label' => false, 'autofocus' => false, "required" => true]) ?>
							</div>
						</div>

						<!-- 6. string -->
						<div class="form-group row">
							<label for="broadcast" class="col-sm-2 col-form-label"><?= __('Broadcast') ?>:</label>
							<div class="col-sm-4">
								<?= $this->Form->control('broadcast', ['options' => $broadcasts, 'class' => 'selectpicker form-control integer', 'title' => 'Kérem válasszon...', 'data-live-search' => 'true', 'data-actions-box' => 'true', 'label' => false, "required" => true, "empty" => false]) ?>
							</div>
						</div>

						<!-- 1. integer -->
						<div class="form-group row">
							<label for="version_id" class="col-sm-2 col-form-label"><?= __('Packagegroup') ?>:</label>
							<div class="col-sm-4">
								<?php echo $this->Form->control('packagegroup_id', ['options' => $packagegroups, 'class' => 'selectpicker form-control integer', 'title' => 'Kérem válasszon...', 'data-live-search' => 'true', 'data-actions-box' => 'true', 'label' => false, "required" => true, "empty" => false]); ?>
							</div>										
						</div>

						<!-- 6. string -->
						<div class="form-group row">
							<label for="popular-comment-analog" class="col-sm-2 col-form-label"><?= __('Popular Comment Analog') ?>:</label>
							<div class="col-sm-9">
								<?= $this->Form->control('popular_comment_analog', ['placeholder' => __('For example: discounted (loyalty fee) gross: 3735 HUF/month'), 'type'=>'text', 'class'=>'form-control', 'label' => false, 'autofocus' => false, "required" => false]) ?>
							</div>
						</div>

						<!-- 6. string -->
						<div class="form-group row">
							<label for="popular-comment-digital" class="col-sm-2 col-form-label"><?= __('Popular Comment Digital') ?>:</label>
							<div class="col-sm-9">
								<?= $this->Form->control('popular_comment_digital', ['placeholder' => __('For example: discounted (loyalty fee) gross: 3735 HUF/month'), 'type'=>'text', 'class'=>'form-control', 'label' => false, 'autofocus' => false, "required" => false]) ?>
							</div>
						</div>

						<!-- 4.a. integer -->
						<div class="form-group row">
							<label for="price" class="col-sm-2 col-form-label"><?= __('Price') ?>:</label>
							<div class="input-group col-xs-12 col-sm-10 col-md-8 col-lg-4 col-xl-3">
								<?= $this->Form->control('price', ['type' => 'number', 'placeholder' => __('Package price'), 'class' => 'form-control number', 'label' => false, 'templates'=>[ 'inputContainer' => '{{content}}', 'inputContainerError' => '{{content}}{{error}}'], "required" => true, "empty" => false]) ?>
							</div>
							<div class="input-group col-xs-12 col-sm-10 col-md-8 col-lg-4 col-xl-3" style="padding-top: 6px;">
								&larr;&nbsp;Egyelőre nem jelenik meg sehol!
							</div>
						</div>

<?php /*
						<!-- 6. string -->
						<div class="form-group row">
							<label for="external-name" class="col-sm-2 col-form-label"><?= __('External Name') ?>:</label>
							<div class="col-sm-9">
								<?= $this->Form->control('external_name', ['placeholder' => __(''), 'type'=>'text', 'class'=>'form-control', 'label' => false, 'autofocus' => false, "required" => false]) ?>
							</div>
						</div>
*/ ?>

						<!-- 7. text -->
						<div class="form-group row">
							<label for="comment" class="col-sm-2 col-form-label"><?= __('Comment') ?>:</label>
							<div class="col-sm-10">
								<?= $this->Form->textarea('comment', ['type'=>'textarea', 'class'=>'summernote', 'label' => false, 'placeholder'=>__('Place some text here'), 'style'=>'width: 100%; height: 249px;', "required" => false ]) ?>
							</div>
						</div>



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
								<?= $this->Form->control('pos', ['type' => 'number', 'class' => 'form-control number spinner', 'label' => false, 'templates'=>[ 'inputContainer' => '{{content}}', 'inputContainerError' => '{{content}}{{error}}'], 'value' => 500, 'step' => '10', "required" => false]) ?>
							</div>
						</div>

<?php if(isset($config['form_show_counts']) && $config['form_show_counts']){ ?>
						<!-- 4.b. integer -->
						<div class="form-group row">
							<label for="programs-count" class="col-sm-2 col-form-label"><?= __('Programs Count') ?>:</label>
							<div class="input-group col-xs-12 col-sm-10 col-md-8 col-lg-4 col-xl-4">
								<div class="count"><?= $package->programs_count ?></div>
							</div>
						</div>
<?php } ?>

						<!-- 8.  -->
						<div class="form-group row">
							<label for="" class="col-sm-2 col-form-label"><?= __('Programs') ?>:</label>
							<div class="col-sm-9">
								<?php echo $this->Form->control('programs._ids', ['options' => $programs, 'class' => 'selectpicker form-control ', 'title' => 'Kérem válasszon...', 'data-live-search' => 'true', 'data-actions-box' => 'true', 'label' => false, 'empty' => true, 'multiple'=>true]) ?>

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

