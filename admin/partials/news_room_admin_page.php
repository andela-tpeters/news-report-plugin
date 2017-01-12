<?php
	/**
	* 
	*/
?>

<div class='wrap'>
	<div>
		<h1><?= esc_html(get_admin_page_title()); ?></h1>
	</div>
	<div>
		<form action="options.php" method="post">
            <?php
            // output security fields for the registered setting "wporg_options"
            settings_fields('wporg_options');
            // output setting sections and their fields
            // (sections are registered for "wporg", each field is registered to a specific section)
            do_settings_sections('wporg');
            // output save settings button
            submit_button('Save Settings');
            ?>
        </form>
	</div>
</div>