
//Code for the Matching Game. 

//object to compare the two flipped images
var comp = {
    firstImage: "",
    secondImage: "",
    flipCount: 0,
    totalFlips: 0,
    matchCount: 0,
    rowNum1: 0,
    colNum1: 0,
    rowNum2: 0,
    colNum2: 0
};

$(function () {
    //create arrays of image names for each of the 4 rows
    var imageArray = [["apple", "acorn", "recycle", "farmer", "sun"],
                ["owl", "sun", "lightbulb", "hybrid", "pollution"],
                ["pollution", "acorn", "farmer", "recycle", "compost"],
                ["apple", "hybrid", "owl", "compost", "lightbulb"]];

    //randomize inner and outer arrays so game is different each time
    randomize(imageArray[0]);
    randomize(imageArray[1]);
    randomize(imageArray[2]);
    randomize(imageArray[3]);
    randomize(imageArray);

    $('td').click(function () {
        //get row and column of clicked td
        var rowNum = $(this).parent().attr('class').charAt(0);
        var colNum = $(this).attr('class').charAt(0);
        //make sure card is not already flipped
        var imgHtml = $("." + rowNum + "Row" + " ." + colNum + "Col").html();
        if (imgHtml.substring(25, 29) != "tree") {
            //alert("This card has already been flipped!");
            return;
        }
        //keep track of flip counts
        comp.flipCount++;
        //make sure user doesn't click while unmatched images haven't yet reverted to trees
        if (comp.flipCount > 2) {
            return;
        }
        comp.totalFlips++;
        //get image and compare
        var chosenImage = imageArray[rowNum][colNum];
        $(this).html("<img src='../images/game/" + chosenImage + ".jpg' alt='" + chosenImage + "' width='65' height='65' height='65'>");
        var isMatch = compareImages(chosenImage, rowNum, colNum);
        //set back to trees if no match
        if (comp.flipCount == 2 && !isMatch) {
            setTimeout(function () {
                $("." + comp.rowNum1 + "Row" + " ." + comp.colNum1 + "Col").html("<img src='../images/game/tree.jpg'  width='65' height='65' height='65'>");
                $("." + comp.rowNum2 + "Row" + " ." + comp.colNum2 + "Col").html("<img src='../images/game/tree.jpg'  width='65' height='65' height='65'>");
                comp.flipCount = 0;
            }, 1000);
        } //end if
        //alert the winner
        if (comp.matchCount == 10) {
            $('#winning').html("<strong>YOU WIN!!!</strong><br><img src='../images/game/dancingPenguin.gif' alt='winner image' width='175' height='130' id='dancing'>");
        }
    });
});

//compare images
function compareImages(chosenImage, rowNum, colNum) {
    if (comp.flipCount == 1) {
        $('#winning').html('');
        comp.firstImage = chosenImage;
        comp.rowNum1 = rowNum;
        comp.colNum1 = colNum;
    }
    else if (comp.flipCount == 2) {
        comp.secondImage = chosenImage;
        comp.rowNum2 = rowNum;
        comp.colNum2 = colNum;
        $('#guesses').html(comp.totalFlips / 2);
        if (comp.firstImage == comp.secondImage) {
            //notify of match and keep unflipped
            //show an eco-tip based on matched image
            switch (comp.secondImage) {
                case 'acorn':
                    $('#winning').html("<strong>MATCH!</strong><br><img src='../images/game/" + comp.secondImage + ".jpg' width='65' height='65'> Planting trees is a great way to keep your city greener, cleaner, and healthier. <br><a href='http://www.growbostongreener.org/gbg/index.html' target='blank'>(Learn More)</a>");
                    break;
                case 'apple':
                    $('#winning').html("<strong>MATCH!</strong><br><img src='../images/game/" + comp.secondImage + ".jpg' width='65' height='65'> Organically grown fruits and vegetables are grown without pesticides, which is better for the earth and your health. <br><a href='http://tiki.oneworld.net/food/organic_advantages.html' target='blank'>(Learn More)</a>");
                    break;
                case 'pollution':
                    $('#winning').html("<strong>MATCH!</strong><br><img src='../images/game/" + comp.secondImage + ".jpg' width='65' height='65'> More hazardous pollutants are discharged into the air each year than are released to water and land combined. <br><a href='http://eschooltoday.com/pollution/air-pollution/air-pollution-facts.html' target='blank'>(Learn More)</a>");
                    break;
                case 'compost':
                    $('#winning').html("<strong>MATCH!</strong><br><img src='../images/game/" + comp.secondImage + ".jpg' width='65' height='65'> Composting is a great way to recycle household and lawn waste and promotes healthy soils. <br><a href='http://www.michigan.gov/kids/0,4600,7-247-49067-62499--,00.html' target='blank'>(Learn More)</a>");
                    break;
                case 'farmer':
                    $('#winning').html("<strong>MATCH!</strong><br><img src='../images/game/" + comp.secondImage + ".jpg' width='65' height='65'> Support your local farmers by buying food grown locally. It is fresher, tastier and more sustainable. <br><a href='http://www.localharvest.org/' target='blank'>(Learn More)</a>");
                    break;
                case 'hybrid':
                    $('#winning').html("<strong>MATCH!</strong><br><img src='../images/game/" + comp.secondImage + ".jpg' width='65' height='65'> Hybrid cars are powered by gasoline and also electricity. They are better for the environment because they produce fewer emissions. <br><a href='http://www.hybrid-car.org/hybrid-car-facts.html' target='blank'>(Learn More)</a>");
                    break;
                case 'lightbulb':
                    $('#winning').html("<strong>MATCH!</strong><br><img src='../images/game/" + comp.secondImage + ".jpg' width='65' height='65'> Compact fluorescent lightbulbs use about 90 percent less energy than incandescent bulbs. <br><a href='http://greenliving.nationalgeographic.com/energyefficient-lightbulb-2692.html' target='blank'>(Learn More)</a>");
                    break;
                case 'owl':
                    $('#winning').html("<strong>MATCH!</strong><br><img src='../images/game/" + comp.secondImage + ".jpg' width='65' height='65'> Spotted owls are an endangered species, mainly due to the loss of the old-growth forests where they live. <br><a href='http://naturemappingfoundation.org/natmap/facts/spotted_owl_k6.html' target='blank'>(Learn More)</a>");
                    break;
                case 'recycle':
                    $('#winning').html("<strong>MATCH!</strong><br><img src='../images/game/" + comp.secondImage + ".jpg' width='65' height='65'> Recycling is the process of turning used waste and materials into new products. This reduces energy use and pollution. <br><a href='http://www.sciencekids.co.nz/sciencefacts/recycling.html' target='blank'>(Learn More)</a>");
                    break;
                case 'sun':
                    $('#winning').html("<strong>MATCH!</strong><br><img src='../images/game/" + comp.secondImage + ".jpg' width='65' height='65'> Solar energy comes from the sun and can produce heat and electricity. This is a renewable and abundant source of energy with no harmful emissions. <br><a href='http://www.renewableenergyworld.com/rea/blog/post/2012/08/solar-energy-facts-for-kids' target='blank'>(Learn More)</a>");
                    break;
                default:
                    $('#winning').html("An error has occurred");
            }
            comp.matchCount++;
            comp.flipCount = 0;
            return true;
        }
        else {
            return false;
        }
    }
    else {
        alert("error!");
    }

} //end compareImages

//randomize arrays
function randomize(myArray) {
    var i = myArray.length, j, tempi, tempj;
    if (i == 0) return false;
    while (--i) {
        j = Math.floor(Math.random() * (i + 1));
        tempi = myArray[i];
        tempj = myArray[j];
        myArray[i] = tempj;
        myArray[j] = tempi;
    }
}



