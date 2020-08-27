<?php
class Branch extends Model{
    public function getBranchsByEstablishment($establishmentId){
        return $this->Get("SELECT b.id, b.name Branch from establishment e,linebe l, branch b WHERE e.id = l.establishment_id and b.id = l.branch_id and e.id = ".$establishmentId);
    }
}
?>