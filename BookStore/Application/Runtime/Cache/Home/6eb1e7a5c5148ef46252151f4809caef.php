<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>增加书籍</title>
    <style>
        body{ text-align:center}
        #div{position: absolute;width:400px;height:200px;left:50%;top:50%;
            margin-left:-200px;margin-top:-200px;}
    </style>
</head>
<body>
<div id="div">
    <a href="<?php echo U('Home/Admin/adminIndex');?>">回到管理员主页</a>
    <form action="" name="form_addBook" id="form_addBook" method="post">
        <input type="text" name="book_ISBN" id="book_ISBN" placeholder="ISBN"><br>
        <input type="text" name="book_name" id="book_name" placeholder="书名"><br>
        <input type="text" name="price" id="price" placeholder="价格"><br>
        <input type="text" name="remain_num" id="remain_num" placeholder="库存"><br>
        <input type="text" name="book_author" id="book_author" placeholder="作者"><br>
        <input type="text" name="book_intro" id="book_intro" placeholder="简介"><br>
        <input type="text" name="book_printing_time" id="book_printing_time" placeholder="印刷时间"><br>
        <input type="text" name="book_page_num" id="book_page_num" placeholder="页数"><br>
        <input type="text" name="book_publisher" id="book_publisher" placeholder="出版社"><br>
        <button type="submit" name="submit_add" id="submit_add">提交</button>
    </form>
</div>
</body>
</html>