<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>个人主页</title>
</head>
<body>
<div align="center">
    <b>个人中心</b>
    <a href="<?php echo U('Home/HomePage/homePage');?>">回到主页</a>
    <table>
        <tr>
            <td>昵称</td>
            <td><?php echo ($user["user_nickname"]); ?></td>
        </tr>
        <tr>
            <td>收货地址</td>
            <td><?php echo ($user["user_address"]); ?></td>
        </tr>
        <tr>
            <td>电话</td>
            <td><?php echo ($user["user_phone"]); ?></td>
        </tr>
        <tr>
            <td>余额</td>
            <td><?php echo ($user["user_balance"]); ?></td>
        </tr>
        <tr>
            <td><a href="<?php echo U('Home/User/changePassword');?>">修改密码</a></td>
        </tr>
    </table>
    <br>
    <br>
    <br>
    <b>订单详情</b>
    <table>
        <tr>
            <td>书名</td>
            <td>下单时间</td>
            <td>订单状态</td>
            <td>订单金额</td>
            <td>数量</td>
        </tr>
        <?php if(is_array($order)): $i = 0; $__LIST__ = $order;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$o): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo ($o["book_name"]); ?></td>
                <td><?php echo ($o["order_time"]); ?></td>
                <td>
                    <?php if($o["order_state"] == 0): ?>未受理
                        <?php elseif($o["order_state"] == 1): ?>已发货<?php endif; ?>
                </td>                <td><?php echo ($o["order_price"]); ?></td>
                <td><?php echo ($o["book_num"]); ?></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
    <br>
    <br>
    <br>
    <b>我的购物车</b>
    <table>
        <tr>
            <td>书名</td>
            <td>数量</td>
            <td>操作</td>
        </tr>
        <?php if(is_array($shopping_cart)): $i = 0; $__LIST__ = $shopping_cart;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$s): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo ($s["book_name"]); ?></td>
                <td><?php echo ($s["book_num"]); ?></td>
                <td><a href="javascript:void(0);" onclick="addOrder('<?php echo ($s["sp_cart_id"]); ?>')">生成订单</a></td>
                <td><a href="javascript:void(0);" onclick="deleteShopping('<?php echo ($s["sp_cart_id"]); ?>')">删除</a></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
</div>
</body>
<script>
    function addOrder(id) {
        var temp = confirm("确定生成订单吗");
        if(temp)
            window.location.href="http://localhost/bookstore/index.php/Home/User/addOrder?id=" + id;
    }

    function deleteShopping(id) {
        window.location.href="http://localhost/bookstore/index.php/Home/User/deleteShopping?id=" + id;
    }
</script>
</html>