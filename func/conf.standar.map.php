    var latitude="<?php 
                if($row['LATITUDE']!=NULL)                      //Change to standar International Latitude
                    echo str_replace(",",".",$row['LATITUDE']); 
                else echo "No Data";
                            ?>";
    var longitude="<?php                            //Change to standar International Longitude
                if($row['LATITUDE']!=NULL)
                    echo str_replace(",",".",$row['LONGITUDE']);
                else echo "No Data";
                ?>";