<?php

function flone_language_selector(){
	echo do_shortcode('[gtranslate]');
}

if(!function_exists('flone_get_social_share_html')){
	function flone_get_social_share_html(){
		$post_title 	= get_the_title();
		$post_url	= get_permalink();
		$post_img	= wp_get_attachment_url( get_post_thumbnail_id() );

		$facebook_url 	= 'https://www.facebook.com/sharer/sharer.php?u=' . $post_url;
		$twitter_url	= 'http://twitter.com/intent/tweet?status=' . rawurlencode( $post_title ) . '+' . $post_url;
		$pinterest_url	= 'http://pinterest.com/pin/create/bookmarklet/?media=' . $post_img . '&url=' . $post_url . '&is_video=false&description=' . rawurlencode( $post_title );

		$social_share_html = '<div class="share-social">';
		$social_share_html .= '<ul>';
		$social_share_html .= '<li><a class="facebook" target="_blank" href="'. esc_url($facebook_url) .'"><i class="fab fa-facebook"></i></a></li>';
		$social_share_html .= '<li><a class="twitter" target="_blank" href="'. esc_url($twitter_url) .'"><i class="fab fa-twitter"></i></a></li>';
		$social_share_html .= '<li><a class="pinterest" target="_blank" href="'. esc_url($pinterest_url) .'"><i class="fab fa-pinterest"></i></a></li>';
		$social_share_html .= '</ul>';
		$social_share_html .= '</div>';

	    return $social_share_html;
	}
}