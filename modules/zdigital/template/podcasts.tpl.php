<div id="podcasts" class="clearfix">

	<?php if(user_is_logged_in()): ?>
	<div class="operation row">
		<div class="col-md-4 col-md-offset-6 col-xs-12">
			<div class="dropdown">
			  <a data-toggle="dropdown" href="#" class="form-control"><?php echo $featured->title; ?><b class="caret"></b></a>
			  <?php if(!empty($nodes)): ?>
			  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
			  <?php foreach($nodes as $row) :?>
			  <li><?php echo l($row->title, 'podcasts/'.$row->nid, array('html'=>true, 'attributes'=>array('style'=>'padding-left: 10px;'))); ?></li>
			  <?php endforeach; ?>
			  </ul>
			  <?php endif; ?>
			</div>
		</div>
			
		<div class="col-md-2 col-xs-12">
			<a href="#" class="arcivos btn btn-link">
				<?php echo t('ARCHIVOS'); ?>
				<span class="icon glyphicon glyphicon-plus"></span>
			</a>
		</div>
			
		<div class="clearfix"></div>
	</div>
	
	<div class="row clearfix">
		<div class="col-lg-12 show-ipad show-iphone" style="display: none">
		<?php 
		$all_fields = field_get_items('node', $featured, 'field_embed_id');
		$download_key = rand(0, count($all_fields)-1);
		?>
		  		<h1><?php echo $featured->title; ?></h1>
			  	<div class="submitted">
			  		<b class="glyphicon glyphicon-calendar"></b>
			  		<?php 
			  		list($field) = field_get_items('node', $featured, 'field_post_date');
			  		if(!empty($field['value'])){
						$datetime = strtotime($field['value']);
			  			echo format_date($datetime, 'custom', 'F d, Y');
			  		}?>
			  		<b class="glyphicon glyphicon-time"></b>
			  		<?php 
			  			list($field) = field_get_items('node', $featured, 'field_video_time');
			  			echo $field['value'];
			  	?></div>
			  	<div style="margin-top:15px;min-height:40%;width:70%"><?php 
			  		list($field) = field_get_items('node', $featured, 'body');
// 			  		echo drupal_substr($field['safe_value'], 0, 500);
					echo text_summary($field['safe_value'], 1, 500);
// 			  		$body = field_view_field('node', $node, 'body');
// 			  		echo render($body);
			  	?></div>
			  	<div><a class="btn download" target="_blank" href="<?php 
			  		echo url('zdigital/file', array('query'=>array('file'=>$all_fields[$download_key]['value']))); ?>"><b class="glyphicon glyphicon-download-alt"></b><?php echo t('DOWNLOAD'); ?></a>
			  	</div>
		</div>

		<div class="col-lg-12" style="min-height: 300px"><?php
			list($field) = field_get_items('node', $featured, 'field_embed_id');
			
			$embed_id = !empty($field['value']) ? $field['value'] : 8131;
			//echo theme_zdigital_podcast_iframe_player(array('embid'=>$embed_id, 'width'=>'100%', 'height'=>'325'));
			echo theme_zdigital_podcast_video_iframe_player(array('nid'=>$featured->nid, 'width'=>'100%', 'height'=>'392px'));
		?>
		</div>		
	</div>
	<?php endif; ?>

	<div class="row clearfix">
		<div class="media"></div>
		
		<?php foreach($nodes as $entity) : ?>
		<div id="node-<?php echo $entity->nid; ?>" class="col-xs-12 col-md-6 media posdcast">
			<div class="pull-left"><?php 
				list($field) = field_get_items('node', $entity, 'field_image');

				$style = array('path'=>$field['uri'], 'style_name'=>'posdcast_cover_image', 'attributes' => array('class'=> array('media-object img-thumbnail')));
				echo theme('image_style', $style);
			?><!-- <img class="media-object img-thumbnail" src="<?php echo base_path().drupal_get_path('theme', 'zdigital').'/images/podcats_14.jpg'?>" /> --></div>
			<div class="media-body">
				<h3 class="media-heading"><a href="<?php echo user_is_anonymous() ? url('user/login', array('query'=>array('destination'=>'podcasts/'.$entity->nid))) : url('podcasts/'.$entity->nid); ?>"><?php echo $entity->title; ?></a></h3><?php 
					list($field) = field_get_items('node', $entity, 'body');
					echo text_summary($field['safe_value'], 1, 250);
				?><div class="submitted">
					<span class="date"><span class="icon glyphicon glyphicon-calendar"></span><?php 
			  		list($field) = field_get_items('node', $entity, 'field_post_date');
			  		if(!empty($field['value'])){
						$datetime = strtotime($field['value']);
			  			echo format_date($datetime, 'custom', 'F d, Y');
			  		}
					?></span>
				</div>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
</div>