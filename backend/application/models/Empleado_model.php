<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Empleado_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get($codigo = null, $tipo = null)
    {
        if (!is_null($codigo)) {
            $query = $this->db
                ->select('*')
                ->from('empleado')
                ->where('codigo_empleado', $codigo)
                ->get();
            if ($query->num_rows() === 1) {
                return $query->row_array();
            }
            return null;
        }
        //reporte
        if (!is_null($tipo) and $tipo=1) {
            $query = $this->db
            ->select('*')
            ->from('empleado')
            ->join('estado','empleado.id_estado = estado.id_estado')
            ->join('provincia','empleado.id_provincia = provincia.id_provincia', 'Left')
            ->order_by('apellido_empleado', 'ASC')
            ->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            return null;
        }
        //datos empleado
         $query = $this->db
            ->select('*')
            ->from('empleado')
            ->join('estado','empleado.id_estado = estado.id_estado')
            ->order_by('apellido_empleado', 'ASC')
            ->limit(10)
            ->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return null;
    }

    public function save($empleado)
    {
        $this->db->set($this->_setEmpleado($empleado))->insert('empleado');
        if ($this->db->affected_rows() === 1) {
            return true; //$this->db->insert_id();
        }
        return null;
    }

    public function update($empleado)
    {
        $codigo = $empleado['codigo_empleado'];
        $this->db->set($this->_setEmpleado($empleado))->where('codigo_empleado', $codigo)->update('empleado');
        if ($this->db->affected_rows() === 1) {
            return true;
        }
        return null;
    }

    public function delete($codigo)
    {
        $this->db->where('codigo_empleado', $codigo)->delete('empleado');
        if ($this->db->affected_rows() === 1) {
            return true;
        }
        return null;
    }

    private function _setEmpleado($empleado)
    {
        $codigo= $this->obtenerUltimo()+1;
        $cod_empleado = str_pad($codigo, 5, "0", STR_PAD_LEFT);
        return array(
            'codigo_empleado' => $cod_empleado,
            'nombre_empleado' => $empleado['nombre_empleado'],
            'apellido_empleado' => $empleado['apellido_empleado'],
            'cedula_empleado' => $empleado['cedula_empleado'],
            'id_provincia' => $empleado['id_provincia'],
            'fecha_nacimiento_empleado' => $empleado['fecha_nacimiento_empleado'],
            'correo_empleado' => $empleado['correo_empleado'],
            'observacion_empleado' => $empleado['observacion_empleado'],
            'foto_empleado' => $empleado['foto_empleado'],
            'id_estado' => $empleado['id_estado'],
            'fecha_ingreso' => $empleado['fecha_ingreso'],
            'cargo_empleado' => $empleado['cargo_empleado'],
            'departamento_empleado' => $empleado['departamento_empleado'],
            'id_provincia_laboral' => $empleado['id_provincia_laboral'],
            'sueldo_empleado' => $empleado['sueldo_empleado'],
            'jornada_empleado' => $empleado['jornada_empleado'],
            'observacion_laboral' => $empleado['observacion_laboral']
        );
    }

    public function obtenerUltimo()
    {
        $this->db->select_max('codigo_empleado');
        $query = $this->db
        ->get('empleado');
        if ($query->num_rows() > 0) {
            $row=$query->result_array();
            return $row[0]['codigo_empleado'];
        }
        return null;
    }

    public function buscarCodigo($codigo)
    {
        if (!is_null($codigo)) {
            $query = $this->db
                ->select('*')
                ->from('empleado')
                ->where('codigo_empleado', $codigo)
                ->get();
            if ($query->num_rows() === 1) {
                return $query->row_array();
            }
            return null;
        }
    }

    public function buscarNombre($nombre)
    {
        if (!is_null($nombre)) {
            $query = $this->db
                ->select('*')
                ->from('empleado')
                ->like('nombre_empleado', $nombre)
                ->or_like('apellido_empleado', $nombre)
                ->get();
            if ($query->num_rows() === 1) {
                return $query->row_array();
            }
            return null;
        }
    }
}