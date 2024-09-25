<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ciber extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('ciber_model');
        $this->load->helper('url');
    
    }

    // Página principal que muestra todas las computadoras
    public function index() {
        $this->ciber_model->reset_all_computers();
        $data['computadoras'] = $this->ciber_model->get_all_computers();
        $this->load->view('ciber_view', $data);
    }

       // Nueva función para mostrar el formulario de agregar máquina
       public function agregar_maquina_form() {
        $this->load->view('agregar_maquina_form');
    }

    // Función para agregar una máquina
    public function agregar_maquina() {
        $nombre = $this->input->post('nombre');

        if (empty($nombre)) {
            echo json_encode(['success' => false, 'message' => 'El nombre es requerido.']);
            return;
        }

        $data = [
            'nombre' => $nombre,
            'estado' => 'sin usar',
            'inicio' => NULL,
            'contador' => NULL
        ];

        $success = $this->ciber_model->add_machine($data);

        echo json_encode(['success' => $success]);
    }


    // Actualiza el estado de la computadora
    public function actualizar_estado() {
        $id = $this->input->post('id');
        $estado = $this->input->post('estado');
        $result = $this->ciber_model->update_computer_state($id, $estado);
        echo json_encode(['success' => $result]);
    }

    // Inicia la sesión en la computadora (cambia su estado a 'en uso')
    public function iniciar_sesion() {
        $id = $this->input->post('id');
        $parar_a = $this->input->post('parar_a');
        $result = $this->ciber_model->start_session($id, $parar_a);
        echo json_encode(['success' => $result]);
    }
    // Finaliza la sesión en la computadora (cambia su estado a 'sin usar')
    public function finalizar_sesion() {
        $id = $this->input->post('id');
        $result = $this->ciber_model->end_session($id);
        echo json_encode(['success' => $result]);
    }

    // Actualiza la nota y el mensaje de la computadora
    public function actualizar_nota_mensaje() {
        $id = $this->input->post('id');
        $nota = $this->input->post('nota');
        $mensaje = $this->input->post('mensaje');
        $result = $this->ciber_model->update_computer_note_and_message($id, $nota, $mensaje);
        echo json_encode(['success' => $result]);
    }

    // Elimina una máquina
    public function eliminar_maquina() {
        $id = $this->input->post('id');
        
        if (!$id) {
            echo json_encode(['success' => false, 'message' => 'ID de máquina no proporcionado.']);
            return;
        }
    
        $result = $this->ciber_model->delete_computer($id);
        echo json_encode(['success' => $result]);
    }
    
    public function manual() {
        $this->load->view('manual_view');
    }
    
}
