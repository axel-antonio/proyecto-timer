<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alertas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Cargar el modelo de alertas
        $this->load->model('Alerta_model');
        // Cargar el modelo de computadoras si es necesario
        $this->load->model('Ciber_model');
        // Cargar helpers y librerías necesarias
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        // Verificar si el usuario está autenticado (si aplica)
        // $this->load->library('session');
        // if (!$this->session->userdata('logged_in')) {
        //     redirect('login');
        // }
    }

    /**
     * Método principal que lista todas las alertas de una computadora específica.
     *
     * @param int $computadora_id
     */
    public function index($computadora_id = NULL) {
        if ($computadora_id === NULL) {
            show_error('ID de computadora no proporcionado.', 400);
        }

        // Verificar si la computadora existe
        $computadora = $this->Ciber_model->get_computer_by_id($computadora_id);
        if (empty($computadora)) {
            show_error('Computadora no encontrada.', 404);
        }

        // Obtener todas las alertas para esta computadora
        $data['alertas'] = $this->Alerta_model->get_alertas($computadora_id);
        $data['computadora'] = $computadora;

        // Cargar la vista
        $this->load->view('alertas/index', $data);
    }

    /**
     * Mostrar el formulario para crear una nueva alerta.
     *
     * @param int $computadora_id
     */
    public function crear($computadora_id = NULL) {
        if ($computadora_id === NULL) {
            show_error('ID de computadora no proporcionado.', 400);
        }

        // Verificar si la computadora existe
        $computadora = $this->Ciber_model->get_computer_by_id($computadora_id);
        if (empty($computadora)) {
            show_error('Computadora no encontrada.', 404);
        }

        $data['computadora'] = $computadora;

        // Cargar la vista del formulario
        $this->load->view('alertas/crear', $data);
    }

    /**
     * Procesar la creación de una nueva alerta.
     */
    public function guardar() {
        // Definir reglas de validación
        $this->form_validation->set_rules('computadora_id', 'Computadora', 'required|integer');
        $this->form_validation->set_rules('mensaje', 'Mensaje', 'required|max_length[255]');
        $this->form_validation->set_rules('sticker', 'Sticker', 'required|valid_url');

        if ($this->form_validation->run() === FALSE) {
            // Si la validación falla, recargar el formulario con errores
            $computadora_id = $this->input->post('computadora_id');
            $computadora = $this->Ciber_model->get_computer_by_id($computadora_id);
            $data['computadora'] = $computadora;
            $this->load->view('alertas/crear', $data);
        } else {
            // Preparar los datos para insertar
            $data = array(
                'computadora_id' => $this->input->post('computadora_id'),
                'mensaje' => $this->input->post('mensaje'),
                'sticker' => $this->input->post('sticker')
            );

            // Crear la alerta
            if ($this->Alerta_model->create_alerta($data)) {
                // Redirigir a la lista de alertas con éxito
                $this->session->set_flashdata('success', 'Alerta creada exitosamente.');
                redirect('alertas/index/' . $data['computadora_id']);
            } else {
                // Mostrar error al crear la alerta
                $this->session->set_flashdata('error', 'Hubo un problema al crear la alerta. Intenta de nuevo.');
                redirect('alertas/crear/' . $data['computadora_id']);
            }
        }
    }

    /**
     * Mostrar el formulario para editar una alerta existente.
     *
     * @param int $id
     */
    public function editar($id = NULL) {
        if ($id === NULL) {
            show_error('ID de alerta no proporcionado.', 400);
        }

        // Obtener la alerta
        $alerta = $this->Alerta_model->get_alerta($id);
        if (empty($alerta)) {
            show_error('Alerta no encontrada.', 404);
        }

        // Obtener información de la computadora
        $computadora = $this->Ciber_model->get_computer_by_id($alerta['computadora_id']);
        if (empty($computadora)) {
            show_error('Computadora asociada no encontrada.', 404);
        }

        $data['alerta'] = $alerta;
        $data['computadora'] = $computadora;

        // Cargar la vista del formulario de edición
        $this->load->view('alertas/editar', $data);
    }

    /**
     * Procesar la actualización de una alerta existente.
     *
     * @param int $id
     */
    public function actualizar($id = NULL) {
        if ($id === NULL) {
            show_error('ID de alerta no proporcionado.', 400);
        }

        // Definir reglas de validación
        $this->form_validation->set_rules('mensaje', 'Mensaje', 'required|max_length[255]');
        $this->form_validation->set_rules('sticker', 'Sticker', 'required|valid_url');

        if ($this->form_validation->run() === FALSE) {
            // Si la validación falla, recargar el formulario con errores
            $alerta = $this->Alerta_model->get_alerta($id);
            $computadora = $this->Ciber_model->get_computer_by_id($alerta['computadora_id']);
            $data['alerta'] = $alerta;
            $data['computadora'] = $computadora;
            $this->load->view('alertas/editar', $data);
        } else {
            // Preparar los datos para actualizar
            $data = array(
                'mensaje' => $this->input->post('mensaje'),
                'sticker' => $this->input->post('sticker')
            );

            // Actualizar la alerta
            if ($this->Alerta_model->update_alerta($id, $data)) {
                // Redirigir a la lista de alertas con éxito
                $this->session->set_flashdata('success', 'Alerta actualizada exitosamente.');
                $alerta = $this->Alerta_model->get_alerta($id);
                redirect('alertas/index/' . $alerta['computadora_id']);
            } else {
                // Mostrar error al actualizar la alerta
                $this->session->set_flashdata('error', 'Hubo un problema al actualizar la alerta. Intenta de nuevo.');
                redirect('alertas/editar/' . $id);
            }
        }
    }

    /**
     * Procesar la eliminación de una alerta.
     *
     * @param int $id
     */
    public function eliminar($id = NULL) {
        if ($id === NULL) {
            show_error('ID de alerta no proporcionado.', 400);
        }

        // Obtener la alerta para obtener el ID de la computadora asociada
        $alerta = $this->Alerta_model->get_alerta($id);
        if (empty($alerta)) {
            show_error('Alerta no encontrada.', 404);
        }

        // Eliminar la alerta
        if ($this->Alerta_model->delete_alerta($id)) {
            // Redirigir a la lista de alertas con éxito
            $this->session->set_flashdata('success', 'Alerta eliminada exitosamente.');
            redirect('alertas/index/' . $alerta['computadora_id']);
        } else {
            // Mostrar error al eliminar la alerta
            $this->session->set_flashdata('error', 'Hubo un problema al eliminar la alerta. Intenta de nuevo.');
            redirect('alertas/index/' . $alerta['computadora_id']);
        }
    }
}
