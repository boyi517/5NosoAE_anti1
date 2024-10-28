<?php
error_reporting(0);
include("frame.php");

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

date_default_timezone_set('Asia/Taipei');
putenv("PATH=/home/chieh/antibiogram_platform/bin:/home/chieh/eggNOG/eggnog-mapper:/home/chieh/bin/ncbi-blast-2.8.1+/bin:/usr/local/bin:/usr/bin:/usr/local/sbin:/usr/sbin");

$pattern = "/^20\d{6}-[0-9a-zA-Z]{4}-[0-9a-zA-Z]{4}-[0-9a-zA-Z]{8}$/";
if (strlen($folder)!=0 && !preg_match_all($pattern, $folder)) {
        exit();
}

$pattern2 = "/^GC[AF]_[0-9]{9}(.\d)?$/";
if (strlen($txtOneGen)!=0 && !preg_match_all($pattern2, $txtOneGen)) {
        exit();
}


#echo $folder;

if(!(file_exists("./temp/$folder/run_antibiogram.out")) && ($txtOneGen != "")) {
	system("perl download-GenomeSeq.pl -i $txtOneGen -o ./temp/$folder");
}



if(!(file_exists("./temp/$folder/contigFile.fa"))&& ($txtOneGen == "")) {  //檢查使用者有沒有按upload =>跳回index  
      header('Location: index.php?fa=Nofa');
      exit();
}elseif(!(file_exists("./temp/$folder/contigFile.fa"))&& ($txtOneGen != "")){  //輸入錯誤的ID
    header('Location: index.php?fa=x');
    exit();
}



if(!(file_exists("./temp/$folder/run_antibiogram.out"))) {
	$sub_time = date("D M d H:i:s Y");

	$file=fopen("temp/$folder/mail","w");   //紀錄email
	fwrite($file, $address, 100);
	fclose($file);
	if(strlen($address) == 0) {
		$address = "none";
	}

    //$country="Australia";
    $file=fopen("temp/$folder/country","w");     //紀錄國家
	fwrite($file, $country, 100);
	fclose($file);
	if($country == "-1") {
		$country = "none";
	}

	exec("cat ./temp/$folder/contigFile.fa |tr -d '\r' > ./temp/$folder/contigFile.fa.1");
	exec("mv ./temp/$folder/contigFile.fa.1 ./temp/$folder/contigFile.fa");
	$req_time = 6;

	system("perl run_antibiogram-nosoAE.pl $folder $address > ./temp/$folder/run_antibiogram.out &");
}


if(file_exists("./temp/$folder/complete_ok")) {   //完成 =>跳到result
	$cur_time = date("D M d H:i:s Y");
	$run_time = strtotime($cur_time)-strtotime($sub_time)-28800;
	$run_time = date("H:i:s", $run_time);

	html_3($folder);
	print("</head></html>");

} else {    //還在跑...

	html_2($folder, $address, $sub_time, $req_time,$country,$txtOneGen);
	opentable();

	$cur_time = date("D M d H:i:s Y");
	$run_time = strtotime($cur_time)-strtotime($sub_time)-28800;
	$run_time = date("H:i:s", $run_time);
?>
<style>
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
        <h4 class="col-md-12 text-center title">
            5NosoAE: a web server for Nosocomial bacterial Antibiogram investigation and Epidemiology survey
            <img src="images/title2.png" height="50px" width="50px" />
        </h4>
    </div>
    <br />
    <div class="row">
        <div class="col-md-3" style="font-weight: bolder;font-size: x-large;">
            Status of job:
        </div>
        <div class="col-md-6" id="jobid" style="font-weight: bolder;font-size: x-large;">
            <?php echo $folder; ?>
        </div>
        <div class="col-3 justify-content-end">
            <button type="button" id="btnCopy" class="btn btn-outline-dark btn-sm" data-bs-toggle="tooltip"
                data-bs-placement="top" title="Copy to clipboard">Copy</button>
        </div>


    </div>
    <br />
    <div class="row">
        <div class="col-md-3">
            Submitted：
        </div>
        <div class="col-md-9">
            <?php echo $sub_time; ?>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-md-3">
            Time request：
        </div>
        <div class="col-md-9">
            about <?php echo $req_time; ?> minutes
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-md-3">
            Status：
        </div>
        <div class="col-md-9">
            <strong class="col-md-2" style="display:inline-block;vertical-align: top;">Running...</strong>
            <div class="col-md-3 spinner-border" role="status"></div>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-md-3">
            Last status change：
        </div>
        <div class="col-md-9">
            <?php echo $cur_time; ?>
        </div>
    </div>
    <br />
    <!-- <div class="row">
        <div class="col-md-12">
            See your <a href="run_antibiogram.php?folder=<?php echo $folder; ?>&address=<?php echo $address; ?>&sub_time=<?php echo $sub_time; ?>&req_time=<?php echo $req_time; ?>" style="text-decoration:none;">RESULTS</a> or <a href=""
                style="text-decoration:none;">DOWNLOAD</a> them
        </div>
    </div> -->
    <br />
    <div class="row alert alert-warning" role="alert">
        <div class="col-md-12">
            <h4 class="alert-heading" style="font-weight: bolder;text-decoration:underline;">Important</h4>
            <div class="row">
                <div class="col-md-12" style="color: black;">
                    <i class="bi bi-exclamation-lg" style="color: red;font-weight:bolder"></i> If you have not
                    provided an email address, please <B>bookmark</B> this page so you can access your
                    results later.
                    <!--  Alternatively, you can search by your <a href="index.php?search=search"  target="_blank"
                        style="text-decoration:none;" >Job
                        ID</a>. -->
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12" style="color: black;">
                    <i class="bi bi-check2" style="color: green;font-weight:bolder"></i> If you have specified an email
                    address, you will be notified once the job is complete.
                </div>
            </div>
        </div>
    </div>
</div>
<br />
<br />
<br />
<br />
<br />
<?php

	closetable2();
}
?>
