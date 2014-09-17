<?php
/**
 * @file: theme-settings.php
 * @author: arjun<arjun0819@gmail.com>                                      
 * @date: Mar 17, 2014 3:39:44 PM
 * @encode: UTF-8
 */

function zdigital_form_system_theme_settings_alter(&$form, &$form_state) {
	
	$form['social_setting'] = array(
			'#tree' => false,
			'#type' => 'fieldset',
			'#title' => t('Social Network Page Settings'),
			'#description' => ''
	);
	
	$form['social_setting']['twitter'] = array(
		'#type' => 'textfield',
		'#title' => 'Twitter Page',
		'#default_value' => 'http://www.twitter.com/',
		'#description' => t('Please enter a valid link to  be shown on the site, if empty will not show.')
	);
	$form['social_setting']['facebook'] = array(
		'#type' => 'textfield',
		'#title' => 'Facebook Page',
		'#default_value' => 'http://www.facebook.com/',
		'#description' => t('Please enter a valid link to  be shown on the site, if empty will not show.')
	);
	$form['social_setting']['linkin'] = array(
		'#type' => 'textfield',
		'#title' => "Linkin Page",
		'#default_value' => 'http://www.linkin.com/',
		'#description' => t('Please enter a valid link to  be shown on the site, if empty will not show.')
	);
	$form['social_setting']['youtube'] = array(
		'#type' => 'textfield',
		'#title' => 'Youtube Page',
		'#default_value' => 'http://www.youtube.com/',
		'#description' => t('Please enter a valid link to  be shown on the site, if empty will not show.')
	);
}