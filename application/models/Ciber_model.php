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

    // Contar el total de computadoras
    public function count_computers() {
        return $this->db->count_all('computadoras');
    }

    // Agregar una nueva máquina
    public function add_machine($data) {
        if (!isset($data['nombre']) || empty($data['nombre'])) {
            return false; // Validación extra en caso de que el nombre falte
        }
        return $this->db->insert('computadoras', $data);
    }

    // Obtener todas las computadoras
    public function get_all_computers() {
        return $this->db->get('computadoras')->result_array();
    }

    // Actualizar el estado de una computadora
    public function update_computer_state($id, $estado) {
        $this->db->where('id', $id);
        return $this->db->update('computadoras', ['estado' => $estado]);
    }

    // Iniciar sesión en una máquina
    public function start_session($id, $parar_a, $notificacion_personalizada) {
        $this->db->where('id', $id);
        return $this->db->update('computadoras', [
            'estado' => 'en uso',
            'inicio' => date('H:i:s'),
            'contador' => '00:00:00',
            'parar_a' => $parar_a,
            'notificacion_personalizada' => $notificacion_personalizada
        ]);
    }

    // Finalizar sesión en una máquina
    public function end_session($id) {
        $this->db->where('id', $id);
        return $this->db->update('computadoras', [
            'estado' => 'sin usar',
            'inicio' => NULL,
            'contador' => NULL,
            'nota' => '',
            'notificacion_personalizada' => NULL
        ]);
    }

  // Nuevo método para obtener la notificación personalizada
  public function get_notification($id) {
    $this->db->select('notificacion_personalizada');
    $this->db->where('id', $id);
    $query = $this->db->get('computadoras');
    
     // Asegurarte de que devuelva el valor correcto
     if ($query->num_rows() > 0) {
        return $query->row()->notificacion_personalizada;
    }
    return null; // En caso de que no se encuentre
}





    // Actualizar nota y mensaje de una máquina
    public function update_computer_note_and_message($id, $nota, $mensaje) {
        $this->db->where('id', $id);
        return $this->db->update('computadoras', [
            'nota' => $nota,
            'mensaje' => $mensaje
        ]);
    }

    // Eliminar una máquina
    public function delete_computer($id) {
        if (!$id) {
            return false; // Verificación extra en caso de que el ID no esté presente
        }
        $this->db->where('id', $id);
        return $this->db->delete('computadoras');
    }
}
