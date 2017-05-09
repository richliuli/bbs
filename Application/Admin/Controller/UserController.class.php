<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/5/5
 * Time: 10:24
 */

namespace Admin\Controller;


class UserController extends CommonController{
    public function index(){
        if(IS_POST){
            $username=I('post.user_name');
            $data=M('User')->where("user_name = '$username'")->select();
        }else{
            $data=M('User')->select();
        }
        $da=__FUNCTION__;
        $locate=getLoc($da);
        $this->assign('locate',$locate);
        $this->assign('data',$data);
        $this->display('showList');
    }
    public function modify(){
        if(IS_POST){
            $post=I('post.');
            $res=M('User')->save($post);
            if($res){
                $this->success('修改成功',U('index'),3);
            }else{
                $this->error('修改失败');
            }
        }else{
            $user_id=I('get.user_id');
            $data=M('User')->find($user_id);
            $this->assign('data',$data);
            $this->display();
        }


    }
    public  function del(){
        $user_id=I('get.');
        $res=M('User')->where($user_id)->delete();
        if($res){
            $this->success('删除成功',U('index'),3);
        }else{
            $this->error('删除失败');
        }
    }
}


