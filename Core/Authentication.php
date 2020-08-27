<?php

class Authentication{
    public static function SignIn($email,$password){
        $res = Model::Get("SELECT * FROM user WHERE email = \"".$email."\" AND password = \"".md5($password)."\"");
        if(count($res) > 0){
            $user = $res[0];
            if(intval($user["activated"]) === 0){
                Notify::Set("Your account is not activated !!!","warning");
                return false;
            }
            AuthUser::Set($res[0]);
            return true ;
        }
        else Notify::Set("User not found !!!","warning");
        return false;
    }
    public static function LogOut(){
        Session::Avoid("user");
        Func::Redirect(ROOT."/auths");
    }
}

?>