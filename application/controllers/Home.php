<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
         parent::__construct();
         /*Load the URL helper*/ 
         $this->load->helper('url');
         $this->load->helper('form');
         $this->load->library('form_validation'); 
         $this->load->model('Student_model'); //Load the Model here   
         $this->load->model('User_model'); //Load the Model here   

 }

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
	public function index()
	{
		$this->load->view('login');
		//echo 'i m in home controller';
	}
	public function anilkumar(){
		echo 'hello i m in anilkumar method';
	}
	public function kuldeep_singh(){
			
			$this->Student_model->data_submit();
			redirect('home');

	}
	public function loginpage(){
		//print_r($this->session->all_userdata());
		$this->load->view('loginpage');
	}
	public function submit_user(){
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('cpassword', 'Password Confirmation', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error','User Registration Failed'); 
			redirect(base_url(). 'login');
		}
		else
		{
			$name = $this->input->post('name');
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$hash_password = password_hash($password,PASSWORD_DEFAULT);
			$data = array('name'=>$name, 'email'=>$email, 'password'=>$hash_password);
			$result = $this->User_model->registerUser($data);
			$this->session->set_flashdata('status','User Registered Successfully...');
			redirect(base_url(). 'login');

		}
	}
	public function loginuser(){
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error','Enter Email ID & Password to Access'); 
			redirect(base_url(). 'login');
		}
		else
		{
			$result = $this->User_model->verifyUser();
			//print_r($result);
			//die();
			if($result){
				redirect(base_url(). 'dashboard');
			}else{
				$this->session->set_flashdata('status','User Login Failed');
				redirect(base_url(). 'login');	
			}
			

		}
	}
	public function showallstudents(){
		$keyword = $this->input->get('search');
		$data['anil'] = $this->Student_model->displayStudents($keyword);
		$this->load->view('show_students', $data);
	}
	public function deletestudent(){
		$id = $this->input->get('id');
		$result = $this->Student_model->delete_student_record($id);
		if($result){
			$this->session->set_flashdata('delete_student_status', 'Student Deleted Succcessfully.');
		redirect(base_url(). 'showall');	
		}else{
			$this->session->set_flashdata('delete_student_error', 'Deletion Failed.');
		redirect(base_url(). 'showall');
		}
	}
	public function delete_student_AJAX(){
		$id = $this->input->post('sid');
		$result = $this->Student_model->delete_student_record($id);
		if($result){
			echo $this->session->set_flashdata('delete_student_status', 'Student Deleted Succcessfully.');
		
		}else{
			echo $this->session->set_flashdata('delete_student_error', 'Deletion Failed.');
		
		}
	}
}
