<?php 
class Login_model extends Model {

    function Login_model()
    {
        parent::Model();
    }
    
    function connect($post){
		$this->db->where('usd_username', $post['username']);
		$this->db->where('usd_password', substr(md5($post['password']),0,15));
		$query = $this->db->get('VW_LIST_ALL_ACTIVE_USERS');
		if ($query->num_rows() > 0){
			$row = $query->row();

			$_SESSION['user_so_id'] = $row->so_id;
			$_SESSION['name'] = $row->usd_name;
			$_SESSION['usd_user'] = $row;
			return true;
		}else{
			return false;
		}
    }
}

/* End of file login_model.php */
/* Location: ./system/application/controllers/login_model.php */
?>