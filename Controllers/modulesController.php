<?php
class modulesController extends Controller
{
    function jsonUnusedModulesByEstablishment($establishmentId){
        $res = $this->model->getUnusedModulesByEstablishment($establishmentId);
        Func::ToJson($res);
    }
    function jsonModulesByBranchAndSemester($branchId,$semesterId){
        $res = $this->model->getModulesByBranchAndSemester($branchId,$semesterId);
        Func::ToJson($res);
    }
}
?>