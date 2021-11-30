<?php // Baked at 2021.11.22. 14:36:23  ?>
<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $myUser
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

	if(!isset($layoutUsersLastId)){
		$layoutUsersLastId = 0;
	}
	
?>
		<div class="view col-sm-10 users">
			<div class="card card-lightblue">
				<div class="card-header">
					<h3 class="card-title"><?= $title ?>: <?= h($myUser->username) ?></h3>
				</div><!-- /.card-header -->
				<div class="card-body">
				
					<div class="form-group row"><!-- 2. -->
						<label for="id" class="col-sm-2 col-form-label"><?= __('Id') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field non-associated">
								<?php 
									if(!empty($myUser->id)){
										echo h($myUser->id);
									}else{
										echo "&nbsp;";
									}
								?>
							</div>
						</div>
					</div>
<?php /*
					<div class="form-group row"><!-- 2. -->
						<label for="username" class="col-sm-2 col-form-label"><?= __('Username') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field non-associated">
								<?php 
									if(!empty($myUser->username)){
										echo h($myUser->username);
									}else{
										echo "&nbsp;";
									}
								?>
							</div>
						</div>
					</div>
*/ ?>

					<div class="form-group row"><!-- 2. -->
						<label for="email" class="col-sm-2 col-form-label"><?= __d('cake_d_c/users', 'Email') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field non-associated">
								<?php 
									if(!empty($myUser->email)){
										echo h($myUser->email);
									}else{
										echo "&nbsp;";
									}
								?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 2. -->
						<label for="last-name" class="col-sm-2 col-form-label"><?= __d('cake_d_c/users', 'Last name') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field non-associated">
								<?php 
									if(!empty($myUser->last_name)){
										echo h($myUser->last_name);
									}else{
										echo "&nbsp;";
									}
								?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 2. -->
						<label for="first-name" class="col-sm-2 col-form-label"><?= __d('cake_d_c/users', 'First name') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field non-associated">
								<?php 
									if(!empty($myUser->first_name)){
										echo h($myUser->first_name);
									}else{
										echo "&nbsp;";
									}
								?>
							</div>
						</div>
					</div>


					<div class="form-group row"><!-- 2. -->
						<label for="secret" class="col-sm-2 col-form-label"><?= __d('cake_d_c/users', 'Secret') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field non-associated">
								<?php 
									if(!empty($myUser->secret)){
										echo h($myUser->secret);
									}else{
										echo "&nbsp;";
									}
								?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 2. -->
						<label for="role" class="col-sm-2 col-form-label"><?= __d('cake_d_c/users', 'Role') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field non-associated">
								<?php 
									if(!empty($myUser->role)){
										echo $roles[$myUser->role];
									}else{
										echo "&nbsp;";
									}
								?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 2. -->
						<label for="additional-data" class="col-sm-2 col-form-label"><?= __d('cake_d_c/users', 'Additional Data') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field non-associated">
								<?php 
									if(!empty($myUser->additional_data)){
										echo h($myUser->additional_data);
									}else{
										echo "&nbsp;";
									}
								?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 5. -->
						<label for="activation-date" class="col-sm-2 col-form-label"><?= __d('cake_d_c/users', 'Activation Date') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field date">
								<?php
									if(!empty($myUser->activation_date)){
										echo h($myUser->activation_date);
									}else{
										echo "&nbsp;";
									}
								?>
							</div>
						</div>
					</div>

					<div class="form-group row"><!-- 5. -->
						<label for="tos-date" class="col-sm-2 col-form-label"><?= __d('cake_d_c/users', 'Tos Date') ?>:</label>
						<div class="col-sm-9">
							<div class="view-field date">
								<?php
									if(!empty($myUser->tos_date)){
										echo h($myUser->tos_date);
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
									if(!empty($myUser->created)){
										echo h($myUser->created);
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
									if(!empty($myUser->modified)){
										echo h($myUser->modified);
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
<?php if (!empty($myUser->social_accounts)): ?>
						<li class="nav-item view-tab">
							<a class="nav-link active" id="related-tab-social-accounts" data-toggle="pill" href="#tab-social-accounts" role="tab" aria-controls="aria-tab-social-accounts" aria-selected="true"><?= __('Social Accounts') ?></a>
						</li>
<?php endif; ?>
					</ul>
				</div>


				<div class="card-body p-0">
					<div class="tab-content" id="custom-tabs-four-tabContent">
<?php if (!empty($myUser->social_accounts)) : ?>
						<div class="tab-pane fade active show" id="tab-social-accounts" role="tabpanel" aria-labelledby="aria-tab-social-accounts">
<?php /* */ ?>



							<div class="col-12 table-responsive p-0">

								<table class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th class="id"><?= __('Id') ?></th>
											<th class="user-id"><?= __('User Id') ?></th>
											<th class="provider"><?= __('Provider') ?></th>
											<th class="username"><?= __('Username') ?></th>
											<th class="reference"><?= __('Reference') ?></th>
											<th class="avatar"><?= __('Avatar') ?></th>
											<th class="description"><?= __('Description') ?></th>
											<th class="link"><?= __('Link') ?></th>
											<th class="token"><?= __('Token') ?></th>
											<th class="token-secret"><?= __('Token Secret') ?></th>
											<th class="token-expires"><?= __('Token Expires') ?></th>
											<th class="active"><?= __('Active') ?></th>
											<th class="data"><?= __('Data') ?></th>
											<th class="created"><?= __('Created') ?></th>
											<th class="modified"><?= __('Modified') ?></th>
<?php if(isset($config['index_show_actions']) && $config['index_show_actions']){ ?>
											<th class="actions"><?= __('Actions') ?></th>
<?php } ?>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($myUser->social_accounts as $socialAccounts): ?>
										<tr aria-expanded="true">
<?php if($config['index_show_actions'] !== null && $config['index_show_actions']){ ?>
											<td class="actions text-center">
<?php 	if($config['index_enable_view'] !== null && $config['index_enable_view']){ ?>					  
												<?= $this->Html->link('<i class="fas fa-eye"></i>', ['controller' => 'SocialAccounts', 'action' => 'view', $socialAccounts->id], ['escape' => false, 'class' => 'btn btn-sm bg-gradient-warning action-button-view', 'data-bs-tooltip'=>'tooltip', 'data-bs-placement'=>'top', 'title' => __('View this record')]) ?>
<?php 	} ?>
<?php 	if($config['index_enable_edit'] !== null && $config['index_enable_edit']){ ?>					  
												<?= $this->Html->link('<i class="fas fa-edit"></i>', ['controller' => 'SocialAccounts', 'action' => 'edit', $socialAccounts->id], ['escape' => false, 'class' => 'btn btn-sm bg-gradient-success action-button-edit', 'data-bs-tooltip'=>'tooltip', 'data-bs-placement'=>'top', 'title' => __('Edit this record')]) ?>
<?php 	} ?>			
<?php 	if($config['index_enable_delete'] !== null && $config['index_enable_delete']){ ?>					  
												<?php //= $this->Form->postLink('<i class="fas fa-remove"></i>', ['action' => 'delete', $myUser->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $myUser->id), 'class' => 'btn btn-sm bg-gradient-danger action-button-delete']) ?>						
												<?= $this->Form->postLink('', ['controller' => 'SocialAccounts', 'action' => 'delete', $socialAccounts->id], ['class'=>'crose-btn hide-postlink action-button-delete']) ?>
												<a href="javascript:;" class="btn btn-sm btn-danger delete postlink-delete" data-bs-tooltip="tooltip" data-bs-placement="top" title="<?= __("Delete this record!") ?>" text="<?= h($socialAccounts->name) ?>" subText="<?= __("You will not be able to revert this!") ?>" confirmButtonText="<?= __("Yes, delete it!") ?>" cancelButtonText="<?= __("Cancel") ?>"><i class="icon-minus"></i></a>
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
