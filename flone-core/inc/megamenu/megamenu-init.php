<?php

class flone_Mega_Menu {

	function __construct() {
		// add custom menu fields to menu
		add_filter( 'wp_setup_nav_menu_item', array( $this, 'flone_add_custom_nav_fields' ) );
		// save menu custom fields
		add_action( 'wp_update_nav_menu_item', array( $this, 'flone_update_custom_nav_fields'), 10, 3 );
		// edit menu walker
		add_filter( 'wp_edit_nav_menu_walker', array( $this, 'flone_edit_walker'), 10, 2 );
	} // end constructor
	
	/**
	 * Add custom fields to $item nav object
	 * in order to be used in custom Walker
	 *
	 * @access      public
	 * @since       1.0 
	 * @return      void
	*/
	function flone_add_custom_nav_fields( $menu_item ) {
	    $menu_item->menuposition = get_post_meta( $menu_item->ID, '_menu_item_menuposition', true );
	    $menu_item->ficon = get_post_meta( $menu_item->ID, '_menu_item_ficon', true );
	    $menu_item->megamenu = get_post_meta( $menu_item->ID, '_menu_item_megamenu', true );
	    $menu_item->disablet = get_post_meta( $menu_item->ID, '_menu_item_disablet', true );
        $menu_item->shortcode = get_post_meta( $menu_item->ID, '_menu_item_shortcode', true );
	    $menu_item->menubackground = get_post_meta( $menu_item->ID, '_menu_item_background', true );
	    return $menu_item;
	}
	/**
	 * Save menu custom fields
	 *
	 * @access      public
	 * @since       1.0 
	 * @return      void
	*/
	function flone_update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {
	    // Check if element is properly sent
        
		
	    // Check if element is properly sent
        if( !isset( $_REQUEST['menu-item-menuposition'][$menu_item_db_id] ) ) {
           $_REQUEST['menu-item-menuposition'][$menu_item_db_id] = '';
        }
	        $ficon_value = $_REQUEST['menu-item-menuposition'][$menu_item_db_id];
	        update_post_meta( $menu_item_db_id, '_menu_item_menuposition', $ficon_value );
	    // Check if element is properly sent
        if( !isset( $_REQUEST['menu-item-ficon'][$menu_item_db_id] ) ) {
           $_REQUEST['menu-item-ficon'][$menu_item_db_id] = '';
        }
	        $ficon_value = $_REQUEST['menu-item-ficon'][$menu_item_db_id];
	        update_post_meta( $menu_item_db_id, '_menu_item_ficon', $ficon_value );
	  
	    // Check if element is properly sent
        if( !isset( $_REQUEST['menu-item-megamenu'][$menu_item_db_id] ) ) {
           $_REQUEST['menu-item-megamenu'][$menu_item_db_id] = '';
        }
        $megamenu_value = $_REQUEST['menu-item-megamenu'][$menu_item_db_id];
        update_post_meta( $menu_item_db_id, '_menu_item_megamenu', $megamenu_value );
   
	    // Check if element is properly sent
        if( !isset( $_REQUEST['menu-item-column'][$menu_item_db_id] ) ) {
           $_REQUEST['menu-item-column'][$menu_item_db_id] = '';
        }

	    // Check if element is properly sent
        if( !isset( $_REQUEST['menu-item-disablet'][$menu_item_db_id] ) ) {
           $_REQUEST['menu-item-disablet'][$menu_item_db_id] = '';
        }
        $disablet_value = $_REQUEST['menu-item-disablet'][$menu_item_db_id];
        update_post_meta( $menu_item_db_id, '_menu_item_disablet', $disablet_value );
   
        // Check if element is properly sent
        if( !isset( $_REQUEST['menu-item-shortcode'][$menu_item_db_id] ) ) {
           $_REQUEST['menu-item-shortcode'][$menu_item_db_id] = '';
        }
        $shortcode_value = $_REQUEST['menu-item-shortcode'][$menu_item_db_id];
        update_post_meta( $menu_item_db_id, '_menu_item_shortcode', $shortcode_value );
   
	    // Check if element is properly sent
        if( !isset( $_REQUEST['menu-item-background'][$menu_item_db_id] ) ) {
           $_REQUEST['menu-item-background'][$menu_item_db_id] = '';
        }
        $background_value = $_REQUEST['menu-item-background'][$menu_item_db_id];
        update_post_meta( $menu_item_db_id, '_menu_item_background', $background_value );
	}
	/**
	 * Define new Walker edit
	 *
	 * @access      public
	 * @since       1.0 
	 * @return      void
	*/
	function flone_edit_walker($walker,$menu_id) {
	    return 'flone_Walker_Nav_Menu_Edit';
	}
}

// instantiate plugin's class
$GLOBALS['flone_Mega_Menu'] = new flone_Mega_Menu();
require FLONE_CORE_DIR . '/inc/megamenu/backend-menu-walker.php';
require FLONE_CORE_DIR . '/inc/megamenu/frontend-menu-walker.php';