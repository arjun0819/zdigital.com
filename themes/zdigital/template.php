<?php
function zdigital_breadcrumb($variables) {
	$breadcrumb = $variables['breadcrumb'];
	
	if (!empty($breadcrumb)) {
		// Provide a navigational heading to give context for breadcrumb links to
		// screen-reader users. Make the heading invisible with .element-invisible.
		$output = '<h2 class="element-invisible">' . t('You are here') . '</h2>';
	
		if(arg(0) == 'node' && arg(1) && $node=node_load(arg(1))) {
			if('blog' == $node->type){
				$breadcrumb = array(
					l(t('Home'), '<front>'),
					l(t('Opinión'), 'blog')
				);	
			}
		}
		
		$breadcrumb[] = truncate_utf8(drupal_get_title(), 40, true, true);
		$output .= '<div class="breadcrumb hidden-xs hidden-sm">' . implode(' » ', $breadcrumb) . '</div>';
		
		return $output;
	}
}

function zdigital_preprocess_toolbar(&$variables) {
	$variables['classes_array'][] = 'hidden-xs hidden-sm';
}

function zdigital_textfield($variables) {
	
	$variables['element']['#attributes']['class'][] = 'form-control';
 	return theme_textfield($variables);
}

function zdigital_password($variables) {
	
	$variables['element']['#attributes']['class'][] = 'form-control';
	return theme_password($variables);
}

function zdigital_button($variables) {
	
	$variables['element']['#attributes']['class'][] = 'btn';
	return theme_button($variables);
}

function zdigital_form_element($variables) {
	$element = &$variables['element'];
	
	// This function is invoked as theme wrapper, but the rendered form element
	// may not necessarily have been processed by form_builder().
	$element += array(
		'#title_display' => 'before',
	);
	
	// Add element #id for #type 'item'.
	if (isset($element['#markup']) && !empty($element['#id'])) {
		$attributes['id'] = $element['#id'];
	}
	// Add element's #type and #name as class to aid with JS/CSS selectors.
	$attributes['class'] = array('form-item');
	if (!empty($element['#type'])) {
		$attributes['class'][] = 'form-type-' . strtr($element['#type'], '_', '-');
	}
	if (!empty($element['#name'])) {
		$attributes['class'][] = 'form-item-' . strtr($element['#name'], array(' ' => '-', '_' => '-', '[' => '-', ']' => ''));
	}
	// Add a class for disabled elements to facilitate cross-browser styling.
	if (!empty($element['#attributes']['disabled'])) {
		$attributes['class'][] = 'form-disabled';
	}
	
	if(!empty($element['#parent_class'])) {
		$attributes['class'] = is_array($element['#parent_class']) ? array_merge($element['#parent_class'], $attributes['class']) : array_push($attributes['class'], $element['#parent_class']);
	}
	$output = '<div' . drupal_attributes($attributes) . '>' . "\n";
	
	// If #title is not set, we don't display any label or required marker.
	if (!isset($element['#title'])) {
		$element['#title_display'] = 'none';
	}
	$prefix = isset($element['#field_prefix']) ? '<span class="field-prefix">' . $element['#field_prefix'] . '</span> ' : '';
	$suffix = isset($element['#field_suffix']) ? ' <span class="field-suffix">' . $element['#field_suffix'] . '</span>' : '';
	
	switch ($element['#title_display']) {
		case 'before':
		case 'invisible':
			$output .= ' ' . theme('form_element_label', $variables);
			$output .= ' ' . $prefix . $element['#children'] . $suffix . "\n";
			break;
	
		case 'after':
			$output .= ' ' . $prefix . $element['#children'] . $suffix;
			$output .= ' ' . theme('form_element_label', $variables) . "\n";
			break;
	
		case 'none':
		case 'attribute':
			// Output no label and no required marker, only the children.
			$output .= ' ' . $prefix . $element['#children'] . $suffix . "\n";
			break;
	}
	
	if (!empty($element['#description'])) {
		$output .= '<div class="description">' . $element['#description'] . "</div>\n";
	}
	
	$output .= "</div>\n";
	
	return $output;	
}

function zdigital_status_messages(&$variables) {
	$display = $variables['display'];
	$output = '';
	
	$status_heading = array(
		'status' => t('Status message'),
		'error' => t('Error message'),
		'warning' => t('Warning message'),
	);
	
	$alert_classes = array(
		'status' => 'alert alert-success',
		'error' => 'alert alert-danger',
		'warning' => 'alert alert-warning'
	);
	foreach (drupal_get_messages($display) as $type => $messages) {
		$output .= "<div class=\"$alert_classes[$type] alert-dismissable\">\n ";
		$output .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
		if (!empty($status_heading[$type])) {
			$output .= '<h2 class="element-invisible">' . $status_heading[$type] . "</h2>\n";
		}
		if (count($messages) > 1) {
			$output .= " <dl>\n";
			foreach ($messages as $message) {
				$output .= '  <dd>' . $message . "</dd>\n";
			}
			$output .= " </dl>\n";
		}
		else {
			$output .= $messages[0];
		}
		$output .= "</div>\n";
	}
	return $output;
}

function zdigital_image($variables) {
	$attributes = $variables['attributes'];
	$attributes['src'] = file_create_url($variables['path']);
	
	foreach (array('alt', 'title') as $key) {
	
		if (isset($variables[$key])) {
			$attributes[$key] = $variables[$key];
		}
	}
	
	if(isset($attributes['width'])) { unset($attributes['width']);}
	if(isset($attributes['height'])){ unset($attributes['height']); }
	
	return '<img' . drupal_attributes($attributes) . ' />';
}