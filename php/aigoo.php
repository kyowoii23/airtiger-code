<?php
@include "../inc/imp_db.inc";
session_start();
$sql_handle = mysqli_connect("$db_host","$db_account","$db_password","$db_dbname");
isset($_SESSION['id']) || exit;
if(isset($_GET['pw'])){
    $pass_query = "SELECT * FROM `tiger_login` WHERE `id` = '{$_GET['id']}'";
    $pass_check = mysqli_query($sql_handle, $pass_query);
    if(mysqli_num_rows($pass_check) == 0 ){
        echo "로그인이후에 이용해주세요.";
        exit;
       } else {
        $pass_record = mysqli_fetch_assoc($pass_check);
		$pass_pwd = md5($_GET['pw']);
		if($pass_record['pwd'] == $pass_pwd ){
            // 다시 좌석 + 시킬 인덱스 구해오는 쿼리
            $search_sc = "SELECT COUNT(*) as all_idx FROM `ticket_sc` WHERE `booking_num` = '{$_GET['booking']}'";
            $search_result = mysqli_query($sql_handle, $search_sc);
            $search_result = mysqli_fetch_assoc($search_result);
            $new_nam_sit = $search_result['all_idx'];
            $search_sc2 = "SELECT * FROM `ticket_sc` WHERE `booking_num` = '{$_GET['booking']}'";
            $search_result = mysqli_query($sql_handle,$search_sc2);
            $search_result = mysqli_fetch_assoc($search_result);
            //ticket_login에 등록된 남은좌석 구해오기.
            $search_login = "SELECT * FROM `ticket_login` WHERE `fly_name`='{$search_result['fly_name']}' AND `fly_date`='{$search_result['fly_start']}'";
            $search_login_result = mysqli_query($sql_handle,$search_login);
            $login_update_result = mysqli_fetch_assoc($search_login_result);
            $new_nam_sit = $new_nam_sit + $login_update_result['fly_nam_sit'];
            if(mysqli_num_rows($search_login_result) == 0){
                echo $search_login;
                exit;
            }
            //ticket_login에 남은좌석 셋하기.
            $login_update = "UPDATE `ticket_login` SET `fly_nam_sit` = '{$new_nam_sit}' WHERE `fly_name`= '{$search_result['fly_name']}' AND `fly_date`='{$search_result['fly_start']}'";
            $login_update_result = mysqli_query($sql_handle,$login_update);
            //예약취소 쿼리.
            $delete_sc = "DELETE FROM `ticket_sc` WHERE `booking_num` = '{$_GET['booking']}'";
            $delete_result = mysqli_query($sql_handle, $delete_sc);
			echo true;
            exit;
		} else {
			echo false;
            exit;
		}
    }
}
if(isset($_POST['aigoo'])){
    $tiger_sirabe = "SELECT * FROM `tiger_login` WHERE `id` = '{$_SESSION['id']}'";
    $tiger_result = mysqli_query($sql_handle,$tiger_sirabe);
    if(!$tiger_result){
        echo "통신의 문제가 발생하였습니다. 다시시도하세요.";
        exit;
    }
    if(mysqli_num_rows($tiger_result)== 0 ){
        echo "로그인후에 예약하실 수 있습니다.";
        exit;
    }
    $count_idx = 0;
    //회원정보 핸들러 
    $tiger_result = mysqli_fetch_assoc($tiger_result);
    //회원아이디넘버 + 편명 + 출발데이트 
    $booking_num = $tiger_result['id_num'].$_POST['fly_name'][0].$_POST['start_day'][0].date("Ymdhis",time());
    for($i=0; $i < count($_POST['passenger_name']); $i++){ 
        $sql_insert = <<<END
        INSERT INTO `ticket_sc` VALUES('{$_POST['start_city'][$i]}','{$_POST['end_city'][$i]}','{$_POST['passenger_name'][$i]}','{$_POST['passenger_birthday'][$i]}',
        '{$_POST['passenger_nameen'][$i]}','{$_POST['passenger_gender'][$i]}','{$_POST['old'][$i]}','$booking_num','$i','{$_POST['fly_length'][$i]}','{$_SESSION['id']}',
        '{$tiger_result['id_num']}','{$_POST['start_day'][$i]}','{$_POST['price'][$i]}','{$_POST['fly_name'][$i]}','{$_POST['start_time'][$i]}','{$_POST['end_time'][$i]}','{$_POST['all_price']}','{$_POST['passenger_national'][$i]}');        
END;
        $result_insert = mysqli_query($sql_handle,$sql_insert);
        if(!$result_insert){
            echo "오류입니다.".mysqli_error($sql_handle);
            exit;
        }
        $count_idx++;
    }
    $fly_such = "SELECT * FROM `ticket_login` WHERE `fly_date` = '{$_POST['start_day'][0]}' AND `fly_name` = '{$_POST['fly_name'][0]}'";
    $result_such = mysqli_query($sql_handle,$fly_such);
    if(mysqli_num_rows($result_such) == 0){
        echo "예약 가능한 비행기스케줄이 없습니다.";
        exit;
    }
    $fetch_result_such = mysqli_fetch_assoc($result_such);
    $new_nam_sit = $fetch_result_such['fly_nam_sit'] - $count_idx;
    $new_set_sit = "UPDATE `ticket_login` SET `fly_nam_sit` = '{$new_nam_sit}' WHERE `fly_date` = '{$_POST['start_day'][0]}' AND `fly_name` = '{$_POST['fly_name'][0]}'";
    $result_update = mysqli_query($sql_handle, $new_set_sit);
    if(!$result_update){
        echo "남은좌석 오류 ";
        exit;
    }
    echo <<<END
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic&display=swap" rel="stylesheet">
    <script src="../js/jq.js"></script>
    <link rel="stylesheet" href="../css/main345.css">
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
            <div class="null_box"></div>
            <div class="pass_box">
                <img src="../img/small_logo.png" alt="small">
                <div>
                    <span class="text_pass">비밀번호 입력</span>
                    <input class="check_pass" type="password" id="check_pass" name="pass" required>
                    <input type = 'hidden' name='id' value= '{$_SESSION['id']}'>
                </div>
                <p>* 비밀번호 일치하지 않습니다. 다시 입력해주세요.</p>
                <input type="button" class="check_box" value="확인">
            </div> 
            <form id="main4_selectbox_kkw" class="main4_selectbox_kkw" action="#" name="admin_search">
                <div class="wrap">
                    <li class="find"><h2>예약조회</h2></li>
                    <input type="hidden" name="admin_delete" value="$booking_num">
                    <li class="reserve_number"><p>예약번호</p><p>$booking_num</p></li>
                    <li class="start_day"><p>{$_POST['start_day'][0]}</p><p>출발일</p></li>
                    <article class="main3_selectprice_kkw">
                        <div>편명</div>
                        <div>출발시간</div>
                        <div>소요시간</div>
                        <div>도착시간</div>
                        <div>결제금액</div>
                        <div>취소</div>
                    </article>
                    <article class="main3_selectprice2_kkw">
                        <div><img src="../img/small_logo.png" alt="logo"><p>{$_POST['fly_name'][0]}</p></div>
                        <div>{$_POST['start_time'][0]}<br></div>
                        <div>{$_POST['fly_length'][0]}</div>
                        <div>{$_POST['end_time'][0]}<br></div>
                        <div><br>{$_POST['all_price']}<br></div>
                        <input type="button" class="admin_delete_bt" value="취소">
                    </article>
                    <div class="passengers">
END;
    $i = 0;
    while($i < count($_POST['passenger_name'])){
        $j = $i + 1;
        echo <<<END
                            <div>
                                <h4>{$j}.{$_POST['old'][$i]}</h4>
                                <span>{$_POST['passenger_name'][$i]}</span>
                                <span>{$_POST['passenger_nameen'][$i]}</span>
                                <span>{$_POST['passenger_birthday'][$i]}</span>
                                <span>{$_POST['passenger_gender'][$i]}</span>
                                <span>{$_POST['passenger_national'][$i]}</span>
                            </div>                      
END;
        $i++;
    }
    echo <<<END
    </div>
    </div>
    </form>       
</section>
        <div class="pop_up">
            <img src="../img/small_logo.png" alt="small">
            <div>가입 완료되었습니다.</div>
            <a href="./login.php">닫기</a>
        </div>
        <footer>
            <!--footer info-->
            <div class="footer_info">
                <h3>(주) 에어타이거</h3>
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
}
if(isset($_GET['main'])){
    //여기에 기본 예약조회 페이지
    echo <<<END
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic&display=swap" rel="stylesheet">
    <script src="../js/jq.js"></script>
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
            <div class="null_box"></div>
END;
    if($_SESSION['id'] == 'admin'){
        echo <<<END
        <h2 class="ad_text">관리자 모드</h2>
        <form class="admin_search" action="./aigoo.php?main=0" method="post" name="admin_search">
        <input id="admin_id_search" class="admin_id_search" type="text" name="search_id" placeholder=" 회원 아이디">
        <input id="admin_id_bt" class="admin_id_bt" type="submit" name="admin_sc_search" value="조회">                   
        </form>
        <div class="wrap">
        <li class="find"><h2>예약조회</h2></li>
END;
        if(isset($_POST['admin_sc_search'])){
            $search_sc_id ="SELECT * FROM `ticket_sc` WHERE `booking_id`= '{$_POST['search_id']}' GROUP BY `booking_num`";
            $search_sc_id_result = mysqli_query($sql_handle,$search_sc_id);
            while($row = mysqli_fetch_assoc($search_sc_id_result)){
                echo <<<END
                <div class="pass_box">
                    <img src="../img/small_logo.png" alt="small">
                        <div>
                            <span class="text_pass">비밀번호 입력</span>
                            <input class="check_pass" type="password" id="check_pass" name="pass" required>
                            <input type = 'hidden' name='id' value= '{$row['booking_id']}'>
                        </div>
                    <p>* 비밀번호 일치하지 않습니다. 다시 입력해주세요.</p>
                <input type="button" class="check_box" value="확인">
                </div> 
                <form class="main4_selectbox_kkw" action="#" name="admin_search">
                <div class = 'booking_while'>
                    <li class="reserve_number"><p>예약번호</p><p>{$row['booking_num']}</p></li>
                    <input type="hidden" name="admin_delete" value="{$row['booking_num']}">
                    <li class="start_day"><p>{$row['fly_start']}</p><p>출발일</p></li>
                    <article class="main3_selectprice_kkw">
                        <div>편명</div>
                        <div>출발시간</div>
                        <div>소요시간</div>
                        <div>도착시간</div>
                        <div>결제금액</div>
                        <div>취소</div>
                    </article>
                    <article class="main3_selectprice2_kkw">
                        <div><img src="../img/small_logo.png" alt="logo"><p>{$row['fly_name']}</p></div>
                        <div>{$row['fly_start_time']}<br></div>
                        <div>{$row['flying_length']}</div>
                        <div>{$row['fly_end_time']}<br></div>
                        <div><br>{$row['fly_all_price']}<br></div>
                        <input type="button" class="admin_delete_bt" value="취소">
                        <p class="booking_info">탑승자 정보 >></p>
                    </article>
                    <div class="passengers">
END;
                $search_sc_id2="SELECT * FROM `ticket_sc` WHERE `booking_id`= '{$_POST['search_id']}' AND `booking_num`='{$row['booking_num']}'";
                $search_sc_id2_result = mysqli_query($sql_handle,$search_sc_id2);
                $all_price = 0;
                while($row2= mysqli_fetch_assoc($search_sc_id2_result)){
                    $j = $row2['booking_num_num'] + 1;
                    $all_price+=$row2['fly_chage'];
                    echo <<<END
                    <div>
                        <h4>{$j}.{$row2['stay_lange']}</h4>
                        <input type= 'hidden' value= '{$row['fly_chage']}'>
                        <span>{$row2['stay_name']}</span>
                        <span>{$row2['stay_name_en']}</span>
                        <span>{$row2['stay_birth']}</span>
                        <span>{$row2['stay_sex']}</span>
                        <span>{$row2['fly_country']}</span>
                    </div>                      
END;
                }
                echo <<<END
                </div>
            </div>
        </form>
END;
            }
        }
    }else {
        echo <<<END
        <div class="wrap">
        <li class="find"><h2>예약조회</h2></li>
END;
        $search_sc_id ="SELECT * FROM `ticket_sc` WHERE `booking_id`= '{$_SESSION['id']}' GROUP BY `booking_num`";
        $search_sc_id_result = mysqli_query($sql_handle,$search_sc_id);
        if(mysqli_num_rows($search_sc_id_result)== 0){
            echo "<div class=\"booking_not\">조회 가능한 예약스케쥴이 없습니다.</div>";
        }
        while($row = mysqli_fetch_assoc($search_sc_id_result)){
            echo <<<END
            <div class="pass_box">
                <img src="../img/small_logo.png" alt="small">
                <div>
                    <span class="text_pass">비밀번호 입력</span>
                    <input class="check_pass" type="password" id="check_pass" name="pass" required>
                    <input type = 'hidden' name='id' value= '{$row['booking_id']}'>
                </div>
                <p>* 비밀번호 일치하지 않습니다. 다시 입력해주세요.</p>
                <input type="button" class="check_box" value="확인">
            </div> 
            <form class="main4_selectbox_kkw" action="#" name="admin_search">
            <div class = 'booking_while'>
                <li class="reserve_number"><p>예약번호</p><p>{$row['booking_num']}</p></li>
                <input type="hidden" name="admin_delete" value="{$row['booking_num']}">
                <li class="start_day"><p>{$row['fly_start']}</p><p>출발일</p></li>
                <article class="main3_selectprice_kkw">
                    <div>편명</div>
                    <div>출발시간</div>
                    <div>소요시간</div>
                    <div>도착시간</div>
                    <div>결제금액</div>
                    <div>취소</div>
                </article>
                <article class="main3_selectprice2_kkw">
                    <div><img src="../img/small_logo.png" alt="logo"><p>{$row['fly_name']}</p></div>
                    <div>{$row['fly_start_time']}<br></div>
                    <div>{$row['flying_length']}</div>
                    <div>{$row['fly_end_time']}<br></div>
                    <div><br>{$row['fly_all_price']}<br></div>
                    <input type="button" class="admin_delete_bt" value="취소">
                    <p class="booking_info">탑승자 정보 >></p>
                </article>
                <div class="passengers">
END;
            $search_sc_id2="SELECT * FROM `ticket_sc` WHERE `booking_id`= '{$_SESSION['id']}' AND `booking_num`='{$row['booking_num']}'";
            $search_sc_id2_result = mysqli_query($sql_handle,$search_sc_id2);
            while($row2= mysqli_fetch_assoc($search_sc_id2_result)){
                $j = $row2['booking_num_num'] + 1;
                echo <<<END
                <div>
                    <h4>{$j}.{$row2['stay_lange']}</h4>
                    <input type= 'hidden' value= '{$row['fly_chage']}'>
                    <span>{$row2['stay_name']}</span>
                    <span>{$row2['stay_name_en']}</span>
                    <span>{$row2['stay_birth']}</span>
                    <span>{$row2['stay_sex']}</span>
                    <span>{$row2['fly_country']}</span>
                </div>                      
END;
            }
            echo <<<END
            </div>
        </div>
    </form>  
END;
        }
    }
    echo <<<END
    </div>     
</section>
        <div class="pop_up">
            <img src="../img/small_logo.png" alt="small">
            <div>가입 완료되었습니다.</div>
            <a href="./login.php">닫기</a>
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
}
?>