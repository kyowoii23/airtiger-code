<?php
if(isset($_SESSION['id'])){
    echo "<script>location.href='./main.php';</script>";
    exit;
}
echo <<<END
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/login.css">
    <script src="../js/jq.js"></script>
    <link rel="shortcut icon" type="image" href="../img/logo_only_img.png">
    <title>Air Tiger login</title>
</head>

<body>
    <!--로그인창 배경화면-->
    <div id="login_back_ksg" class="login_back_ksg" minwidth="570px">
        <div class="login_bandbox_ksg"> <!--인풋 박스 묶어주는 박스-->
            <img src="../img/logo_txt_bottom.png" alt="로고 이미지">
            <form class="login_form_ksg" action="login.php" method="post">
                <input type="text" placeholder=" 아이디" class="login_id_ksg" name="id">
                <input type="password" placeholder=" 비밀번호" class="login_pw_ksg" name="pw">
                <p id="login_error_kkw" class='login_error_kkw'>* 아이디 또는 비밀번호가 일치하지 않습니다.</p>
                <canvas id="login_capcha_ksg" class="login_capcha_ksg"></canvas>
                <input type="text" maxlength = "4" class="login_capchainput_ksg">
                <input type="button" id="login_refresh_ksg" class="login_refresh_ksg" value="&#8635;">
                <p id="cap_error_kkw" class='cap_error_kkw'>* 아이디 및 비밀번호와 표시된 숫자를 정확하게 입력해주세요.</p>
                <input type="button" class="login_button_ksg" value="로그인">
                <div class="login_search_ksg">
                    <a class="login_searchid_ksg" href="./find_id.php?id='find_id'">아이디/비밀번호 찾기</a>
                </div>
                <a href="./signup.php" class="login_signup_ksg">회원가입</a>
            </form>
        </div>
    </div>
    <div class="login_fixed_info">
        <div id="login_fixed_admin" class="login_fixed_admin">admin</div>
        <div id="login_fixed_user" class="login_fixed_user">user01</div>
    </div>
    
    <script src="../js/airtiger2.js"></script>
    <script>
        displayNumber = (printNumber) => {
        const stLogCc = document.getElementById("login_capcha_ksg");
        const ctx = stLogCc.getContext("2d");
        
        ctx.font = "100px D2Coding";
        ctx.fillStyle = "#13264e";
        ctx.textAlign = "center";
        ctx.clearRect(0,0,stLogCc.width, stLogCc.height); // 값이 초기화 되는 상자
        ctx.fillText(printNumber, stLogCc.width/2, stLogCc.height/1.3);
        }

        generateRandomNumber = () => {
            const magicNumber = Math.floor(Math.random()*(9999-1000+1))+1000; // 랜덤숫자
            displayNumber(magicNumber);
            return magicNumber;
        }

        let randomNumber = generateRandomNumber(); 
        $("#login_refresh_ksg").on("click", function() { // 새로고침
            randomNumber = generateRandomNumber();
        });        
        
        $(".login_button_ksg").on("click", function(){
        const cap_check = /^[0-9]$/;
        let num = 0;
        if(randomNumber != $(".login_capchainput_ksg").val() && !cap_check.test($(".login_capchainput_ksg").val())){
            num = 1;
            $("#cap_error_kkw").css("visibility", "visible");
        }
        if( num == 0 ){
            $(".login_form_ksg").submit();
        }
        });
        $(".login_capchainput_ksg").focusin(function(){
            $("#cap_error_kkw").css("visibility", "hidden");
        });
        $(".login_id_ksg, .login_pw_ksg").focusin(function(){
            $("#login_error_kkw").css("visibility", "hidden");
        });

        $(".login_fixed_admin").on("click", function(){
            $(".login_id_ksg").val("admin");
            $(".login_pw_ksg").val(1234);
        });
        $(".login_fixed_user").on("click", function(){
            $(".login_id_ksg").val("user01");
            $(".login_pw_ksg").val(1234);
        });

    </script>
END;
if(isset($_GET["login"])){
    echo <<<END
    <script>
        if('{$_GET["login"]}'=="no"){
            $("#login_error_kkw").css("visibility", "visible");
        }
    </script>
END;
}    
echo <<<END
</body>
</html>
END;
?>
