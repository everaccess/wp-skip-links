<?php
/*
 * Create a field for the panel
 */
function wpsl_panel_field($type, $name, $label, $value, $columns = 2, $echo = false) {
	$options_group = get_option( WPSL_ID );
	$current_value = (isset($options_group[$name])) ? $options_group[$name] : '';
	$output     = '<div class="ea-field-group column-'. $columns .'">';
	$output    .= ' <label for="ea-field-'.$name.'">'.$label.'</label>';
	if($type == 'select') {
		$output .= '<select name="'.WPSL_ID.'['.$name.']" id="ea-field-'.$name.'">';
		foreach ($value as $key => $option_label) {
			$output .= '<option value="'.$key.'" '.selected($current_value, $key, false).'>'.$option_label.'</option>';
		}
		$output .= '</select>';
	} elseif ($type == 'color') {
		$output .= '<input type="color" name="'.WPSL_ID.'['.$name.']" id="ea-field-'.$name.'" class="color" value="'.$current_value.'">';
	} elseif($type == 'number') {
		$output .= '<input type="number" name="'.WPSL_ID.'['.$name.']" id="ea-field-'.$name.'" class="number" value="'.$current_value.'">';
	} else {
		$output .= '<input type="text" name="'.WPSL_ID.'['.$name.']" id="ea-field-'.$name.'" value="'.$current_value.'">';
	}
	$output    .= '</div>';
	if($echo == false)
		return $output;
	elseif ($echo == true)
		echo $output;
}