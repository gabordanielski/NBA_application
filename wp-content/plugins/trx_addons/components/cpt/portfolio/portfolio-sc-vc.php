<?php
/**
 * ThemeREX Addons Custom post type: Portfolio (WPBakery support)
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.5
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}



// Add [trx_sc_portfolio] in the VC shortcodes list
if (!function_exists('trx_addons_sc_portfolio_add_in_vc')) {
	function trx_addons_sc_portfolio_add_in_vc() {

		if (!trx_addons_exists_vc()) return;
	
		vc_lean_map("trx_sc_portfolio", 'trx_addons_sc_portfolio_add_in_vc_params');
		class WPBakeryShortCode_Trx_Sc_Portfolio extends WPBakeryShortCode {}
	}
	add_action('init', 'trx_addons_sc_portfolio_add_in_vc', 20);
}

// Return params
if (!function_exists('trx_addons_sc_portfolio_add_in_vc_params')) {
	function trx_addons_sc_portfolio_add_in_vc_params() {
		return apply_filters('trx_addons_sc_map', array(
				"base" => "trx_sc_portfolio",
				"name" => esc_html__("Portfolio", 'trx_addons'),
				"description" => wp_kses_data( __("Display portfolio items from specified group", 'trx_addons') ),
				"category" => esc_html__('ThemeREX', 'trx_addons'),
				"icon" => 'icon_trx_sc_portfolio',
				"class" => "trx_sc_portfolio",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array_merge(
					array(
						array(
							"param_name" => "type",
							"heading" => esc_html__("Layout", 'trx_addons'),
							"description" => wp_kses_data( __("Select shortcode's layout", 'trx_addons') ),
							"admin_label" => true,
							'edit_field_class' => 'vc_col-sm-4',
							"std" => "default",
							"value" => array_flip(apply_filters('trx_addons_sc_type', trx_addons_components_get_allowed_layouts('cpt', 'portfolio', 'sc'), 'trx_sc_portfolio')),
							"type" => "dropdown"
						),
						array(
							"param_name" => "more_text",
							"heading" => esc_html__("'More' text", 'trx_addons'),
							"description" => wp_kses_data( __("Specify caption of the 'Read more' button. If empty - hide button", 'trx_addons') ),
							'edit_field_class' => 'vc_col-sm-4',
							"std" => esc_html__('Read more', 'trx_addons'),
							"type" => "textfield"
						),
						array(
							"param_name" => "pagination",
							"heading" => esc_html__("Pagination", 'trx_addons'),
							"description" => wp_kses_data( __("Add pagination links after posts. Attention! If using slider - pagination not allowed!", 'trx_addons') ),
							'edit_field_class' => 'vc_col-sm-4',
							"std" => 'none',
							"value" => array_flip(trx_addons_get_list_sc_paginations()),
							"type" => "dropdown"
						),
						array(
							"param_name" => "cat",
							"heading" => esc_html__("Group", 'trx_addons'),
							"description" => wp_kses_data( __("Portfolio group", 'trx_addons') ),
							"value" => array_merge(array(esc_html__('- Select category -', 'trx_addons') => 0), 
													array_flip(trx_addons_get_list_terms(false, TRX_ADDONS_CPT_PORTFOLIO_TAXONOMY))),
							"std" => "0",
							"type" => "dropdown"
						)
					),
					trx_addons_vc_add_query_param(''),
					trx_addons_vc_add_slider_param(),
					trx_addons_vc_add_title_param(),
					trx_addons_vc_add_id_param()
				)
			), 'trx_sc_portfolio' );
	}
}
