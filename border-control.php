<?php
namespace Elementor;


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Custom Border Control control.
 *
 *
 *
 * @since 1.0.0
 */
if ( class_exists( 'Elementor\Plugin') && !class_exists( 'Group_Control_TXC_Border') )
{
	/**
	 * Elementor border control.
	 *
	 * A base control for creating border control. Displays input fields to define
	 * border type, border width and border color.
	 *
	 * @since 1.0.0
	 */
	class Group_Control_TXC_Border extends Group_Control_Base {

		/**
		 * Fields.
		 *
		 * Holds all the border control fields.
		 *
		 * @since 1.0.0
		 * @access protected
		 * @static
		 *
		 * @var array Border control fields.
		 */
		protected static $fields;

		/**
		 * Get border control type.
		 *
		 * Retrieve the control type, in this case `border`.
		 *
		 * @since 1.0.0
		 * @access public
		 * @static
		 *
		 * @return string Control type.
		 */
		public static function get_type() {
			return 'txc_border';
		}

		/**
		 * Init fields.
		 *
		 * Initialize border control fields.
		 *
		 * @since 1.2.2
		 * @access protected
		 *
		 * @return array Control fields.
		 */
		protected function init_fields() {
			$fields = [];

			$fields['border'] = [
				'label' => _x( 'Border Type', 'Border Control', 'text-domain' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'None', 'text-domain' ),
					'solid' => _x( 'Solid', 'Border Control', 'text-domain' ),
					'double' => _x( 'Double', 'Border Control', 'text-domain' ),
					'dotted' => _x( 'Dotted', 'Border Control', 'text-domain' ),
					'dashed' => _x( 'Dashed', 'Border Control', 'text-domain' ),
					'groove' => _x( 'Groove', 'Border Control', 'text-domain' ),
				],
				'selectors' => [
					'{{SELECTOR}}' => 'border-style: {{VALUE}};',
				],
			];

			$fields['width'] = [
				'label' => _x( 'Width', 'Border Control', 'text-domain' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{SELECTOR}}' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'border!' => '',
				],
				'responsive' => true,
			];

			return $fields;
		}

		/**
		 * Get default options.
		 *
		 * Retrieve the default options of the border control. Used to return the
		 * default options while initializing the border control.
		 *
		 * @since 1.9.0
		 * @access protected
		 *
		 * @return array Default border control options.
		 */
		protected function get_default_options() {
			return [
				'popover' => false,
			];
		}
	}
}

