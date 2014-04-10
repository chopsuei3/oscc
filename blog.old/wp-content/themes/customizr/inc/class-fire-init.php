<?php
/**
* Adds theme supports using WP functions, 
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
class TC_init {
    //image sizes properties
    public $tc_thumb;
    public $slider_full;
    public $slider;

    //Access any method or var of the class with classname::$instance -> var or method():
    static $instance;

    function __construct () {

        self::$instance =& $this;

        //Customizr default images sizes
        $this -> tc_thumb_size      = array('width' => 270 , 'height' => 250, 'crop' => true);
        $this -> slider_full_size   = array('width' => 99999 , 'height' => 500, 'crop' => true );
        $this -> slider_size        = array('width' => 1170 , 'height' => 500, 'crop' => true);

        add_action( 'after_setup_theme'                     , array( $this , 'tc_customizr_setup' ));
    }


    /**
     * Sets up theme defaults and registers the various WordPress features
     * 
     *
     * @package Customizr
     * @since Customizr 1.0
     */

    function tc_customizr_setup() {
      //record for debug
      tc__f('rec' , __FILE__ , __FUNCTION__, __CLASS__ );

      /* Set default content width for post images and media. */
      global $content_width;
      if( ! isset( $content_width ) )   { $content_width = 1170; }

      /*
       * Makes Customizr available for translation.
       * Translations can be added to the /lang/ directory.
       */
      load_theme_textdomain( 'customizr' , TC_BASE . 'lang' );

     /*
     * Customizr styles the visual editor to resemble the theme style,
     * Loads the editor-style specific (post formats and RTL), the active skin, the user style.css
     */
      $active_skin = TC_BASE_URL.'inc/css/'.tc__f( '__get_option' , 'tc_skin' );
      add_editor_style( array( TC_BASE_URL.'inc/admin/css/editor-style.css', $active_skin, get_stylesheet_uri() ) );

      /* Adds RSS feed links to <head> for posts and comments. */
      add_theme_support( 'automatic-feed-links' );

      /*  This theme supports nine post formats. */
      add_theme_support( 'post-formats' , array( 'aside' , 'gallery' , 'link' , 'image' , 'quote' , 'status' , 'video' , 'audio' , 'chat' ) );

      /* This theme uses wp_nav_menu() in one location. */
      register_nav_menu( 'main' , __( 'Main Menu' , 'customizr' ) );

      /* This theme uses a custom image size for featured images, displayed on "standard" posts. */
      add_theme_support( 'post-thumbnails' );
        //set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop

      //remove theme support => generates notice in admin @todo fix-it!
       /* remove_theme_support( 'custom-background' );
        remove_theme_support( 'custom-header' );*/

      //post thumbnails for featured pages and post lists (archive, search, ...)
      $tc_thumb_size = apply_filters( 'tc_thumb_size', $this -> tc_thumb_size  );
      add_image_size( 'tc-thumb' , $tc_thumb_size['width'] , $tc_thumb_size['height'], $tc_thumb_size['crop'] );

      //slider full width
      $slider_full_size = apply_filters( 'slider_full_size', $this -> slider_full_size  );
      add_image_size( 'slider-full' , $slider_full_size['width'] , $slider_full_size['height'], $slider_full_size['crop'] );

      //slider boxed
      $slider_size = apply_filters( 'slider_size', $this -> slider_size  );
      add_image_size( 'slider' , $slider_size['width'] , $slider_size['height'], $slider_size['crop'] );

      //post with no headers (filter this if needed)
      add_filter  ( 'post_type_with_no_headers'                 , array( $this , 'tc_post_type_with_no_headers' ));
      }



      /**
     * List of posts type with no headers
     *
     * @package Customizr
     * @since Customizr 3.0.10
     */
      function tc_post_type_with_no_headers() {
        return array( 'aside' , 'status' , 'link' , 'quote' );
      }


}//end of class
