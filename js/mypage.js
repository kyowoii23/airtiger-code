//마이페이지 회원정보 수정
$('.my_button_ksg').on("click", function(){
    const pw_check = /^[a-zA-Z0-9\@\!\#]{4,20}$/;
    const nameen_check = /^[a-zA-Z]*$/;
    const tel_check = /^01(?:0|1|[6-9])-(?:\d{3}|\d{4})-\d{4}$/;
    const email_check = /^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*.[a-zA-Z]{2,3}$/i;
    let idx = 0;
//비밀번호
    if( !pw_check.test($(".my_pw_ksg").val()) || $(".my_pw_ksg").val() == "" ){
        idx = 1;
        $(".my_pw_alert").css("visibility", "visible");
        $(".my_pw_ksg").css("border", "1px solid red").val("");
    }
//비밀번호 재확인
    if( !pw_check.test($(".my_replay_ksg").val()) || $(".my_replay_ksg").val() == "" ){
        idx = 1;
        $(".my_pw_alert").css("visibility", "visible");
        $(".my_replay_ksg").css("border", "1px solid red").val("");
    }
//비밀번호 / 비밀번호 재확인 시 일치여부 확인
    if($(".my_pw_ksg").val() != $(".my_replay_ksg").val()){
        idx = 1;
        $(".my_pw_alert").css("visibility", "visible");
        $(".my_replay_ksg").css("border", "1px solid red").val("");
        $(".my_pw_ksg").css("border", "1px solid red").val("");
    }
//영문 국적
    if( !nameen_check.test($(".my_from_ksg").val()) || $(".my_from_ksg").val() == ""){
        idx = 1;
        $(".my_from_alert").css("visibility", "visible");
        $(".my_from_ksg").css("border", "1px solid red").val("");
    }
//연락처 확인    
    if( !tel_check.test($(".my_phone_ksg").val()) || $(".my_phone_ksg").val() == ""){
        idx = 1;
        $(".my_phone_alert").css("visibility", "visible");
        $(".my_phone_ksg").css("border", "1px solid red").val("");
    }
//이메일 확인
    if( !email_check.test($(".my_email_ksg").val()) || $(".my_email_ksg").val() == ""){
        idx = 1;
        $(".my_email_alert").css("visibility", "visible");
        $(".my_email_ksg").css("border", "1px solid red").val("");
    }
//생년월일 확인
    if( $(".my_birth_ksg").val() == "" ){
        idx = 1;        
        $(".my_birth_alert").css("visibility", "visible");
        $(".my_birth_ksg").css("border", "1px solid red");
    }
//주소 확인
    if( $(".my_address_ksg").val() == "" ){
        idx = 1;        
        $(".my_address_alert").css("visibility", "visible");
        $(".my_address_ksg").css("border", "1px solid red");
    }
//최종 확인
    if( idx == 0 ){
        $(".my_form_ksg").submit();
    }
});
my_focus =(inclass, nameclass)=>{
    $("."+inclass).focusin(function(){
        $("."+inclass).css("border","1px solid lightgrey");
        $("."+nameclass).css("visibility", "hidden");
    });
}
my_focus("my_pw_ksg", "my_pw_alert");
my_focus("my_replay_ksg", "my_pw_alert");
my_focus("my_name_ksg", "my_name_alert");
my_focus("my_nameen_ksg", "my_nameen_alert");
my_focus("my_birth_ksg", "my_birth_alert");
my_focus("my_from_ksg", "my_from_alert");
my_focus("my_phone_ksg", "my_phone_alert");
my_focus("my_email_ksg", "my_email_alert");
my_focus("my_address_ksg", "my_address_alert");

$(".my_pw_button_ksg").on("click", function(){
    $(".pop_up").css("display", "block");
});
$(".my_pop_up_btn").on("click", function(){
    const pw_check = /^[a-zA-Z0-9\@\!\#]{4,20}$/;
    if( !pw_check.test($(".my_pop_up_new").val()) || $(".my_pop_up_new_replay").val() == "" ){
        $(".my_pass_second").css("visibility", "visible");
        $(".my_pop_up_new_replay").css("border", "1px solid red");
        $(".my_pop_up_new").css("border", "1px solid red");
        $(".my_pop_up_new").val("");
        $(".my_pop_up_new_replay").val("");
    }else if( $(".my_pop_up_new").val() == $(".my_pop_up_new_replay").val() && $(".my_pop_up_new").val() != "" && $(".my_pop_up_new_replay").val() != "" ){
        $("#my_pass_form").submit();
    } else {
        $(".my_pass").css("visibility", "visible");
        $(".my_pop_up_new_replay").css("border", "1px solid red");
        $(".my_pop_up_new").css("border", "1px solid red");
        $(".my_pop_up_new").val("");
        $(".my_pop_up_new_replay").val("");
    }
    
});
$("#my_pass_form").on("focusin", function(e){
    $(e.target).css("border", "none");
    $(".my_pass").css("visibility", "hidden");
    $(".my_pass_second").css("visibility", "hidden");
});
$(".my_pop_up_cancle").on("click", function(){
    $(".pop_up").css("display", "none");
});
$("#pop_box").on("click", function(){
    location.href="./mypage.php";
});

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