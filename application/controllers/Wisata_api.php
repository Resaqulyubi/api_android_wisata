<?php

require APPPATH . '/libraries/REST_Controller.php';

class wisata_api extends REST_Controller {

  function __construct($config = 'rest') {
    parent::__construct($config);
  }

  // show data
  function index_get() {
    $id = $this->get('id');
    $iduser = $this->get('iduser');
    if( $iduser != ''){
      $this->db->where('iduser', $iduser);
      $data=$this->db->get("tbl_wisata")->result();
   
    }   elseif ( $id == ''){
      $data=$this->db->get("tbl_wisata")->result();
    }else {
      $this->db->where('id', $id);
     
      $data=$this->db->get("tbl_wisata")->result();
    }
    $data = array(
      "status"=>"true",
      "data"=> $data);
      $this->response($data, 200);
    }

    // insert new data to
    function index_post() {
      if($this->input->post('action')=="POST"){
        $data = array(
          'id' => '',
          'iduser' => $this->input->post('iduser'),
          'idkategori' => $this->input->post('idkategori'),
          'latlong' => $this->input->post('latlong'),
          'nama_lokasi' => $this->input->post('nama_lokasi'),
          'createdate' => $this->input->post('createdate'),
          'jam' => $this->input->post('jam')
        );
        $insert = $this->db->insert('tbl_wisata', $data);
        if ($insert) {
          $this->response(array("data"=>array($data), "status"=>"true", 200));
        } else {
          $this->response(array("data"=>array($data),'status' => 'false', 502));
        }

      }elseif($this->input->post('action')=="PUT"){
        $id_user = $this->input->post('id');
        $data = array(
          'nama' => $this->input->post('nama'),
          'email' => $this->input->post('email'),
          'username' => $this->input->post('username'),
          'password' => $this->input->post('password')
        );

        $this->db->where('id', $id_user);
        $update = $this->db->update('tb_user', $data);
        if ($update) {
          $this->response(array("data"=>array($data), "status"=>"true", 200));
        } else {
          $this->response(array("data"=>array($data),'status' => 'false', 502));
        }

      }elseif($this->input->post('action')=="DELETE"){
        $id_user = $this->input->post('id');
        $this->db->where('id', $id_user);
        $delete = $this->db->delete('tb_user');
        if ($delete) {
          $this->response(array('status' => 'true'), 200);
        } else {
          $this->response(array('status' => 'false', 502));
        }
      }
    }

  }
