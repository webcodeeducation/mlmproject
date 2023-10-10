<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
         $this->load->model('Admin_model'); //Load the Model here   
         //$this->load->model('User_model'); //Load the Model here
         /*if($this->session->userdata('admin_id') == "")
			{
			   redirect('admin/login');
			}*/   
 }
	public function index()
	{
		$this->load->view('admin/login');
		//echo 'Welcome to user';
	}
	public function login(){
		echo 'show admin login page here';
	}
	public function adminlogin(){
		//print_r($_POST);
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error','Enter Email ID & Password to Access'); 
			redirect(base_url(). 'login');
		}
		else
		{
			$result = $this->Admin_model->verifyAdmin();
			//print_r($result);
			//die();
			if($result){
				redirect(base_url(). 'admin');
			}else{
				$this->session->set_flashdata('status','Admin Login Failed');
				redirect(base_url(). 'admin/login');	
			}
			

		}
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
	redirect(base_url(). 'admin/login');
	}
}
