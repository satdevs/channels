<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Version $version
 */
?>
<?php // Baked at 2021.10.28. 15:35:35  ?>
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
				<?= $this->Form->create($version, ['id' => 'main-form', 'class'=>'form-horizontal']) ?>

					<!-- card-body -->
					<div class="card-body" style="opacity: 0;">
						<!-- 6. string -->
						<div class="form-group row">
							<label for="name" class="col-sm-2 col-form-label"><?= __('Name') ?>:</label>
							<div class="col-sm-9">
								<?= $this->Form->control('name', ['placeholder' => __(''), 'type'=>'text', 'class'=>'form-control', 'label' => false, 'empty' => true, 'autofocus' => true, "required" => true]) ?>
							</div>
						</div>

						<!-- 2. integer -->
						<div class="form-group row">
							<label for="headstation_id" class="col-sm-2 col-form-label"><?= __('Source version') ?>:</label>
							<div class="col-sm-4">
								<?php echo $this->Form->control('version_id', ['options' => $versions, 'class' => 'selectpicker form-control integer', 'title' => 'Kérem válasszon...', 'data-live-search' => 'true', 'data-actions-box' => 'true', 'label' => false]); ?>
							</div>										
							<label for="headstation_id" class="col-sm-2 col-form-label"><?= __('Destionation Headstation') ?>:</label>
							<div class="col-sm-3">
								<?php echo $this->Form->control('headstation_id', ['options' => $headstations, 'class' => 'selectpicker form-control integer', 'title' => 'Kérem válasszon...', 'data-live-search' => 'true', 'data-actions-box' => 'true', 'label' => false]); ?>
							</div>										
						</div>

						<hr>

						<!-- 7. text -->
						<div class="form-group row">
							<label for="comment" class="col-sm-2 col-form-label"><?= __('Comment') ?>:</label>
							<div class="col-sm-10">
								<?= $this->Form->textarea('comment', ['type'=>'textarea', 'class'=>'summernote', 'label' => false, 'placeholder'=>__('Place some text here'), 'style'=>'width: 100%; height: 249px;', "required" => false ]) ?>
							</div>
						</div>

						<!-- 5. boolean -->
<?php /*
						<div class="form-group row">
							<div class="offset-sm-2 col-sm-10">
								<?= $this->Form->control('current', ['id'=>'current', 'div'=>false, 'type'=>'checkbox', 'class'=>'flat', 'label'=>false, 'templates'=>[ 'inputContainer' => '{{content}}', 'inputContainerError' => '{{content}}{{error}}' ], "required" => false ]); ?>
								<label class="checkbox" for="current"><?= __('Current') ?></label>
							</div>
						</div>
*/ ?>
<?php /*
						<?php // https://tempusdominus.github.io/bootstrap-4/Usage/ ?>
						<!-- 3. date -->
						<div class="form-group row">
							<label for="date-from" class="col-sm-2 col-form-label"><?= __('Date From') ?>:</label>
							<div class="col-md-10 col-sm-10 col-xs-10">
								<div class="input-group date" id="date-from" data-target-input="nearest">
									<?= $this->Form->control('date_from', ['type'=>'text', 'label'=>false, 'placeholder' => __('Date From'), 'class'=>'form-control datetimepicker-input', 'data-target'=>'#date-from', 'autocomplete'=>'off', 'data-validity-message'=>__('This field cannot be left empty'), "required" => false]); ?>
									<div class="input-group-append" data-target="#date-from" data-toggle="datetimepicker">
										<div class="input-group-text"><i class="icon-calendar"></i></div>
									</div>
								</div>
							</div>
						</div>

						<?php // https://tempusdominus.github.io/bootstrap-4/Usage/ ?>
						<!-- 3. date -->
						<div class="form-group row">
							<label for="date-to" class="col-sm-2 col-form-label"><?= __('Date To') ?>:</label>
							<div class="col-md-10 col-sm-10 col-xs-10">
								<div class="input-group date" id="date-to" data-target-input="nearest">
									<?= $this->Form->control('date_to', ['type'=>'text', 'label'=>false, 'placeholder' => __('Date To'), 'class'=>'form-control datetimepicker-input', 'data-target'=>'#date-to', 'autocomplete'=>'off', 'data-validity-message'=>__('This field cannot be left empty'), "required" => false]); ?>
									<div class="input-group-append" data-target="#date-to" data-toggle="datetimepicker">
										<div class="input-group-text"><i class="icon-calendar"></i></div>
									</div>
								</div>
							</div>
						</div>
*/ ?>

						<div class="form-group row">
							<div class="offset-sm-2 col-sm-10">
								<?= $this->Form->control('print_image', ['id'=>'print_image', 'div'=>false, 'type'=>'checkbox', 'class'=>'flat', 'label'=>false, 'templates'=>[ 'inputContainer' => '{{content}}', 'inputContainerError' => '{{content}}{{error}}' ], "required" => false ]); ?>
								<label class="checkbox" for="print-image"><?= __('Print image') ?>&nbsp;<i class="icon-info-circled" style="color: gray;" data-bs-tooltip="tooltip" data-bs-placement="top" title="<?= __('Whether or not to print the uploaded image on the second page ') ?>"></i></label>
							</div>
						</div>

						<!-- 5. boolean -->
						<div class="form-group row">
							<div class="offset-sm-2 col-sm-10">
								<?= $this->Form->control('visible', ['id'=>'visible', 'div'=>false, 'type'=>'checkbox', 'class'=>'flat', 'label'=>false, 'checked' => true, 'templates'=>[ 'inputContainer' => '{{content}}', 'inputContainerError' => '{{content}}{{error}}' ], "required" => false, 'checked' => false ]); ?>
								<label class="checkbox" for="visible"><?= __('Visible') ?>&nbsp;<i class="icon-info-circled" style="color: gray;" data-bs-tooltip="tooltip" data-bs-placement="top" title="<?= __('When cloning, appears in the source list') ?>"></i></label>
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
			"JeffAdmin./plugins/bootstrap-select-1.13.14/dist/css/bootstrap-select.min",
			"JeffAdmin./plugins/summernote/summernote-bs4.min",
		],
		['block' => true]);


	$this->Html->script(
		[
			"JeffAdmin./plugins/icheck-1.x/icheck.min",
			"JeffAdmin./plugins/bootstrap-select-1.13.14/dist/js/bootstrap-select.min",
			"JeffAdmin./plugins/moment/moment.min",
			"JeffAdmin./plugins/moment/locale/hu",
			"JeffAdmin./plugins/bootstrap4-datetime-picker-rails-master/vendor/assets/javascripts/tempusdominus-bootstrap-4.min",
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
<?php /* https://tempusdominus.github.io/bootstrap-4/Usage/ */ ?>
			
			tooltips = {
				today: 			'<?= __('Go to today') ?>',
				clear: 			'<?= __('Clear selection') ?>',
				close: 			'<?= __('Close the picker') ?>',
				selectMonth: 	'<?= __('Select Month') ?>',
				prevMonth: 		'<?= __('Previous Month') ?>',
				nextMonth: 		'<?= __('Next Month') ?>',
				selectYear: 	'<?= __('Select Year') ?>',
				prevYear: 		'<?= __('Previous Year') ?>',
				nextYear: 		'<?= __('Next Year') ?>',
				selectDecade: 	'<?= __('Select Decade') ?>',
				prevDecade: 	'<?= __('Previous Decade') ?>',
				nextDecade: 	'<?= __('Next Decade') ?>',
				prevCentury: 	'<?= __('Previous Century') ?>',
				nextCentury: 	'<?= __('Next Century') ?>',
				incrementHour: 	'<?= __('Increment Hour') ?>',
				pickHour: 		'<?= __('Pick Hour') ?>',
				decrementHour:	'<?= __('Decrement Hour') ?>',
				incrementMinute:'<?= __('Increment Minute') ?>',
				pickMinute: 	'<?= __('Pick Minute') ?>',
				decrementMinute:'<?= __('Decrement Minute') ?>',
				incrementSecond:'<?= __('Increment Second') ?>',
				pickSecond: 	'<?= __('Pick Second') ?>',
				decrementSecond:'<?= __('Decrement Second') ?>'
			}
			
			$('#date-from').datetimepicker({
				locale: moment.locale("hu"),	
				format: 'L',
<?php //if(isset($version->date_from) && $version->date_from != '00:00:00' && $version->date_from != '0:' ){ ?>
<?php if(!empty($version->date_from)){ ?>
				defaultDate: moment("<?= FrozenTime::parse($version->date_from)->i18nFormat('yyyy-MM-dd') ?>", "YYYY-MM-DD"),
<?php } ?>
				//locale: moment.locale(),
				buttons: {
					showToday: true,
					showClear: true,
					showClose: true
				},				
				//viewDate: true,
				icons: {
					time: "icon-clock",
					date: "icon-calendar",
					up: "icon-up-big",
					down: "icon-down-big",
	                previous: 'icon-left-big',
	                next: 'icon-right-big',
	                today: 'icon-calendar',
	                clear: 'icon-trash-empty',
	                close: 'icon-window-close-o'
				},
				tooltips: tooltips
			});

			$('#date-to').datetimepicker({
				locale: moment.locale("hu"),	
				format: 'L',
<?php //if(isset($version->date_to) && $version->date_to != '00:00:00' && $version->date_to != '0:' ){ ?>
<?php if(!empty($version->date_to)){ ?>
				defaultDate: moment("<?= FrozenTime::parse($version->date_to)->i18nFormat('yyyy-MM-dd') ?>", "YYYY-MM-DD"),
<?php } ?>
				//locale: moment.locale(),
				buttons: {
					showToday: true,
					showClear: true,
					showClose: true
				},				
				//viewDate: true,
				icons: {
					time: "icon-clock",
					date: "icon-calendar",
					up: "icon-up-big",
					down: "icon-down-big",
	                previous: 'icon-left-big',
	                next: 'icon-right-big',
	                today: 'icon-calendar',
	                clear: 'icon-trash-empty',
	                close: 'icon-window-close-o'
				},
				tooltips: tooltips
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

