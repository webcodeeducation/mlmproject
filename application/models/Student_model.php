<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_model extends CI_Model {

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
	public function data_submit()
	{
		
			$name = $_POST['name'];
			$phone = $_POST['phone'];
			$city = $_POST['city'];
			$data = array('name'=>$name, 'city'=>$city, 'phone'=>$phone);
			$this->db->insert('students',$data);
	}
	public function displayStudents($search=""){
		$this->db->select('*');
$this->db->from('students');
$this->db->like('name', $search);
$query = $this->db->get();

		//$query = $this->db->get('students');	// select * from students
		return $query->result();
	}
	public function delete_student_record($id){
		$status = $this->db->query("delete  from students where id='".$id."'");
		return $status;
	}
	public function registerUser($data){
		$this->db->insert('users', $data);
	}
	public function verifyUser(){
		$email = $this->input->post('email');
		$password1 = $this->input->post('password');
		$hash_password = password_hash($password1,PASSWORD_DEFAULT);
		$query = $this->db
            ->select("*")
            ->from("users")
            ->where("email", $email)
            ->get();
            if(count($query) == 1){
            	$row = $query->row();
            	$password = $row->password;
            	if (!password_verify($hash_password, $row->password)){
            		echo 'not matched';
					return false;
            	}else{
            		echo 'matched';
            		$this->session->set_userdata('userid', $row->id);
            		$newdata = array( 
						   'name'  => $row->name, 
						   'email'     => $row->email,
						   'logged_in' => TRUE
						);
					$this->session->set_userdata($newdata);
            		return true;
            	}

    			}
    			else{
            	return false;
            }
	}
}
