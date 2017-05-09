<?php
namespace Admin\Controller;
use Think\Controller;
class ManagerController extends CommonController{
	public function showlist(){
        $da=__FUNCTION__;
        $locate=getLoc($da);
        $this->assign('locate',$locate);
		$data = M('Manager') -> select();
		$this->assign('data',$data);
		$this->display();
	}
}