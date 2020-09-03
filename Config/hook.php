<?php 

    class Hook{
        public static function Check($request){
            if(strpos($request->url,"json") === false){
                if($request->controller != 'auths'){
                    if(!AuthUser::IsAthenticated()){
                        Func::Redirect("auths");
                    }
                }
            }
        }
    }

?>