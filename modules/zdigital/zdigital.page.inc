<?php
/**
 * @file: zdigital.page.inc
 * @author: arjun<arjun0819@gmail.com>                                      
 * @date: Mar 17, 2014 9:09:26 AM
 * @encode: UTF-8
 */

function zdigital_blog_page_last() {
	global $user;
	$build = array();
	
	$query = db_select('node', 'n')->extend('PagerDefault');
	$query
	->fields('n', array('nid', 'sticky', 'created'));
	$query->leftJoin('field_data_field_author_name', 'author', 'author.entity_id=n.nid');
	
	
	$query->condition('type', 'blog')
	->condition('status', 1);
	if(!empty($_GET['author'])) {
		$query->condition('author.field_author_name_value', trim($_GET['author']));
	}
	$nids = $query->orderBy('sticky', 'DESC')
	->orderBy('created', 'DESC')
	->limit(variable_get('default_nodes_main', 10))
	->addTag('node_access')
	->execute()
	->fetchCol();
	
	if (!empty($nids)) {
		$nodes = node_load_multiple($nids);
		$build += node_view_multiple($nodes);
		$build['pager'] = array(
				'#theme' => 'pager',
				'#weight' => 5,
		);
	}
	else {
		drupal_set_message(t('No blog entries have been created.'));
	}
	drupal_add_feed('blog/feed', t('RSS - blogs'));
	
	return $build;
}

function zdigital_file_download_callback() {
	$file = $_GET['file'];
	
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename='.basename($file));
	header('Content-Transfer-Encoding: binary');
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Pragma: public');
	header('Content-Length: ' . filesize($file));
	ob_clean();
	flush();
	readfile($file);
}
function zdigital_admin_user_login_page_callback() {
	
	$form = drupal_get_form('user_login');
	
	$form['login_title'] = array(
			'#markup' => '<h2 class="form-signin-heading">Please sign in</h2>'
	);
	$form['name']['#description'] = '';
	$form['pass']['#description'] = '';
	
	$form['#attributes']['class'] = array('form-signin');
	$form['#attributes']['role'] = 'form';
	
	$form['name']['#attributes']['class'][] = 'form-control';
	$form['pass']['#attributes']['class'][] = 'form-control';
	
	$form['actions']['submit']['#attributes']['class'][] = 'btn btn-lg btn-primary btn-block';

	return render($form);
}

function zdigital_podcasts_page_callback() {

	$items = !empty($_GET['items']) ? $_GET['items'] : 4;
	
	// Featured Posdcast
	$featured_nid = arg(1) ? arg(1) : 13;
	$featured = null;
	$record = db_select('node', 'n')->fields('n')->condition('n.nid', $featured_nid)->execute()->fetch();
	$featured = node_load($record->nid);
	
	$query = db_select('node', 'n')->fields('n')
		->condition('n.type', 'posdcast')
		->condition('n.status', NODE_PUBLISHED);
	if(user_is_logged_in()) {
		$query->condition('n.nid', $featured_nid, '<>');
	}

	$query->orderBy('n.changed', 'DESC')->extend('PagerDefault')->limit($items);
	
	$results = $query->execute();
	$nodes = array();
	//$nodes[] = $featured;
	foreach($results as $row) {
		$nodes[] = node_load($row->nid);
	}
	
	return theme('podcasts', array('nodes'=>$nodes, 'featured'=>$featured));
}

function zdigital_programming_page_callback() {
	
	$items = !empty($_GET['items']) ? $_GET['items'] : 8;
	
	$results  = db_select('node', 'n')->fields('n')
		->condition('n.type', 'programacion')->condition('n.status', NODE_PUBLISHED)->orderBy('n.changed', 'DESC')
		->extend('PagerDefault')->limit($items)->execute();
	
	$nodes = array();
	foreach($results as $node) {
		$nodes[] = node_load($node->nid);
	}
	
	$output = theme('zdigital_programming', array('nodes'=>$nodes));
	$output .= theme('pager');
	
	return $output;
}

function zdigital_user_register_by_paypal_page_callback() {

	
	$paypal_form = drupal_get_form('zdigital_user_reigster_payment_by_paypal_form', array('uid'=>$_GET['uid']));
	return render($paypal_form);
}

function zdigital_user_reigster_payment_by_paypal_form($form, &$form_state, $data = array()) {
	drupal_add_js('Drupal.behaviors.autoPayment= {attach: function(context, settings){jQuery(".paypal-payment").submit(); jQuery("body").append("'.t('You are being redirected to PayPal...').'")}}', array('type' => 'inline', 'scope'=>'footer'));
	$from = array();
// 	$form['#action'] = 'https://www.paypal.com/cgi-bin/webscr';
	$form['#action'] = 'https://'.variable_get('paypal_server', 'www.sandbox.paypal.com').'/cgi-bin/webscr';
	$form['#method'] = 'post';
	$form['#attributes']['class']= 'paypal-payment';

	$form['cmd'] = array(
		'#type' => 'hidden',
// 		"#value" => "_xclick"
		"#value" => "_xclick-subscriptions"
	);
	$form['business'] = array(
		'#type' => "hidden",
		'#value' => variable_get('paypal_business', "raulantonio20-facilitator@gmail.com")
	);
	$form['item_name'] = array(
		'#type' => 'hidden',
		'#value' => variable_get("paypal_item_name", "Zdigital Account Payment"),
	);
	$form['charset'] = array(
		'#type' => 'hidden',
		'#value' => 'utf-8',
	);
	$form['quantity'] = array(
		'#type' => 'hidden',
		'#value' => 1,
	);
// 	$form['env'] = array(
// 		'#type' => "hidden",
// 		"#value" => "www.sandbox"
// 	);
 	$form['return'] = array(
		'#type' => 'hidden',
//  		'#value' => url(variable_get('user_register_success_path', 'user/register/success/'.$data['uid']), array('absolute'=>true, 'query' => array('uid'=>$data['uid']))),
 		'#value' => url('user/register/success/'.$data['uid'], array('absolute'=>true, 'query' => array('uid'=>$data['uid']))),
 	);

// 	$form['amount'] = array(
// 		'#type' => 'hidden',
// 		'#value' => variable_get('payment_amount', 6.8),
// 	);

 	$form['a3'] = array( // amount to be invoiced each recurrence
 		'#type' => 'hidden',
 		'#value' => variable_get('payment_amount', 6.8),
 	);
 	$form['t3'] = array( //  time period (D=days, W=weeks, M=months, Y=years)
 		'#type' => 'hidden',
 		'#value' => "M"
 	);
 	$form['p3'] = array(
 		'#type' => 'hidden',
 		'#value' => '1'
 	);
 	
	$form['currency_code'] = array(
		'#type' => 'hidden',
		'#value' => variable_get('payment_currency', 'USD'),
	);
	$form['custom'] = array(
		'#type' => 'hidden',
		'#value' => $data['uid'],
	);
	$form['item_number'] = array(
		'#type' => 'hidden',
		'#value' => time()
	);
	$form['notify_url'] = array(
		'#type' => 'hidden',
		'#value' => url('user/register/paypal/notify', array('absolute'=>true)),
	);
	$form['button'] = array(
		'#type' => "hidden",
		"#value" => "buynow"
	);
	$form['no_shipping'] = array(
		'#type' => "hidden",
		"#value" => 1
	);
	$form['shipping'] = array(
		'#type' => "hidden",
		"#value" => "0"
	);
	$form['tax'] = array(
		'#type' => "hidden",
		"#value" => "0"
	);

	return $form;
}

function zdigital_user_register_by_paypal_notify_page_callback() {
	
	watchdog('paypal_notify', json_encode($_POST));
	
	$array = $_POST;
	$hostname = variable_get('paypal_server', 'www.sandbox.paypal.com');
	$array['vertify_server'] = $hostname;
	$array['cmd'] = '_notify-validate';
	watchdog('paypal_notify_vertify', json_encode($array));
	// 
	
	$query = http_build_query($array);
	// post back to PayPal system to validate
	$header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
	$header .= "Host: {$hostname}\r\n";
	$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
	$header .= "Content-Length: " . strlen($query) . "\r\n\r\n";
	$fp = fsockopen ("ssl://{$hostname}", 443, $errno, $errstr, 30);
  
	watchdog('paypal_notify_vertify_header', $header);
	watchdog('paypal_notify_vertify_query', $query);
	if(!$fp) { // HTTP ERROR
		watchdog('paypal_notify_vertify', 'Vertify fail');
	}else{
		$payment_status = $_POST['payment_status'];
		$txn_id = $_POST['txn_id'];
		
		fputs ($fp, $header . $query);
		while (!feof($fp)) {
			$results = fgets($fp, 1024);
			watchdog('paypal_notify_vertify_inprocess', print_r($results, true));
			if (strcmp ($results, "VERIFIED") == 0) {
				if( strcmp($payment_status, 'Completed')!=0) {
					continue;
				}
				watchdog('paypal_notify_complete', t('Payor: @payor, Payee: @payee, Amount: @amount, Payment Date: @date, Txn ID: @txn_id', array(
					'@payor' => $array['payer_email'], '@payee' => $array['business'], '@amount' => $array['mc_gross'].$array['mc_currency'], '@date' => $array['payment_date'],
					'@txn_id' => $array['txn_id']
				)));
				
				$register_account = user_load($array['custom']);

				$register_account->mail = preg_replace('/test[0-9]{1,}_/U', '', $register_account->mail);
				
				watchdog('paypal_notify_load_account', t('Load account @email', array("@email"=>$register_account->mail)));
				if($register_account->status == 0) { // TODO:
					watchdog('paypal_notify_enable_account', t('Enable account @email', array('@email'=>$register_account->mail)));
					
					$name =  preg_replace('/test[0-9]{1,}_/U', '', $register_account->name);
					$mail =  preg_replace('/test[0-9]{1,}_/U', '', $register_account->mail);
					db_update('users')->fields(array('status'=>1, 'name'=>$name, 'mail'=>$mail))->condition('uid', $register_account->uid)->execute();
					$form_state = array('uid'=>$register_account->uid);
				}
			}else if (strcmp ($results, "INVALID") == 0) {
				watchdog('paypal_notify_verfity_fail', t('Can not vertify paypel payment. payor: @payor, payee: @payee', 
					array('@payee' =>$array['business'],  '@payor'=>$array['payer_email'])));
			}
		}
	}
}

/**
 * @return string
 */
function zdigital_user_register_success($uid) {
	global $user;
	$uid = $uid;
	
	$account = user_load($uid);
	
	if($account && $account->status) {
		$form_state = array('uid' => $uid);
		user_login_submit(array(), $form_state);
	}
	
	$output = '';
	if(user_is_anonymous()) {
		return drupal_access_denied();
	}else{ // register

		list($firstname) = field_get_items('user', $account, 'field_first_name');
		list($lastname) = field_get_items('user', $account, 'field_last_name');
		$output = t(variable_get("user_register_success_page", '<p>Order #<b>@order_number</b></p>
 
		<p>Thank you !username, registration was successful.</p>
		<p></p>
		<p>You will be sent an email confirmation and receipt of your subscription.</p>'), array(
				'@order_number' => $uid,
				'!username' => l($firstname['safe_value'].' '.$lastname['safe_value'], 'user/'.$account->uid)
		));
	}

	return $output;
}


function zdigital_podcast_player_page_callback() {
	
	
	$output = theme('zdigital_podcast_player', array('embid'=>8131, 'width'=>960, 'height'=>325));
	echo $output;
	exit();
}

/**
 * @param unknown $node
 */
function zdigital_podcast_video_player_page_callback($node) {
	
	$output = theme('zdigital_podcast_video_player', array('node'=>$node, 'width'=>'100%', 'height'=>'390px'));
	echo $output;
	exit();
}

function zdigital_user_change_password_page_callback() {
	global $user;
	if(user_is_anonymous()) {
		drupal_goto('user/login');
	}
	$form_state = array();
	
	if(is_ajax()) {
		$form = drupal_get_form('zdigital_user_change_password_form', $user);
		$output = drupal_render($form);
		echo drupal_json_encode(array('data'=>$output, 'title'=>t('Manage Account')));
		exit();
	}
	return drupal_get_form('zdigital_user_change_password_form', $user);
}

function zdigital_user_change_password_form($form, $form_state, $account) {
	$form = array();
	$form['uid'] = array(
		'#type' => "value",
		'#value' => $account->uid
	);
	
	$form['password'] = array(
// 		'#type' => 'password_confirm',
// 		'#title' => t('Change Password'),
// 		'#required' => true
		'#tree' => TRUE,
		'#element_validate' => array('password_confirm_validate')
	);
	
	$form['password']['pass1'] = array(
		'#type' => 'password',
		'#title' => t('Change Password'),
		'#required' => TRUE,
		'#parent_class' => array('col-md-6')
	);
	$form['password']['pass2'] = array(
		'#type' => 'password',
		'#title' => t('Repeat'),
		'#required' => TRUE,
		'#parent_class' => array('col-md-6')
	);

	$form['actions'] = array(
		'#type' => 'actions',
		'#attributes' => array(
			'class' => array('text-right')
		),
		'#weight' => 1
	);
	$form['actions']['submit'] = array(
		'#type' => "submit",
		'#value' => t("Update")
	);
	
	if(is_ajax()) {
		$block = module_invoke('block', 'block_view', 9);
		$form['helpers'] = array(
			'#prefix' => '<div>',
			'#markup' => $block['content'],
			'#suffix' => '</div>',
			'#weight' => 2
		);
	}

	return $form;
}

function zdigital_user_change_password_form_submit($form, &$form_state) {
	
	$values = $form_state['values'];
	
	$account = user_load($values['uid']);
	try{
		user_save($account, array('pass'=>$values['password']));
		drupal_set_message(t('Change password successful'));
	}catch(Exception $e){
		drupal_set_message(t('Error occur: @message', array('@message'=>$e->getMessage())), 'error');
	}
}

function zdigital_user_change_password_title_callback() {
	return t('Manage Account');
}