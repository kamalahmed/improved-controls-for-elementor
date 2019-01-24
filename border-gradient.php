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
if ( class_exists( 'Elementor\Plugin') && !class_exists( 'Group_Control_TXC_Border_Gradient') )
{
	/**
	 * Elementor Custom gradient control.
	 *
	 * A base control for creating border control. Displays input fields to define
	 * border type, border width and border color.
	 *
	 * @since 1.0.0
	 */
	class Group_Control_TXC_Border_Gradient extends Group_Control_Base {

		/**
		 * Fields.
		 *
		 * Holds all the background control fields.
		 *
		 * @since 1.2.2
		 * @access protected
		 * @static
		 *
		 * @var array Border Color control fields.
		 */
		protected static $fields;

		/**
		 * Border Color Types.
		 *
		 * Holds all the available background types.
		 *
		 * @since 1.2.2
		 * @access private
		 * @static
		 *
		 * @var array
		 */
		private static $border_color_types;

		/**
		 * Get background control type.
		 *
		 * Retrieve the control type, in this case `background`.
		 *
		 * @since 1.0.0
		 * @access public
		 * @static
		 *
		 * @return string Control type.
		 */
		public static function get_type() {
			return 'txc_border_gradient';
		}

		/**
		 * Get background control types.
		 *
		 * Retrieve available background types.
		 *
		 * @since 1.2.2
		 * @access public
		 * @static
		 *
		 * @return array Available background types.
		 */
		public static function get_border_color_types() {
			if ( null === self::$border_color_types ) {
				self::$border_color_types = self::get_default_border_color_types();
			}

			return self::$border_color_types;
		}

		/**
		 * Get Default background types.
		 *
		 * Retrieve background control initial types.
		 *
		 * @since 2.0.0
		 * @access private
		 * @static
		 *
		 * @return array Default background types.
		 */
		private static function get_default_border_color_types() {
			return [
				'classic' => [
					'title' => _x( 'Classic', 'Border Color Control', 'text-domain' ),
					'icon' => 'fa fa-paint-brush',
				],
				'gradient' => [
					'title' => _x( 'Gradient', 'Border Color Control', 'text-domain' ),
					'icon' => 'fa fa-barcode',
				],
			];
		}

		/**
		 * Init fields.
		 *
		 * Initialize background control fields.
		 *
		 * @since 1.2.2
		 * @access public
		 *
		 * @return array Control fields.
		 */
		public function init_fields() {
			$fields = [];

			$fields['background'] = [
				'label' => _x( 'Border Color Type', 'Border Color Control', 'text-domain' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'render_type' => 'ui',
			];

			$fields['color'] = [
				'label' => _x( 'Color', 'Border Color Control', 'text-domain' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'title' => _x( 'Border Color Color', 'Border Color Control', 'text-domain' ),
				'selectors' => [
					'{{SELECTOR}}' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'background' => [ 'classic', 'gradient' ],
				],
			];

			$fields['color_stop'] = [
				'label' => _x( 'Location', 'Border Color Control', 'text-domain' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
					'size' => 0,
				],
				'render_type' => 'ui',
				'condition' => [
					'background' => [ 'gradient' ],
				],
				'of_type' => 'gradient',
			];

			$fields['color_b'] = [
				'label' => _x( 'Second Color', 'Border Color Control', 'text-domain' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#f2295b',
				'render_type' => 'ui',
				'condition' => [
					'background' => [ 'gradient' ],
				],
				'of_type' => 'gradient',
			];

			$fields['color_b_stop'] = [
				'label' => _x( 'Location', 'Border Color Control', 'text-domain' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'render_type' => 'ui',
				'condition' => [
					'background' => [ 'gradient' ],
				],
				'of_type' => 'gradient',
			];

			$fields['gradient_type'] = [
				'label' => _x( 'Type', 'Border Color Control', 'text-domain' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'linear' => _x( 'Linear', 'Border Color Control', 'text-domain' ),
					'radial' => _x( 'Radial', 'Border Color Control', 'text-domain' ),
				],
				'default' => 'linear',
				'render_type' => 'ui',
				'condition' => [
					'background' => [ 'gradient' ],
				],
				'of_type' => 'gradient',
			];

			$fields['gradient_angle'] = [
				'label' => _x( 'Angle', 'Border Color Control', 'text-domain' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'deg' ],
				'default' => [
					'unit' => 'deg',
					'size' => 180,
				],
				'range' => [
					'deg' => [
						'step' => 10,
					],
				],
				'selectors' => [
					'{{SELECTOR}}' => 'border-color: transparent; -webkit-border-image: linear-gradient({{SIZE}}{{UNIT}}, {{color.VALUE}} {{color_stop.SIZE}}{{color_stop.UNIT}}, {{color_b.VALUE}} {{color_b_stop.SIZE}}{{color_b_stop.UNIT}}); -moz-border-image: linear-gradient({{SIZE}}{{UNIT}}, {{color.VALUE}} {{color_stop.SIZE}}{{color_stop.UNIT}}, {{color_b.VALUE}} {{color_b_stop.SIZE}}{{color_b_stop.UNIT}}); -o-border-image: linear-gradient({{SIZE}}{{UNIT}}, {{color.VALUE}} {{color_stop.SIZE}}{{color_stop.UNIT}}, {{color_b.VALUE}} {{color_b_stop.SIZE}}{{color_b_stop.UNIT}}); border-image: linear-gradient({{SIZE}}{{UNIT}}, {{color.VALUE}} {{color_stop.SIZE}}{{color_stop.UNIT}}, {{color_b.VALUE}} {{color_b_stop.SIZE}}{{color_b_stop.UNIT}}); border-image-slice: 1;',
				],
				'condition' => [
					'background' => [ 'gradient' ],
					'gradient_type' => 'linear',
				],
				'of_type' => 'gradient',
			];

			$fields['gradient_position'] = [
				'label' => _x( 'Position', 'Border Color Control', 'text-domain' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'center center' => _x( 'Center Center', 'Border Color Control', 'text-domain' ),
					'center left' => _x( 'Center Left', 'Border Color Control', 'text-domain' ),
					'center right' => _x( 'Center Right', 'Border Color Control', 'text-domain' ),
					'top center' => _x( 'Top Center', 'Border Color Control', 'text-domain' ),
					'top left' => _x( 'Top Left', 'Border Color Control', 'text-domain' ),
					'top right' => _x( 'Top Right', 'Border Color Control', 'text-domain' ),
					'bottom center' => _x( 'Bottom Center', 'Border Color Control', 'text-domain' ),
					'bottom left' => _x( 'Bottom Left', 'Border Color Control', 'text-domain' ),
					'bottom right' => _x( 'Bottom Right', 'Border Color Control', 'text-domain' ),
				],
				'default' => 'center center',
				'selectors' => [
					'{{SELECTOR}}' => 'border-color: transparent; border-image: radial-gradient(at {{VALUE}}, {{color.VALUE}} {{color_stop.SIZE}}{{color_stop.UNIT}}, {{color_b.VALUE}} {{color_b_stop.SIZE}}{{color_b_stop.UNIT}}); border-image-slice: 1;',
				],
				'condition' => [
					'background' => [ 'gradient' ],
					'gradient_type' => 'radial',
				],
				'of_type' => 'gradient',
			];

			return $fields;
		}

		/**
		 * Get child default args.
		 *
		 * Retrieve the default arguments for all the child controls for a specific group
		 * control.
		 *
		 * @since 1.2.2
		 * @access protected
		 *
		 * @return array Default arguments for all the child controls.
		 */
		protected function get_child_default_args() {
			return [
				'types' => [ 'classic', 'gradient' ],
			];
		}

		/**
		 * Filter fields.
		 *
		 * Filter which controls to display, using `include`, `exclude`, `condition`
		 * and `of_type` arguments.
		 *
		 * @since 1.2.2
		 * @access protected
		 *
		 * @return array Control fields.
		 */
		protected function filter_fields() {
			$fields = parent::filter_fields();

			$args = $this->get_args();

			foreach ( $fields as &$field ) {
				if ( isset( $field['of_type'] ) && ! in_array( $field['of_type'], $args['types'] ) ) {
					unset( $field );
				}
			}

			return $fields;
		}

		/**
		 * Prepare fields.
		 *
		 * Process background control fields before adding them to `add_control()`.
		 *
		 * @since 1.2.2
		 * @access protected
		 *
		 * @param array $fields Border Color control fields.
		 *
		 * @return array Processed fields.
		 */
		protected function prepare_fields( $fields ) {
			$args = $this->get_args();

			$border_color_types = self::get_border_color_types();

			$choose_types = [];

			foreach ( $args['types'] as $type ) {
				if ( isset( $border_color_types[ $type ] ) ) {
					$choose_types[ $type ] = $border_color_types[ $type ];
				}
			}

			$fields['background']['options'] = $choose_types;

			return parent::prepare_fields( $fields );
		}

		/**
		 * Get default options.
		 *
		 * Retrieve the default options of the background control. Used to return the
		 * default options while initializing the background control.
		 *
		 * @since 1.9.0
		 * @access protected
		 *
		 * @return array Default background control options.
		 */
		protected function get_default_options() {
			return [
				'popover' => false,
			];
		}
	}
}

