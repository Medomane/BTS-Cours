<?php
class authsController extends Controller
{
    function index(){
        $this->layout = "auth";
        if(isset($_POST["submit"])){
            $email = Form::SecureInput($_POST["email"]);
            $password = Form::SecureInput($_POST["password"]);
            if(Authentication::SignIn($email,$password)) Func::Redirect(ROOT."home");
            $d['email'] = $email;
            $this->set($d);
        }
        $this->autoRender();
    }


    function register(){
        $this->layout = "auth";
        $d['establishments'] = Model::Get("SELECT * FROM establishment");
        $d['semesters'] = Model::Get("SELECT * FROM semester");
        $this->set($d);
        $this->autoRender();
    }
    function logout(){
        Authentication::LogOut();
    }
    function jsonCheckEmail($email){
        $res = new stdClass();
        $res->message = "success";
        $email = base64_decode($email);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $res->message = "Invalid email format";
        }
        else{
            $dt = $this->model::Get("SELECT * FROM user WHERE email = \"".$email."\"");
            if(count($dt) !== 0) $res->message = "Email exist";
        }
        header('Content-Type: application/json');
        echo json_encode($res);
        die();
    }
    function jsonRegister(){
        $res = new stdClass();
        $res->message = "success";
        try{
            $data = $_POST;
            $cols = "";$vals = "";
            foreach($data as $k => $v){
                if($k != "establishment" && $k != "branch" && $k != "module" && $k != "semester" && $k != "passwordVer"){
                    $cols .=$k.",";
                    $val = ($k == "password")?md5(Form::SecureInput($data[$k])):Form::SecureInput($data[$k]);
                    $vals .=  "\"".$val."\",";
                }
            }
            $cols .= "establishment_id,";
            $vals .= "\"".Form::SecureInput($data["establishment"])."\",";
            if($data["type"] === "student"){
                $cols .= "branch_id,";
                $vals .= "\"".Form::SecureInput($data["branch"])."\",";
                $cols .= "semester_id,";
                $vals .= "\"".Form::SecureInput($data["semester"])."\",";
            }
            $user_id = Model::Exec("INSERT INTO user (".rtrim($cols,',').") values (".rtrim($vals,',').")");
            if($data["type"] === "professor"){
                foreach($data["module"] as $k) Model::Exec("UPDATE lineums set user_id = ".$user_id." WHERE id = ".$k);
            }
            Notify::Set("Successfully registered, you have to wait until the admin confirm your information","success");
        }
        catch (Exception $e) {
            $res->message = $e->getMessage();
        }
        header('Content-Type: application/json');
        echo json_encode($res);
        die();
    }
}
?>