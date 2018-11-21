<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;

class Brand extends Controller
{  
	  //展示
    public function index()
    { 
       //接brand_name
       $brand_name = input('brand_name','');
       $where['brand_name'] = array('like',"%$brand_name%");
       $brandList = Db::name("brand")->where($where)->paginate(2);
       $page = $brandList->render();
       //转数组
       $brandList =  $brandList->toArray();
       $brandList = $brandList['data'];
       
      //处理状态
      foreach ($brandList as $key => $val) {
        if($val['is_show']=='1'){
           $brandList[$key]['is_show'] = '<img src="images/yes.gif">';
        }else{
          $brandList[$key]['is_show'] = '<img src="images/no.gif">';
        }
      }
      //判断是否是Ajax请求
      if(request()->isAjax()){
           $result['data'] =  $brandList;
           $result['page'] = $page;
           return json($result);
      }
      //dump($brandList);
      $this->assign('brandList',$brandList);
      $this->assign('page',$page);
      $this->assign('brand_name',$brand_name);
      return view();
    }

    //添加
    public function add(){
    	//判断是否是post请求
    	if(request()->isPost()){
          $data = input("post.");
          $filename = 'brand_logo';
          $data['brand_logo'] = $this->upload($filename);
          $res = Db::name("brand")->insert($data);
          if($res){
                $this->success("添加成功",url('index'));
          }else{
                $this->error("添加失败");
          }
          
    	}else{
    		return view();
    	}
    }

    public function upload($filename){
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file($filename);
        // 移动到框架应用根目录/public/uploads/ 目录下
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
         if($info){
            // 成功上传后 获取上传信息
            return $info->getSaveName();

         }else{
             // 上传失败获取错误信息
              echo $file->getError();
          }
    }






    //删除
    public function del(){

        $brand_id = input('brand_id');
        $res = Db::name('brand')->delete($brand_id);
        if($res){
          $this->success("删除成功",url('index'));
        }else{
          $this->error("删除失败");
        }
    }
    //修改
    public function edit(){
        if(request()->isPost()){
           $data = input('post.');
           $brand_id = input("post.brand_id");

          
           $res = Db::name("brand")->where("brand_id = $brand_id")->update($data);
           if($res){
             $this->success("修改成功",url('index'));
           }else{
             $this->error("修改失败");
           }
        }else{
            $brand_id = input('brand_id');
            $brand = Db::name("brand")->where("brand_id = $brand_id ")->find();
            $this->assign("brand",$brand);
            return view();
        }
     
    }
   
   
}

?>