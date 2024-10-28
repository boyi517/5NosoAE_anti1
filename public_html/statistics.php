<?php
include("frame.php");
html_1();
opentable();
?>
<style>
td,
th {
    border: 1 px solid gray;
    width: 100 px;
    height: 30 px;
}

.highcharts-figure,
.highcharts-data-table table {
    min-width: 320px;
    max-width: 800px;
    margin: 1em auto;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-data-table th {
    font-weight: 600;
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
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-11">
                <br />
                <h2 style="text-align: center;">Genome data distribution by the source of database and organism</h2>
                <br />
                <table class="table table-striped table-hover table-bordered table-responsive">
                    <thead class="table-success">
                        <tr>
                            <th>Organism</th>
                            <th>Assembly</th>
                            <th>SRA</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><I>Acinetobacter baumannii</I></td>
                            <td>9208</td>
                            <td>1574</td>
                            <td>10782</td>
                        </tr>
                        <tr>
                            <td><I>Pseudomonas aeruginosa</I></td>
                            <td>8331</td>
                            <td>5626</td>
                            <td>13957</td>
                        </tr>
                        <tr>
                            <td><I>Klebsiella pneumoniae</I></td>
                            <td>14766</td>
                            <td>9631</td>
                            <td>24397</td>
                        </tr>
                        <tr>
                            <td><I>Enterococcus faecium</I></td>
                            <td>11729</td>
                            <td>4506</td>
                            <td>16235</td>
                        </tr>
                        <tr>
                            <td><I>Staphylococcus aureus</I></td>
                            <td>25000</td>
                            <td>17016</td>
                            <td>42016</td>
                        </tr>
                        <tr>
                            <td><B>Total</B></td>
                            <td>69034</td>
                            <td>38353</td>
                            <td>107387</td>
                        </tr>
                    </tbody>
                </table>
                <br />
            </div>
        </div>
        <br />
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div id="container1"></div>
            </div>
            <div class="col-md-4">
                <div id="container2"></div>
            </div>
            <div class="col-md-4">
                <div id="container3"></div>
            </div>
        </div>
    </div>
    <figure class="col-md-12 text-end">
        <blockquote class="blockquote">
            <p style="color:grey; font-size: 16px;">Last update：Dec 20th, 2021</p>
        </blockquote>
    </figure>
    <script>
    Highcharts.chart('container1', {
        chart: {
            margin: [0, 0, 0, 0],
            spacingTop: 0,
            spacingBottom: 0,
            spacingLeft: 0,
            spacingRight: 0,

            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Assembly'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.2f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                size: '50%',
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    distance: '20%',
                    enabled: true,
                    format: '{point.name}: {point.percentage:.2f}%',
                    connectorWidth: 1,
                    style: {
                        fontSize: 11
                    }
                }
            }
        },
        series: [{
            name: 'Assembly',
            colorByPoint: true,
            data: [{
                name: 'Acinetobacter baumannii',
                y: 9208
            }, {
                name: 'Pseudomonas aeruginosa',
                y: 8331,
                dataLabels: {
                    distance: '-5' // Individual distance (in px)
                }
            }, {
                name: 'Klebsiella pneumoniae',
                y: 14766,
                dataLabels: {
                    distance: '-25' // Individual distance (in px)
                }
            }, {
                name: 'Enterococcus faecium',
                y: 11729
            }, {
                name: 'Staphylococcus aureus',
                y: 25000,
                dataLabels: {
                    distance: '-25' // Individual distance (in px)
                },
                sliced: true,
                selected: true
            }]
        }],
        //移除商標
        credits: {
            enabled: false
        }
    });
    Highcharts.chart('container2', {
        chart: {
            margin: [0, 0, 0, 0],
            spacingTop: 0,
            spacingBottom: 0,
            spacingLeft: 0,
            spacingRight: 0,

            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'SRA'
        },
        tooltip: {
            pointFormat: '{series.name}: {point.percentage:.2f}%'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                size: '50%',
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    distance: '30%',
                    enabled: true,
                    format: '{point.name}: {point.percentage:.2f}%',
                    connectorWidth: 1,
                    style: {
                        fontSize: 11
                    }
                }
            }
        },
        series: [{
            name: 'SRA',
            colorByPoint: true,
            data: [{
                name: 'Acinetobacter baumannii',
                y: 1574
            }, {
                name: 'Pseudomonas aeruginosa',
                y: 5626,
                dataLabels: {
                    distance: '-1' // Individual distance (in px)
                }
            }, {
                name: 'Klebsiella pneumoniae',
                y: 9631,
                dataLabels: {
                    distance: '-25' // Individual distance (in px)
                }
            }, {
                name: 'Enterococcus faecium',
                y: 4506
            }, {
                name: 'Staphylococcus aureus',
                y: 17016,
                dataLabels: {
                    distance: '-25' // Individual distance (in px)
                },
                sliced: true,
                selected: true
            }]
        }],
        //移除商標
        credits: {
            enabled: false
        }
    });
    Highcharts.chart('container3', {
        chart: {
            margin: [0, 0, 0, 0],
            spacingTop: 0,
            spacingBottom: 0,
            spacingLeft: 0,
            spacingRight: 0,

            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Total'
        },
        tooltip: {
            pointFormat: '{series.name}: {point.percentage:.2f}%'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                size: '50%',
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    distance: '10%',
                    enabled: true,
                    format: '{point.name}: {point.percentage:.2f}%',
                    connectorWidth: 1,
                    style: {
                        fontSize: 11
                    }
                }
            }
        },
        series: [{
            name: 'Total',
            colorByPoint: true,
            data: [{
                name: 'Acinetobacter baumannii',
                y: 10782
            }, {
                name: 'Pseudomonas aeruginosa',
                y: 13957,
                dataLabels: {
                    distance: '-1' // Individual distance (in px)
                }
            }, {
                name: 'Klebsiella pneumoniae',
                y: 24397,
                dataLabels: {
                    distance: '-25' // Individual distance (in px)
                }
            }, {
                name: 'Enterococcus faecium',
                y: 16235
            }, {
                name: 'Staphylococcus aureus',
                y: 42016,
                dataLabels: {
                    distance: '-25' // Individual distance (in px)
                },
                sliced: true,
                selected: true
            }]
        }],
        //移除商標
        credits: {
            enabled: false
        }
    });
    </script>
</body>

</html>
<?php
closetable();
?>