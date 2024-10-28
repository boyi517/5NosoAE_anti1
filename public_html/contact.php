<?php
include("frame.php");
html_1();
opentable();
?>
<style>
body {
    background-color: #ECE6CC;
}

.page {
    width: 500px;
    background: white;
    border: 20px solid #F1A3B6;
    border-radius: 20px;
    margin: auto;
    margin-top: 8%;
}

.header {
    font-family: Helvetica, Arial, sans-serif;
    font-size: 28px;
    color: #FFA600;
    font-weight: bold;
    margin: 40px 0 15px 0;
    display: inline-block;
}

.feedback-input {
    /*兩個輸入框 */
    font-family: Helvetica, Arial, sans-serif;
    color: #000000;
    font-size: 18px;
    line-height: 22px;
    padding: 10px;
    border: 1px solid white;
    border-bottom: 3px solid #F1A3B6;
    width: 90%;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    -ms-box-sizing: border-box;
    box-sizing: border-box;
}

.submit-button {
    font-family: Helvetica, Arial, sans-serif;
    cursor: pointer;
    background-color: white;
    color: #F1A3B6;
    font-size: 24px;
    margin: 25px 0 30px 0;
    padding: 10px 0;
    width: 130px;
    border: 2px solid #F1A3B6;
    border-radius: 25px;
    -webkit-transition: all 0.4s;
    -moz-transition: all 0.4s;
    transition: all 0.4s;
}

textarea {
    height: 180px;
    line-height: 150%;
}

.submit-button:hover {
    background-color: #A3F1AE;
    border: 2px solid #A3F1AE;
    color: #4EA45B;
    font-weight: 700;
}

.definition {
    font-family: Helvetica, Arial, sans-serif;
    font-size: 14px;
    padding: 10px;
    border: 10px solid #000000;
    border-radius: 10px;
    background: white;
    color: #9B9B9B;
    position: absolute;
}

.definition:after {
    content: ' ';
    position: absolute;
    width: 0;
    height: 0;
    left: 70%;
    top: 100px;
    border: 25px solid;
    border-color: #000000 transparent transparent #000000;
}

.name_def {
    width: 180px;
    top: 40%;
    left: 7%;
}

.email_def {
    width: 120px;
    top: 45%;
    left: 75%;
}

.message_def {
    width: 190px;
    top: 17%;
    left: 67%;
}

.feedback-input:focus {
    outline: none;
}

/* @media only screen and (max-width : 710px) {
    .name_def {
        left: 40%;
    }

    .email_def {
        left: 15%;
    }

    .message_def {
        left: 42%;
    }
} */

@media screen and (min-width:380px) and (max-width:444px) {

    /*螢幕在380~518之間*/
    .page {
        width: 400px;
        background: white;
        border: 20px solid #F1A3B6;
        border-radius: 20px;
        margin: auto;
        margin-top: 8%;
    }


}

@media screen and (min-width:445px) and (max-width:538px) {

    /*螢幕在380~518之間*/
    .page {
        width: 430px;
        background: white;
        border: 20px solid #F1A3B6;
        border-radius: 20px;
        margin: auto;
        margin-top: 8%;
    }


}

@media screen and (max-width:420px) {

    /*螢幕<420時*/
    .page {
        width: 350px;
        background: white;
        border: 20px solid #F1A3B6;
        border-radius: 20px;
        margin: auto;
        margin-top: 8%;
    }


}
</style>

<script>
$(".definition").hide();

function myFunction($myVar, $myVar_def) {
    $myVar.hover(function() {
        $myVar_def.show();
    }, function() {
        $myVar_def.hide();
    })
}

myFunction($(".name"), $(".name_def"));
myFunction($(".email"), $(".email_def"));
myFunction($(".message"), $(".message_def"));

// $(document).ready(function() {
//     function IsEmail(email) { //檢查是否為email格式

//         var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

//         if (!regex.test(email)) {

//             return false;

//         } else {

//             return true;

//         }

//     }

//     $("#btnSubmit").click(function() { //email_Check
//         if ($("#txtEmail").val() == "" && $("#txtMessage").val() == "") { //email 或 訊息 空值
//             swal("warning!", "Please enter your E-mail and Message!", "warning", {
//                 button: "OK"

//             });

//         } else if ($("#txtEmail").val() == "") {
//             swal.fire("warning!", "Please enter your E-mail !", "warning", {
//                 button: "OK"
//             });
//         } else if ($("#txtMessage").val() == "") {
//             swal("warning!", "Please enter the messages !", "warning", {
//                 button: "OK"
//             });
//         } else if ($("#txtEmail").val() !== "" && $("#txtMessage").val() !== "") { //email & 訊息 非空值

//             $Emailchecking = IsEmail($("#txtEmail").val()); //email格式錯誤
//             if ($Emailchecking == false) {
//                 swal("Error!", "Please check the e-mail format!", "error", {
//                     button: "OK"
//                 });
//                 $("#txtEmail").focus();
//             } else { //寄信

//                 function sendEmail() {
//                     var address = $("#txtEmail").val();
//                     var message = $("#txtMessage").val();
//                     Email.send({
//                         SecureToken: "16bab878-95e0-45a9-ac0b-2c3e6fdf641b",
//                         To: "julie41020@gmail.com", //chieh@mail.nsysu.edu.tw
//                         From: address,
//                         Subject: "ProbioMinDB_Contact",
//                         Body: message

//                     }).then(
//                         message => alert("已傳送"),
//                         function() {
//                             swal({
//                                 icon: "success",
//                                 title: "Success!",
//                                 text: "The e-mail has been sent!",
//                                 buttons: {
//                                     A: {
//                                         text: "OK",
//                                         value: "OK"
//                                     },
//                                 }
//                             });
//                         },
//                     );
//                 }
//                 sendEmail();
//             }
//         }

//     });
// });
</script>

</head>

<body>
    <div class="container page text-center">

        <div class="header"> CONTACT US </div>

        <form class="form" id="form">
            <input name="name" type="text" class="email feedback-input" placeholder="Your Email" id="txtEmail" />
            <textarea name="message" class="message feedback-input" placeholder="Message" id="txtMessage"></textarea>
            <input class="submit-button" type="submit" value="SUBMIT" id="btnSubmit">
        </form>
        <br />

    </div>
</body>

<!--EmailJS-->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>

<script type="text/javascript">
//emailjs UserID
emailjs.init("ncgIHbE3UJpNnqMgu");

$(document).ready(function() {
    function IsEmail(email) { //檢查是否為email格式

        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

        if (!regex.test(email)) {

            return false;

        } else {

            return true;

        }

    }

    $("#btnSubmit").click(function() { //email_Check
        if ($("#txtEmail").val() == "" && $("#txtMessage").val() == "") { //email 或 訊息 空值    
            swal("warning!", "Please enter your E-mail and Message!", "warning", {
                button: "OK"
            });
            return false;

        } else if ($("#txtEmail").val() == "") { //email 空值   
            swal("warning!", "Please enter your E-mail !", "warning", {
                button: "OK"
            });
            return false;

        } else if ($("#txtMessage").val() == "") { //訊息 空值   
            swal("warning!", "Please enter the messages !", "warning", {
                button: "OK"
            });
            return false;

        } else if ($("#txtEmail").val() !== "" && $("#txtMessage").val() !== "") { //email & 訊息 非空值

            $Emailchecking = IsEmail($("#txtEmail").val()); //email格式錯誤
            if ($Emailchecking == false) {
                swal("Error!", "Please check the e-mail format!", "error", {
                    button: "OK"
                });
                $("#txtEmail").focus();
                return false;

            } else { //寄信

                const btn = document.getElementById("btnSubmit");

                document
                    .getElementById("form")
                    .addEventListener("submit", function(event) {
                        event.preventDefault();

                        btn.value = "Sending...";

                        const serviceID = "service_64l40m2";
                        const templateID = "template_euzvxlo";

                        emailjs.sendForm(serviceID, templateID, this).then(
                            () => {
                                swal("Success!", "The e-mail has been sent!",
                                    "success", {
                                        button: "OK"
                                    });
                                btn.value = "SUBMIT";
                            },
                            (err) => {
                                btn.value = "Send Email";
                                alert(JSON.stringify(err));
                            }
                        );

                    });

            }
        }

    });
});
</script>
<?php
closetable2();
?>