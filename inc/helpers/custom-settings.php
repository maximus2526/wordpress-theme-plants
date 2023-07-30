<?php
//add new menu for theme-options page with page callback theme-options-page.

add_theme_page("Theme Customization", "Theme Customization", "manage_options", "theme-options", "theme_option_page", null, 99);

//this function creates a simple page with title Custom Theme Options Page.
function theme_option_page()
{
	?>
	<div class="wrap">
		<h1>Custom Theme Options Page</h1>
		<form method="post" action="options.php">
			<?php
			?>
		</form>
	</div>
	<?php
}