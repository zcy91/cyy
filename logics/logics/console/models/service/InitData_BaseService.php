<?php
namespace console\models\service;

use console\models\BaseModel;
use console\models\base\BaseProductOperate;
use console\models\service\BaseService;
use console\models\service\View_BaseService;
use console\models\user\View_UserLogin;
use console\models\base\View_BaseAttr;
use console\models\base\View_BaseProductcategory;
use console\models\base\View_BaseProductCommission;

class InitData_BaseService extends BaseModel {

    private $sellerId;
    private $attrs;

    private function handlAttr($event){

        $View_BaseAttr = new View_BaseAttr();

        $index = 1;
        foreach ($this->attrs as $attrItem){

            if (!isset($attrItem["id"]) || !is_numeric($attrItem["id"]) || empty($attrItem["id"]) ||
                !isset($attrItem["required"]) || !is_numeric($attrItem["required"]) || !in_array($attrItem["required"],[0,1])){
                continue;
            }

            $attrId = $attrItem["id"];
            $attrData = $View_BaseAttr->getOne($event, $attrId, $this->sellerId);

            if (!empty($attrData)) {
                $event->base_product_attr_data[] = array(
                    "seller_id" => $this->sellerId,
                    "productId" => &$event->productId,
                    "attrId" => $attrId,
                    "attrName" => $attrData["dnames"],
                    "genre" => $attrData["genre"],
                    "required" => $attrItem["required"],
                    "imageCount" => $attrData["imageCount"],
                    "sort" => $index++,
                );
                $genre = $attrData["genre"];
                if (in_array($genre, [3,4])) {
                    $attrItemsData = $View_BaseAttr->getAttrItems($event, $attrId, $this->sellerId);

                    foreach ($attrItemsData as $attrItemsItem) {
                        $event->base_product_attr_item_data[] = array(
                            "seller_id" => $this->sellerId,
                            "productId" => &$event->productId,
                            "attrId" => $attrId,
                            "attrItemId" => $attrItemsItem["id"],
                            "attrItemName" => $attrItemsItem["dnames"],
                            "sort" => $attrItemsItem["sort"]
                        );
                    }
                }
            }

        }
        unset($View_BaseAttr);
    }
    public function serviceAdd($event){
        $data = &$event->RequestArgs;
        if (empty($data) || !isset($data["name"]) || empty($data["icon"])) {
            return parent::go_error($event, -12);
        }
        //判断名字是否重复
        $name = $data['name'];
        $model = new View_BaseService();
        $count = $model -> checkName(0,$name,$event);
        if($count > 0){
            return parent::go_error($event, -5044);
        }
        $ownSellerId = $this->sellerId = View_UserLogin::getOperateSellerId($data);
        if (empty($ownSellerId)) {
            return parent::go_error($event, -2011);
        }
        $nowTime = date('Y-m-d H:i:s');
        $event->service_data = array(
            "name" => $data["name"],
            "icon" => $data["icon"],
            "is_show" => (isset($data["is_show"]) && is_string($data["is_show"]) && !empty($data["is_show"])) ? $data["is_show"] : 0,
            "des" => (isset($data["des"]) && is_string($data["des"]) && !empty($data["des"])) ? $data["des"] : "",
            "seller_id" => $ownSellerId,
            "creatTime" => $nowTime,
        );
    }

    public function serviceEdit($event){
        $data = &$event->RequestArgs;
        if (empty($data) ||
            !isset($data["id"]) || empty($data["id"]) || !is_numeric($data["id"])) {
            return $this->go_error($event, -12);
        }
        if (!(isset($data["name"]) && !empty($data["name"]) && is_string($data["name"])) ||
            !(isset($data["des"]) && !empty($data["des"]) && is_string($data["des"])) ||
            !(isset($data["is_show"]) && is_numeric($data["is_show"]))
        ) {
            return parent::go_error($event, -12);
        }

        $ownSellerId = $this->sellerId = View_UserLogin::getOperateSellerId($data);
        if (empty($ownSellerId)) {
            return parent::go_error($event, -2011);
        }
        $View_BaseService = new View_BaseService();
        $count = $View_BaseService->checkName($data['id'],$data['name'],$event);
        if($count > 0){
            return parent::go_error($event, -5044);
        }
        $id = $event->serviceId = $data["id"];
        $oldProduct = $View_BaseService->getOne($event, $id, $ownSellerId);
        unset($View_BaseProduct);
        if (empty($oldProduct)) {
            return parent::go_error($event, -2132);
        }
        $nowTime = date('Y-m-d H:i:s');
        $newProduct = $data;
        BaseService::setEditData($event,$id,$nowTime,$newProduct,$oldProduct);
    }

    public function serviceDelete($event){

        $data = &$event->RequestArgs;

        if (empty($data) || !isset($data["id"]) || empty($data["id"]) || !is_numeric($data["id"])) {
            return parent::go_error($event, -12);
        }

        $ownSellerId = View_UserLogin::getOperateSellerId($data);
        if (empty($ownSellerId)) {
            return parent::go_error($event, -2011);
        }

        $id = $event->serviceId = $data["id"];

        $View_BaseService = new View_BaseService();
        $oldProduct = $View_BaseService->getOne($event, $id, $ownSellerId);
        unset($View_BaseProduct);
        if (empty($oldProduct)) {
            return parent::go_error($event, -2132);
        }

        $event->service_data = array(
            "id" => $id,
            "sellerId" => $ownSellerId
        );
    }

}
