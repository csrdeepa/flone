<?php

/**
*
* Footer Logo widget.
*
**/

if ( !class_exists('flone_footer_logo_Widget') ) {
	class flone_footer_logo_Widget extends WP_Widget{

		function __construct(){

			$widget_options = array(
				'description' 					=> esc_html__('This widget show Footer Logo', 'flone'), 
				'customize_selective_refresh' 	=> true,
			);

			parent:: __construct('flone_footer_logo_Widget', esc_html__( 'Flone: Footer Logo', 'flone'), $widget_options );

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

			$image = isset( $instance['image'] ) ? $instance['image'] : '';
			$content = isset( $instance['content'] ) ? $instance['content'] : '';

			?>
			
	        <?php echo wp_kses_post( $args['before_widget'] ); ?>
	        	<div class="flone-footer-logo-box copyright mb-30 ">
					
	        		<?php if ( !empty($image) ): ?>
	        			<div class="footer-logo">
	        			<a href="<?php the_permalink(); ?>">
	        			<img src="<?php echo esc_url( $image ) ; ?>" alt="<?php echo esc_attr__('Image','flone'); ?>">
	        		</a><br>
	        		</div>
	        		<?php endif ?>  
					
		                <?php if ( !empty($content) ): ?>
		                	<?php echo wpautop( $content ); ?>
		                <?php endif ?>
	            </div>
	        <?php echo wp_kses_post( $args['after_widget'] ); ?>

		<?php }


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
		public function update($new_instance, $old_instance){
			$instace = array();
			$instance['image'] = ( !empty($new_instance['image']) ) ? strip_tags ( $new_instance['image'] ) : '';
			$instance['content'] = ( !empty($new_instance['content']) ) ? strip_tags ( $new_instance['content'] ) : '';



			if ( current_user_can( 'unfiltered_html' ) ) {
			        $instance['content'] = $new_instance['content'];
			} else {
			        $instance['content'] = wp_kses_post( $new_instance['content'] );
			}

			return $instance;
		}



		/**
		 * Back-end widget form.
		 *
		 * @see WP_Widget::form()
		 *
		 * @param array $instance Previously saved values from database.
		 */

		public function form($instance){ 
			
			$image = !empty( $instance['image'] ) ? $instance['image'] : ''; 
			$content = !empty( $instance['content'] ) ? $instance['content'] : ''; 			?>



			<div class="image_box_wrap" style="margin:20px 0 15px 0; width: 100%;">
				<button class="button button-primary author_info_image">
					<?php esc_html_e('Upload Image', 'flone'); ?>
				</button>
				<div class="image_box widefat">
					<img src="<?php if( !empty($image)){echo esc_html($image);} ?>" style="margin:15px 0 0 0;padding:0;max-width: 100%;display:inline-block; height: auto;" alt="<?php echo esc_attr__('Image','flone'); ?>" />
				</div>
				<input type="text" class="widefat image_link" name="<?php echo esc_attr($this->get_field_name('image')); ?>" id="<?php echo esc_attr($this->get_field_id('image')); ?>" value="<?php echo esc_attr($image); ?>" style="margin:15px 0 0 0;">
			</div>
	
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('content')); ?>"><?php echo esc_html__('Content:' ,'flone') ?></label>
				<textarea  id="<?php echo esc_attr($this->get_field_id('content')); ?>" name="<?php echo esc_attr($this->get_field_name('content')); ?>" rows="7" class="widefat" ><?php echo esc_textarea( $content ); ?></textarea>
			</p>

		<?php }


	} // end extends class
} // end exists class


// Register Footer Logo widget.

function flone_footer_logo_Widget() {
    register_widget( 'flone_footer_logo_Widget' );
}
add_action( 'widgets_init', 'flone_footer_logo_Widget' );