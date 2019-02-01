<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	private function dbconn(){
		$this->load->database();
	}

	public function ListMembers()
	{
		$this->dbconn();
		$sql = $this->db->query("SELECT * FROM MEMBERS");
		$result = $sql -> result();

		return $result;
	}

	public function getId($loginfo)
	{
		$this->load->database();
		$resID = $this->db->get_where('MEMBERS', array('LOGIN_ID'=>$loginfo['LOGIN_ID']))->row();
		return $resID;
	}

	public function utdId($info)
	{
		$this->dbconn();
		$resId = $this->db->query("SELECT * FROM MEMBERS WHERE LOGIN_ID='$info'")->result();
		return $resId;
	}
		
	public function addMember($info)
	{
		$this->dbconn();
                $this->db->set('LOGIN_ID', $info['LOGIN_ID']);
                $this->db->set('PASSWORD', $info['PASSWORD']);
                $this->db->set('USER_NAME', $info['USER_NAME']);
                $this->db->set('USER_EMAIL', $info['USER_EMAIL']);
                $this->db->set('AD',$info['AD']);
                $this->db->set('RD',$info['RD']);
                $this->db->set('WD',$info['WD']);
		$this->db->insert('MEMBERS');	
	}

	public function utdMember($info)
	{
		$this->dbconn();
		$this->db->query("UPDATE MEMBERS SET AD=$info[AD],RD=$info[RD],WD=$info[WD] WHERE LOGIN_ID='$info[LOGIN_ID]'");

	}

	public function delMember($info)
	{
		echo $info;
		$this->dbconn();
		$this->db->query("DELETE FROM MEMBERS WHERE LOGIN_ID='$info'");
	}
}

