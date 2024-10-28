<!DOCTYPE html>

<?php
if (isset($_REQUEST))
{
    while(list($varname, $varvalue) = each($_REQUEST))
    { $$varname = $varvalue; }
}
if (isset($_SERVER))
{
    while (list($varname, $varvalue) = each($_ENV))
    { $$varname = $varvalue; }
    while (list($varname, $varvalue) = each($_SERVER))
    { $$varname = $varvalue; }
}
?>

<?php

$folder = $_GET["folder"];

$country = array();
exec("cat ./temp/$folder/country", $country);
//print("$country[0]\n");
//exec("cat ./temp/$folder/3.abProfilesCmp/hits_table.tsv", $profile);

//Location
$location = array();
$latitude = array();
$longitude = array();
exec("cat ./z_lati_long.tsv", $location);
$line_num = count($location);
for($i=1;$i<$line_num;$i++){
    $location[$i] = trim($location[$i]);
    $temp1 = array();
    $temp1 = explode("\t",$location[$i]);
    $latitude[$temp1[0]] = $temp1[1];
    $longitude[$temp1[0]] = $temp1[2];
    /*$j = $temp1[0]."\t".$latitude[$temp1[0]]."\t".$longitude[$temp1[0]]."<br>";
    print($j);*/
}

//使用者所選擇的國家
$marker = "[".$longitude[$country[0]].",".$latitude[$country[0]]."]" ;
//print("$marker");


//國家有幾筆資料
$location = array();
$SUM = array();
exec("cat ./temp/$folder/3.abProfilesCmp/hits_summary.tsv", $location);
$line_num = count($location);
for($i=1;$i<$line_num;$i++){
    $location[$i] = trim($location[$i]);
    $temp1 = array();
    $temp1 = explode("\t",$location[$i]);
    $SUM[$temp1[0]] = $temp1[6];
    //$j = $temp1[0]."\t".$SUM[$temp1[0]]."\t"."<br>";
    //print($j);
}


//取得發現菌株的國家
$profile = array();
exec("cat ./temp/$folder/3.abProfilesCmp/hits_table.tsv", $profile);
$line_num = count($profile);
for($i=1;$i<$line_num;$i++){
    $profile[$i] = trim($profile[$i]);
    $temp = array();
    $temp = explode("\t",$profile[$i]);
    /*$latitude[$temp[3]];
    $longitude[$temp[3]];
    $j = $temp[3]."\t".$latitude[$temp[3]]."\t".$longitude[$temp[3]]."<br>";
    $j = "{"."'type'".":"."'Feature'".","."'geometry'".":"."{"."'type'".":"."'Point'".","."'coordinates'".":"."[".$longitude[$temp[3]].",".$latitude[$temp[3]]."]}},";*/
    //$z =$z."{'type':'Feature','geometry':{'type':'Point','coordinates':[".$longitude[$temp[3]].",".$latitude[$temp[3]]."]}},";
    $z_test = $z_test. "{'type':'Feature','properties':{'description':'https://nosoae.imst.nsysu.edu.tw/pie_chart.php?folder=".$folder."&country=".$temp[5]."','mag':".$SUM[$temp[5]]."},'geometry':{'type':'Point','coordinates':[".$longitude[$temp[5]].",".$latitude[$temp[5]]."]}},";
    //print($z_test."<br>");
}
//print($z_test."<br>")

?>

<html lang="en">

<head>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no" />
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.css" rel="stylesheet" />
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.js"></script>
    <script src="js/jquery-3.3.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
    </script>
    <title>MAPBOX</title>
    <style>
    body {
        margin: 0;
        padding: 0;
    }

    #map {
        position: absolute;
        left: 0px;
        bottom: 0%;
        width: 100%;
    }

    .mapboxgl-popup {
        max-width: 400px;
        font: 12px/20px 'Helvetica Neue', Arial, Helvetica, sans-serif;
    }

    table,
    td {
        border: 1px solid rgb(37, 84, 172);
    }

    thead,
    tfoot {
        background-color: rgb(37, 84, 172);
        color: #fff;
    }

    .collapse1 {
        overflow-y: scroll;
        height: 280px;
    }

    .legend {
        background-color: #fff;
        border-radius: 10px;
        bottom: 30px;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        /*font: 12px/20px 'Helvetica Neue', Arial, Helvetica, sans-serif;*/
        font-size: 16px;
        font-weight: bolder;
        padding: 10px;
        position: absolute;
        right: 10px;
        z-index: 1;
    }

    .legend div span {
        border-radius: 50%;
        display: inline-block;
        height: 15px;
        margin-right: 5px;
        width: 15px;
    }

    table,
    td {
        border: 1px solid #333;
    }

    thead,
    tfoot {
        background-color: #333;
        color: #fff;
    }

    .pie {
        overflow-y: scroll;
        /* Add the ability to scroll */
    }

    /* Hide scrollbar for Chrome, Safari and Opera */
    .pie::-webkit-scrollbar {
        display: none;
    }

    /* Hide scrollbar for IE, Edge and Firefox */
    .pie {
        -ms-overflow-style: none;
        /* IE and Edge */
        scrollbar-width: none;
        /* Firefox */
    }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div id="map" style="height: 100%; width: 100%" class="col-md-12"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="state-legend" class="legend">
        <div><span style="background-color: #c34118"></span>76-100</div>
        <div><span style="background-color: #dcac38"></span>51-75</div>
        <div><span style="background-color: #4fbf71"></span>26-50</div>
        <div><span style="background-color: #558cc3"></span>0-25</div>
    </div>
    <script>
    mapboxgl.accessToken =
        'pk.eyJ1IjoiY2h1Y2h1Y2h1IiwiYSI6ImNrc2U2dHp3OTB4cWsydG9zMGF5eHdzcHYifQ.2NNaI8i9Ek3TgQVRx25j-g';
    /*const bounds = [
        [-19, -85], // Southwest coordinates
        [345, 85] // Northeast coordinates
    ];*/
    const map = new mapboxgl.Map({
        container: 'map', // container ID
        style: 'mapbox://styles/mapbox/light-v10', // style URL
        center: [18.7, 46.4], // starting position [lng, lat]
        zoom: 1, // starting zoom
        maxZoom: 5,
        minZoom: 1,
        //maxBounds: bounds //固定可觀看的範圍
    });
    map.on('load', () => {
        // Add a new source from our GeoJSON data and
        // set the 'cluster' option to true. GL-JS will
        // add the point_count property to your source data.
        map.resize();
        map.addSource('places', {
            type: 'geojson',
            //data: 'https://docs.mapbox.com/mapbox-gl-js/assets/earthquakes.geojson',
            data: {
                features: [<?php echo substr($z_test,0,-1); ?>]
            },
            cluster: true,
            clusterMaxZoom: 4, // Max zoom to cluster points on
            clusterRadius: 50 // Radius of each cluster when clustering points (defaults to 50)
        });

        //將各個座標群組並分類
        map.addLayer({
            id: 'clusters',
            type: 'circle',
            source: 'places',
            filter: ['has', 'point_count'],
            paint: {
                // Use step expressions (https://docs.mapbox.com/mapbox-gl-js/style-spec/#expressions-step)
                // with three steps to implement three types of circles:
                //   * Blue, 20px circles when point count is less than 100
                //   * Yellow, 30px circles when point count is between 100 and 750
                //   * Pink, 40px circles when point count is greater than or equal to 750
                'circle-color': [
                    'step',
                    ['get', 'point_count'],
                    '#558cc3',
                    25,
                    '#4fbf71',
                    50,
                    '#dcac38',
                    75,
                    '#c34118'
                ],
                'circle-radius': [
                    'step',
                    ['get', 'point_count'],
                    16,
                    25,
                    20,
                    50,
                    24,
                    75,
                    28
                ]
            }
        });

        //群組的style
        map.addLayer({
            id: 'cluster-count',
            type: 'symbol',
            source: 'places',
            filter: ['has', 'point_count'],
            layout: {
                'text-field': '{point_count_abbreviated}',
                'text-font': ['DIN Offc Pro Medium', 'Arial Unicode MS Bold'],
                'text-size': 18
            },
            paint: {
                "text-color": "#ffffff"
            }
        });

        //點上的style
        map.addLayer({
            id: 'unclustered-point',
            type: 'circle',
            source: 'places',
            filter: ['!', ['has', 'point_count']],
            paint: {
                'circle-color': '#558cc3',
                'circle-radius': 16,
                'circle-stroke-width': 1,
                'circle-stroke-color': '#558cc3'
            }
        });

        //點上的Label
        map.addLayer({
            'id': 'places_label',
            'type': 'symbol',
            'source': 'places',
            'filter': ['!=', 'cluster', true],
            'layout': {
                'text-field': [
                    'number-format',
                    ['get', 'mag'],
                    {
                        'min-fraction-digits': 0,
                        'max-fraction-digits': 1
                    }
                ],
                'text-font': ['DIN Offc Pro Medium', 'Arial Unicode MS Bold'],
                'text-size': 18
            },
            'paint': {
                'text-color': [
                    'case',
                    ['<', ['get', 'mag'], 0],
                    'black',
                    'white'
                ]
            }
        });

        // inspect a cluster on click 將座標群組
        map.on('click', 'clusters', (e) => {
            const features = map.queryRenderedFeatures(e.point, {
                layers: ['clusters']
            });
            const clusterId = features[0].properties.cluster_id;
            map.getSource('places').getClusterExpansionZoom(
                clusterId,
                (err, zoom) => {
                    if (err) return;

                    map.easeTo({
                        center: features[0].geometry.coordinates,
                        zoom: zoom //可看到群組內的點集合
                    });
                }
            );
        });

        // When a click event occurs on a feature in
        // the unclustered-point layer, open a popup at
        // the location of the feature, with
        // description HTML from its properties.

        //點擊座標&看到細節內容
        map.on('click', 'unclustered-point', (e) => {
            const coordinates = e.features[0].geometry.coordinates.slice();
            const descript1 = e.features[0].properties.description;
            //const tsunami = e.features[0].properties.tsunami === 1 ? 'yes' : 'no';

            //    // Ensure that if the map is zoomed out such that
            //    // multiple copies of the feature are visible, the
            //    // popup appears over the copy being pointed to.
            while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
                coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
            }

            new mapboxgl.Popup()
                .setMaxWidth('450')
                .setLngLat(coordinates)
                .setHTML(
                    //descript1
                    //使用iframe
                    "<br/><div class='pie' height='320px' width='450px'><iframe src='" + descript1 +
                    "' height='320px' width='450px'></iframe></div>"
                    //"<br/><div height='500px' width='500px'><iframe src='http://140.117.103.223/~chu/pie_chart.php' height=450px width=350px></iframe></div>"
                )
                .addTo(map);
        });

        map.on('mouseenter', 'clusters', () => {
            map.getCanvas().style.cursor = 'pointer';
        });
        map.on('mouseleave', 'clusters', () => {
            map.getCanvas().style.cursor = '';
        });

        // Create a default Marker and add it to the map.
        const marker1 = new mapboxgl.Marker({
                color: 'red'
            })
            .setLngLat(<?php echo $marker; ?>)
            .addTo(map);
    });

    //Full Screen
    //map.addControl(new mapboxgl.FullscreenControl());

    // disable map rotation using right click + drag
    map.dragRotate.disable();

    // disable map rotation using touch rotation gesture
    map.touchZoomRotate.disableRotation();

    // disable map zoom when using scroll
    //map.scrollZoom.disable();

    // Add zoom and rotation controls to the map.
    map.addControl(new mapboxgl.NavigationControl());
    </script>
</body>

</html>
