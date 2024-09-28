<?php
class Categoria_model extends CI_Model {

    // Obtener todas las categorías
    public function get_all_categories() {
        $query = $this->db->get('categorias');
        return $query->result();
    }

    // Insertar una nueva categoría
    public function insert_categoria($data) {
        return $this->db->insert('categorias', $data);
    }

    // Obtener una categoría por su ID
    public function get_categoria_by_id($id) {
        $query = $this->db->get_where('categorias', array('id' => $id));
        return $query->row();
    }
// Insertar una nueva categoría
// Insertar una nueva categoría
    // Actualizar una categoría
    public function update_categoria($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('categorias', $data);
    }

    // Eliminar una categoría
    public function delete_categoria($id) {
        return $this->db->delete('categorias', array('id' => $id));
    }
}
