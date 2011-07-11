<?php
/**
 *
 * @param array $getVars
 * @return string 
 */
function getPageName( $getVars ) {
	if( isset( $getVars[ 'page' ] ) && $getVars[ 'page' ] ) {
		return 'Content '.$getVars['page'];
	}
}

if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest' ) {
	echo getPageName($_GET);
	exit(0);
}
?>
<!doctype html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Demo of popstate | stojg.se</title>
	<meta name="description" content="This is a small test">
	<meta name="author" content="stig lindqvist">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="/favicon.ico">
	<link rel="stylesheet" href="css/style.css?v=2">

	<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>
	<div id="header-container">
		<header class="wrapper">
			<h1 id="title">History state api</h1>
			<nav>
				<ul>
					<li><a href="/history-state-api/?page=1">Foo</a></li>
					<li><a href="/history-state-api/?page=2">Bar</a></li>
					<li><a href="/history-state-api/?page=3">Nav</a></li>
				</ul>
			</nav>
		</header>
	</div>
	<div id="main" class="wrapper">
		<aside>
			<h3><?php echo getPageName($_GET );?></h3>
		</aside>
		<article>
			<header>
                <p>
                    "The DOM window object provides access to the browser's history through the history object. It exposes useful methods and properties that let you move back and forth through the user's history, as well as -- starting with HTML5 -- manipulate the contents of the history stack."
                </p>
                
                <p>Mozilla Developer Network - <a href="https://developer.mozilla.org/en/DOM/Manipulating_the_browser_history">Manipulating the browser history</a></p>
                
				<code><pre>
var changeTitleForURL = function( URL ) {
	jQuery.get( URL, function(data){
		$('aside h3').html(data);
	});
}

jQuery(document).ready(function(){
	jQuery('nav a').click(function(event){
		history.pushState({url: jQuery(this).attr('href')}, 'title', '/' + jQuery(this).attr('href') )
		changeTitleForURL( jQuery(this).attr('href') );
		return false;
	});

	jQuery(window).bind("popstate", function(e) {
		if (e.originalEvent.state) {
			changeTitleForURL( e.originalEvent.state.url );
		}
	return false;
	});
});
</pre></code>
			</header>
		</article>
	</div>
	<div id="footer-container">
		<footer class="wrapper">
		</footer>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<script src="/history-state-api/js/history.js"></script>
	<!--[if lt IE 7 ]>
	<script src="js/libs/dd_belatedpng.js"></script>
	<script> DD_belatedPNG.fix('img, .png_bg');</script>
	<![endif]-->
</body>
</html>