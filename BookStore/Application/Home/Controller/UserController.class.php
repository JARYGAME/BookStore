<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2017/1/8
 * Time: 15:55
 */
namespace Home\Controller;
use Think\Controller;

class UserController extends Controller{
    public function userIndex(){
        $user = M('user');

        $data['user_id'] = session('user_id');

        $result = $user->where($data)->find();

        $this->assign('user',$result);
        $this->myOrder();
        $this->myShopping();
        $this->display();
    }

    public function myOrder(){
        $order = M('order');

        $condition['user_id'] = session('user_id');

        $result = $order->where($condition)
            ->join('JOIN bs_book ON bs_order.book_ISBN = bs_book.book_ISBN')->select();
        $this->assign('order', $result);
    }

    public function myShopping(){
        $shopping_cart = M('shopping_cart');

        $condition['user_id'] = session('user_id');

        $result = $shopping_cart->where($condition)
            ->join('JOIN bs_book ON bs_shopping_cart.book_ISBN = bs_book.book_ISBN')->select();

        $this->assign('shopping_cart',$result);
    }

    public function addOrder($id){
        $order = M('order');
        $book = M('book');
        $user = M('user');
        $shopping_cart = M('shopping_cart');

        $sp_id['sp_cart_id'] = $id;
        $result4 = $shopping_cart->where($sp_id)->find();

        $book_isbn = $result4['book_isbn'];
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
            $shopping_cart->where($sp_id)->delete();
            $this->success('订单生成成功');
        }else{
            $this->error('订单生成失败');
        }
    }

    public function deleteShopping($id){
        $shopping_cart = M('shopping_cart');

        $sp_id['sp_cart_id'] = $id;
        $result = $shopping_cart->where($sp_id)->delete();

        if($result){
            $this->success('删除成功',U('userIndex'));
        }else
            $this->error('删除失败',U('userIndex'));
    }

    public function changePassword(){
        if(IS_POST){
            $user = M('user');
            $old = I('post.old_password');
            $new = I('post.new_password');
            $user_id['user_id'] = session('user_id');

            $result = $user->where($user_id)->find();
            if($old != $result['user_password'])
                $this->error('旧密码错误', U('userIndex'));
            else{
                $result2 = $user->where($user_id)->setField('user_password', $new);
                if($result2)
                    $this->success('修改成功',U('userIndex'));
                else
                    $this->error('修改失败',U('userIndex'));
            }
        }else{
            $this->display();
        }
    }
}