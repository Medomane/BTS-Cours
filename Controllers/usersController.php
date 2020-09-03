<?php
class usersController extends Controller
{
    function index($type=null){
        $type = ($type === "student" || $type === "professor")?$type :"professor";
        $res = $this->model->Get("SELECT * FROM users WHERE type = \"".$type."\" ".(AuthUser::IsAdministrator()?"":" AND activated = 1"));
        $d['type'] = $type;
        $d['users'] = $res;
        $this->set($d);
        $this->autoRender();
    }
    function profile($id=null){
        $id = ($id==null && !is_numeric($id))?$id = AuthUser::Get()["id"]:$id;
        $user = $this->model->Get("SELECT * FROM `users` WHERE id = ".$id.(AuthUser::IsAdministrator()?'':' AND activated = 1'));
        if(count($user) > 0){
            $user = $user[0];
            if($user["type"] == "professor") $user["modules"] = $this->model->Get("SELECT * FROM teachs WHERE user_id = ".$id);
            $tmp = WEBROOT."img/avatars/".$user["id"].".png";
            $user["avatar"] = file_exists($tmp)?$tmp:WEBROOT."img/".$user["gender"].".png";
            $user["uploads"] = $this->model->Get("SELECT * FROM files WHERE user_id = ".$id.(AuthUser::IsAdministrator()?'':' AND confirmed = 1'));
            $d['user'] = $user;
            $this->set($d);
            $this->autoRender();
        }
        else $this->e404("User doesn't exist !!!");
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