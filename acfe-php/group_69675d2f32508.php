<?php 

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_69675d2f32508',
	'title' => 'block:status',
	'fields' => array(
		array(
			'key' => 'field_69675d2f379a8',
			'label' => 'Заголовок',
			'name' => 'title',
			'type' => 'group',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'layout' => 'table',
			'acfe_seamless_style' => 0,
			'acfe_group_modal' => 0,
			'acfe_group_modal_close' => 0,
			'acfe_group_modal_button' => '',
			'acfe_group_modal_size' => 'large',
			'sub_fields' => array(
				array(
					'key' => 'field_69675d2f3b3ed',
					'label' => 'Текст',
					'name' => 'text',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'field_69675d2f3b927',
					'label' => 'Тип',
					'name' => 'type',
					'type' => 'select',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '20',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						'h1' => 'H1',
						'h2' => 'H2',
					),
					'default_value' => 'h2',
					'allow_null' => 0,
					'multiple' => 0,
					'max' => '',
					'ui' => 0,
					'return_format' => 'value',
					'prepend' => '',
					'append' => '',
					'ajax' => 0,
					'placeholder' => '',
					'allow_custom' => 0,
					'search_placeholder' => '',
					'min' => '',
				),
			),
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'post',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'left',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => false,
	'description' => '',
	'acfe_autosync' => array(
		0 => 'php',
	),
	'acfe_form' => 0,
	'acfe_display_title' => '',
	'acfe_meta' => '',
	'acfe_note' => '',
	'modified' => 1768381759,
));

endif;