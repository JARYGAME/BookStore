<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>管理员主页</title>
    <style>
        body{ text-align:center}
        #div{position: absolute;width:600px;height:200px;left:42%;top:50%;
            margin-left:-200px;margin-top:-200px;}
    </style>
</head>
<body>
<div id="div">
    <a href="<?php echo U('Home/Admin/showBook');?>">查看书籍信息</a>
    <a href="<?php echo U('Home/Admin/addBook');?>">增加书籍</a>
    <a href="<?php echo U('Home/HomePage/homePage');?>">回到主页</a>
    <div>
        <b>订单详情</b>
        <table>
            <tr>
                <td>书名</td>
                <td>用户名</td>
                <td>下单时间</td>
                <td>订单状态</td>
                <td>订单金额</td>
                <td>数量</td>
                <td>操作</td>
            </tr>
            <?php if(is_array($order)): $i = 0; $__LIST__ = $order;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$o): $mod = ($i % 2 );++$i;?><tr>
                    <td><?php echo ($o["book_name"]); ?></td>
                    <td><?php echo ($o["user_name"]); ?></td>
                    <td><?php echo ($o["order_time"]); ?></td>
                    <td>
                        <?php if($o["order_state"] == 0): ?>未受理
                            <?php elseif($o["order_state"] == 1): ?>已发货<?php endif; ?>
                    </td>
                    <td><?php echo ($o["order_price"]); ?></td>
                    <td><?php echo ($o["book_num"]); ?></td>
                    <td><a href="javascript:void(0);" onclick="deliver('<?php echo ($o["order_id"]); ?>')">发货</a></td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>
    </div>
    <script>
        function deliver(id) {
            window.location.href="http://localhost/bookstore/index.php/Home/Admin/updateOrder?id=" + id;
        }
    </script>
</div>
</body>
</html>