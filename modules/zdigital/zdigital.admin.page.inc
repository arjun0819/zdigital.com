<?php
/****************************************************************************************************
 * @file: zdigital.admin.page.inc                                                                                                                     
 * @author: Arjun<arjun0819@gmail.com>                                                                             
 * @date: Sep 16, 2014 5:14:35 PM                                                                                                    
 * @encode: UTF-8                                                                                                            
 ****************************************************************************************************/
function zdigital_admin_translate_country_name_callback() {
	
	return drupal_get_form('zdigital_admin_translate_country_names_form');
}

function zdigital_admin_delete_country_callback($id) {
	
	$row = db_select('countries', 'c')->fields('c')->condition('c.country_id', $id)->execute()->fetchObject();
	if($row && $row->country_id) {
		db_delete('countries')->condition('country_id', $id)->execute();
		drupal_set_message(t('Delete @country success', array('@country'=>$row->country_name)));
	}else{
		drupal_set_message(t('Country ID @id is not exists', array('@id'=>$id)), 'warning');
	}
	drupal_goto('admin/config/regional/zdigital/list');
}

function zdigital_admin_translate_country_names_form() {
	$form = array();
	$default_value = file_get_contents(drupal_get_path('module', 'zdigital') . '/country_translate.txt');
	$form['translate'] = array(
		'#title' => t('Translate Datas'),
		'#type' => 'textarea',
		'#required' => true,
		'#description' => t('Example: <span style="color:red">Afghanistan</span>(in English)<span style="color:red">:Afganistán</span>(in Spanish)', array('html'=>true)),
		'#default_value' => $default_value
	);
	$form['new'] = array(
		'#type' => 'checkbox',
		'#title' => t("If country doesn't exists, insert to database!")
	);
	$form['submit'] = array(
		'#type' => 'submit',
		'#value' => t('Translate')
	);
	return $form;
}

function zdigital_admin_translate_country_names_form_submit($form, &$form_state) {
	
	$values = $form_state['values'];
	
	$countries = explode("\n", $values['translate']);
	$values['countries'] = $countries;
	
	$batch_definition = array(
		'title' => t('Translate countries ...'),
		'operations' => array(
			array('zdigital_batch_translate_country', array($values)),
		),
		'finished' => 'zdigital_batch_translate_country_finished',
		'file' => drupal_get_path('module', 'zdigital') . '/zdigital.batch.inc'
	);
	
	batch_set($batch_definition);
	
	batch_process('admin/config/regional/zdigital');
}

function zdigital_admin_translate_countries_list_callback() {
	
	$result = db_select('countries', 'c')->fields('c')->orderBy('country_name')->execute();
	
	$variables = array(
		'header' => array(
			t('Country ID'),
			t('Name (in English)'),
			t('Name (in Spanish)'),
			t('Operations')
		)
	);
	
	$rows = array();
	foreach($result as $row) {
		$rows[] = array(
			$row->country_id,
			$row->country_name,
			$row->country_name_es,
			l(t('Translate'), 'admin/config/regional/zdigital/translate/'.$row->country_id). ' | '.l(t('Delete'), 'admin/config/regional/zdigital/delete/'.$row->country_id)
		);
	}
	$variables['rows'] = $rows;
	
	return theme('table', $variables);
}


function zdigital_admin_translate_country_form($form, $form_state, $id) {
	$row = db_select('countries', 'c')->fields('c')->condition('country_id', $id)->execute()->fetchObject();
	$form = array();
	$form['country_id'] = array(
		'#type' => 'hidden',
		'#value' => $id,
	);
	$form['country_name'] = array(
		'#type' => 'textfield',
		'#title' => t('Country Name (in English)'),
		'#default_value' => $row->country_name,
		'#required' => true
	);

	$form['country_name_es'] = array(
		'#type' => 'textfield',
		'#title' => t('Country Name (in Spanish)'),
		'#default_value' => $row->country_name_es,
		'#required' => true
	);
	
	$form['submit'] = array(
		'#type' => 'submit',
		'#value' => t('Save')
	);
	$form['#redirect'] = 'admin/config/regional/zdigital/list';
	
	return $form;
}

function zdigital_admin_translate_country_form_submit($form, &$form_state) {
	$values = $form_state['values'];

	unset($values['form_build_id'],$values['form_token'],$values['form_id'],$values['submit'],$values['op']);
	if(empty($values['country_id'])) {
		db_insert('countries')->fields(array_keys($values), $values)->execute();
	}else{
		$country_id = $values['country_id'];
		$return = db_update('countries')->fields($values)->condition('country_id', $country_id)->execute();
	}
	
	if(!empty($form['#redirect'])) {
		drupal_set_message(t('Save country @country information success', array('@country'=>$values['country_name'])));
		drupal_goto($form['#redirect']);
	}
}