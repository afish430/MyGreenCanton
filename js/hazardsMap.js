
goog.require('goog.dom');
goog.require('goog.ui.Tab');
goog.require('goog.ui.TabBar');

//script to embed Protected Areas Map as a Google map
var gmap, mapExtension, identifyTask, layers, overlays;
var hazSvc, res, iw, ovs = [];
var visLayers = [1, 7, 10, 11, 13, 15, 20, 26];

function initialize() {
    var mapOptions = {
        'center': new google.maps.LatLng(42.18, -71.125),
        'zoom': 12,
        'draggableCursor': 'pointer', // every pixel is clickable.
        'streetViewControl': true,
        'mapTypeId': google.maps.MapTypeId.ROADMAP
    };

    gmap = new google.maps.Map(document.getElementById("gmap"), mapOptions);

    //initialize map layers

    //Hazards Layer
    hazSvc = new gmaps.ags.MapService("http://geodata.epa.gov/ArcGIS/rest/services/OEI/FRS_INTERESTS/MapServer/"); //get service
    var hazLayer = new gmaps.ags.MapOverlay(hazSvc, { 'opacity': 1 }); //create layer
    hazLayer.setMap(gmap); //add to map

    //Canton Boundary
    var boundarySvc = new gmaps.ags.MapService("http://fema-services2.esri.com/arcgis/rest/services/Boundaries/ZipCodes/MapServer"); //get service
    var boundaryLayer = new gmaps.ags.MapOverlay(boundarySvc, { 'opacity': 1 }); //create layer

    //set visible layers of Haz layer
    hazSvc = hazLayer.getMapService();
    google.maps.event.addListenerOnce(hazLayer.getMapService(), 'load', function () {
        hazSvc.layers[1].visible = true;
        hazSvc.layers[7].visible = true;
        hazSvc.layers[10].visible = true;
        hazSvc.layers[11].visible = true;
        hazSvc.layers[13].visible = true;
        hazSvc.layers[15].visible = true;
        hazSvc.layers[20].visible = true;
        hazSvc.layers[26].visible = true;
    });
    //hazLayer.setMap(gmap);

    //set visible layer of Canton Boundary
    //boundaryLayer.setMap(gmap);
    boundarySvc = boundaryLayer.getMapService();
    google.maps.event.addListenerOnce(boundaryLayer.getMapService(), 'load', function () {
        boundarySvc.layers[0].visible = true;
    });


    //toggle which facility layers are turned on
    $(':radio').click(function () {
        var value = $(this).val();
        if (this.checked) {
            if (this.value == 'all') {
                visLayers = [1, 7, 10, 11, 13, 15, 20, 26];
            }
            else if (this.value == 'none') {
                visLayers = [];
            }
            else {
                visLayers = [value];
            }
            hazLayer.setMap(null);
            hazSvc.layers[1].visible = false;
            hazSvc.layers[7].visible = false;
            hazSvc.layers[10].visible = false;
            hazSvc.layers[11].visible = false;
            hazSvc.layers[13].visible = false;
            hazSvc.layers[15].visible = false;
            hazSvc.layers[20].visible = false;
            hazSvc.layers[26].visible = false;
            for (var i = 0; i < visLayers.length; i++) {
                hazSvc.layers[visLayers[i]].visible = true;
            }
            hazLayer.setMap(gmap);
        }
    }); //end toggle layers

    // register click event listener for the map
    google.maps.event.addListener(gmap, 'click', identify);
	
    setTimeout(function () { gmap.setCenter(new google.maps.LatLng(42.18, -71.1251)) }, 2000);//need this slight shift after quick timeout to make hazards layer appear on load in chrome
	
	//add layers to map
	hazLayer.setMap(gmap);
	boundaryLayer.setMap(gmap);
	
	}//end initialize

function identify(evt) {
    clearOverlays();
    if (res) {
        res.length = 0;
    }
    hazSvc.identify({
        'geometry': evt.latLng,
        'tolerance': 5,
        'layerIds': visLayers,
        'layerOption': 'all',
        'bounds': gmap.getBounds(),
        'width': gmap.getDiv().offsetWidth,
        'height': gmap.getDiv().offsetHeight
        //'overlayOptions': ovOptions
    }, function (results, err) {
        if (err) {
            alert(err.message + err.details.join('\n'));
        } else {
            addResultToMap(results, evt.latLng);
        }
    });
} //end identify

function clearOverlays() {
    if (ovs) {
        for (var i = 0; i < ovs.length; i++) {
            ovs[i].setMap(null);
        }
        ovs.length = 0;
    }
} //end clearOverlays

function addResultToMap(idresults, latlng) {
    res = idresults.results;
    layers = { "1": [], "7": [], "10": [], "11": [], "13": [], "15": [], "20": [], "26": []};
    for (var i = 0; i < res.length; i++) {
        var result = res[i];
        layers[result['layerId']].push(result);
    }
    // create and show the info-window
    var label = "Facilities:";
    var content = '';
    content += "<div style='max-height:250px;'><div style='font-size: 9pt; font-weight: bold;'>" + label + "</div><br><table class='identify' width='350px' border='1' style='font-size: 8pt; border-collapse:collapse;'><th>Type</th><th>Name</th><th>Address</th><th>Link</th>";
    for (var layerId in layers) {
        var results = layers[layerId];
        var count = results.length;
        for (var j = 0; j < count; j++) {
            var attributes = results[j].feature.attributes;
            content += "<tr>";
            content += "<td>" + results[j].layerName + "</td>";
            content += "<td>" + attributes["PRIMARY_NAME"] + "</td>";
            content += "<td>" + attributes["LOCATION_ADDRESS"] + "</td>";
            content += "<td><a target='blank' href='" + attributes["FAC_URL"] + "'>More Info</a></td>";
            content += "</tr>";
        }
    }
    content += "</div></table>";
        if (!iw) {
            iw = new google.maps.InfoWindow({
                content: content,
                position: latlng
            });
        } else {
            iw.setContent(content);
            iw.setPosition(latlng);
        }
        iw.open(gmap);

} //end addResultToMap


function clearResults() {
    mapExtension.removeFromMap(overlays);
    gmap.closeInfoWindow();
}

function hasErrorOccurred(error) {
    if (error) {
        alert("Error " + error.code + ": " + (error.message || (error.details && error.details.join(" ")) || "Unknown error"));
        return true;
    }
    return false;
}


