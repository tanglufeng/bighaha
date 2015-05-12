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
use Think\Hook;
use Atlas\Api\AtlasApi;
use Think\Exception;
use Common\Exception\ApiException;

/**
 * 前台首页控制器
 * 主要获取首页聚合数据
 */
class IndexController extends AtlasController {
	private $atlasModel;
	private $atlasApi;
	
	public function _initialize(){
		$this->atlasModel = D('Atlas');
		
		$this->atlasApi = new AtlasApi();
	}
	
	public function index($page = 1) {
	    //获取图集列表
		$map['status'] = 1;
		$page = intval($page);
		$atlas_list = $this->atlasModel->page($page, 10)->order('id desc')->select();
		$totalCount = $this->atlasModel->where($map)->count();
		$list_ids = getSubByKey($atlas_list, 'id');
		$atlas_list = $this->getAtlasByIds($list_ids);
		$this->assign('atlas_list', $atlas_list);
		$this->assign('totalCount', $totalCount);
		$this->display ();
	}
	
	/**
	 * 图集详情
	 * @param unknown $id
	 */
	function detail($id){
		$detail = $this->atlasApi->getAtlas($id);
		$this->assign('detail', $detail);
		$this->display();
	}
	
	/**
	 * 喜欢还是不喜欢
	 * 
	 */
	function dolike($id,$type){
	    $likeCountArray = $this->atlasApi->dolike($id,$type);
	    //返回成功结果
	    $this->ajaxReturn(apiToAjax($likeCountArray));
	}
	
	/**
	 * 测试
	 * 
	 */
	function test(){
		
		/* $url = 'http://www.budejie.com/';
		$page_suffix = '{page}';
		$page_Count = 50;	//页码
		
		//保存Model
		
		
		//Vendor('Snoopy.Snoopy');
		require_once('ThinkPHP/Library/Vendor/Snoopy/Snoopy.class.php');
		require_once('ThinkPHP/Library/Vendor/simplehtmldom/simple_html_dom.php');
		
		$snoopy = new \Snoopy;
		$url = $url.$page_suffix;
		//循环读取页面
		for ($i = 1; $i<$page_Count; $i++){
			$siteUrl = str_replace('{page}',$i,$url);
			
			$snoopy->fetch($siteUrl); //获取所有内容
			$results = $snoopy->results;
			$html = str_get_html($results);
			foreach ($html->find('.web_left') as $webLeft){
				foreach ($webLeft->find('.post-body') as $postbody){
					$img = $postbody->find('img',0);
					$src = $img->src;
					$alt = $img->alt;
					$id = str_replace('pic-',' ',$img->id);
					//保存到数据库
					
					print_r($id);
					die();
				}
			}
			$html->clear();	//清理
		}*/
	} 
	
}