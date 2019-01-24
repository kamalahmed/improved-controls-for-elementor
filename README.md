# Improved Controls for Elementor Page Builder Plugin For WordPress
These are some improved single and group controls for the elementor page builder plugin. For example, You can use text gradient control, Border gradient control, Responsive box shadows etc which are not supported by elementor by default.

## How to use them 
We need to include all the controls in our theme's functions.php or in our plugin and register them. Then we can use them as regular elementor control in any custom elementor widgets.

## Register the controls
Use the follwoing hook to register your controls

         // register custom elementor controls
 	add_action( 'elementor/controls/controls_registered',  'prefix_register_control' );
    
         /**
	 * @param \Elementor\Controls_Manager $controls_manager
	 */
	function prefix_register_control( $controls_manager ){
		//At first you need to include all of these files in your theme or plugin.

		include_once  get_template_directory(). 'elementor-controls/txc-text-gradient.php';
		include_once  get_template_directory(). 'elementor-controls/txc-border-gradient.php';
		include_once  get_template_directory(). 'elementor-controls/txc-border-control.php';
		include_once  get_template_directory(). 'elementor-controls/txc-box-shadow.php';
    
		$controls_manager->add_group_control( 'txc_text_gradient', new Group_Control_Text_Gradient() );
		$controls_manager->add_group_control( 'txc_border_gradient', new Group_Control_TXC_Border_Gradient() );
		$controls_manager->add_group_control( 'txc_border', new Group_Control_TXC_Border() );
		$controls_manager->add_group_control( 'txc-box-shadow', new Group_Control_TXC_Box_Shadow() );
	}
  
  ## how to use in yuor widget control?
  You can use this like below:
  
    // using text gradient for heading title in this example. 
     $this->add_group_control(
			Group_Control_Text_Gradient::get_type(),
			[
				'name' => 'background_color',
				'label' => __( 'Color', 'text-domain' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .elementor-heading-title',
			]
		);
    
    
You can use other controls like this. If you have any confusion, please feel free to ask me, I will be happy to help you in more details. You can use this freely with any of your fee or commerecial projects without any limitation. You are more than welcome to contribute if you like. Thanks.
  
