<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//AIzaSyDliyJ5AjeSRT26ncDNo9SYQCTXVjSuFm4
class youtube extends CI_Controller {
        
	public function index()
	{	
            $data = array();
            $this->load->helper('url');
          
                //$data['css']  = $this->config->item('css');
                 //$this->load->view('youtubeView',$data);
            
             if($this->input->post('submit') != NULL ){
                        $postData = $this->input->post();
                       $data['response'] = $postData;
                       
                       //var_dump($postData);
            }
            
	
/*
        if (empty($keyword))
        {
            $response = array(
                  "type" => "error",
                  "message" => "Please enter the keyword."
                );
        }*/
          $this->load->view('youtube',$data);
}}