<?php
include("frame.php");
html_1();
opentable();
?>
<style>
body {
    background-color: #F7D6C8;
}

/* .switch {
    position: relative;
    display: inline-block;
    width: 50px;
    height: 24px;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
    border-radius: 34px;
}

.slider:before {
    position: absolute;
    content: "";
    height: 20px;
    width: 20px;
    left: 2px;
    top: 2px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
    border-radius: 50%;
}

input:checked+.slider {
    background-color: #ff8300;
}

input:checked+.slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
}*/
</style>


<html>

<body>
    <div class="container-fluid">
        <br />
        <div class="row">
            <h1 style="text-align: center; font-weight:bolder;color:#FFA600">User Guide</h1>
        </div>
        <br />
        <h5>Graphical Abstract</h5>
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Graphical Abstract
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="row justify-content-center">
                            <img src="./images/graphical_abstract.png" width="70%" height="70%" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br />
        <div class="accordion" id="accordionPanelsStayOpenExample">
            <!--according-->
            <h5>（I）QUERY</h5>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                        aria-controls="panelsStayOpen-collapseOne">
                        <B>1.1：Upload genome contig file</B>
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                    aria-labelledby="panelsStayOpen-headingOne">
                    <div class="accordion-body">
                        <p>Upload genome contig file</p>
                        <img src="./images/home.png" width="100%" />
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                        aria-controls="panelsStayOpen-collapseTwo">
                        <B>1.2：Results for existing job</B>
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse"
                    aria-labelledby="panelsStayOpen-headingTwo">
                    <div class="accordion-body">
                        <p>Results for existing job</p>
                        <img src="./images/jobid.png" width="100%" />
                    </div>
                </div>
            </div>
        </div>
        <br />
        <div class="accordion" id="accordionPanelsStayOpenExample">
            <h5>（II）RESULTS</h5>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
                        aria-controls="panelsStayOpen-collapseThree">
                        <B>2.1：Resistance genes & Antibiotics</B>
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse"
                    aria-labelledby="panelsStayOpen-headingThree">
                    <div class="accordion-body">
                        <p>Resistance genes & Antibiotics</p>
                        <img src="./images/query.png" width="100%" />
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false"
                        aria-controls="panelsStayOpen-collapseFour">
                        <B>2.2：Antimicrobial resistance profile search</B>
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse"
                    aria-labelledby="panelsStayOpen-headingFour">
                    <div class="accordion-body">
                        <p>Antimicrobial resistance profile search</p>
                        <img src="./images/search.png" width="100%" />
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingFive">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseFive" aria-expanded="false"
                        aria-controls="panelsStayOpen-collapseFive">
                        <B>2.3：Heatmap of antimicrobial resistance profiles</B>
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse"
                    aria-labelledby="panelsStayOpen-headingFive">
                    <div class="accordion-body">
                        <p>Heatmap of antimicrobial resistance profiles</p>
                        <img src="./images/antibiogram.png" width="100%" />
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingSix">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseSix" aria-expanded="false"
                        aria-controls="panelsStayOpen-collapseSix">
                        <B>2.4：Geographical distribution</B>
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseSix" class="accordion-collapse collapse"
                    aria-labelledby="panelsStayOpen-headingSix">
                    <div class="accordion-body">
                        <p>Geographical distribution</p>
                        <img src="./images/Geographical.png" width="100%" />
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingSeven">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseSeven" aria-expanded="false"
                        aria-controls="panelsStayOpen-collapseSeven">
                        <B>2.5：cgMLST analysis</B>
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseSeven" class="accordion-collapse collapse"
                    aria-labelledby="panelsStayOpen-headingSeven">
                    <div class="accordion-body">
                        <p>cgMLST analysis</p>
                        <img src="./images/cgmlst.png" width="100%" />
                    </div>
                </div>
            </div>
        </div>
        <!--according-->
        <br />
        <h5>（III）Browser compatibility</h5>
        <div class="table-responsive">
            <table class="table table-light table-striped table-hover">
                <thead class="table-warning">
                    <tr>
                        <th scope="col">OS</th>
                        <th scope="col">Version</th>
                        <th scope="col">Chrome</th>
                        <th scope="col">Firefox</th>
                        <th scope="col">Microsoft Edge</th>
                        <th scope="col">Safari</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Linux</th>
                        <td>CentOS 7</td>
                        <td>not tested</td>
                        <td>61.0</td>
                        <td>n/a</td>
                        <td>n/a</td>
                    </tr>
                    <tr>
                        <th scope="row">MacOS</th>
                        <td>Big Sur, High Sierra</td>
                        <td>96.0.4664.110</td>
                        <td>61.0</td>
                        <td>n/a</td>
                        <td>14.1.1, 13.1.2</td>
                    </tr>
                    <tr>
                        <th scope="row">Windows</th>
                        <td>10</td>
                        <td>96.0.4664.110</td>
                        <td>61.0</td>
                        <td>42.17134.1.0</td>
                        <td>n/a</td>
                    </tr>
            </table>
        </div>

    </div>

</body>
<br /><br />

</html>
<!--<div class="sticky-bottom" style="width:100%;position:absolute;left:0px">
    <div class="row justify-content-center">
        <div class="col-md-12 bg-dark">
            <br />
            <h6 class="text-center" style="color:white;">Copyright © 2021 Institute of Medical Science and
                Technology,
                National Sun Yat-sen University, Taiwan.</h6>
        </div>
    </div>
</div>-->
<?php
closetable();
?>