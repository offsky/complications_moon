<?php

//https://codex.wordpress.org/Plugin_API/Action_Reference

class Complications_Moon_Widget extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
			'classname' => 'complications_moon_class',
			'description' => 'Display information about the current state of The Moon.'
		);

		parent::__construct('complications_moon_widget','The Moon',$widget_ops); //Can also pass in options
		$this->base = Complications_Moon_Base::getInstance();

		add_action('widgets_init', array($this,'register'));
	}

	public function register() {
		register_widget("Complications_Moon_Widget");
	}

	public function widget($args,$instance) {
		$id = uniqid(random_int(1000,9999));

		$params = $this->base->parseParams($instance);

		echo "<div id='complications_moon_".esc_attr($id)."' class='complications_moon_widget' width='".esc_attr($params['width'])."' color='".esc_attr($params['color'])."' hidearrow='".esc_attr($params['arrow'])."' style='".esc_attr($params['style'])."'>Moon Loading...</div>";
	}

	public function form($instance) {
		$defaults = array('color' => '#fff','width' => '', 'hidearrow'=>0, 'colortransparent'=>1);
		$instance = wp_parse_args((array)$instance, $defaults);
		

		echo '<p><label for="'.$this->get_field_id('color').'">Background Color</label><br>';
		echo '<input id="'.$this->get_field_id('color').'" name="'.$this->get_field_name('color').'" type="color" value="'.esc_attr($instance['color']).'" />';
	
		if(!empty($instance['colortransparent'])) {
			echo ' or <input id="'.$this->get_field_id('colortransparent').'" name="'.$this->get_field_name('colortransparent').'" type="checkbox" value="1" checked="checked" />';
		} else {
			echo ' or <input id="'.$this->get_field_id('colortransparent').'" name="'.$this->get_field_name('colortransparent').'" type="checkbox" value="1" />';
		}
		
		echo '<label for="'.$this->get_field_id('colortransparent').'">Transparent</label></p>';

		echo '<p><label for="'.$this->get_field_id('maxwidth').'">Maximum Width (pixels)</label><br>';
		echo '<input id="'.$this->get_field_id('maxwidth').'" name="'.$this->get_field_name('maxwidth').'" type="number" value="'.esc_attr($instance['maxwidth']).'" /></p>';

		echo '<p><label for="'.$this->get_field_id('hidearrow').'">Terminator Arrow</label><br>';
		echo '<select id="'.$this->get_field_id('hidearrow').'" name="'.$this->get_field_name('hidearrow').'">';

		echo '<option value="0" '.selected(!$instance['hidearrow'],true,false).'>Show Arrow</option>';
		echo '<option value="1" '.selected($instance['hidearrow'],true,false).'>Hide Arrow</option>';

		echo '</select></p>';
	}

	public function update($new_instance, $old_instance) {
		if(!empty($new_instance['colortransparent'])) $new_instance['color'] = "";
		else $new_instance['colortransparent']=0;

		return $new_instance;
	}
}