<!DOCTYPE html>

<?php
function html_1() {
    print("<html lang='en' xmlns='http://www.w3.org/1999/xhtml'><head>");
//  print("<html><head>");
}

function html_2($folder, $address, $sub_time, $req_time,$country,$txtOneGen) {
    print("<html><head>");
    print("<meta http-equiv='refresh' content='5; url=loadingPage.php?folder=$folder&address=$address&sub_time=$sub_time&req_time=$req_time&country=$country&txtOneGen=$txtOneGen'>");
}
function html_3($folder) {
    print("<html><head>");
    print("<meta http-equiv='refresh' content='0; url=result.php?folder=$folder'>");
}
function html_4($value) {
    print("<html><head>");
    print("<meta http-equiv='refresh' content='0; url=result.php?folder=$value'>");
}
function html_5($alert) {
    print("<html><head>");
    print("<meta http-equiv='refresh' content='0; url=index.php?alert=$alert'>");
}
function html_6($value, $address, $sub_time, $req_time) {
    print("<html><head>");
    print("<meta http-equiv='refresh' content='0; url=loadingPage.php?folder=$value&address=$address&sub_time=$sub_time&req_time=$req_time'>");
}
function html_7($loading) {
    print("<html><head>");
    print("<meta http-equiv='refresh' content='0; url=loadingPage.php?loading=$loading'>");
}
?>

<?php
function opentable() {
?>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta charset="utf-8" name="viewport" content="width=device-width,initial-scale=1;charset=utf-8;" />
<title>5NosoAE</title>
<!--bootstap-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<!--sweet第一版-->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!--bootstap icon-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
<!--fontawesome icon-->
<link href="//maxcdn.bootstrapcdn.com/font-awesome/6.2.0/css/font-awesome.min.css" rel="stylesheet" media="all">
<!--bootstap 彈跳js-->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.1/dist/umd/popper.min.js"></script>
<!--js-->
<script src="js/jquery-3.3.1.min.js"></script>
<!--hover 動畫-->
<link href="css/hover-min.css" rel="stylesheet" />
<!--上傳 upload file-->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" crossorigin="anonymous">
<link href="./kartik-v-bootstrap/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="./kartik-v-bootstrap/themes/explorer-fas/theme.css">
<script src="./kartik-v-bootstrap/js/plugins/sortable.js" type="text/javascript"></script>
<script src="./kartik-v-bootstrap/js/fileinput.js" type="text/javascript"></script>
<script src="./kartik-v-bootstrap/js/locales/zh-TW.js" type="text/javascript"></script>
<script src="./kartik-v-bootstrap/themes/explorer-fas/theme.js" type="text/javascript"></script>
<script src="./kartik-v-bootstrap/themes/fas/theme.js" type="text/javascript"></script>
<!--hightchart-->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/heatmap.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<!--動畫-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
<script>
$(document).ready(function() {
    //E-MAIL格式檢查
    // $("body").on("change", "#txtEmail", function() {
    //     $Emailchecking = IsEmail($("#txtEmail").val());
    //     if ($Emailchecking == false) {
    //         alert("請填寫正確的E-MAIL格式");
    //         $("#txtEmail").blur(); //離開焦點
    //     }
    // })

    // function IsEmail(email) { //檢查是否為email格式
    //     var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    //     if (!regex.test(email)) {
    //         return false;
    //     } else {
    //         return true;
    //     }
    // }

    // function sendEmail() {
    //     var address = $("#txtEmail").val();
    //     Email.send({
    //         SecureToken: "16bab878-95e0-45a9-ac0b-2c3e6fdf641b",
    //         To: address,
    //         From: "楊<karta101313@gmail.com>",
    //         Subject: "嗨!!",
    //         Body: "寄信程式測試~~~您已成功了!!~~<br/>哈哈哈<br/> <input type='button' id='btnSend' class='btn btn-outline-dark' value=" +
    //             "沒有用ㄉ按鈕^_^" + "> "

    //     }).then(
    //         /* message => alert("已傳送"),*/
    //         function() {
    //             swal({
    //                 icon: "success",
    //                 title: "完成",
    //                 text: "已傳送至您的信箱!",
    //                 buttons: {
    //                     A: {
    //                         text: "OK",
    //                         value: "OK"
    //                     },
    //                 }
    //             }).then((value) => {
    //                 $("#btnSend").val("傳送");
    //                 $("#btnSend").removeAttr("disabled", "disabled");
    //             });
    //         },
    //     );
}

$("#btnSend").click(function() {
    $("#btnSend").val("請等候一段時間..");
    $("#btnSend").attr("disabled", "disabled");
    //                sendEmail();
});

$("#fileinput").change(function() {
    $('#lblSize').remove();
    var fileinput, getfile;
    fileinput = document.getElementById('fileinput');
    getfile = fileinput.files[0];
    var Size = (getfile.size / 1024).toFixed(2); // 輸出結果為 2.45
    var htmlSize = "<label id='lblSize'>　File Size：" + Size + " KB</label>";
    $('#divSize').append(htmlSize);

});


});

function fill_id(id) {
    var id = id;
    document.getElementById("txtOneGen").value = id;
}
</script>

<script>
$(document).ready(function() {
    $("#btnCopy").tooltip();

    $("#btnCopy").click(function() {
        $("#btnCopy").attr('data-bs-original-title', 'Copied!').tooltip("show");
        var jobid = document.getElementById('jobid');
        window.getSelection().selectAllChildren(jobid);
        document.execCommand("Copy");
        //alert("已复制好，可贴粘。");
    });
    $('#btnCopy').on('shown.bs.tooltip', function() {
        $("#btnCopy").attr('data-bs-original-title', 'Copy to clipboard');
    });

    /////固定footer
    var footerHeight = 0;
    var footerTop = 0;
    var $footer = $(".footer");
    positionFooter();

    function positionFooter() {
        footerHeight = $footer.height();
        footerTop =
            $(window).scrollTop() + $(window).height() - footerHeight + "px";
        if ($(document.body).height() + footerHeight < $(window).height()) {
            $footer
                .css({
                    position: "absolute",
                })
            // .stop()
            // .animate({
            //     top: footerTop,
            // });
        } else {
            $footer.css({
                position: "static",
            });
        }
    }

    $(window).scroll(positionFooter).resize(positionFooter);
});
</script>

</head>
<style>
.zoom {
    transform: scale(1.5);
    margin-left: 20px;
    margin-bottom: 4px;
}

.zoom:hover {
    transform: scale(1.6);
}

.footer {
    width: 100%;
    height: 5%;
    position: absolute;
    bottom: 0;
    left: 0;
    /* background: #ee5; */
}
</style>

<body>
    <!--主板-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand zoom" href="index.php"><img src="images/logo2.png" width="75" height="30"
                    class="animated fadeInLeft slow" /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a id="btnHome" class="nav-link" aria-current="page" href="index.php"><i
                                class="bi bi-house-door-fill"></i> Home</a>
                        <!--有需要可以加active-->
                    </li>
                    <li class="nav-item">
                        <a id="btnStatistics" class="nav-link" href="statistics.php"><i
                                class="bi bi-bar-chart-line-fill"></i> Database</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-bookmark-check-fill"></i> Sample output
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="result.php?folder=20220418-zVFF-FdsL-ogj0Zs8K">Sample
                                    output 1</a></li>
                            <li><a class="dropdown-item" href="result.php?folder=20220418-sqVk-xmeL-yo4uQHUc">Sample
                                    output 2</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a id="btnHelp" class="nav-link" href="help.php"><i class="bi bi-question-square-fill"></i>
                            Help</a>
                    </li>
                    <li class="nav-item">
                        <a id="btnArtical" class="nav-link" href="artical.php"><i class="bi bi-book-half"></i>
                            About</a>
                    </li>
                    <li class="nav-item">
                        <a id="btnContact" class="nav-link" href="contact.php"><i class="bi bi-envelope-fill"></i>
                            Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <br />

        <?php
}
function closetable(){
?>

    </div>
</body>

</html>

<div class="sticky-bottom footer">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12 bg-dark">
                <br />
                <h6 class="text-center" style="color:white;">Copyright © 2022 Institute of Medical Science and
                    Technology,
                    National Sun Yat-sen University, Taiwan.</h6>
            </div>
        </div>
    </div>
</div>

<?php
}
function closetable2(){
?>

</div>
</body>

</html>
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<div class="sticky-bottom footer">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12 bg-dark">
                <br />
                <h6 class="text-center" style="color:white;">Copyright © 2022 Institute of Medical Science and
                    Technology,
                    National Sun Yat-sen University, Taiwan.</h6>
            </div>
        </div>
    </div>
</div>

<?php
    }
 ?>