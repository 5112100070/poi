/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    function initialize_sitac_conf(){
        $('#detil-container').hide();     // Hide all detil sitac in Potensi,Sitac, and progress Deployment
    }
    
    function cekIndiHome(){
                if($('#status_indihome').val()=='YES')
                        $('#no_indihome').show();
                else $('#no_indihome').hide();
            }
    function activingTab(data){
        if(data=="detil_sitac"){
            $('#detil-container').show();
            $('#map-container').hide();
        }
        else{
            $('#detil-container').hide();
            $('#map-container').show();
        }
        data = "#"+data;
        $("#detil_data li").removeClass("active");
        $(data).parent().addClass("active")
    }
function getUrlVars() {                             // Code Sumber http://papermashup.com/read-url-get-variables-withjavascript/
        var vars = {};
        var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
        });
        return vars;
}
    function generateMap(){
        javascript:void($('#briefing_map').onclick=function(){return false;})
        var id = getUrlVars()['site_id'];
        var witel = getUrlVars()['witel'];
        location.assign('map.briefing.php?site_id='+id+'&witel='+witel);
    }
            //End of Function Area    
            $(document).ready(function(){
                initialize_sitac_conf();
                cekIndiHome();
                $('#status_indihome').change(function(){
                    cekIndiHome();
                });
                
                $('#index_indihome').change(function(){
                    var url = location.pathname.split("?");
                    var url = url[0].split('/');
                    
                    var data = $('#index_indihome').val();
                    var path = url[2]+"?tipe_site="+data;
                    location.assign(path);
                });
                
                $('a').click(function (){
                    if(event.target.id=="detil_sitac" || event.target.id=="detil_map")activingTab(event.target.id);
                    else if(event.target.id=="briefing_map")generateMap();
                });
            });
 