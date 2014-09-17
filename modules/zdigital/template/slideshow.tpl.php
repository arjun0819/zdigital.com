
<div id="sideshow">
	<div class="sl_content">
		<ul class="slide">
			<?php 
				$i=0;	
			foreach($nodes as $node) :
			?>
			<li id='slideshow-<?php echo $node->nid; ?>' <?php if($i++ >= 1): ?>style="display: none; "<?php endif; ?>>
				<div class="images"><?php 
								list($items) = field_get_items('node', $node, 'field_image');
								
								$style = array('path'=>$items['uri'], 'style_name'=>'slideshow');
								echo theme('image_style', $style);
							?>
				</div>
				<div class="desc text-left hidden-xs" <?php if(!variable_get('zdigital_slideshow_hide_text', 1)): echo 'style="display:none"'; endif;?>>
					<div style="width: 75%"><h3><?php echo $node->title; ?></h3>
								<?php 
								$view = field_view_field('node', $node, 'body');
								echo render($view);?>	
					</div>			
				</div>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>
	<div class="sl_controller"></div>
</div>