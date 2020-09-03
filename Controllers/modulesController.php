<?php
class modulesController extends Controller
{
    function jsonModules(){
        $data = $_POST;
        $req = "SELECT * FROM `modulesdetail`".(count($_POST) > 0?' WHERE ':'');
        foreach($data as $k => $v) $req .= $k." = ".Form::SecureInput($v).' AND ';
        $res = $this->model->Get(rtrim(rtrim($req,' '),'AND'));
        Func::ToJson($res);
    }
    function jsonModulesByBranch($branchId){
        Func::ToJson($this->model->Get("SELECT * FROM `modules` WHERE branch_id = ".$branchId));
    }
}
?>