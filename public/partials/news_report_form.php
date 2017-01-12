

<div>
	<form class="news_report_form" action="<?php //plugin_dir_url(dirname(__FILE__))."public/save_news_report.php" ?>" method="post">
	<input type="hidden" name="post_type" value="news_report">
		<div class="form-field">
			<input type="text" name="post_author" id="post_author" placeholder="First">
		</div>
		<div class="form-field">
			<input type="email" name="email" placeholder="Email">
		</div>
		<div class="form-field">
			<input type="text" name="location" placeholder="Location">
		</div>
		<div class="form-field">
			<textarea name="post_content" placeholder="Details"></textarea>
		</div>
		<div class="form-field">
			<button type="submit" class="btn btn-primary">Submit Report</button>
		</div>
	</form>
</div>