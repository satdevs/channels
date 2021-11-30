    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
		  
			
			<?php if(empty($version_id) && $controller != 'Versions'){ ?>
				&nbsp;<?php //= $this->Html->link('<b>' . __('Please select version') . '</b>', ['controller' => 'Versions', 'action' => 'index'], ['escape' => false, 'class' => 'btn btn-danger btn-lg']) ?>
			<?php }else{ ?>
				<h1 class="m-0"><?= $version_name ?></h1>
			<?php } ?>
			
			
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
				<?= $this->Html->link(__('Change version'), ['controller' => 'Versions', 'action' => 'index']) ?>
				<!--a href="#">Kezdőlap</a-->
			  </li>
              <!--li class="breadcrumb-item active">Termékek</li-->
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
