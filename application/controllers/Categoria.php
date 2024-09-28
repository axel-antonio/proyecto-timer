<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Categoria_model');
        $this->load->helper('url');
        $this->load->library('session'); // Cargar la librería de sesiones
    }

    // Mostrar todas las categorías
    public function index() {
        $data['categorias'] = $this->Categoria_model->get_all_categories();
        $this->load->view('categoria_view', $data);
    }

    // Mostrar formulario de crear categoría
    public function crear() {
        $this->load->view('crear_categoria');
    }

    // Guardar categoría en la base de datos
    public function guardar() {
        $categoria_data = array(
            'nombre' => $this->input->post('nombre'),
            'descripcion' => $this->input->post('descripcion'),
            'restriccion_tiempo' => $this->input->post('restriccion_tiempo')
        );

        if ($this->Categoria_model->insert_categoria($categoria_data)) {
            $this->session->set_flashdata('success', 'Categoría agregada correctamente.');
        } else {
            $this->session->set_flashdata('error', 'Hubo un problema al agregar la categoría.');
        }

        redirect(base_url('index.php/Categoria'));
    }

    // Mostrar formulario de editar categoría
    public function editar($id) {
        $data['categoria'] = $this->Categoria_model->get_categoria_by_id($id);
        $this->load->view('editar_categoria', $data);
    }

    // Actualizar categoría en la base de datos
    public function actualizar($id) {
        $categoria_data = array(
            'nombre' => $this->input->post('nombre'),
            'descripcion' => $this->input->post('descripcion'),
            'restriccion_tiempo' => $this->input->post('restriccion_tiempo')
        );

        if ($this->Categoria_model->update_categoria($id, $categoria_data)) {
            $this->session->set_flashdata('success', 'Categoría actualizada correctamente.');
        } else {
            $this->session->set_flashdata('error', 'Hubo un problema al actualizar la categoría.');
        }

        redirect(base_url('index.php/Categoria'));
    }

    // Eliminar categoría
    public function eliminar($id) {
        if ($this->Categoria_model->delete_categoria($id)) {
            $this->session->set_flashdata('success', 'Categoría eliminada correctamente.');
        } else {
            $this->session->set_flashdata('error', 'Hubo un problema al eliminar la categoría.');
        }

        redirect(base_url('index.php/Categoria'));
    }
}
