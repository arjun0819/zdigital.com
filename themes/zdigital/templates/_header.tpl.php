<?php
/**
 * @file: _header.tpl.php
 * @author: arjun<arjun0819@gmail.com>                                      
 * @date: Mar 27, 2014 3:52:51 PM
 * @encode: UTF-8
 */?>
<div id="header">
	<div class="main-wrapper container">
	
		<div class="visible-xs">
			<ul class="small-menu" style="display: none">
				<li><a class="menu-trigger" href="#xs-menu" data-toggle="tab"><span class="glyphicon glyphicon-align-justify"></span>Menu</a></li>
				<li><a class="menu-trigger" href="#xs-login" data-toggle="tab"><span class="glyphicon glyphicon-user">Login</span></a></li>
				<li><a class="menu-trigger" href="#xs-search" data-toggle="tab"><span class="glyphicon glyphicon-search">Search</span></a></li>
			</ul>
			
			<div class="small-menu row">
				<div class="col-xs-4">
					<a class="menu-trigger" href="#xs-menu" data-toggle="tab"><i class="glyphicon glyphicon-align-justify"></i>Menu</a>
				</div>
				<div class="col-xs-4">
					<?php if(user_is_anonymous()): ?>
						<a class="menu-trigger" href="#xs-login" data-toggle="tab"><i class="glyphicon glyphicon-user"></i>Login</a>
					<?php else: ?>
						<!-- <a href="<?php echo url('user');?>"><?php echo $user->name; ?><i class="glyphicon glyphicon-log-out"></i></a> -->
					<?php endif;?>
				</div>
				<div class="col-xs-4">
					<a class="menu-trigger" href="#xs-search" data-toggle="tab"><i class="glyphicon glyphicon-search"></i>Search</a>
				</div>
			</div>
			
			<div class="tab-content row" style="border:0">
				<div id="xs-menu" class="col-xs-12 tab-pane" role="menu"><?php 
					echo theme('links', array('links'=>menu_navigation_links('main-menu'))); 
				?></div>
					
				<div id="xs-login" class="col-xs-12 tab-pane"><?php 
					$login_block = module_invoke('user', 'block_view', 'login');
					echo render($login_block['content']);
				?></div>
					
				<div id="xs-search" class="col-xs-12 tab-pane"><?php 
					$search_block = module_invoke('search', 'block_view', '');
					echo render($search_block['content']);
				?></div>
			</div>
		</div>
			
		<div class="row">
			<div id="menu" class="menu clearfix col-xs-8 hidden-xs">
				<?php echo theme('links', array('links'=>menu_navigation_links('main-menu'))); ?>
				<div class="clearfix"></div>
			</div>
			
			<div id="header-blocks" class="col-xs-4 hidden-xs">
			
				<div id="social_icons">
					<ul>
					<?php 
						$social_settings = array('linkin'=>t('Link In'), 'youtube'=>t('Youtube'), 'facebook'=>t('Facebook'), 'twitter'=>t('Twitter')  );
						foreach($social_settings as $key => $value):
					?>
						<li><a href="<?php echo theme_get_setting($key); ?>"><img alt="" src="<?php echo base_path().$directory.'/images/'.$key.'.png'; ?>"></a></li>
					<?php endforeach; ?>
						<!-- <li><a href="<?php echo theme_get_setting('linkin'); ?>"><img alt="" src="<?php echo base_path().$directory.'/images/GTB_Comps_14.png'; ?>"></a></li>
						<li><a href="<?php echo theme_get_setting('youtube'); ?>"><img alt="" src="<?php echo base_path().$directory.'/images/GTB_Comps_12.png'; ?>"></a></li>
						<li><a href="<?php echo theme_get_setting('facebook'); ?>"><img alt="" src="<?php echo base_path().$directory.'/images/GTB_Comps_10.png'; ?>"></a></li>
						<li><a href="<?php echo theme_get_setting('twitter'); ?>"><img alt="" src="<?php echo base_path().$directory.'/images/GTB_Comps_08.png'; ?>"></a></li> -->
					</ul>
				</div>
				<?php echo render($page['header']); ?>
			</div>
		</div>
		
	</div>
</div>

<div id="feature" class="main-wrapper container">
	<div class=" clearfix row">
		<div id="second-menu" class="menu clearfix col-xs-12">
			<ul>
				<li class="contacto"><?php echo l(t('<span class="icon"></span>Contacto'), 'contact', array('html'=>true));?></li>
				<li class="home"><a href="<?php echo url('<front>');?>"><span class="icon"></span><?php echo t('INÍCIO'); ?></a></li>
				<?php if(user_is_anonymous()):?>
				<li class="suscribe"><?php echo l(t('<span></span>Suscribe'), 'user/register', array('html'=>true)); ?></li>
				<?php else: ?>
				<li class="account"><?php echo l(t('<span class="glyphicon glyphicon-cog"></span>ADMINISTRAR CUENTA'), 'user/change_password', 
						array('html'=>true, 'attributes'=>array('data-toggle'=>'modal', 'data-target'=>'#modal', 'data-remote'=>"true"))); ?></li>
				<?php endif; ?>
				<?php if(user_is_anonymous()):?>
				<li class="login"><?php echo l(t('<span class="icon"></span>Login'), 'user/login', array('html'=>true));?></li>
				<?php else:?>
				<li class="logout"><?php echo l(t('<span class="glyphicon glyphicon-log-out"></span>Logout'), 'user/logout', array('html'=>true));?></li>
				<?php endif; ?>
			</ul>
			<div class="clearfix"></div>
		</div>
		
		<div id="logo" class="col-sm-6"><?php 
			$logo_block = block_load('block', 10);
			if(!empty($logo_block->bid)){
				$block = _block_get_renderable_array( _block_render_blocks( array($logo_block)));
				echo render($block);
		?>
		<?php }else{?>
			<a href="<?php echo url('<front>');?>"><img alt="<?php echo t('Zdigital.Com');?>" src="<?php echo base_path().$directory.'/logo_with_slogan.png'?>" class="img-responsive"></a>
		<?php }?>
		</div>
			
		
		<!-- <div id="social" class="hidden-xs col-xs-6">
			<ul>
				<li class="last" style="margin-right:0"><a href="<?php echo url('user'); ?>"><img src="<?php echo base_path().$directory.'/images/v_05.jpg'; ?>" class="img-responsive" /></a></li>
				<li class="first"><a href="<?php echo url('node/2'); ?>"><img src='<?php echo base_path().$directory.'/images/v_03.jpg'?>' class="img-responsive" /></a></li>
			</ul>
		</div>-->
		<div id="ggao" class='col-sm-6 row hidden-xs'>
			<div class="col-sm-7 col-sm-offset-1 ">
			<?php 
			$social_block = block_load('block', 11);
			if(!empty($social_block->bid)){
				$block = _block_get_renderable_array( _block_render_blocks( array($social_block)));
				echo render($block);
			}else{
			?>
				<a href="<?php echo url('node/2'); ?>"><img src='<?php echo base_path().$directory.'/images/v_03.jpg'?>' /></a>
			<?php }?>
			</div>
			<div class="col-sm-4"><a href="<?php echo url('user'); ?>"><img src="<?php echo base_path().$directory.'/images/v_05.jpg'; ?>" /></a></div>
		</div>
		<div id="logo-area" class="clearfix col-xs-12"></div>
		
		<div id="bottom" class="clearfix col-xs-12"><img alt="" src="<?php echo base_path().$directory.'/images/top-spr_44.png'; ?>"  class="img-responsive" /></div>
	</div>
</div>