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


//bacteria_information
$profile = array();
$folder=$_GET["folder"];
exec("cat ./temp/$folder/3.abProfilesCmp/query_table.tsv", $profile);
$line_num = count($profile);
$temp_header = explode("\t",$profile[0]);
$column_num = count($temp_header);
for($i=0;$i<$line_num;$i++){
    //$profile[$i] = trim($profile[$i]); //delet
    $temp = array();
    $temp = explode("\t",$profile[$i]);
    //$column_num = count($temp);
    if($i==0){
        for ($j = 0; $j < $column_num; $j++) { 
            $x_label = $temp[$j];
            //$num=substr($x_label , 0 , ".");
            //$num_string = explode(".", $x_label[0]);
            //$num = $num_string[0];
            $num = (int) filter_var($x_label, FILTER_SANITIZE_NUMBER_INT);  
            $row_title =$row_title. "<th class='th-class' data-num='".$num."' data-bs-toggle='tooltip' data-bs-placement='bottom' title='?'><span>".$x_label."</span></th>";
        }
    }else {
        $column_title="";
        $column_title2="";
        $rmsd = sprintf('%.2f',$temp[1]);
        $column_title2 ="<tr style='vertical-align: middle;'><td class='table-warning text-center' style='font-size: 12px;'><B>".$temp[0]."<B></td><td class='table-warning text-center' style='font-size: 12px;'><B>".$rmsd."</B></td>";
        for($k=2;$k<$column_num;$k++){
            
            $column_title = $column_title."<td class='td-ok text-center' data-ok='".$temp[$k]."'><label class='lbl-".$temp[$k]."'>".$temp[$k]."</label></td>";

        }
        $column_title3 =$column_title3.$column_title2.$column_title."</tr>";
    }
    
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/jquery-3.3.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.1/dist/umd/popper.min.js"></script>
    <link href="css/hover-min.css" rel="stylesheet" />
    <title>Query_table</title>
    <style>
    /*title_rotate */
    .th-class span {

        writing-mode: vertical-rl;
        transform: rotate(180deg);
        text-align: left;

    }

    /*title_rotate */

    /*置頂&置左 */
    .div_class {

        overflow: auto;

        height: 700px;
        /* 固定高度 */
        border-bottom: 0;
        border-right: 0;

    }

    td,
    th {

        /* border-right: 1px solid gray;
        border-bottom: 1px solid gray; */

        width: 58px;

        height: 30px;

        box-sizing: border-box;

    }

    table {
        border-collapse: separate;
        table-layout: fixed;
        width: 100%;
        /* 固定寬度 */

    }

    td:first-child,
    th:first-child {

        position: sticky;

        left: 0;
        /* 首行在左 */

        z-index: 1;

    }

    thead tr th {

        position: sticky;

        top: 0;
        /* 第一列最上 */

    }

    th:first-child {

        z-index: 2;

    }

    /*置頂&置左 */
    </style>


    <script>
    $(document).ready(function() {
        $(".th-class").tooltip();
        $.each($(".th-class"), function(i, e) { //判斷分類上色      
            var num = $(this).data("num");
            if (num == 1) {
                $(this).css("background-color", "#E3908C9B");
                $(this).attr("data-bs-original-title", "Aminoglycoside");
            } else if (num == 2) {
                $(this).css("background-color", "#FFA5009B");
                $(this).attr("data-bs-original-title", "Aminocyclitol");
            } else if (num == 3) {
                $(this).css("background-color", "#5CC0FF9B");
                $(this).attr("data-bs-original-title", "Fluoroquinolone");
            } else if (num == 4) {
                $(this).css("background-color", "#0175809B");
                $(this).attr("data-bs-original-title", "Beta-lactam");
            } else if (num == 5) {
                $(this).css("background-color", "#C99AE09B");
                $(this).attr("data-bs-original-title", "Folate_pathway_antagonist");
            } else if (num == 6) {
                $(this).css("background-color", "#FF6C5C9B");
                $(this).attr("data-bs-original-title", "Fosfomycin");
            } else if (num == 7) {
                $(this).css("background-color", "#415F949B");
                $(this).attr("data-bs-original-title", "Glycopeptide");
            } else if (num == 8) {
                $(this).css("background-color", "#61E7869B");
                $(this).attr("data-bs-original-title", "Lincosamide");
            } else if (num == 9) {
                $(this).css("background-color", "#E0C6639B");
                $(this).attr("data-bs-original-title", "Streptogramin_A");
            } else if (num == 10) {
                $(this).css("background-color", "#E044449B");
                $(this).attr("data-bs-original-title", "Pleuromutilin");
            } else if (num == 11) {
                $(this).css("background-color", "#529CE09B");
                $(this).attr("data-bs-original-title", "Macrolide");
            } else if (num == 12) {
                $(this).css("background-color", "#E0721D9B");
                $(this).attr("data-bs-original-title", "Tetracycline");
            } else if (num == 13) {
                $(this).css("background-color", "#8435949B");
                $(this).attr("data-bs-original-title", "Phenicol");
            } else if (num == 14) {
                $(this).css("background-color", "#E07B689B");
                $(this).attr("data-bs-original-title", "Rifamycin");
            } else if (num == 15) {
                $(this).css("background-color", "#274B949B");
                $(this).attr("data-bs-original-title", "Streptogramin_B");
            } else if (num == 16) {
                $(this).css("background-color", "#8CE0669B");
                $(this).attr("data-bs-original-title", "Oxazolidinone");
            } else if (num == 17) {
                $(this).css("background-color", "#944E2F9B");
                $(this).attr("data-bs-original-title", "Polymyxin");
            } else if (num == 18) {
                $(this).css("background-color", "#F759CF9B");
                $(this).attr("data-bs-original-title", "Steroid_antibacterial");
            } else if (num == 19) {
                $(this).css("background-color", "#65E4E49B");
                $(this).attr("data-bs-original-title", "Pseudomonic_acid");
            } else if (num == 20) {
                $(this).css("background-color", "#CB00009B");
                $(this).attr("data-bs-original-title", "Nitroimidazole");
            } else if (num == 21) {
                $(this).css("background-color", "#1627DB9B");
                $(this).attr("data-bs-original-title", "Aldehyde");
            } else if (num == 22) {
                $(this).css("background-color", "#9994DE9B");
                $(this).attr("data-bs-original-title", "Quaternary_ammonium_compound");
            } else if (num == 23) {
                $(this).css("background-color", "#8F79069B");
                $(this).attr("data-bs-original-title", "Peroxide");
            } else if (num == 24) {
                $(this).css("background-color", "#8080809B");
                $(this).attr("data-bs-original-title", "Heat");
            } else if (num == 0) {
                $(this).addClass("table-warning");
                $(this).removeAttr("data-bs-toggle"); ///Title
                $(this).removeAttr("data-bs-placement");
                $(this).removeAttr("data-bs-original-title");
                $(this).removeAttr("data-bs-title");
            }


        });
        $.each($(".td-ok"), function(i, e) { //判斷分類上色      
            var ok = $(this).data("ok");
            if (ok == "V") { //打勾
                $(".lbl-V").css("display", "none");
                html = "<img src='images/V.png' width='30' height='30'/>"
                $(this).append(html);
            } else if (ok == "X") { //打叉
                $(".lbl-X").css("display", "none");
            }


        });

        // if ($(".th-class").html() == "Similarity") {
        //     alert("cfes");
        //     //$(this).css("background-color","red");
        // }
    });
    </script>
</head>

<body>
    <div class="container-fluid">
        
        <div class="row">
            <div class="d-flex mb-1">
                <div class="me-auto p-3">
                    <!--<h5 style="font-weight: bolder"><?php echo $catch ?></h5>-->
                </div>
                <div>
                    <a href="https://nosoae.imst.nsysu.edu.tw/temp/<?php echo $folder; ?>/3.abProfilesCmp/query_table.tsv"
                        target="_blank" download="Query.tsv" class="hvr-wobble-vertical">
                        <img src="https://nosoae.imst.nsysu.edu.tw/images/cloud.png" width="45px" height="45px">
                    </a>
                    &nbsp;
                </div>
            </div>
        </div>
        <br />

        <div class="div_class table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <!--Class分類-->
                        <?php echo $row_title; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $column_title3; ?>
                </tbody>
            </table>
        </div>

    </div>
</body>

</html>