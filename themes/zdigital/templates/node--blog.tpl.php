<style type="text/css">
<!--
.node .submitted table tbody {
	border-top: 0;
}
.node .submitted table td {
  vertical-align: top;
  padding-left: 8px;
}
-->
</style>
<?php 
// user picture
list($field) = field_get_items('node', $node, 'field_image');
$style = array('path'=>$field['uri'], 'style_name'=>'thumbnail');

if($teaser) : ?>
<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> col-md-6 col-xs-12"<?php print $attributes; ?>>

  <div class="user-picture hidden-sm hidden-xs col-md-4  col-sm-12 col-xs-12">
  	<a href="#" class="popover-toggle" data-trigger="hover"><?php 
		echo theme('image_style', $style);
  	?></a>
  	
  	<div class="popover-content popover">
  		<div class="media">
  			<div class="pull-left"><?php echo theme('image_style', $style);;?></div>
  			<h4 class="media-heading"><?php 
			  	$view = field_view_field('node', $node, 'field_author_name');
			  	echo render($view); ?></h4>
  			<?php 
  				$view = field_view_field('node', $node, 'field_author_bios');
		  		echo render($view); ?>
  		</div>
  	</div>
  </div>

  <div class="visible-xs visible-sm">
  	<div class="pull-left" style="margin-right: 5px;">
  		<a href="#" class="popover-toggle" data-trigger="hover"><?php 
			echo theme('image_style', $style);
	  	?></a>
	  	
	  	<div class="popover-content popover">
	  		<div class="media">
	  			<div class="pull-left"><?php echo theme('image_style', $style);;?></div>
	  			<h4 class="media-heading"><?php 
	  				$view = field_view_field('node', $node, 'field_author_name');
				  	echo render($view); ?></h4>
	  			<?php 
					$view = field_view_field('node', $node, 'field_author_bios');
					echo render($view); ?>
	  		</div>
	  	</div>
  	</div>
  	
  	<div class="title">
	  <?php print render($title_prefix); ?>
	  <?php if (!$page): ?>
	    <h3<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h3>
	  <?php endif; ?>
	  <?php print render($title_suffix); ?>
  	</div>
  </div>
  
  <div class="node-content col-md-8 col-sm-12 col-xs-12">
  	<div class="hidden-sm hidden-xs">
	  <?php print render($title_prefix); ?>
	  <?php if (!$page): ?>
	    <h3<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h3>
	  <?php endif; ?>
	  <?php print render($title_suffix); ?>
	</div>
	
	  <div class="content"<?php print $content_attributes; ?>>
	    <?php
	      // We hide the comments and links now so that we can render them later.
	      hide($content['comments']);
	      hide($content['links']);
	      print render($content);
	    ?>
	  </div>
	  
	  <?php if ($display_submitted): ?>
	    <div class="submitted">
	    	<ul>
	    		<li class="date"><span class="icon"></span><?php 
			  		list($field) = field_get_items('node', $node, 'field_post_date');
			  		if(!empty($field['value'])){
						$datetime = strtotime($field['value']);
			  			echo format_date($datetime, 'custom', 'F d, Y');
			  		}
	    			//echo format_date($node->changed, 'custom', 'F d, Y'); ?></li>
	    		<li class="author"><span class="icon"></span><?php //echo t('Author: ');
	    		
	    		list($author) = field_get_items('node', $node, 'field_author_name');
	    		echo l($author['safe_value'], 'blog', array('query'=>array('author'=>$author['safe_value']), 'attributes'=>array('data-placement'=>'top', 'class'=>array('popover-toggle')))); ?>
	    		  	<div class="popover-content popover">
				  		<div class="media">
				  			<div class="pull-left"><?php echo theme('image_style', $style);;?></div>
				  			<h4 class="media-heading"><?php 
				  				$view = field_view_field('node', $node, 'field_author_name');
							  	echo render($view); ?></h4>
				  			<?php 
							  	$view = field_view_field('node', $node, 'field_author_bios');
							  	echo render($view); ?>
				  		</div>
				  	</div>
	    		</li>
	    	</ul>
	    </div>
	  <?php endif; ?>
  </div>
</div>
<?php else: ?>
<div class="row">
	<div class="col-xs-12" style="margin:8px auto"><a href="<?php echo url('blog');?>"><?php echo t('<< Return to Article List');?></a></div>
	<div class="col-md-8 col-xs-12">
		<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
			<div id="blog-content" class="">
				<?php print render($title_prefix); ?>
				<h2<?php print $title_attributes; ?> class="media-heading"><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
				<?php print render($title_suffix); ?>
				  
				<?php if ($display_submitted): ?>
					<div class="submitted">
						<div class="pull-right col-md-5" >
							<table>
								<tr>
								<td>
									
							<span style="vertical-align: bottom; width: 124px; height: 20px;">
								<div
									  class="fb-like"
									  data-send="true"
									  data-width="450"
									  data-show-faces="true"
									  data-layout="button_count" >
								</div>
							</span>
								</td>
								
								<td>
								<span>
								    <a href="https://twitter.com/share" class="twitter-share-button" data-lang="en">Tweet</a>
	    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
								</span>
								</td>
							</tr>
							</table>
						</div>
					
						<ul>
							<li class="date"><span class="icon"></span><?php 
			  		list($field) = field_get_items('node', $node, 'field_post_date');
			  		if(!empty($field['value'])){
						$datetime = strtotime($field['value']);
			  			echo format_date($datetime, 'custom', 'F d, Y');
			  		}
			  		//echo format_date($node->changed, 'custom', 'F d, Y'); ?></li>
							<li class="author"><span class="icon"></span><?php //echo t('Author: ');
					    		
					    		list($author) = field_get_items('node', $node, 'field_author_name');
					    		echo l($author['safe_value'], 'blog', array('query'=>array('author'=>$author['safe_value']), 'attributes'=>array('data-placement'=>'top', 'class'=>array('popover-toggle')))); ?>
					    		  	<div class="popover-content popover">
								  		<div class="media">
								  			<div class="pull-left"><?php echo theme('image_style', $style);;?></div>
								  				<h4 class="media-heading"><?php 
											  		$view = field_view_field('node', $node, 'field_author_name');
											  		echo render($view); ?></h4>
								  				<?php 
											  		$view = field_view_field('node', $node, 'field_author_bios');
											  		echo render($view); ?>
								  		</div>
								  	</div>
				  			</li>
						</ul>
					</div>
				<?php endif; ?>
				
				<div class="spr clearfix"></div>
				<div class="content media"<?php print $content_attributes; ?>>
					  <div class="user-picture">
					  	<a href="#" class="popover-toggle" data-trigger="hover"><?php 
							list($field) = field_get_items('node', $node, 'field_image');
							$style = array('path'=>$field['uri'], 'style_name'=>'thumbnail');
							$style2 = $style;
							$style2['style_name'] = 'medium';
							echo theme('image_style', $style2);
					  	?></a>
					  	
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
					  	</div>
					  </div>
					<div class="article-body">
					    <?php
					      // We hide the comments and links now so that we can render them later.
					      hide($content['comments']);
					      hide($content['links']);
					      print render($content);
					    ?>
					</div>

				</div>
			</div>
		</div>
		
		<div class="col-md-12">
			<?php 
				  $nids = db_select('node', 'n')->fields('n', array('nid', 'sticky', 'created'))
				    ->condition('type', 'blog')
				    ->condition('status', 1)
				    ->condition('n.created', $node->created, '>')
				    ->orderBy('sticky', 'DESC')
				    ->orderBy('created', 'DESC')
				    ->range(0, 1)
				    ->addTag('node_access')
				    ->execute()
				    ->fetchCol();
			if(!empty($nids)):
				  $nid = array_shift($nids);
			?>
				<div class="pull-left"><a href="<?php echo url("node/$nid")?>">< <?php echo t('Previous'); ?></a></div>
			<?php 
			endif; 

			$nids = db_select('node', 'n')->fields('n', array('nid', 'sticky', 'created'))
			->condition('type', 'blog')
			->condition('status', 1)
			->condition('n.created', $node->created, '<')
			->orderBy('sticky', 'DESC')
			->orderBy('created', 'DESC')
			->range(0, 1)
			->addTag('node_access')
			->execute()
			->fetchCol();
			if(!empty($nids)):
				  $nid = array_shift($nids);
			?>
			<div class="pull-right"><a href="<?php echo url("node/$nid"); ?>"> <?php echo t('Next'); ?> ></a> </div>
			<?php endif; ?>
		</div>
		
		<div class="spr clearfix"></div>
		<div class="col-md-12"><div style="margin:0 0 10px 0;"><span><?php echo t('COMENTAR ARTICULOS'); ?></span></div></div>
		<div id="fb-root"></div>
		<fb:comments href="<?php echo url('node/'.$node->nid, array('absolute'=>true)); ?>" numposts="5" colorscheme="light" data-width="100%"></fb:comments>
		
		<script>(function(d, s, id) {
					  var js, fjs = d.getElementsByTagName(s)[0];
					  if (d.getElementById(id)) return;
					  js = d.createElement(s); js.id = id;
					  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
					  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
	</div>
	
	<div class="col-md-4 col-xs-12 author-articles row">
		<div class="col-xs-12">
				<?php 
				$block = _block_get_renderable_array( _block_render_blocks( array(block_load('zdigital', 'author_recent_blog'))));
				echo render($block);
				?>
		</div>
	</div>
	
</div>
<?php endif; ?>