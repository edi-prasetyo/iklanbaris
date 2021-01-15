<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Property_model extends CI_Model
{

	public function get_allproperty($limit, $start)
	{
		$this->db->select('property.*, user.user_image');
		$this->db->from('property');
		// join
		$this->db->join('user', 'user.id = property.user_id', 'LEFT');
		// End Join
		$this->db->order_by('id', 'DESC');
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		return $query->result();
	}

	// Get Property Front Page

	public function get_property($limit, $start)
	{
		$this->db->select('property.*, user.user_image');
		$this->db->from('property');
		$this->db->where('start_date <= ', date('Y-m-d'));
		$this->db->where('expired_date >= ', date('Y-m-d'));
		// join
		$this->db->join('user', 'user.id = property.user_id', 'LEFT');
		// End Join
		$this->db->order_by('id', 'DESC');
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_property_user($limit, $start, $id)
	{
		$this->db->select('*');
		$this->db->from('property');
		$this->db->where('user_id', $id);
		// $this->db->where('start_date <= ' , date('Y-m-d'));
		// $this->db->where('expired_date >= ' , date('Y-m-d'));
		$this->db->order_by('id', 'DESC');
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		return $query->result();
	}
	public function total_property_user($id)
	{
		$this->db->select('*');
		$this->db->from('property');
		$this->db->where('user_id', $id);
		// $this->db->where('start_date <= ' , date('Y-m-d'));
		// $this->db->where('expired_date >= ' , date('Y-m-d'));
		$this->db->order_by('id', 'DESC');

		$query = $this->db->get();
		return $query->result();
	}
	public function total_active_user($id)
	{
		$this->db->select('*');
		$this->db->from('property');
		$this->db->where('user_id', $id);
		$this->db->where('start_date <= ', date('Y-m-d'));
		$this->db->where('expired_date >= ', date('Y-m-d'));
		$this->db->order_by('id', 'DESC');

		$query = $this->db->get();
		return $query->result();
	}
	public function total_inactive_user($id)
	{
		$this->db->select('*');
		$this->db->from('property');
		$this->db->where('user_id', $id);
		// $this->db->where('start_date <= ' , date('Y-m-d'));
		$this->db->where('expired_date <= ', date('Y-m-d'));
		$this->db->order_by('id', 'DESC');

		$query = $this->db->get();
		return $query->result();
	}
	public function total_row_user()
	{
		$this->db->select('*');
		$this->db->from('property');
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}
	function get_province()
	{
		$this->db->select('*');
		$this->db->from('province');
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function property_detail($id)
	{
		$this->db->select('*');
		$this->db->from('property');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	//Kirim Data Berita ke database
	public function create($data)
	{
		$this->db->insert('property', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	public function update($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->update('property', $data);
	}
	public function perpanjangan($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->update('property', $data);
	}

	function get_city($province_id)
	{
		$query = $this->db->get_where('city', array('province_id' => $province_id));
		return $query;
	}


	// FRONT VIEW

	//Read Properti
	public function read($property_slug)
	{
		$this->db->select('property.*,user.user_name, user.user_image, user.user_bio, user.date_register, user.user_phone, user.user_whatsapp, user.email, company.company_name, company.company_logo');
		$this->db->from('property');
		// Join
		$this->db->join('user', 'user.id = property.user_id', 'LEFT');
		$this->db->join('company', 'company.id = user.company_id', 'left');
		//End Join
		$this->db->where('property.property_slug',  $property_slug);
		$query = $this->db->get();
		return $query->row();
	}
	// Update Counter Property
	public function update_counter($property_slug)
	{
		// return current article views
		$this->db->where('property_slug', urldecode($property_slug));
		$this->db->select('property_views');
		$count = $this->db->get('property')->row();
		// then increase by one
		$this->db->where('property_slug', urldecode($property_slug));
		$this->db->set('property_views', ($count->property_views + 1));
		$this->db->update('property');
	}
	public function get_property_popular()
	{
		$this->db->select('property.*, user.user_image');
		$this->db->from('property');
		$this->db->where('start_date <= ', date('Y-m-d'));
		$this->db->where('expired_date >= ', date('Y-m-d'));

		// join
		$this->db->join('user', 'user.id = property.user_id', 'LEFT');
		// End Join
		$this->db->order_by('property_views', 'DESC');
		$this->db->limit(3);
		$query = $this->db->get();
		return $query->result();
	}
}
