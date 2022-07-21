<?php
/**
 * Adds Recent post Widget.
 * @package flone
 */
if( !class_exists('Flone_Recent_Post') ){
	class Flone_Recent_Post extends WP_Widget{
		/**
		 * Register widget with WordPress.
		 */
		function __construct(){

			$widget_options = array(
				'description' 					=> esc_html__('Flone theme\'s custom widget', 'flone'), 
				'customize_selective_refresh' 	=> true,
			);

			parent:: __construct('Flone_Recent_Post', __( 'Recent Posts : Flone', 'flone'), $widget_options );

		}
		/**
		 * Front-end display of widget.
		 *
		 * @see WP_Widget::widget()
		 *
		 * @param array $args     Widget arguments.
		 * @param array $instance Saved values from database.
		 */
		public function widget($args, $instance){

			if ( ! isset( $args['widget_id'] ) ) {

			$args['widget_id'] = $this->id;

		}
		
		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts','flone' );
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$per_page = ( ! empty( $instance['per_page'] ) ) ? absint( $instance['per_page'] ) : 3;
		$count_words = ( ! empty( $instance['count_words'] ) ) ? absint( $instance['count_words'] ) : 6;

			echo wp_kses_post( $args['before_widget'] ); 

			if( $title ): 
			    echo wp_kses_post( $args['before_title'] );  
				echo esc_attr( $title );  
			 	echo wp_kses_post( $args['after_title'] ); 
			endif; 

			$argss = array(
				'post_type'      => 'post',
				'posts_per_page' => $per_page,
				'ignore_sticky_posts'	=> 	1
			);
			$argss['tax_query'] = array(
                array(
                    'taxonomy' => 'post_format',
                    'field' => 'slug',
                    'terms' => array('post-format-link','post-format-quote','post-format-gallery','post-format-audio','post-format-video'),
	                        'operator' => 'NOT IN',
                ),
			);
			$posts = new WP_Query($argss);


			?>
			<div class="sidebar-project-wrap mt-30">
				<?php while($posts->have_posts()) : $posts->the_post();  ?>
                <div class="single-sidebar-blog">
                	<?php if ( has_post_thumbnail() ): ?>
                    <div class="sidebar-blog-img">
                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'thumbnail' ); ?></a>
                    </div>
                    <?php endif ?>

                    <div class="sidebar-blog-content">
                        <span><?php echo get_the_category_list( $separator = '<span></span>', $parents = '', $post_id = false ); ?></span>
                        <h4><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words( get_the_title(), $count_words,' '); ?></a></h4>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>

			<?php echo wp_kses_post( $args['after_widget'] ); ?>
			<?php wp_reset_postdata();
		}


		/**
		 * Sanitize widget form values as they are saved.
		 *
		 * @see WP_Widget::update()
		 *
		 * @param array $new_instance Values just sent to be saved.
		 * @param array $old_instance Previously saved values from database.
		 *
		 * @return array Updated safe values to be saved.
		 */
		public function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = sanitize_text_field( $new_instance['title'] );
			$instance['per_page'] = (int) $new_instance['per_page'];
			$instance['count_words'] = (int) $new_instance['count_words'];

			return $instance;
	}

	 	/**
		 * Back-end widget form.
		 *
		 * @see WP_Widget::form()
		 *
		 * @param array $instance Previously saved values from database.
		 */

		public function form( $instance ) {
			$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
			$per_page    = isset( $instance['per_page'] ) ? absint( $instance['per_page'] ) : 4;
			$count_words    = isset( $instance['count_words'] ) ? absint( $instance['count_words'] ) : 6;
	?>
			<p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php echo esc_html__( 'Title:','flone' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
			
			
			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'per_page' )); ?>"><?php echo esc_html__( 'Posts to show:','flone' ); ?></label>
				<input class="tiny-text" id="<?php echo esc_attr(esc_attr($this->get_field_id( 'per_page' ))); ?>" name="<?php echo esc_attr($this->get_field_name( 'per_page' )); ?>" type="number" step="1" min="1" value="<?php echo esc_attr($per_page); ?>" size="3" />
			</p>

			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'count_words' )); ?>"><?php echo esc_html__( 'Words Count','flone' ); ?></label>
				<input class="tiny-text" id="<?php echo esc_attr(esc_attr($this->get_field_id( 'count_words' ))); ?>" name="<?php echo esc_attr($this->get_field_name( 'count_words' )); ?>" type="number" step="1" min="1" value="<?php echo esc_attr($count_words); ?>" size="3">
			</p>
	<?php
		}
	}
}



// Flone_Recent_Post
function Flone_Recent_Post(){
	register_widget('Flone_Recent_Post');
}
add_action('widgets_init','Flone_Recent_Post');