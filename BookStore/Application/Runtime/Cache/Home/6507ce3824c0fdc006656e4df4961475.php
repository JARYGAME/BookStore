<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>
        body{ text-align:center}
        #div{position: absolute;width:400px;height:200px;left:50%;top:50%;
            margin-left:-200px;margin-top:-100px;}
    </style>
</head>
<script type="text/javascript" src="/bookstore/Public/jquery.js"></script>
<body>
<div id="div">
    <input type="text" name="user_name" id="user_name" placeholder="输入用户名">
    <a href="javascript:void(0);" onclick="sub()">提交</a>
</div>
</body>
<script>
    function sub() {
        var temp = $('#user_name').val();
        window.location.href="http://localhost/bookstore/index.php/Home/LoginRegister/findPassword?user_name=" + temp;
    }
</script>
</html>