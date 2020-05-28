<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_preguntas extends CI_Model {

	public function verificaLogin($folio,$pass){
		$this->db->select('*');
		$this->db->from('cues_aspirantes');
		$this->db->where('asp_folio', $folio);
		$datosP = $this->db->get()->result();
		if (count($datosP) > 0) {
			if ($datosP[0]->asp_password == $pass) {
				if ($datosP[0]->asp_fin_examen == "N") {
					$pasa = [];
					$pasa["pasa"] = "true";
					$pasa["dato"] = $datosP[0];
					return $pasa;
				}else{
					$pasa = [];
					$pasa["pasa"] = "false";
					$pasa["msj"] = "Ya terminaste el examen, no puedes volver a contestarlo";
					return $pasa;
				}
			}else{
				$pasa = [];
				$pasa["pasa"] = "false";
				$pasa["msj"] = "Contraseña incorrecta";
				return $pasa;
			}
		}else{
			$pasa = [];
			$pasa["pasa"] = "false";
			$pasa["msj"] = "FolioUV incorrecto";
			return $pasa;
		}
	}

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

	public function preguntasContestadas($id_usuario){
		$this->db->select('resp_usu_preg pregunta');
		$this->db->from('cues_respuesta_usuario');
		$this->db->where('resp_usu_aspirante', $id_usuario);
		return $this->db->get()->result();
	}

	public function respuesta_preg($id_usu, $id_preg){
		$this->db->select('resp_usu_resp respuesta');
		$this->db->from('cues_respuesta_usuario');
		$this->db->where('resp_usu_aspirante', $id_usu);
		$this->db->where('resp_usu_preg', $id_preg);
		$resultado = $this->db->get()->result();
		if (count($resultado) > 0) {
			return $resultado[0]->respuesta;
		}else{
			return null;
		}
	}

	public function eliminaReg($id_usu, $id_preg){
		$this->db->where('resp_usu_aspirante', $id_usu);
		$this->db->where('resp_usu_preg', $id_preg);
		$this->db->delete('cues_respuesta_usuario');
	}

	public function guardaRespuesta($id_usu, $id_preg, $id_resp){
		$objeto = [
			"resp_usu_preg" => $id_preg,
			"resp_usu_resp" => $id_resp,
			"resp_usu_aspirante" => $id_usu
		];
		$this->db->insert('cues_respuesta_usuario', $objeto);
		return $objeto;
	}

	public function hora_inicio($id){
		$this->db->where('asp_id', $id);
		return $this->db->get('cues_aspirantes')->row()->asp_hora_empezo;
	}

	public function estado_pausa($id){
		$this->db->where('asp_id', $id);
		return $this->db->get('cues_aspirantes')->row()->asp_esta_pausa;
	}

}

/* End of file Model_preguntas.php */
/* Location: ./application/models/Model_preguntas.php */