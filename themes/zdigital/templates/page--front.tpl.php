<?php
/**
 * @file: page.tpl.php
 * @author: arjun<arjun0819@gmail.com>                                      
 * @date: Mar 14, 2014 2:30:47 PM
 * @encode: UTF-8
 */
?>
<?php include_once '_header.tpl.php';?>

<div id="main" class="clearfix">
	<div class="main-wrapper container">
	
		
		<div id="front-slide"><?php 
// 			$slideshow = module_invoke('zdigital', 'block_view', 'slideshow');
// 			echo $slideshow['content'];
		?>
			<?php echo render($page['front_feature'])?>
		</div>
		
		<div id="front-feature" class="clearfix row">
			<!-- <div id="instructor" class="col-sm-6 col-xs-12"> -->
			<div class="col-sm-6 col-xs-12">
				<div id="subscribe">
				<?php echo render($page['front_instructor']);?>
				<div class="clearfix"></div>
				</div>
			</div>
			
			<div class="col-sm-6 col-xs-12">
				<div id="subscribe">
					<?php echo render($page['front_subscribe']); ?>
					
					<!-- <div class="content">
						<div class="first img"><img src="<?php echo base_path().$directory.'/images/subscribe_50.png'?>" /></div>
						<div class="spr"><img alt="" src="<?php echo base_path().$directory.'/images/subscribe_52.png'?>"></div>
						<div class="desc">
							<h4 class="media-heading"><?php echo t('Suscribe Ahora!'); ?></h4>
							<p><?php echo t('Etiam vel sapien imperdiet, vestibulum felis vitae, suscipit diam. Praesent eu aliquam nisl.'); ?></p>
							<p>
								<a href="<?php echo url('user/register');?>" class="button"><?php echo t('Suscribe');?></a>
								<a href="<?php echo url('node/3'); ?>" class="readmore"><b class="icon"></b><?php echo t('Learn More'); ?></a>
							</p>
						</div>
					</div> -->
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include_once '_footer.tpl.php';?>