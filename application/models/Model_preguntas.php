<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_preguntas extends CI_Model {

	public function cargaPreguntas(){
		$this->db->select('*');
		$this->db->from('cues_pregunta');
		$this->db->where('preg_cuestionario', 1);
		return $this->db->get()->result();
	}

	public function pregById($id){
		$this->db->select('*');
		$this->db->from('cues_pregunta');
		$this->db->where('preg_cuestionario', 1);
		$this->db->where('preg_id', $id);
		return $this->db->get()->row();
	}

	public function respByIdPreg($idpre){
		$this->db->select('*');
		$this->db->from('cues_repuesta');
		$this->db->where('resp_idpregunta', $idpre);
		return $this->db->get()->result();
	}

}

/* End of file Model_preguntas.php */
/* Location: ./application/models/Model_preguntas.php */