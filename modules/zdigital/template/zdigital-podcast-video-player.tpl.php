<?php
/**
 * @file: zdigital-podcast-video-player.tpl.php
 * @author: arjun<arjun0819@gmail.com>                                      
 * @date: Apr 10, 2014 4:46:48 PM
 * @encode: UTF-8
 * @company: LonghuaUSA Inc.
 */

function getVideoType($path) {
	$path = pathinfo($path);
	
	switch($path['extension']) {
		case 'ogv':
			return 'video/ogg';
			
		case 'mp3':
			return 'audio/mpeg';
		default:
			return 'video/'.$path['extension'];
	}
}
?><!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title><?php echo $node->title; ?></title>
  <style type="text/css" media="all">@import url("/sites/all/themes/zdigital/css/style.css");</style>
  <link href="/sites/all/themes/zdigital/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <!-- Chang URLs to wherever Video.js files will be hosted -->
  <link href="<?php echo base_path().drupal_get_path('module', 'zdigital'); ?>/video-js.css" rel="stylesheet" type="text/css">
  <!-- video.js must be in the <head> for older IEs to work. -->
  <script type="text/javascript" src="<?php echo base_path().drupal_get_path('module', 'zdigital'); ?>/video.js"></script>
  <script type="text/javascript" src="<?php echo base_path();?>misc/jquery.js"></script>

  <script type="text/javascript">
  jQuery(function(){
    var iOS = false, p = navigator.platform;

	if( p === 'iPad' || p === 'iPhone' || p === 'iPod' ){
	    iOS = true;
	}
	if(iOS) {
      jQuery(".hidden-ipad, .hidden-iphone").hide();
      jQuery(".show-ipad, .show-iphone").show();
	}else{
	  jQuery(".hidden-ipad, .hidden-iphone").show();
	  jQuery(".show-ipad, .show-iphone").hide();
	}
  });
  </script>
  <!-- Unless using the CDN hosted version, update the URL to the Flash SWF -->
  <script type="text/javascript">
    videojs.options.flash.swf = "<?php echo base_path().drupal_get_path('module', 'zdigital'); ?>/video-js.swf";
  </script>

  <style type="text/css">
  .field-label {display:none;}
  .submitted {color:#999}
  .download{
  	background-color:#999;
  	color: #fff;
  	font-weight:bold;
	  display: inline-block;
		margin-bottom: 0px;
		text-align: center;
		vertical-align: middle;
		cursor: pointer;
		background-image: none;
		border: 1px solid transparent;
		white-space: nowrap;
		padding: 4px 15px;
		font-size: 14px;
		line-height: 1.42857;
		border-radius: 0;
		-moz-user-select: none;
  }
  </style>
  
  <!--[if lte IE 7]>
  	<link href="/sites/all/themes/zdigital/css/ie.css" rel="stylesheet">
  <![endif]-->
  
  <!--[if lte IE 8]>
  	<link href="/sites/all/themes/zdigital/css/ie.css" rel="stylesheet">
  <![endif]-->
</head>
<body style="background-color: #212121">
	<div id="vide-node">
	  <video id="example_video_1" class="video-js vjs-default-skin" controls preload="none" width="<?php echo $width; ?>" height="<?php echo $height; ?>"
	      poster="<?php 
	      list($field) = field_get_items('node', $node, 'field_image');
	      
	      $poster = file_exists($field['uri']) ? file_create_url($field['uri']) : 'http://video-js.zencoder.com/oceans-clip.png';
	      echo $poster;
	      ?>"
	      data-setup="{}">
	    <?php 
	    	foreach($all_fields = field_get_items('node', $node, 'field_embed_id') as $key => $field) : ?>
	    	<source src="<?php echo $field['value']; ?>" type='<?php echo getVideoType($field['value']);?>' />
	    <?php endforeach; 
	    	$download_key = rand(0, count($all_fields)-1);
	    ?>
	    <track kind="captions" src="<?php echo base_path().drupal_get_path('module', 'zdigital'); ?>/demo.captions.vtt" srclang="en" label="English"></track><!-- Tracks need an ending tag thanks to IE9 -->
	    <track kind="subtitles" src="<?php echo base_path().drupal_get_path('module', 'zdigital'); ?>/demo.captions.vtt" srclang="en" label="English"></track><!-- Tracks need an ending tag thanks to IE9 -->
	  </video>
	  <div id="video-desc" class="container-fluid hidden-xs hidden-ipad hidden-iphone" style="display:none;padding:20px;z-index:88; position:absolute; background-color:#212121;top:0;width:100%;height:100%;color:#fff">
	  	<div class="row" style="height: 100%">
		  	<div class="col-md-4 col-sm-4" style="overflow: hidden;height: 100%;padding:0;"><img alt="" src="<?php 
		      list($field) = field_get_items('node', $node, 'field_image');
		      
		      $poster = file_exists($field['uri']) ? file_create_url($field['uri']) : 'http://video-js.zencoder.com/oceans-clip.png';
		      echo $poster;
		      ?>" class="img-responsive" />
		    </div>
		  		
		  	<div class="col-md-8 col-sm-8" style="height: 100%;overflow:hidden;">
		  		<h1><?php echo $node->title; ?></h1>
			  	<div class="submitted">
			  		<b class="glyphicon glyphicon-calendar"></b>
			  		<?php 
			  		list($field) = field_get_items('node', $node, 'field_post_date');
			  		if(!empty($field['value'])){
						$datetime = strtotime($field['value']);
			  			echo format_date($datetime, 'custom', 'F d, Y');
			  		}
			  		?>
			  		<b class="glyphicon glyphicon-time"></b>
			  		<?php 
			  			list($field) = field_get_items('node', $node, 'field_video_time');
			  			echo $field['value'];
			  	?></div>
			  	<div style="margin-top:15px;min-height:40%;width:70%"><?php 
			  		list($field) = field_get_items('node', $node, 'body');
// 			  		echo drupal_substr($field['safe_value'], 0, 500);
					echo text_summary($field['safe_value'], 1, 500);
// 			  		$body = field_view_field('node', $node, 'body');
// 			  		echo render($body);
			  	?></div>
			  	<div><a class="btn download" target="_blank" href="<?php 
			  		echo url('zdigital/file', array('query'=>array('file'=>$all_fields[$download_key]['value']))); ?>"><b class="glyphicon glyphicon-download-alt"></b><?php echo t('DOWNLOAD');?></a>
			  	</div>
		  	</div>
	  	</div>
	  </div>
  </div>
	<script type="text/javascript">
	var myvideo = videojs('example_video_1').ready(function(){
		$(".vjs-default-skin .vjs-big-play-button").css({top: '3.5em', left: '3.5em',zIndex:999,backgroundColor:'#505050',content:'"\e001"; LEFT: 0px'})
		$(".vjs-default-skin .vjs-big-play-button span").css({zIndex:1000});
	});

	myvideo.on('play',function(){
		jQuery('#video-desc').hide(300);
		$(".vjs-default-skin .vjs-big-play-button").hide();
	})
	myvideo.on('pause', function(){
		jQuery('#video-desc').show(300).css({marginBottom:20});
		$(".vjs-default-skin .vjs-big-play-button").show(300);
	});
	</script>
</body>
</html>