<?php
/**
* Header actions
*
* 
* @package      Customizr
* @subpackage   classes
* @since        3.0
* @author       Nicolas GUILLAUME <nicolas@themesandco.com>
* @copyright    Copyright (c) 2013, Nicolas GUILLAUME
* @link         http://themesandco.com/customizr
* @license      http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/

class TC_header_main {

    //Access any method or var of the class with classname::$instance -> var or method():
    static $instance;

    function __construct () {

        self::$instance =& $this;

        //html > head actions
        add_action ( '__before_body'			, array( $this , 'tc_head_display' ));
        add_action ( 'wp_head'     				, array( $this , 'tc_favicon_display' ));

        //html > header actions
        add_action ( '__before_main_wrapper'	, 'get_header');
        add_action ( '__header' 				, array( $this , 'tc_logo_title_display' ) , 10 );
        add_action ( '__header' 				, array( $this , 'tc_tagline_display' ) , 20, 1 );
        add_action ( '__header' 				, array( $this , 'tc_navbar_display' ) , 30 );

        //body > header > navbar actions ordered by priority
        add_action ( '__navbar' 				, array( $this , 'tc_social_in_header' ) , 10, 2 );
        add_action ( '__navbar' 				, array( $this , 'tc_tagline_display' ) , 20, 1 );
    }
	



    /**
	 * Displays what is inside the head html tag. Includes the wp_head() hook.
	 *
	 *
	 * @package Customizr
	 * @since Customizr 3.0
	 */
	function tc_head_display() {
		tc__f('rec' , __FILE__ , __FUNCTION__, __CLASS__ );
		?>
		<head>
		    <meta charset="<?php bloginfo( 'charset' ); ?>" />
		    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />
		    <title><?php wp_title( '|' , true, 'right' ); ?></title>
		    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		    <link rel="profile" href="http://gmpg.org/xfn/11" />
		    <?php
		      /* We add some JavaScript to pages with the comment form
		       * to support sites with threaded comments (when in use).
		       */
		      if ( is_singular() && get_option( 'thread_comments' ) )
		        wp_enqueue_script( 'comment-reply' );
		    ?>
		    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		   
		   <!-- Icons font support for IE6-7  -->
		    <!--[if lt IE 8]>
		      <script src="<?php echo TC_BASE_URL ?>inc/css/fonts/lte-ie7.js"></script>
		    <![endif]-->
		    <?php
		      /* Always have wp_head() just before the closing </head>
		       * tag of your theme, or you will break many plugins, which
		       * generally use this hook to add elements to <head> such
		       * as styles, scripts, and meta tags.
		       */
		      wp_head();
		    ?>
		    <!--Icons size hack for IE8 and less -->
		    <!--[if lt IE 9]>
		      <link href="<?php echo TC_BASE_URL ?>inc/css/fonts/ie8-hacks.css" rel="stylesheet" type="text/css"/>
		    <![endif]-->
		</head>
		<?php
	}




	 /**
      * Render favicon from options
      *
      * @package Customizr
      * @since Customizr 3.0 
     */
      function tc_favicon_display() {
      	tc__f('rec' , __FILE__ , __FUNCTION__, __CLASS__ );

        $url = esc_url( tc__f( '__get_option' , 'tc_fav_upload' ) );
        if( $url != null)   {
          $type = "image/x-icon";
          if(strpos( $url, '.png' )) $type = "image/png";
          if(strpos( $url, '.gif' )) $type = "image/gif";
        
          $html = '<link rel="shortcut icon" href="'.$url.'" type="'.$type.'">';
        
        echo apply_filters( 'tc_favicon_display', $html );
        }

      }




      /**
	 * The template for displaying the logo (text or img)
	 *
	 *
	 * @package Customizr
	 * @since Customizr 3.0
	 */
	function tc_logo_title_display() {
		tc__f('rec' , __FILE__ , __FUNCTION__, __CLASS__ );
       	$logo_src    			= esc_url ( tc__f( '__get_option' , 'tc_logo_upload') ) ;
       	$logo_resize 			= esc_attr( tc__f( '__get_option' , 'tc_logo_resize') );
      	$accepted_formats		= array('jpg', 'jpeg', 'png' ,'gif');
       	$filetype 				= wp_check_filetype ($logo_src);

		?>

		<?php if( !empty($logo_src) && in_array( $filetype['ext'], $accepted_formats ) ) :?>
			
			<?php
			//filter args
	   		$filter_args 		= array( 
		       		'logo_src' 			=>		$logo_src, 
		       		'logo_resize' 		=>		$logo_resize 
	   		);
			ob_start();

			$width = '';
			$height = '';
			//get height and width from image, we check if getimagesize can be used first with the error control operator
			if ( @getimagesize($logo_src) ) {
				list( $width, $height ) = getimagesize($logo_src);
			}
			?>

		        <div class="brand span3">

		        	<?php do_action( '__before_logo' ) ?>

		          	<?php tc__f( 'tip' , __FUNCTION__ , __CLASS__, __FILE__ ); ?>

		          	<?php 
			          	printf( '<a class="site-logo" href="%1$s" title="%2$s | %3$s"><img src="%4$s" alt="%5$s" width="%6$s" height="%7$s" %8$s /></a>',
			          		esc_url( home_url( '/' ) ),
			          		esc_attr( get_bloginfo( 'name') ),
			          		esc_attr( get_bloginfo( 'description' ) ),
			          		$logo_src,	
			          		__( 'Back Home' , 'customizr' ),
							$width,
							$height,
							( 1 == $logo_resize) ? sprintf( 'style="max-width:%1$spx;max-height:%2$spx"',
													apply_filters( '__max_logo_width', 250 ),
													apply_filters( '__max_logo_height', 100 )
													) : ''
			          	); 
		          	?>

		           	<?php do_action( '__after_logo' ) ?>

		        </div> <!-- brand span3 -->

	        <?php 
		   	$html = ob_get_contents();
	       	ob_end_clean();
	       	echo apply_filters( 'tc_logo_img_display', $html, $filter_args );
	       	?>

	    
	    <?php else : ?>

	    	<?php ob_start(); ?>

		        <div class="brand span3 pull-left">

		        	<?php do_action( '__before_logo' ) ?>

		          	<?php tc__f( 'tip' , __FUNCTION__ , __CLASS__, __FILE__ ); ?>
		            
		            <?php
			          	printf('<h1><a class="site-title" href="%1$s" title="%2$s | %3$s">%4$s</a></h1>',
			          		esc_url( home_url( '/' ) ),
			          		esc_attr( get_bloginfo( 'name') ),
			          		esc_attr( get_bloginfo( 'description' ) ),
			          		esc_attr( get_bloginfo( 'name') )
			          	); 
		          	?>

		             <?php do_action( '__after_logo' ) ?>

		        </div> <!-- brand span3 pull-left -->

	        <?php 
		   	$html = ob_get_contents();
	       	ob_end_clean();
	       	echo apply_filters( 'tc_logo_text_display', $html);
	       	?>

	   <?php endif; ?>

	   
	   <?php 
	}


	
	/**
	 * Displays what's inside the navbar of the website. Uses the resp parameter for __navbar action.
	 *
	 *
	 * @package Customizr
	 * @since Customizr 3.0.10
	 */
	function tc_navbar_display() {
		tc__f('rec' , __FILE__ , __FUNCTION__, __CLASS__ );
		ob_start();

		?>
		<?php do_action( 'before_navbar' ); ?>

	      	<div class="navbar-wrapper clearfix span9">

          		<div class="navbar notresp row-fluid pull-left">
          			<div class="navbar-inner" role="navigation">
          				<?php tc__f( 'tip' , __FUNCTION__ , __CLASS__, __FILE__ ); ?>
          				<div class="row-fluid">
	            			<?php 
	            				do_action( '__navbar' ); //hook of social, tagline, menu, ordered by priorities 10, 20, 30 
	            			?>
	            		</div><!-- .row-fluid -->
	            	</div><!-- /.navbar-inner -->
	            </div><!-- /.navbar notresp -->

	            <div class="navbar resp">
	            	<div class="navbar-inner" role="navigation">
	            		<?php 
	            			do_action( '__navbar' , 'resp' ); //hook of social, menu, ordered by priorities 10, 20 
	            		?>
	            	</div><!-- /.navbar-inner -->
          		</div><!-- /.navbar resp -->

        	</div><!-- /.navbar-wrapper -->

        	<?php do_action( '__after_navbar' ); ?>
		<?php

		$html = ob_get_contents();
       	ob_end_clean();
       	echo apply_filters( 'tc_navbar_display', $html );
	}


	


	/**
	 * Displays the social networks block in the header
	 *
	 *
	 * @package Customizr
	 * @since Customizr 3.0.10
	 */
    function tc_social_in_header($resp = null) {
      	tc__f('rec' , __FILE__ , __FUNCTION__, __CLASS__ );

        ob_start();

        //class added if not resp
        $class 		=  ('resp' == $resp) ? '':'span5' 
        ?>

        	<div class="social-block <?php echo $class ?>">
        		<?php if ( 0 != tc__f( '__get_option', 'tc_social_in_header') ) : ?>
	        		<?php tc__f( 'tip' , __FUNCTION__ , __CLASS__, __FILE__ ); ?>
	           		<?php echo tc__f( '__get_socials' ) ?>
	           	<?php endif; ?>
        	</div><!--.social-block-->

        <?php
        $html = ob_get_contents();
        ob_end_clean();
        echo apply_filters( 'tc_social_in_header', $html, $resp );
    }





	/**
	 * Displays the tagline. This function has two hooks : __header and __navbar
	 *
	 *
	 * @package Customizr
	 * @since Customizr 3.0
	 */
	function tc_tagline_display() {
		tc__f('rec' , __FILE__ , __FUNCTION__, __CLASS__ );
		ob_start();
		?>
			<?php if ( '__header' == current_filter() ) : //when hooked on  __header?>
				<div class="container outside">
			        <h2 class="site-description">
			        	 <?php tc__f( 'tip' , __FUNCTION__ , __CLASS__, __FILE__ ); ?>
			        	 <?php bloginfo( 'description' ); ?>
			        </h2>
			    </div>
			<?php else : //when hooked on __navbar?>
				<h2 class="span7 inside site-description">
					<?php tc__f( 'tip' , __FUNCTION__ , __CLASS__, __FILE__ ); ?>
                      <?php bloginfo( 'description' ); ?>
                </h2>

			<?php endif; ?>

		<?php
		$html = ob_get_contents();
        ob_end_clean();
        echo apply_filters( 'tc_tagline_display', $html );
	}


}//end of class