<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Region_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get($codigo = null)
    {
        if (!is_null($codigo)) {
            $query = $this->db->select('*')->from('region')->where('id_region', $codigo)->get();
            if ($query->num_rows() === 1) {
                return $query->row_array();
            }
            return null;
        }
        $query = $this->db->select('*')->from('region')->order_by('nombre_region', 'ASC')->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return null;
    }

    public function save($region)
    {
        $this->db->set($this->_setregion($region))->insert('region');
        if ($this->db->affected_rows() === 1) {
            return $this->db->insert_id();
        }
        return null;
    }

    public function update($region)
    {
        $id = $region['id_region'];
        $this->db->set($this->_setregion($region))->where('id_region', $id)->update('region');
        if ($this->db->affected_rows() === 1) {
            return true;
        }
        return null;
    }

    public function delete($id)
    {
        $this->db->where('id_region', $id)->delete('region');
        if ($this->db->affected_rows() === 1) {
            return true;
        }
        return null;
    }

    private function _setregion($region)
    {
        return array(
            'id_region' => $region['id_region'],
            'nombre_region' => $region['nombre_region'],
            'descripcion_region' => $region['descripcion_region']
        );
    }
}