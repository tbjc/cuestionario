<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Model_preguntas');
	}

	public function index(){
		if ($this->session->userdata('id') != null) {
			redirect('/inicio/preguntas','refresh');
		}
		$this->load->view('inicio_view');
	}

	public function entrar(){
		if ($this->session->userdata('id') != null) {
			redirect('/preguntas','refresh');
		}
		$this->load->view('login');
	}

	public function login(){
		$folio = $this->input->post("folio");
		$password = $this->input->post("password");
		$respCons = $this->Model_preguntas->verificaLogin($folio,$password);
		$respuesta = [];
		if ($respCons["pasa"] == "true") {
			$respuesta["pasa"] = "true";
			$dato = $respCons["dato"];
			$array = array(
				'nombre' => $dato->asp_nombres." ".$dato->asp_apellido1." ".$dato->asp_apellido2,
				'folio' => $dato->asp_folio,
				'id' => $dato->asp_id
			);
			
			$this->session->set_userdata($array);
		}else{
			$respuesta["pasa"] = "false";
			$respuesta["msj"] = $respCons["msj"];
		}
		echo json_encode($respuesta);
	}

	public function quitaPausa(){
		$folio = $this->input->post("folio");
		$password = $this->input->post("password");
		$respuesta = [];
		if ($folio == $this->session->userdata('folio')) {
			$respCons = $this->Model_preguntas->verificaLogin($folio,$password);
			if ($respCons["pasa"] == "true") {
				$respuesta["pasa"] = "true";
			}else{
				$respuesta["pasa"] = "false";
				$respuesta["msj"] = $respCons["msj"];
			}
		}else{
			$respuesta["pasa"] = "false";
			$respuesta["msj"] = "FolioUV incorrecto";
		}
		echo json_encode($respuesta);
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('/','refresh');
	}

	public function salir(){
		$id = $this->session->userdata('id');
		$this->db->where('asp_id', $id);
		$this->db->update('cues_aspirantes', ["asp_fin_examen" => "S"]);
		$this->session->sess_destroy();
		$this->load->view('final_view');
		//redirect('/','refresh');
	}

	public function instrucciones(){
		if ($this->session->userdata('id') == null) {
			redirect('/','refresh');
		}
		redirect('/inicio/preguntas','refresh');
	}

	public function final_examen(){
		if ($this->session->userdata('id') == null) {
			redirect('/','refresh');
		}
		$id = $this->session->userdata('id');
		$this->db->where('asp_id', $id);
		$this->db->update('cues_aspirantes', ["asp_fin_examen" => "S"]);
		$this->session->sess_destroy();

	}

	public function preguntas(){
		if ($this->session->userdata('id') == null) {
			redirect('/','refresh');
		}

		$preguntasDb = $this->Model_preguntas->cargaPreguntas();
		$pregContest = $this->Model_preguntas->preguntasContestadas($this->session->userdata('id'));
		$preguntas = [];
		$renglon = [];
		for ($i=0; $i < count($preguntasDb) ; $i++) {
			array_push($renglon, ["pregunta"=>$preguntasDb[$i]->preg_pregunta,"numero"=>$preguntasDb[$i]->preg_numero,"id"=>$preguntasDb[$i]->preg_id]); 
			if (count($renglon) == 10 ) {
				array_push($preguntas, $renglon);
				$renglon = [];
			}
			//array_push($preguntas, ["pregunta"=>$i."dato","numero"=>$i]);
		}
		if (count($renglon) > 0) {
			array_push($preguntas, $renglon);
		}

		$data["preguntas"] = $preguntas;
		$data["numPreguntas"] = count($preguntasDb);
		$data["pregCont"] = $pregContest;
		$data["hora_inicio"] = $this->Model_preguntas->hora_inicio($this->session->userdata('id'));
		$this->load->view('preguntas_view',$data);
	}

	public function cargaPregById(){
		$id = $this->input->post("id");
		$pregunta = $this->Model_preguntas->pregById($id);
		$pregunta->respuestas = $this->Model_preguntas->respByIdPreg($id);
		$pregunta->contestada = $this->Model_preguntas->respuesta_preg($this->session->userdata('id'),$id);
		echo json_encode($pregunta);
	}

	public function guardaRespuesta(){
		$dato = "";
		$pregunta = $this->input->post("pregunta");
		$respuesta = $this->input->post("respuesta");
		$this->Model_preguntas->eliminaReg($this->session->userdata('id'),$pregunta);
		$resp = $this->Model_preguntas->guardaRespuesta($this->session->userdata('id'), $pregunta, $respuesta);
		echo json_encode($resp);
	}

	public function guardaHoraInicio(){
		$hora = $this->input->post("hora");
		$this->db->where('asp_id', $this->session->userdata('id'));
		$this->db->update('cues_aspirantes', ["asp_hora_empezo" => $hora]);
		echo "guardado";
	}

	public function keepsession(){
		echo "ok";
	}

}

/* End of file Inicio.php */
/* Location: ./application/controllers/Inicio.php */