<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Lib_hari {

  public function __construct(){
    $this->CI =& get_instance();
    date_default_timezone_set("Asia/Jakarta");
    $this->hari_ini = date("Y-m-d");
  }

  public function cekByDate($date){
	$this->CI->db->where("id_hari", date("w", strtotime($date)));
	return $this->CI->db->get("rule_hari")->result_array();
  }
  public function cek(){
    if($this->cekHariTambahan() != null){
      return $this->cekHariTambahan();
    }else{
      return $this->cekHari();
    }
  }

  public function cekHariTambahan(){
    $this->CI->db->where("tanggal", $this->hari_ini);
    return $this->CI->db->get("rule_hari_tambahan")->result_array();
  }

  public function cekHari(){
    $hari = date("w");
    $this->CI->db->where("id_hari", $hari);
    return $this->CI->db->get("rule_hari")->result_array();
  }
}
?>