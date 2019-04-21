<?php
namespace console\models\service;

use console\models\BaseModel;

class BaseService extends BaseModel {

    const TABLE_NAME = "service";

    public function primaryKey() {
        return ['id' => 'auto'];
    }

    protected function resolveFields($v = array(), $default_arr = array()) {

        $subset = array(
            "id",
            "name",
            "icon",
            "sort",
            "is_show",
            "des",
            "seller_id",
            "information",
            "creatTime",
            "nowTime"
        );

        $info_arr = parent::key_values_intersect($v, $subset, $default_arr);
        return $info_arr;
    }

    public function get_seq_no($event, $data_arr, $array_dim) {

        $count = $array_dim == 1 ? 1 : count($data_arr);
        $seq_no = 0;
        $this->proc_call('getKeyValue', array(503, $count), $seq_no, $event);

        return $seq_no;
    }

    public function refer_to($event, $data_arr, $array_dim, $seq_no, $count) {
        $event->set_service_id($seq_no);
    }

    public static function setEditData($event, $id, $nowTime, $newData, $oldData){

        if (isset($newData["name"]) && !empty($newData["name"]) && $newData["name"] != $oldData["name"]) {
            $event->service_data["name"] = $newData["name"];
        }

        if (isset($newData["icon"]) && !empty($newData["icon"]) && $newData["icon"] != $oldData["icon"]) {
            $event->service_data["icon"] = $newData["icon"];
        }

        if (isset($newData["is_show"]) && !empty($newData["is_show"]) && $newData["is_show"] != $oldData["is_show"]) {
            $event->service_data["is_show"] = $newData["is_show"];
        }

        if (isset($newData["sort"]) && !empty($newData["sort"]) && $newData["sort"] != $oldData["sort"]) {
            $event->service_data["sort"] = $newData["sort"];
        }

        if (isset($newData["des"]) && !empty($newData["des"]) && $newData["des"] != $oldData["des"]) {
            $event->service_data["des"] = $newData["des"];
        }
        if (isset($newData["information"]) && !empty($newData["information"]) && $newData["information"] != $oldData["information"]) {
            $event->service_data["information"] = $newData["information"];
        }

        if (!empty($event->service_data)) {
            $event->service_data["id"] = $id;
            $event->service_data["nowTime"] = $nowTime;
        }
    }

    public function delete($event) {

        $data = $event->service_data;

        if (!empty($data)) {

            $sql = "DELETE FROM service WHERE seller_id = :sellerId AND id = :Id";
            $params = array(
                ":sellerId" => $data["sellerId"],
                ":Id" => $data["id"],
            );

            $this->update_sql($sql, $event, $params);

        }
    }

}
