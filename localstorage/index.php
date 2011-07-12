<!doctype html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

        <title>Musings about front-end code | stojg.se</title>
        <meta name="description" content="This is a small test">
        <meta name="author" content="stig lindqvist">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="shortcut icon" href="/favicon.ico">
        <link rel="stylesheet" href="/css/style.css?v=2">

        <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
    </head>
    <body>
        <div id="header-container">
            <header class="wrapper">
                <h1 id="title">musings on localstorage</h1>
                <nav>
                    <ul>
                        <li><a href="/">Go back</a></li>
                    </ul>
                </nav>
            </header>
        </div>
        <div id="main" class="wrapper">
            <article>
                <header>
                    <h2>Localstorage</h2>
                    <h3></h3>
                    <table width="50%">
                        <caption>Supported browsers</caption>
                        <thead>
                        <tr>
                            <th>IE<th>
                            <th>Firefox<th>
                            <th>Safari<th>
                            <th>Chrome<th>
                            <th>Opera<th>
                            <th>Iphone<th>
                            <th>Android<th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>8.0+<td>
                            <td>3.5+<td>
                            <td>4.0+<td>
                            <td>4.0+<td>
                            <td>10.5+<td>
                            <td>2.0+<td>
                            <td>2.0+<td>
                        </tr>
                        </tbody>
                    </table>

                    <form id="storageForm">

                        <table width="50%">
                            <caption>Currently in storage</caption>
                            <thead><tr><th>index</th><th>value</th><th>action</th></tr></thead>
                            <tbody id="inputs">
                                <tr>
                                    <td><input class="keyName" name="key" type="key" value="index" /></td>
                                    <td><input class="value" name="value" type="value" value="" /></td>
                                    <td><input type="submit" value="set value" /></td>
                                </tr>
                            </tbody>
                            <tbody id="content"></tbody>
                        </table>

                </header>
            </article>
        </div>
        <div id="footer-container">
            <footer class="wrapper">
            </footer>
        </div>
        <script src="/js/libs/jquery.min.js"></script>
        <script type="text/javascript">
            function supports_html5_storage() {
                try {
                    return 'localStorage' in window && window['localStorage'] !== null;
                } catch (e) {
                    return false;
                }
            }
            
            var iterateStorage = function() {
                if( !localStorage.key ) { return; }
                var toPrint = '';
                for (var i = 0, len = localStorage.length; i < len; i++){
                    var key = localStorage.key(i);
                    toPrint += '<tr><td>'+key + '</td><td>' + localStorage.getItem( key )+'</td><td><a class="clear-entry" href="#clear" data-keyname="'+key+'">clear</a></tr>';
                }
                jQuery("#content").html(toPrint);
                jQuery(this).find(".value").focus();
            }
            
            jQuery(document).ready(function(){
                if( !supports_html5_storage() ){
                    return;
                }
               
                iterateStorage();
                value = jQuery(this).find(".value").val(localStorage.getItem( 'index' ));
                
                jQuery("#storageForm").submit(function(e){
                    var keyName, value;
                    keyName = jQuery(this).find(".keyName").val();
                    value = jQuery(this).find(".value").val();
                    localStorage.setItem(keyName, value );
                    iterateStorage();
                    return false;
                });
                
                jQuery(".clear-entry").live('click', function(e){
                    var keyname = this.getAttribute("data-keyname");
                    localStorage.removeItem(keyname);
                    iterateStorage();
                    return false;
                });
                
            });
    
        </script>
        <!--[if lt IE 7 ]>
        <script src="js/libs/dd_belatedpng.js"></script>
        <script> DD_belatedPNG.fix('img, .png_bg');</script>
	<![endif]-->
    </body>
</html>