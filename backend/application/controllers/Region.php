<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';

class Region extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('region_model');
	}
	
    public function index_get()
    {
        $regiones = $this->region_model->get();
        if (!is_null($regiones)) {
            $this->response(array('response' => $regiones), 200);
        } else {
            $this->response(array('error' => 'No hay regiones en la base de datos...'), 404);
        }
	}
	
    public function find_get($id)
    {
        if (!$id) {
            $this->response(null, 400);
        }
        $region = $this->region_model->get($id);
        if (!is_null($region)) {
            $this->response(array('response' => $region), 200);
        } else {
            $this->response(array('error' => 'Región no encontrada...'), 404);
        }
	}
	
    public function index_post()
    {
        if (!$this->post('region')) {
            $this->response(null, 400);
        }
        $id = $this->region_model->save($this->post('region'));
        if (!is_null($id)) {
            $this->response(array('response' => $id), 200);
        } else {
            $this->response(array('error', 'Algo ha fallado en el servidor...'), 400);
        }
	}
	
    public function index_put()
    {
        if (!$this->put('region')) {
            $this->response(null, 400);
        }
        $update = $this->region_model->update($this->put('region'));
        if (!is_null($update)) {
            $this->response(array('response' => 'Región actualizada!'), 200);
        } else {
            $this->response(array('error', 'Algo ha fallado en el servidor...'), 400);
        }
	}
	
    public function index_delete($id)
    {
        if (!$id) {
            $this->response(null, 400);
        }
        $delete = $this->region_model->delete($id);
        if (!is_null($delete)) {
            $this->response(array('response' => 'Región eliminada!'), 200);
        } else {
            $this->response(array('error', 'Algo ha fallado en el servidor...'), 400);
        }
    }
}