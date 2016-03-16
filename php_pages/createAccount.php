<!DOCTYPE html>
<html>
    <head>
        <title>MyGreenCanton: Flora and Fauna</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="description" content="all things environmental for the town of Canton, Massachusetts" />
        <meta name="author" content="Arthur Fisher" />
        <link rel="Stylesheet" href="../styles/main.css"/>
        <link rel="Stylesheet" href="../styles/ff_admin_styles.css"/>
        <link rel="shortcut icon" href="../images/favicon.ico"/>
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
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
                    <li class="current">Flora & Fauna</li>
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
            <h2>Flora and Fauna</h2>
            <p>Create a user account:</p>
                <?php               
                if (isset($_COOKIE["user"]))
                  $userName = $_COOKIE["user"];
                else
                  $userName = "";
                if (isset($noMatch)){
                    echo "<strong>".$noMatch."</strong>";
                }
                ?>
            
             <form id="accountForm" action="index.php" method="post">
                 <input type="hidden" name="action" value="createAccount" />
                <label for="loginName">User Name:</label>
                <input type="text" name="loginName" <?php echo "value = '$userName'" ?>><br>
                <label for="password">Password:</label>
                <input type="password" name="password"><br>
                <label for="password2">Confirm Password:</label>
                <input type="password" name="password2"><br>
                <input type="submit" id="submitAccount" name="submit" value="Create Account">
            </form>
            
            <a href="signIn.php">Back to Login</a>
        </section>
        
</html>
