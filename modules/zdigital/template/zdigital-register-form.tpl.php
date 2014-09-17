
<div class="register row">

	<div class="col-xs-12 col-md-4 left-sidebar"><?php 
			$block = _block_get_renderable_array( _block_render_blocks( array(block_load('block', '7'))));
			
			echo render($block);
		?>
	</div>
	
	<div class="col-xs-12 col-md-8 row">
		
	  <div class="introduction"><?php 
			$block = _block_get_renderable_array( _block_render_blocks( array(block_load('block', '8'))));
			
			echo render($block);
		?></div>
		
		<div class="col-xs-12 col-md-6">
			<?php echo drupal_render($form['account']['name']); ?>
		</div>
		<div class="col-xs-12 col-md-6">
			<?php echo drupal_render($form['account']['mail']); ?>
		</div>
		
		<div class="col-xs-12 col-md-6">
			<?php echo drupal_render($form['account']['pass']['pass1']); ?>
		</div>
		
		<div class="col-xs-12 col-md-6">
			<?php echo drupal_render($form['account']['pass']['pass2']); ?>
		</div>
		
		<div class="col-xs-12 col-md-6">
			<?php echo drupal_render_children($form['field_first_name']); ?>
		</div>
		<div class="col-xs-12 col-md-6">
			<?php echo drupal_render_children($form['field_last_name']); ?>
		</div>
		<div class="col-xs-12 col-md-6">
			<?php echo drupal_render_children($form['field_country']); ?>
		</div>
		<!-- <div class="col-xs-12 col-md-6">
			<?php //echo drupal_render_children($form['field_state']); ?>
		</div> -->
		<div class="col-xs-12 col-md-6">
			<?php echo drupal_render_children($form['field_city']); ?>
		</div>
		<!-- <div class="col-xs-12 col-md-6">
			<?php //echo drupal_render_children($form['field_zipcode']); ?>
		</div>
		<div class="col-xs-12 col-md-6">
			<?php //echo drupal_render_children($form['field_address_1']); ?>
		</div>
		<div class="col-xs-12 col-md-6">
			<?php //echo drupal_render_children($form['field_address_2']); ?>
		</div> -->
		<div class="col-xs-12 col-md-6">
			<?php echo drupal_render_children($form['field_phone']); ?>
		</div>
		
		<div class="col-xs-12">
		<?php echo drupal_render($form['actions']); ?>
		</div>
		<div style="display: none">
		<?php echo drupal_render_children($form); ?>
		</div>
	</div>

</div>

