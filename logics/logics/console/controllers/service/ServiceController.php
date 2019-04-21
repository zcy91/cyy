<?php
namespace console\controllers\service;

use console\behaviors\service\ServiceBehavior;
use console\events\service\ServiceEvent;
use console\controllers\BaseController;
use console\behaviors\BaseBehavior;

class ServiceController extends BaseController {

    public function init() {
        parent::init();
        $this->behavior = new ServiceBehavior();
        $this->attachBehavior("Servicebehavior", $this->behavior);
        $this->event = new ServiceEvent();
    }

    public function actionServiceadd($data) {
        $this->event->set($data, BaseBehavior::ADD_ACTION);
        parent::add($this->getModels_ServiceAdd(), $this->event);
        $this->event->Display();
        return 0;
    }

    public function actionServiceedit($data) {
        $this->event->set($data, BaseBehavior::ADD_ACTION);
        parent::modify($this->getModels_ServiceEdit(), $this->event);
        $this->event->Display();
        return 0;
    }

    public function actionServicedisplay($data) {
        $this->event->set($data, BaseBehavior::ADD_ACTION);
        parent::modify($this->getModels_ServiceDisplay(), $this->event);
        $this->event->Display();
        return 0;
    }

    public function actionServicedelete($data) {
        $this->event->set($data, BaseBehavior::ADD_ACTION);
        parent::delete($this->getModels_ServiceDelete(), $this->event);
        $this->event->Display();
        return 0;
    }

    public function actionServicecommission($data) {
        $this->event->set($data, BaseBehavior::ADD_ACTION);
        parent::modify($this->getModels_ServiceCommission(), $this->event);
        $this->event->Display();
        return 0;
    }

    public function actionServicelist($data) {

        $this->event->set($data, BaseBehavior::FETCH_ALL_ACTION);
        parent::fetch_all($this->getModels_ServiceList(), $this->event, false);
        $this->event->Display();
        return 0;
    }

    public function actionServicedesc($data) {
        $this->event->set($data, BaseBehavior::FETCH_ALL_ACTION);
        parent::fetch_all($this->getModels_ServiceDesc(), $this->event, false);
        $this->event->Display();
        return 0;
    }

    public function actionServicecommissiondesc($data) {
        $this->event->set($data, BaseBehavior::FETCH_ALL_ACTION);
        parent::fetch_all($this->getModels_ServiceCommissionDesc(), $this->event, false);
        $this->event->Display();
        return 0;
    }

}
