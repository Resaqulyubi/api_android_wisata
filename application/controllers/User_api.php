<?php

require APPPATH . '/libraries/REST_Controller.php';

class User_api extends REST_Controller {

  function __construct($config = 'rest') {
    parent::__construct($config);
  }

  // show data
  function index_get() {
    $id = $this->get('id');
    $username = $this->get('username');
    $password = $this->get('password');
    if ($username!=''&& $password!='' ) {
      $this->db->where('username', $username);
      $this->db->where('password', $password);
      $data=$this->db->get("tbl_user")->result();
    }else if( $id == ''){
      $data=$this->db->get("tbl_user")->result();
    }else {
      $this->db->where('id', $id);
     
      $data=$this->db->get("tbl_user")->result();
    }
    
           if (empty($data)) {
$data = array(

      "status"=>"false",
      "data"=> $data);
      
      $this->response($data, 200);
  }else{
    $data = array(
  
      "status"=>"true",
      "data"=> $data);
      
      $this->response($data, 200);
  }

    
    }

    // insert new data to
    function index_post() {
      if($this->input->post('action')=="POST"){
        $data = array(
          'id' => '',
          'nama' => $this->input->post('nama'),
          'email' => $this->input->post('email'),
          'username' => $this->input->post('username'),
          'password' => $this->input->post('password')
        );
        $insert = $this->db->insert('tbl_user', $data);
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
        $update = $this->db->update('tbl_user', $data);
        if ($update) {
          $this->response(array("data"=>array($data), "status"=>"true", 200));
        } else {
          $this->response(array("data"=>array($data),'status' => 'false', 502));
        }

      }elseif($this->input->post('action')=="DELETE"){
        $id_user = $this->input->post('id');
        $this->db->where('id', $id_user);
        $delete = $this->db->delete('tbl_user');
        if ($delete) {
          $this->response(array('status' => 'true'), 200);
        } else {
          $this->response(array('status' => 'false', 502));
        }
      }
    }

  }
