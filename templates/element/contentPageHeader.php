    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?= (isset($version_name)) ? $version_name : 'Aktuális verzió' ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
				<?php //= $this->Html->link(__('Change version'), ['controller' => 'Versions', 'action' => 'index']) ?>
				<!--a href="#">Kezdőlap</a-->
			  </li>
              <!--li class="breadcrumb-item active">Termékek</li-->
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
