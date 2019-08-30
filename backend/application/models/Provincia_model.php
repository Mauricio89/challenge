<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Provincia_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get($codigo = null)
    {
        if (!is_null($codigo)) {
            $query = $this->db->select('*')->from('provincia')->where('id_provincia', $codigo)->get();
            if ($query->num_rows() === 1) {
                return $query->row_array();
            }
            return null;
        }
        $query = $this->db->select('*')->from('provincia')->order_by('nombre_provincia', 'ASC')->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return null;
    }

    public function save($provincia)
    {
        $this->db->set($this->_setprovincia($provincia))->insert('provincia');
        if ($this->db->affected_rows() === 1) {
            return $this->db->insert_id();
        }
        return null;
    }

    public function update($provincia)
    {
        $id = $provincia['id_provincia'];
        $this->db->set($this->_setprovincia($provincia))->where('id_provincia', $id)->update('provincia');
        if ($this->db->affected_rows() === 1) {
            return true;
        }
        return null;
    }

    public function delete($id)
    {
        $this->db->where('id_provincia', $id)->delete('provincia');
        if ($this->db->affected_rows() === 1) {
            return true;
        }
        return null;
    }

    private function _setprovincia($provincia)
    {
        return array(
            'id_provincia' => $provincia['id_provincia'],
            'nombre_provincia' => $provincia['nombre_provincia'],
            'capital_provincia' => $provincia['capital_provincia'],
            'descripcion_provincia' => $provincia['descripcion_provincia'],
            'poblacion_provincia' => $provincia['poblacion_provincia'],
            'superficie_provincia' => $provincia['superficie_provincia'],
            'latitud_provincia' => $provincia['latitud_provincia'],
            'longitud_provincia' => $provincia['longitud_provincia'],
            'id_region' => $provincia['id_region']
        );
    }
}