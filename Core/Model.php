<?php
    class Model
    {
        public $bdd = null;
        protected $controller ;
        function __construct($ctr=null) {
            $tmp = Conf::$conf[Conf::$name];
            $this->bdd = new PDO("mysql:host=".$tmp["host"].";dbname=".$tmp["dbname"]."",$tmp["username"], $tmp["password"],
            array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            if($ctr != null && isset($ctr)) $this->controller = $ctr ;
        }
        public static function getBDD(){
            $mod = new Model();
            return $mod->bdd;
        }
        public static function Get($query){
            $req = Model::getBDD()->prepare($query);
            $req->execute();
            return $req->fetchAll(PDO::FETCH_ASSOC);
        } 
        public static function Exec($query){
            $db = Model::getBDD();
            $stmt = $db->prepare($query);
            $stmt->execute();
            if(strpos(strtolower($query),"insert") !== false) return $db->lastInsertId();
            return 0;
        }
        public function Delete($id){
            $this->Exec("DELETE FROM ".get_class($this)." WHERE id = ".$id);
        }
    }
?>