<?php

//https://developer.wordpress.org/plugins/
//https://github.com/norcross/wp-comment-notes/blob/master/wp-comment-notes.php
//https://github.com/DevinVinson/WordPress-Plugin-Boilerplate/blob/master/plugin-name/includes/class-plugin-name.php
//https://codex.wordpress.org/Plugin_API/Action_Reference

class Complications_Moon_Shortcode {
	
	public function __construct() {
		$this->base = Complications_Moon_Base::getInstance();

		add_shortcode('themoon', array($this,'shortcode'));
	}

	/*	Registers the shortcode that can be used to create a block 
		[themoon key="$atts[key]"]$content[/themoon]
	*/
	public function shortcode($atts = [], $content = null) {
		$id = uniqid(random_int(1000,9999));

		$params = $this->base->parseParams($atts);

		return "<div id='complications_moon_".esc_attr($id)."' class='complications_moon_shortcode' width='".esc_attr($params['width'])."' color='".esc_attr($params['color'])."' hidearrow='".esc_attr($params['arrow'])."' style='".esc_attr($params['style'])."'>Moon Loading...</div>";
	}

	//https://developer.wordpress.org/reference/functions/wptexturize/
	//Prevents smart quotes
	//		add_filter( 'no_texturize_shortcodes', array( 'CoolClock_Shortcode', 'no_wptexturize') );
	// public static function no_wptexturize( $shortcodes )
	// {
	// 	$shortcodes[] = 'coolclock';
	// 	return $shortcodes;
	// }

}
