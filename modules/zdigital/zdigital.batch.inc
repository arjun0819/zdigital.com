<?php
/****************************************************************************************************
 * @file: zdigital.batch.inc                                                                                                                     
 * @author: Arjun<arjun0819@gmail.com>                                                                             
 * @date: Sep 17, 2014 2:18:24 PM                                                                                                    
 * @encode: UTF-8                                                                                                          
 ****************************************************************************************************/

/**
 * 
 */
function zdigital_batch_translate_country($data, &$context) {
	if(empty($context['sandbox']['@total'])) {
		$context['sandbox']['@total'] = count($data['countries']);
		$context['sandbox']['@update'] = 0;
		$context['sandbox']['@new'] = 0;
		$context['sandbox']['@error'] = 0;
		$context['sandbox']['@no_exists'] = 0;
		$context['sandbox']['error_message'] = array();
		$context['sandbox']['@process'] = 0;
		
		// ignore
		$context['sandbox']['@ignore'] = array();
	}
	
	$country = $data['countries'][$context['sandbox']['@process']++];
	$translate_fields = explode(':', $country);
	
	if(count($translate_fields) == 2) {
		$row = db_select('countries', 'c')->fields('c', array('country_name', 'country_id', 'country_name_es'))
			->condition('c.country_name', strtolower($translate_fields[0]))
			->execute()
			->fetchObject();
		$row = (array)$row;
		$row['country_name'] = $translate_fields[0];
		$row['country_name_es'] = $translate_fields[1];
		
		if(!empty($row['country_id'])) { // @TODO: 
			db_update('countries')->fields($row)->condition('country_id', $row)->execute();
			$context['sandbox']['@update']++;
		}else if(!empty($data['new'])){
			db_insert('countries')->fields(array_keys($row), $row)->execute();
			$content['sandbox']['@new']++;
		}else{
			$context['sandbox']['@no_exists']++;
			$context['sandbox']['@ignore'][] = $country;
		}
	}else{
		$context['sandbox']['@error']++;
		$context['sandbox']['error_message'][] = $country;
	}
	
	$context['finished'] = $context['sandbox']['progress'] = $context['sandbox']['@process'] / $context['sandbox']['@total'];
	$context['message'] = t('Translate: @process of @total, update: @update; new: @new; fail: @error; ignore: @no_exists', $context['sandbox']);
	
	if($context['finished'] === 1) {
		drupal_set_message($context['message']);
		if(!empty($context['sandbox']['@ignore'])) {
			drupal_set_message(t('Ignore Country <br /> !ignore', array('html'=>true, '!ignore'=>implode("<br />", $context['sandbox']['@ignore']))), 'warning');
		}
		if(!empty($context['sandbox']['error_message'])) {
			drupal_set_message(t('Error datas: <br /> !datas', array('html'=>true, '!datas'=>implode("<br />", $context['sandbox']['error_message']))), 'error');
		}
	}
}

function zdigital_batch_translate_country_finished($success, $results, $operations) {


}