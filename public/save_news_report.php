<?php

/**
* 
*/

class SaveNewsReport
{

	function __construct(){}

	public function process_report() {

		$news_report = $_POST;

		if(!empty($news_report) && !isset($news_report['post_ID']) && isset($news_report['post_type']) && $news_report['post_type'] == "news_report") {
			$temp = $news_report['post_author'];
			$news_report['post_title'] = 'News Report @ '.strftime('%Y-%m-%d', strtotime('today'));
			$news_report['post_status'] = 'draft';
			$news_report['comment_status'] = 'open';
			$news_report['ping_status'] = 'open';
			$news_report['post_type'] = 'news_report';
			$news_report['post_author'] = wp_get_current_user()->ID;
			$news_report['post_category'] = [$this->get_news_report_category()];
			$id = wp_insert_post($news_report);
			add_post_meta($id, 'fullname', $temp);
			add_post_meta($id, 'email', $news_report['email']);
			add_post_meta($id, 'location', $news_report['location']);
			add_post_meta($id, 'time', strftime('%H:%M:%S', strtotime('now')));

			// wp_redirect(home_url());
			// exit;
		}
	}


	public function update_post_type() {
		$post = $_POST;

		if(isset($post['post_type']) && 'news_report' != $post['post_type']) return;

		if(!empty($post) && isset($post['post_type']) && isset($post['action']) && $post['action'] == 'editpost' && isset($post['post_ID']) && 'news_report' == $post['post_type']) {
			remove_action('save_post', array($this, 'update_post_type'));

			wp_update_post(array('ID'=>$post['post_ID'], 'post_type' => 'post', 'post_category' => [$this->get_news_report_category()]));

			add_action('save_post', array($this, 'update_post_type'));
		}
	}

	private function get_news_report_category() {
		return get_categories(['name'=>'News Report'])[0]->term_id;
	}

}
