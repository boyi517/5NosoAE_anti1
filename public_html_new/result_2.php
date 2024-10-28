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
include("frame.php");
html_1();
opentable();
$folder=$_GET["folder"];
//print($folder);

//抓菌種
$species = array();
exec("cat ./temp/$folder/1.taxAssign/taxAssign.result", $species);
$cutchar = explode("\t", $species[0]);
$catch = $cutchar[0];
$replace_species = str_replace('_',' ',$catch);
//print($replace_species);


//判斷檔案大小
$file_size = filesize("./temp/$folder/3.abProfilesCmp/query_table.tsv");
//print("$file_size");


exec("cat ./temp/$folder/contigFile.list", $contigFile);
trim($contigFile);

?>

<title>result</title>
<script type="text/javascript">
$(document).ready(function() {
    var filesize = "<?php echo $file_size; ?>";

    if (filesize < 30) {

        $(".nav-tabs").addClass("lidisplay");
        $(".tab-content").addClass("lidisplay");
        swal("Result", "No resistance gene has been detected", "warning", {
            button: "OK",
        });
        var html =
            '<div class="row">' +
            '<label class="col-md-12">&nbsp;</label>' +
            '</div>' +
            '<div class="col-md-12">' +
            '<h3 style="font-weight: bolder; color:red;"><i class="bi bi-exclamation-triangle-fill"></i> No resistance gene has been detected</h3>' +
            '</div>';
        $("#divOther").append(html);
    }

});
</script>

<style>
.lidisplay {
    display: none;
}

@media screen and (max-width:415px) {

    /* iphone 螢幕*/
    #divScrollBar {
        width: 410px;
        overflow-x: auto;
    }

    /* #iframeHeatmap{
        height:600px;
    } */
}

.nav-link.active {
    background-color: lavenderblush !important;
    border-color: transparent transparent #865E6B !important;
    border-bottom: 3px solid;
    font-weight: bold;
}

.nav-link1.active {
    background-color: lavenderblush !important;
    border-color: transparent transparent #865E6B !important;
    border-bottom: 3px solid;
    font-weight: bold;
}

.nav-link2.active {
    background-color: #DEF5F1 !important;
    border-color: transparent transparent #29849A !important;
    border-bottom: 3px solid;
    font-weight: bold;
}

.nav-link3.active {
    background-color: #FEE7D1 !important;
    border-color: transparent transparent #F0883B !important;
    border-bottom: 3px solid;
    font-weight: bold;
}

@media screen and (min-width:480px) {
    /*pc螢幕*/

    #iframeTree {
        width: 650px;
        /*overflow-y: auto;
        overflow-x: hidden;*/
    }

    .hide-download-2 {
        display: none;
    }
}

@media screen and (max-width:1200px) {
    /*pad螢幕*/

    .hide-download-1 {
        display: none;
    }

    .hide-download-2 {
        display: block;
    }

}

.bi-diagram-3 {
    transform: rotate(45deg);
}
</style>


<div class="container">
    <!--Job ID-->
    <div class="row">
        <div class="col-md-2">
            <h5 style="font-weight: bolder; color:#B27400;"><i class="bi bi-check"></i> Job ID：</h5>
        </div>
        <div class="col-md-10">
            <h5><?php echo $folder; ?></h5>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <h5 style="font-weight: bolder; color:#B27400;"><i class="bi bi-check"></i> Genome file：</h5>
        </div>
        <div class="col-md-10">
            <h5><a href="./temp/<?php echo $folder ?>/contigFile.fa" download="<?php echo $contigFile[0]; ?>"><?php echo $contigFile[0]; ?></a></h5>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <h5 style="font-weight: bolder; color:#B27400;"><i class="bi bi-check"></i> Taxonomy：</h5>
        </div>
        <div class="col-md-10">
            <h5 style="font-style:italic;"><?php echo $replace_species ?></h5>
        </div>
    </div>
    <div class="row" id="divOther">
        <!--append Other-->
    </div>
    <br />
    <!--Job ID-->
    <!--標籤頁-->
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" id="li_query" role="presentation">
            <button class="nav-link nav-link1 active" id="tabQuery" data-bs-toggle="tab" data-bs-target="#divQuery"
                type="button" role="tab" style="color:purple;font-family:Verdana;" data-color="purple"><i
                    class="bi bi-folder-check"></i></i> Query</button>
        </li>
        <li class="nav-item" id="li_search" role="presentation">
            <button class="nav-link nav-link2" id="tabTable" data-bs-toggle="tab" data-bs-target="#divTable"
                type="button" role="tab" style="color:green;font-family:Verdana;" data-color="green"><i
                    class="bi bi-list-ul"></i> Search</button>
        </li>
        <li class="nav-item" id="li_antibiogram" role="presentation">
            <button class="nav-link nav-link2" id="tabHeatmap" data-bs-toggle="tab" data-bs-target="#divHeatMap"
                type="button" role="tab" style="color:green;font-family:Verdana;"><i class="bi bi-grid-3x3"></i>
                Antibiogram</button>
        </li>
        <li class="nav-item" id="li_map" role="presentation">
            <button class="nav-link nav-link2" id="tabMapbox" data-bs-toggle="tab" data-bs-target="#divMapbox"
                type="button" role="tab" style="color:green;font-family:Verdana;"><i class="bi bi-pin-map-fill"></i>
                Map</button>
        </li>
        <li class="nav-item" id="li_wg" role="presentation">
            <button class="nav-link nav-link3" id="tabMapbox" data-bs-toggle="tab" data-bs-target="#divTree"
                type="button" role="tab" style="color:orange;font-family:Verdana;"><i class="bi bi-diagram-3"></i>
                wgMLST</button>
        </li>
    </ul>
    <!--標籤頁-->
    <br>
    <!--內容-->
    <div class="tab-content" id="myTabContent">
        <!--Query內容-->
        <div class="tab-pane fade show active row" id="divQuery" role="tabpanel">
            <div class="row">
                <h4 class="col-md-11" style="font-weight: bolder">
                    <i class="bi bi-folder-check"></i></i> Resistance gene & Antibiotic
                </h4>

                <div class="col-md-1 justify-content-end">
                    <a href="https://nosoae.imst.nsysu.edu.tw/temp/<?php echo $folder; ?>/3.abProfilesCmp/query_table.tsv"
                        target="_blank" download="Query.tsv" class="hvr-wobble-vertical">
                        <img src="https://nosoae.imst.nsysu.edu.tw/images/cloud.png" width="45px" height="45px">
                    </a>
                </div>
            </div>
            <iframe src="https://nosoae.imst.nsysu.edu.tw/query_table.php?folder=<?php echo $folder; ?>"
                class="justify-content-center" height="800px" width="1000px" allowfullscreen>
            </iframe>
        </div>
        <!--Query內容-->
        <!--Table內容-->
        <div class="tab-pane fade show row" id="divTable" role="tabpanel">
            <div class="row">
                <h4 class="col-md-12" style="font-weight: bolder">
                    <i class="bi bi-list-ul"></i> Antibiogram Profile Search
                </h4>
            </div>
            <iframe src="https://nosoae.imst.nsysu.edu.tw/table.php?folder=<?php echo $folder; ?>"
                class="justify-content-center" height="800px" width="1000px" allowfullscreen></iframe>
            <br /><br /><br />
            <div class="row d-flex justify-content-center">
                <h4 class="col-md-12" style="font-weight: bolder">
                    <i class="bi bi-graph-up"></i> Statistical Significance
                </h4>
                <div class="col-md-6 d-flex justify-content-center">
                    <img src="temp/<?php echo $folder; ?>/3.abProfilesCmp/hits_hist_1.svg" width="550px"
                        class="img-fluid">
                </div>
                <div class="col-md-6 d-flex justify-content-center">
                    <img src="temp/<?php echo $folder; ?>/3.abProfilesCmp/hits_hist_2.svg" width="550px"
                        class="img-fluid">
                </div>
            </div>
            <br />
        </div>
        <!--Table內容-->
        <!--熱圖內容-->
        <div class="tab-pane fade row" id="divHeatMap" role="tabpanel">
            <div class="row">
                <h4 class="col-md-12" style="font-weight: bolder">
                    <i class="bi bi-grid-3x3"></i> Antibiogram HeatMap
                </h4>
            </div>
            <iframe src="https://nosoae.imst.nsysu.edu.tw/heatmap_iframe.php?folder=<?php echo $folder; ?>"
                class="justify-content-center" height="1000px" width="1400px" id="iframeHeatmap">
            </iframe>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-3">
                        <i class="bi bi-square-fill" style="color:#E3908C9B"></i> 1.Aminoglycoside
                    </div>
                    <div class="col-md-3">
                        <i class="bi bi-square-fill" style="color:#FFA5009B"></i> 2.Aminocyclitol
                    </div>
                    <div class="col-md-3">
                        <i class="bi bi-square-fill" style="color:#5CC0FF9B"></i> 3.Fluoroquinolone
                    </div>
                    <div class="col-md-3">
                        <i class="bi bi-square-fill" style="color:#0175809B"></i> 4.Beta-lactam
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <i class="bi bi-square-fill" style="color:#C99AE09B"></i> 5.Folate_pathway_antagonist
                    </div>
                    <div class="col-md-3">
                        <i class="bi bi-square-fill" style="color:#FF6C5C9B"></i> 6.Fosfomycin
                    </div>
                    <div class="col-md-3">
                        <i class="bi bi-square-fill" style="color:#415F949B"></i> 7.Glycopeptide
                    </div>
                    <div class="col-md-3">
                        <i class="bi bi-square-fill" style="color:#61E7869B"></i> 8.Lincosamide
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <i class="bi bi-square-fill" style="color:#E0C6639B"></i> 9.Streptogramin_A
                    </div>
                    <div class="col-md-3">
                        <i class="bi bi-square-fill" style="color:#E044449B"></i> 10.Pleuromutilin
                    </div>
                    <div class="col-md-3">
                        <i class="bi bi-square-fill" style="color:#529CE09B"></i> 11.Macrolide
                    </div>
                    <div class="col-md-3">
                        <i class="bi bi-square-fill" style="color:#E0721D9B"></i> 12.Tetracycline
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <i class="bi bi-square-fill" style="color:#8435949B"></i> 13.Phenicol
                    </div>
                    <div class="col-md-3">
                        <i class="bi bi-square-fill" style="color:#E07B689B"></i> 14.Rifamycin
                    </div>
                    <div class="col-md-3">
                        <i class="bi bi-square-fill" style="color:#274B949B"></i> 15.Streptogramin_B
                    </div>
                    <div class="col-md-3">
                        <i class="bi bi-square-fill" style="color:#8CE0669B"></i> 16.Oxazolidinone
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <i class="bi bi-square-fill" style="color:#944E2F9B"></i> 17.Polymyxin
                    </div>
                    <div class="col-md-3">
                        <i class="bi bi-square-fill" style="color:#F759CF9B"></i> 18.Steroid_antibacterial
                    </div>
                    <div class="col-md-3">
                        <i class="bi bi-square-fill" style="color:#65E4E49B"></i> 19.Pseudomonic_acid
                    </div>
                    <div class="col-md-3">
                        <i class="bi bi-square-fill" style="color:#CB00009B"></i> 20.Nitroimidazole
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <i class="bi bi-square-fill" style="color:#1627DB9B"></i> 21.Aldehyde
                    </div>
                    <div class="col-md-3">
                        <i class="bi bi-square-fill" style="color:#9994DE9B"></i> 22.QAC
                    </div>
                    <div class="col-md-3">
                        <i class="bi bi-square-fill" style="color:#8F79069B"></i> 23.Peroxide
                    </div>
                    <div class="col-md-3">
                        <i class="bi bi-square-fill" style="color:#8080809B"></i> 24.Heat
                    </div>
                </div>
                </br>
            </div>
        </div>
        <!--熱圖內容-->
        <!--MapBox內容-->
        <div class="tab-pane fade row" id="divMapbox" role="tabpanel">
            <div class="row">
                <h4 class="col-md-12" style="font-weight: bolder">
                    <i class="bi bi-pin-map-fill"></i> Geographical Distribution
                </h4>
            </div>
            <br />
            <iframe src="https://nosoae.imst.nsysu.edu.tw/map.php?folder=<?php echo $folder; ?>"
                style="border:0px #ffffff none;" name="myMapBox" scrolling="no" class="justify-content-center"
                height="800px" width="1000px" allowfullscreen>
            </iframe>
            <br />
            <br />
        </div>
        <!--MapBox內容-->
        <!--Tree內容-->
        <div class="tab-pane fade row" id="divTree" role="tabpanel">
            <div class="row">
                <h4 class="col-md-5 justify-conteny-start" style="font-weight: bolder">
                    <i class="bi bi-diagram-3-fill"></i> wgMLST
                </h4>
                <div class="col-md-1">
                    <!--Tree&下載(同一行)中間空格-->
                </div>
                <h4 class="col-md-5 justify-conteny-end hide-download-1" style="font-weight: bolder">
                    <i class="bi bi-file-earmark-arrow-down-fill"></i> Download
                </h4>
            </div>
            <div class="container-fluid">
                <div class="row justify-content-start">
                    <div class="col-md-5">
                        <!--TreePDF-->
                        <br />
                        <iframe src="https://nosoae.imst.nsysu.edu.tw/tree.php?folder=<?php echo $folder; ?>"
                            style="border:0px #ffffff none;" id="iframeTree" scrolling="no"
                            class="justify-content-center"height="820px" width="1200px" allowfullscreen>
                        </iframe>
                        <br />
                        <br />
                        <br />
                    </div>
                    <div class="col-md-1">
                        <!--Tree&下載(同一行)中間空格-->
                    </div>
                    <div class="col-md-5 hide-download-1">
                        <!--Tree下載(同一行)-->
                        <br />
                        <table class="table table-responsive">
                            <tbody>
                                <tr>
                                    <td>
                                        <li style="font-size:17px"><B>Locus list：</B></li>
                                    </td>
                                    <td><a href="./temp/<?php echo $folder; ?>/5.DendroPlot/locusmapping"
                                            target="_blank" style="text-decoration:none;color:#3498DB;"
                                            download="locus_list.tsv">locus_list.tsv</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <li style="font-size:17px"><B>Allele matrix：</B></li>
                                    </td>
                                    <td><a href="./temp/<?php echo $folder; ?>/5.DendroPlot/allele_profile.tsv"
                                            target="_blank" style="text-decoration:none;color:#3498DB;"
                                            download="allele_matrix.tsv">allele_matrix.tsv</a>
                                    </td>

                                </tr>
                                <tr>
                                    <td>
                                        <li style="font-size:17px"><B>Distance matrix：</B></li>
                                    </td>
                                    <td><a href="./temp/<?php echo $folder; ?>/5.DendroPlot/alleleDiff.0.matrix"
                                            target="_blank" style="text-decoration:none;color:#3498DB;"
                                            download="distance_matrix.tsv">distance_matrix.tsv</a>
                                    </td>

                                </tr>
                                <tr>
                                    <td>
                                        <li style="font-size:17px"><B>Dendrogram（newick）:</B></li>
                                    </td>
                                    <td><a href="./temp/<?php echo $folder; ?>/5.DendroPlot/NJtree_wgMLST.newick"
                                            target="_blank" style="text-decoration:none;color:#3498DB;"
                                            download="NJtree_wgMLST.newick">NJtree_wgMLST.newick</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <li style="font-size:17px"><B>Dendrogram（pdf）:</B></li>
                                    </td>
                                    <td><a href="./temp/<?php echo $folder; ?>/5.DendroPlot/NJtree_wgMLST.pdf"
                                            target="_blank" style="text-decoration:none;color:#3498DB;"
                                            download="NJtree_wgMLST.pdf">NJtree_wgMLST.pdf</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6 hide-download-2">
                        <!--Tree下載(下面)-->
                        <h4><i class="bi bi-file-earmark-arrow-down-fill"></i><B> Download</B></h4>
                        <br />
                        <table class="table table-responsive">
                            <tbody>
                                <tr>
                                    <td>
                                        <li style="font-size:17px"><B>Locus list：</B></li>
                                    </td>
                                    <td><a href="./temp/<?php echo $folder; ?>/5.DendroPlot/locusmapping"
                                            target="_blank" style="text-decoration:none;color:#3498DB;"
                                            download="locus_list.tsv">locus_list.tsv</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <li style="font-size:17px"><B>Allele matrix：</B></li>
                                    </td>
                                    <td><a href="./temp/<?php echo $folder; ?>/5.DendroPlot/allele_profile.tsv"
                                            target="_blank" style="text-decoration:none;color:#3498DB;"
                                            download="allele_matrix.tsv">allele_matrix.tsv</a>
                                    </td>

                                </tr>
                                <tr>
                                    <td>
                                        <li style="font-size:17px"><B>Distance matrix：</B></li>
                                    </td>
                                    <td><a href="./temp/<?php echo $folder; ?>/5.DendroPlot/alleleDiff.0.matrix"
                                            target="_blank" style="text-decoration:none;color:#3498DB;"
                                            download="distance_matrix.tsv">distance_matrix.tsv</a>
                                    </td>

                                </tr>
                                <tr>
                                    <td>
                                        <li style="font-size:17px"><B>Dendrogram（newick）:</B></li>
                                    </td>
                                    <td><a href="./temp/<?php echo $folder; ?>/5.DendroPlot/NJtree_wgMLST.newick"
                                            target="_blank" style="text-decoration:none;color:#3498DB;"
                                            download="NJtree_wgMLST.newick">NJtree_wgMLST.newick</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <li style="font-size:17px"><B>Dendrogram（pdf）:</B></li>
                                    </td>
                                    <td><a href="./temp/<?php echo $folder; ?>/5.DendroPlot/NJtree_wgMLST.pdf"
                                            target="_blank" style="text-decoration:none;color:#3498DB;"
                                            download="NJtree_wgMLST.pdf">NJtree_wgMLST.pdf</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--Tree內容-->
    </div>
    <!--內容-->
</div>
<?php
closetable();
?>
