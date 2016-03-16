<!DOCTYPE html>
<html>
    <head>
        <title>MyGreenCanton: Contact Us</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="description" content="all things environmental for the town of Canton, Massachusetts" />
        <meta name="author" content="Arthur Fisher" />
        <link rel="shortcut icon" href="../images/favicon.ico"/>
        <link rel="Stylesheet" href="../styles/main.css"/>
        <link rel="Stylesheet" href="../styles/contact_styles.css"/>
	<script type="text/JavaScript" src="../js/getEcoTip.js"></script>
    </head>
    <body>
        <header>
            <!--small utility navigation bar-->
            <nav id="utils">
                <ul>
                    <li><a href="../single_pages/author.html">About the Author</a></li>
                    <li><a href="#">Contact Us</a></li>
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
        
        <section>
            <h2>Contact Us</h2>
            
            <p>Please use the form below to contact the site's administrator with any questions about
            the site and its content, or suggestions to make it better!</p>
             <?php               
                if (isset($_COOKIE["user"]))
                  $userName = $_COOKIE["user"];
                else
                  $userName = "";
                if (isset($_COOKIE["email"]))
                  $emailAddress = $_COOKIE["email"];
                else
                  $emailAddress = "";
            ?>
            
            <form id="contactForm" action="send_email.php" method="post">
                <label for="name">Name:</label>
                <input type="text" name="name" <?php echo "value = '$userName'" ?>><br>
                <label for="email">Email:</label>
                <input type="email" name="email" <?php echo "value = '$emailAddress'" ?>><br>
                <label for="message">Message:</label>
                <textarea name="message"></textarea><br>
                <input type="submit" id="contactButton" name="Submit" value="Submit">
            </form>

        </section>

		<footer>
			<span><strong>Today's Eco Tip: </strong><span id="ecoTip"><script>showTip();</script> </span>
		</footer>

    </body>
</html>