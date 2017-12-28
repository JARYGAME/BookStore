<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2017/1/6
 * Time: 22:28
 */
namespace Home\Controller;
use Think\Controller;

class HomePageController extends Controller{
    public function homePage(){
        if (IS_POST){
            //退出登录请求
            $where = I('post.info');
//            $where = $_POST["info"];
            if($where == "quit_Login") {
                $this->assign('is_login', 0);
                //清楚当前session
                session(null);
                echo json_encode($where);
            }
        }else{
            //判断当前是否有用户登录着
            if(session('?user_name')){
                $data = array(
                    'user_name' => session('user_name'),
                    'user_id' => session('user_id')
                );
                $user = M('user');
                $result = $user->where($data)->find();
                $this->assign('user_name',$result['user_nickname']);
                $this->assign('is_login', 1);
                $this->showBook();
                $this->display();
            }else{
                $this->assign('is_login', 0);
                $this->showBook();
                $this->display();
            }
        }
    }

    public function test(){
        $where = $_POST["info"];

        echo json_encode($where);
    }

    public function showBook(){
        $book = M('book');

        $result = $book->select();

        $this->assign('book', $result);
    }

    public function bookDetail(){
        $book = M('book');

        $condition['book_isbn'] = I('post.info');
        $result = $book->where($condition)
            ->join('JOIN bs_book_info ON bs_book.book_info_id = bs_book_info.book_info_id')->find();
        echo json_encode($result);
    }

    public function buyBook(){
        $order = M('order');
        $book = M('book');
        $user = M('user');

        $book_isbn = I('post.info');
        $condition['book_ISBN'] = $book_isbn;
        $result2 = $book->where($condition)->find();

        //库存减少
        $remain_num = $result2['remain_num'];
        $remain_num = $remain_num - 1;
        //销量增加
        $sold_num = $result2['sold_num'];
        $sold_num = $sold_num + 1;

//        $data['remain_num'] = $remain_num;

        $book->where($condition)->setField('remain_num', $remain_num);
        $book->where($condition)->setField('sold_num', $sold_num);

        //余额减少
        $condition2['user_id'] = session('user_id');
        $result3 = $user->where($condition2)->find();

        $balance = $result3['user_balance'];
        $balance = $balance - $result2['price'];

        $user->where($condition2)->setField('user_balance', $balance);

        $data = array(
            'book_ISBN' => $book_isbn,
            'user_id' => session('user_id'),
            'order_time' => date('Y-m-d H:i:s'),
            'order_price' => $result2['price'],
            'order_state' => 0,
            'book_num' => 1
        );

        $result = $order->add($data);

        if($result){
            $r['r'] = "success";
            echo json_encode($r);
        }else{
            $r['r'] = "error";
            echo json_encode($r);
        }
    }

    public function shopping($id){
        $shopping_cart = M('shopping_cart');

        $data = array(
            'book_ISBN' => $id,
            'user_id' => session('user_id'),
            'book_num' => 1
        );

        $result = $shopping_cart->add($data);

        if($result)
            $this->success('购物车添加成功',U('homePage'));
        else
            $this->error('购物车添加失败',U('homePage'));
    }

    public function searchBook($text){
        $user_name = session('user_name');
        $this->assign('user_name',$user_name);
        $book = M('book');
        $data = $text;
        $string = '%'.$data."%";

        $condition['book_name'] = array('like',$string);

        $result = $book->where($condition)->select();

        $this->assign('search_result', $result);
        $this->display();
    }
}