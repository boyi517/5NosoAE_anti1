<?php
error_reporting(0);
include("frame.php");
html_1();
opentable();

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

<div class="container">
    <br />
    <br />
    <div class="row justify-content-center">
        <div class="card border-0">
            <div class="card-body row">
                <div class="col-lg-7">
                    <img src="./images/graphical_abstract.png" class="card-img-top img-fluid"
                        style="width:100%;height:100%">
                </div>
                <div class="col-lg-5 text-dark">
                    </br>
                    <h2 class="card-title"><label class="fw-bolder pb-2 hvr-grow"
                            style="border-bottom:5px solid #F58578;font-family:Verdana;">About</label>
                    </h2>
                    </br>
                    <div class="card-text fs-5 p-4" style="background-color:#F1FDE9; border-radius: 10px;">5NosoAE is a
                        web-based tool that allows users to perform large-scale strain searches according to
                        antimicrobial resistance profiles and visualize epidemiological information including the
                        spatiotemporal distribution, antibiogram heatmap, and phylogeny of identified strains.</div>
                    </br>
                </div>
            </div>
            <ul class="list-group list-group-flush">
                <!-- <li class="list-group-item"><i class="bi bi-quote"></i> <a href="https://academic.oup.com/nar/article/50/W1/W21/6593106?searchresult=1"  class="fs-5"style="text-decoration:none;color:#3498DB;" target="_blank"><I>Nucleic Acids Research</I>, Volume 50, Issue W1, 5 July 2022, Pages W21–W28</a></li> -->
                <h2 class="card-title"><label class="fw-bolder pb-2 ms-4 hvr-grow"
                        style="border-bottom:5px solid #F58578;font-family:Verdana;">Cite</label></h2>
                <li class="list-group-item px-4  fs-5"><i class="bi bi-quote"></i>
                    <B>5NosoAE: a web server for nosocomial bacterial antibiogram investigation and epidemiology
                        survey</B><br />
                    Chih-Chieh Chen, Yen-Yi Liu, Ya-Chu Yang, Chu-Yi Hsu<br />
                    <I>Nucleic Acids Research</I>, Volume 50, Issue W1, 5 July 2022, Pages W21–W28<br />
                    <a href="https://academic.oup.com/nar/article/50/W1/W21/6593106"
                        style="text-decoration:none;color:#3498DB;" target="_blank"
                        class="hvr-icon-forward">doi.org：10.1093/nar/gkac423
                        <i class="fa fa-chevron-circle-right hvr-icon"
                            style="text-decoration:none;color:gray;cursor: default;"></i>
                    </a>

                </li>
                <!-- <li class="list-group-item">A second item</li>
                <li class="list-group-item">A third item</li> -->
            </ul>
            <div class="card-body">
                <!-- <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a> -->
            </div>
        </div>
    </div>
</div>
<br />
<br />
<br />
<br />
<?php

	closetable();

?>