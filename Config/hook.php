<?php 

    class Hook{
        public static function Check(){
            if(!AuthUser::IsAthenticated()){
                Func::Redirect("auths");
            }
        }
    }

?>