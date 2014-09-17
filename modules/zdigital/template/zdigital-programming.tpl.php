<div class="programing media-list">

	<?php foreach($nodes as $entity) : ?>
		<div class="row">
			<div class="col-xs-12 col-md-9 media row">
				<div class="col-xs-12 col-md-4"><?php 
					list($field) = field_get_items('node', $entity, 'field_image');

					
					$style = array('path'=>$field['uri'], 'style_name'=>'programaction_cover_image');
					echo theme('image_style', $style);
				?>
					<!-- <img alt="" src="<?php echo base_path().$directory.'/images/programing_03.jpg'?>" /> -->
				</div>
			
			<div class="media-body col-md-8">
				<h3 class="media-heading"><?php echo $entity->title; ?></h3>
				<div class="submited">
					<span class="glyphicon glyphicon-time"></span>
					<!-- <span><?php 
						list($field) = field_get_items('node', $entity, 'field_time_from');
						echo $field['value'];
					?></span>
					<span> - </span>
					<span><?php 
						list($field) = field_get_items('node', $entity, 'field_time_to');
						echo $field['value'];
					?></span> -->
					<?php 
						$view = field_view_field('node', $entity, 'field_times_area');
						echo render($view);
					?>
				</div>
				<div class="media-body"><?php 
					$view = field_view_field('node', $entity, 'body');
					echo render($view);
				?>
				</div>
			</div>
			
			</div>
			
			<div class="col-xs-12 col-md-3">
				<dl>
					<?php 
						$names = field_get_items('node', $entity, 'field_name');
						$description = field_get_items('node', $entity, 'field_brief_introduction');
						if(!empty($names)):
						foreach($names as $key => $value):
					?>
					<dt style="position: relative;">
						<a href="javascript:void(0)" class="popover-toggle"><span class="glyphicon glyphicon-info-sign icon"></span><?php echo $value['safe_value']; ?></a>

				    <div class="popover-content popover"><?php 
				    	//$view = field_view_field('node', $entity, $field_name);
				    	echo !empty($description[$key]) ? trim($description[$key]['value']) : ''; ?></div>
					</dt>
					<?php endforeach; 
						endif;
					?>
				</dl>
			</div>
		</div>
	<?php endforeach; ?>

</div>