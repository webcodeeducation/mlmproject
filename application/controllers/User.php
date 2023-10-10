<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct(){
         parent::__construct();
         /*Load the URL helper*/ 
         $this->load->helper('url');
         $this->load->helper('form');
         $this->load->library('form_validation'); 
         $this->load->library('session');
         //$this->load->model('Student_model'); //Load the Model here   
         //$this->load->model('User_model'); //Load the Model here
         if($this->session->userdata('user_id') == "")
			{
			   redirect('login');
			}   

 }

	public function index()
	{
		$this->load->view('user/home');
		//echo 'Welcome to user';
	}
	public function login(){
		echo 'show login page here';
	}
	public function logout(){
		$newdata = array(
                'user_id' => '',
                'name' => '',
                'email' => '',
                'logged_in' => FALSE
               );
     $this->session->unset_userdata($newdata);
     $this->session->sess_destroy();
     //redirect('default_controller','refresh');
     session_regenerate_id(true);
     $this->session->set_flashdata('status','User Login Successfully.');
	redirect(base_url(). 'login');
	}
}
