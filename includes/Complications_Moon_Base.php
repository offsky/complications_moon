<?php

//https://developer.wordpress.org/plugins/
//https://github.com/norcross/wp-comment-notes/blob/master/wp-comment-notes.php
//https://github.com/DevinVinson/WordPress-Plugin-Boilerplate/blob/master/plugin-name/includes/class-plugin-name.php
//https://codex.wordpress.org/Plugin_API/Action_Reference

class Complications_Moon_Base {
	static $instance = null;

	public function __construct() {
		add_action('wp_footer',array($this,'includeJS'),1);
	}

	public static function getInstance() {
		if(!self::$instance) self::$instance = new self;
		return self::$instance;
	}

	/* 	Activate the plugin
		Create any caches, DB tables or necessary options
	*/
	public function activate() { 
		$this->log("activate");
	}

	/* 	Deactivate the plugin
		Flush cache and temporary files. Flush permalinks
	*/
	public function deactivate() { 
		$this->log("deactivate");
	}

	/* 	Uninstall the plugin
		Remove any DB tables or options
	*/
	public function uninstall() { 
		$this->log("uninstall");
	}

	public function includeJS() {
		$path = plugins_url('/',__FILE__);
		$version = COMPLICATIONS_MOON_VERSION; 

		wp_enqueue_script('complications_moon_main', $path.'Complications_Moon.min.js', ['complications_moon_svg','complications_moon_astro'], $version, true);
		wp_enqueue_script('complications_moon_svg', $path.'vendor/svg.js-master/svg.min.js', false, null, false);
		wp_enqueue_script('complications_moon_astro', $path.'vendor/astronomy-master/source/js/astronomy.browser.min.js', false, null, false);
	}

	public function parseParams($arr) {
		// $this->log("parse ".json_encode($arr));

		//getting optional background color
		$color = "";
		if(isset($arr['color'])) {
			$color = sanitize_hex_color($arr['color']);
		}

		//getting optional max width
		$widthStyle = "";
		$width = "";
		if(isset($arr['maxwidth'])) {
			$width = intval($arr['maxwidth']);
			if(!is_nan($width) && $width>30) $widthStyle = "max-width:".$width."px;";
		}

		//getting optional hide arrow
		$hideArrow = 0;
		if(isset($arr['hidearrow']) && (intval($arr['hidearrow'])==1 || strtolower($instance['hidearrow'])=="true")) {
			$hideArrow = 1;
		}

		return array("color"=>$color,"width"=>$width,"style"=>$widthStyle,"arrow"=>$hideArrow);
	}

	public function log($txt) {
		$date = date('m/d/Y H:i:s');
		//file_put_contents(plugin_dir_path(__FILE__).'log.txt', $date." : ".$txt."\n", FILE_APPEND);
	}
}
