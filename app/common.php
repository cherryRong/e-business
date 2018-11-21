<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
/**
 * 打印函数
 * @author Rong
 * @param  [type] $data [description]
 * @return [type]       [description]
 */
function p($data){
   header("content-type:text/html;charset=utf-8");
   echo "<pre>";
   print_r($data);
}
/**
 * 让子类和父类紧挨着
 * @author Rong
 * @param  [type]  $data     要处理的数组
 * @param  integer $parentId f父类id
 * @param  integer $level   层级
 * @return array         处理好的数组
 */
function getCatSon($data,$id='cat_id',$parentId=0,$level=1){
   static $arr = array();
   foreach ($data as $key => $val) {
      if($val['parent_id'] == $parentId){
          $val['level'] = $level;
          $arr[] = $val;
          getCatSon($data,$id,$val["$id"],$level+1);

      }
   }
   return $arr;
}

/**
 * 三级分类-找到孩子装进父亲son下标
 * @author Rong
 * @param  [type]  $data     [description]
 * @param  integer $parentId [description]
 * @return [type]            [description]
 */
function getThree($data,$id='cat_id',$parentId = 0){
  $arr = [];
  foreach ($data as $key => $val) {
    //找孩子
    if($val['parent_id']==$parentId){

        
        $val['son'] = getThree($data,$id,$val["$id"]);
        $arr[]= $val;
    }
  }
  return $arr;
}
/**
 * 找孩子
 * @author Rong
 * @param  [type]  $data    [description]
 * @param  integer $parenId [description]
 * @return [type]           [description]
 */
function getSon($data,$parentId = 0){
  static $arr = [];
  foreach ($data as $key => $val) {
    if($val['parent_id']==$parentId){
        $arr[] = $val;
        getSon($data,$val['cat_id']);
    }
  }
  return $arr;
}


function getExc($arr,$filename){
    
      //1.实例化PHPExcel类 等同于在桌面上新建一个excel
      $objPHPExcel = new \PHPExcel();

      //2.设定活动sheet
      $objPHPExcel->setActiveSheetIndex(0);
      //3.获取活动表
      $objSheet = $objPHPExcel->getActiveSheet();


      //$objSheet->setCellValue('A1','姓名')->setCellValue('B1','年龄');
     // $objSheet->fromArray($h);
      $objSheet->fromArray($arr);

      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
      header('Cache-Control: max-age=0');
      //5.生成excel文件
      $objWriter=\PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');

      $objWriter->save("php://output");//输出到浏览器
    }