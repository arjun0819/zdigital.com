<h2><?php echo t('More Articles By <b>@author</b>', array('@author'=>$author->name)); ?></h2>
<div class="media-list">
<?php 
foreach($artciles as $node) :
	$node = node_load($node->nid);
	list($field) = field_get_items('node', $node, 'field_image');
	$style = array('path'=>$field['uri'], 'style_name'=>'thumbnail');
?>
	<div class="media">
		<h4 class="media-heading"><?php echo l($node->title, 'node/'.$node->nid); ?></h4>
		<div class="media-body hidden-xs">
		<?php 
			list($body_field) = field_get_items('node', $node, 'body');		
			echo drupal_substr($body_field['value'], 0, 50);
							//echo $body_field['value']; ?>
						</div>
						<div class="submitted">
							<ul>
								<li class="date"><span class="icon"></span><?php echo format_date($node->changed, 'custom', 'F d, Y')?></li>
								<li class="author"><span class="icon"></span><?php echo t('Author: ');
					    		
					    		list($author) = field_get_items('node', $node, 'field_author_name');
					    		echo l($author['safe_value'], 'blog', array('query'=>array('author'=>$author['safe_value']), 'attributes'=>array('data-placement'=>'top', 'class'=>array('popover-toggle')))); ?>
					    		  	<div class="popover-content popover">
								  		<div class="media">
								  			<div class="pull-left"><?php echo theme('image_style', $style);;?></div>
								  			<div class="media-body">
								  				<h4 class="media-heading"><?php 
											  		$view = field_view_field('node', $node, 'field_author_name');
											  		echo render($view); ?></h4>
								  				<?php 
											  		$view = field_view_field('node', $node, 'field_author_bios');
											  		echo render($view); ?>
								  			</div>
								  		</div>
								  	</div></li>
							</ul>
						</div>
					</div>
<?php 
endforeach; 
?>	
</div>