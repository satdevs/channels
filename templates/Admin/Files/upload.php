<?php 
	// https://webscodex.com/how-to-upload-file-in-cakephp-4-part-5/
	//-------- to translate -------
	__('Upload image');
	__('Print Image');
	
?>
		<div class="edit col-sm-10">
			<div class="card card-lightblue">
				<div class="card-header">
					<h3 class="card-title"><?= $title ?></h3>
				</div><!-- /.card-header -->

				<!-- form start -->
				<?php echo $this->Form->create(null, ['class'=>'form-horizontal', 'enctype'=>'multipart/form-data']) ?>
			  
					<!-- card-body -->
					<div class="card-body" style="opacity: 1;">

						<div class="form-group row">
							<label for="name" class="col-sm-2 col-form-label"><?= __('File') ?>:</label>
							<div class="col-sm-9">
								<?= $this->Form->control('post_image', ['type'=>'file', 'label' => false, 'empty' => false, 'class'=>'form-control', 'required'=>true, 'autofocus' => true]); ?><br>
								<p><?= __('If the uploaded image does not appear here, press Ctrl+F5 to refresh the entire page.') ?></p>
								<p><?= __('You can set image printing on and off for versions menu.') ?></p>
							</div>
						</div>

					</div><!-- /.card-body -->
				
					<div class="card-footer">
						<button type="submit" class="offset-sm-2 btn btn-info" data-bs-tooltip="tooltip" data-bs-placement="top" title="<?= __('Save') ?>" ><span class="btn-label"><i class="fa fa-save"></i></span> <?= __('Save') ?></button>
						<?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class'=>'btn btn-default', 'role'=>'button', 'escape'=>false, 'data-bs-tooltip'=>'tooltip', 'data-bs-placement'=>'top', 'title' => __('Back to list without save') ] ) ?>
					</div><!-- /.card-footer -->


					<div class="form-group row p-3">
						<label for="name" class="col-sm-2 col-form-label"><?= __('Image') ?>:</label>
						<div class="col-sm-9">
							<?= $this->Html->image('advertising.jpg', ['class' => 'img img-responsive', 'style'=>'width: 100%; border: 1px solid lightgray; padding: 5px; background: white;']); ?>
						</div>
					</div>


				<?= $this->Form->end() ?>

            </div>
        </div>

