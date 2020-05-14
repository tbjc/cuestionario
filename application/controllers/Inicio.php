<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_preguntas');
	}

	public function index()
	{
		$this->load->view('login');
	}

	public function preguntas(){
		$preguntasDb = $this->Model_preguntas->cargaPreguntas();

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
		$this->load->view('preguntas_view',$data);
	}

	public function cargaPregById(){
		$id = $this->input->post("id");
		$pregunta = $this->Model_preguntas->pregById($id);
		$pregunta->respuestas = $this->Model_preguntas->respByIdPreg($id);
		echo json_encode($pregunta);
	}
}

/* End of file Inicio.php */
/* Location: ./application/controllers/Inicio.php */