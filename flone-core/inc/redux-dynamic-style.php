<?php

// generate dynamic style
add_filter('redux/options/flone_opt/compiler', 'flone_compiler_action', 10, 3);
function flone_compiler_action($options, $css, $changed_values) {
    global $wp_filesystem;
 
 	$filename = '';
 	if(function_exists('wp_get_upload_dir')){
 		$filename = wp_get_upload_dir()['basedir'] . '/flone-dynamic-style.css';
 	}
    
 
    if( empty( $wp_filesystem ) ) {
        require_once( ABSPATH .'/wp-admin/includes/file.php' );
        WP_Filesystem();
    }
 
    if( $wp_filesystem ) {
        $wp_filesystem->put_contents(
            $filename,
            $css,
            FS_CHMOD_FILE // predefined mode settings for WP files
        );
    }
}

// enqueue theme option dynamic styels
add_action('wp_enqueue_scripts', 'flone_dynamic_style_enqueue', 15);
function flone_dynamic_style_enqueue(){
	global $wp_filesystem;

	if( empty( $wp_filesystem ) ) {
		require_once(ABSPATH . 'wp-admin/includes/file.php');
	}

	$filepath = '';
	if(function_exists('wp_get_upload_dir')){
		$filepath = wp_get_upload_dir()['basedir'] . '/flone-dynamic-style.css';
	}
	
	if(function_exists('WP_Filesystem') && function_exists('wp_get_upload_dir')){
		if ( ! WP_Filesystem() ) {
			$url = wp_nonce_url();
			request_filesystem_credentials($url, '', true, false, null);
		}
		
		$file_url = wp_get_upload_dir()['baseurl'] . '/flone-dynamic-style.css';
		if($wp_filesystem->exists($filepath)){
			wp_enqueue_style( 'flone-dynamic-style', $file_url , array('flone-style'), '1.0.0' );
		}
	}
}