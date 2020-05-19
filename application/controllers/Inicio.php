<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Model_preguntas');
	}

	public function index(){
		$this->load->view('login');
	}

	public function login(){
		$folio = $this->input->post("folio");
		$password = $this->input->post("password");
		$dato = $this->Model_preguntas->verificaLogin($folio,$password);
		$respuesta = [];
		if ($dato != []) {
			$respuesta["pasa"] = "true";
			$array = array(
				'nombre' => $dato->asp_nombres." ".$dato->asp_apellido1." ".$dato->asp_apellido2,
				'folio' => $dato->asp_folio,
				'id' => $dato->asp_id,
			);
			
			$this->session->set_userdata($array);
		}else{
			$respuesta["pasa"] = "false";
		}
		echo json_encode($respuesta);
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('/','refresh');
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
		$this->load->view('preguntas_view',$data);
	}

	public function cargaPregById(){
		$id = $this->input->post("id");
		$pregunta = $this->Model_preguntas->pregById($id);
		$pregunta->respuestas = $this->Model_preguntas->respByIdPreg($id);
		$pregunta->contestada = $this->Model_preguntas->respuesta_preg($this->session->userdata('id'),$id);
		//echo $this->db->last_query();
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


}

/* End of file Inicio.php */
/* Location: ./application/controllers/Inicio.php */