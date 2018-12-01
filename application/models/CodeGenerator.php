<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CodeGenerator extends CI_Model {

	public function buatkode($table,$field, $panjang, $inisial){
		
		$sql=$this->db->query("select max(".$field.") as $field from ".$table)->result();
		//var_dump($sql[0]->noktp);
		// $row=mysql_fetch_array($sql);
		
		if ($sql[0]->$field==""){
			$angka="0";
		}else{
			
			$angka=substr($sql[0]->$field,strlen($inisial));
		}
		//return $angka;
		$angka++;
		$angka=strval($angka);
		$tmp="";
		for ($i=1; $i<=($panjang-strlen($angka)-strlen($inisial));$i++){
			$tmp=$tmp."0";
		}
		return $inisial.$tmp.$angka ;
	}	
	public function buatkodetr($table,$field, $panjang, $inisial){
		
		$sql=$this->db->query("select max(".$field.") as field from ".$table)->result();
		//var_dump($sql[0]->noktp);
		// $row=mysql_fetch_array($sql);

		if ($sql[0]->field==""){
			$angka="0";
		}else{
			$da=explode("-", $sql[0]->field);
			$field1=$da[1];
			// var_dump($da);
			$angka=substr($field1,strlen($inisial));
		}
		//return $angka;
		$angka++;
		$angka=strval($angka);
		$tmp="";
		for ($i=1; $i<=($panjang-strlen($angka)-strlen($inisial));$i++){
			$tmp=$tmp."0";
		}
		return date("ymd")."-".$inisial.$tmp.$angka ;
	}	
	public function buatkode2(){
		
		$sql=$this->db->query("select * from form");
		return $sql->num_rows();
	}	
	

	public function konversi($nilai){

		$sql=$this->db->query("select * from grade")->result();
		foreach ($sql as $gradeku) {
			
			if($gradeku->dari<=$nilai && $gradeku->sampai>=$nilai){
				
				return $gradeku->grade;
			}
			
		}
		
	}
	function to_xml(SimpleXMLElement $object, array $data)
{   
    foreach ($data as $key => $value) {
        if (is_array($value)) {
            $new_object = $object->addChild($key);
            to_xml($new_object, $value);
        } else {   
            $object->addChild($key, $value);
        }   
    }   
}   



}

/* End of file CodeGenerator.php */
/* Location: ./application/models/CodeGenerator.php */