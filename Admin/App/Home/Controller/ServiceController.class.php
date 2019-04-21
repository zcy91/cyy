<?php
/*
用户控制器
 *  */
namespace Home\Controller;
use Home\Model\ServiceModel;
use Home\Model\UserModel;
use Home\Model\RoleModel;
use Home\Plugin\Upfile;
class ServiceController extends CommonController
{
    /**
    列表
     **/
    public function service_list(){
        $p = isset($_POST['p'])?$_POST['p']:1;
        $pagesize = I("post.page_size");
        $post_data = I("post.");
        $search_str = [];
        if(!empty($post_data)){
            $search_type = $post_data['search_type'];
            switch($search_type){
                case 1: $search_str['service_name'] = $post_data['search_str']; break;  //名称
                case 2: $search_str['is_show'] = $post_data['search_str']; break;  //展示类型
            }
        }

        $service = new ServiceModel();
        $params = array(
            "pagination" => array(
                "pagesize" => $pagesize,
                "pageindex" => $p,
                "recordcount" => 0
            )
        );

        if(isset($post_data['name']) && !empty($post_data['name'])){
            $params['name'] = $post_data['name'];
        }
        if(isset($post_data['is_show'])){
            $params['is_show'] = $post_data['is_show'];
        }
        if(isset($post_data['time_limit'])){
            $params['time_limit'] = $post_data['time_limit'];
        }
        $apiData = $service->fetchs($params);
        $returnData = array(
            "totalItem" => $apiData['returnData']['recordcount'],
            "time_limit" => $apiData['returnData']['time_limit'],
            "p" => $p,
            "items"      => $apiData['returnData']['data']
        );

        $info = get_error_info($apiData['returnState']);
        $this->ajaxReturn(array("status"=>$apiData['returnState'],"data"=>$returnData,"info"=>$info));
    }
    
    //添加、编辑
    public function add_save()
    {
//        $memcache_obj = memcache_connect('192.168.0.135', 11211);
//        memcache_flush($memcache_obj);
        $post_data = $_POST;
        if (empty($post_data)) {
            $this->ajaxReturn(array("status" => 0, "info" => "参数异常"));
        }

        //处理图片上传
        if ($_FILES['file']['name']) {
            $file = new Upfile($_FILES['file']);
//            p($_FILES['file']);die;
            $post_data['icon'] = $file->get_url();
        }

        $service_id = I("id", 0, intval);
        $Service = new ServiceModel();
        if ($service_id == 0) {
//            var_dump($sellerInfo);
            $apiData = $Service->add($post_data);
        } else {
            $apiData = $Service->save($post_data);
        }

        $info = "";
        if ($apiData['returnState'] != 1) {
            $info = get_error_info($apiData['returnState']);
        } else {
            $id = $apiData['returnData']['base_service']['id'];
        }

        $this->ajaxReturn(array("status" => $apiData['returnState'], "info" => $info, "id" => $id), json);
    }
    //查询单个
    public function single_view(){
        $service_id = I("post.id",1,intval);
        if($service_id == 0){
            $this->ajaxReturn(array("status"=>0,"info"=>"参数异常"));
        }

        $Service = new ServiceModel();
        $apiData = $Service->single_view(["id"=>$service_id]);
        $response_data = [];$info = "";
        if($apiData['returnState'] == 1 && !empty($apiData['returnData'])){
            $response_data = $apiData['returnData'];
        }else{
            $info = get_error_info($apiData['returnState']);
        }
        $this->ajaxReturn(array("status"=>1,"data"=>$response_data,"info"=>$info),json);
    }

    /**
    删除
     **/
    public function delete(){
        $post_data = I("post.");

        if(!isset($post_data['id']) || $post_data['id'] == "" ||  $post_data['id'] == 0){
            $this->ajaxReturn(array("status"=>0,"info"=>"参数异常"));
        }

        $Service = new ServiceModel();
        $apiData = $Service->delete($post_data);
        $info = "";
        if($apiData['returnState'] != 1){
            $info = get_error_info($apiData['returnState']);
        }

        $this->ajaxReturn(array("status"=>$apiData['returnState'],"info"=>$info),json);
    }
}