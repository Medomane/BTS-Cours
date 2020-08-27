<?php
class Module extends Model{    
    function getUnusedModulesByEstablishment($establishmentId){
        return $this->Get("SELECT * FROM detail WHERE user_id = 0 AND establishment_id = ".$establishmentId." ORDER BY id ASC");
    }
    function getModulesByBranchAndSemester($branchId,$semesterId){
        return $this->Get("SELECT * FROM `detail` WHERE branch_id = ".$branchId." and semester_id = ".$semesterId." ORDER BY `id` ASC");
    }
}
?>