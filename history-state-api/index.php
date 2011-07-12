<?php 
function getImageName( $getVars ) {
	if( isset( $getVars[ 'image' ] ) && $getVars[ 'image' ] ) {
		return $getVars[ 'image' ];
	}
	return '/img/01.jpg';
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
		
		<title>Musings on pushstate</title>
		<meta name="description" content="This is a small test">
		<meta name="author" content="stig lindqvist">

		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="stylesheet" href="css/style.css?v=2">

		<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	</head>
	<body>
		<div id="header-container">
			<header class="wrapper">
				<h1 id="title">HTML5: History </h1>
				<nav>
					<ul>
						<li><a href="/img/01.jpg">Image one</a></li>
						<li><a href="/img/02.jpg">Image two</a></li>
						<li><a href="/img/03.jpg">Image three</a></li>
					</ul>
				</nav>
			</header>
		</div>
		<div id="main" class="wrapper">
			<aside>
				<div id="content"><img src="<?php echo getImageName( $_GET );?>" /></div>
			</aside>
			<article>
				<header>
					<h3>Changing the browser history</h3>
					<p>1. Click on top navigation to load a new image by DOM insertion into the aside box.</p>
					<p>2. Click your browsers back button, only the image will be reloaded.</p>
					<p>3. Profit</p>
				</header>
			</article>
		</div>
		<div id="footer-container">
			<footer class="wrapper">
			</footer>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
		<script type="text/javascript">
			var changeTitleForURL = function( URL ) {
				$('#content').html('<img src="'+URL+'" />');
			}

			jQuery(document).ready(function(){
				jQuery('nav a').click(function(event){
					window.history.pushState({href: jQuery(this).attr('href') }, 'Title', '/history-state-api/?image=' + jQuery(this).attr('href')   )
					changeTitleForURL( jQuery(this).attr('href') );
					return false;
				});
	
				jQuery(window).bind("popstate", function(e) {
					if (e.originalEvent.state) {
						changeTitleForURL( e.originalEvent.state.href );
					}
				});
			});
		</script>
		<!--[if lt IE 7 ]>
		<script src="/js/libs/dd_belatedpng.js"></script>
		<script> DD_belatedPNG.fix('img, .png_bg');</script>
	<![endif]-->
	</body>
</html>