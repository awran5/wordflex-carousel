<?php
/**
 * Slider field type for CMB2. Ready to use with a theme
 * @link https://github.com/improy/CMB2-slider-field
 *
 * Modified: Stracture changed
 * Modified: Removed jquery ui dependencie
 */


function cmb2_render_range( $field, $field_escaped_value, $field_object_id, $field_object_type, $field_type_object ){

	$slider = $field_type_object->input( array(
		'type'  => 'range',
		'class' => 'cmb2-range',
		'start' => absint( $field_escaped_value ),
		'min'   => $field->min(),
		'step'  => $field->step(),
		'max'   => $field->max(),
		'desc'  => '',
	) );

	$slider .= '<span class="range-text">' . $field->value_label() . ' <span class="range-value"></span></span>';
	$slider .= $field_type_object->_desc(true);
	echo $slider;
}
add_filter( 'cmb2_render_range', 'cmb2_render_range', 10, 5 );


