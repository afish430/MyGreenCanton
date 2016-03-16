<?php
//make sure user is logged in
 if (!isset($_SESSION)){
     session_start();
 };
 if (!isset($_SESSION['is_valid_admin'])){
     header('Location: signIn.php');
 }
 ?>
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
        <script type="text/javascript">
            //Show either the plant form or the animal form, depending which radio button is clicked.
            $(function(){
                $(':radio').click(function() {
                    if (this.checked && $(this).val() == 'animal'){
                        $('#animalAddForm').css('display', 'block');
                        $('#plantAddForm').css('display', 'none');
                    }
                    else {
                        $('#animalAddForm').css('display', 'none');
                        $('#plantAddForm').css('display', 'block');
                    }
                });     
            });
        
	function validateForm(kingdom){
            if(kingdom=="animal"){ //validate animal form
		//check common name
		var isValid = true;
		var nameEntered=$("#commonName").val();
		if (nameEntered==null || nameEntered==""){
			  $("#commonNameVal").html("Required");
			  isValid = false;
	  	  }
	  	else{$("#commonNameVal").html("")};
	  	//check genus
		var genusEntered=$("#genus").val();
	  	if(genusEntered==null || genusEntered==""){
                    $("#genusVal").html("Required");
                    isValid = false;
	  	 }
	  	else{$("#genusVal").html("")};
                //check species
		var speciesEntered=$("#species").val();
	  	if(speciesEntered==null || speciesEntered==""){
                    $("#speciesVal").html("Required");
                    isValid = false;
	  	 }
	  	else{$("#speciesVal").html("")};
                //check link
		var linkEntered=$("#webLink").val();
	  	if(linkEntered==null || linkEntered==""){
                    $("#webLinkVal").html("Required");
                    isValid = false;
	  	 }
	  	else{$("#webLinkVal").html("")};
		return isValid;
            }//end if animal
            else{ //validate plant form
                //check common name
		var isValid = true;
		var nameEntered=$("#commonNameP").val();
		if (nameEntered==null || nameEntered==""){
			  $("#commonNameValP").html("Required");
			  isValid = false;
	  	  }
	  	else{$("#commonNameValP").html("")};
	  	//check genus
		var genusEntered=$("#genusP").val();
	  	if(genusEntered==null || genusEntered==""){
                    $("#genusValP").html("Required");
                    isValid = false;
	  	 }
	  	else{$("#genusValP").html("")};
                //check species
		var speciesEntered=$("#speciesP").val();
	  	if(speciesEntered==null || speciesEntered==""){
                    $("#speciesValP").html("Required");
                    isValid = false;
	  	 }
	  	else{$("#speciesValP").html("")};
                //check link
		var linkEntered=$("#webLinkP").val();
	  	if(linkEntered==null || linkEntered==""){
                    $("#webLinkValP").html("Required");
                    isValid = false;
	  	 }
	  	else{$("#webLinkValP").html("")};
		return isValid;
            }//end if plant

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
                    <li><a href="../php_pages/comments.php">Comments</a></li>
                    <li><a href="../single_pages/resources.html">Resources</a></li>
                </ul>
            </nav>
            
        </header>
        
        <section>
            <h2>Flora and Fauna: Add a Record</h2>
            <?php if(isset($added)){
                echo "<p><strong id='added'>".$added."</strong></p>";
                }
                ?>
            <a href="ff_options.php">Back to Options</a><br>
            
            <div id="addFFDiv">
                <p>Add records to <em>MyGreenCanton</em>'s plant and animal database using the form below.</p>
                
                <input type="radio" name="plantOrAnimal" value="animal" checked><span>Animal</span>
                <input type="radio" name="plantOrAnimal" value="plant"><span>Plant</span>

                <!--Two separate forms- only one will be shown at a given time.-->
                <form id="animalAddForm" method="post" action="index.php" onsubmit="return validateForm('animal')" name="animalAddForm">
                    <input type="hidden" name="action" value="add_ff" />
                    <?php echo "<input type='hidden' name='loginName' value='".$_SESSION['loginName']."'/>" ?>
                    <input type="hidden" name="kingdom" value="Animalia" />
                    <label for="commonName">Common Name:</label>
                    <input type="text" id="commonName" name="commonName" title="The local name given to a particular species of an animal, as opposed to the scientific latin or greek name, which is used universally."><span class="val" id="commonNameVal"></span><br>
                    <label for="genus">Genus:</label>
                    <input type="text" id="genus" name="genus" title="A taxonomic category ranking below a family and above a species and generally consisting of a group of species exhibiting similar characteristics."><span class="val" id="genusVal"></span><br>
                    <label for="species">Species:</label>
                    <input type="text" id="species" name="species" title="The lowest taxonomic rank, and the most basic unit or category of biological classification."><span class="val" id="speciesVal"></span><br>
                    <label for="type">Type:</label>
                    <select name="type" class="tooltip" title="Choose the broad classification that best describes the organism.">
                        <option value="Mammal" selected>Mammal</option>
                        <option value="Bird">Bird</option>
                        <option value="Fish">Fish</option>
                        <option value="Reptile">Reptile</option>
                        <option value="Amphibian">Amphibian</option>
                        <option value="Invertebrate">Invertebrate</option>
                        <option value="Other">Other</option>  
                    </select>&nbsp;<a href="http://animals.about.com/od/animal-facts/tp/animal-groups.htm" target="blank">More Info</a><br>
                    <label for="Origin">Origin:</label>
                    <select name="origin" class="tooltip" title="Choose whether this species is native to this area or was introduced (is invasive).">
                        <option value="Native" selected>Native</option>
                        <option value="Invasive">Invasive</option>
                    </select>&nbsp;<a href="http://www.massaudubon.org/Invasive_Species/" target="blank">More Info</a><br>
                    <label for="status">Status:</label>
                    <select  name="status" class="tooltip" title="Choose the general conservation status for this species. Consider anything above 'Least Concern' to be Threatened.">
                        <option value="Low Risk" selected>Low Risk</option>
                        <option value="Threatened">Threatened</option>
                    </select>&nbsp;<a href="http://en.wikipedia.org/wiki/Conservation_status" target="blank">More Info</a><br>
                    <label for="link">Web Link:</label>
                    <input type="text" id="webLink" name="link" title="Include a web URL with information about this species."><span class="val" id="webLinkVal"></span><br>
                    <input type="submit" class="submitButton" name="Add" value="Add">                   
                </form>
                
                <form id="plantAddForm" method="post" action="index.php" onsubmit="return validateForm('plant')" name="plantAddForm">
                    <input type="hidden" name="action" value="add_ff" />
                    <?php echo "<input type='hidden' name='loginName' value='".$_SESSION['loginName']."'/>" ?>
                    <input type="hidden" name="kingdom" value="Plantae" />
                    <label for="commonName">Common Name:</label>
                    <input type="text" id="commonNameP" name="commonName" title="The local name given to a particular species of a plant, as opposed to the scientific latin or greek name, which is used universally."><span class="val" id="commonNameValP"></span><br>
                    <label for="genus">Genus:</label>
                    <input type="text" id="genusP" name="genus" title="A taxonomic category ranking below a family and above a species and generally consisting of a group of species exhibiting similar characteristics."><span class="val" id="genusValP"></span><br>
                    <label for="species">Species:</label>
                    <input type="text" id="speciesP" name="species" title="The lowest taxonomic rank, and the most basic unit or category of biological classification."><span class="val" id="speciesValP"></span><br>
                    <label for="type">Type:</label>
                    <select name="type" class="tooltip" title="Choose the broad classification that best describes the organism.">
                        <option value="Woody Plant" selected>Woody Plant</option>
                        <option value="Herbaceous Plant">Herbaceous Plant</option>
                    </select>&nbsp;<a href="http://plant-bio.wikispaces.com/Woody+stems+vs.+Herbaceous+stems" target="blank">More Info</a><br>
                    <label for="Origin">Origin:</label>
                    <select name="origin" class="tooltip" title="Choose whether this species is native to this area or was introduced (is invasive).">
                        <option value="Native" selected>Native</option>
                        <option value="Invasive">Invasive</option>
                    </select>&nbsp;<a href="http://www.massaudubon.org/Invasive_Species/" target="blank">More Info</a><br>
                    <label for="status">Status:</label>
                    <select  name="status" class="tooltip" title="Choose the general conservation status for this species. Consider anything above 'Least Concern' to be Threatened.">
                        <option value="Low Risk" selected>Low Risk</option>
                        <option value="Threatened">Threatened</option>
                    </select>&nbsp;<a href="http://en.wikipedia.org/wiki/Conservation_status" target="blank">More Info</a><br>
                    <label for="link">Web Link:</label>
                    <input type="text" id="webLinkP" name="link" title="Include a web URL with information about this species."><span class="val" id="webLinkValP"></span><br>
                    <input type="submit" class="submitButton" name="Add" value="Add">                 
                </form>
            </div>

        </section>

	<footer>
		<span><strong>Today's Eco Tip: </strong><span id="ecoTip"><script>showTip();</script> </span>
	</footer>

    </body>
</html>