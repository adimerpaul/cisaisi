<?php

class User extends CI_Model {
    public function consula($mostrar,$tabla,$where,$dato){
        $query=$this->db->query("SELECT $mostrar FROM $tabla WHERE $where='$dato'");
        $row=$query->row();
        return $row->$mostrar;
    }
}