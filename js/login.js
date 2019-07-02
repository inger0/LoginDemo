
// 点击登录按钮 发起请求
$("#submit").click(function () {
    var account = $("#account").val();
    var password = $("#password").val();
    var verify = $("#verify").val();
    if (account !== "" && password !== "") {
        $.ajax({
            type: "Post",
            url: "./mysql/login.php",
            data: {
                'account': account,
                'password': password,
                'verification': verify,
            },
            dataType: "json",
            success: function (data) {
                let message = data['message'];
                alert(message);
                if (data['status'] === 200) {
                    window.location.href = "index.html"
                }
            },
            error: function (data) {
                console.log(data);
            }
        });
    } else {
        alert("请您补全信息!!!");
    }
});