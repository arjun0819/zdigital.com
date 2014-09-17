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
      	
      	<?php if ($breadcrumb): ?>
    	  <div id="breadcrumb">
    	    <?php print render($title_prefix); ?>
    	    <?php if ($title): ?>
      		<h1 class="title" id="page-title">
          		<?php print truncate_utf8($title, 40, true, true); ?>
          	</h1>
      		<?php endif; ?>
      		<?php print render($title_suffix); ?>
      		<?php print $breadcrumb; ?>
      		<div class="clearfix"></div>
    	  </div>
    	<?php endif; ?>
    	
		<?php if ($messages): ?>
			<div id="messages"><div class="section clearfix"><?php print $messages; ?></div></div> <!-- /.section, /#messages -->
		<?php endif; ?>
  
		<?php if ($tabs && 0): ?>
	      <div class="tabs">
	    		<?php print render($tabs); ?>
	    	</div>
	    <?php endif; ?>
	    
		<?php print render($page['content']); ?>
		
		<?php if($page['right_sidebar']):?>
		<div class="right-sidebar">
			<?php echo render($page['right_sidebar']); ?>
		</div>
		<?php endif; ?>
	</div>
</div>

<?php include_once '_footer.tpl.php';?>