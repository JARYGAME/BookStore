<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>
        body{ text-align:center}
        #div{position: absolute;width:400px;height:200px;left:50%;top:50%;
            margin-left:-200px;margin-top:-200px;}
    </style>
</head>
<body>
<div id="div">
    <h1>修改密码</h1>
    <form action="<?php echo U('Home/User/changePassword');?>" name="form_change" id="form_change" method="post">
        <input type="text" name="old_password" id="old_password" placeholder="旧密码"><br>
        <input type="text" name="new_password" id="new_password" placeholder="新密码"><br>
        <button type="submit" name="user_submit" id="user_submit" onclick="">登录</button>
    </form>
</div>
</body>
</html>