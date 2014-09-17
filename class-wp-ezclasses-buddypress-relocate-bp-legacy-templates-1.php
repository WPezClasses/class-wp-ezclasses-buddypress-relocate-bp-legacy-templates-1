<?php
/** 
 * Tell BuddyPress you moved the bp-legacy templates and stuff elsewhere, in this case, into a dedicated plugin. 
 *
 * Better to manage your customizations in a plugin than to bake them into a theme. 
 *
 * The folder structure below reflects having a folder within your plugin buddypress/ and then within 
 * that:  bp-templates / bp-legacy / 
 * and from there buddypress/..., css/ and js/ can all be moved into your plugin. 
 * 
 * I maintained the bp-legacy folder structure to mitigate confusion, etc. That's what works for me. You might have other ideas (for the method: bp_get_template_part())
 *
 * PHP version 5.3
 *
 * LICENSE: TODO
 *
 * @package WPezClasses
 * @author Mark Simchock <mark.simchock@alchemyunited.com>
 * @since 0.5.0
 * @license TODO
 */
 
/**
 * == Change Log == 
 *
 */
 
/**
 * == TODOs ==
 *
 * TODO - buddypress-function.php?? Can that be moved too? Or can it only go in the theme? 
 * 
 */
 

// No WP? Die! Now!!
if (!defined('ABSPATH')) {
	header( 'HTTP/1.0 403 Forbidden' );
    die();
}
 

if (! class_exists('Class_WP_ezClasses_BuddyPress_Relocate_BP_Legacy_Templates_1') ) {
  class Class_WP_ezClasses_BuddyPress_Relocate_BP_Legacy_Templates_1 {
  
    protected $_str_plugin_dir_url;
    protected $_str_folder;
  
    public function __construct(){
	
	  $this->init_defaults();
     
      // move the css from bp plugin to this plugin
      add_action( 'bp_enqueue_scripts', array( $this, 'enqueue_styles'   ),20 );
   
      // tell bp to look for the theme templates in this plugin
      add_action( 'bp_init', array($this, 'bp_move_templates') );
	  
    }
	
	/**
	 * copy & paste this method into your plugin's class that extends this class
	 *
	 * I presume there's probably a better more natural / elegant way to do this, but for now it'll have to be a TODO
	 */
	public function init_defaults(){
	
	  $this->_str_plugin_dir_url = plugins_url() . '/' . basename( dirname(__FILE__) ) . '/';
	 
      $this->_str_folder = 'buddypress/bp-templates/bp-legacy';
	}
	
	
	/**
	 * copy & paste this method into your plugin's class that extends this class.
	 *
	 * Again, just do the copy / paste. I'll invest some additional time late. 
	 */
	public function bp_template_stack() {
      return dirname(__FILE__)  . '/' . $this->_str_folder . '/buddypress/';
    }
	
	
	// =======================================================================================================
  
    public function enqueue_styles(){
  
      // dequeue the default bp style
      wp_dequeue_style('bp-legacy-css');
	
	  /**
	   * re-enqueue - for now - our own local copy 
	   * note: we have to use a differnet name (e.g., bp-legacy-css2) , else WP / BP will just keep using what we dequeue'd still in the BP plugin itself. 
	   */
      wp_enqueue_style( 'bp-legacy-css2', $this->_str_plugin_dir_url . $this->_str_folder . '/css/buddypress.css', array(), '0.5.0', 'screen' );
    }
  	
   
    function bp_move_templates() {

      add_filter( 'bp_template_stack', array($this, 'bp_template_stack') );
    
	  // if viewing a member page, overload the template
      if ( bp_is_user() ){ 
        add_filter( 'bp_get_template_part', array($this,'bp_get_template_part'), 10, 3 );
	  }
    }
   
    function bp_get_template_part( $templates, $slug, $name ) {
	
	  // if( 'members/single/profile/profile-loop' != $slug ){
      return $templates;
     // }
     // return array( $slug . '.php' );
    }  
  
  }
}