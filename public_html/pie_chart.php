<html>

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

$title = $_GET["country"];
$profile = array();
$x_label = array();
$y_label = array();
$m_value = "";
//print($title);
//exec("cat ./pie_chart.tsv", $profile);//grep "^$title" ./pie_chart.tsv
exec("grep '$title' ./temp/$folder/3.abProfilesCmp/hits_summary.tsv", $profile);
//print($profile[0]);
$temp1 = array();
$temp1 = explode("\t",$profile[0]);
//print($temp1[1]);
$m_value = "['Acinetobacter baumannii',".$temp1[1]."],['Enterococcus faecium',".$temp1[2]."],['Klebsiella pneumoniae',".$temp1[3]."],['Pseudomonas aeruginosa',".$temp1[4]."],['Staphylococcus aureus',".$temp1[5]."],";
//print($m_value);


?>


<head>
    <meta charset="UTF-8" />
    <title>Highcharts</title>
    <script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
</head>
<style>
.highcharts-figure,
.highcharts-data-table table {
    /*min-width: 200px;*/
    max-width: 380px;
    margin: 1em auto;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    /*margin: 150px auto;*/
    text-align: center;
    width: 100%;
    max-width: 300px;
}

.highcharts-data-table caption {
    /*padding: 1em 0;
    font-size: 1.2em;*/
    color: #555;
}

.highcharts-data-table th {
    font-weight: 150;
    padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

input[type="number"] {
    min-width: 50px;
}
</style>

<body>
    <!--<div id="container" style="width: 380px; height: 280px"></div>-->
    <figure class="highcharts-figure">
        <div id="container" style="width: 350px; height: 300px"></div>
    </figure>
    <script type="text/javascript">
    $(document).ready(function() {
        var chart = {
            margin: [0, 0, 0, 0],
            spacingTop: 0,
            spacingBottom: 0,
            spacingLeft: 0,
            spacingRight: 0,

            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        };
        var title = {
            text: '<?php echo ($title); ?>'
        };
        var tooltip = {
            pointFormat: 'Frequency: <b>{point.percentage:.2f}%</b>'
        };
        var plotOptions = {
            pie: {
                size: '50%',
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    distance: '5%',
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.2f} %',
                    connectorWidth: 1,
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black',
                        fontSize: 11
                    }
                }
            }
        };
        var series = [{
            type: 'pie',
            name: 'Count',
            data: [<?php echo substr($m_value,0,-1); ?>]
            /*data: [
                ['Acinetobacter baumannii',96.2],
                ['Pseudomonas aeruginosa',0.4],
                ['Klebsiella pneumoniae',1.5],
                ['Enterococcus faecium',0.7],
                ['Staphylococcus aureus',1.2],
            ]*/
        }];


        //移除商標
        var credits = {
            enabled: false
        };


        //創建 json數據
        var json = {};
        json.chart = chart;
        json.title = title;
        json.tooltip = tooltip;
        json.series = series;
        json.credits = credits;
        json.plotOptions = plotOptions;
        $('#container').highcharts(json);
    });
    </script>
</body>

</html>
