<?php
    @include "../inc/imp_db.inc";
    @include "header.php";
    session_start();
    if(!isset($_SESSION['id']) || !isset($_SESSION['pw']) || isset($_GET['log'])){
        session_destroy();
        echo "<script>location.href='./login.php';</script>";
        exit;
    }
// 쿼리 핸들러
$sql_handle = mysqli_connect("$db_host","$db_account","$db_password","$db_dbname");
//쿼리 할일 변수
$sql_doit = "";
echo <<<END
END;
//main2 >>> main3
if(isset($_POST['submit'])){
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
    <link rel="stylesheet" href="../css/main34.css">
    <link rel="shortcut icon" type="image" href="../img/logo_only_img.png">
    <title>비행기 티켓팅 사이트</title>
</head>
<body>
<header>
    <!--header logo-->
    <div class="main3_menu">
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
        <article class="main3_selectbox_kkw">
            <div>
                <p>편도</p>
                <form id="main1_form" action="./main.php" method="post">
                    <select id="main1_start_city" name="start_city">
                        <option value="set" selected>출발지</option>
                        <option value="서울/인천(ICN)" selected>서울/인천(ICN)</option>
                    </select>
                    <input id="main1_start_day" type="date" name="start_day" max="2021-06-19" min="2021-06-17" data-placeholder="출발일" required aria-required="true" value='{$_POST['start_day']}'>
                    <span>-</span>
                    <select id="main1_end_city" name="end_city">
                        <option value="set" selected>도착지</option>
                        <option value="도쿄/나리타(NRT)" selected>도쿄/나리타(NRT)</option>
                    </select>
                    <input type="date" id="main1_end_day" name="end_day" max="2021-06-19" min="2021-06-17" data-placeholder="도착일" required aria-required="true" value="{$_POST['end_day']}">
                    <span>성인</span><select id="main1_adult" name="adult">
                        <option value={$_POST['adult']} selected hidden>{$_POST['adult']}명</option>
                        <option value=0>0명</option>
                        <option value=1>1명</option>
                        <option value=2>2명</option>
                        <option value=3>3명</option>
                        <option value=4>4명</option>
                        <option value=5>5명</option>
                    </select>                    
                    <span>유아</span><select id="main1_kids" name="kids">
                        <option value={$_POST['kids']} selected hidden>{$_POST['kids']}명</option>
                        <option value=0>0명</option>
                        <option value=1>1명</option>
                        <option value=2>2명</option>
                        <option value=3>3명</option>
                        <option value=4>4명</option>
                        <option value=5>5명</option>
                    </select>
                    <input id="main1_search_button" type="submit" name="first_sirabe" value="변경">
                </form>
            </div>
        </article>
        <article class="main3_selectbox2_kkw">
        <form id="air_check" action="aigoo.php" method="post">
            <div class="empty_box"></div>
            <div class="board_info">
                <h2>탑승객 정보</h2>
                <div class="info_box">
END;
    $i = 1;
    while($i < ($_POST['adult'] + 1)){
        echo <<<END
        <div class="main_2_jy">
            <h3>성인{$i}</h3>
            <input type="text" id="ad_name" name="passenger_name[]" placeholder=" 한글 이름" required>
            <input type="text" id="ad_name" name="passenger_nameen[]" placeholder=" 영문 이름" required>
            <span>생년월일</span><input type="date" id="ad_birth" name="passenger_birthday[]" placeholder="생년월일" required>
            <span>성별</span><select name="passenger_gender[]">
                <option value="set">선택</option>
                <option value="남자">남</option>
                <option value="여자">여</option>
            </select>
            <span>국적</span><input type="text" id="ad_from" type="text" name="passenger_national[]" placeholder=" 영문 국가" required>
            <input type='hidden' name ='start_city[]' value='{$_POST['startcity']}'>
            <input type='hidden' name ='end_city[]' value='{$_POST['endcity']}'>
            <input type='hidden' name ='start_day[]' value='{$_POST['start_day']}'>
            <input type='hidden' name ='end_day[]' value='{$_POST['end_day']}'>
            <input type='hidden' name ='start_time[]' value='{$_POST['startime']}'>
            <input type='hidden' name ='end_time[]' value='{$_POST['endtime']}'>
            <input type='hidden' name ='fly_name[]' value='{$_POST['airline']}'>
            <input type='hidden' name ='fly_length[]' value='{$_POST['fly_length']}'>
            <input type='hidden' name ='price[]' value='{$_POST['price']}'>
            <input type='hidden' name ='old[]' value='성인'>
        </div>
END;
        $i++;
    }
    $i = 1;
    $ua_price = $_POST['price'] / 2;
    while($i < $_POST['kids']+1){
        echo <<<END
        <div class="main_2_jy">
            <h3>유아{$i}</h3>
            <input type="text" id="kd_name" name="passenger_name[]" placeholder=" 한글 이름" required>
            <input type="text" id="kd_name" name="passenger_nameen[]" placeholder=" 영문 이름" required>
            <span>생년월일</span><input type="date" id="kd_birth" name="passenger_birthday[]" required>
            <span>성별</span><select name="passenger_gender[]">
                <option value="set">선택</option>
                <option value="남자">남</option>
                <option value="여자">여</option>
            </select>
            <span>국적</span><input type="text" id="ad_from" type="text" name="passenger_national[]"  placeholder=" 영문 국가" required>
            <input type='hidden' name ='start_city[]' value='{$_POST['startcity']}'>
            <input type='hidden' name ='end_city[]' value='{$_POST['endcity']}'>
            <input type='hidden' name ='start_day[]' value='{$_POST['start_day']}'>
            <input type='hidden' name ='end_day[]' value='{$_POST['end_day']}'>
            <input type='hidden' name ='start_time[]' value='{$_POST['startime']}'>
            <input type='hidden' name ='end_time[]' value='{$_POST['endtime']}'>
            <input type='hidden' name ='fly_name[]' value='{$_POST['airline']}'>
            <input type='hidden' name ='fly_length[]' value='{$_POST['fly_length']}'>
            <input type='hidden' name ='price[]' value='$ua_price'>
            <input type='hidden' name ='old[]' value='유아'>
        </div>
END;
        $i++;
    }
    echo <<<END
    <div>
                                <p>- 이름 및 성별을 제외한 생년월일, 국적 등 정보는 마이페이지에서 수정 가능합니다.</p>
                            </div>
                        </div>
                    </div>
                    <p class="air_alert">* 입력칸을 확인해주세요.</p>
                    <div class="reservation_info">
                        <h2>예매자 정보</h2>
                        <div class="info_box">
                            <div>
                                <span>이메일</span><input id="leader_email" type="text" name="leader_email" placeholder="e-mail">
                                <span>연락처</span><input id="leader_phone" type="text" name="leader_phone" placeholder="연락처">
                            </div>
                            <div>
                                <p>- 항공기 운항정보(스케줄 변경, 결항 등) 및 구매정보가 알림톡 또는 SMS 로 발송되며, 이메일로 e-티켓이 발송됩니다.</p>
                            </div>
                        </div>
                    </div>

                    <div class="main3_bottom_kkw">
                        <div>
                            <p>항공 운임 총액</p>
                            <div>{$_POST['all_price']}</div>
                            <input type="hidden" name="all_price" value="{$_POST['all_price']}">
                            <input id="main3_submitbt_kkw" type="submit" name="aigoo" value="결제">
                        </div>
                    </div>
                </form>
                
            </article>
            
        </section>
END;
    echo <<<END
    <div class="pop_up">
    <img src="../img/small_logo.png" alt="small">
    <div>가입 완료되었습니다.</div>
    <input type="button" id="#x_box" value="닫기">
</div>  
    <footer>
<!--footer info-->
<div class="footer_info">
    <h3>(주) 에어 타이거</h3>
    <p>대표 : 김하늘 외 3명 | 주소 : 서울특별시 강서구 하늘길 260 | 전화 : 1234-5678 / 02-1234-5678<br>
        사업자등록번호 : 100-12-09134 | 통신판매업신고 : 강서 제 21-0507 <a href="https://www.ftc.go.kr/www/bizCommList.do?key=3765">사업자정보 확인 &gt;</a><br>개인정보보호책임자 : 여객사업본부장 김장연 대표<br>
        &copy; AIR TIGER
    </p>
</div>
</footer>
<script src="../js/airtiger2.js"></script>
</body>
</html>
END;
    exit;
}
// main1 > main2
if(isset($_POST['first_sirabe'])){
    //name="start_city" 출발지
    //name="end_city" 도착지
    //name="adult" 성인
    //name="start_day"출발일
    //name="end_day"도착일
    //name="kids" 유아
    $sql_doit = "SELECT * FROM `ticket_login` WHERE `fly_date` = '{$_POST['start_day']}'";
    $result1 = mysqli_query($sql_handle,$sql_doit);
    if(mysqli_num_rows($result1) == 0){
        echo "<script>location.href=\"./main.php?fly=no\"</script>";
        exit;
    }
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
    <link rel="stylesheet" href="../css/main12.css">
    <link rel="shortcut icon" type="image" href="../img/logo_only_img.png">
    <title>비행기 티켓팅 사이트</title>
</head>
<body>
<header>
    <!--header logo-->
    <div class="main1_menu">
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
    <section class="main2_select_sky">
        <article class="main2_selectbox_sky">
            <div>
                <p>편도</p>
                <form id="main1_form" action="./main.php" method="post">
                    <select id="main1_start_city" name="start_city">
                        <option value="set" selected>출발지</option>
                        <option value="서울/인천(ICN)" selected>서울/인천(ICN)</option>
                    </select>
                    <input id="main1_start_day" type="date" name="start_day" max="2021-06-19" min="2021-06-17" data-placeholder="출발일" required aria-required="true" value='{$_POST['start_day']}'>
                    <span>-</span>
                    <select id="main1_end_city" name="end_city">
                        <option value="set" selected>도착지</option>
                        <option value="도쿄/나리타(NRT)" selected>도쿄/나리타(NRT)</option>
                    </select>
                    <input type="date" id="main1_end_day" name="end_day" max="2021-06-19" min="2021-06-17" data-placeholder="도착일" required aria-required="true" value="{$_POST['end_day']}">
                    <span>성인</span><select id="main1_adult" name="adult">
                        <option value={$_POST['adult']} selected hidden>{$_POST['adult']}명</option>
                        <option value=0>0명</option>
                        <option value=1>1명</option>
                        <option value=2>2명</option>
                        <option value=3>3명</option>
                        <option value=4>4명</option>
                        <option value=5>5명</option>
                    </select>                    
                    <span>유아</span><select id="main1_kids" name="kids">
                        <option value={$_POST['kids']} selected hidden>{$_POST['kids']}명</option>
                        <option value=0>0명</option>
                        <option value=1>1명</option>
                        <option value=2>2명</option>
                        <option value=3>3명</option>
                        <option value=4>4명</option>
                        <option value=5>5명</option>
                    </select>
                    <input id="main1_search_button" type="submit" name="first_sirabe" value="변경">
                </form>
            </div>
        </article>
END;
    while($row = mysqli_fetch_assoc($result1)){
        $num = number_format($row['fly_charge']);
        $all_num = number_format(($row['fly_charge'] * $_POST['adult'])+(($row['fly_charge']/2)*$_POST['kids']));
        echo <<<END
        <article class="main2_selectbox2_sky">
            <div></div>
            <h1><img class="air_img" src="../img/air.png" alt="air_img">&nbsp;여정 : {$_POST['start_city']} <img class="arr_img" src="../img/arr.png" alt="arr_img"> {$_POST['end_city']}</h1>
            <div class="main2_price_sky">
                <p>{$row['fly_date']}</p>
                <span>KRW</span><p class="main2_pricepay_sky">$num</p>
            </div>
        </article>
        <article class="main2_selectprice_sky">
            <div>편명</div>
            <div>출발시간</div>
            <div>소요시간</div>
            <div>도착시간</div>
            <div>운임</div>
        </article>
        <article class="main2_selectprice2_sky">
            <div>{$row['fly_name']}</div>
            <div>{$row['fly_start_time']}<br></div>
            <div>{$row['fly_length']}</div>
            <div>{$row['fly_finish_time']}<br></div>
            <div><br>$num<br><p>잔여 {$row['fly_nam_sit']}</p></div>
        </article>
    </section>
    <section class="main2_bottom_sky">
        <form id="main2_hidden" action="main.php" method="post">
            <input id="main2_startcity_sky" type="hidden" name="startcity" value="{$_POST['start_city']}">
            <input id="main2_endcity_sky" type="hidden" name="endcity" value="{$_POST['end_city']}">
            <input id="main2_startday_sky" type="hidden" name="start_day" value="{$row['fly_date']}">
            <input id="main2_startday_sky" type="hidden" name="end_day" value="{$_POST['end_day']}">
            <input id="main2_starttime_sky" type="hidden" name="startime" value="{$row['fly_start_time']}">
            <input id="main2_endtime_sky" type="hidden" name="endtime" value="{$row['fly_finish_time']}">
            <input id="main2_airline_sky" type="hidden" name="airline" value="{$row['fly_name']}">
            <input type="hidden" name="fly_length" value="{$row['fly_length']}">
            <input id="main2_price_sky" type="hidden" name="price" value='{$row['fly_charge']}'>
            <input id="main2_adult_sky" type="hidden" name="adult" value={$_POST['adult']}>
            <input id="main2_kids_sky" type="hidden" name="kids" value={$_POST['kids']}>
            <p>항공 운임 총액</p>
            <div>$all_num</div>
            <input id="main2_all_price_jy" type="hidden" name="all_price" value="{$all_num}">
            <input id="main2_submitbt_sky" type="submit" name="submit" value="다음">
        </form>
    </section>
END;
    }
}else {
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
    <link rel="stylesheet" href="../css/main12.css">
    <link rel="shortcut icon" type="image" href="../img/logo_only_img.png">
    <title>비행기 티켓팅 사이트</title>
</head>
<body>
<header>
    <!--header logo-->
    <div class="main1_menu">
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
            <article class="main1_slidecut_sky">
                <div>
                    <img src="../img/slide1.jpg" alt="slide_img">
                </div>
                <div>
                    <img src="../img/slide2.jpg" alt="slide_img">
                </div>
                <div>
                    <img src="../img/slide3.jpg" alt="slide_img">
                </div>    
            </article>
                <article class="main1_selectbox_sky">
                    <p>편도</p>
                    <form id="main1_form" action="./main.php" method="post">
                        <select id="main1_start_city" name="start_city">
                            <option value="set" selected>출발지</option>
                            <option value="서울/인천(ICN)">서울/인천(ICN)</option>
                        </select>
                        <select id="main1_end_city" name="end_city">
                            <option value="set" selected>도착지</option>
                            <option value="도쿄/나리타(NRT)">도쿄/나리타(NRT)</option>
                        </select>
                        <span>성인</span><select id="main1_adult" name="adult">
                            <option value=0 selected>0명</option>
                            <option value=1>1명</option>
                            <option value=2>2명</option>
                            <option value=3>3명</option>
                            <option value=4>4명</option>
                            <option value=5>5명</option>
                        </select>
                        <input type="date" id="main1_start_day" name="start_day" max="2021-06-19" min="2021-06-17" data-placeholder="출발일" required aria-required="true">
                        <input type="hidden" id="main1_end_day" name="end_day">
                        <span>유아</span><select id="main1_kids" name="kids">
                            <option value=0 selected>0명</option>
                            <option value=1>1명</option>
                            <option value=2>2명</option>
                            <option value=3>3명</option>
                            <option value=4>4명</option>
                            <option value=5>5명</option>
                        </select>
                        <p class="main1_alert">* 빈칸을 입력해주세요.</p>  
                        <input type="submit" id="main1_search_button" name="first_sirabe" value="조회">                   
                    </form>
                </article>
            </section>
END;

if(@$_GET['fly'] == 'no'){
    echo <<<END
        <div class="pop_up">
            <img src="../img/small_logo.png" alt="small">
            <div>예약 가능한 스케쥴이 없습니다.</div>
            <input id="x_box" type="button" value="닫기">
        </div>
END;
}
}
//풋터
echo <<<END
<footer>
<!--footer info-->
<div class="footer_info">
    <h3>(주) 에어 타이거</h3>
    <p>대표 : 김하늘 외 3명 | 주소 : 서울특별시 강서구 하늘길 260 | 전화 : 1234-5678 / 02-1234-5678<br>
        사업자등록번호 : 100-12-09134 | 통신판매업신고 : 강서 제 21-0507 <a href="https://www.ftc.go.kr/www/bizCommList.do?key=3765">사업자정보 확인 &gt;</a><br>개인정보보호책임자 : 여객사업본부장 김장연 대표<br>
        &copy; AIR TIGER
    </p>
</div>
</footer>
<script src="../js/airtiger2.js"></script>
</body>
</html>
END;
?>