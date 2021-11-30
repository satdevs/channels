<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Headstation $headstation
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
				<?= $this->Form->create($headstation, ['id' => 'main-form', 'class'=>'form-horizontal']) ?>
			  
					<!-- card-body -->
					<div class="card-body" style="opacity: 0;">
						<!-- 6. string -->
						<div class="form-group row">
							<label for="name" class="col-sm-2 col-form-label"><?= __('Name') ?>:</label>
							<div class="col-sm-9">
								<?= $this->Form->control('name', ['placeholder' => __(''), 'type'=>'text', 'class'=>'form-control', 'label' => false, 'empty' => true, 'autofocus' => true, "required" => true]) ?>
							</div>
						</div>

						<!-- 6. string -->
						<div class="form-group row">
							<label for="place" class="col-sm-2 col-form-label"><?= __('Place') ?>:</label>
							<div class="col-sm-9">
								<?= $this->Form->control('place', ['placeholder' => __(''), 'type'=>'text', 'class'=>'form-control', 'label' => false, 'autofocus' => false, "required" => false]) ?>
							</div>
						</div>

						<!-- 6. string -->
						<div class="form-group row">
							<label for="last-sentence" class="col-sm-2 col-form-label"><?= __('Last Sentence') ?>:</label>
							<div class="col-sm-9">
								<?= $this->Form->control('last_sentence', ['placeholder' => __(''), 'type'=>'text', 'class'=>'form-control', 'label' => false, 'autofocus' => false, "required" => false]) ?>
							</div>
						</div>

						<!-- 6. string -->
						<div class="form-group row">
							<label for="last-digital-sentence" class="col-sm-2 col-form-label"><?= __('Last Digital Sentence') ?>:</label>
							<div class="col-sm-9">
								<?= $this->Form->control('last_digital_sentence', ['placeholder' => __(''), 'type'=>'text', 'class'=>'form-control', 'label' => false, 'autofocus' => false, "required" => false]) ?>
							</div>
						</div>

						<!-- 7. text -->
						<div class="form-group row">
							<label for="comment" class="col-sm-2 col-form-label"><?= __('Comment') ?>:</label>
							<div class="col-sm-10">
								<?= $this->Form->textarea('comment', ['type'=>'textarea', 'class'=>'summernote', 'label' => false, 'placeholder'=>__('Place some text here'), 'style'=>'width: 100%; height: 249px;', "required" => false ]) ?>
							</div>
						</div>

<?php if(isset($config['form_show_counts']) && $config['form_show_counts']){ ?>
						<!-- 4.b. integer -->
						<div class="form-group row">
							<label for="package-count" class="col-sm-2 col-form-label"><?= __('Package Count') ?>:</label>
							<div class="input-group col-xs-12 col-sm-10 col-md-8 col-lg-4 col-xl-4">
								<div class="count"><?= $headstation->package_count ?></div>
							</div>
						</div>
<?php } ?>

<?php if(isset($config['form_show_counts']) && $config['form_show_counts']){ ?>
						<!-- 4.b. integer -->
						<div class="form-group row">
							<label for="city-count" class="col-sm-2 col-form-label"><?= __('City Count') ?>:</label>
							<div class="input-group col-xs-12 col-sm-10 col-md-8 col-lg-4 col-xl-4">
								<div class="count"><?= $headstation->city_count ?></div>
							</div>
						</div>
<?php } ?>

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
			"JeffAdmin./plugins/summernote/summernote-bs4.min",
		],
		['block' => true]);


	$this->Html->script(
		[
			"JeffAdmin./plugins/icheck-1.x/icheck.min",
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

