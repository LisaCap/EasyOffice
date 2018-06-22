//variable pour la carte
var map;
//fonction initMap appelée par l'API Google
function initMap()
{
    //DIV devant recevoir la carte
    var mapDiv = document.getElementById('map');
    //création de la carte
    map = new google.maps.Map(mapDiv, {
        zoom: 17,
        mapTypeId: 'satellite'
    });
    
    //contenu HTML de la boite d'info
    var contentString = '<div id="content">'+
      '<div id="siteNotice">WebForce3 is here...'+
      '</div>'+
      '<h1 id="firstHeading" class="firstHeading">WebForce3</h1>'+
      '<div id="bodyContent">'+
      '<p><b>WebForce3</b>: Ecole de développeurs Web à Marseille.<br/>'+
      '<img src="http://www.marseille-innov.org/wp-content/uploads/2016/09/logo-webforce3.jpg" class="logo" /></p>'+
      '</div>'+
      '</div>';
    //boite d'info
    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });
    
    // pour centrer la carte avec une adresse réelle
    var geocoder = new google.maps.Geocoder();
    var address = "600 Avenue du Campus Agropolis, 34980 Montferrier-sur-Lez";
    geocoder.geocode({'address': address}, function(results, status) 
    {
        if (status === google.maps.GeocoderStatus.OK)
        {
            map.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
                map: map,
                position: results[0].geometry.location,
                title: 'quelque part...'
            });
    
            // ajout de la boite et du listener
            marker.addListener('click', function() {
                infowindow.open(map, marker);
            });
    
        } 
        else 
        {
            alert('Geocode was not successful for the following reason: ' + status);
        }
        
    });
    
    // pour ajouter une autre adresse réelle
    var geocoder2 = new google.maps.Geocoder();
    var address2 = "Route de Montpellier, 34730 Prades-le-Lez";
    geocoder2.geocode({'address': address2}, function(results2, status2)
    {
        if (status2 === google.maps.GeocoderStatus.OK)
        {
            var marker2 = new google.maps.Marker({
                map: map,
                position: results2[0].geometry.location,
                title: 'Inter c est pour manger'
            });    
        }
        else
        {
            alert('Geocode was not successful for the following reason: ' + status2);
        }       
    });
}