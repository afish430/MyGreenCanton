<?php
require_once("index.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>MyGreenCanton: Comments</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="description" content="all things environmental for the town of Canton, Massachusetts" />
        <meta name="author" content="Arthur Fisher" />
        <link rel="Stylesheet" href="../styles/main.css"/>
        <link rel="Stylesheet" href="../styles/comment_styles.css"/>
        <link rel="shortcut icon" href="../images/favicon.ico"/>
	<script type="text/JavaScript" src="../js/getEcoTip.js"></script>
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script>
	function validateForm(){
		//check name
		var isValid = true;
		var nameEntered=$("#name").val();
		if (nameEntered==null || nameEntered==""){
			  $("#nameVal").html("Name Required");
			  isValid = false;
	  	  }
	  	else{$("#nameVal").html("")};
	  	//check comment
		var messageEntered=$("#comment").val();
	  	if(messageEntered==null || messageEntered==""){
			 $("#messageVal").html("Message Required");
			  isValid = false;
	  	 }
	  	else{$("#messageVal").html("")};
		return isValid;

	}//end validateForm
	</script>
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
                    <li class="current">Comments</li>
                    <li><a href="../single_pages/resources.html">Resources</a></li>
                </ul>
            </nav>
            
        </header>
        
        <section class="tall">
            <h2>Comments</h2>
            
            <p>Please use the form at the bottom of this page to submit comments that can be viewed by visitors to this site. 
            Use this forum to recount a nature walk you recently enjoyed, discuss your concerns about pollution in our town,
            or mention a local business you believe is doing their part to protect the planet. All comments are welcome.</p>

            <div id="commentsDiv">
                <?php
                //show error if comment could not be added
                if(isset($error)){
                   echo "<p id='commentError'>".$error."</p>"; 
                }
                //show all comments from database
                foreach($comments as $commentToShow){
                    echo "<div class='comment'><p>".$commentToShow['Comment']."<br><br><em>--".$commentToShow['Name'].", ".$commentToShow['TimeAdded']."</em></p></div>";
                }               
                ?>
            </div>
            
            <h3>Add a Comment:</h3>
            <?php
                if (isset($_COOKIE["user"]))
                  $userName = $_COOKIE["user"];
                else
                  $userName = "";
            ?>
            <form method="post" action="index.php" name="commentsForm" onsubmit="return validateForm()" id="commentsForm">
                <input type="hidden" name="action" value="add_comment" />
                <label for="commentName">Name:</label>
                <input type="text" id="name" name="commentName" <?php echo "value = '$userName'" ?>><span class="val" id="nameVal"></span><br>
                <label for="comment">Comment:</label>
                <textarea id="comment" name="comment"></textarea><span class="val" id="messageVal"></span><br>
                
                <div id="recap">
                <label>Verify:</label>
                <?php
                //Use recaptcha to make sure it is a human
                require_once('recaptchalib.php'); // reCAPTCHA Library
                $pubkey = "6LdcceASAAAAACzO_7XJix_zBlN2JbR-0ABv0rCA"; // Public API Key
                echo recaptcha_get_html($pubkey); // Display reCAPTCHA
                ?>
                </div>
                <input type="submit" id="commentButton" name="commentSubmit" value="Submit">
                
            </form>
        </section>

	<footer>
		<span><strong>Today's Eco Tip: </strong><span id="ecoTip"><script>showTip();</script> </span>
	</footer>

    </body>
</html>