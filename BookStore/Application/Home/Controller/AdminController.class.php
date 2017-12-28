<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2017/1/8
 * Time: 13:54
 */
namespace Home\Controller;
use Think\Controller;

class AdminController extends Controller{
    public function adminIndex(){
        $this->showOrder();
        $this->display();
    }

    public function addBook(){
        if (IS_POST){
            $book_data = array(
                'book_ISBN' => I('book_ISBN'),
                'book_name' => I('book_name'),
                'price' => I('price'),
                'remain_num' => I('remain_num')
            );

            if($book_data['price'] <= 0)
                $this->error('价格要大于零！',U('Home/Admin/adminIndex'));

            if($book_data['remain_num'] <= 0)
                $this->error('库存要大于零！',U('Home/Admin/adminIndex'));

            $book_info_data = array(
                'book_author' => I('book_author'),
                'book_intro' => I('book_intro'),
                'book_printing_time' => I('book_printing_time'),
                'book_page_num' => I('book_page_num'),
                'book_publisher' => I('book_publisher')
            );

            if($book_info_data['book_page_num'] <= 0)
                $this->error('页数要大于零！',U('Home/Admin/adminIndex'));

            $book = M('book');
            $book_info = M('book_info');

            $result1 = $book_info->add($book_info_data);
            $book_data['book_info_id'] = $result1;
            $result = $book->add($book_data);

            if($result && $result1)
                $this->success('增加成功',U('Home/Admin/adminIndex'));
            else
                $this->error('增加失败',U('Home/Admin/adminIndex'));
        }else{
            $this->display();
        }
    }

    public function showOrder(){
        $order = M('order');

        $result = $order->join('JOIN bs_book ON bs_order.book_ISBN = bs_book.book_ISBN')
            ->join('JOIN bs_user ON bs_order.user_id = bs_user.user_id')->select();

        $this->assign('order', $result);
    }

    public function updateOrder($id){
        $order = M('order');

        $condition['order_id'] = $id;

        $result = $order->where($condition)->setField('order_state', 1);

        if($result)
            $this->success('订单修改成功',U('adminIndex'));
        else
            $this->error('订单修改失败',U('adminIndex'));
    }

    public function showBook(){
        $book = M('book');

        $result = $book->join('JOIN bs_book_info ON bs_book.book_info_id = bs_book_info.book_info_id')->select();

        $this->assign('book', $result);
        $this->display();
    }

    public function deleteBook($id){
        $book = M('book');

        $condition['book_ISBN'] = $id;

        $result = $book->where($condition)->delete();

        if($result)
            $this->success('删除成功',U('adminIndex'));
        else
            $this->error('删除失败',U('adminIndex'));
    }
}