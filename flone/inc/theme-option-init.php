<?php

/**

 * ReduxFramework Sample Config File

 * For full documentation, please visit: http://docs.reduxframework.com/

 */

if ( ! class_exists( 'Redux' ) ) {

    return;

}



// This is your option name where all the Redux data is stored.

$opt_name = "flone_opt";



// This line is only for altering the demo. Can be easily removed.

$opt_name = apply_filters( 'redux_demo/opt_name', $opt_name );

/**

 * ---> SET ARGUMENTS

 * All the possible arguments for Redux.

 * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

 * */





$theme = wp_get_theme(); // For use with some settings. Not necessary.



$args = array(

    'opt_name'             => $opt_name,



    'display_name'         => $theme->get( 'Name' ),

    'display_version'      => $theme->get( 'Version' ),



    'menu_title'           => esc_html__( 'Flone Options', 'flone' ),

    'page_title'           => esc_html__( 'Flone Options', 'flone' ),



    'menu_type'            => 'submenu',

    'page_parent' => 'flone',

    'page_permissions'     => 'manage_options',

    'page_priority'        => 100,

    'dev_mode'             => false,



);



Redux::setArgs( $opt_name, $args );



/*

 * ---> END ARGUMENTS

 */



// -> START Basic Fields



/**

* General 

*/

Redux::setSection( $opt_name, array(

    'title'            => esc_html__( 'General', 'flone' ),

    'id'               => 'flone-general-settings',

    'icon'             => 'el el-adjust-alt',

    'customizer_width' => '500px',

    'fields'           => array( 

        array(

            'id'          => 'primary_color',

            'type'        => 'color',

            'title'       => esc_html__('Primary Color', 'flone'),

            'subtitle'    => esc_html__('Choose your preferred color to change theme main color.', 'flone'),

        ),

        array(

            'id'          => 'secondary_color',

            'type'        => 'color',

            'title'       => esc_html__('Secondary Color', 'flone'),

            'subtitle'    => esc_html__('Choose your preferred color to change theme secondary color.', 'flone'),

        ),

        array(

            'id'          => 'link_color',

            'type'        => 'color',

            'title'       => esc_html__('Link Color', 'flone'),

            'subtitle'    => esc_html__('Choose your preferred color to change link Color.', 'flone'),

        ),

        array(

            'id'          => 'link_hover_color',

            'type'        => 'color',

            'title'       => esc_html__('Link Hover Color', 'flone'),

            'subtitle'    => esc_html__('Choose your preferred color to change link Hover Color.', 'flone'),

        ),

        array(

            'id'          => 'onsale_bg_color',

            'type'        => 'background',

            'title'       => esc_html__('OnSale Bg Color', 'flone'),

            'background-repeat' => false,

            'background-attachment' => false,

            'background-image' => false,

            'background-size' => false,

            'background-position' => false,

            'compiler' => array(

            	'.woocommerce span.onsale,.woocommerce span.onsale.pink',

            ),

        ),

        array(

            'id'          => 'onsale_text_color',

            'type'        => 'color',

            'title'       => esc_html__('OnSale Text Color', 'flone'),

            'compiler' => array(

            	'.woocommerce span.onsale',

            ),

        ),

        array(

            'id'          => 'discount_bg_color',

            'type'        => 'background',

            'title'       => esc_html__('Discount Bg Color', 'flone'),

            'background-repeat' => false,

            'background-attachment' => false,

            'background-image' => false,

            'background-size' => false,

            'background-position' => false,

            'compiler' => array(

            	'.woocommerce span.onsale.pink',

            ),

        ),

        array(

            'id'          => 'discount_text_color',

            'type'        => 'color',

            'title'       => esc_html__('Discount Text Color', 'flone'),

            'compiler' => array(

            	'.woocommerce span.onsale.pink',

            ),

        ),

        array(

            'id'                    => 'google_map_api_key',

            'type'                  => 'text',

            'title'                 => esc_html__('Google Map API Key', 'flone'),

            'default'               => 'AIzaSyCGM-62ap9R-huo50hJDn05j3x-mU9151Y'

        ),

        array(

            'id'                    => 'enable_preloader_whole_site',

            'type'                  => 'button_set',

            'title'                 => esc_html__('Enable Preloader For Whole Site', 'flone'),

            'options'               => array(

                '1'               => esc_html__('Yes', 'flone'),

                '0'                => esc_html__('No', 'flone'), 

             ), 

            'default'               => '0',

        ),

        array(

            'id'                    => 'enable_preloader_front',

            'type'                  => 'button_set',

            'title'                 => esc_html__('Enable Preloader For Frontpage', 'flone'),

            'options'               => array(

                '1'               => esc_html__('Yes', 'flone'),

                '0'                => esc_html__('No', 'flone'), 

             ), 

            'default'               => '0',

            'required'                  => array('enable_preloader_whole_site','equals', '0'),

        ),

        array(

            'id'                    => 'enable_preloader_shop',

            'type'                  => 'button_set',

            'title'                 => esc_html__('Enable Preloader For Shop', 'flone'),

            'options'               => array(

                '1'               => esc_html__('Yes', 'flone'),

                '0'                => esc_html__('No', 'flone'), 

             ), 

            'default'               => '0',

            'required'                  => array('enable_preloader_whole_site','equals', '0'),

        ),

        array(

            'id'                    => 'enable_backto_top',

            'type'                  => 'button_set',

            'title'                 => esc_html__('Enable Back To Top', 'flone'),

            'subtitle'              => esc_html__('Enable the back to top button that appears in the bottom right corner of the screen.', 'flone'),

            'options'               => array(

                '1'               => esc_html__('Yes', 'flone'),

                '0'                => esc_html__('No', 'flone'), 

             ), 

            'default'               => '1'

        ),

    ) 

) );



// Typography

Redux::setSection( $opt_name, array(

    'id'        => 'flone_typography_settings',

    'title'     => esc_html__('Typography', 'flone'),

    'icon'      => 'el el-fontsize',

    'fields'    => array(

            array(

                'id'                    => 'body_typography',

                'type'                  => 'typography',

                'title'                 => esc_html__('Body Typography', 'flone'),

                'subtitle'              => esc_html__('Controls the typography settings of the body.', 'flone'),

                'google'                => true,        

                'subsets'               => false, 

                'word-spacing'          => true, 

                'letter-spacing'        => true,

                'text-align'            => false,

                'all_styles'            => true,    

                'compiler'                => array('body'), 

                'units'                 => 'px',

            ),

            array(

                'id'                    => 'h1_typography',

                'type'                  => 'typography',

                'title'                 => esc_html__('H1 Heading Typography', 'flone'),

                'subtitle'              => esc_html__('Controls the typography settings of the H1 heading.', 'flone'),

                'google'                => true,    

                'text-transform'        => true, 

                'word-spacing'          => true, 

                'letter-spacing'        => true,                    

                'subsets'               => false, 

                'text-align'            => false,

                'all_styles'            => true,     

                'units'                 => 'px',

                'compiler'                => array('h1'),

            ),

            array(

                'id'                    => 'h2_typography',

                'type'                  => 'typography',

                'title'                 => esc_html__('H2 Heading Typography', 'flone'),

                'subtitle'              => esc_html__('Controls the typography settings of the H2 heading.', 'flone'),

                'google'                => true,  

                'text-transform'        => true, 

                'letter-spacing'        => true,                    

                'word-spacing'          => true,    

                'subsets'               => false, 

                'text-align'            => false,

                'all_styles'            => true,    

                'units'                 => 'px',

                'compiler'                => array('h2'),

            ),

            array(

                'id'                    => 'h3_typography',

                'type'                  => 'typography',

                'title'                 => esc_html__('H3 Heading Typography', 'flone'),

                'subtitle'              => esc_html__('Controls the typography settings of the H3 heading.', 'flone'),

                'google'                => true, 

                'text-transform'        => true, 

                'letter-spacing'        => true,                    

                'word-spacing'          => true,    

                'subsets'               => false, 

                'text-align'            => false,

                'all_styles'            => true,     

                'units'                 => 'px',

                'compiler'                => array('h3'),

            ),

            array(

                'id'                    => 'h4_typography',

                'type'                  => 'typography',

                'title'                 => esc_html__('H4 Heading Typography', 'flone'),

                'subtitle'              => esc_html__('Controls the typography settings of the H4 heading.', 'flone'),

                'google'                => true,    

                'text-transform'        => true, 

                'word-spacing'          => true, 

                'letter-spacing'        => true,                    

                'subsets'               => false, 

                'text-align'            => false,

                'all_styles'            => true,     

                'units'                 => 'px',

                'compiler'                => array('h4'),

            ),

            array(

                'id'                    => 'h5_typography',

                'type'                  => 'typography',

                'title'                 => esc_html__('H5 Heading Typography', 'flone'),

                'subtitle'              => esc_html__('Controls the typography settings of the H5 heading.', 'flone'),

                'google'                => true,    

                'text-transform'        => true, 

                'word-spacing'          => true, 

                'letter-spacing'        => true,                    

                'subsets'               => false, 

                'text-align'            => false,

                'all_styles'            => true,    

                'units'                 => 'px',

                'compiler'                => array('h5'),

            ),

            array(

                'id'                    => 'h6_typography',

                'type'                  => 'typography',

                'title'                 => esc_html__('H6 Heading Typography', 'flone'),

                'subtitle'              => esc_html__('Controls the typography settings of the H6 heading.', 'flone'),

                'google'                => true,    

                'text-transform'        => true,  

                'word-spacing'          => true, 

                'letter-spacing'        => true,                    

                'subsets'               => false, 

                'text-align'            => false,

                'all_styles'            => true,     

                'units'                 => 'px',

                'compiler'                => array('h6'),

            ),



        )

    ) 

);





/**

* Layout Settings

*/

Redux::setSection( $opt_name, array(

    'title'            => esc_html__( 'Layout Settings', 'flone' ),

    'id'               => 'flone-layout-settings',

    'customizer_width' => '400px',

    'icon'             => 'el el-website',

    'fields'           => array(

    	array(

    	    'id' => 'site_padding',

    	    'type' => 'slider',

    	    'title' => esc_html__('Site Padding (px)', 'flone'),

    	    'subtitle' => esc_html__('Padding around the entire website. ', 'flone'),

    	    "default" => 0,

    	    "min" => 0,

    	    "step" => 5,

    	    "max" => 300,

    	    'display_value' => 'text'

    	),

    	array(

    	    'id'                    => 'site_content_pt',

    	    'type'                  => 'spacing',

    	    'title'                 => esc_html__('Site Content Padding Top', 'flone'),

    	    'subtitle'              => esc_html__('Top padding of the content.', 'flone'),

    	    'mode'                  => 'padding',

    	    'units'                 => array('em','px'),

    	    'right'                 => false,

    	    'left'                  => false,

    	    'bottom'                => false,

    	    'units_extended'        => false,

    	),

    	array(

    	    'id'                    => 'site_content_pb',

    	    'type'                  => 'spacing',

    	    'title'                 => esc_html__('Site Content Padding Bottom', 'flone'),

    	    'subtitle'              => esc_html__('Bottom padding of the content.', 'flone'),

    	    'mode'                  => 'padding',

    	    'units'                 => array('em','px'),

    	    'right'                 => false,

    	    'left'                  => false,

    	    'top'                   => false,

    	    'units_extended'        => false,

        )

    ) 

));









/**

* Header 

*/

Redux::setSection( $opt_name, array(

    'id'         => 'flone_header_settings',

    'title'      => esc_html__( 'Header', 'flone' ),

    'icon'       =>'el el-photo',

    'fields'     => array(

    	array(

    	    'id'       => 'header_style',

    	    'type'     => 'select',

    	    'title'    => esc_html__('Select Header Style', 'flone'), 

    	    'options'  => array(

    	        '1' => 'Header Style 1',

    	        '2' => 'Header Style 2',

    	        '3' => 'Header Style 3',

    	        '4' => 'Header Style 4',

    	        '5' => 'Header Style 5',

    	        '6' => 'Header Style 6',

    	        '7' => 'Header Style 7',

    	    ),

    	    'default'  => '1',

    	),

        array(

            'id'          => 'menu_default_color',

            'type'        => 'color',

            'title'       => esc_html__('Menu Default Color', 'flone'),

            'subtitle'    => esc_html__('Choose your preferred color to change menu default Color.', 'flone'),

        ),

    	array(

    	    'id'                    => 'header_width',

    	    'type'                  => 'button_set',

    	    'title'                 => esc_html__('Enable Full Width Header', 'flone'),

    	    'options'               => array(

    	        'full'              => esc_html__('Yes', 'flone'),

    	        'default'                 => esc_html__('No', 'flone'), 

    	     ), 

    	    'default'               => 'full',

    	    'required'              => array('header_style','!=','3'),

    	),

    	array(

    	    'id'                    => 'enable_transparent_header',

    	    'type'                  => 'button_set',

    	    'title'                 => esc_html__('Enable Transparent', 'flone'),

    	    'subtitle'              => esc_html__('Enable to make the header area transparent', 'flone'),

    	    'options'               => array(

    	        '1'               => esc_html__('Yes', 'flone'),

    	        '0'                => esc_html__('No', 'flone'), 

    	     ), 

    	    'default'               => '0',

    	    'required'              => array('header_style','!=','3'),

    	),

		array(

			'id'                    => 'flone_header_bg',

			'type'                  => 'background',

			'background-attachment' => false,

			'background-repeat'     => false,

			'background-size'       => false,

			'background-position'   => false,

			'background-image'      => false,

			'output'                => array('.header-bottom, .flone_header_4.header-padding-3,.header-padding-3.header_style_5'),

			'title'                 => esc_html__('Header Background color', 'flone'),

			'subtitle'              => esc_html__('Pick a color to set header area background.', 'flone'),

    	    'required'              => array('enable_transparent_header','!=','1'),

			'preview'               => false,

		),

		array(

			'id'                    => 'flone_header_style_three_bg',

			'type'                  => 'background',

			'background-attachment' => false,

			'background-repeat'     => false,

			'background-size'       => false,

			'background-position'   => false,

			'background-image'      => false,

			'output'                => array('.home-sidebar-left'),

			'title'                 => esc_html__('Header Background color', 'flone'),

			'subtitle'              => esc_html__('Pick a color to set header area background.', 'flone'),

    	    'required'              => array('header_style','equals','3'),

			'preview'               => false,

		),

    	array(

    	    'id'                    => 'enable_sticky_header',

    	    'type'                  => 'button_set',

    	    'title'                 => esc_html__('Enable Sticky', 'flone'),

    	    'subtitle'              => esc_html__('Enable to activate the sticky header.', 'flone'),

    	    'options'               => array(

    	        '1'               => esc_html__('Yes', 'flone'),

    	        '0'                => esc_html__('No', 'flone'), 

    	     ), 

    	    'default'               => '0',

    	    'required'              => array('header_style','!=','3'),

    	),

		array(

			'id'                    => 'flone_sticky_header_bg',

			'type'                  => 'background',

			'background-attachment' => false,

			'background-repeat'     => false,

			'background-size'       => false,

			'background-position'   => false,

			'background-image'      => false,

			'output'                => array('.sticky-bar.stick'),

			'title'                 => esc_html__('Sticky Header Background color', 'flone'),

			'subtitle'              => esc_html__('Pick a color to set sticky header area background.', 'flone'),

    	    'required'              => array('enable_sticky_header','!=','0'),

			'preview'               => false,

		),

        array(

            'id'          => 'sticky_menu_default_color',

            'type'        => 'color',

            'title'       => esc_html__('Sticky Menu Default Color', 'flone'),

            'subtitle'    => esc_html__('Choose your preferred color to change sticky menu default Color.', 'flone'),

    	    'required'              => array('enable_sticky_header','!=','0'),

        ),

    	array(

    	    'id'                    => 'show_header_icons',

    	    'type'                  => 'button_set',

    	    'title'                 => esc_html__('Show Header Icons', 'flone'),

    	    'subtitle'              => esc_html__('Show the quick navigation icons in header', 'flone'),

    	    'options'               => array(

    	        '1'               => esc_html__('Yes', 'flone'),

    	        '0'                => esc_html__('No', 'flone'), 

    	     ), 

    	    'default'               => '1',

    	    'required' => array( 

    	        array('header_style','=', array('2', '4', '5')),

    	    )

    	),

    	array(

    	    'id'       => 'quick_nav_show_search',

    	    'type'     => 'checkbox',

    	    'title'    => esc_html__('Show Search Icon', 'flone'), 

    	    'default'  => '1',// 1 = on | 0 = off

    	    'required'	=> array('show_header_icons','equals','1'),

    	),

    	array(

    	    'id'       => 'quick_nav_show_user',

    	    'type'     => 'checkbox',

    	    'title'    => esc_html__('Show User Icon', 'flone'), 

    	    'default'  => '1',// 1 = on | 0 = off

    	    'required'	=> array('show_header_icons','equals','1'),

    	),

    	array(

    	    'id'       => 'quick_nav_show_wishlist',

    	    'type'     => 'checkbox',

    	    'title'    => esc_html__('Show Wishlist Icon', 'flone'), 

    	    'default'  => '1',// 1 = on | 0 = off

    	    'required'	=> array('show_header_icons','equals','1'),

    	),

    	array(

    	    'id'       => 'quick_nav_show_minicart',

    	    'type'     => 'checkbox',

    	    'title'    => esc_html__('Show Minicart Icon', 'flone'), 

    	    'default'  => '1',// 1 = on | 0 = off

    	    'required'	=> array('show_header_icons','equals','1'),

    	),

    )

) );





/**

* Menu

*/

Redux::setSection( $opt_name, array(

  'title'      => esc_html__( 'Top Bar', 'flone' ),

  'id'         => 'flone_main_menu_settings',

  'icon'       =>'el el-eject',

  'subsection' => true,

  'fields'     => array(

        array(

          'id'                    => 'show_topbar',

          'type'                  => 'switch',

          'title'                 => esc_html__( 'Top Bar Show/Hide', 'flone' ),

          'subtitle'              => esc_html__( 'Turn on if you want to show the top bar area.', 'flone' ),

          'default'               => false,

        ),

        array(

            'id'       => 'topbar_style',

            'type'     => 'select',

            'title'    => esc_html__('Topbar Style', 'flone'), 

            'options'  => array(

                '1' => esc_html__( 'Style 1', 'flone' ),

                '2' => esc_html__( 'Style 2', 'flone' ),

            ),

            'default'  => '2',

            'required'              => array('show_topbar','equals','1'),

        ),

        array(

            'id'                    => 'topbar_width',

            'type'                  => 'button_set',

            'title'                 => esc_html__('Topbar Width', 'flone'),

            'options'               => array(

				'full'			=> esc_html__('Full Width', 'flone'),

				'0'				=> esc_html__('Default', 'flone'), 

             ), 

            'default'               => 'full',

            'required'              => array('show_topbar','equals','1'),

        ),

        array(

          'id'                    => 'show_topbar_language',

          'type'                  => 'switch',

          'title'                 => esc_html__( 'Language Switcher Show/Hide', 'flone' ),

          'default'               => false,

          'required'              => array('show_topbar','equals','1'),

        ),

        array(

          'id'                    => 'show_topbar_currency',

          'type'                  => 'switch',

          'title'                 => esc_html__( 'Currency Switcher Show/Hide', 'flone' ),

          'default'               => false,

          'required'              => array('show_topbar','equals','1'),

        ),

        array(

            'id'                    => 'currency_switcher_type',

            'type'                  => 'select',

            'title'                 => esc_html__('Currency Switcher Type', 'flone'),

            'description'           => __('Theme Default - You can only add/update/delete currencies from the dashboard.<br> WC Multi Currency Plugin - It has more options to for the multi currency.', 'flone'),

            'options'               => array(

				'default'	=> esc_html__('Theme Default', 'flone'),

				'plugin'	=> esc_html__('WC Multi Currency Plugin', 'flone'), 

             ), 

            'default'               => 'plugin',

            'required'              => array('show_topbar_currency','equals','1'),

        ),

        array(

            'id'                    => 'topbar_text_1',

            'type'                  => 'textarea',

            'title'                 => esc_html__( 'Call To Action Text 1', 'flone' ),

            'subtitle'              => esc_html__( 'This text will show at the left side (Support HTML Tags)', 'flone' ),

            'required'              => array('show_topbar','equals','1'),

        ),

        array(

            'id'                    => 'topbar_text_2',

            'type'                  => 'textarea',

            'title'                 => esc_html__( 'Call To Action Text 2', 'flone' ),

            'subtitle'              => esc_html__( 'This text will show at the right side (Support HTML Tags)', 'flone' ),

            'required'              => array('show_topbar','equals','1'),

        ),

        array(

          'id'                    => 'topbar_bg',

          'type'                  => 'background',

          'background-attachment' => false,

          'background-repeat'     => false,

          'background-size'       => false,

          'background-position'   => false,

          'background-image'      => false,

          'title'                 => esc_html__('Top Bar Background Color', 'flone'),

          'subtitle'              => esc_html__('Controls the background color of the header top bar area', 'flone'),

          'required'              => array('show_topbar','equals','1'),

          'compiler' => array(

          	'.header-top-area',

          ),

        ),

        array(

          'id'                    => 'topbar_text_color',

          'type'                  => 'color',

          'compiler'                => array(

          	'.header-top-area,

          	.header-offer p,

          	.language-currency-wrap .same-language-currency p,

          	.language-currency-wrap .same-language-currency a,

          	#gtranslate_selector,

          	.language-currency-wrap .same-language-currency::before,

          	.language-style::after

          	'

          ),

          'title'                 => esc_html__('Top Bar Text Color', 'flone'),

          'subtitle'              => esc_html__('Controls the color of the top bar text.', 'flone'),

          'transparent'           => false,

          'required'              => array('show_topbar','equals','1'),

        ),

        array(

          'id'                    => 'topbar_right_price_color',

          'type'                  => 'color',

          'compiler'                => array('.header-offer p span' ),

          'title'                 => esc_html__('Top Bar Right Price Color', 'flone'),

          'subtitle'              => esc_html__('Controls the color of the top bar right price text.', 'flone'),

          'transparent'           => false,

          'required'              => array('show_topbar','equals','1'),

        ),

        array(

            'id'       => 'topbar_link_color',

            'type'     => 'link_color',

            'title'    => esc_html__('Topbar Link Color Option', 'flone'),

            'compiler'                => array(

            	'.header-top-area a'

            )

        ),

        array(

          'id'                    => 'topbar_padding',

          'type'                  => 'spacing',

          'mode'                  => 'padding',

          'title'                 => esc_html__('Top Bar Padding ', 'flone'),

          'subtitle'              => esc_html__('Controls header top bar padding.', 'flone'),

          'right'                 => false,

          'left'                  => false,

          'compiler'                => array('.header-top-area'),

          'units'                 => array('em','px'),

          'required'              => array('show_topbar','equals','1'),

        ),

      )

  ) 

);



/**

* Breadcrumb

*/

Redux::setSection( $opt_name, array(

    'title'            => esc_html__( 'Breadcrumb', 'flone' ),

    'id'               => 'flone_breadcrumb_settings',

    'icon'             => 'el el-align-center',

    'fields'           => array(

    	array(

    	    'id'                    => 'show_breadcrumb',

    	    'type'                  => 'button_set',

    	    'title'                 => esc_html__('Show Breadcrumb', 'flone'),

    	    'options'               => array(

    	        '1'               => esc_html__('Yes', 'flone'),

    	        '0'                => esc_html__('No', 'flone'), 

    	     ), 

    	    'default'               => '1'

    	),

    	array(

    	    'id'                    => 'enable_breadcrumb_in_mobile',

    	    'type'                  => 'button_set',

    	    'title'                 => esc_html__('Enable Breadcrumb In Mobile Device', 'flone'),

    	    'options'               => array(

    	        '1'               => esc_html__('Yes', 'flone'),

    	        '0'                => esc_html__('No', 'flone'), 

    	     ),

    	    'default'               => '1',

    	    'required'              => array('show_breadcrumb','equals','1'),

    	),

    	array(

    	    'id'          => 'breadcrumb_bg',

    	    'type'        => 'background',

    	    'title'       => esc_html__('Breadcrumb Background', 'flone'),

    	    'required'              => array('show_breadcrumb','equals','1'),

    	    'compiler'	  => array(

    	    	'.breadcrumb-area'

    	    )

    	),

    	array(

    	    'id'          => 'breadcrumb_text_color',

    	    'type'        => 'color',

    	    'title'       => esc_html__('Breadcrumb Text Color', 'flone'),

    	    'subtitle'    => esc_html__('Choose your preferred text color for the Breadcrumb.', 'flone'),

    	    'required'              => array('show_breadcrumb','equals','1'),

    	    'compiler'	  => array(

    	    	'.breadcrumb-area ul li',

    	    	'.breadcrumb-area ul li p'

    	    )

    	),

    	array(

    	    'id'          => 'breadcrumb_sep_color',

    	    'type'        => 'background',

    	    'title'       => esc_html__('Breadcrumb Separator Color', 'flone'),

    	    'background-attachment' => false,

    	    'background-repeat'     => false,

    	    'background-size'       => false,

    	    'background-position'   => false,

    	    'background-image'      => false,

    	    'required'              => array('show_breadcrumb','equals','1'),

    	    'compiler'	  => array(

    	    	'.breadcrumb-content ul li::before',

    	    )

    	),

    	array(

    	    'id'       => 'breadcrumb_link_color',

    	    'type'     => 'link_color',

    	    'title'    => esc_html__('Breadcrumb Links Color', 'flone'),

    	    'required' => array('show_breadcrumb','equals','1'),

    	    'compiler'	  => array(

    	    	'.breadcrumb-area ul li a',

    	    )

    	),

    )

));



// Blog Options

Redux::setSection( $opt_name, array(

    'title'     => esc_html__('Blog', 'flone'),

    'id'        => 'flone_blog_settings',

    'icon'      => 'el el-edit',

    'fields'    => array(

    	array(

    	    'id'       => 'blog_sidebar',

    	    'type'     => 'select',

    	    'title'    => esc_html__('Blog Sidebar Position', 'flone'), 

    	    'options'  => array(

    	        'left' => esc_html__('Sidebar Left', 'flone'),

    	        'right' => esc_html__('Sidebar Right', 'flone'),

    	        'none' => esc_html__('No Sidebar', 'flone'),

    	    ),

    	    'default'  => 'left',

    	),

    	array(

    	    'id'       => 'blog_columns',

    	    'type'     => 'select',

    	    'title'    => esc_html__('Blog Columns', 'flone'), 

    	    'subtitle' => esc_html__('Define how many post in a row.', 'flone'),

    	    'options'  => array(

    	        '1' => esc_html__('1 Column', 'flone'),

    	        '2' => esc_html__('2 Columns', 'flone'),

    	        '3' => esc_html__('3 Columns', 'flone'),

    	    ),

    	    'default'  => '1',

    	),

    	array(

    	    'id'                    => 'enable_post_excerpt',

    	    'type'                  => 'button_set',

    	    'title'                 => esc_html__('Enable Post Excerpt', 'flone'),

    	    'options'               => array(

    	        '1'               => esc_html__('Yes', 'flone'),

    	        '0'                => esc_html__('No', 'flone'), 

    	     ), 

    	    'default'               => '1',

    	),

    	array(

    	    'id'       => 'excerpt_length',

    	    'type'     => 'text',

    	    'title'    => esc_html__('Blog Excerpt Length', 'flone'),

    	    'subtitle' => esc_html__('Define How many Words will show as a short description. -1 means it will show full post content.', 'flone'),

    	    'validate' => 'numeric',

    	    'default'  => '50',

    	    'required'              => array('enable_post_excerpt','equals','1'),

    	),

    	array(

    	    'id'       => 'readmore_text',

    	    'type'     => 'text',

    	    'title'    => esc_html__('Readmore Text', 'flone'),

    	    'default'  => esc_html__('Read More', 'flone'),

    	    'required' => array('show_readmore','equals','1'),

    	    'required'              => array('enable_post_excerpt','equals','1'),

    	),

    	array(

    	    'id'                    => 'show_categories',

    	    'type'                  => 'button_set',

    	    'title'                 => esc_html__('Show Categories', 'flone'),

    	    'options'               => array(

    	        '1'               => esc_html__('Yes', 'flone'),

    	        '0'                => esc_html__('No', 'flone'), 

    	     ), 

    	    'default'               => '1'

    	),

    	array(

    	    'id'                    => 'show_author',

    	    'type'                  => 'button_set',

    	    'title'                 => esc_html__('Show Author', 'flone'),

    	    'options'               => array(

    	        '1'               => esc_html__('Yes', 'flone'),

    	        '0'                => esc_html__('No', 'flone'), 

    	     ), 

    	    'default'               => '1'

    	),

    	array(

    	    'id'                    => 'show_date',

    	    'type'                  => 'button_set',

    	    'title'                 => esc_html__('Show Date', 'flone'),

    	    'options'               => array(

    	        '1'               => esc_html__('Yes', 'flone'),

    	        '0'                => esc_html__('No', 'flone'), 

    	     ), 

    	    'default'               => '1'

    	),

    )

));  



/**

* Single Post 

*/

Redux::setSection( $opt_name, array(

    'title'     => esc_html__('Blog Details Page', 'flone'),

    'id'        => 'flone_blog_page_settings',

    'icon'      => 'el el-website',

    'subsection'=> true,

    'fields'    => array( 

    	array(

    	    'id'       => 'single_blog_sidebar',

    	    'type'     => 'select',

    	    'title'    => esc_html__('Blog Sidebar Position', 'flone'), 

    	    'options'  => array(

    	        'left' => esc_html__('Sidebar Left', 'flone'),

    	        'right' => esc_html__('Sidebar Right', 'flone'),

    	        'none' => esc_html__('No Sidebar', 'flone'),

    	    ),

    	    'default'  => 'left',

    	),

    	array(

    	    'id'                    => 'single_show_author',

    	    'type'                  => 'button_set',

    	    'title'                 => esc_html__('Show Author', 'flone'),

    	    'options'               => array(

    	        '1'               => esc_html__('Yes', 'flone'),

    	        '0'                => esc_html__('No', 'flone'), 

    	     ), 

    	    'default'               => '1'

    	),

    	array(

    	    'id'                    => 'single_show_date',

    	    'type'                  => 'button_set',

    	    'title'                 => esc_html__('Show Date', 'flone'),

    	    'options'               => array(

    	        '1'               => esc_html__('Yes', 'flone'),

    	        '0'                => esc_html__('No', 'flone'), 

    	     ), 

    	    'default'               => '1'

    	),

    	array(

    	    'id'                    => 'single_show_categories',

    	    'type'                  => 'button_set',

    	    'title'                 => esc_html__('Show Categories', 'flone'),

    	    'options'               => array(

    	        '1'               => esc_html__('Yes', 'flone'),

    	        '0'                => esc_html__('No', 'flone'), 

    	     ), 

    	    'default'               => '1'

    	),

    	array(

    	    'id'                    => 'single_show_tags',

    	    'type'                  => 'button_set',

    	    'title'                 => esc_html__('Show Tags', 'flone'),

    	    'options'               => array(

    	        '1'               => esc_html__('Yes', 'flone'),

    	        '0'                => esc_html__('No', 'flone'), 

    	     ), 

    	    'default'               => '1'

    	),

    	array(

    	    'id'                    => 'single_show_social_share',

    	    'type'                  => 'button_set',

    	    'title'                 => esc_html__('Show Social Share', 'flone'),

    	    'options'               => array(

    	        '1'               => esc_html__('Yes', 'flone'),

    	        '0'                => esc_html__('No', 'flone'), 

    	     ), 

    	    'default'               => '0'

    	),

    )

));



//footer settings

Redux::setSection($opt_name, array(

    'title'   => esc_html__('Footer','flone'),

    'id'      => 'flone_footer_settings',

    'icon'    => 'el el-photo',

    'fields'  => array(

        array(

        	'id'                    => 'show_footer_widget_area',

        	'type'                  => 'button_set',

        	'title'                 => esc_html__('Show Footer Widgets Area', 'flone'),

        	'options'               => array(

        	    '1'               => esc_html__('Yes', 'flone'),

        	    '0'                => esc_html__('No', 'flone'), 

        	 ), 

        	'default'               => '1'

        ),

        array(

            'id'       => 'footer_style',

            'type'     => 'select',

            'title'    => esc_html__('Select Option', 'flone'), 

            'subtitle' => esc_html__('No validation can be done on this field type', 'flone'),

            'options'  => array(

                '1' => esc_html__('Footer Style 1', 'flone'),

                '2' => esc_html__('Footer Style 2', 'flone'),

                '3' => esc_html__('Footer Style 3', 'flone'),

            ),

            'default'  => '1',

            'required'              => array('show_footer_widget_area','equals','1'),

        ),

        array(

            'id'                        => 'footer_columns',

            'title'                     => esc_html__('Number of Footer Columns','flone'),

            'subtitle'                  => esc_html__( 'Controls the number of columns in the footer.', 'flone' ),

            'type'                      => 'button_set',

            'options'                   => array(

                '1'                     => esc_html__('One Column','flone'),

                '2'                     => esc_html__('Two Columns','flone'),

                '3'                     => esc_html__('Three Columns','flone'),

                '4'                     => esc_html__('Four Columns','flone'),

                '5'                     => esc_html__('Five Columns','flone'),

            ),

            'default'                   => '4',

            'required'                  => array('footer_style','equals', '2'),

        ),

        array(

            'id'                        => 'footer_column_1_class',

            'type'                      => 'text',

            'title'                     => esc_html__( 'Column 1 Class', 'flone' ),

            'subtitle'                  => esc_html__( 'Set the column class as per bootstrap grid.','flone' ),

            'desc'                      => esc_html__('Example: col-lg-3 col-xs-12', 'flone'),

            'default'					=> 'col-lg-3 col-sm-6 col-xs-12',

            'required'                  => array('footer_style','equals', '2'),

        ),

        array(

            'id'                        => 'footer_column_2_class',

            'type'                      => 'text',

            'title'                     => esc_html__( 'Column 2 Class', 'flone' ),

            'subtitle'                  => esc_html__( 'Set the column class as per bootstrap grid.','flone' ),

            'desc'                      => esc_html__('Example: col-lg-3 col-xs-12', 'flone'),

            'default'					=> 'col-lg-3 col-sm-6 col-xs-12',

            'required'                  => array('footer_style','equals', '2'),

        ),

        array(

            'id'                        => 'footer_column_3_class',

            'type'                      => 'text',

            'title'                     => esc_html__( 'Column 3 Class', 'flone' ),

            'subtitle'                  => esc_html__( 'Set the column class as per bootstrap grid.','flone' ),

            'desc'                      => esc_html__('Example: col-lg-3 col-xs-12', 'flone'),

            'default'					=> 'col-lg-3 col-sm-6 col-xs-12',

            'required'                  => array('footer_style','equals', '2'),

        ),

        array(

            'id'                        => 'footer_column_4_class',

            'type'                      => 'text',

            'title'                     => esc_html__( 'Column 4 Class', 'flone' ),

            'subtitle'                  => esc_html__( 'Set the column class as per bootstrap grid.','flone' ),

            'desc'                      => esc_html__('Example: col-lg-3 col-xs-12', 'flone'),

            'default'					=> 'col-lg-3 col-sm-6 col-xs-12',

            'required'                  => array('footer_style','equals', '2'),

        ),

        array(

            'id'                        => 'footer_column_5_class',

            'type'                      => 'text',

            'title'                     => esc_html__( 'Column 5 Class', 'flone' ),

            'subtitle'                  => esc_html__( 'Set the column class as per bootstrap grid.','flone' ),

            'desc'                      => esc_html__('Example: col-lg-3 col-xs-12', 'flone'),

            'required'                  => array('footer_style','equals', '2'),

        ),

        array(

            'id'                    => 'footer_logo',

            'type'                  => 'button_set',

            'title'                 => esc_html__('Enable Footer Logo', 'flone'),

            'options'               => array(

                '1'               => esc_html__('Yes', 'flone'),

                '0'                => esc_html__('No', 'flone'), 

             ), 

            'default'               => '1',

            'required'                  => array('footer_style','equals', '3'),

        ),

        array(

            'id'       => 'footer_text',

            'type'     => 'textarea',

            'title'    => esc_html__('Footer Text', 'flone'),

            'default'  => esc_html__('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim', 'flone'),

            'required'                  => array('footer_style','equals', '3'),

        ),

        array(

            'id'                    => 'enable_social_icons',

            'type'                  => 'button_set',

            'title'                 => esc_html__('Enable Social Icons', 'flone'),

            'options'               => array(

                '1'               => esc_html__('Yes', 'flone'),

                '0'                => esc_html__('No', 'flone'), 

             ), 

            'default'               => '1',

            'required'                  => array('footer_style','equals', '3'),

        ),

        array(

            'id'                    => 'enable_footer3_widget_area',

            'type'                  => 'button_set',

            'title'                 => esc_html__('Enable Widget Area', 'flone'),

            'description'           => esc_html__('Footer Widget 1 will be used for this area.', 'flone'),

            'options'               => array(

                '1'               => esc_html__('Yes', 'flone'),

                '0'                => esc_html__('No', 'flone'), 

             ), 

            'default'               => '0',

            'required'                  => array('footer_style','equals', '3'),

        ),

        array(

            'id'                        => 'footer_color',

            'title'                     => esc_html__('Footer Color','flone'),

            'type'                      => 'select',

            'options'                   => array(

                'black'                     => esc_html__('Black','flone'),

                'gray'                     	=> esc_html__('Gray','flone'),

                'custom'                    => esc_html__('Custom','flone'),

            ),

            'default'                   => 'Gray',

            'required'                  => array('show_footer_widget_area','equals', '1'),

        ),

        array(

            'id'          => 'footer_bg_color',

            'type'        => 'background',

            'title'       => esc_html__('Footer Bg Color', 'flone'),

            'subtitle'    => esc_html__('Choose your preferred background color for the footer widget area.', 'flone'),

            'background-repeat' => true,

            'background-attachment' => false,

            'background-image' => true,

            'background-size' => true,

            'background-position' => false,

            'required'              => array('footer_color','equals','custom'),

            'compiler' => array(

            	'.footer-area',

            	'.footer-area.flone-bg-gray',

            	'.footer-area.flone-bg-white',

            	'.footer-area.site-footer',

            ),

            'required'                  => array('show_footer_widget_area','equals', '1'),

        ),

        array(

            'id'          => 'footer_text_color',

            'type'        => 'color',

            'title'       => esc_html__('Footer Text Color', 'flone'),

            'subtitle'    => esc_html__('Choose your preferred text color for the footer widget area..', 'flone'),

            'compiler' => array(

            	'.footer-area',

            	'.footer-area p',

            	'.flone-bg-gray .footer-top p',

            	'.footer-widget .subscribe-style',

            	'.footer-widget .footer-title h2',

            	'.footer-widget .subscribe-form input',

            ),

            'required'                  => array('show_footer_widget_area','equals', '1'),

        ),

        array(

          'id'                    => 'footer_link_color',

          'type'                  => 'link_color',

          'title'                 => esc_html__('Footer Link Color', 'flone'),

          'compiler' => array(

          	'.footer-area a',

          	'.footer-area p a',

          	'.footer-area .footer-widget a',

          	'.footer-area .footer-widget.widget_nav_menu ul li a',

          	'.footer-widget .subscribe-form input[type="submit"]'

          ),

          'required'                  => array('show_footer_widget_area','equals', '1'),

        ),

        array(

            'id'                    => 'footer_icon_color',

            'type'                  => 'color',

            'title'                 => esc_html__('Footer Icon Color', 'flone'),

            'required'              => array('footer_style','equals', '3'),

        ),

        array(

            'id'                    => 'footer_icon_hover_color',

            'type'                  => 'color',

            'title'                 => esc_html__('Footer Icon Hover Color', 'flone'),

            'required'              => array('footer_style','equals', '3'),

        ),

    )

));





//footer copyright settings

Redux::setSection($opt_name, array(

    'title'   => esc_html__('Copyright','flone'),

    'id'      => 'flone_copyright_settings',

    'icon'    => 'el el-chevron-right',

    'subsection'	=> true,

    'fields'  => array(

    	array(

    	    'id'                    => 'show_copyright_area',

    	    'type'                  => 'button_set',

    	    'title'                 => esc_html__('Show Copyright Area', 'flone'),

    	    'options'               => array(

    	        '1'               => esc_html__('Yes', 'flone'),

    	        '0'                => esc_html__('No', 'flone'), 

    	     ), 

    	    'default'               => '1'

    	),

    	array(

    	    'id'                    => 'copyright_text',

    	    'type'                  => 'textarea',

    	    'title'                 => esc_html__('Copyright Text', 'flone'),

    	    'default'               => esc_html__('Copyright &copy; 2020 .All Rights Reserved.', 'flone'),

    	    'args'                  => array(

    	        'teeny'             => true,

    	        'textarea_rows'     => 5,

    	    )

    	),

    	array(

    	    'id'                    => 'copyright_padding',

    	    'type'                  => 'spacing',

    	    'title'                 => esc_html__('Copyright Area Padding', 'flone'),

    	    'subtitle'              => esc_html__('Padding of the copyright area', 'flone'),

    	    'mode'                  => 'padding',

    	    'units'                 => array('em','px'),

    	    'units_extended'        => false,

    	    'required'              => array('show_copyright_area','equals','1'),

    	),

    	array(

    	    'id'          => 'copyright_bg_color',

    	    'type'        => 'background',

    	    'title'       => esc_html__('Copyright Bg Color', 'flone'),

    	    'subtitle'    => esc_html__('Choose your preferred background color for the copyright area.', 'flone'),

    	    'background-repeat' => false,

    	    'background-attachment' => false,

    	    'background-image' => false,

    	    'background-size' => false,

    	    'background-position' => false,

    	    'required'              => array('show_copyright_area','equals','1'),

    	    'compiler' => array(

    	    	'.footer-bottom',

    	    ),

    	),

    	array(

    	    'id'          => 'copyright_text_color',

    	    'type'        => 'color',

    	    'title'       => esc_html__('Copyright Text Color', 'flone'),

    	    'subtitle'    => esc_html__('Choose your preferred text color for the copyright area.', 'flone'),

    	    'required'    => array('show_copyright_area','equals','1'),

    	    'compiler' => array(

    	    	'.footer-bottom .copyright',

    	    	'.footer-bottom .copyright-2',

    	    	'.footer-bottom .copyright p',

    	    	'.footer-bottom .copyright-2 p',

    	    ),

    	),

    	array(

    	  'id'                    => 'copyright_link_color',

    	  'type'                  => 'link_color',

    	  'title'                 => esc_html__('Copyright Area Link Color', 'flone'),

    	  'required'              => array('show_copyright_area','equals','1'),

    	  'compiler' 			  => array(

    	  	'.footer-bottom .copyright a',

    	  ),

    	),

    )

));   	







//404 error page

Redux::setSection( $opt_name, array(

    'id'        => 'flone_404_page_settings',  

    'title'     => esc_html__('404 Page', 'flone'),

    'icon'      => 'el el-eye-close',

    'fields'    => array(

    	 array(

    	    'id'                    => 'not_found_title',

    	    'type'                  => 'textarea',

    	    'title'                 => esc_html__('Title', 'flone'),

    	    'default'               => esc_html__('Oops! That page can\'t be found.', 'flone'),

    	),

    	 array(

    	     'id'                    => 'not_found_content',

    	     'type'                  => 'textarea',

    	     'title'                 => esc_html__('Description', 'flone'),

    	     'default'               => esc_html__('It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'flone'),

    	 ),

    	 array(

    	     'id'                    => 'not_found_show_search',

    	     'type'                  => 'button_set',

    	     'title'                 => esc_html__('Show Search form', 'flone'),

    	     'subtitle'              => esc_html__('Enable this if you want to show search form in the 404 page.', 'flone'),

    	     'options'               => array(

    	         '1'               => esc_html__('Yes', 'flone'),

    	         '0'                => esc_html__('No', 'flone'), 

    	      ), 

    	     'default'               => '1'

    	 ),

    )

));



// Social networks

Redux::setSection( $opt_name, array(

    'id'               => 'flone_social_network_settings',

    'title'            => esc_html__('Social Network', 'flone'),

    'icon'             => 'el el-share',      

    'fields'           => array( 

        array(

            'id'                    => 'social_icons',

            'type'                  => 'sortable',

            'title'                 => esc_html__('Social Icons', 'flone'),

            'subtitle'              => esc_html__('Enter social links to show the icons', 'flone'),

            'mode'                  => 'text',

            'label'                 => true,

            'options'               => array(        

                'facebook'          => '',

                'twitter'           => '',

                'instagram'         => '',

                'dribbble'          => '',

                'tumblr'            => '',

                'pinterest'         => '',

                'linkedin'          => '',

                'behance'           => '',

                'youtube'           => '',

                'vimeo'             => '',

                'rss'               => '',

        ),

        'default'                   => array(

            'facebook'              => 'https://www.facebook.com/',

            'twitter'               => 'https://twitter.com/',

            'instagram'             => 'https://instagram.com/',

            'dribbble'              => 'https://dribbble.com/',

            'tumblr'                => '',

            'pinterest'             => '',

            'linkedin'              => '',

            'behance'               => '',

            'youtube'               => '',

            'vimeo'                 => '',

            'rss'                   => '',

        ),

    ))

));





// WooCommerce Settings

Redux::setSection( $opt_name, array(

    'id'               => 'flone_woocommerce_settings',

    'title'            => esc_html__('WooCommerce', 'flone'),

    'icon'             => 'el el-braille',      

    'fields'           => array( 

        array(

            'id'       => 'shop_sidebar',

            'type'     => 'select',

            'title'    => esc_html__('Shop Sidebar Position', 'flone'), 

            'options'  => array(

                'left' => esc_html__('Sidebar Left', 'flone'),

                'right' => esc_html__('Sidebar Right', 'flone'),

                'none' => esc_html__('No Sidebar', 'flone'),

            ),

            'default'  => 'left',

        ),

        array(

            'id'           => 'shop_style',

            'type'         => 'button_set',

            'title'        => esc_html__('Shop Style', 'flone'),

            'options'      => array(

                '1'        => esc_html__('Style 1', 'flone'), 

                '2'        => esc_html__('Enable', 'flone'),

             ), 

            'default'               => 'default'

        ),

        array(

            'id'       => 'shop_style',

            'type'     => 'select',

            'title'    => esc_html__('Shop Style', 'flone'), 

            'options'  => array(

                '1' =>  esc_html__('Style 1', 'flone'), 

                '2' =>  esc_html__('Style 2', 'flone'), 

            ),

            'default'  => '1',

        ),

        array(

            'id'                    => 'shop_layout',

            'type'                  => 'button_set',

            'title'                 => esc_html__('Enable Full Width Shop', 'flone'),

            'options'               => array(

                'default'           => esc_html__('Default', 'flone'), 

                'full_width'        => esc_html__('Enable', 'flone'),

             ), 

            'default'               => 'default'

        ),

        array(

            'id'                    => 'quickview_control',

            'type'                  => 'button_set',

            'title'                 => esc_html__('Quick View', 'flone'),

            'options'               => array(

                '1'               => esc_html__('Yes', 'flone'),

                '0'                => esc_html__('No', 'flone'), 

             ), 

            'default'               => '1'

        ),

        array(

            'id'                    => 'shop_view',

            'type'                  => 'button_set',

            'title'                 => esc_html__('Shop View', 'flone'),

            'options'               => array(

                'grid'              => esc_html__('Grid', 'flone'),

                'list'              => esc_html__('List', 'flone'), 

             ), 

            'default'               => 'grid'

        ),

        array(

            'id'       => 'prod_per_page',

            'type'     => 'text',

            'title'    => esc_html__('Products Per Page', 'flone'),

            'subtitle' => esc_html__('Define how many products you want to show in shop page.', 'flone'),

            'validate' => 'numeric',

            'default'  => '9'

        ),

        array(

            'id'       => 'add_to_cart_text',

            'type'     => 'text',

            'title'    => esc_html__('Add To Cart Text', 'flone'),

            'default'  => esc_html__('Add To Cart', 'flone')

        ),

        array(

            'id'       => 'shop_columns',

            'type'     => 'select',

            'title'    => esc_html__('Shop Page Columns', 'flone'), 

            'subtitle' => esc_html__('Define how many products show in a row.', 'flone'),

            'options'  => array(

                '2' => esc_html__('2 Columns', 'flone'),

                '3' => esc_html__('3 Columns', 'flone'),

                '4' => esc_html__('4 Columns', 'flone'),

            ),

            'default'  => '3',

            'required'              => array('shop_view','equals','grid'),

        ),

        array(

            'id'       => 'shop_columns_mobile',

            'type'     => 'select',

            'title'    => esc_html__('Shop Page Columns In Mobile', 'flone'), 

            'options'  => array(

                '1' => esc_html__('1 Column', 'flone'),

                '2' => esc_html__('2 Columns', 'flone'),

            ),

            'default'  => '1',

            'required'              => array('shop_view','equals','grid'),

        )

	)

));



// WooCommerce Product Page Settings

Redux::setSection( $opt_name, array(

    'id'               => 'flone_product_page_settings',

    'title'            => esc_html__('Product Details Page', 'flone'),

    'icon'             => 'el el-chevron-right',    

    'subsection'	   => true,

    'fields'           => array(

    	array(

    	    'id'          => 'product_details_current_price_color',

    	    'type'        => 'color',

    	    'title'       => esc_html__('Current Price Color', 'flone'),

    	    'compiler' => array(

    	    	'.product .entry-summary .price .woocommerce-Price-amount.amount,.product .entry-summary .variations_form.cart .reset_variations',

    	    ),

    	),

    	array(

    	    'id'          => 'product_details_prev_price_color',

    	    'type'        => 'color',

    	    'title'       => esc_html__('Previous Price Color', 'flone'),

    	    'compiler' => array(

    	    	'.product .entry-summary .price del .woocommerce-Price-amount.amount',

    	    ),

    	),

    	array(

    	    'id'       => 'gallery_style',

    	    'type'     => 'select',

    	    'title'    => esc_html__('Gallery Style', 'flone'), 

    	    'options'  => array(

    	        '1' => esc_html__('Style 1', 'flone'),

    	        '2' => esc_html__('Style 2', 'flone'),

    	        '3' => esc_html__('Style 3', 'flone'),

    	        '4' => esc_html__('Style 4', 'flone'),

    	        '5' => esc_html__('Style 5', 'flone'),

    	        '6' => esc_html__('Style 6', 'flone'),

    	    ),

    	    'default'  => '1',

    	),

    	array(

    	    'id'       => 'gallery_thumbnail_size',

    	    'type'     => 'text',

    	    'title'    => esc_html__('Gallery Thumbnail Size', 'flone'),

    	    'subtitle' => esc_html__('Control The Gallery Thumbnail Size For Product Details Page. e.g: thumbnail / medium / large etc', 'flone'),

    	    'default'  => ''

    	),

    	array(

    	    'id'           => 'enable_image_zoom',

    	    'type'         => 'button_set',

    	    'title'        => esc_html__('Enable Image Zoom', 'flone'),

    	    'options'      => array(

    	        '1'        => esc_html__('Yes', 'flone'), 

    	        '0'        => esc_html__('No', 'flone'), 

    	     ), 

    	    'default'               => '1'

    	),

    	array(

    	    'id'           => 'single_prod_sharing',

    	    'type'         => 'button_set',

    	    'title'        => esc_html__('Show Sharing Buttons', 'flone'),

    	    'options'      => array(

    	        '1'        => esc_html__('Yes', 'flone'), 

    	        '0'        => esc_html__('No', 'flone'), 

    	     ), 

    	    'default'               => '0'

    	),

    	array(

    	    'id'       => 'related_prod_per_page',

    	    'type'     => 'text',

    	    'title'    => esc_html__('Related Products Per Page', 'flone'),

    	    'subtitle' => esc_html__('Define how many products you want to show in related products area.', 'flone'),

    	    'validate' => 'numeric',

    	    'default'  => '3'

    	),

    	array(

    	    'id'       => 'related_prod_columns',

    	    'type'     => 'select',

    	    'title'    => esc_html__('Related Product Columns', 'flone'), 

    	    'subtitle' => esc_html__('Define how many products show in a row.', 'flone'),

    	    'options'  => array(

    	        '2' => esc_html__('2 Column', 'flone'),

    	        '3' => esc_html__('3 Column', 'flone'),

    	        '4' => esc_html__('4 Column', 'flone'),

    	    ),

    	    'default'  => '3',

    	),

    	 array(

    	    'id'                    => 'related_products_text',

    	    'type'                  => 'text',

    	    'title'                 => esc_html__('Related Products Text', 'flone'),

    	    'default'               => esc_html__('Related products', 'flone'),

    	),

		array(

			'id'                    => 'enable_product_tabs_rename',

			'type'                  => 'switch',

			'title'                 => esc_html__( 'Enable Product Tabs Rename', 'flone' ),

			'default'               => '0',

		),

		array(

		    'id'           => 'enable_product_tabs_rename',

		    'type'         => 'button_set',

		    'title'        => esc_html__('Enable Product Tabs Rename', 'flone'),

		    'options'      => array(

		        '1'        => esc_html__('Yes', 'flone'), 

		        '0'        => esc_html__('No', 'flone'), 

		     ), 

		    'default'               => '0'

		),

		array(

			'id'                    => 'tab_additional_info_text',

			'type'                  => 'text',

			'title'                 => esc_html__('Tab: Additional Information Text', 'flone'),

			'required'              => array('enable_product_tabs_rename','equals', '1'),

		),

		array(

			'id'                    => 'tab_description_text',

			'type'                  => 'text',

			'title'                 => esc_html__('Tab: Description Text', 'flone'),

			'required'              => array('enable_product_tabs_rename','equals', '1'),

		),

		array(

			'id'                    => 'tab_reviews_text',

			'type'                  => 'text',

			'title'                 => esc_html__('Tab: Reviews Text', 'flone'),

			'required'              => array('enable_product_tabs_rename','equals', '1'),

		),

		array(

		    'id'           => 'enable_woo_tab_custom_ordering',

		    'type'         => 'button_set',

		    'title'        => esc_html__('Enable Product Tabs Custom Ordering', 'flone'),

		    'options'      => array(

		        '1'        => esc_html__('Yes', 'flone'), 

		        '0'        => esc_html__('No', 'flone'), 

		     ), 

		    'default'               => '0'

		),

		array(

			'id'      => 'woo_tab_custom_ordering',

		    'type'    => 'sorter',

		    'title'   => esc_html__('Tab Custom Ordering', 'flone'),

		    'desc'    => esc_html__('Organize how you want the tabs to appear on the product details page', 'flone'),

		    'options' => array(

		        'enabled'  => array(

		            'additional_information' => 'Additional Information',

		            'description'     => 'Description',

		            'reviews' => 'Reviews',

		        ),

		        'disabled' => array()



			),

			'required'              => array('enable_woo_tab_custom_ordering','equals', '1'),

		),

	)

));