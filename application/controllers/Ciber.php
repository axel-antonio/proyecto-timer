<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ciber extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ciber_model');
        $this->load->helper('url');

    }
    public function obtenerClima()
    {
        $url = 'https://my.meteoblue.com/packages/basic-1h_basic-day?apikey=zJDn3CsaqUdKQ0Ym&lat=14.6407&lon=-90.5133&asl=1508&format=json';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $data = curl_exec($curl);
        curl_close($curl);
        return json_decode($data,true);
        $lat = $data["metadata"][0]["temperature"];
    }
    private function getLocationCoords($query = "Basel", $iso2 = "CH", $apikey = "DEMOKEY", $sig = "siuhaefiusf") {
        $parameters = array("query" => $query, "iso2" => $iso2, "apikey" => $apikey, "sig" => $sig);
        $url = "https://www.meteoblue.com/en/server/search/query3?";
        $url .= http_build_query($parameters);
     
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $json = curl_exec($ch);
        $data = json_decode($json);
     
        $coords = array();
        $coords["lat"] = (float)$data->results["0"]->lat;
        $coords["lon"] = (float)$data->results["0"]->lon;
        $coords["asl"] = (int)$data->results["0"]->asl;
        /*
         * print_r($coords):
         * Array
         * (
         *     [lat] => 47.5582
         *     [lon] => 7.5881
         *     [asl] => 260
         * )
         */
        return $coords;
    }

    // Página principal que muestra todas las computadoras
    public function index()
    {
        $this->ciber_model->reset_all_computers();
        $data['computadoras'] = $this->ciber_model->get_all_computers();
        $data['clima']=  $this->obtenerClima();

        $this->load->view('ciber_view', $data);
    }

    // Nueva función para mostrar el formulario de agregar máquina
    public function agregar_maquina_form()
    {
        $this->load->view('agregar_maquina_form');
    }

    // Función para agregar una máquina
    public function agregar_maquina()
    {
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
    public function actualizar_estado()
    {
        $id = $this->input->post('id');
        $estado = $this->input->post('estado');
        $result = $this->ciber_model->update_computer_state($id, $estado);
        echo json_encode(['success' => $result]);
    }

    // Inicia la sesión en la computadora (cambia su estado a 'en uso')
    public function iniciar_sesion()
    {
        $id = $this->input->post('id');
        $parar_a = $this->input->post('parar_a');
        $result = $this->ciber_model->start_session($id, $parar_a);
        echo json_encode(['success' => $result]);
    }
    // Finaliza la sesión en la computadora (cambia su estado a 'sin usar')
    public function finalizar_sesion()
    {
        $id = $this->input->post('id');
        $result = $this->ciber_model->end_session($id);
        echo json_encode(['success' => $result]);
    }

    // Actualiza la nota y el mensaje de la computadora
    public function actualizar_nota_mensaje()
    {
        $id = $this->input->post('id');
        $nota = $this->input->post('nota');
        $mensaje = $this->input->post('mensaje');
        $result = $this->ciber_model->update_computer_note_and_message($id, $nota, $mensaje);
        echo json_encode(['success' => $result]);
    }

    // Elimina una máquina
    public function eliminar_maquina()
    {
        $id = $this->input->post('id');

        if (!$id) {
            echo json_encode(['success' => false, 'message' => 'ID de máquina no proporcionado.']);
            return;
        }

        $result = $this->ciber_model->delete_computer($id);
        echo json_encode(['success' => $result]);
    }

    public function manual()
    {
        $this->load->view('manual_view');
    }

}
