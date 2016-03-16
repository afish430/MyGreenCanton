
goog.require('goog.dom');
goog.require('goog.ui.Tab');
goog.require('goog.ui.TabBar');

//script to embed Protected Areas Map as a Google map
var gmap, mapExtension, identifyTask, layers, overlays;
var areasSvc, res, iw, ovs = [];

function initialize() {
    var mapOptions = {
            'center': new google.maps.LatLng(42.18, -71.12),
            'zoom': 12,
            'draggableCursor': 'pointer', // every pixel is clickable.
            'streetViewControl': true,
            'mapTypeId': google.maps.MapTypeId.ROADMAP
        };

        gmap = new google.maps.Map(document.getElementById("gmap2"), mapOptions);

        //initialize map layers

         //by Owner
         areasSvc = new gmaps.ags.MapService("http://gis1.usgs.gov/arcgis/rest/services/gap/PADUS_Owner/MapServer/"); //get service
         var areasLayer = new gmaps.ags.MapOverlay(areasSvc, { 'opacity': 0.7 }); //create layer
         areasLayer.setMap(gmap); //add to map

         //by Protection Status
         var areas2Svc = new gmaps.ags.MapService("http://gis1.usgs.gov/arcgis/rest/services/gap/PADUS_Status/MapServer/"); //get service
         var areas2Layer = new gmaps.ags.MapOverlay(areas2Svc, { 'opacity': 0.7 }); //create layer
         areas2Layer.setMap(gmap); //add to map

         //Canton Boundary
         var boundarySvc = new gmaps.ags.MapService("http://fema-services2.esri.com/arcgis/rest/services/Boundaries/ZipCodes/MapServer"); //get service
         var boundaryLayer = new gmaps.ags.MapOverlay(boundarySvc, { 'opacity': 1}); //create layer
            //set visible layers
         google.maps.event.addListenerOnce(boundaryLayer.getMapService(), 'load', function () {
             boundaryLayer.setMap(gmap);
             var service = boundaryLayer.getMapService();
             service.layers[0].visible = true;
         });

         areas2Layer.setMap(null);//hide

         //toggle which protected layer is turned on
         $(':radio').click(function () {
             var value = $(this).val();
             if (this.checked) {
                if (value == "status") {//by status
                    areasLayer.setMap(null);//hide
                    areas2Layer.setMap(gmap);//show
                    $('#legend2').html("<h3>Legend</h3><img src='../images/legend/gap.png' width='245'/>");
                }
                else {//by owner
                    areas2Layer.setMap(null);//hide
                    areasLayer.setMap(gmap);//show
                    $('#legend2').html("<h3>Legend</h3><img src='../images/legend/protected.png' width='245'/>");
                 }
             }
          }); //end toggle layers

        // register click event listener for the map
        google.maps.event.addListener(gmap, 'click', identify);
        setTimeout(function () { gmap.setCenter(new google.maps.LatLng(42.18, -71.125)) }, 500); //need this slight shift after quick timeout to make boundary layer appear on load in chrome
    }//end initialize

    function identify(evt) {
        clearOverlays();
            if (res) {
                res.length = 0;
            }
            areasSvc.identify({
                'geometry': evt.latLng,
                'tolerance': 5,
                'layerIds': [0],
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
        }//end identify

        function clearOverlays() {
            if (ovs) {
                for (var i = 0; i < ovs.length; i++) {
                    ovs[i].setMap(null);
                }
                ovs.length = 0;
            }
        }//end clearOverlays

        function addResultToMap(idresults, latlng) {
          res = idresults.results;
          layers = { "0": []};
          for (var i = 0; i < res.length; i++) {
            var result = res[i];
            layers[result['layerId']].push(result);
          }
                  // create and show the info-window
                  var label = "Protected Areas";
                  var content = '';
                  content += "<div style='max-height:250px; font-size: 9pt; font-weight: bold;'>" + label + "</div><br><table class='identify' width='350px' border='1' style='font-size: 8pt; border-collapse:collapse;'><th>Name</th><th>Type</th><th>Owner</th><th>Access</th>";
                  for (var layerId in layers) {
                      var results = layers[layerId];
                      var count = results.length;
                      for (var j = 0; j < count; j++) {
                          var attributes = results[j].feature.attributes;
                          content += "<tr>";
                          content += "<td>" + attributes["Primary Designation Name"] + "</td>";
                          content += "<td>" + attributes["Primary Designation Type"] + "</td>";
                          content += "<td>" + attributes["Local Owner"] + "</td>";
                          content += "<td>" + attributes["Public Access"] + "</td>";
                          content += "</tr>";
                      }
                  }
                  content += "</div></table>";
                  if (count != 0) {
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
                  }
                  else if (iw && count == 0) {
                    iw.close();
                  }
          }//end addResultToMap


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