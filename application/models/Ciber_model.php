<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ciber_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function reset_all_computers() {
        $this->db->update('computadoras', [
            'estado' => 'sin usar',
            'inicio' => NULL,
            'contador' => NULL
        ]);
    }

    public function count_computers() {
        return $this->db->count_all('computadoras');
    }

    public function add_machine($data) {
        if (!isset($data['nombre']) || empty($data['nombre'])) {
            return false;
        }
        return $this->db->insert('computadoras', $data);
    }

    public function get_all_computers() {
        return $this->db->get('computadoras')->result_array();
    }

    public function update_computer_state($id, $estado) {
        $this->db->where('id', $id);
        return $this->db->update('computadoras', ['estado' => $estado]);
    }

    public function start_session($id, $parar_a) {
        $this->db->where('id', $id);
        return $this->db->update('computadoras', [
            'estado' => 'en uso',
            'inicio' => date('H:i:s'),
            'contador' => '00:00:00',
            'parar_a' => $parar_a
        ]);
    }

    public function end_session($id) {
        $this->db->where('id', $id);
        return $this->db->update('computadoras', [
            'estado' => 'sin usar',
            'inicio' => NULL,
            'contador' => NULL,
            'nota' => ''
        ]);
    }

    public function update_computer_note_and_message($id, $nota, $mensaje) {
        $this->db->where('id', $id);
        return $this->db->update('computadoras', [
            'nota' => $nota,
            'mensaje' => $mensaje
        ]);
    }

    public function delete_computer($id) {
        if (!$id) {
            return false;
        }
        $this->db->where('id', $id);
        return $this->db->delete('computadoras');
    }

    public function get_notifications($computadora_id) {
        $this->db->where('computadora_id', $computadora_id);
        return $this->db->get('notificaciones_personalizadas')->result_array();
    }

    public function add_notification($data) {
        return $this->db->insert('notificaciones_personalizadas', $data);
    }

    public function update_notification($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('notificaciones_personalizadas', $data);
    }

    public function delete_notification($id) {
        $this->db->where('id', $id);
        return $this->db->delete('notificaciones_personalizadas');
    }

    public function get_computer_by_id($id) {
        $this->db->where('id', $id);
        return $this->db->get('computadoras')->row_array();
    }

    // Nuevo método para obtener la notificación activa
    public function get_active_notification($computadora_id) {
        $this->db->where('computadora_id', $computadora_id);
        $this->db->where('activa', 1);
        $query = $this->db->get('notificaciones_personalizadas');
        
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        
        return null;
    }
}