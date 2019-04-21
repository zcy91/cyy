<?php
namespace console\events\service;

use console\events\BaseEvent;

class ServiceEvent extends BaseEvent {

    public $serviceId;

    public $service_data;
//    public $base_product_attr_data;
//    public $base_product_attr_item_data;
//    public $base_product_operate_data;
//    public $base_product_commission_quot_data;
//    public $base_product_commission_percentage_data;
//
//
//    public $base_product_attr_del;
//    public $base_product_attr_item_del;
//    public $base_product_commission_quot_del;
//    public $base_product_commission_percentage_del;
    
    public function  set_service_id($seq_no){
        $this->serviceId = $seq_no;
    }

}

?>