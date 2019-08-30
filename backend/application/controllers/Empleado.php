<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';

class Empleado extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('empleado_model');
	}
	
    public function index_get()
    {
        $empleados = $this->empleado_model->get();
        if (!is_null($empleados)) {
            $this->response(array('response' => $empleados), 200);
        } else {
            $this->response(array('error' => 'No hay empleados en la base de datos...'), 404);
        }
    }
    
    public function reporte_get()
    {
        $empleado = $this->empleado_model->get(null,1);
        if (!is_null($empleado)) {
            $this->response(array('response' => $empleado), 200);
        } else {
            $this->response(array('error' => 'Empleado no encontrado...'), 404);
        }
	}
	
    public function find_get($codigo)
    {
        if (!$codigo) {
            $this->response(null, 400);
        }
        $empleado = $this->empleado_model->get($codigo,null);
        if (!is_null($empleado)) {
            $this->response(array('response' => $empleado), 200);
        } else {
            $this->response(array('error' => 'Empleado no encontrado...'), 404);
        }
	}
	
    public function index_post()
    {
        if (!$this->post('empleado')) {
            $this->response(null, 400);
        }
        $id = $this->empleado_model->save($this->post('empleado'));
        if (!is_null($id)) {
            $this->response(array('response' => $id), 200);
        } else {
            $this->response(array('error', 'Algo ha fallado en el servidor...'), 400);
        }
	}
	
    public function index_put()
    {
        if (!$this->put('empleado')) {
            $this->response(null, 400);
        }
        $update = $this->empleado_model->update($this->put('empleado'));
        if (!is_null($update)) {
            $this->response(array('response' => 'Empleado actualizado!'), 200);
        } else {
            $this->response(array('error', 'Algo ha fallado en el servidor...'), 400);
        }
	}
	
    public function index_delete($id)
    {
        if (!$id) {
            $this->response(null, 400);
        }
        $delete = $this->empleado_model->delete($id);
        if (!is_null($delete)) {
            $this->response(array('response' => 'Empleado eliminado!'), 200);
        } else {
            $this->response(array('error', 'Algo ha fallado en el servidor...'), 400);
        }
    }

    /*public function reporte()
    {
        $empleados = $this->empleado_model->reporte();
        if (!is_null($empleados)) {
            $this->response(array('response' => $empleados), 200);
        } else {
            $this->response(array('error' => 'No hay empleados en la base de datos...'), 404);
        }
    }*/

    public function buscarCodigo_get($codigo)
    {
        if (!$codigo) {
            $this->response(null, 400);
        }
        $empleado = $this->empleado_model->buscarCodigo($codigo);
        if (!is_null($empleado)) {
            $this->response(array('response' => $empleado), 200);
        } else {
            $this->response(array('error' => 'Empleado no encontrado...'), 404);
        }
    }
    
    public function buscarNombre_get($nombre)
    {
        if (!$nombre) {
            $this->response(null, 400);
        }
        $empleado = $this->empleado_model->buscarNombre($nombre);
        if (!is_null($empleado)) {
            $this->response(array('response' => $empleado), 200);
        } else {
            $this->response(array('error' => 'Empleado no encontrado...'), 404);
        }
    }
    
    public function guadarImagen_post()
	{
		if (!empty($_FILES)) {
            $tempPath = $_FILES['file']['tmp_name'];
            if(file_exists($tempPath))
            {
            $destination = FCPATH . "/../frontend/public/img/";
            $uploadPath = $destination . str_replace(' ', '', trim($_FILES['file']['name']));
            if(is_dir($destination)){
                if(move_uploaded_file($tempPath, $uploadPath)){
                    echo "upload complete";
                }else{
                    echo "move_uploaded_file failed";
                    //exit();
                }
            }else {
                echo "no dir" . $destination;
                //exit();
            }
            }else{
            echo "file no exist";
            }
        }
	}
}
