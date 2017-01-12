<?php
	/**
	* 
	*/
	class NewsRoomShortcodes
	{
		
		function __construct(){}

		public function report_form() {
			include_once plugin_dir_path(__FILE__)."partials/news_report_form.php";
		}

		public function load_shortcodes() {
			add_shortcode('news_room_report_form', array($this,'report_form'));
		}
	}