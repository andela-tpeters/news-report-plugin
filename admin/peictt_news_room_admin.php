<?php 
	/**
	* 
	*/
	class NewsRoomAdmin
	{
		private $plugin_name;
		private $version;
		
		function __construct($plugin_name, $version)
		{
			$this->plugin_name = $plugin_name;
			$this->version = $version;
		}


		public function load_styles() {
			$skeleton = plugin_dir_url(__FILE__)."css/skeleton.css";
			$admin_css = plugin_dir_url(__FILE__)."css/news_room_admin.css";
			wp_enqueue_style($this->plugin_name, $admin_css, array($skeleton), $this->version, 'all');
		}

		public function load_scripts() {
			$admin_js = plugin_dir_url(__FILE__)."js/news_room_admin.js";
			wp_enqueue_script($this->plugin_name, $admin_js, array('jquery'), $this->version, true);
		}


		public function add_menu() {
			add_menu_page('News Room Admin', "News Room", 'manage_options', $this->plugin_name, array($this, 'display_admin_page'));
		}

		public function add_action_links($links) {
			$settings_link = array(
				'<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">' . __('Settings', $this->plugin_name) . '</a>',
				);
			return array_merge($settings_link, $links);
		}

		public function display_admin_page() {
			include_once('partials/news_room_admin_page.php');
		}

		public function add_post_type() {
			register_post_type('news_report', array(
					'labels'=> array(
							'name' 				=> __('News Reports'),
							'singular_name' 	=> __('News Report'),
							'add_new' 			=> __("New Report"),
							'add_new_item' 		=> __("Add News Report"),
							'edit_item'			=> __("Edit News Report"),
							'new_item'			=> __("New Report"),
							'view_item'			=> __('View Report'),
							'view_items'		=> __('View Reports'),
							'search_items'		=> __('Search Reports'),
							'not_found'			=> __('No news reports found'),
							'not_found_in_trach'=> __('No news reports found in trash'),
							'all_items'			=> __('All News Reports'),
							'archives'			=> __('News Reports Archive'),
							'attributes'		=> __('News Reports attributes')
						),
					'supports'			=> array('title', 'editor', 'post-formats', 'revisions', 'comments', 'page-attributes', 'custom-fields', 'taxonomies'),
					'description' => "This is for handling all the news reports made by users from the frontend",
					'public' => true,
					'has_archive' => true,
					'rewrite' => array('slug','news_report'),
					'menu_position' => 5,
					'taxonomies' => [5]
				));
		}

		public function add_news_room_category() {
			wp_create_category("News Report");
		}
	}