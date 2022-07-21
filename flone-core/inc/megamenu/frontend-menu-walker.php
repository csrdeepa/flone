<?php

/**
 * Custom Walker
 *
 * @access      public
 * @since       1.0 
 * @return      void
*/

class flone_Nav_Walker extends Walker_Nav_Menu

{
  public $flone_Mega ='';
  public $megadiv ='';
  public $flone_CLM ='';
  public $flone_scode = '';
  public $flone_background = '';
  public $flone_menupos = '';

  public function start_lvl( &$output,  $depth = 0, $args = array() ) {
	$Mbg = $Mleft = '';
    $indent = str_repeat("\t", $depth);
    if( $depth === 0 &&  $this->flone_Mega == "yes" ){

      if( !empty( $this->flone_menupos ) ){
        $Mleft = 'style="left:'.$this->flone_menupos.'px" ';
      }

      if( !empty( $this->flone_background ) ){
        $Mbg = 'data-src="'.esc_url( $this->flone_background ).'" ';
      }

      $output .= $indent.'<ul class="mega-menu" '. $Mbg .'>';

    }else{
      if( $depth === 0 ){
        $output .= "\n$indent<ul class=\"sub-menu\">\n";
      }else{
        $output .= "\n$indent<ul class=\"sub-menu\">\n";
      }
    }
  }

  public function end_lvl( &$output, $depth = 0, $args = array() ) {
    $indent = str_repeat( "\t", $depth );
    if( $depth === 0 ){
      $output .= "\n$indent</ul>";
    }else{
      $output .= "\n$indent</ul>";
    }
  }

  function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
     global $wp_query;
     $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
    if( $item->megamenu == 'enabled' ){
      $this->flone_Mega = 'yes';
    }else{
      $this->flone_Mega = 'no';
    }

    // Background
    if( isset( $item->menubackground ) ){
      $this->flone_background = $item->menubackground;
    }else{
      $this->flone_background = '';
    }

    if($depth === 0 && $this->flone_Mega=='no'){
      $flone_cls = 'nocls';
    }else{
      $flone_cls = '';
    }

     $class_names = $value = '';
     $classes = empty( $item->classes ) ? array() : (array) $item->classes;
     $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
     $class_names = ' class="'. esc_attr( $class_names ).' '.$flone_cls . '"';
	 
    if($depth ==1){
     $output .= $indent . '<li' . $value . $class_names .'>';
   }else{
     $output .= $indent . '<li' . $value . $class_names .'>';
   }
     $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
     $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
     $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
     $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
     $prepend = '';
     $append = '';
     $description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';
    if(isset($item->menuposition)){
      $this->flone_menupos = $item->menuposition;
    }else{
      $this->flone_menupos ='';
    }
     $flone_sv = '';
     $flone_ico = '';
     $flone_fico = '';
     $flone_aspn = '';
     $flone_bspn = '';
     $flone_ttlc = '';  
     $flone_drop = '';
    if($item->ficon){
      $flone_ico = $item->ficon;
    }
	
     if($depth != 0)
     {
       $description = $append = $prepend = "";
       $flone_aspn ='<span>';
       $flone_bspn ='</span>';
     }
     if($item->disablet){
      $flone_sv=1;
     }
     if(isset($item->shortcode)){
        $fgh = $item->shortcode;
        $this->flone_scode = $item->shortcode;
     }
     if( $depth ==1 && $flone_sv!=1){
       $flone_ttlc='menu_title';
     }elseif( $depth ==1 && $flone_sv==1){
       $flone_ttlc='ttl-hd-cls';
     }
    if ( $args->has_children && $depth === 0){
      $flone_drop = '';
    }else{
      $flone_drop = '';
    }
      if(isset($flone_ico)){
        $flone_fico ='<i class="'.$flone_ico. '"></i>';
        if(empty($flone_ico)){
          $flone_fico = '';
        }
      }
      $item_output = $args->before;
      if($flone_sv!=1){
        $item_output .= '<a'. $attributes .' class="'.$flone_ttlc.'">';
        $item_output .= $flone_fico. $flone_aspn;
        $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
        $item_output .= $flone_bspn;
        $item_output .= $description.$args->link_after;
        $item_output .= ' '.$item->subtitle.$flone_drop.'</a>';
      }else{
       if(isset($item->shortcode) && !empty($fgh)){
          $item_output .= '<a'. $attributes .'>';
          $item_output .= $this->flone_scode;
          $item_output .= '</a>';
       }
      }
      $item_output .= $args->after;
      $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
  }

  public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
      $id_field = $this->db_fields['id'];
        if ( is_object( $args[0] ) ){
           $args[0]->has_children =  !empty ( $children_elements[ $element->$id_field ] ) ;
        }
        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
  }
}