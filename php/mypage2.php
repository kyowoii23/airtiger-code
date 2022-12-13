<?php
session_start();
// $_POST['ad_id_kkw'] // id hidden
// $_POST['name']
// $_POST['sex']
// $_POST['nameen']
// $_POST['birth']
// $_POST['from']
// $_POST['phone']
// $_POST['email']
// $_POST['address']
if(isset($_POST['admin_name'])){
    include "../inc/imp_db.inc";
    $ok_handler = mysqli_connect($db_host, $db_account, $db_password, $db_dbname);
    if(!$ok_handler){
        echo "오류낫다 고쳐라";
    }
    $up_query = "UPDATE `tiger_login` SET `name` ='{$_POST['admin_name']}', sex='{$_POST['sex']}', birth='{$_POST['birth']}', name_en='{$_POST['nameen']}', country='{$_POST['from']}', tel='{$_POST['phone']}', mail='{$_POST['email']}', address='{$_POST['address']}' WHERE id='{$_POST['ad_id_kkw']}'";
    $db_content = mysqli_query($ok_handler,$up_query);
    if($db_content){
        echo <<<END
        <!DOCTYPE html>
        <html lang="ko">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <script src="../js/jq.js"></script>
            <link rel="preconnect" href="https://fonts.gstatic.com">
            <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic&display=swap" rel="stylesheet">
            <link rel="stylesheet" href="../css/admin.css">
            <link rel="shortcut icon" type="image" href="../img/logo_only_img.png">
            <title>비행기 티켓팅 사이트</title>
        </head>
        <body>
                <header>
                    <!--header logo-->
                    <div class="admin_page">
                        <div class="main_logo">
                            <div class="main_logo_box">
                                <img class="main_logo_img" src="../img/main_logo.png" alt="main_logo">
                            </div>
                        </div>
                        <!--header menu-->
                        <div class="main_menu">
                            <ul class="main_menu_box">
                                <li id="main_menu1" class="menu1">예약하기</li>
                                <li id="main_menu2" class="menu2">예약 조회</li>
                                <li id="main_menu3" class="menu3">마이 페이지</li>
                            </ul>
                        </div>
                        <!--header logout-->
                        <div class="main_logout">
                            <a class="logout_btn" href="./main.php?log=out">로그아웃</a>
                        </div>
                    </div>
                </header>
                <section>
                    <div class="null_box"></div>
                    <h2 class="ad_text">관리자 모드</h2>
                    <form class="ad_serarchbox_ksg" action="./mypage.php" method="post">
                        <input class="ad_search_ksg" type="text" placeholder=" 회원 아이디" name="search_id">
                        <input type="submit" class="ad_id_search_button_ksg" value="조회">
                    </form>

                    <div class="tabBox1" minwidth="150px">
                        <h2 class="tab_menu">회원 정보 수정</h2>
                        <div class="yellowBar"></div>
                    </div>

                    <form class="ad_form_ksg" id="ad_form_ksg" action="./mypage.php" method="post">
                        <p class="ad_id_txt_ksg">아이디</p>
                        <span id="ad_id_ksg" class="ad_id_ksg">아이디를 조회해주세요.</span>
                        <input type="hidden" name="ad_id_kkw">
                        <p class="ad_pw_txt_ksg">임시 비밀번호</p>
                        <input type="text" placeholder=" 비밀번호" class="ad_pw_ksg" value="1234" name="ad_new_pw">
                        <p class="ad_replay_txt_ksg">임시 비밀번호 재확인</p>
                        <input type="text" placeholder=" 비밀번호 확인" class="ad_replay_ksg" value="1234" name="ad_new_replay_pw">
                        <input type="button" class="ad_confirm_ksg" value="확인">
                        <p class="ad_alert ad_pw_alert">* 임시 비밀번호를 확인해주세요.</p>
                        <p class="ad_name_txt_ksg">이름</p>
                        <input type="text" class="ad_name_ksg" name="name">                
                        <input type="button" class="ad_man_button_ksg" value="남">
                        <input type="button" class="ad_woman_button_ksg" value="여">
                        <input id="admin_sex_check" type="hidden" name="sex" required>
                        <p class="ad_alert ad_name_alert">* 한글 이름 및 성별을 확인해주세요.</p>
                        <p class="ad_nameen_txt_ksg">영문 이름</p>
                        <input type="text" class="ad_nameen_ksg" name="nameen">
                        <p class="ad_alert ad_nameen_alert">* 영문 이름을 확인해주세요.</p>                
                        <p class="ad_birth_txt_ksg">생년월일</p>
                        <input type="date" class="ad_birth_ksg" name="birth">
                        <p class="ad_alert ad_birth_alert">* 생년월일을 입력해주세요.</p>    
                        <p class="ad_from_txt_ksg">국적</p>
                        <input type="text" placeholder=" 국적" class="ad_from_ksg" name="from">
                        <p class="ad_alert ad_from_alert">* 영문으로 국적을 입력해주세요.</p>
                        <p class="ad_phone_txt_ksg">연락처</p>
                        <input type="text" placeholder=" 연락처" class="ad_phone_ksg" name="phone">
                        <p class="ad_alert ad_phone_alert">* 연락처를 확인해주세요.</p>
                        <p class="ad_email_txt_ksg">이메일</p>
                        <input type="email" placeholder=" 이메일" class="ad_email_ksg" name="email">
                        <p class="ad_alert ad_email_alert">* 이메일 주소를 확인해주세요.</p>
                        <p class="ad_address_txt_ksg">주소</p>
                        <input type="address" placeholder=" 주소" class="ad_address_ksg" name="address">
                        <p class="ad_alert ad_address_alert">* 주소를 확인해주세요.</p>
                        <input type="button" value="수정" class="ad_button_ksg">
                        <a class="ad_cancle_ksg" href="./main.php">취소</a>
                    
                    <div class="pop_up">
                        <img src="../img/small_logo.png" alt="small">
                        <div>임시 비밀번호를 설정하시겠습니까?</div>
                        <input type="button" class="x_box_ok" value="확인">
                        <input type="button" class="x_box_no" value="닫기">
                    </div>
                    </form>
                    <div class="pop_up_ok">
                        <img src="../img/small_logo.png" alt="small">
                        <div>회원정보가 수정되었습니다.</div>
                        <input type="button" class="x_box_pop_up_ok" value="닫기">
                    </div>
                    
                </section>
                <footer>
            <div class="footer_info">
                <h3>(주) 에어 타이거</h3>
                <p>대표 : 김하늘 외 3명 | 주소 : 서울특별시 강서구 하늘길 260 | 전화 : 1234-5678 / 02-1234-5678<br>
                    사업자등록번호 : 100-12-09134 | 통신판매업신고 : 강서 제 21-0507 <a href="https://www.ftc.go.kr/www/bizCommList.do?key=3765">사업자정보 확인 &gt;</a><br>개인정보보호책임자 : 여객사업본부장 김장연 대표<br>
                    &copy; AIR TIGER
                </p>
            </div>
        </footer>
        <script>
            // 확인 눌렀을 때 컨펌 창 띄우기
            $(".ad_confirm_ksg").on("click", function(){
                $(".pop_up").css("display", "block");
            })
            // 닫기 눌렀을 때
            $(".x_box_no").on("click", function(){
                $(".pop_up").css("display", "none");
            })

            // 컨펌 창 확인 버튼시 submit
            $(".x_box_ok").on("click", function(){
                $("#ad_form_ksg").submit();
            });

            $(".main_menu").on("click", function(e){
                switch(e.target.id){
                    case 'main_menu1' :
                        location.href="./main.php";
                    break;
                    case 'main_menu2' :
                        location.href="./aigoo.php";
                    break;
                    case 'main_menu3' :
                        location.href="./mypage.php";
                    break;
                }
            });
            $(".pop_up_ok").on("click", function(){
                location.href="./mypage.php";
            });
            
        </script>
        <script src="../js/airtiger2.js"></script>
        </body>
        </html>
END;
    }
}
?>