<?php

	/**
	* 
	*/
	class NewsRoomPublic
	{
		protected $plugin_name;
		protected $version;
		
		function __construct($plugin_name, $version)
		{
			$this->plugin_name = $plugin_name;
			$this->version = $version;
		}

		public function load_styles() {
			$public_css = plugin_dir_url(__FILE__)."css/news_room_public.css";
			wp_enqueue_style($this->plugin_name, $public_css, array(), $this->version, 'all');
		}

		public function load_scripts() {
			$public_js = plugin_dir_url(__FILE__)."js/news_room_public.js";
			wp_enqueue_script($this->plugin_name, $public_js, array('jquery'), $this->version, true);
		}
	}