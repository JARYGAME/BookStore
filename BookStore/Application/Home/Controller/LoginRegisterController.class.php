<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2017/1/7
 * Time: 11:21
 */
namespace Home\Controller;
use Think\Controller;

class LoginRegisterController extends Controller{
    public function login(){
        if(IS_POST){
            $data = array(
                'user_name' => I('user_name'),
                'user_password' => I('user_password')
            );

            $user = M('user');
            $exit_name['user_name'] = $data['user_name'];
            $exit_user = $user->where($exit_name)->find();

            if($exit_user){
                if($exit_user['user_password'] == $data['user_password']){
                    //登录成功
                    session('user_id', $exit_user['user_id']);
                    session('user_name', $exit_user['user_name']);

                    $this->success('登录成功', U('Home/HomePage/homePage'));
                }else{
                    $this->error('密码错误', U('Home/LoginRegister/login'));
                }
            }else{
                $this->error('输入的账号不存在!', U('Home/LoginRegister/login'));
            }
        }else{
            $this->display();
        }
    }

    public function register(){
        if(IS_POST){
            $data = array(
                'user_name' => I('post.user_name'),
                'user_password' => I('post.user_password'),
                'user_nickname' => I('post.user_nickname'),
                'user_address' => I('post.user_address'),
                'user_phone' => I('post.user_phone'),
                'user_question' => I('post.user_question'),
                'user_answer' => I('post.user_answer'),
                'user_balance' => 10000
            );

            $user = M('user');


            //检测用户名和手机号是否已经被注册
            $name_repeat['user_name'] = $data['user_name'];
            $phone_repeat = 'user_phone = '.$data['user_phone'];

            $exit_name = $user->where($name_repeat)->find();
            $exit_phone = $user->where($phone_repeat)->find();

            if ($exit_name)
                $this->error('这个用户名已被注册，注册失败',U('Home/LoginRegister/register'));
            elseif ($exit_phone)
                $this->error('这个手机号已被注册，注册失败',U('Home/LoginRegister/register'));
            else{
                $result = $user->add($data);

                if($result)
                    $this->success('注册成功');
                else
                    $this->error('注册失败');
            }
        }
        else{
            $this->display();
        }
    }

    public function adminLogin(){
        if(IS_POST){
            $data = array(
                'admin_name' => I('post.admin_name'),
                'admin_password' => I('post.admin_password')
            );
            $admin = M('admin');
//            $exit_name = 'admin_name = '.$data['admin_name'];
//            dump($admin->select());
            $exit_name['admin_name'] = $data['admin_name'];
            $exit_admin = $admin->where($exit_name)->find();
//            $exit_admin = $admin->where("admin_name = 233")->find();

            if($exit_admin){
                if($exit_admin['admin_password'] == $data['admin_password']){
                    //登录成功
                    $this->success('登录成功', U('Home/Admin/adminIndex'));
                }else{
                    $this->error('密码错误', U('Home/LoginRegister/adminLogin'));
                }
            }else{
                $this->error('输入的管理员账号错误!', U('Home/LoginRegister/adminLogin'));
            }
        }else{
            $this->display();
        }
    }

    public function findPassword($user_name)
    {
        session('user_name', $user_name);
        $user = M('user');
        $result = $user->where($user_name)->find();
//        if(IS_POST){
//            $data = I('post.answer');
////            $user_id['user_name'] = I('user_name');
//            if ($data == $result['user_answer'])
//                $this->success('密码是' . $result['user_password'], U('login'));
//            else
//                $this->error('回答错误', U('login'));
//        }else {
        $question = "";
        switch ($result['user_question']) {
            case 'music':
                $question = "你最喜欢的歌曲是什么";
                break;
            case 'food':
                $question = "你最喜欢的美食是什么";
                break;
            case 'scene':
                $question = "你最喜欢的风景是什么";
        }
        $this->assign('question', $question);
        $this->display();
//        }
    }

    public function inputUser(){
        $this->display();
    }

    public function getPassword(){
        $user_name['user_name'] = session('user_name');
        $user = M('user');
        $result = $user->where($user_name)->find();
        $answer = I('user_answer');
        if ($answer == $result['user_answer']){
            session(null);
            $this->success('密码是' . $result['user_password'], U('login'));
        }
        else{
            session(null);
            $this->error('回答错误', U('login'));
        }
    }
}