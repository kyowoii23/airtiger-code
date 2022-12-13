//admin 메뉴
$(".ad_man_button_ksg").on("click",function() {
    $(".ad_man_button_ksg").css("background-color","#ffb300");
    $(".ad_woman_button_ksg").css("background-color","lightgray");
    $("#admin_sex_check").val("남자");
});
$(".ad_woman_button_ksg").on("click",function() {
    $(".ad_woman_button_ksg").css("background-color","#ffb300");
    $(".ad_man_button_ksg").css("background-color","lightgray");
    $("#admin_sex_check").val("여자");
});
$(".tab_menu").on("click", function() {
    $(".yellowBar").css("visibility", "visible");
    $(".yellowBar2").css("visibility", "hidden");
    $(".ad_form_ksg").css("display", "block");
    $(".main4_selectbox_kkw").css("display", "none");
});
$(".tab_menu2").on("click", function() {
    $(".yellowBar2").css("visibility", "visible");
    $(".yellowBar").css("visibility", "hidden");
    $(".main4_selectbox_kkw").css("display", "block");
    $(".ad_form_ksg").css("display", "none");
});

//main1 슬라이드
let num = 1;
setInterval(function(){
	num = num % 3;
	$(".main1_slidecut_sky>div").fadeOut(2000);
	$(".main1_slidecut_sky>div").eq(num).fadeIn(2000);
	num++;
}, 4000);

 //성별 클릭 이벤트
$(".signup_man_button_ksg").on("click",function() {
    $(".signup_man_button_ksg").css("background-color","#ffb300");
    $(".signup_woman_button_ksg").css("background-color","lightgray");
    $("#signup_sex_check").val("남자");
    $(".signup_man_button_ksg").css("border", "none");
    $(".signup_woman_button_ksg").css("border", "none");
});
$(".signup_woman_button_ksg").on("click",function() {
    $(".signup_woman_button_ksg").css("background-color","#ffb300");
    $(".signup_man_button_ksg").css("background-color","lightgray");
    $("#signup_sex_check").val("여자");
    $(".signup_woman_button_ksg").css("border", "none");
    $(".signup_man_button_ksg").css("border", "none");
});
let idx = 0;
let idx2 = 0;
//아이디 중복 확인
$('.signup_id_button_ksg').click(function(){
    $(".signup_id_button_ksg").css("border", "none");
    $("#signup_id_check_ksg").val(0);
    $.ajax({
        url:'./signup.php?id='+$("input[name='id']").val(),
        type : "GET",
        success:function(data){
            const result_check = data == false ? "* 아이디 중복 및 영문 대소문자, 숫자 포함 6~15자 이내로 입력하세요." : "* 사용 가능한 아이디입니다.";
            idx = result_check == "* 사용 가능한 아이디입니다." ? 0 : 1;
            $(".signup_id_check").html(result_check).css("visibility", "visible");
        }
    });
});
$("#signup_id_ksg").on("change", function(){
    idx= 1;
    idx2= 1;
});
//회원 가입 시 정규식 및 submit 이벤트
$('#signup_button_ksg').on("click", function(){
    const id_check = /^[a-zA-Z0-9]{6,15}$/;
    const pw_check = /^[a-zA-Z0-9\@\!\#]{4,20}$/;
    const name_check = /[a-z0-9]|[ \[\]{}()<>?|`~!@#$%^&*-_+=,.;:\"'\\]/g;
    const nameen_check = /^[a-zA-Z]*$/;
    const tel_check = /^01(?:0|1|[6-9])-(?:\d{3}|\d{4})-\d{4}$/;
    const email_check = /^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*.[a-zA-Z]{2,3}$/i;
    if( !id_check.test($("#signup_id_ksg").val()) || $("#signup_id_ksg").val() == ""){
        idx = 1;
        $(".signup_id_check").html("* 영문 대소문자, 숫자 조합 6~15자 이내로 입력하세요.").css("visibility", "visible");
        $("#signup_id_ksg").css("border", "1px solid red").val("");
    }
    if( !pw_check.test($("#signup_pw_ksg").val()) || $("#signup_pw_ksg").val() == "" ){
        idx = 1;
        $(".signup_pw_check").html("* 영문 대소문자, 숫자, 특수문자(@/!/#) 조합 4~20자 이내로 입력하세요.").css("visibility", "visible");
        $("#signup_pw_ksg").css("border", "1px solid red").val("");
    }
    if( !pw_check.test($("#signup_replay_ksg").val()) || $("#signup_replay_ksg").val() == "" ){
        idx = 1;
        $(".signup_replay_check").html("* 영문 대소문자, 숫자, 특수문자(@/!/#) 조합 10자 이내로 입력하세요.").css("visibility", "visible");
        $("#signup_replay_ksg").css("border", "1px solid red").val("");
    }
    if($("#signup_pw_ksg").val() != $("#signup_replay_ksg").val()){
        idx = 1;
        $(".signup_replay_check").html("* 비밀번호가 일치하지 않습니다.").css("visibility", "visible");
        $("#signup_replay_ksg").css("border", "1px solid red").val("");
        $("#signup_pw_ksg").css("border", "1px solid red").val("");
    }
    if( name_check.test($("#signup_name_ksg").val()) || $("#signup_name_ksg").val() == "" ){
        idx = 1;
        $(".signup_name_check").html("* 한글 이름만 입력해주세요.").css("visibility", "visible");
        $("#signup_name_ksg").css("border", "1px solid red").val("");
    }
    if( !nameen_check.test($("#signup_nameen_ksg").val()) || $("#signup_nameen_ksg").val() == ""){
        idx = 1;
        $(".signup_nameen_check").html("* 영문 이름만 입력해주세요.").css("visibility", "visible");
        $("#signup_nameen_ksg").css("border", "1px solid red").val("");
    }
    if( !nameen_check.test($("#signup_from_ksg").val()) || $("#signup_from_ksg").val() == ""){
        idx = 1;
        $(".signup_from_check").html("* 국적을 영문으로 입력해주세요.").css("visibility", "visible");
        $("#signup_from_ksg").css("border", "1px solid red").val("");
    }    
    if( !tel_check.test($("#signup_phone_ksg").val()) || $("#signup_phone_ksg").val() == ""){
        idx = 1;
        $(".signup_phone_check").html("* 휴대폰 번호를 숫자와 \"-\" 포함하여 정확하게 입력해주세요.").css("visibility", "visible");
        $("#signup_phone_ksg").css("border", "1px solid red").val("");
    }
    if( !email_check.test($("#signup_email_ksg").val()) || $("#signup_email_ksg").val() == ""){
        idx = 1;
        $(".signup_email_check").html("* 이메일 주소를 정확하게 입력해주세요.").css("visibility", "visible");
        $("#signup_email_ksg").css("border", "1px solid red").val("");
    }
    if( $("#signup_id_check_ksg").val() == "" ){
        idx = 1;        
        $(".signup_id_check").html("* 아이디 중복확인 해주세요.").css("visibility", "visible");
        $(".signup_id_button_ksg").css("border", "1px solid red");
    }
    if( $("#signup_sex_check").val() == "" ){
        idx = 1;        
        $(".signup_name_check").html("* 성별을 선택해주세요.").css("visibility", "visible");
        $(".signup_man_button_ksg").css("border", "1px solid red");
        $(".signup_woman_button_ksg").css("border", "1px solid red");
    }
    if( $("#signup_birth_ksg").val() == "" ){
        idx = 1;        
        $(".signup_birth_check").html("* 생년월일을 입력해주세요.").css("visibility", "visible");
        $(".signup_birth_ksg").css("border", "1px solid red");
    }
    if( $("#signup_address_ksg").val() == "" ){
        idx = 1;        
        $(".signup_address_check").html("* 생년월일을 입력해주세요.").css("visibility", "visible");
        $(".signup_address_ksg").css("border", "1px solid red");
    }
    if(idx2 == 1){
        $(".signup_id_check").html("* 아이디 중복확인 해주세요.").css("visibility", "visible");
        $(".signup_id_button_ksg").css("border", "1px solid red");
    }
    if( idx == 0 ){
        $("#signup_form_ksg").submit();
    }
});

reset_hidden =(id, cls)=>{
    $("#"+id).focusin(function(){
    $("."+cls).css("visibility", "hidden");
    $("#"+id ).css("border", "1px solid lightgrey");
    });
}

reset_hidden("signup_id_ksg", "signup_id_check");
reset_hidden("signup_pw_ksg", "signup_pw_check");
reset_hidden("signup_replay_ksg", "signup_replay_check");
reset_hidden("signup_name_ksg", "signup_name_check");
reset_hidden("signup_nameen_ksg", "signup_nameen_check");
reset_hidden("signup_birth_ksg", "signup_birth_check");
reset_hidden("signup_from_ksg", "signup_from_check");
reset_hidden("signup_phone_ksg", "signup_phone_check");
reset_hidden("signup_email_ksg", "signup_email_check");
reset_hidden("signup_address_ksg", "signup_address_check");

//main1 필수 항목 체크 후 submit
$("#main1_search_button").on("click", function(){
    let check = 0;
        if($("#main1_start_city").val() == 'set'){
            check = 1;
            $(".main1_alert").css("visibility", "visible");
            $("#main1_start_city").css("border", "1px solid red");
        }
        if( $("#main1_end_city").val() == 'set' ){
            check = 1;
            $(".main1_alert").css("visibility", "visible");
            $("#main1_end_city").css("border", "1px solid red");
        }        
        if($("#main1_adult").val() == '0' && $("#main1_kids").val() == '0' ){
            check = 1;
            $(".main1_alert").css("visibility", "visible");
            $("#main1_adult").css("border", "1px solid red");
            $("#main1_kids").css("border", "1px solid red");
        }
        if($("#main1_start_day").val() == ''){
            check = 1;
            $(".main1_alert").css("visibility", "visible");
            $("#main1_start_day").css("border", "1px solid red");
        }
        if( check == 0 ){
            $("#main1_form").submit();
        } else {
            return false;
        }        
});
// main1 필수 항목 리셋 이벤트
reset_none =(id)=>{
    $("#"+id).focusin(function(){
    $(".main1_alert").css("visibility", "hidden");
    $("#"+id ).css("border", "1px solid #FFB300");
    });
}
reset_none("main1_start_city");
reset_none("main1_end_city");
reset_none("main1_adult, #main1_kids");
reset_none("main1_start_day");
reset_none("main1_end_day");

$("#main1_start_day").on("change",function(){
    $("#main1_end_day").val($("#main1_start_day").val());
});
$("#x_box").on("click", function(){
    $(".pop_up").css("display", "none");
    location.href="./main.php";
});

$("#main3_submitbt_kkw").on("click", function(){
    let last_val = 0;
    const name_check = /[a-z0-9]|[ \[\]{}()<>?|`~!@#$%^&*-_+=,.;:\"'\\]/g;
    const nameen_check = /^[a-zA-Z]*$/;
    const tel_check = /^01(?:0|1|[6-9])-(?:\d{3}|\d{4})-\d{4}$/;
    const email_check = /^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*.[a-zA-Z]{2,3}$/i;

    let i = 0;
    while( i < $("input[name=\"passenger_name[]\"]").length){
        if(name_check.test($("input[name=\"passenger_name[]\"]").eq(i).val()) || $("input[name=\"passenger_name[]\"]").eq(i).val() == ""){
            last_val = 1;
            $("input[name=\"passenger_name[]\"]").eq(i).css("border", "1px solid red");
            $(".air_alert").css("visibility", "visible");
        }
        if(!nameen_check.test($("input[name=\"passenger_nameen[]\"]").eq(i).val()) || $("input[name=\"passenger_nameen[]\"]").eq(i).val() == ""){
            last_val = 1;
            $("input[name=\"passenger_nameen[]\"]").eq(i).css("border", "1px solid red");
            $(".air_alert").css("visibility", "visible");
        }
        if(!nameen_check.test($("input[name=\"passenger_national[]\"]").eq(i).val()) || $("input[name=\"passenger_national[]\"]").eq(i).val() == ""){
            last_val = 1;
            $("input[name=\"passenger_national[]\"]").eq(i).css("border", "1px solid red");
            $(".air_alert").css("visibility", "visible");
        }                
        if($("input[name=\"passenger_birthday[]\"]").eq(i).val() == ""){
            last_val = 1;
            $("input[name=\"passenger_birthday[]\"]").eq(i).css("border", "1px solid red");
            $(".air_alert").css("visibility", "visible");
        }
        if($("select[name=\"passenger_gender[]\"]").eq(i).val() == "set"){
            last_val = 1;
            $("select[name=\"passenger_gender[]\"]").eq(i).css("border", "1px solid red");
            $(".air_alert").css("visibility", "visible");
        }        
        i++;
    }
    if(!email_check.test($("#leader_email").val()) || $("#leader_email").val() == "" ){
        last_val = 1;
        $("#leader_email").css("border", "1px solid red");
        $(".air_alert").css("visibility", "visible");
    }        
    if(!tel_check.test($("#leader_phone").val()) || $("#leader_phone").val() == "" ){
        last_val = 1;
        $("#leader_phone").css("border", "1px solid red");
        $(".air_alert").css("visibility", "visible");
    }
    if( last_val == 1 ){
        return false;
    } else {
        $("#air_check").submit();
    }
});

$(".main_2_jy").focusin(function(e){
    $(e.target).css("border","1px solid lightgrey");
    $(".air_alert").css("visibility", "hidden");
});
$("#leader_email, #leader_phone").focusin(function(e){
    $(e.target).css("border","1px solid lightgrey");
    $(".air_alert").css("visibility", "hidden");
});
//일반 회원 예약 조회 삭제 시 패스워드 입력 창
$(".admin_delete_bt").on("click", function(e){
    $(e.target).parents('.main4_selectbox_kkw').prev().css("display", "block");
});
$(".pass_box>img").on("click", function(e){
    $(e.target).parent().css("display", "none");
});
//관리자 모드 아이디 검색

//관리자 모드 회원정보 수정
$('.ad_button_ksg').on("click", function(){
    const id_check = /^[a-zA-Z0-9]{6,15}$/;
    const pw_check = /^[a-zA-Z0-9\@\!\#]{4,20}$/;
    const name_check = /[a-z0-9]|[ \[\]{}()<>?|`~!@#$%^&*-_+=,.;:\"'\\]/g;
    const nameen_check = /^[a-zA-Z]*$/;
    const tel_check = /^01(?:0|1|[6-9])-(?:\d{3}|\d{4})-\d{4}$/;
    const email_check = /^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*.[a-zA-Z]{2,3}$/i;
    let idx = 0;
//임시 비밀번호
    if( !pw_check.test($(".ad_pw_ksg").val()) || $(".ad_pw_ksg").val() == "" ){
        idx = 1;
        $(".ad_pw_alert").css("visibility", "visible");
        $(".ad_pw_ksg").css("border", "1px solid red").val("");
    }
//임시 비밀번호 재확인
    if( !pw_check.test($(".ad_replay_ksg").val()) || $(".ad_replay_ksg").val() == "" ){
        idx = 1;
        $(".ad_pw_alert").css("visibility", "visible");
        $(".ad_replay_ksg").css("border", "1px solid red").val("");
    }
//임시 비밀번호 / 임시 비밀번호 재확인 시 일치여부 확인
    if($(".ad_pw_ksg").val() != $(".ad_replay_ksg").val()){
        idx = 1;
        $(".ad_pw_alert").css("visibility", "visible");
        $(".ad_replay_ksg").css("border", "1px solid red").val("");
        $(".ad_pw_ksg").css("border", "1px solid red").val("");
    }
//한글 이름
    if( name_check.test($(".ad_name_ksg").val()) || $(".ad_name_ksg").val() == "" ){
        idx = 1;
        $(".ad_name_alert").css("visibility", "visible");
        $(".ad_name_ksg").css("border", "1px solid red").val("");
    }
//영문 이름
    if( !nameen_check.test($(".ad_nameen_ksg").val()) || $(".ad_nameen_ksg").val() == ""){
        idx = 1;
        $(".ad_nameen_alert").css("visibility", "visible");
        $(".ad_nameen_ksg").css("border", "1px solid red").val("");
    }
//영문 국적
    if( !nameen_check.test($(".ad_from_ksg").val()) || $(".ad_from_ksg").val() == ""){
        idx = 1;
        $(".ad_from_alert").css("visibility", "visible");
        $(".ad_from_ksg").css("border", "1px solid red").val("");
    }
// 연락처 확인    
    if( !tel_check.test($(".ad_phone_ksg").val()) || $(".ad_phone_ksg").val() == ""){
        idx = 1;
        $(".ad_phone_alert").css("visibility", "visible");
        $(".ad_phone_ksg").css("border", "1px solid red").val("");
    }
// 이메일 확인
    if( !email_check.test($(".ad_email_ksg").val()) || $(".ad_email_ksg").val() == ""){
        idx = 1;
        $(".ad_email_alert").css("visibility", "visible");
        $(".ad_email_ksg").css("border", "1px solid red").val("");
    }
// 성별
    if( $("ad_sex_check").val() == "" ){
        idx = 1;        
        $(".ad_name_alert").css("visibility", "visible");
        $(".ad_man_button_ksg").css("border", "1px solid red");
        $(".ad_woman_button_ksg").css("border", "1px solid red");
    }
//생년월일 확인
    if( $(".ad_birth_ksg").val() == "" ){
        idx = 1;        
        $(".ad_birth_alert").css("visibility", "visible");
        $(".ad_birth_ksg").css("border", "1px solid red");
    }
// 주소 확인
    if( $(".ad_address_ksg").val() == "" ){
        idx = 1;        
        $(".ad_address_alert").css("visibility", "visible");
        $(".ad_address_ksg").css("border", "1px solid red");
    }
// 최종 확인
    if( idx == 0 ){
        $(".ad_form_ksg").submit();
    }
});

//회원정보 수정 시 포커스 이벤트
ad_focus =(inclass, nameclass)=>{
    $("."+inclass).focusin(function(){
        $("."+inclass).css("border","1px solid lightgrey");
        $("."+nameclass).css("visibility", "hidden");
    });
}
ad_focus("ad_pw_ksg", "ad_pw_alert");
ad_focus("ad_replay_ksg", "ad_pw_alert");
ad_focus("ad_name_ksg", "ad_name_alert");
ad_focus("ad_nameen_ksg", "ad_nameen_alert");
ad_focus("ad_birth_ksg", "ad_birth_alert");
ad_focus("ad_from_ksg", "ad_from_alert");
ad_focus("ad_phone_ksg", "ad_phone_alert");
ad_focus("ad_email_ksg", "ad_email_alert");
ad_focus("ad_address_ksg", "ad_address_alert");

//취소 시 비밀번호 이벤트 비동기
$('.check_box').click(function(e){
    $.ajax({
        url:'./aigoo.php?pw='+$(e.target).prev().prev().children().eq(1).val()+"&booking="+$(e.target).parent().next().children('div').children().eq(1).val()+"&id="+$(e.target).prev().prev().children().eq(2).val(),
        type : "GET",
        success:function(data){
            const del_check = data == false ? "1" : "0";
            console.log(data);
		if( del_check == "1" ){
			$(".pass_box p").css("visibility", "visible");
            $(e.target).prev().prev().children().eq(1).val("");
		} else {
            location.href="./aigoo.php?main=0";
		}
        }
    });
});

$("input[name=\"pass\"]").on("focusin", function(){
	$(".pass_box p").css("visibility", "hidden");
});

// 메인 메뉴 시 페이지 이동
$(".main_menu").on("click", function(e){
    switch(e.target.id){
        case 'main_menu1' :
            location.href="./main.php";
        break;
        case 'main_menu2' :
            location.href="./aigoo.php?main=0";
        break;
        case 'main_menu3' :
            location.href="./mypage.php";
        break;
    }
});

// 메인 로고 클릭 시 메인 페이지 이동
$(".main_logo_img").on("click", function(){
    location.href="./main.php";
});

// 탑승자 정보 마우스 오버 시 이벤트
$(".booking_info").on("mouseenter", function(e){
    $(e.target).parent().next().stop().slideDown();
});
$(".booking_info").on("mouseleave", function(e){
    $(e.target).parent().next().slideUp();
});

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
$("#signup_birth_ksg, #kd_birth, #ad_birth").attr("max", date);
