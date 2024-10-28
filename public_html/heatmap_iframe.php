<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "css/xhtml1-transitional.dtd">

<?php
if (isset($_REQUEST)) {
    while (list($varname, $varvalue) = each($_REQUEST)) {
        $$varname = $varvalue;
    }
}
if (isset($_SERVER)) {
    while (list($varname, $varvalue) = each($_ENV)) {
        $$varname = $varvalue;
    }
    while (list($varname, $varvalue) = each($_SERVER)) {
        $$varname = $varvalue;
    }
}
?>

<?php

$profile = array();
$x_label = "";
$y_label = "";
$m_value = "";
$folder=$_GET["folder"];
exec("cat temp/$folder/3.abProfilesCmp/hits_profile.tsv", $profile);
//exec("cat ./z_profile_100.tsv", $profile);  ///hits_profile.tsv 
//print($folder);
$line_num = count($profile);
for ($i = 0; $i < $line_num; $i++) {   //100
    //for($i=0;$i<51;$i++) {
    $profile[$i] = trim($profile[$i]);
    $temp = array();
    $temp = explode("\t", $profile[$i]);
    $column_num = count($temp);
    if ($i == 0) {
        for ($j = 1; $j < $column_num; $j++) {     //100
            //        for($j=1;$j<51;$j++) {
            $x_label = $x_label . "'" . $temp[$j] . "',";
        }
    } else {
        $y_label = $y_label . "'" . $temp[0] . "',";
        for ($j = 1; $j < $column_num; $j++) {      //100
            //        for($j=1;$j<50;$j++) {
            $m_value = $m_value . "[" . ($j - 1) . "," . ($i - 1) . "," . $temp[$j] . "],";
        }
    }
}

//print("$x_label<br><br>$y_label<br><br>$m_value<br><br>");

?>


<html xmlns='http://www.w3.org/1999/xhtml'>

<head>
    <meta charset="utf-8" name="viewport" content="width=device-width,initial-scale=1;charset=utf-8;" />
    <title>HeatMap</title>
    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
    <script src="https://code.highcharts.com/modules/heatmap.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script> -->

    <script src="https://blacklabel.github.io/grouped_categories/grouped-categories.js"></script>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script> 加了會變當-->
    <!-- <script src="http://code.highcharts.com/modules/offline-exporting.js"></script> -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/heatmap.js"></script>
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        //圖表樣式
        var chart = {
            type: 'heatmap',
            marginTop: 130, //距離上邊界40px
            marginBottom: 120, //距離下邊界80px
            events: {
                load: function() {
                    var labels1 = $('#Heatmap').highcharts().xAxis[0].labelGroup.element
                        .childNodes; //下排
                    var labels2 = $('#Heatmap').highcharts().xAxis[1].labelGroup.element
                        .childNodes; //上排

                    for (var i = 0; i < labels1.length; i++) { //Class 1.
                        if (labels1[i].textContent == "1.Gentamicin" || labels1[i].textContent ==
                            "1.Tobramycin" || labels1[i].textContent == "1.Streptomycin" ||
                            labels1[i].textContent == "1.Amikacin" || labels1[i].textContent ==
                            "1.Isepamicin" || labels1[i].textContent == "1.Dibekacin" ||
                            labels1[i].textContent == "1.Kanamycin" || labels1[i].textContent ==
                            "1.Neomycin" || labels1[i].textContent == "1.Lividomycin" ||
                            labels1[i].textContent == "1.Paromomycin" || labels1[i].textContent ==
                            "1.Ribostamycin" || labels1[i].textContent == "1.Butiromycin" ||
                            labels1[i].textContent == "1.Butirosin" || labels1[i].textContent ==
                            "1.Hygromycin" || labels1[i].textContent == "1.Netilmicin" ||
                            labels1[i].textContent == "1.Apramycin" || labels1[i].textContent ==
                            "1.Sisomicin" ||
                            labels1[i].textContent == "1.Arbekacin" || labels1[i].textContent ==
                            "1.Kasugamycin" ||
                            labels1[i].textContent == "1.Astromicin" || labels1[i].textContent ==
                            "1.Fortimicin" ||
                            labels1[i].textContent == "1.Spectinomycin") {
                            labels1[i].style.fill = '#E3908C'; //更改颜色(下排)
                            labels2[i].style.fill = '#E3908C'; //更改颜色(上排)


                        } else if (labels1[i].textContent == "2.Spectinomycin") { //Class 2.
                            labels1[i].style.fill = 'orange'; //更改颜色(下排)
                            labels2[i].style.fill = 'orange'; //更改颜色(上排)
                        } else if (labels1[i].textContent == "3.Fluoroquinolone" || labels1[i]
                            .textContent == "3.Ciprofloxacin" || labels1[i].textContent ==
                            "3.Nalidixic_acid") { //Class 3.
                            labels1[i].style.fill = '#5CC0FF'; //更改颜色(下排)
                            labels2[i].style.fill = '#5CC0FF'; //更改颜色(上排)
                        } else if (labels1[i].textContent == "4.Amoxicillin" || labels1[i]
                            .textContent == "4.Amoxicillin+Clavulanic_acid" || labels1[i].textContent ==
                            "4.Ampicillin" || labels1[i].textContent ==
                            "4.Ampicillin+Clavulanic_acid" || labels1[i].textContent ==
                            "4.Cefepime" || labels1[i].textContent ==
                            "4.Cefixime" || labels1[i].textContent ==
                            "4.Cefotaxime" || labels1[i].textContent ==
                            "4.Cefoxitin" || labels1[i].textContent ==
                            "4.Ceftazidime" || labels1[i].textContent ==
                            "4.Ertapenem" || labels1[i].textContent ==
                            "4.Imipenem" || labels1[i].textContent ==
                            "4.Meropenem" || labels1[i].textContent ==
                            "4.Piperacillin" || labels1[i].textContent ==
                            "4.Piperacillin+Tazobactam" || labels1[i].textContent ==
                            "4.Aztreonam" || labels1[i].textContent ==
                            "4.Cefotaxime+Clavulanic_acid" || labels1[i].textContent ==
                            "4.Temocillin" || labels1[i].textContent ==
                            "4.Ticarcillin" || labels1[i].textContent ==
                            "4.Ceftazidime+Avibactam" || labels1[i].textContent ==
                            "4.Penicillin" || labels1[i].textContent ==
                            "4.Ceftriaxone" || labels1[i].textContent ==
                            "4.Ticarcillin+Clavulanic_acid" || labels1[i].textContent ==
                            "4.Cephalothin" ||
                            labels1[i].textContent ==
                            "4.Cephalotin" ||
                            labels1[i].textContent ==
                            "4.Piperacillin+Clavulanic_acid") { //Class 4.
                            labels1[i].style.fill = '#017580'; //更改颜色(下排)
                            labels2[i].style.fill = '#017580'; //更改颜色(上排)
                        } else if (labels1[i].textContent == "5.Sulfamethoxazole" || labels1[i]
                            .textContent ==
                            "5.Trimethoprim") { //Class 5.
                            labels1[i].style.fill = '#C99AE0'; //更改颜色(下排)
                            labels2[i].style.fill = '#C99AE0'; //更改颜色(上排)
                        } else if (labels1[i].textContent == "6.Fosfomycin") { //Class 6.
                            labels1[i].style.fill = '#FF6C5C'; //更改颜色(下排)
                            labels2[i].style.fill = '#FF6C5C'; //更改颜色(上排)
                        } else if (labels1[i].textContent == "7.Vancomycin" || labels1[i].textContent ==
                            "7.Teicoplanin") { //Class 7.
                            labels1[i].style.fill = '#415F94'; //更改颜色(下排)
                            labels2[i].style.fill = '#415F94'; //更改颜色(上排)
                        } else if (labels1[i].textContent == "8.Lincomycin" || labels1[i].textContent ==
                            "8.Clindamycin") { //Class 8.
                            labels1[i].style.fill = '#61E786'; //更改颜色(下排)
                            labels2[i].style.fill = '#61E786'; //更改颜色(上排)
                        } else if (labels1[i].textContent == "9.Dalfopristin" || labels1[i]
                            .textContent == "9.Pristinamycin_IIA" || labels1[i].textContent ==
                            "9.Virginiamycin_M" || labels1[i].textContent ==
                            "9.Quinupristin+Dalfopristin") { //Class 9.
                            labels1[i].style.fill = '#E0C663'; //更改颜色(下排)
                            labels2[i].style.fill = '#E0C663'; //更改颜色(上排)
                        } else if (labels1[i].textContent == "10.Tiamulin") { //Class 10.
                            labels1[i].style.fill = '#E04444'; //更改颜色(下排)
                            labels2[i].style.fill = '#E04444'; //更改颜色(上排)
                        } else if (labels1[i].textContent == "11.Carbomycin" || labels1[i]
                            .textContent == "11.Erythromycin" || labels1[i].textContent ==
                            "11.Azithromycin" || labels1[i].textContent ==
                            "11.Oleandomycin" || labels1[i].textContent ==
                            "11.Spiramycin" || labels1[i].textContent ==
                            "11.Tylosin" || labels1[i].textContent ==
                            "11.Telithromycin") { //Class 11.
                            labels1[i].style.fill = '#529CE0'; //更改颜色(下排)
                            labels2[i].style.fill = '#529CE0'; //更改颜色(上排)
                        } else if (labels1[i].textContent == "12.Tetracycline" || labels1[i]
                            .textContent == "12.Doxycycline" || labels1[i].textContent ==
                            "12.Minocycline" || labels1[i].textContent ==
                            "12.Tigecycline") { //Class 12.
                            labels1[i].style.fill = '#E0721D'; //更改颜色(下排)
                            labels2[i].style.fill = '#E0721D'; //更改颜色(上排)
                        } else if (labels1[i].textContent == "13.Chloramphenicol" || labels1[i]
                            .textContent == "13.Florfenicol") { //Class 13.
                            labels1[i].style.fill = '#843594'; //更改颜色(下排)
                            labels2[i].style.fill = '#843594'; //更改颜色(上排)
                        } else if (labels1[i].textContent == "14.Rifampicin") { //Class 14.
                            labels1[i].style.fill = '#E07B68'; //更改颜色(下排)
                            labels2[i].style.fill = '#E07B68'; //更改颜色(上排)
                        } else if (labels1[i].textContent == "15.Quinupristin" || labels1[i]
                            .textContent == "15.Pristinamycin_IA" || labels1[i].textContent ==
                            "15.Virginiamycin_S"
                        ) { //Class 15.
                            labels1[i].style.fill = '#274B94'; //更改颜色(下排)
                            labels2[i].style.fill = '#274B94'; //更改颜色(上排)
                        } else if (labels1[i].textContent == "16.Linezolid") { //Class 16.
                            labels1[i].style.fill = '#8CE066'; //更改颜色(下排)
                            labels2[i].style.fill = '#8CE066'; //更改颜色(上排)
                        } else if (labels1[i].textContent == "17.Colistin") { //Class 17.
                            labels1[i].style.fill = '#944E2F'; //更改颜色(下排)
                            labels2[i].style.fill = '#944E2F'; //更改颜色(上排)
                        } else if (labels1[i].textContent == "18.Fusidic_acid") { //Class 18.
                            labels1[i].style.fill = '#F759CF'; //更改颜色(下排)
                            labels2[i].style.fill = '#F759CF'; //更改颜色(上排)
                        } else if (labels1[i].textContent == "19.Mupirocin") { //Class 19.
                            labels1[i].style.fill = '#65E4E4'; //更改颜色(下排)
                            labels2[i].style.fill = '#65E4E4'; //更改颜色(上排)
                        } else if (labels1[i].textContent == "20.Metronidazole") { //Class 20.
                            labels1[i].style.fill = '#CB0000'; //更改颜色(下排)
                            labels2[i].style.fill = '#CB0000'; //更改颜色(上排)
                        } else if (labels1[i].textContent == "21.Formaldehyde") { //Class 21.
                            labels1[i].style.fill = '#1627DB'; //更改颜色(下排)
                            labels2[i].style.fill = '#1627DB'; //更改颜色(上排)
                        } else if (labels1[i].textContent == "22.Benzylkonium_Chloride" || labels1[i]
                            .textContent == "22.Ethidium_Bromide" || labels1[i].textContent ==
                            "22.Chlorhexidine" || labels1[i].textContent ==
                            "22.Cetylpyridinium_Chloride") { //Class 22.
                            labels1[i].style.fill = '#9994DE'; //更改颜色(下排)
                            labels2[i].style.fill = '#9994DE'; //更改颜色(上排)
                        } else if (labels1[i].textContent == "23.Hydrogen_peroxide") { //Class 23.
                            labels1[i].style.fill = '#8F7906'; //更改颜色(下排)
                            labels2[i].style.fill = '#8F7906'; //更改颜色(上排)
                        } else if (labels1[i].textContent == "24.Temperature") { //Class 24.
                            labels1[i].style.fill = 'grey'; //更改颜色(下排)
                            labels2[i].style.fill = 'grey'; //更改颜色(上排)
                        }

                    }
                }
            }
        };
        //圖片存檔
        var exporting = {
            url: "http://140.117.103.223:8889"
        }
        //標題
        var title = {
            text: ''
        };
        //繪圖線條控制
        var plotOptions = {
            series: {
                allowPointSelect: true,
                cursor: 'pointer',
            }
        };
        //x軸
        var xAxis = [{
            categories: [<?php echo substr($x_label, 0, -1); ?>],
            //opposite: true,
            title: {
                text: 'Antibiotics',
            },
            tickmarkPlacement: 'on',
            tickLength: 8,
            tickWidth: 1,
            labels: {
                groupedOptions: [{
                    rotation: 0, // rotate labels for a 2nd-level
                }],
                rotation: -45,
                step: 1,
                allowOverlap: true,
                padding: 0,
                style: {
                    fontSize: '8px',
                    // color:"red",
                }
            }
        }, {
            linkedTo: 0,
            opposite: true,
            categories: [<?php echo substr($x_label, 0, -1); ?>],
            //                title:{
            //                    text: 'Antibiotics',
            //                },
            tickmarkPlacement: 'on',
            tickLength: 8,
            tickWidth: 1,
            labels: {
                rotation: -45,
                step: 1,
                allowOverlap: true,
                padding: 0,
                style: {
                    fontSize: '8px'
                }
            }
        }];
        //y軸
        var yAxis = {
            categories: [<?php echo substr($y_label, 0, -1); ?>],
            //categories: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
            title: {
                text: 'Genome ID',
            },
            tickmarkPlacement: 'on',
            tickLength: 8,
            tickWidth: 1,
            labels: {
                step: 1,
                allowOverlap: true,
                padding: 0,
                style: {
                    fontSize: '6px'
                }
            },
            reversed: true
        };
        //圖表顏色
        var colorAxis = {
            min: 0,
            minColor: 'rgb(166,217,106)', //最小值的底色
            //                maxColor: Highcharts.getOptions().colors[0], //最大值的底色
            max: 100,
            maxColor: 'rgb(244,109,67)',
            stops: [
                //                    [0.0, 'rgb(102,189,99)'],
                [0.0, 'rgb(166,217,106)'],
                [0.2, 'rgb(217,239,139)'],
                [0.5, 'rgb(254,224,139)'],
                [0.8, 'rgb(253,174,97)'],
                [1.0, 'rgb(244,109,67)']
            ],
            // stops: [ //數值多少顏色改變(淺到深)
            //     [0, 'white'],
            //     [0.5, '#C000AB'],
            //     [0.97, '#6900AB'],
            //     [0.98, '#6C00AB'],
            //     [0.99, '#5B05A8'],
            //     [1, '#4A00AB'],
            // ],

        };

        //漸層標示 0~100
        var legend = {
            align: 'right', //數字標籤在右邊
            layout: 'vertical', //調整圖例的水平或垂直排列的 可以設定的值有 "horizontal" 和 "vertical"。
            margin: 0,
            verticalAlign: 'top', //決定圖例在圖表中的"垂直位置"，可以輸入 top、middle、bottom。
            y: 115, //距離y軸多少
            symbolHeight: 690 //最高到幾公分
        };
        //hover提示訊息
        var tooltip = {
            backgroundColor: '#FFFFFF', //底色
            style: {
                color: '#30403D',
                fontWeight: 'lighter',
                fontSize: '14px'
            },
            formatter: function() { //文字內容
                return '<b>Antibiotic：</b>' + this.series.xAxis.categories[this.point.x] +
                    '<br/><b>Genome：</b>' + this.series.yAxis.categories[this.point.y] +
                    '</br><b>Evidence score：</b>' + this.point.value;
            },
        };
        //數值
        var series = [{
            name: 'Antibiogram Profile',
            borderWidth: 0.5,
            borderColor: "white",
            pointPadding: 0,
            data: [<?php echo substr($m_value, 0, -1); ?>],
            //                data: [[0, 0, 10], [0, 1, 19], [0, 2, 8], [0, 3, 24], [0, 4, 67],   //xy(位置),z(值)
            //                [1, 0, 92], [1, 1, 58], [1, 2, 78], [1, 3, 117], [1, 4, 48],
            //                [2, 0, 35], [2, 1, 15], [2, 2, 123], [2, 3, 64], [2, 4, 52],
            //                [3, 0, 72], [3, 1, 132], [3, 2, 114], [3, 3, 19], [3, 4, 16],
            //                [4, 0, 38], [4, 1, 5], [4, 2, 8], [4, 3, 117], [4, 4, 115],
            //                [5, 0, 88], [5, 1, 32], [5, 2, 12], [5, 3, 6], [5, 4, 120],
            //                [6, 0, 13], [6, 1, 44], [6, 2, 88], [6, 3, 98], [6, 4, 96],
            //                [7, 0, 31], [7, 1, 1], [7, 2, 82], [7, 3, 32], [7, 4, 30],
            //                [8, 0, 85], [8, 1, 97], [8, 2, 123], [8, 3, 64], [8, 4, 84],
            //                [9, 0, 47], [9, 1, 114], [9, 2, 31], [9, 3, 48], [9, 4, 91]],
            dataLabels: {
                enabled: false, //秀出數字
                color: '#000000' //字的顏色
            }
        }];
        //移除商標
        var credits = {
            enabled: false
        };

        //創建 json 數據
        var json = {};
        json.chart = chart;
        json.title = title;
        json.xAxis = xAxis;
        json.yAxis = yAxis;
        json.colorAxis = colorAxis;
        json.legend = legend;
        json.tooltip = tooltip;
        json.plotOptions = plotOptions;
        json.exporting = exporting; //下載圖片
        json.series = series;
        json.credits = credits;
        $('#Heatmap').highcharts(json); //在$('#container')畫圖

    });
    </script>
    <style>
    @media screen and (max-width:415px) {

        #divScrollBar {
            width: 410px;
            overflow-x: auto;
        }
    }
    </style>
</head>

<body>
    <div id="divScrollBar">
        <div id="Heatmap" style="width: 1200px; height: 950px; margin: 0 auto">
        </div>
    </div>
</body>

</html>