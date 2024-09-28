<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ciber extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('ciber_model');
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index() {
        $this->ciber_model->reset_all_computers();
        $data['computadoras'] = $this->ciber_model->get_all_computers();
        $this->load->view('ciber_view', $data);
    }

    public function notificaciones_view($computer_id) {
        if (!$computer_id || !$this->ciber_model->get_computer_by_id($computer_id)) {
            show_404();
        }
        $data['computer'] = $this->ciber_model->get_computer_by_id($computer_id);
        $data['notificaciones'] = $this->ciber_model->get_notifications($computer_id);
        $this->load->view('notificaciones_view', $data);
    }

    public function agregar_maquina_form() {
        $this->load->view('agregar_maquina_form');
    }

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

    public function actualizar_estado() {
        $id = $this->input->post('id');
        $estado = $this->input->post('estado');
        $result = $this->ciber_model->update_computer_state($id, $estado);
        echo json_encode(['success' => $result]);
    }

    public function iniciar_sesion() {
        $id = $this->input->post('id');
        $parar_a = $this->input->post('parar_a');
        $result = $this->ciber_model->start_session($id, $parar_a);
        echo json_encode(['success' => $result]);
    }

    public function finalizar_sesion() {
        $id = $this->input->post('id');
        $result = $this->ciber_model->end_session($id);
        echo json_encode(['success' => $result]);
    }

    public function actualizar_nota_mensaje() {
        $id = $this->input->post('id');
        $nota = $this->input->post('nota');
        $mensaje = $this->input->post('mensaje');
        $result = $this->ciber_model->update_computer_note_and_message($id, $nota, $mensaje);
        echo json_encode(['success' => $result]);
    }

    public function get_notifications($computadora_id) {
        $notifications = $this->ciber_model->get_notifications($computadora_id);
        echo json_encode($notifications);
    }

    public function add_notification() {
        $data = $this->input->post();
        $result = $this->ciber_model->add_notification($data);
        echo json_encode(['success' => $result]);
    }

    public function update_notification() {
        $id = $this->input->post('id');
        $data = $this->input->post();
        unset($data['id']);
        $result = $this->ciber_model->update_notification($id, $data);
        echo json_encode(['success' => $result]);
    }

    public function delete_notification() {
        $id = $this->input->post('id');
        $result = $this->ciber_model->delete_notification($id);
        echo json_encode(['success' => $result]);
    }

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

    // Nuevo método para obtener notificación personalizada
    public function obtener_notificacion_personalizada($computadora_id) {
        $notificacion = $this->ciber_model->get_active_notification($computadora_id);
        
        if ($notificacion) {
            echo json_encode(['success' => true, 'notificacion' => $notificacion]);
        } else {
            echo json_encode(['success' => false]);
        }
    }
}