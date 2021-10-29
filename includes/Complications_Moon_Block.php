<?php

//https://developer.wordpress.org/block-editor/reference-guides/block-api/block-registration/

class Complications_Moon_Block {
	
	public function __construct() {
		$this->base = Complications_Moon_Base::getInstance();

		add_action('enqueue_block_editor_assets', array($this,'register'));
		add_action('enqueue_block_assets', array($this,'register'));

		// add_action('init',array($this,'init'));
	}

	public function init() {
		register_block_type(__DIR__."/..");
	}

	public function register() {
		$path = plugins_url('/',__FILE__);
		$version = COMPLICATIONS_MOON_VERSION; 

		wp_enqueue_script(
			'complications_moon_block',
			$path.'Complications_Moon_Block.min.js',
			array('wp-blocks', 'wp-element', 'wp-i18n', 'complications_moon_main'), // Dependencies, defined above.
			$version
	 	);

	 	wp_enqueue_script('complications_moon_main', $path.'Complications_Moon.min.js', ['complications_moon_svg','complications_moon_astro'], $version, true);
		wp_enqueue_script('complications_moon_svg', $path.'vendor/svg.js-master/svg.min.js', false, null, false);
		wp_enqueue_script('complications_moon_astro', $path.'vendor/astronomy-master/source/js/astronomy.browser.min.js', false, null, false);
	}
}
