
// 点击注册按钮 发起注册
$("#register").click(function () {
    var account = $("#account").val();
    var password = $("#password").val();
    var password_repeat = $("#password_repeat").val();
    var username = $("#username").val();

    $.ajax({
        type: "Post",
        url: "./mysql/register.php",
        data: {
            'account': account,
            'password': password,
            'password_repeat': password_repeat,
            'username': username,
        },
        dataType: "json",
        success: function (data) {
            let message = data['message'];
            alert(message);
        },
        error: function (data) {
            console.log(data);
        }
    });
});