<?php
namespace Home\Model;
use Home\Model\BaseModel;
// 描述：用于公共服务管理下的操作
class ServiceModel extends BaseModel{
    
    private $Module = "service";
    private $Controller = "service";
    
    private $fetchs_router = "servicelist";
    private $add_router = "serviceadd";
    private $save_router = "serviceedit";
    private $delete_router = "servicedelete";
    private $setvisible_router = "servicedisplay";
    private $singleview_router = "servicedesc";
   
    //列表
    public function fetchs($params) {
        $apiData = c_call_service($this->Module, $this->Controller, $this->fetchs_router,$params);
        return $apiData;
    }
    
    //列表
    public function single_view($params) {
        $apiData = c_call_service($this->Module, $this->Controller, $this->singleview_router,$params);
        return $apiData;
    }
    
    /*
    添加
    **/
    public function add($params) {
        $apiData = c_call_service($this->Module, $this->Controller, $this->add_router,$params);
        return $apiData;
    }
    
    /*
    修改
     *      */
    public function save($params) {
        $apiData = c_call_service($this->Module, $this->Controller, $this->save_router,$params);
        return $apiData;
    }
    
    //删除
    public function delete($params) {
        $apiData = c_call_service($this->Module, $this->Controller, $this->delete_router,$params);
        return $apiData;
    }
    
    //设置上下架
    public function set_visible($params) {
        $apiData = c_call_service($this->Module, $this->Controller, $this->setvisible_router,$params);
        return $apiData;
    }
    
}
