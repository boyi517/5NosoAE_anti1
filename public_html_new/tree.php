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

$folder=$_GET["folder"];
?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/jquery-3.3.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <title>Document</title>
</head>

<body>
    <!--<iframe src="temp/<?php echo $folder; ?>/5.DendroPlot/NJtree_wgMLST.pdf#view=FitH&scrollbar=0&toolbar=0&statusbar=0&messages=0&navpanes=0" width="550px" height="800px"></iframe>-->
    <img src="temp/<?php echo $folder; ?>/5.DendroPlot/dendrogram_cgMLST.svg" class="img-fluid"  width="520px"/>
</body>

</html>
