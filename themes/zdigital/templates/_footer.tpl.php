<?php
/**
 * @file: _footer.tpl.php
 * @author: arjun<arjun0819@gmail.com>                                      
 * @date: Mar 27, 2014 3:51:15 PM
 * @encode: UTF-8
 */
?>
<!-- Footer Wrapper -->
<div id="footer" class="clearfix">
	<div class="main-wrapper container clearfix">
	
		<div id="footer-menu" class="menu clearfix">
			<?php echo theme('links', array('links' => menu_navigation_links('menu-footer-menu'))); ?>
		</div>
		
		<div class="spr"><span></span></div>
		
		<div id="copyright">
			<div id="parent-site">
				<!-- <?php echo t('Parent Site:'); ?> <a href="<?php echo url('<front>'); ?>">copyright © 2014 Z101digital.com</a> -->
				© 2014 <a href="<?php echo url('<front>'); ?>">zdigital</a>  | Pagina de origen: <a href="http://www.z101digital.com">z101digital</a>  |  Todos los derechos reservados
			</div>
			
			<div id="social_icons">
				<ul>
					<?php $social_settings = array('twitter'=>t('Twitter'), 'facebook'=>t('Facebook'), 'youtube'=>t('Youtube'), 'linkin'=>t('Link In')); 
					foreach($social_settings as $key => $title) :
					?>
					
					<?php if(theme_get_setting($key)): ?>
					<li><a href="<?php echo theme_get_setting($key); ?>" title="<?php echo $title; ?>"><span class="icon <?php echo $key; ?>"></span></a></li>
					<?php endif; ?>
					<?php 
					endforeach;
					?>
				</ul>
			</div>
		</div>
		<?php print render($page['footer']); ?>
	</div>
</div> <!-- /#footer -->