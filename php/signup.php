<?php
    session_start();
    include "../inc/imp_db.inc";
    function db_open( $host_db, $account_db, $password_db, $name_db){
        //DB접속
        ($db_handler = mysqli_connect("$host_db", "$account_db", "$password_db", "$name_db"))
        || print "<script>alert(\"DB 연결 실패\"); location.href=\"./login.php\";</script>";
        //Use DB
        !mysqli_select_db($db_handler, $name_db)
        && print "<script>alert(\"DB 선택 실패\"); location.href=\"./login.php\";</script>";
        return $db_handler;
    }
    @$check_query = "SELECT * FROM `tiger_login` WHERE `id`= '{$_GET['id']}'";    
    $ok_handler = db_open( $db_host, $db_account, $db_password, $db_dbname);    
        if(isset($_GET['id'])){
            $result_check = mysqli_query($ok_handler, $check_query);
            if(mysqli_num_rows($result_check) != 0){
                echo false;
                exit;
            } else {
                if(preg_match("/^[a-zA-Z0-9]{6,15}$/",$_GET['id'])){
                    echo true;
                } else {
                    echo false;
                    exit;
                }
            }
        }
    if(isset($_POST['id'])){
        function sign_up($db_handler, $etc_query){
            $db_put = mysqli_query($db_handler, $etc_query);
            if($db_put === false ){
                echo mysqli_error($db_handler);
            } else {
                echo "<script>location.href=\"./signup.php?signup=ok\";</script>";
            }
        }
        $pw_md = md5($_POST['pw']);
        $add_query = "INSERT `tiger_login` SET `id` = '{$_POST['id']}', `pwd`='{$pw_md}',`name`= '{$_POST['name']}', `birth`='{$_POST['birth']}', `tel`='{$_POST['phone']}', `name_en`='{$_POST['name_en']}', `sex`='{$_POST['sex']}', `country`='{$_POST['from']}', `address`='{$_POST['address']}', `mail`='{$_POST['email']}'";"INSERT `tiger_login` SET `id` = '{$_POST['id']}', `pwd`='{$pw_md}',`name`= '{$_POST['name']}', `birth`='{$_POST['birth']}', `tel`='{$_POST['phone']}', `name_en`='{$_POST['name_en']}', `sex`='{$_POST['sex']}', `country`='{$_POST['from']}', `address`='{$_POST['address']}', `mail`='{$_POST['email']}'";"INSERT `tiger_login` SET `id` = '{$_POST['id']}', `pwd`='{$pw_md}',`name`= '{$_POST['name']}', `birth`='{$_POST['birth']}', `tel`='{$_POST['phone']}', `name_en`='{$_POST['name_en']}', `sex`='{$_POST['sex']}', `country`='{$_POST['from']}', `address`='{$_POST['address']}', `mail`='{$_POST['email']}'";
        sign_up($ok_handler, $add_query);
    }
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/signup.css">
    <title>회원가입</title>
    <script src="../js/jq.js"></script>
    <link rel="shortcut icon" type="image" href="../img/logo_only_img.png">
</head>
<body>
        <!--로그인창 배경화면-->
        <div id="signup_back_ksg" class="signup_back_ksg" minwidth="560px">
                <div class="signup_logo_ksg"><img src="../img/logo_txt_bottom.png" alt="로고 이미지"></div>
                <h1>회원가입</h1>
                <p>*모든 항목 필수 입력해주세요</p>
                <form class="signup_form_ksg" id="signup_form_ksg" action="./signup.php" method="post">
                    <p class="signup_id_txt_ksg">아이디</p>
                    <input type="text" placeholder=" 아이디" id="signup_id_ksg" class="signup_id_ksg" class="signup_id_ksg" name="id" required>
                    <input type="button" value="중복확인" class="signup_id_button_ksg" required>
                    <input id="signup_id_check_ksg" type="hidden" required>
                    <p class="signup_id_check">* 사용 가능합니다.</p>
                    <p class="signup_pw_txt_ksg">비밀번호</p>
                    <input type="password" name="pw" placeholder=" 비밀번호" id="signup_pw_ksg" class="signup_pw_ksg" required>
                    <p class="signup_pw_check">* 사용 가능합니다.</p>
                    <p class="signup_replay_txt_ksg" name="replay">비밀번호 재확인</p>
                    <input type="password" placeholder=" 비밀번호 확인" id="signup_replay_ksg" class="signup_replay_ksg" required>
                    <p class="signup_replay_check">* 사용 가능합니다.</p>
                    <p class="signup_name_txt_ksg">이름</p>
                    <input type="text" name="name" placeholder=" 이름" id="signup_name_ksg" class="signup_name_ksg" required>
                    <input type="button" class="signup_man_button_ksg" value="남">
                    <input type="button" class="signup_woman_button_ksg" value="여">
                    <p class="signup_name_check">* 사용 가능합니다.</p>
                    <p class="signup_nameen_txt_ksg">영문 이름</p>
                    <input type="text" name="name_en" placeholder=" 영문이름" id="signup_nameen_ksg" class="signup_nameen_ksg" required>
                    <p class="signup_nameen_check">* 사용 가능합니다.</p>
                    <input id="signup_sex_check" type="hidden" name="sex" required>
                    <p class="signup_birth_txt_ksg">생년월일</p>
                    <input type="date" id="signup_birth_ksg" class="signup_birth_ksg" name="birth" required>
                    <p class="signup_birth_check">* 사용 가능합니다.</p>
                    <p class="signup_from_txt_ksg">국적</p>
                    <input type="text" name="from" placeholder=" 영문 국적" id="signup_from_ksg"  class="signup_from_ksg" required>
                    <p class="signup_from_check">* 사용 가능합니다.</p>
                    <p class="signup_phone_txt_ksg">연락처</p>
                    <input type="text" placeholder=" 연락처를 '-'를 포함하여 입력" id="signup_phone_ksg" class="signup_phone_ksg" name="phone" required>
                    <p class="signup_phone_check">* 사용 가능합니다.</p>
                    <p class="signup_email_txt_ksg">이메일</p>
                    <input type="email" placeholder=" 이메일" id="signup_email_ksg" class="signup_email_ksg" name="email" required>
                    <p class="signup_email_check">* 사용 가능합니다.</p>
                    <p class="signup_address_txt_ksg">주소</p>
                    <input type="address" placeholder=" 주소" id="signup_address_ksg" class="signup_address_ksg" name="address" required>
                    <p class="signup_address_check">* 사용 가능합니다.</p>
                    <input type="button" value="가입완료" id="signup_button_ksg" class="signup_button_ksg" name="signup_button_ksg">
                    <a class="signup_cancle_ksg" href="./login.php">취소</a>
                </form>
        </div>
        <div class="pop_up">
            <img src="../img/small_logo.png" alt="small">
            <div>가입 완료되었습니다.</div>
            <a id="x_box" href="./login.php">확인</a>
        </div>
    <script src="../js/airtiger2.js"></script>
    <script>
        if("<?=@$_GET['signup']?>" =='ok'){
            $(".pop_up").css("display", "block");
        }
        function getFormatDate(date){
            var year = date.getFullYear();              //yyyy
            var month = (1 + date.getMonth());          //M
            month = month >= 10 ? month : '0' + month;  //month 두자리로 저장
            var day = date.getDate();                   //d
            day = day >= 10 ? day : '0' + day;          //day 두자리로 저장
            return  year + '-' + month + '-' + day;       //'-' 추가하여 yyyy-mm-dd 형태 생성 가능
        }
        var date = new Date();
        date = getFormatDate(date);
        $("#signup_birth_ksg").attr("max", date);   
        console.log(date);
    </script>
    </body>
</html>