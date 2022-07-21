<?php

	$show_breadcrumb = flone_get_meta_otpion('show_breadcrumb', '1');


 if ((!is_single() && 'post' != get_post_type() && !is_shop()) || ('product' == get_post_type() && !is_shop())) {
   
	if( $show_breadcrumb):

?>

<div class="breadcrumb-area pt-35 pb-35 bg-gray-3">

    <div class="container">

        <div class="breadcrumb-content text-center">

            <?php
            		

				if(function_exists('is_woocommerce')){

		          if( is_woocommerce() ){



		           	woocommerce_breadcrumb();



		          } else {

		          	    
                        flone_breadcrumbs();



		          }

		         } else {

		         	

                  	flone_breadcrumbs();
                    

		         }

            ?>

        </div>

    </div>

</div>

<?php 
endif; 
}
else if (is_single() &&'product' != get_post_type())
{

?>


<div class="bg-banner bg-banner-blog">
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<h2 class="p-10 m-0"><?php echo get_the_title(); ?></h2>
			</div>
		</div>
	</div>
</div>

<?php

}
if( is_shop() )
{
	echo '<div class="bg-banner bg-banner-blog">
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<h2 class="p-10 m-0">Shop All Products</h2>
			</div>
		</div>
	</div>
</div>';
}

?>