<?php
class usersController extends Controller
{
    function index($type=null)
    {
        $type = ($type === "student" || $type === "professor")?$type :"professor";
        $res = $this->model->Get("SELECT * FROM detailUsers WHERE type = \"".$type."\" ".(AuthUser::IsAdministrator()?"":" AND activated = 1"));

        if($type === "professor"){
            foreach($res as $k=>$v){
                $res[$k]["modules"] = $this->model->Get("SELECT * FROM detail WHERE user_id = ".$v["id"]." ORDER BY id ASC");
            }
        }        
        /*echo "<pre>";
        print_r($res);die();*/
        $d['type'] = $type;
        $d['users'] = $res;
        $this->set($d);
        $this->autoRender();
    }
    function customize()
    {
        if(!AuthUser::IsAdministrator()) Func::Redirect("home");
        $d['users'] = $this->model->Get("SELECT * FROM user WHERE activated = 0");
        $this->set($d);
        $this->autoRender();
    }
    function delete($id){
        $this->model->delete($id);
    }
    function activated($id){
        $this->model->activated($id);
    }
}
?>