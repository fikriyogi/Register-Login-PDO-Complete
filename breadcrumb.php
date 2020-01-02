<div id="ribbon">

	<span class="ribbon-button-alignment"> 
		<span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true">
			<i class="fa fa-refresh"></i>
		</span> 
	</span>

	<!-- breadcrumb -->
	<?php 
	// This function will take $_SERVER['REQUEST_URI'] and build a breadcrumb based on the user's current path
	function breadcrumbs($separator = ' &raquo; ', $home = 'Home') {
	    // This gets the REQUEST_URI (/path/to/file.php), splits the string (using '/') into an array, and then filters out any empty values
	    $path = array_filter(explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)));

	    // This will build our "base URL" ... Also accounts for HTTPS :)
	    @$base = ($_SERVER['HTTPS'] ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';

	    // Initialize a temporary array with our breadcrumbs. (starting with our home page, which I'm assuming will be the base URL)
	    $breadcrumbs = Array("<a href=\"$base\">$home</a>");

	    // Find out the index for the last value in our path array
	    @$last = end(array_keys($path));

	    // Build the rest of the breadcrumbs
	    foreach ($path AS $x => $crumb) {
	        // Our "title" is the text that will be displayed (strip out .php and turn '_' into a space)
	        $title = ucwords(str_replace(Array('.php', '_'), Array('', ' '), $crumb));

	        // If we are not on the last index, then display an <a> tag
	        if ($x != $last)
	            $breadcrumbs[] = "<a href=\"$base$crumb\">$title</a>";
	        // Otherwise, just display the title (minus)
	        else
	            $breadcrumbs[] = $title;
	    }

	    // Build our temporary array (pieces of bread) into one big string :)
	    return implode($separator, $breadcrumbs);
	}

	?>
	<ol class="breadcrumb">

		<?= breadcrumbs(' > ') ?>
		<!-- <li>Home</li><li>Forms</li><li>Form Plugins</li> -->
	</ol>
	<!-- end breadcrumb -->

	<!-- You can also add more buttons to the
	ribbon for further usability

	Example below:

	<span class="ribbon-button-alignment pull-right">
	<span id="search" class="btn btn-ribbon hidden-xs" data-title="search"><i class="fa-grid"></i> Change Grid</span>
	<span id="add" class="btn btn-ribbon hidden-xs" data-title="add"><i class="fa-plus"></i> Add</span>
	<span id="search" class="btn btn-ribbon" data-title="search"><i class="fa-search"></i> <span class="hidden-mobile">Search</span></span>
	</span> -->

</div>