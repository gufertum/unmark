<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Groups_model extends CI_Model {

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    /* ## CRUD */
    function create_group()
    {
        $name = $this->input->post('name',TRUE);
        $description = $this->input->post('description',TRUE);
        $uid = $this->input->post('uid');

        // Add group to database
        $this->db->insert('groups',array('name'=>$name,'description'=>$description,'uid'=>$uid,'createdby'=>$this->session->userdata('userid')));
        
        $groupid = $this->Groups_model->get_group_id($uid);
        if (!$groupid) { 
            exit ('there was a problem creating the group');
        }

        return $groupid;
    }

    function get_group_id( $uid ) {
        
        if (!$uid) { return false; }

        $group = $this->db->get_where('groups', array('uid' => $uid));
        
        if ($group->num_rows() > 0) {
            $group = $group->result_object();
            return $group[0]->id;
        }

        return false;
    }

    function get_all_groups()
    {

    }

    function get_groups_by_user()
    {	
		$user_belongs_to_groups = $this->db->query('SELECT * FROM users_groups LEFT JOIN groups ON users_groups.groupid=groups.id WHERE users_groups.userid='.$this->session->userdata('userid'));
		
		if ($user_belongs_to_groups->num_rows() > 0) {
			return $user_belongs_to_groups->result_array();
		} else {
			return false;
		}
    }

    function get_group_members()
    {

    }

    function add_member_to_group($groupid)
    {
        if (!$groupid) return false;

        $this->db->insert('users_groups',array('groupid'=>$groupid,'userid'=>$this->session->userdata('userid')));
    }

    function get_group_members_count()
    {

    }

    function group_update()
    {

    }

    function group_delete()
    {

    }

    /* Invites */

    function group_create_invite()
    {

    }

    function group_accept_invite()
    {

    }

    function group_delete_invite()
    {

    }


}