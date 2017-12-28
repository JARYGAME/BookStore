<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<script type="text/javascript" src="/bookstore/Public/jquery.js"></script>
<body>
<div align="center">
    <h1>欢迎进入网上书店！</h1>
</div>
<div align="center">
    <?php switch($is_login): case "0": ?><a href="<?php echo U('Home/LoginRegister/login');?>">登录</a>
            <a href="<?php echo U('Home/LoginRegister/register');?>">注册</a>
            <a href="<?php echo U('Home/LoginRegister/adminLogin');?>">我是管理员</a><?php break;?>
        <?php case "1": ?>亲爱的<?php echo ($user_name); ?>，您好
            <a href="<?php echo U('Home/User/userIndex');?>">个人中心</a>
            <a href="" onclick="quit()">退出登录</a><?php break; endswitch;?>

    <br>
    <br>
    <br>
    <br>
    搜索你想要的书籍
    <input type="text" id="search" name="search">
    <a href="javascript:void(0);" onclick="searchBook()">搜索</a>
    <br>
    <br>
    <br>
    <br>
    热销书籍列表
    <div id="book_all">
        <table>
            <tr>
                <td>ISBN</td>
                <td>书名</td>
                <td>价格</td>
                <td>库存</td>
                <td>销量</td>
                <td>状态</td>

            </tr>
            <?php if(is_array($book)): $i = 0; $__LIST__ = $book;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$b): $mod = ($i % 2 );++$i;?><tr>
                    <td><?php echo ($b["book_isbn"]); ?></td>
                    <td><?php echo ($b["book_name"]); ?></td>
                    <td><?php echo ($b["price"]); ?></td>
                    <td><?php echo ($b["remain_num"]); ?></td>
                    <td><?php echo ($b["sold_num"]); ?></td>
                    <td>
                        <?php if($b["book_state"] == 0): ?>在售
                            <?php elseif($b["book_state"] == 1): ?>已下架<?php endif; ?>
                    </td>
                    <td><a href="javascript:void(0);" onclick="detail('<?php echo ($b["book_isbn"]); ?>')">查看详情</a></td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>
    </div>
    <div id="book_details" hidden="hidden">
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
            </tr>
            <tr>
                <td><span id="book_isbn"></span></td>
                <td><span id="book_name"></span></td>
                <td><span id="price"></span></td>
                <td><span id="remain_num"></span></td>
                <td><span id="book_state"></span></td>
                <td><span id="book_author"></span></td>
                <td><span id="book_intro"></span></td>
                <td><span id="book_printing_time"></span></td>
                <td><span id="book_page_num"></span></td>
                <td><span id="book_publisher"></span></td>
                <td><a href="javascript:void(0);" onclick="shopping()">加入购物车</a></td>
                <td><a href="javascript:void(0);" onclick="buy()">购买</a></td>
            </tr>
        </table>
        <a href="javascript:void(0);" onclick="back()">返回</a>
    </div>
</div>
<span id="isLogin" data-vid = "<?php echo ($user_name); ?>"></span>
</body>
<script>
    var book_id;

    function quit() {
        $.ajax({
            type : "post",
//            url : "index.php/Home/HomePage/homePageLogin",
            url : "http://localhost/bookstore/index.php/Home/HomePage/homePage",
            async : false,
            dataType : "json",
            data : {
                "info" : "quit_Login"
            },

            success:function (data) {
//                alert("ajax成功");
//                alert(data);
            },

            error:function (data) {
                alert("ajax操作失败");
            }
        })
    }

    function detail(isbn) {
//        alert(isbn);
        var result;
        $.ajax({
            type : "post",
            url : "http://localhost/bookstore/index.php/Home/HomePage/bookDetail",
            async : false,
            dataType : "json",
            data : {
                "info" : isbn
            },

            success:function (data) {
                result = eval(data);
//                alert(result["book_isbn"]);
//                alert(result["book_intro"]);
                book_id = result["book_isbn"];
            },

            error:function (data) {
                alert("ajax操作失败");
            }
        })

        document.getElementById("book_isbn").innerHTML = result["book_isbn"];
        document.getElementById("book_name").innerHTML = result["book_name"];
        document.getElementById("price").innerHTML = result["price"];
        document.getElementById("remain_num").innerHTML = result["remain_num"];
        document.getElementById("book_author").innerHTML = result["book_author"];
        if(result["book_state"] == 0)
            document.getElementById("book_state").innerHTML = "在售";
        else
            document.getElementById("book_state").innerHTML = "已下架";
        document.getElementById("book_intro").innerHTML = result["book_intro"];
        document.getElementById("book_printing_time").innerHTML = result["book_printing_time"];
        document.getElementById("book_page_num").innerHTML = result["book_page_num"];
        document.getElementById("book_publisher").innerHTML = result["book_publisher"];

        $('#book_details').show();
        $('#book_all').hide();
    }

    function buy() {
        var vid = $('#isLogin').attr("data-vid");
        if(vid){
            var ifBuy = confirm("确认购买这本书吗？");
            var result;
            if(ifBuy){
                $.ajax({
                    type : "post",
                    url : "http://localhost/bookstore/index.php/Home/HomePage/buyBook",
                    async : false,
                    dataType : "json",
                    data : {
                        "info" : book_id
                    },

                    success:function (data) {
                        result = eval(data);
                        if(result['r'] == "success")
                            alert("购买成功");
                        else
                            alert("购买失败");
                    },

                    error:function (data) {
                        alert("ajax操作失败");
                    }
                })
            }
        }else{
            alert("请先登录");
        }
    }

    function back() {
        $('#book_details').hide();
        $('#book_all').show();
    }

    function shopping() {
        var vid = $('#isLogin').attr("data-vid");

        if(vid)
            window.location.href="http://localhost/bookstore/index.php/Home/HomePage/shopping?id=" + book_id;
        else
            alert("请先登录");
    }

    function searchBook() {
        var text = $('#search').val();
        window.location.href="http://localhost/bookstore/index.php/Home/HomePage/searchBook?text=" + text;
    }
</script>
</html>