<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------
namespace Atlas\Controller;
use Think\Controller;
/**
 * 前台首页控制器
 * 主要获取首页聚合数据
 */
class IndexController extends AtlasController {
	private $atlasModel;
	
	public function _initialize(){
		$this->atlasModel = D('Atlas');
	}
	
	public function index($page = 1) {
	    //获取图集列表
		$atlas_list = $this->atlasModel->page($page, 10)->select();
		$list_ids = getSubByKey($atlas_list, 'id');
		$atlas_list = $this->getAtlasByIds($list_ids);
		$this->assign('atlas_list', $atlas_list);
		$this->display ();
	}
	
	/**
	 * 喜欢还是不喜欢
	 * 
	 */
	function dolike(){
		
	}
	
}