<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

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
	public function fetchAllUsers(){
		$this->db->select('*');
    $this->db->from('users');
    //$this->db->where('users_groups.user_id',1);
    //$this->db->join('users_groups', 'users.id = users_groups.user_id');
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
	}
	public function verifyUser(){
		$email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->getUserByEmail($email);

        if ($user && password_verify($password, $user->password)) {
            $this->session->set_userdata([
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'logged_in' => TRUE
            ]);

            //redirect('dashboard'); // Redirect to dashboard or any other page on successful login
            return true;
        } else {
            //echo 'Invalid login credentials'; // You may want to show an error message
            return false;
        }
		/*$email = $this->input->post('email');
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
            }*/
	}
	public function verifyAdmin(){
		$email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->getAdminByEmail($email);

        if ($user && password_verify($password, $user->password)) {
            $this->session->set_userdata([
                'admin_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'logged_in' => TRUE
            ]);

            //redirect('dashboard'); // Redirect to dashboard or any other page on successful login
            return true;
        } else {
            //echo 'Invalid login credentials'; // You may want to show an error message
            return false;
        }
	}
	public function getAdminByEmail($email) {
        return $this->db->get_where('admin', ['email' => $email])->row();
    }
}
