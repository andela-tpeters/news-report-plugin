<?php

	/**
	* 
	*/
	class NewsRoom
	{

		protected $plugin_name;
		protected $version;
		protected $loader;

		
		function __construct()
		{
			$this->plugin_name = "news_room";
			$this->version = '1.0.0';

			$this->load_dependencies();
			$this->load_admin_hooks();
			$this->load_public_hooks();
		}


		private function load_dependencies() {
			$dir = plugin_dir_path(dirname(__FILE__));
			require_once $dir.'admin/peictt_news_room_admin.php';
			require_once $dir.'public/peictt_news_room_public.php';
			require_once $dir.'includes/class-news-room-loader.php';
			require_once $dir."public/news_room_shortcodes.php";
			require_once $dir."public/save_news_report.php";

			$this->loader = new NewsRoomLoader();
		}


		private function load_admin_hooks() {
			$admin = new NewsRoomAdmin($this->get_plugin_name(), $this->get_version());

			$this->loader->add_action('admin_enqueue_scripts', $admin, 'load_styles');
			$this->loader->add_action('admin_enqueue_scripts', $admin, 'load_scripts');

			$this->loader->add_action('init', $admin, 'add_post_type');
			$this->loader->add_action('save_post', new SaveNewsReport(), 'update_post_type');

			$this->loader->add_action('init', $admin, 'add_news_room_category');
		}

		public function load_public_hooks() {
			$public = new NewsRoomPublic($this->get_plugin_name(), $this->get_version());

			$this->loader->add_action('wp_enqueue_scripts', $public, 'load_styles');
			$this->loader->add_action('wp_enqueue_scripts', $public, 'load_scripts');
			$this->loader->add_action('init', new SaveNewsReport(), 'process_report');
			$this->loader->add_action('init', new NewsRoomShortcodes(), 'load_shortcodes');
		}

		public function get_plugin_name() {
			return $this->plugin_name;
		}

		public function get_version() {
			return $this->version;
		}

		public function get_loader() {
			return $this->loader;
		}

		public function run() {
			$this->loader->run();
		}
	}