<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Flone_Blog_Post extends Widget_Base {

    public function get_name() {
        return 'flone_blog';
    }
    
    public function get_title() {
        return __( 'Blog Posts', 'flone' );
    }

    public function get_icon() {
        return 'eicon-posts-grid';
    }
    public function get_categories() {
        return [ 'flone' ];
    }

	public function flone_content_fields(){
		$this->start_controls_section(
		    'content_section_1',
		    [
		        'label' => __( 'Content', 'flone' ),
		    ]
		);

		// categories
		$this->add_control(
		    'categories',
		    [
		        'label' => __( 'Categories', 'flone' ),
		        'type' => Controls_Manager::SELECT2,
		        'label_block' => true,
		        'multiple' => true,
		        'options' => flone_get_taxonomies(),
		    ]
		);
		// lg_item
		$this->add_control(
		    'blog_layout',
		    [
		        'label' => __( 'Blog Layout', 'flone' ),
		        'type' => Controls_Manager::SELECT,
		        'default' => 'style1',
		        'options' => [
		            'style1'          => __('Style One','flone'),
		            'style2'          => __('Style Two','flone'),
		        ],
		    ]
		);

		// per_page
		$this->add_control(
			'per_page',
			[
				'label'   => __( 'Number Of Post To Display', 'flone' ),
				'description' => __('Specify number of posts that you want to show. Set 0 to get all posts ', 'flone'),
				'type'    => Controls_Manager::NUMBER,
				'default' => 3,
				'min'     => 0,
				'max'     => 100,
				'step'    => 1,
			]
		);

		// lg_item
		$this->add_control(
		    'lg_item',
		    [
		        'label' => __( 'Columns On Each Row', 'flone' ),
		        'type' => Controls_Manager::SELECT,
		        'default' => '3',
		        'options' => [
		            '2'          => __('2','flone'),
		            '3'          => __('3','flone'),
		            '4'          => __('4','flone'),
		        ],
		    ]
		);

		// image_size
		$this->add_group_control(
		    Group_Control_Image_Size::get_type(),
		    [
		        'name' => 'image_size',
		        'default' => 'large',
		        'separator' => 'none',
		    ]
		);

		// custom_order
		$this->add_control(
		    'custom_order',
		    [
		        'label' => __( 'Custom order', 'flone' ),
		        'type' => Controls_Manager::SWITCHER,
		        'return_value' => '1',
		        'default' => '0',
		    ]
		);

		// order_by
		$this->add_control(
		    'orderby',
		    [
		        'label' => __( 'Orderby', 'flone' ),
		        'type' => Controls_Manager::SELECT,
		        'default' => 'none',
		        'options' => [
		            'none'          => __('None','flone'),
		            'ID'            => __('ID','flone'),
		            'date'          => __('Date','flone'),
		            'name'          => __('Name','flone'),
		            'title'         => __('Title','flone'),
		            'comment_count' => __('Comment count','flone'),
		            'rand'          => __('Random','flone'),
		        ],
		        'condition' => [
		            'custom_order' => '1',
		        ]
		    ]
		);

		// order
		$this->add_control(
		    'order',
		    [
		        'label' => __( 'Order', 'flone' ),
		        'type' => Controls_Manager::SELECT,
		        'default' => 'DESC',
		        'options' => [
		            'DESC'  => __('Descending','flone'),
		            'ASC'   => __('Ascending','flone'),
		        ],
		        'condition' => [
		            'custom_order' => '1',
		        ]
		    ]
		);

		// show_category
		$this->add_control(
		    'show_category',
		    [
		        'label' => __('Show Category','flone'),
		        'type' =>Controls_Manager::SELECT,
		        'options' =>[
		            '1' =>	__('Show', 'flone'),
		            '0' =>	__('Hide', 'flone'),
		        ],
		        'default' => '1',
		    ]
		);
		// show_category
		$this->add_control(
		    'show_category_position',
		    [
		        'label' => __('Category Position','flone'),
		        'type' =>Controls_Manager::SELECT,
		        'options' =>[
		            'pos_left' =>	__('Left', 'flone'),
		            'pos_right' =>	__('Right', 'flone'),
		        ],
		        'default' => 'pos_left',
		        'condition'=>[
					'show_category' => '1',


		        ]
		    ]
		);
		// title_words_limit
		$this->add_control(
			'title_words_limit',
			[
				'label'   => __( 'Title Limit Words', 'flone' ),
				'description' => __('Limit words you want show as short title ', 'flone'),
				'type'    => Controls_Manager::NUMBER,
				'default' => 5,
				'min'     => 0,
				'max'     => 100,
				'step'    => 1,
			]
		);

		// show_author
		$this->add_control(
		    'show_author',
		    [
		        'label' => __('Show Author','flone'),
		        'type' =>Controls_Manager::SELECT,
		        'options' =>[
		            '1' =>	__('Show', 'flone'),
		            '0' =>	__('Hide', 'flone'),
		        ],
		        'default' => '1',
		    ]
		);
	    $this->add_control(
	        'read_more_btn_show_hide',
	        [
	            'label' => esc_html__( 'Read More Show/Hide', 'flone' ),
	            'type' => Controls_Manager::SWITCHER,
	            'return_value' => 'yes',
	            'default' => 'no',
	        ]
	    );            
	    $this->add_control(
	        'read_more_btn_txt',
	        [
	            'label' => __( 'Read More Button Text', 'flone' ),
	            'type' => Controls_Manager::TEXT,
	            'default' => 'Read More',
	            'title' => __( 'Enter button text', 'flone' ),
	            'condition' => [
	                'read_more_btn_show_hide' => 'yes',
	            ]
	        ]
	    );
		$this->end_controls_section(); // Content Fields End
	}


// style fields
public function flone_style_fields(){
	$this->start_controls_section(
	    'style_section_1',
	    [
	        'label' => __( 'Stying Options', 'flone' ),
	        'tab' => Controls_Manager::TAB_STYLE,
	    ]
	);


	// title_typography
	$this->add_group_control(
	    Group_Control_Typography::get_type(),
	    [
	        'name' => 'title_typography',
	        'label' => __( 'Title Typography', 'flone' ),
	        'scheme' => Scheme_Typography::TYPOGRAPHY_1,
	        'selector' => '
	        	{{WRAPPER}} .blog-wrap .blog-content-wrap .blog-content h3 a
	        '
	    ]
	);

	// title_color
	$this->add_control(
	    'title_color',
	    [
	        'label'     => __( 'Title Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .blog-wrap .blog-content-wrap .blog-content h3 a' => 'color: {{VALUE}};',
	        ],
	    ]
	);

	$this->add_control(
	    'title_color_hover',
	    [
	        'label'     => __( 'Title Hover Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .blog-wrap .blog-content-wrap .blog-content h3 a:hover' => 'color: {{VALUE}};',
	        ],

	    ]
	);
        $this->add_responsive_control(
        'title_margin',
        [
            'label' => __( 'Title Margin', 'flone' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors' => [
                '{{WRAPPER}} .blog-wrap .blog-content-wrap .blog-content h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
           'separator' => 'after',

        ]
    ); 
	// meta_info_typography
	$this->add_group_control(
	    Group_Control_Typography::get_type(),
	    [
	        'name' => 'meta_info_typography',
	        'label' => __( 'Meta Info Typography', 'flone' ),
	        'scheme' => Scheme_Typography::TYPOGRAPHY_1,
	        'selector' => '
	        	{{WRAPPER}} .blog-wrap .blog-content-wrap .blog-content span
	        '
	    ]
	);

	// meta_info_color
	$this->add_control(
	    'meta_info_color',
	    [
	        'label'     => __( 'Title Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .blog-wrap .blog-content-wrap .blog-content span' => 'color: {{VALUE}};',
	        ],
	        'separator' => 'after',
	    ]
	);

	// category_typography
	$this->add_group_control(
	    Group_Control_Typography::get_type(),
	    [
	        'name' => 'category_typography',
	        'label' => __( 'Category Typography', 'flone' ),
	        'scheme' => Scheme_Typography::TYPOGRAPHY_1,
	        'selector' => '
	        	{{WRAPPER}} .blog-wrap .blog-img span a,{{WRAPPER}} .blog-wrap .blog-content-wrap .blog-content span a
	        '
	    ]
	);

	// category_bg_color
	$this->add_control(
	    'category_bg_color',
	    [
	        'label'     => __( 'Category Bg Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .blog-wrap .blog-img span.purple' => 'background-color: {{VALUE}};',
	        ],
	    ]
	);

	// category_text_color
	$this->add_control(
	    'category_text_color',
	    [
	        'label'     => __( 'Category Text Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .blog-wrap .blog-img span a,{{WRAPPER}} .blog-wrap .blog-content-wrap .blog-content span a' => 'color: {{VALUE}};',
	        ],
	    ]
	);

	// category_even_bg_color
	$this->add_control(
	    'category_bg_color_2',
	    [
	        'label'     => __( 'Category Bg Color 2', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .blog-wrap .blog-img span.pink' => 'background-color: {{VALUE}};',
	        ],
	    ]
	);

	// category_even_text_color
	$this->add_control(
	    'category_text_color_2',
	    [
	        'label'     => __( 'Category Text Color 2', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .blog-wrap .blog-img span.pink a' => 'color: {{VALUE}};',
	        ],
	        'separator' => 'after',
	    ]
	);

        $this->add_responsive_control(
        'content_wrap_box_padding',
        [
            'label' => __( 'Content Wrap Box Padding', 'flone' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors' => [
                '{{WRAPPER}} .blog-wrap .blog-content-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],

        ]
    );
    $this->add_responsive_control(
        'content_box_padding',
        [
            'label' => __( 'Content Box Padding', 'flone' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors' => [
                '{{WRAPPER}} .blog-wrap .blog-content-wrap .blog-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],

        ]
    ); 
        $this->add_responsive_control(
        'content_box_margin',
        [
            'label' => __( 'Content Box Margin', 'flone' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors' => [
                '{{WRAPPER}} .blog-wrap .blog-content-wrap .blog-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],

        ]
    ); 
		$this->add_control(
		    'content_box_bg',
		    [
		        'label'     => __( 'Content Box BG', 'flone' ),
		        'type'      => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .blog-wrap .blog-content-wrap .blog-content' => 'background: {{VALUE}};'
		        ],
		        
		    ]
		);
        $this->add_control(
            'item_readmore_heading',
            [
                'label' => __( 'Read More Style', 'flone' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_control(
            'item_readmore_color',
            [
                'label' => __( 'Read More color', 'flone' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default' => '#333',
                'selectors' => [
                    '{{WRAPPER}} .flone_read-more a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'item_readmore_color_hover',
            [
                'label' => __( 'Read More Hover color', 'flone' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default' => '#333',
                'selectors' => [
                    '{{WRAPPER}} .flone_read-more a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .flone_read-more a:hover:before' => 'border-color: {{VALUE}};',
                ],
            ]
        );        
        $this->add_control(
            'item_readmore_color_bg',
            [
                'label' => __( 'Read More BG Color', 'flone' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default' => 'rgba(0,0,0,0.0)',
                'selectors' => [
                    '{{WRAPPER}} .flone_read-more a' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'readmoreypography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .flone_read-more a',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'border_readmore',
                'label' => __( 'Read More Border', 'flone' ),
                'selector' => '{{WRAPPER}} .flone_read-more a',
            ]
        ); 
        $this->add_responsive_control(
            'icon_margin',
            [
                'label' => __( 'Read More margin', 'flone' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .flone_read-more' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'read_more_padding',
            [
                'label' => __( 'Read More Padding', 'flone' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .flone_read-more a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'read_more_border_radius',
            [
                'label' => __( 'Read More Border Radius', 'flone' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .flone_read-more a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'border_readmore_bottom',
                'label' => __( 'Read More Border Bottom', 'flone' ),
                'selector' => '{{WRAPPER}} .flone_read-more a:before',
            ]
        ); 




	$this->end_controls_section(); // title style section
}

protected function _register_controls() {

	$this->flone_content_fields();
	$this->flone_style_fields();
}

protected function render( $instance = [] ) {

    $settings = $this->get_settings_for_display();
    $id = substr( $this->get_id_int(), 0, 3 );
	$blog_layout = $settings['blog_layout'];
	$read_more_btn_show_hide = $settings['read_more_btn_show_hide'];
	$btntext        = ! empty( $settings['read_more_btn_txt'] ) ? $settings['read_more_btn_txt'] : '';


    //post query
    $args = array();
    $args['post_type']		= 'post';
    $args['posts_per_page']	= $settings['per_page'] == 0 ? '-1' : $settings['per_page'];

    // Custom Order
    if( $settings['custom_order'] == '1' ){
        $args['orderby']		= $settings['orderby'];
        $args['order']			= $settings['order'];
    }

    if($settings['categories']){
    	$args['category_name']		= implode(',', $settings['categories']);
    }
    
    $posts_query = new \WP_Query($args);


    // columns support
    $lg_item    = $settings['lg_item'] ? floor(12 / $settings['lg_item']) : 3;

    $column_classes = array();
    $column_classes[] = 'col-xs-12';
    $column_classes[] = 'col-sm-6';
    $column_classes[] = 'col-md-6';
    $column_classes[] = 'col-lg-'. $lg_item;


    ob_start(); ?>

    <div class="row">

    <?php if($posts_query->have_posts()): ?>
    	<?php
    		$i = 0; while($posts_query->have_posts()): $posts_query->the_post(); $i++;
    		$image_size = $settings['image_size_size'] ? $settings['image_size_size'] : 'large';
    		?>

        <div class="<?php echo esc_attr( implode(' ', $column_classes ) ); ?>">
            
			<?php if( $blog_layout == 'style2' ){ ?>
            <div class="blog-wrap mb-30 scroll-zoom flone-blog-st2">

            	<?php if(has_post_thumbnail(  )): ?>
                <div class="blog-img">
                    <a href="<?php the_permalink() ?>">
                    	<?php the_post_thumbnail( $image_size ) ?>
                    </a>

                </div>
				<?php endif; ?>

                <div class="blog-content-wrap">
                    <div class="blog-content">

                    <?php if($settings['show_category']): ?>
                    <span class="<?php echo esc_attr( $settings['show_category_position']); echo esc_attr( $i % 2 == 0 ? ' pink' : ' purple' ); ?>"><?php the_category( ' , ' ) ?></span>
               		<?php endif; ?>
                        <h3><a href="<?php the_permalink( ) ?>"><?php echo wp_trim_words( get_the_title(), $settings['title_words_limit'], '' ); ?></a></h3>

                        <?php if( $settings['show_author'] ): ?>
                        <span><?php echo esc_html__( 'By', 'flone' ); ?> <?php echo get_the_author(); ?></span>
                    	<?php endif; ?>

                        <?php
                            if($read_more_btn_show_hide == 'yes'){ ?>
                            <div class="flone_read-more">
                                <a href="<?php the_permalink(); ?>" class="read-more"><?php if( !empty($btntext) ){echo esc_html__($btntext); }else{ flone_read_more(); }?></a>
                            </div>
                        <?php } ?>


                    </div>
                </div>
            </div>

        <?php }else{ ?>
		
            <div class="blog-wrap mb-30 scroll-zoom">

            	<?php if(has_post_thumbnail(  )): ?>
                <div class="blog-img">
                    <a href="<?php the_permalink() ?>">
                    	<?php the_post_thumbnail( $image_size ) ?>
                    </a>

                    <?php if($settings['show_category']): ?>
                    <span class="<?php echo esc_attr( $settings['show_category_position']); echo esc_attr( $i % 2 == 0 ? ' pink' : ' purple' ); ?>"><?php the_category( ' , ' ) ?></span>
               		<?php endif; ?>

                </div>
				<?php endif; ?>

                <div class="blog-content-wrap">
                    <div class="blog-content text-center">
                        <h3><a href="<?php the_permalink( ) ?>"><?php echo wp_trim_words( get_the_title(), $settings['title_words_limit'], '' ); ?></a></h3>

                        <?php if( $settings['show_author'] ): ?>
                        <span><?php echo esc_html__( 'By', 'flone' ); ?> <?php echo get_the_author(); ?></span>
                    	<?php endif; ?>
                        <?php
                            if($read_more_btn_show_hide == 'yes'){ ?>
                            <div class="flone_read-more">
                                <a href="<?php the_permalink(); ?>" class="read-more"><?php if( !empty($btntext) ){echo esc_html__($btntext); }else{ flone_read_more(); }?></a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>




		<?php } ?>

        </div>

        <?php endwhile; wp_reset_postdata(); ?>

        <?php else: ?>
        	<div class="col-md-12">
        		<p class="text-center"><?php echo esc_html__( 'No posts found!', 'flone' ); ?></p>
        	</div>
        <?php endif; //endif have posts ?>

    </div>

    <?php echo ob_get_clean();
}

} // end class

Plugin::instance()->widgets_manager->register_widget_type( new Flone_Blog_Post() );