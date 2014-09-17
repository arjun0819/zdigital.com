<div id="user-console" class="clearfix">
	<div id="video-play" class="row">
	
		<div class="col-md-12 col-xs-12">
			<?php 
			$block = _block_get_renderable_array( _block_render_blocks( array(block_load('zdigital', 'podcast_member_dashboard'))));
			echo render($block);
			?>
		  <!-- <img src="<?php echo base_path().$directory.'/images/user_03.png'?>" /> -->
		
		</div>
	
	</div>
	
	<div id="operations" class="row">
		<div class="first col-xs-12 odd col-md-4 col-sm-4">
			<div class="option"><?php 
			$block = _block_get_renderable_array( _block_render_blocks( array(block_load('block', '3'))));
			
			echo render($block);
		?></div></div>
		
		<div class="even col-xs-12 col-md-4 col-sm-4">
			<div class="option"><?php 
			$block = _block_get_renderable_array( _block_render_blocks( array(block_load('block', '4'))));
			
			echo render($block);
		?></div></div>
		
		<div class="last odd col-xs-12 col-md-4 col-sm-4">
			<div class="option"><?php 
			$block = _block_get_renderable_array( _block_render_blocks( array(block_load('block', '5'))));
			
			echo render($block);
		?></div></div>
	</div>
</div>