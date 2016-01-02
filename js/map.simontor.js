/* 
Author  : By Wahyu Kukuh Herlambang
Email   : russians.wahyu@gmail.com
 */

var Koordinate = [
            ["Malang",-7.9784695,112.5617421],   //Malang
            ["Sidoarjo",-7.450958,112.6767486],   //Sidoarjo
            ["Jember",-8.1767234,113.6559507],   //Jember
            ["Surabaya",-7.3103105,112.7265701],   //Surabaya
            ["Pasuruan",-7.6513924,112.8875851],   //Pasuruan
            ["Denpasar",-8.6725072,115.1542218],   //Denpasar
            ["Gresik",-7.1648785,112.6354278],   //Gresik
            ["Mataram",-8.5876173,116.0815804]    //Mataram
        ];
        
    function conf_map_standar(position_sitac){
                    var map_sitac_prop={
                        center: position_sitac,
                        mapTypeId: google.maps.MapTypeId.ROADMAP,
                        zoom: 15
                    };
                    return new google.maps.Map(document.getElementById("map_sitac"),map_sitac_prop);
    }
    
    function conf_coordinate(coordinate){               //Change "," in coordinate become "."
        coordinate=coordinate.replace(",",".");
        return coordinate;
    }
    // public function
function  initialize_map_index(){
        var mapProp = {
            center:new google.maps.LatLng(-7.5667,115.7500),
            zoom:8,
            panControl:true,
            zoomControl:false,
            mapTypeControl:true,
            scaleControl:true,
            streetViewControl:true,
            overviewMapControl:true,
            rotateControl:true,    
            scrollwheel:false,
            mapTypeId:google.maps.MapTypeId.ROADMAP
        };
        
        var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
        var infoWindow = new google.maps.InfoWindow();
        
        var marker,i;
        for(i=0;i<Koordinate.length;i++){
            var position = new google.maps.LatLng(Koordinate[i][1],Koordinate[i][2]);
            marker = new google.maps.Marker({
                position:position,
                map: map,
                animation:google.maps.Animation.BOUNCE
            });
            
            google.maps.event.addListener(marker,'click', (function(marker,i){ 
                return function() {
                    infoWindow.setContent(Koordinate[i][0]);
                    infoWindow.open(map,marker);
                    
                    map.setZoom(12);
                    map.setCenter(marker.getPosition());
                };
            })(marker,i));  
        }
    }
    function initialize_map_sitac(latitude,longitude){
                    latitude=conf_coordinate(latitude);
                    longitude=conf_coordinate(longitude);
                    var position_sitac=new google.maps.LatLng(latitude,longitude);
                    var map_sitac=conf_map_standar(position_sitac);      // Definisikan mapnya
                    var marker=new google.maps.Marker({                                 // Beri marker
                        position: position_sitac,
                        animation: google.maps.Animation.BOUNCE,
                        map: map_sitac
                    });
                }