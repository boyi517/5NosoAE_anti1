<?php
include("frame.php");
html_1();
opentable();
?>

<?php  
$countrytsv = array(); //國家
exec("cat ./z_lati_long_sort.tsv",$countrytsv);
$line_num = count($countrytsv);
for($i=1;$i<$line_num;$i++){
    $countrytsv[$i] = trim($countrytsv[$i]);
    $temp1 = array();
    $temp1 = explode("\t",$countrytsv[$i]);
    $country=$country."<option value='".$temp1[0]."'>".$temp1[0]."</option>";
    //print($country);

}
//$country="<option name='country'>AAA</option>";

date_default_timezone_set('Asia/Taipei');
$folder = date("Ymd-").randomkeys(4)."-".randomkeys(4)."-".randomkeys(8);
while(file_exists("temp/$folder")){
    $folder = date("Ymd-").randomkeys(4)."-".randomkeys(4)."-".randomkeys(8);
}
function randomkeys($length) {
    $key = "";
    $pattern = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    for($i=0;$i<$length;$i++){
        $key .= $pattern{rand(0,61)};
    }
    return $key;
}



//$folder_2 = date("Ymd_").randomkeys(5);   //產生日期資料夾  !!!移到index
//print($folder."<br>");
// session_start();
// $_SESSION['folder_2']=$folder_2;
// print($_SESSION['folder_2']);
$alert=$_GET['alert'];
$search=$_GET['search'];
$fa=$_GET['fa'];
$fa = trim(htmlentities($fa));  //修正XSS弱點
// $loading=$_GET['loading'];
// print($loading);
?>


<script>
$(document).ready(function() {

    //E-MAIL格式檢查

    $("body").on("change", "#txtEmail", function() {


    });

    function IsEmail(email) { //檢查是否為email格式

        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

        if (!regex.test(email)) {

            return false;

        } else {

            return true;

        }

    }

    // function sendEmail() {
    //     var address = $("#txtEmail").val();
    //     Email.send({
    //         SecureToken: "16bab878-95e0-45a9-ac0b-2c3e6fdf641b",
    //         To: address,
    //         From: "楊<karta101313@gmail.com>",
    //         Subject: "嗨!!",
    //         Body: "查看結果!!~~<br/><a href='result.php'"

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
    // }

    // $("#btnSend").click(function() {
    //     $("#btnSend").val("請等候一段時間..");
    //     $("#btnSend").attr("disabled", "disabled");
    //     sendEmail();
    // });

    /////////檔案大小
    // $("#folderinput").change(function() {
    //     $('#lblSize').remove();
    //     var fileinput, getfile;
    //     fileinput = document.getElementById('folderinput');
    //     getfile = fileinput.files[0];
    //     var Size = (getfile.size / 1024).toFixed(2); // 輸出結果為 2.45
    //     var htmlSize = "<label id='lblSize'>　File Size：" + Size + " KB</label>";
    //     $('#divSize').append(htmlSize);

    // });

    //chkOption
    // $("#ChkSpecies").click(function() { //菌種
    //     var checked = $("#ChkSpecies").prop("checked");
    //     if (checked) {
    //         $("#selectSpecies").removeAttr("disabled");
    //     } else {
    //         $("#selectSpecies").attr("disabled", "disabled");
    //         $("#selectSpecies").val("-1");
    //     }
    // });
    // $("#ChkCountry").click(function() { //國家
    //     var checked = $("#ChkCountry").prop("checked");
    //     if (checked) {
    //         $("#selectCountry").removeAttr("disabled");
    //     } else {
    //         $("#selectCountry").attr("disabled", "disabled");
    //         $("#selectCountry").val("-1");
    //     }
    // });

    //Submit
    // $("#btnSubmit").click(function() {
    //     //檢查
    //     if ($("#ChkSpecies").prop("checked") && $("#selectSpecies").val("-1")) {
    //         alert("Please select a species !");
    //         $("#selectSpecies").focus();
    //     }
    //     if ($("#ChkCountry").prop("checked") && $("#selectCountry").val("-1")) {
    //         alert("Please select a country !");
    //         $("#selectCountry").focus();
    //     }
    // });

    $("#btnLoadS").click(function() {
        $("#txtOneGen").val("GCA_019728755.1");
    });

    $("#btnSearch").click(function() {
        if ($("#txtJob").val() === "") {
            swal("Error!", "Please input the Job ID.", "error", {
                button: "OK"
            });
        } else {
            var value = $("#txtJob").val();
            location.href = "aaa.php?value=" + value;
        }
    });

    var nofile = "<?php echo $alert;?>";
    if (nofile != "") { //沒有資料夾存在
        swal("No file exists!", "Please check the Job ID.", "error", {
            button: "OK",
            value: "OK"
        }).then((value) => {
            location.href = "index.php";
        });

    }

    var search = "<?php echo $search;?>";
    if (search != "") { //尋找jobid    
        $("#tabJobs").addClass("active");
        $("#tabHome").removeClass("active");
        $("#divJobs").addClass("show active");
        $("#divHome").removeClass("show active");
        $("#tabHome").click(function() {
            location.href = "index.php";
        });
    }
    var fa = "<?php echo $fa;?>";
    if (fa == "Nofa") { //檔案沒按上傳 btn
        swal("Error!", 'Please click the "Upload" button before submission.', "error", {
            button: "OK",
            value: "OK"
        }).then((value) => {
            location.href = "index.php";
        });
    } else if (fa == "x") { //輸入錯誤的ID
        swal("Error!", 'Please check the GenBank assembly accession before submission.', "error", {
            button: "OK",
            value: "OK"
        }).then((value) => {
            location.href = "index.php";
        });
    }
    $("#btnSubmit").click(function() {
        //檔案上傳防呆
        var file = $(".file-caption-name").prop("title"); //抓Upload的檔名
        if ($("#txtOneGen").val() == "" && file == "") { //無檔案=>跳提醒
            swal("Warning", "Please upload a file or input a GenBank assembly accession.", "warning", {
                button: "OK",
                value: "OK"
            }).then((value) => {
                location.href = "index.php";
            });
            return false;
        } else if ($("#txtOneGen").val() !== "" && file !== "") { //兩者都有檔案=>跳提醒
            swal("Warning", "Please upload a file or input a GenBank assembly accession.", "warning", {
                button: "OK",
                value: "OK"
            }).then((value) => {
                location.href = "index.php";
            });
            return false;
        } else if ($("#txtOneGen").val() == "" && file !== "") { //判斷為Upload檔案
            var type = $(".file-caption-name").prop("title"); //判斷fa或fna檔案  
            var fileformat = type.split('.').pop(); //抓出最後一個"."之後的檔案格式
            //alert("OK");
            //ValidateFileSize();
            // if (fileformat == "fa" || fileformat == "fna" || fileformat == "FNA" || fileformat ==
            //     "FA" || fileformat == "fas" || fileformat == "fasta" || fileformat == "seq" ||
            //     fileformat == "fsa" || fileformat == "txt") {
            //     alert(fileformat);
            //     return true;
            // } else {
            //     swal("Warning", "Please upload a file in FASTA format.", "warning", {
            //         button: "OK",
            //         value: "OK"
            //     }).then((value) => {
            //         location.href = "index.php";
            //     });
            //     alert(fileformat);
            //     return false;
            // }


        } //else if ($("#txtOneGen").val() !== "" && file == "") { //只有輸入id
        //     var str = $("#txtOneGen").val();
        //     var a = str.length;
        //     if (a < 15) { //好像是15
        //         swal("Warning", "Please check the Genbank ID before submission.", "warning", {
        //             button: "OK",
        //             value: "OK"
        //         }).then((value) => {
        //             location.href = "index.php";
        //         });
        //         return false;
        //     }

        // }

        //email_Check
        $Emailchecking = IsEmail($("#txtEmail").val());
        if ($("#txtEmail").val() == "" && ($("#txtOneGen").val() !== "" || file !== "")) {
            return true;
        } else if ($Emailchecking == false) {
            swal("Error!", "Please enter a correct E-mail address.", "error", {
                button: "OK"
            }).then((value) => {
                //location.href = "index.php";
                $("#txtEmail").val("");
                $("#txtEmail").focus(); //焦點
            });
            return false;

            // alert("請填寫正確的E-MAIL格式");

            // swal({
            //     icon: "success",
            //     title: "完成",
            //     text: "已傳送至您的信箱!",
            //     buttons: {
            //         A: {
            //             text: "OK",
            //             value: "OK"
            //         },
            //     }
            // });


        }

    });
    ///檢查檔案格式
    function ValidateFileSize() {
        if (window.FileReader && window.Blob) {
            var type = this.files[0].type.split("/");
            if (
                type[1] == "png" ||
                type[1] == "pdf" ||
                type[1] == "jpeg" ||
                type[1] == "jpg"

            ) {
                swal("Warning", "Please upload a file in FASTA format.", "warning", { //亂上傳檔案 => 擋掉
                    button: "OK",
                    value: "OK"
                }).then((value) => {
                    location.href = "index.php";
                });
                return false;
            } else { //檔案格式正確

                return true;
            }
        } else {
            // File and Blob are not supported
        }
    }
    $('input[type="file"]').change(ValidateFileSize);

}); ////document
</script>
<style>
.nav-link.active {
    background-color: aliceblue !important;
    border-color: transparent transparent #567091 !important;
    border-bottom: 3px solid;
    font-weight: bold;
}

.nav-link1.active {
    background-color: aliceblue !important;
    border-color: transparent transparent #567091 !important;
    border-bottom: 3px solid;
    font-weight: bold;
}

.title {
    padding: 1rem 2rem;
    color: #2D3538;
    background: #F2E8DD;
    -webkit-box-shadow: 5px 5px 0 #003270;
    box-shadow: 5px 5px 0 #003270;
    font-weight: bolder;
}
</style>
<div class="container">
    <div class="row justify-content-center">
        <h4 id="h4" class="col-md-12 text-center title animated bounceInDown slow">
            <lable id="lbltitle">5NosoAE: a web server for Nosocomial bacterial Antibiogram investigation and
                Epidemiology
                survey
                <img src="images/title2.png" height="50px" width="45px" />
            </lable>
        </h4>
    </div>
    <br />
    <ul class="nav nav-tabs">
        <li class="nav-item" role="presentation">
            <!--                    <a class="nav-link active" href="index.php">Nucleotide input</a> -->
            <button class="nav-link active" id="tabHome" data-bs-toggle="tab" data-bs-target="#divHome" type="button"
                role="tab" style="color:blue;font-family:Verdana;"><i class="bi bi-folder"></i>
                Submit job
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <!--                    <a class="nav-link" href="">Results for existing job</a> -->
            <button class="nav-link" id="tabJobs" data-bs-toggle="tab" data-bs-target="#divJobs" type="button"
                role="tab" style="color:blue;font-family:Verdana;"><i class="bi bi-search"></i> Results for existing
                job</button>
        </li>
    </ul>
    <br />


    <div class="tab-content" id="myTabContent">
        <!--Input內容!-->
        <div class="tab-pane fade show active" id="divHome" role="tabpanel">
            <!-- <div class="row">
                <div class="col-md-6">
                    <button type="button" id="botton1" class="btn btn-outline-secondary btn-sm mb-1"
                        onclick="fill_id('GCA_000018445.1')">Load sample input</button>
                    <button type="button" id="botton2" class="btn btn-outline-secondary btn-sm mb-1"
                        onclick="window.location='result.php?folder=20211206-aLRM-lR49-lkfu7Ytz';">Sample Output 1</button>
                    <button type="button" id="botton3" class="btn btn-outline-secondary btn-sm mb-1"
                        onclick="window.location='result.php?folder=20211129-sm9W-paSf-bdTiYQ9B';">Sample Output 2</button>
                </div>
            </div> -->
            <form id="fileupload" action="loadingPage.php" method="POST">
                <input type="hidden" name="folder" value="<?php echo $folder;?>">
                <!--填寫email-->
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <label class="input-group-text alert-primary" for="txtEmail">E-mail</label>
                            <input type='text' id='txtEmail' name='address' class='form-control'
                                placeholder='your.email@example.com' value="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="bi bi-exclamation-circle-fill"> Email address (optional)</label>
                    </div>
                </div>
                <!--填寫email-->
                <br />
                <!--上傳檔案-->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">

                            <!--<input id="file" class="file" multiple type="file" name="file" data-theme="fas" data-show-preview="true"> -->
                            <!-- 初始化插件 -->
                            <input id="file" class="file" multiple type="file" name="file" data-show-preview="false">

                            <!--<input id="input-b2" name="input-b2" type="file" class="file" data-show-preview="false">
                            <input type="file" id='fileinput' class='form-control' value="">-->

                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="bi bi-exclamation-circle-fill"> Upload complete or draft genome in FASTA format
                            (*.fa, *.fna, *.fasta) </label>
                    </div>

                </div>
                <!--上傳檔案-->
                <br />
                <!--上傳一個菌株-->
                <div class="row">
                    <div class="col-md-6">
                        <input type='text' id='txtOneGen' name='txtOneGen' class='form-control' placeholder='GCA_#####'
                            value="">
                    </div>
                    <div class="col-md-6">
                        <label class="">or input a GenBank assembly accession </label>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col-md-3">
                        <button type="button" id="btnLoadS" class="btn btn-outline-secondary btn-sm">
                            Load sample input
                        </button>
                    </div>
                </div>
                <!--上傳一個菌株-->

                <hr />
                <!--Option-->
                <div class="row">
                    <div class="col-md-12" style="font-weight:bolder;">Option：</div>
                </div>
                <!--Option-->

                <br />
                <!--國家-->
                <div class="row">
                    <div class="col-md-6">
                        <!-- <div class="col-md-4" style="font-weight:bolder;">
                            <label for="selectCountry">Geographical location</label>
                        </div> -->
                        <select id="selectCountry" name='country' class="form-select form-select-md">
                            <option selected value="-1">Please select a country...</option>
                            <?php echo $country; ?>
                        </select>

                    </div>
                    <div class="col-md-6">
                        <label class="bi bi-exclamation-circle-fill"> Geographical location (optional)</label>
                    </div>
                </div>
                <!--國家-->
                <!--Option-->
                <hr />

                <div class="alert alert-warning" role="alert">
                    <button type="submit" name="Submit" value="SUBMIT" class="btn btn-primary"
                        id="btnSubmit">Submit</button>
                </div>

            </form>
        </div>


        <!--Jobs內容-->
        <div class="tab-pane fade" id="divJobs" role="tabpanel">
            <br />
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group">
                        <label class="input-group-text alert-primary" for="txtJob">Job ID</label>
                        <input type='text' id='txtJob' class='form-control' placeholder='YYYYMMDD-aaaa-bbbb-cccccccc'
                            value="">
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="bi bi-exclamation-circle-fill"> Search results for an existing job</label>
                </div>
            </div>

            <hr />

            <div class="alert alert-warning" role="alert">
                <input type="button" class="btn btn-primary" id="btnSearch" value="Search" />
            </div>
            <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /><br /><br /><br /><br />
        </div>

    </div>

</div>
<?php
closetable2();
?>

<script>
$("#file").fileinput({
    language: 'en', //語言設定
    uploadUrl: 'upload.php', //上傳地址
    theme: 'explorer-fas',
    minFileCount: 1,
    maxFileCount: 1,
    maxFileSize: 20480, //KB
    overwriteInitial: false,
    showRemove: false,
    uploadExtraData: {
        'folderID': '<?php echo $folder;?>'
    }
});
</script>
