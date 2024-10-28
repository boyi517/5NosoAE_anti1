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

//抓菌種
$species = array();
exec("cat ./temp/$folder/1.taxAssign/taxAssign.result", $species);
$cutchar = explode("\t", $species[0]);
$catch = $cutchar[0];
//print($catch);


//bacteria_information
$profile = array();
exec("cat ./temp/$folder/3.abProfilesCmp/hits_table.tsv", $profile);
$line_num = count($profile);
for($i=1;$i<$line_num;$i++){
$profile[$i] = trim($profile[$i]);
$temp = array();
$temp = explode("\t",$profile[$i]);
//print("<td>".$temp[0]."</td>"."<td>".$temp[1]."</td>"."<td>".$temp[2]."</td>"."<td>".$temp[3]."</td>"."<td>".$temp[4]."</td>");
//$rmsd = sprintf('%.3f',$temp[8]);
//$cos = sprintf('%.5f',$temp[9]);
$GCA = substr($temp[1],0,3);
//print($GCA);

//other菌=> NO Allelic distance
if($catch == "Acinetobacter_baumannii"||$catch == "Pseudomonas_aeruginosa"||$catch == "Klebsiella_pneumoniae"||$catch == "Enterococcus_faecium"||$catch == "Staphylococcus_aureus"){
    //print("YES");
    $rmsd = sprintf('%.3f',$temp[8]);
    $cos = sprintf('%.5f',$temp[9]);
     //判斷GCA&GCF
     if($GCA=="GCA"||$GCA=="GCF"){
        $AS="<a href='https://www.ncbi.nlm.nih.gov/assembly/".$temp[1]."'target='_blank'>".$temp[1]."</a>";
    }
    else{
        $AS="<a href='https://www.ncbi.nlm.nih.gov/sra/?term=".$temp[1]."'target='_blank'>".$temp[1]."</a>";
    }
    $table =$table. "<tr class='th-class' height='20'><td class='text-center'>".$i."</td><td>".$AS."</td>"."<td><I>".$temp[2]."</I></td>"."<td><a href='https://www.ncbi.nlm.nih.gov/biosample/?term=".$temp[3]."'target='_blank'>".$temp[3]."</a></td>"."<td>".$temp[4]."</td>"."<td>".$temp[5]."</td>"."<td><I>".$temp[6]."</I></td><td>".$temp[7]."</td><td>".$rmsd."</td>"."<td>".$cos."</td></tr>";   
}else{
    //print("NO");
    $no_Allelic="noallelic";
    $rmsd = sprintf('%.3f',$temp[7]);
    $cos = sprintf('%.5f',$temp[8]);
    //判斷GCA&GCF
    if($GCA=="GCA"||$GCA=="GCF"){
        $AS="<a href='https://www.ncbi.nlm.nih.gov/assembly/".$temp[1]."'target='_blank'>".$temp[1]."</a>";
    }
    else{
        $AS="<a href='https://www.ncbi.nlm.nih.gov/sra/?term=".$temp[1]."'target='_blank'>".$temp[1]."</a>";
    }
    $table =$table. "<tr class='th-class' height='20'><td class='text-center'>".$i."</td><td>".$AS."</td>"."<td><I>".$temp[2]."</I></td>"."<td><a href='https://www.ncbi.nlm.nih.gov/biosample/?term=".$temp[3]."'target='_blank'>".$temp[3]."</a></td>"."<td>".$temp[4]."</td>"."<td>".$temp[5]."</td>"."<td><I>".$temp[6]."</I><td>".$rmsd."</td>"."<td>".$cos."</td></tr>";
 }
}
?>



<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="http://lib.sinaapp.com/js/jquery/1.7.2/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.1/dist/umd/popper.min.js"></script>
    <!--引用jQuery-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <!--引用dataTables.js-->
    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
    <link href="css/hover-min.css" rel="stylesheet" />
    <!--引用css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" />
    <title>Document</title>

    <script type="text/javascript">
    $(document).ready(function() {
        $("#AD").tooltip();
        $("#CD").tooltip();
        $("#GL").tooltip();
        $("#SPRO").tooltip();
        $("#value").tooltip();

        var noallelic = "<?php echo $no_Allelic;?>";

        if (noallelic == "noallelic") { //  不要畫出Allelic表格  
            $("#AD").remove();
        }
        /* Get the HTML data using Element by Id */
        var table = document.getElementById("myDataTalbe");

        $("#myDataTalbe").DataTable({
            searching: true, //關閉filter功能
            columnDefs: [{
                targets: [3],
                orderable: true,
            }]
        });
    });
    </script>

    <style>
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

        height: 30px;

        box-sizing: border-box;

    }

    table {
        border-collapse: collapse;
        /*table-layout: fixed;*/
        /*註解的意思是可以跟著表格的內容來去決定他的寬度 */
        width: 100%;
        /* 固定寬度 */

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

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="d-flex mb-1">
                <div class="me-auto p-3">
                    <!--<h5 style="font-weight: bolder"><?php echo $catch ?></h5>-->
                </div>
                <div>
                    <a href="https://nosoae.imst.nsysu.edu.tw/temp/<?php echo $folder; ?>/3.abProfilesCmp/hits_table.tsv"
                        target="_blank" download="Antibiogram search.tsv" class="hvr-wobble-vertical">
                        <img src="https://nosoae.imst.nsysu.edu.tw/images/cloud.png" width="45px" height="45px">
                    </a>
                    &nbsp;
                </div>
            </div>
        </div>

        <div class="div_class table-responsive">
            <table id="myDataTalbe" class="table table-striped table-hover table-bordered">
                <thead class="table-warning">
                    <tr>
                        <th scope="col" class='text-center'>Rank</th>
                        <th scope="col">Genome_ID</th>
                        <th scope="col">Organism</th>
                        <th scope="col">BioSample_ID</th>
                        <th scope="col" data-bs-toggle="tooltip" data-bs-placement="top" title="Collection date"
                            id="CD">Date</th>
                        <th scope="col" data-bs-toggle="tooltip" data-bs-placement="top" title="Geographical location"
                            id="GL">
                            Location</th>
                        <th scope="col">Host</th>
                        <th scope="col" data-bs-toggle="tooltip" data-bs-placement="top" title="cgMLST allelic distance"
                            id="AD">
                            Allelic distance</th>
                        <th scope="col" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Similarity of antimicrobial resistance profiles" id="SPRO">
                            Similarity score(<I>S</I><sub>PRO</sub>)</th>
                        <th scope="col" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="A p-value of 0.05 or lower is generally considered statistically significant." id="value"><I>p</I>-value</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
          echo $table;
    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
