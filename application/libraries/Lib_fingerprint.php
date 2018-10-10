<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Lib_fingerprint {

  public function __construct(){

  }

  public function index(){

  }
  
  public function getData($ip_address){
    $Connect = fsockopen($ip_address, "80", $errno, $errstr, 1);
    if($Connect){
      $soap_request="<GetAttLog><ArgComKey xsi:type=\'xsd:integer\'>0</ArgComKey><Arg><PIN xsi:type=\'xsd:integer\'>All</PIN></Arg></GetAttLog>";
      $newLine="\r\n";
      fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
      fputs($Connect, "Content-Type: text/xml".$newLine);
      fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
      fputs($Connect, $soap_request.$newLine);
      $buffer="";
      while($Response=fgets($Connect, 1024)){
        $buffer=$buffer.$Response;
      }

      $buffer=$this->parseData($buffer,"<GetAttLogResponse>","</GetAttLogResponse>"); 
      $buffer=explode("\r\n",$buffer);
      for($a=0;$a<count($buffer);$a++){
        $data=$this->parseData($buffer[$a],"<Row>","</Row>");
        $data1[$a]['id_user']=$this->parseData($data,"<PIN>","</PIN>");
        $data1[$a]['DateTime']=$this->parseData($data,"<DateTime>","</DateTime>");
      }
      return $data1;
    } else {
      return null;
    }
  }

  public function parseData($data,$p1,$p2){
    $data=" ".$data;
    $hasil="";
    $awal=strpos($data,$p1);
    if($awal!=""){
      $akhir=strpos(strstr($data,$p1),$p2);
      if($akhir!=""){
        $hasil=substr($data,$awal+strlen($p1),$akhir-strlen($p1));
      }
    }
    return $hasil;  
  }
}
?>