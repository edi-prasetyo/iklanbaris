<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Berita_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_allberita()
    {
        $this->db->select('*');
        $this->db->from('berita');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_berita($limit, $start)
    {
        $this->db->select('berita.*,
                       category.category_name, user.user_name');
        $this->db->from('berita');
        // Join
        $this->db->join('category', 'category.id = berita.category_id', 'LEFT');
        $this->db->join('user', 'user.id = berita.user_id', 'LEFT');
        //End Join
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
    public function recent_post()
    {
        $this->db->select('berita.*,
                       category.category_name, user.user_name');
        $this->db->from('berita');
        // Join
        $this->db->join('category', 'category.id = berita.category_id', 'LEFT');
        $this->db->join('user', 'user.id = berita.user_id', 'LEFT');
        //End Join
        $this->db->order_by('id', 'DESC');
        $this->db->limit(3);
        $query = $this->db->get();
        return $query->result();
    }

    //Total Berita Main Page
    public function total_row()
    {
        $this->db->select('berita.*,category.category_name, user.user_name');
        $this->db->from('berita');
        // Join
        $this->db->join('category', 'category.id = berita.category_id', 'LEFT');
        $this->db->join('user', 'user.id = berita.user_id', 'LEFT');
        //End Join
        $this->db->where(['berita_status'     =>  'Publish']);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function berita_detail($id)
    {
        $this->db->select('*');
        $this->db->from('berita');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    //Kirim Data Berita ke database
    public function create($data)
    {
        $this->db->insert('berita', $data);
    }
    //Update Data
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('berita', $data);
    }
    //Hapus Data Dari Database
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('berita', $data);
    }

    // Data Berita yang di tampilkan di Front End

    //listing Berita Main Page
    public function berita($limit, $start)
    {
        $this->db->select('berita.*,category.category_name, category.category_slug, user.user_name');
        $this->db->from('berita');
        // Join
        $this->db->join('category', 'category.id = berita.category_id', 'LEFT');
        $this->db->join('user', 'user.id = berita.user_id', 'LEFT');
        //End Join
        $this->db->where(['berita_status'     =>  'Publish']);
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
    //Total Berita Main Page
    public function total()
    {
        $this->db->select('berita.*,category.category_name, user.user_name');
        $this->db->from('berita');
        // Join
        $this->db->join('category', 'category.id = berita.category_id', 'LEFT');
        $this->db->join('user', 'user.id = berita.user_id', 'LEFT');
        //End Join
        $this->db->where(['berita_status'     =>  'Publish']);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    //Read Berita
    public function read($berita_slug)
    {
        $this->db->select('berita.*,category.category_name, category.category_slug, user.user_name, user.user_image, user.user_bio');
        $this->db->from('berita');
        // Join
        $this->db->join('category', 'category.id = berita.category_id', 'LEFT');
        $this->db->join('user', 'user.id = berita.user_id', 'LEFT');
        //End Join
        $this->db->where(array(
            'berita_status'           =>  'Publish',
            'berita.berita_slug'      =>  $berita_slug
        ));
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->row();
    }


    //listing Category Berita
  public function berita_category($category_id,$limit,$start)
  {
    $this->db->select('berita.*,category.category_name, category.category_slug, user.user_name');
    $this->db->from('berita');
    // Join
    $this->db->join('category', 'category.id = berita.category_id', 'LEFT');
    $this->db->join('user', 'user.id = berita.user_id', 'LEFT');
    //End Join
    $this->db->where(array( 'berita_status'           =>  'publish',
                            'berita.category_id'      =>  $category_id));
    $this->db->order_by('berita.id','DESC');
    $this->db->limit($limit,$start);
    $query = $this->db->get();
    return $query->result();
  }
  public function total_category($category_id)
  {
    $this->db->select('berita.*,category.category_name, category.category_slug, user.user_name');
    $this->db->from('berita');
    // Join
    $this->db->join('category', 'category.id = berita.category_id', 'LEFT');
    $this->db->join('user', 'user.id = berita.user_id', 'LEFT');
    //End Join
    $this->db->where(array( 'berita_status'           =>  'publish',
                            'berita.category_id'      =>  $category_id));
    $this->db->order_by('berita.id','DESC');
    $query = $this->db->get();
    return $query->result();
  }

    function update_counter($berita_slug)
    {
        // return current article views
        $this->db->where('berita_slug', urldecode($berita_slug));
        $this->db->select('berita_views');
        $count = $this->db->get('berita')->row();
        // then increase by one
        $this->db->where('berita_slug', urldecode($berita_slug));
        $this->db->set('berita_views', ($count->berita_views + 1));
        $this->db->update('berita');
    }
}
