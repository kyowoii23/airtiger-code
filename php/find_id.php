<?php
if(isset($_GET['find1'])){
    include "../inc/imp_db.inc";
    $ok_handler = mysqli_connect($db_host, $db_account, $db_password, $db_dbname);
    if(!$ok_handler){
        echo "오류낫다 고쳐라";
    }
    $checkAdminQuery = isset($_GET['find4']) ? "SELECT * FROM `tiger_login` where `name` = '{$_GET['find1']}' AND `tel` = '{$_GET['find2']}' AND `mail` = '{$_GET['find3']}' AND `id` = '{$_GET['find4']}'" : "SELECT * FROM `tiger_login` where `name` = '{$_GET['find1']}' AND `tel` = '{$_GET['find2']}' AND `mail` = '{$_GET['find3']}'";
    
    $db_content = mysqli_query($ok_handler,$checkAdminQuery);
    
        
    

    if(!$db_content) {
        echo "<script>alert('No admin query');</script>";
    }
    
    if(mysqli_num_rows($db_content)!=0){
        $test_info = mysqli_fetch_assoc($db_content);
        echo $test_info["id"];
    } else {
        echo false;
    }
}
@$pw_change = md5($_POST['find_pw_pw']);
@$checkPwQuery = "UPDATE `tiger_login` set pwd = '{$pw_change}' where id = '{$_POST['change_pw']}'";
if(isset($_GET["search"])){
    include "../inc/imp_db.inc";
    $ok_handler = mysqli_connect($db_host, $db_account, $db_password, $db_dbname);
    if(!$ok_handler){
        echo "오류낫다 고쳐라";
    }
    $pw_update = mysqli_query($ok_handler, $checkPwQuery);
    if(!$pw_update){
        echo "<script>alert('No update query');</script>";
    } else {
        echo "<script>location.href='./find_id.php?pw=ok';</script>";
    }
}
if(isset($_GET['id'])){
    echo <<< END
    <!DOCTYPE html>
    <html lang="ko">
    <head>
        <meta charset="UTF-8">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../css/find_id.css">
        <script src="../js/jq.js"></script>
        <link rel="shortcut icon" type="image" href="../img/logo_only_img.png">
        <title>아이디/비밀번호 찾기</title>
    </head>
    <body>
        <!--로그인창 배경화면-->
        <div id="find_id_back_kkw" class="find_id_back_kkw" minwidth="570px">
            <!-- <div id="find_id_logo_kkw" class="find_id_logo_kkw"><img src="../img/logo_txt_bottom.png" alt="로고 이미지"></div> -->
            <div class="find_id_bandbox_kkw" style="display:block"> <!--인풋 박스 묶어주는 박스-->
                <div class="tab_menu">
                    <li>아이디 찾기</li>
                    <li>비밀번호 찾기</li>
                </div>
                <p class="find_id_notice">가입 시 등록했던 회원 정보를 입력해주세요.</p>
                
                <div class="find_id_form_kkw">
                    <p class="find_id_id_txt_kkw">이름</p>
                    <input type="text" placeholder=" 이름을 입력해주세요." id="find_id_name" class="find_id_id_kkw" name="find_id_name">
                    <p class="find_id_pw_txt_kkw">연락처</p>
                    <input type="text" placeholder=" 연락처를 입력해주세요." id="find_id_tel" class="find_id_pw_kkw" name="find_id_tel">
                    <p class="find_id_pw_txt_kkw">이메일</p>
                    <input type="text" placeholder=" 이메일을 입력해주세요." id="find_id_email" class="find_id_pw_kkw" name="find_id_email">
                    <p id="find_id_check"></p>
                    <input type="button" id="find_id_button" class="find_id_button_kkw" value="찾기">
                    <p class="find_id_result"></p>
                </div>
                <a href="./login.php" class="find_id_signup_kkw">로그인 하러 가기 &gt;</a>
            </div>

            <div class="find_pw_bandbox_kkw" style="display:none"> <!--인풋 박스 묶어주는 박스-->
                <div class="tab_menu">
                    <li>아이디 찾기</li>
                    <li>비밀번호 찾기</li>
                </div>
                <p class="find_id_notice">가입 시 등록했던 회원 정보를 입력해주세요.</p>
                
                <div class="find_id_form_kkw">
                    <p class="find_id_id_txt_kkw">아이디</p>
                    <input type="text" placeholder=" 아이디를 입력해주세요." id="find_pw_id" class="find_id_id_kkw" name="find_pw_id">
                    <p class="find_id_pw_txt_kkw">이름</p>
                    <input type="text" placeholder=" 이름을 입력해주세요." id="find_pw_name" class="find_id_pw_kkw" name="find_pw_name">
                    <p class="find_id_pw_txt_kkw">연락처</p>
                    <input type="text" placeholder=" 연락처를 입력해주세요." id="find_pw_tel" class="find_id_pw_kkw" name="find_pw_tel">
                    <p class="find_id_pw_txt_kkw">이메일</p>
                    <input type="text" placeholder=" 이메일을 입력해주세요." id="find_pw_email" class="find_id_pw_kkw" name="find_pw_email">
                    <p id="find_pw_check"></p>
                    <input type="button" id="find_pw_button" class="find_id_button_kkw" value="찾기">
                    <p id="find_pw_result" class="find_id_result"></p>
                </div>
                <form class="find_pw_form_kkw" action="./find_id.php?search=ok" method="post">
                    <input type="hidden" name="change_pw" id="change_pw">
                    <p class="find_pw1_txt_kkw">비밀번호</p>
                    <input type="password" placeholder=" 변경할 비밀번호를 입력해주세요." class="find_pw1_pw_kkw" name="find_pw_pw">
                    <p id="find_new_pw_check">* 영문 대소문자, 숫자, 특수문자 조합 4~20자 이내로 입력하세요.</p>
                    <p class="find_pw2_txt_kkw">비밀번호 재입력</p>
                    <input type="password" placeholder=" 비밀번호를 다시 입력해주세요." class="find_pw2_pw_kkw" name="find_pw_pw_re">
                    <p id="find_new_pw_replay_check">* 비밀번호가 일치하지 않습니다.</p>
                    <input type="button" class="find_pw_button_kkw" value="변경">
                </form>
            </div>
            
        </div>
    <div class="pop_up">
        <img src="../img/small_logo.png" alt="small">
        <div>비밀번호가 변경되었습니다.</div>
        <input type="button" id="x_box" value="닫기">
    </div>
        <script>
            $(".find_pw_button_kkw").on("click", function(){
                const pw_check = /^[a-zA-Z0-9\@\!\#]{4,20}$/;
                if( !pw_check.test($(".find_pw1_pw_kkw").val()) || $(".find_pw1_pw_kkw").val() == "" || $(".find_pw2_pw_kkw").val() == "" ){
                    $("#find_new_pw_check").css("visibility", "visible");
                    $(".find_pw1_pw_kkw").css("border", "1px solid red");
                    $(".find_pw2_pw_kkw").css("border", "1px solid red");
                    $(".find_pw1_pw_kkw").val("");
                    $(".find_pw2_pw_kkw").val("");
                } else if( $(".find_pw1_pw_kkw").val() == $(".find_pw2_pw_kkw").val() ){
                    $(".find_pw_form_kkw").submit();
                } else {
                    $("#find_new_pw_replay_check").css("visibility", "visible");
                    $(".find_pw1_pw_kkw").css("border", "1px solid red");
                    $(".find_pw2_pw_kkw").css("border", "1px solid red");
                    $(".find_pw1_pw_kkw").val("");
                    $(".find_pw2_pw_kkw").val("");
                }
            })
            $(".find_pw_form_kkw").on("focusin", function(e){
                $(e.target).css("border", "none");
                $("#find_new_pw_check").css("visibility", "hidden");
                $("#find_new_pw_replay_check").css("visibility", "hidden");
            });
    
            $("li:nth-child(1)").on("click", function(){
                $(".find_pw_form_kkw").css("display", "none");
                $(".find_pw_bandbox_kkw").css("display", "none");
                $(".find_id_bandbox_kkw").css("display", "block");
            });
            $("li:nth-child(2)").on("click", function(){
                $(".find_id_result").css("display", "none");
                $(".find_id_bandbox_kkw").css("display", "none");
                $(".find_pw_bandbox_kkw").css("display", "block");
            });


            // 아이디 찾기 정규식 및 submit 이벤트
            $('#find_id_button').on("click", function(){
                const id_check = /^[a-zA-Z0-9]{6,15}$/;
                const tel_check = /^01(?:0|1|[6-9])-(?:\d{3}|\d{4})-\d{4}$/;
                const name_check = /[a-z0-9]|[ \[\]{}()<>]/g;
                const email_check = /^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*.[a-zA-Z]{2,3}$/i;
                let idx = 0;
                if( name_check.test($("#find_id_name").val()) || $("#find_id_name").val() == "" ){
                    idx = 1;
                    $("#find_id_name").css("border", "1px solid red").val("");
                    $("#find_id_check").html("* 한글 이름을 입력해주세요.");
                }
                if( !tel_check.test($("#find_id_tel").val()) || $("#find_id_tel").val() == ""){
                    idx = 1;
                    $("#find_id_tel").css("border", "1px solid red").val("");
                    $("#find_id_check").html("* 휴대폰 번호를 숫자와 '-'를 포함하여 정확하게 입력해주세요.");
                }
                if( !email_check.test($("#find_id_email").val()) || $("#find_id_email").val() == ""){
                    idx = 1;
                    $("#find_id_email").css("border", "1px solid red").val("");
                    $("#find_id_check").html("* 이메일 주소를 정확하게 입력해주세요.");
                }
                if( idx == 0 ){
                    $.ajax({
                    url:'./find_id.php?find1='+$("#find_id_name").val()+"&find2="+$("#find_id_tel").val()+"&find3="+$("#find_id_email").val(),
                    type : "GET",
                    success:function(data){
                        console.log(data);
                        const result_check = data == false ? "등록되지 않은 정보입니다." : "아이디는 " +data+ "입니다.";
                        $(".find_id_result").html(result_check);
                        }
                    });
                }
            });
            reset_hidden =(id, cls)=>{
                $("#"+id).focusin(function(){
                $("#"+cls).html("");
                $("#"+id ).css("border", "1px solid lightgrey");
                });
            }
            reset_hidden("find_id_name", "find_id_check");
            reset_hidden("find_id_tel", "find_id_check");
            reset_hidden("find_id_email", "find_id_check");


            

            // 비밀번호 찾기 정규식 및 이벤트
            $('#find_pw_button').on("click", function(){
                const id_check = /^[a-zA-Z0-9]{6,15}$/;
                const tel_check = /^01(?:0|1|[6-9])-(?:\d{3}|\d{4})-\d{4}$/;
                const name_check = /[a-z0-9]|[ \[\]{}()<>]/g;
                const email_check = /^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*.[a-zA-Z]{2,3}$/i;
                let idx = 0;
                if( !id_check.test($("#find_pw_id").val()) || $("#find_pw_id").val() == ""){
                    idx = 1;
                    $("#find_pw_id").css("border", "1px solid red").val("");
                    $("#find_pw_check").html("* 영문 대소문자, 숫자 조합 6~15자 이내로 입력하세요.");
                }
                if( name_check.test($("#find_pw_name").val()) || $("#find_pw_name").val() == "" ){
                    idx = 1;
                    $("#find_pw_name").css("border", "1px solid red").val("");
                    $("#find_pw_check").html("* 한글 이름을 입력해주세요.");
                }
                if( !tel_check.test($("#find_pw_tel").val()) || $("#find_pw_tel").val() == ""){
                    idx = 1;
                    $("#find_pw_tel").css("border", "1px solid red").val("");
                    $("#find_pw_check").html("* 휴대폰 번호를 숫자와 '-'를 포함하여 정확하게 입력해주세요.");
                }
                if( !email_check.test($("#find_pw_email").val()) || $("#find_pw_email").val() == ""){
                    idx = 1;
                    $("#find_pw_email").css("border", "1px solid red").val("");
                    $("#find_pw_check").html("* 이메일 주소를 정확하게 입력해주세요.");
                }
                if( idx == 0 ){
                    $("#change_pw").val($("#find_pw_id").val());
                        $.ajax({
                            url:'./find_id.php?find1='+$("#find_pw_name").val()+"&find2="+$("#find_pw_tel").val()+"&find3="+$("#find_pw_email").val()+"&find4="+$("#find_pw_id").val(),
                            type : "GET",
                            success:function(data){
                                console.log(data);
                                const result_check = data;
                                if(result_check == false){
                                    $(".find_pw_form_kkw").css("display", "none");
                                    $("#find_pw_result").css("display", "block");
                                    $("#find_pw_result").html("등록되지 않은 정보입니다.");
                                } else {
                                    $("#find_pw_result").css("display", "none");
                                    $(".find_pw_form_kkw").css("display", "block");
                                }
                            }
                        });
                    }
                });
                reset_hidden =(id, cls)=>{
                    $("#"+id).focusin(function(){
                    $("#"+cls).html("");
                    $("#"+id ).css("border", "1px solid lightgrey");
                    });
                }
                reset_hidden("find_pw_id", "find_pw_check");
                reset_hidden("find_pw_name", "find_pw_check");
                reset_hidden("find_pw_tel", "find_pw_check");
                reset_hidden("find_pw_email", "find_pw_check");
        </script>
    </body>
    </html>
END;
}

if(isset($_GET['pw'])){
    echo <<<END
    <!DOCTYPE html>
    <html lang="ko">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../css/find_id.css">
        <script src="../js/jq.js"></script>
        <link rel="shortcut icon" type="image" href="../img/logo_only_img.png">
        <title>로그인 창</title>
    </head>
    <body>
            <!--로그인창 배경화면-->
            <div id="find_id_back_kkw" class="find_id_back_kkw" minwidth="570px">
                <!-- <div id="find_id_logo_kkw" class="find_id_logo_kkw"><img src="../img/logo_txt_bottom.png" alt="로고 이미지"></div> -->
                <div class="find_id_bandbox_kkw" style="display:none"> <!--인풋 박스 묶어주는 박스-->
                    <div class="tab_menu">
                        <li>아이디 찾기</li>
                        <li>비밀번호 찾기</li>
                    </div>
                    <p class="find_id_notice">가입 시 등록했던 회원 정보를 입력해주세요.</p>
                    
                    <div class="find_id_form_kkw">
                        <p class="find_id_id_txt_kkw">이름</p>
                        <input type="text" placeholder=" 이름을 입력해주세요." id="find_id_name" class="find_id_id_kkw" name="find_id_name">
                        <p class="find_id_pw_txt_kkw">연락처</p>
                        <input type="text" placeholder=" 연락처를 입력해주세요." id="find_id_tel" class="find_id_pw_kkw" name="find_id_tel">
                        <p class="find_id_pw_txt_kkw">이메일</p>
                        <input type="text" placeholder=" 이메일을 입력해주세요." id="find_id_email" class="find_id_pw_kkw" name="find_id_email">
                        <input type="button" id="find_id_button" class="find_id_button_kkw" value="찾기">
                        <p class="find_id_result"></p>
                    </div>
                    <a href="./login.php" class="find_id_signup_kkw">로그인 하러 가기 &gt;</a>
                </div>
    
                <div class="find_pw_bandbox_kkw" style="display:block"> <!--인풋 박스 묶어주는 박스-->
                    <div class="tab_menu">
                        <li>아이디 찾기</li>
                        <li>비밀번호 찾기</li>
                    </div>
                    <p class="find_id_notice">가입 시 등록했던 회원 정보를 입력해주세요.</p>
                    
                    <div class="find_id_form_kkw">
                        <p class="find_id_id_txt_kkw">아이디</p>
                        <input type="text" placeholder=" 아이디를 입력해주세요." id="find_id_id" class="find_id_id_kkw" name="find_pw_id">
                        <p class="find_id_pw_txt_kkw">이름</p>
                        <input type="text" placeholder=" 이름을 입력해주세요." id="find_id_name" class="find_id_pw_kkw" name="find_pw_name">
                        <p class="find_id_pw_txt_kkw">연락처</p>
                        <input type="text" placeholder=" 연락처를 입력해주세요." id="find_id_tel" class="find_id_pw_kkw" name="find_pw_tel">
                        <p class="find_id_pw_txt_kkw">이메일</p>
                        <input type="text" placeholder=" 이메일을 입력해주세요." id="find_id_email" class="find_id_pw_kkw" name="find_pw_email">
                        <input type="button" class="find_id_button_kkw" value="찾기">
                        <p class="find_id_result"></p>
                    </div>
                </div>
                <div class="find_pw_form_kkw">
                    <p class="find_pw1_txt_kkw">비밀번호</p>
                    <input type="text" placeholder=" 변경할 비밀번호를 입력해주세요" class="find_pw1_pw_kkw" name="find_pw_pw">
                    <p class="find_pw2_txt_kkw">비밀번호 재입력</p>
                    <input type="text" placeholder=" 비밀번호를 다시 입력해주세요" class="find_pw2_pw_kkw" name="find_pw_pw_re">
                    <a href="./login.php"><input type="button" class="find_id_button_kkw" value="변경"></a>
                </div>
            </div>
            <div class="pop_up">
                <img src="../img/small_logo.png" alt="small">
                <div>비밀번호가 변경되었습니다.</div>
                <input type="button" id="x_box" value="닫기">
            </div>
        <script>
    
            $("li:nth-child(1)").on("click", function(){
                $(".find_pw_bandbox_kkw").css("display", "none");
                $(".find_id_bandbox_kkw").css("display", "block");
            });
            $("li:nth-child(2)").on("click", function(){
                $(".find_id_bandbox_kkw").css("display", "none");
                $(".find_pw_bandbox_kkw").css("display", "block");
            });
            let pw_update = "{$_GET['pw']}";
            console.log(pw_update);
            if(pw_update == "ok"){
                $(".pop_up").css("display", "block");
            }
            $("#x_box").on("click", function(){
                location.href="./login.php";
            });
            // 비밀번호 찾기
            $('.find_id_button_kkw').click(function(){
                $.ajax({
                    url:'./find_id.php?find1='+$("#find_id_name").val()+"&find2="+$("#find_id_tel").val()+"&find3="+$("#find_id_email").val()+"&find4="+$("#find_id_id").val(),
                    type : "GET",
                    success:function(data){
                        console.log(data);
                        const result_check = data == false ? "등록되지 않은 정보입니다." : "아이디는 " +data+ "입니다.";
                        $(".find_id_result").html(result_check);
                    }
                });
            });
        </script>
    </body>
    </html>
END;
}
?>
