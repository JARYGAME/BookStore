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
<body>
<div id="div">
    <form action="<?php echo U('Home/LoginRegister/getPassword');?>" name="form_change" id="form_change" method="post">
        密保问题
        <br>
        <?php echo ($question); ?>
        <br>
        <input type="text" name="user_answer" id="user_answer" placeholder="回答">
        <button type="submit" name="user_submit" id="user_submit" onclick="">提交</button>
    </form>
</div>
</body>
</html>