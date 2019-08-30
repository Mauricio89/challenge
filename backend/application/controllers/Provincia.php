<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';

class Provincia extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('provincia_model');
	}
	
    public function index_get()
    {
        $provincias = $this->provincia_model->get();
        if (!is_null($provincias)) {
            $this->response(array('response' => $provincias), 200);
        } else {
            $this->response(array('error' => 'No hay provincias en la base de datos...'), 404);
        }
	}
	
    public function find_get($id)
    {
        if (!$id) {
            $this->response(null, 400);
        }
        $provincia = $this->provincia_model->get($id);
        if (!is_null($provincia)) {
            $this->response(array('response' => $provincia), 200);
        } else {
            $this->response(array('error' => 'Provincia no encontrado...'), 404);
        }
	}
	
    public function index_post()
    {
        if (!$this->post('provincia')) {
            $this->response(null, 400);
        }
        $id = $this->provincia_model->save($this->post('provincia'));
        if (!is_null($id)) {
            $this->response(array('response' => $id), 200);
        } else {
            $this->response(array('error', 'Algo ha fallado en el servidor...'), 400);
        }
	}
	
    public function index_put()
    {
        if (!$this->put('provincia')) {
            $this->response(null, 400);
        }
        $update = $this->provincia_model->update($this->put('provincia'));
        if (!is_null($update)) {
            $this->response(array('response' => 'Provincia actualizada!'), 200);
        } else {
            $this->response(array('error', 'Algo ha fallado en el servidor...'), 400);
        }
	}
	
    public function index_delete($id)
    {
        if (!$id) {
            $this->response(null, 400);
        }
        $delete = $this->provincia_model->delete($id);
        if (!is_null($delete)) {
            $this->response(array('response' => 'Provincia eliminada!'), 200);
        } else {
            $this->response(array('error', 'Algo ha fallado en el servidor...'), 400);
        }
    }
}