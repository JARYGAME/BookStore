<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<!--<script src="jquery.js"></script>-->
<!--<script src="jquery.min.js"></script>-->
<!--<script type="text/javascript" src="http://localhost/bookstore/index.php/Home/View/HomePage/test.js"></script>-->
<script type="text/javascript" src="/bookstore/Public/test.js"></script>
<script type="text/javascript" src="/bookstore/Public/jquery.js"></script>
<body>
<b>欢迎进入网上书店！</b>
<!--<button id = "login">登录</button>-->
<!--<button id = "register">注册</button>-->
亲爱的<?php echo ($user_name); ?>，您好
<a href="" onclick="quit()">退出登录</a>
<br>
搜索你想要的书籍
<input type="text">
<button>搜索</button>
<br>
热销书籍列表
</body>
<script>
    function quit() {
        $.ajax({
            type : "post",
//            url : "index.php/Home/HomePage/homePageLogin",
            url : "http://localhost/bookstore/index.php/Home/HomePage/homePageLogin",
            async : false,
            dataType : "json",
            data : {
                "info" : "quit_Login"
            },

            success:function (data) {
                alert("ajax成功");
                alert(data);
            },

            error:function (data) {
                alert("ajax操作失败");
            }
        })
    }
</script>
</html>