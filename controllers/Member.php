<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {

	function __construct(){

		parent::__construct(); 
		$this->load->database();
		$this->load->model('Member_model');
	}	
	
	public function index()
	{
		$this->access_in();
		$this->load->view('template/header');
		$mem_list = $this->mem_lists();
		$this->load->view('/member/adminvault', $mem_list);
		$this->load->view('template/footer');
	}

	public function utd_member()
	{
		$this->access_in();
		$this->load->view('template/header');
		$utd_list = $this->mem_lists();
		$this->load->view('member/utd_member', $utd_list);
		$this->load->view('template/footer');
	}

	public function update_()
	{
		$this->access_in();
		$this->load->model('Member_model');
		$data['utdmem']=$this->Member_model->utdId($_GET['utdid']);
		$this->load->view('member/update_',$data);
	}

	public function utd_permission()
	{
		$this->load->model('Member_model');
		$this->Member_model->utdMember(array('LOGIN_ID'=>$this->input->post('LOGIN_ID'), 'AD'=>$this->input->post('AD'), 'WD'=>$this->input->post('WD'), 'RD'=>$this->input->post('RD')));

?>		<script>window.close();</script><?php
	}

	public function delete_(){

		$this->access_in();
		$this->load->view('member/delete_');
	}

	public function del_user(){
		$utdid = $_GET['utdid'];	
		$this->load->model('Member_model');
		$this->Member_model->delMember($utdid);
?>		<script>
		window.close();
		opener.parent.location.reload();
		window.opener.close();
		
		</script> <?php
	}

	private function mem_lists(){
		$data['members'] = $this->Member_model->ListMembers();
		return $data;
	}

	public function reg_member()
	{
		$this->access_in();
		$this->load->view('template/header');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('LOGIN_ID', 'LOGIN_ID', 'required');
		$this->form_validation->set_rules('PASSWORD', 'PASSWORD', 'required|min_length[5]|matches[re_password]');
		$this->form_validation->set_rules('re_password', 'chkpasswd', 'required');
		$this->form_validation->set_rules('USER_NAME', 'USER_NAME', 'required');
		$this->form_validation->set_rules('USER_EMAIL', 'USER_EMAIL', 'required|valid_email');

		if($this->form_validation->run()==FALSE){
			$this->load->view('/member/reg_member');
		} else {
			$hash = password_hash($this->input->post('PASSWORD'), PASSWORD_BCRYPT);
			$this->load->model('Member_model');
			$this->Member_model->addMember(array('LOGIN_ID'=>$this->input->post('LOGIN_ID'), 'PASSWORD'=>$hash, 'USER_NAME'=>$this->input->post('USER_NAME'), 'USER_EMAIL'=>$this->input->post('USER_EMAIL'), 'AD'=>$this->input->post('AD'), 'RD'=>$this->input->post('RD'), 'WD'=>$this->input->post('WD')));
			$this->session->set_flashdata('message', 'Join Member');
			$this->load->helper('url');
			redirect('/member/reg_member');
		}
		$this->load->view('template/footer');
	}

	public function auth()
	{

		if(!isset($_POST['LOGIN_ID']) || !isset($_POST['password'])){
		       	redirect('/');
		}
		
		$log_id=$_POST['LOGIN_ID'];
		$log_pwd=$_POST['password'];

		if(($log_id=='') || ($log_pwd=='')){
			$this->session->set_flashdata('message', 'Login Failed.');
			$this->load->helper('url');
			redirect('/');	

		}
		
		$this->load->model('Member_model');
		
		$userInfo = $this->Member_model->getId(array('LOGIN_ID'=>$this->input->post('LOGIN_ID')));

		if(($log_id == $userInfo->LOGIN_ID) && (password_verify($log_pwd, $userInfo->PASSWORD)))
		{
			$this->session->set_userdata('is_login', true);
			$this->session->set_userdata('MEMBER_ID',$userInfo->MEMBER_ID);
			$this->session->set_userdata('LOGIN_ID', $userInfo->LOGIN_ID);
			$this->session->set_userdata('USER_NAME', $userInfo->USER_NAME);
			$this->load->helper('url');
			redirect("/home/mainpage");
		}else{
			$this->session->set_flashdata('message', 'Login Failed.');
			$this->load->helper('url');
			redirect('/');
		}	
	}

	private function access_in(){
		$this->load->model('Member_model');
		$currentuser = $this->session->userdata('LOGIN_ID');
		$accessInfo = $this->Member_model->getId(array('LOGIN_ID'=>$currentuser));
		if($accessInfo->AD != 1){
			$this->load->helper('url');
			redirect("/home/mainpage");
		}
	}

	public function logout(){
	    	$this->session->sess_destroy();
	    	$this->load->helper('url');
	    	redirect('/');

	}


}

?>
