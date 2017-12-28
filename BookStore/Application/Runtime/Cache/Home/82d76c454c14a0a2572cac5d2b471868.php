<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>注册</title>
    <style>
        body{ text-align:center}
        #div{position: absolute;width:400px;height:200px;left:50%;top:50%;
            margin-left:-200px;margin-top:-200px;}
    </style>
</head>
<script>
    function register() {
        var password = form_register.user_password;
        var repassword = form_register.user_repassword;
        if(password.value != repassword.value){
            alert("两次密码的输入不一致！请重新输入");
            password.value = "";
            repassword.value = "";
            password.focus();
            return false;
        }
    }

</script>
<body>
<div id="div">
    <h1>注册</h1>
    <a href="<?php echo U('Home/HomePage/homePage');?>">回到主页</a>
    <a href="<?php echo U('Home/LoginRegister/login');?>">已经注册，点击登录</a>
    <form action="<?php echo U('Home/LoginRegister/register');?>" name="form_register" id="form_register" method="post">
        <input type="text" name="user_name" id="user_name" placeholder="用户名"><br>
        <input type="password" name="user_password" id="user_password" placeholder="密码"><br>
        <input type="password" name="user_repassword" id="user_repassword" placeholder="确认密码"><br>
        <input type="text" name="user_nickname" id="user_nickname" placeholder="昵称"><br>
        <input type="text" name="user_address" id="user_address" placeholder="收货地址"><br>
        <input type="text" name="user_phone" id="user_phone" placeholder="联系方式"><br>
        密保问题<br>
        <select name="user_question" id="user_question">
            <option value="music">你最喜欢的歌曲是什么</option>
            <option value="food">你最喜欢的美食是什么</option>
            <option value="scene">你最喜欢的风景是什么</option>
        </select><br>
        <input type="text" name="user_answer" id="user_answer" placeholder="回答"><br>
        <br>
        <button type="submit" name="user_submit" id="user_submit" onclick="return register();">注册</button>
    </form>
</div>
</body>
</html>