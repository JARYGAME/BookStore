<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>书籍信息</title>
    <style>
        body{ text-align:center}
        #div{position: absolute;width:650px;height:200px;left:40%;top:50%;
            margin-left:-200px;margin-top:-200px;}
    </style>
</head>
<body>
<div id="div">
    <h1>书籍信息</h1>
    <a href="<?php echo U('Home/Admin/adminIndex');?>">回到管理员主页</a>
    <table>
        <tr>
            <td>ISBN</td>
            <td>书名</td>
            <td>价格</td>
            <td>库存</td>
            <td>状态</td>
            <td>作者</td>
            <td>简介</td>
            <td>印刷时间</td>
            <td>页数</td>
            <td>出版社</td>
            <td>操作</td>
        </tr>
        <?php if(is_array($book)): $i = 0; $__LIST__ = $book;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$b): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo ($b["book_isbn"]); ?></td>
                <td><?php echo ($b["book_name"]); ?></td>
                <td><?php echo ($b["price"]); ?></td>
                <td><?php echo ($b["remain_num"]); ?></td>
                <td><?php echo ($b["book_state"]); ?></td>
                <td><?php echo ($b["book_author"]); ?></td>
                <td><?php echo ($b["book_intro"]); ?></td>
                <td><?php echo ($b["book_printing_time"]); ?></td>
                <td><?php echo ($b["book_page_num"]); ?></td>
                <td><?php echo ($b["book_publisher"]); ?></td>
                <td><a href="javascript:void(0);" onclick="deleteBook('<?php echo ($b["book_isbn"]); ?>')">删除</a></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
    <script>
        function deleteBook(id) {
            window.location.href="http://localhost/bookstore/index.php/Home/Admin/deleteBook?id=" + id;
        }
    </script>
</div>
</body>
</html>