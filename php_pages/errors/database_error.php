<!DOCTYPE html>
<html>
    <head>
        <title>MyGreenCanton: Contact Us</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="description" content="all things environmental for the town of Canton, Massachusetts" />
        <meta name="author" content="Arthur Fisher" />
        <link rel="Stylesheet" href="../styles/main.css"/>
        <link rel="Stylesheet" href="../styles/contact_styles.css"/>
        <link rel="shortcut icon" href="../images/favicon.ico"/>
        <script type="text/JavaScript" src="../js/getEcoTip.js"></script>
    </head>
    <body>
        <header>
            <!--small utility navigation bar-->
            <nav id="utils">
                <ul>
                    <li><a href="../single_pages/author.html">About the Author</a></li>
                    <li><a href="../php_pages/contact.php">Contact Us</a></li>
                </ul>
            </nav>
            
            <h1><img src="../images/leaves1.jpg" width="60" height="60"/>My<span>Green</span>Canton</h1>
            
            <!--main navigation bar-->
            <nav id="nav_bar">
                <ul>
                    <li><a href="../home.html">Home</a></li>
                    <li><a href="../php_pages/hazards.php">Hazards</a></li>
                    <li><a href="../php_pages/flora_fauna.php">Flora & Fauna</a></li>
					<li><a href="../single_pages/cleanEnergy.html">Clean Energy</a></li>
                    <li><a href="../single_pages/protected.html">Protected Areas</a></li>                 
                    <li><a href="../maps/maps.html">Maps</a></li>
                    <li><a href="../single_pages/kids.html">For Kids</a></li>
                    <li><a href="../php_pages/comments.php">Comments</a></li>
                    <li><a href="../single_pages/resources.html">Resources</a></li>
                </ul>
            </nav>
            
</header>

<section id="main">
    <h1>Database Error</h1>
    <p>There was an error connecting to the database.</p>
    <p>Error message: <?php echo $error_message; ?></p>
    <p>&nbsp;</p>
</section><!-- end main -->

<footer>
	<span><strong>Today's Eco Tip: </strong><span id="ecoTip"><script>showTip();</script></span>
</footer>

    </body>
</html>