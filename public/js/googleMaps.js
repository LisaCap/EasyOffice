/*googleMaps.js*/

//On declare la variable pour la carte
var map;

//fonction initMap appelée par l'API Google
function initMap()
{
    //1. Lattitude et longitude du lieu à afficher (car google en a besoin pour faire son affichage)
    var latLng = {lat: 43.6788781, lng: 3.8701737};
    //div qui reçoit la carte
    var mapDiv = document.getElementById('map');
    
    //appel de l'API Google
    map = new google.maps.Map(mapDiv, {
        
        center: latLng,
        zoom: 17,
        mapTypeId: 'satellite'
    });
    
//ajout d'un marqueur (épingle)
    var marker = new google.maps.Marker({
        
        //emplacement
        position: latLng,
        //attachement à la carte
        map : map,
        //légende
        title: 'WebForce 3 is here'
        
    });
    
//contenu HTML de la boite d'info
  var contentString = '<div id="content">'+
      '<div id="siteNotice">WebForce3 is here...'+
      '</div>'+
      '<h1 id="firstHeading" class="firstHeading">WebForce3</h1>'+
      '<div id="bodyContent">'+
      '<p><b>WebForce3</b>: Ecole de développeurs Web à Montferrier.<br/>'+
      '<img src="http://www.marseille-innov.org/wp-content/uploads/2016/09/logo-webforce3.jpg" class="logo" /></p>'+
      '</div>'+
      '</div>';
  //boite d'info
  var infowindow = new google.maps.InfoWindow({
    content: contentString
  });
  // ajout de la boite et du listener
  marker.addListener('click', function() {
    infowindow.open(map, marker);
  });
}