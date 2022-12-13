"use strict";

$(".ad_man_button_ksg").on("click", function () {
  $(".ad_man_button_ksg").css("background-color", "#ffb300");
  $(".ad_woman_button_ksg").css("background-color", "lightgray");
});
$(".ad_woman_button_ksg").on("click", function () {
  $(".ad_woman_button_ksg").css("background-color", "#ffb300");
  $(".ad_man_button_ksg").css("background-color", "lightgray");
});
$(".tab_menu").on("click", function () {
  $(".yellowBar").css("visibility", "visible");
  $(".yellowBar2").css("visibility", "hidden");
});
$(".tab_menu2").on("click", function () {
  $(".yellowBar2").css("visibility", "visible");
  $(".yellowBar").css("visibility", "hidden");
});
var num = 1;
setInterval(function () {
  num = num % 3;
  $(".main1_slidecut_sky>div").fadeOut(2000);
  $(".main1_slidecut_sky>div").eq(num).fadeIn(2000);
  num++;
}, 4000);
$(".main2_price_sky").on("click", function () {
  $(".main2_price_sky").css("background-color", "#FFB300").css("border", "1px solid #FFB300");
});
$(".main2_selectprice2_sky").on("click", function () {
  $(".main2_selectprice2_sky>div").css("background-color", "#FFB300");
  var price_value = $("#main2_adult_sky").val() * $("#main2_price_sky").val() + $("#main2_kids_sky").val() * ($("#main2_price_sky").val() / 2);
  $(".main2_bottom_sky>form>div").html(price_value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ','));
}); //성별 클릭 이벤트

$(".signup_man_button_ksg").on("click", function () {
  $(".signup_man_button_ksg").css("background-color", "#ffb300");
  $(".signup_woman_button_ksg").css("background-color", "lightgray");
  $("#signup_sex_check").val("남자");
});
$(".signup_woman_button_ksg").on("click", function () {
  $(".signup_woman_button_ksg").css("background-color", "#ffb300");
  $(".signup_man_button_ksg").css("background-color", "lightgray");
  $("#signup_sex_check").val("여자");
}); //아이디 중복 확인

$('.signup_id_button_ksg').click(function () {
  $("#signup_id_check_ksg").val(0);
  $.ajax({
    url: './signup.php?id=' + $("input[name='id']").val(),
    type: "GET",
    success: function success(data) {
      var result_check = data == false ? "* 사용 불가능한 아이디입니다." : "* 사용 가능한 아이디입니다.";
      $(".signup_id_check").html(result_check).css("visibility", "visible");
    }
  });
});
$('#signup_button_ksg').on("click", function () {
  var id_check = /^[a-zA-Z0-9]{6,15}$/;
  var pw_check = /^[a-zA-Z0-9\@\!\#]*$/;
  var name_check = /[a-z0-9]|[ \[\]{}()<>?|`~!@#$%^&*-_+=,.;:\"'\\]/g;
  var nameen_check = /^[a-zA-Z]*$/;
  var tel_check = /^01(?:0|1|[6-9])-(?:\d{3}|\d{4})-\d{4}$/;
  var email_check = /^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*.[a-zA-Z]{2,3}$/i;
  var idx = 0;

  if (!id_check.test($("#signup_id_ksg").val()) || $("#signup_id_ksg").val() == "") {
    idx = 1;
    $(".signup_id_check").html("* 영문 대소문자, 숫자 조합 6~15자 이내로 입력하세요.").css("visibility", "visible");
    $("#signup_id_ksg").css("border", "1px solid red").val("");
  }

  if (!pw_check.test($("#signup_pw_ksg").val()) || $("#signup_pw_ksg").val() == "") {
    idx = 1;
    $(".signup_pw_check").html("* 영문 대소문자, 숫자, 특수문자(@/!/#) 조합 10자 이내로 입력하세요.").css("visibility", "visible");
    $("#signup_pw_ksg").css("border", "1px solid red").val("");
  }

  if (!pw_check.test($("#signup_replay_ksg").val()) || $("#signup_replay_ksg").val() == "") {
    idx = 1;
    $(".signup_replay_check").html("* 영문 대소문자, 숫자, 특수문자(@/!/#) 조합 10자 이내로 입력하세요.").css("visibility", "visible");
    $("#signup_replay_ksg").css("border", "1px solid red").val("");
  }

  if ($("#signup_pw_ksg").val() != $("#signup_replay_ksg").val()) {
    idx = 1;
    $(".signup_replay_check").html("* 비밀번호가 일치하지 않습니다.").css("visibility", "visible");
    $("#signup_replay_ksg").css("border", "1px solid red").val("");
    $("#signup_pw_ksg").css("border", "1px solid red").val("");
  }

  if (name_check.test($("#signup_name_ksg").val()) || $("#signup_name_ksg").val() == "") {
    idx = 1;
    $(".signup_name_check").html("* 한글 이름만 입력해주세요.").css("visibility", "visible");
    $("#signup_name_ksg").css("border", "1px solid red").val("");
  }

  if (!nameen_check.test($("#signup_nameen_ksg").val()) || $("#signup_nameen_ksg").val() == "") {
    idx = 1;
    $(".signup_nameen_check").html("* 영문 이름만 입력해주세요.").css("visibility", "visible");
    $("#signup_nameen_ksg").css("border", "1px solid red").val("");
  }

  if (!nameen_check.test($("#signup_from_ksg").val()) || $("#signup_from_ksg").val() == "") {
    idx = 1;
    $(".signup_from_check").html("* 영문 이름만 입력해주세요.").css("visibility", "visible");
    $("#signup_from_ksg").css("border", "1px solid red").val("");
  }

  if (!tel_check.test($("#signup_phone_ksg").val()) || $("#signup_phone_ksg").val() == "") {
    idx = 1;
    $(".signup_phone_check").html("* 휴대폰 번호를 숫자와 \"-\" 포함하여 정확하게 입력해주세요.").css("visibility", "visible");
    $("#signup_phone_ksg").css("border", "1px solid red").val("");
  }

  if (!email_check.test($("#signup_email_ksg").val()) || $("#signup_email_ksg").val() == "") {
    idx = 1;
    $(".signup_email_check").html("* 이메일 주소를 정확하게 입력해주세요.").css("visibility", "visible");
    $("#signup_email_ksg").css("border", "1px solid red").val("");
  }

  if ($("#signup_id_check_ksg").val() == "") {
    idx = 1;
    $(".signup_id_check").html("* 아이디 중복확인 해주세요.").css("visibility", "visible");
    $(".signup_id_button_ksg").css("border", "1px solid red");
  }

  if ($("#signup_sex_check").val() == "") {
    idx = 1;
    $(".signup_name_check").html("* 성별을 선택해주세요.").css("visibility", "visible");
    $(".signup_man_button_ksg").css("border", "1px solid red");
    $(".signup_woman_button_ksg").css("border", "1px solid red");
  }

  if ($("#signup_birth_ksg").val() == "") {
    idx = 1;
    $(".signup_birth_check").html("* 생년월일을 입력해주세요.").css("visibility", "visible");
    $(".signup_birth_ksg").css("border", "1px solid red");
  }

  if ($("#signup_address_ksg").val() == "") {
    idx = 1;
    $(".signup_address_check").html("* 생년월일을 입력해주세요.").css("visibility", "visible");
    $(".signup_address_ksg").css("border", "1px solid red");
  }

  if (idx == 0) {
    $("#signup_form_ksg").submit();
  }
});