<?php /* 
	HIBÁS: https://www.codethepixel.com/cakephp/cakephp-4-print-pdf-using-cakepdf
	
	https://www.codethepixel.com/ctp/articles/CakePHP-4-Print-PDF-Using-CakePDF
	composer remove vendor/package

 */
	// A Configban előfordulhatnak és azokat a cake i18n nem veszi figyelembe
	__('Print');
	__('Print PDF');
	__('You are not authorized to access that location.');


use Cake\Core\Configure;
 
?>
<?php	
	$chanels_count = count($channels->toArray());
	$digitals_count = count($digitals->toArray());
	// A bal oldali táblázatban a max sorok száma. Ha páratlan, akkor a baloldaliban legyen +1 sor. Azaz elfelezi a táblázatot jobb és baloldalra.
	$max_rows_in_left_table = (round($chanels_count / 2, 0) % 2 == 0) ? round($chanels_count / 2, 0): round($chanels_count / 2, 0) + 1;

	$has_new = false;
	foreach($channels as $channel){
		if($channel->program->new == true){
			$has_new = true;
			break;
		}
	}

	$has_new_digital = false;
	foreach($digitals as $channel){
		if($channel->program->new == true){
			$has_new_digital = true;
			break;
		}
	}
	
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
	<meta name="description" content="<?= __('Channel list') ?>">
	<meta name="keywords" content="<?= __('Channels') ?>">
	<meta name="author" content="<?= __('Sághy-Sat Kft. • 7754 Bóly, Ady E. u. 9. • Tel.: +36 69/368-162 • E-mail: info@saghysat.hu • WEB: www.saghysat.hu') ?>">
  
	<title><?= __('Channels') ?>: <?= $this->fetch('title') ?></title>
	
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?= $this->Html->css(['https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&family=Roboto:wght@300&display=swap']) ?>

	<?= $this->Html->css('channels.digitals', ['fullBase' => true]) ?>
	
</head>
<body>
	<div id="page-1">

		<header>
			<div class="logo">
				<?= $this->Html->image('logo.png', ['class' =>'logo', 'fullBase' => true]); ?>
			</div>
			<div class="title">
<?php if($print_city_name){ ?>
				<h1><?= $city->name ?> <?= __('digital channel distribution') ?></h1>
<?php }else{ ?>
				<h1><?= __('Digital channel distribution') ?></h1>
<?php } ?>
				<p class="subtitle">Sághy-Sat Kft. 7754 Bóly, Ady E. u. 9. - Tel.: 69/696-696 - Web: www.saghysat.hu - Email: info@saghysat.hu</p>
			</div>
			<div class="date">
				<b><?= date("Y.m.d.") ?></b><br>
				<span class="time"><?= date("H:i:s") ?></span>
			</div>
		</header>
		
		<?php //debug($channels->toArray()); ?>		
		<?php 
		//foreach($channels as $channel){ 
		//	if($channel->lcn == 141){
		//		debug($channel->toArray());
		//	}
		//}
		?>		
		<?php //debug($digitals->toArray()); ?>
		
		<div class="clear-both"></div>
	
		<div class="left">
			<table id="table-left" cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<th class="lcn"><?= __('LCN') ?></th>
						<th class="name"><?= __('Program') ?></th>
<?php if($has_new){ ?>
						<th class="new"><?= __('New') ?></th>
<?php } ?>
						<th class="feature"><?= __('Feature') ?></th>
						<th class="language"><?= __('Language') ?></th>
						<th class="family-package"><?= __('Fam') ?></th>
					</tr>
				</thead>
			
				<tbody>		
<?php $i = 1; ?>
<?php $last_lcn = 0; ?>
<?php foreach($channels as $channel){ ?>
<?php if($i++ <= $max_rows_in_left_table){ ?>
<?php $last_lcn = $channel->lcn; ?>
					<tr>
						<td class="lcn"><?= $channel->lcn ?></td>
						<td class="name"><?= $channel->program->name ?></td>
<?php if($has_new){ ?>
						<td class="new"><?= ($channel->program->new) ? 'X' : '' ?></td>
<?php } ?>
						<td class="feature"><?= $channel->program->feature->name ?></td>
						<td class="language"><?= $channel->program->language->name ?></td>
						<td class="family-package"><?= ($channel->package->packagegroup->id == 2) ? 'X' : '' ?></td>
					</tr>
				
<?php } ?>
<?php } ?>
				</tbody>
			</table>
		</div>

		<div class="right">
			<table id="table-right" cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<th class="lcn"><?= __('LCN') ?></th>
						<th class="name"><?= __('Program') ?></th>
<?php if($has_new){ ?>
						<th class="new"><?= __('New') ?></th>
<?php } ?>
						<th class="feature"><?= __('Feature') ?></th>
						<th class="language"><?= __('Language') ?></th>
						<th class="family-package"><?= __('Fam') ?></th>
					</tr>
				</thead>
				
				<tbody>		
<?php $i = 1; ?>
<?php foreach($channels as $channel){ ?>
<?php if($channel->lcn > $last_lcn){ ?>
		
					<tr>
						<td class="lcn"><?= $channel->lcn ?></td>
						<td class="name"><?= $channel->program->name ?></td>
<?php if($has_new){ ?>
						<td class="new"><?= ($channel->program->new) ? 'X' : '' ?></td>
<?php } ?>
						<td class="feature"><?= $channel->program->feature->name ?></td>
						<td class="language"><?= $channel->program->language->name ?></td>
						<td class="family-package"><?= ($channel->package->packagegroup->id == 2) ? 'X' : '' ?></td>
					</tr>
				
<?php } ?>
<?php } ?>
				</tbody>
			</table>
		</div>

		<footer>
			<?= $city->headstation->last_digital_sentence ?><br>
			<i><?= __("The number of channels indicates the default setting on the TV. The custom order may be different.") ?></i>
		</footer>

	</div><!-- /#page-1 -->
	
<?php /*
	#########################################################################################################################
	#########################################################################################################################
	######################### DIGITÁLIS #####################################################################################
	#########################################################################################################################
	#########################################################################################################################
*/ ?>

	<pagebreak /> <!-- for PDF -->


	<div id="page-2">

		<div class="title-digitals">
			<h3><?= __('Our packages are available for a monthly fee.') ?></h3>
		</div>
		
		<div class="container">
			<columns column-count="2">
<?php
	$colspan = 3;
	if($has_new_digital){
		$colspan = 4;
	}
?>						
<?php $package = 0; ?>
<?php $columnbreak = 1; ?>
<?php $first = true; ?>
<?php foreach($digitals as $channel){ ?>
<?php 	if(!$first && $package != $channel->package->id){ ?>
					</tbody>
				</table>
			</div>
<?php 		if($columnbreak >= 3){ ?>

			<columnbreak />
			
<?php 		$columnbreak = 1; ?>
<?php 		} ?>
<?php 		$columnbreak++; ?>
<?php 	} ?>
<?php 	if($package != $channel->package->id){ ?>
			<div class="digitals">
				<table class="table-digitals" cellpadding="0" cellspacing="0">
					<thead>
						<tr>
							<th class="title" colspan="<?= $colspan ?>"><?= $channel->package->popular_name . " - " . $channel->package->popular_comment_digital?></th>
						</tr>
						<tr>
							<th class="lcn"><?= __('LCN') ?></th>
							<th class="name"><?= __('Program') ?></th>
<?php if($has_new_digital){ ?>
							<th class="new"><?= __('New') ?></th>
<?php } ?>
							<th class="feature"><?= __('Feature') ?></th>
						</tr>
					</thead>
					<tbody>
<?php 	} ?>
						<tr>
							<td class="lcn"><?= $channel->lcn ?></td>
							<td class="name"><?= $channel->program->name ?></td>
<?php 	if($has_new_digital){ ?>
							<td class="new"><?= ($channel->program->new) ? 'X' : '' ?></td>
<?php 	} ?>
							<td class="feature"><?= $channel->program->feature->name ?></td>
						</tr>
<?php 	$package = $channel->package->id; ?>
<?php 	$first = false; ?>
<?php } ?>
					</tbody>
				</table>
			</div><!-- /.digitals -->
			
		</columns>
		</div><!-- /.container -->
	</div><!-- /.page -->
	<columns column-count="1">

<?php /*
// A few settings
$img_file = 'raju.jpg';

// Read image path, convert to base64 encoding
$imgData = base64_encode(file_get_contents($img_file));

// Format the image SRC:  data:{mime};base64,{data};
$src = 'data: '.mime_content_type($img_file).';base64,'.$imgData;

// Echo out a sample image
echo '<img src="'.$src.'">';





*/ ?>

<?php
	$img_file = Configure::read('UploadDir') . 'advertising.jpg';
	$imgData = base64_encode(file_get_contents($img_file));
	$src = 'data: '.mime_content_type($img_file).';base64,'.$imgData;

	//$fh = fopen( Configure::read('UploadDir') . 'advertising.jpg', "r" );
	//if ($fh) {
		//while (($buffer = fgets($fh, 4096)) !== false) {
		//	$image .= $buffer;
		//}
		//fclose($fh);
	//}
?>


<?php if($print_image){ ?>
		<div class="advertising">
			<?php //= $this->Html->image('/cities/photo/advertising.jpg', ['fullBase' => true]); ?>
			<!--img src="http://192.168.254.215:8003/channels/cities/photo/advertising.jpg" /-->
			<img src="<?= $src ?>" />
		</div>
<?php } ?>
		
	</columns>
	
	<?php /* https://mpdf.github.io/headers-footers/method-2.html */ ?>
	<htmlpagefooter name="myHTMLFooter">
	<?php /*
		<footer>
			<?= $city->headstation->last_digital_sentence ?><br>
			<?= __("The number of channels indicates the default setting on the TV. The custom order may be different.") ?>
		</footer>
	*/ ?>
	</htmlpagefooter>

</body>
</html>

