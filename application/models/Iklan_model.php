<?php
defined('BASEPATH') or exit('No direct script access allowed');

class iklan_model extends CI_Model
{

    public function get_alliklan($limit, $start)
    {
        $this->db->select('iklan.*, user.user_image,user.user_name, province.province_name, category.category_name');
        $this->db->from('iklan');
        // $this->db->where('iklan_status', 'Active');
        // join
        $this->db->join('category', 'category.id = iklan.category_id', 'LEFT');
        $this->db->join('user', 'user.id = iklan.user_id', 'LEFT');
        $this->db->join('province', 'province.id = iklan.province_id', 'left');
        // End Join
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_iklan_category($category_id, $limit, $start)
    {
        $this->db->select('iklan.*, user.user_image,user.user_name, category.category_name, province.province_name');
        $this->db->from('iklan');
        $this->db->where(['iklan_status' => 'Active', 'category_id' => $category_id]);
        // join
        $this->db->join('category', 'category.id = iklan.category_id', 'LEFT');
        $this->db->join('province', 'province.id = iklan.province_id', 'left');
        $this->db->join('user', 'user.id = iklan.user_id', 'LEFT');
        // End Join
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    // Iklan Premium
    public function iklan_premium()
    {
        $this->db->select('iklan.*, user.user_image,user.user_name, category.category_name, province.province_name');
        $this->db->from('iklan');
        $this->db->where('iklan_status', 'Active');
        // $this->db->where('iklan_featured <= ', date('Y-m-d'));
        $this->db->where('iklan_featured >= ', date('Y-m-d'));
        // join
        $this->db->join('category', 'category.id = iklan.category_id', 'LEFT');
        $this->db->join('province', 'province.id = iklan.province_id', 'left');
        $this->db->join('user', 'user.id = iklan.user_id', 'LEFT');
        // End Join
        $this->db->order_by('rand()');
        $this->db->limit(2);
        $query = $this->db->get();
        return $query->result();
    }

    // Count Iklan Dashboard

    public function count_iklan()
    {
        $this->db->select('*');
        $this->db->from('iklan');
        $query = $this->db->get();
        return $query->result();
    }
    public function iklan_dashboard()
    {
        $this->db->select('iklan.*, user.user_name, category.category_name');
        $this->db->from('iklan');
        // join
        $this->db->join('category', 'category.id = iklan.category_id', 'LEFT');
        $this->db->join('user', 'user.id = iklan.user_id', 'LEFT');
        // End Join
        $this->db->limit(5);
        $query = $this->db->get();
        return $query->result();
    }


    // Get iklan Front Page

    public function get_iklan($limit, $start)
    {
        $this->db->select('iklan.*, user.user_image,user.user_name, category.category_name, province.province_name');
        $this->db->from('iklan');
        $this->db->where('iklan_status', 'Active');
        // $this->db->where('start_date <= ', date('Y-m-d'));
        // $this->db->where('expired_date >= ', date('Y-m-d'));
        // join
        $this->db->join('category', 'category.id = iklan.category_id', 'LEFT');
        $this->db->join('province', 'province.id = iklan.province_id', 'left');
        $this->db->join('user', 'user.id = iklan.user_id', 'LEFT');
        // End Join
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_iklan_user($limit, $start, $id)
    {
        $this->db->select('iklan.*, user.premium_count');
        $this->db->from('iklan');
        $this->db->where('user_id', $id);
        // Join
        $this->db->join('user', 'user.id = iklan.user_id', 'LEFT');
        // End Join
        // $this->db->where('start_date <= ' , date('Y-m-d'));
        // $this->db->where('expired_date >= ' , date('Y-m-d'));
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
    public function total_iklan_user($id)
    {
        $this->db->select('*');
        $this->db->from('iklan');
        $this->db->where('user_id', $id);
        // $this->db->where('start_date <= ' , date('Y-m-d'));
        // $this->db->where('expired_date >= ' , date('Y-m-d'));
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }
    // Iklan Aktif
    public function total_iklan_user_active($id)
    {
        $this->db->select('*');
        $this->db->from('iklan');
        $this->db->where(['user_id' => $id, 'iklan_status' => 'active']);
        // $this->db->where('start_date <= ' , date('Y-m-d'));
        // $this->db->where('expired_date >= ' , date('Y-m-d'));
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }
    // Iklan Pending
    public function total_iklan_user_pending($id)
    {
        $this->db->select('*');
        $this->db->from('iklan');
        $this->db->where(['user_id' => $id, 'iklan_status' => 'Pending']);
        // $this->db->where('start_date <= ' , date('Y-m-d'));
        // $this->db->where('expired_date >= ' , date('Y-m-d'));
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function total_active_user($id)
    {
        $this->db->select('*');
        $this->db->from('iklan');
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
        $this->db->from('iklan');
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
        $this->db->from('iklan');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function total_row()
    {
        $this->db->select('*');
        $this->db->from('iklan');
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

    public function iklan_detail($id)
    {
        $this->db->select('iklan.*,user.premium_count');
        $this->db->from('iklan');
        // Join
        $this->db->join('user', 'user.id = iklan.user_id', 'LEFT');
        // End Joint
        $this->db->where('iklan.id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    //Kirim Data Berita ke database
    public function create($data)
    {
        $this->db->insert('iklan', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('iklan', $data);
    }
    //Hapus Data Dari Database
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('iklan', $data);
    }
    public function perpanjangan($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('iklan', $data);
    }

    function get_city($province_id)
    {
        $query = $this->db->get_where('city', array('province_id' => $province_id));
        return $query;
    }


    // FRONT VIEW

    //Read Properti
    public function read($iklan_slug)
    {
        $this->db->select('iklan.*,user.user_name,user.user_image, user.user_bio, user.date_register, user.user_phone, user.user_whatsapp, user.email, user.username, user.user_address, province.province_name');
        $this->db->from('iklan');
        // Join
        $this->db->join('user', 'user.id = iklan.user_id', 'LEFT');
        $this->db->join('province', 'province.id = iklan.province_id', 'left');

        //End Join
        $this->db->where('iklan.iklan_slug',  $iklan_slug);
        $query = $this->db->get();
        return $query->row();
    }
    // Update Counter iklan
    public function update_counter($iklan_slug)
    {
        // return current article views
        $this->db->where('iklan_slug', urldecode($iklan_slug));
        $this->db->select('iklan_views');
        $count = $this->db->get('iklan')->row();
        // then increase by one
        $this->db->where('iklan_slug', urldecode($iklan_slug));
        $this->db->set('iklan_views', ($count->iklan_views + 1));
        $this->db->update('iklan');
    }
    public function get_iklan_home()
    {
        $this->db->select('iklan.*, user.user_image, category.category_name, province_name');
        $this->db->from('iklan');
        // join
        $this->db->join('user', 'user.id = iklan.user_id', 'LEFT');
        $this->db->join('category', 'category.id = iklan.category_id', 'LEFT');
        $this->db->join('province', 'province.id = iklan.province_id', 'LEFT');
        // End Join
        $this->db->where('iklan_status', 'Active');
        $this->db->order_by('iklan_views', 'DESC');
        $this->db->limit(4);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_iklan_popular()
    {
        $this->db->select('iklan.*, user.user_image');
        $this->db->from('iklan');
        $this->db->where('start_date <= ', date('Y-m-d'));
        $this->db->where('expired_date >= ', date('Y-m-d'));

        // join
        $this->db->join('user', 'user.id = iklan.user_id', 'LEFT');
        // End Join
        $this->db->order_by('iklan_views', 'DESC');
        $this->db->limit(3);
        $query = $this->db->get();
        return $query->result();
    }




    //listing Category Berita
    public function iklan_category($category_id, $limit, $start)
    {
        $this->db->select('iklan.*,category.category_name, category.category_slug, user.user_name,province.province_name');
        $this->db->from('iklan');
        // Join
        $this->db->join('category', 'category.id = iklan.category_id', 'LEFT');
        $this->db->join('user', 'user.id = iklan.user_id', 'LEFT');
        $this->db->join('province', 'province.id = iklan.province_id', 'left');
        //End Join
        $this->db->where(array(
            'iklan_status'           =>  'Active',
            'iklan.category_id'      =>  $category_id
        ));
        $this->db->order_by('iklan.id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
    public function total_category($category_id)
    {
        $this->db->select('iklan.*,category.category_name, category.category_slug, user.user_name');
        $this->db->from('iklan');
        // Join
        $this->db->join('category', 'category.id = iklan.category_id', 'LEFT');
        $this->db->join('user', 'user.id = iklan.user_id', 'LEFT');
        //End Join
        $this->db->where(array(
            'iklan_status'           =>  'Active',
            'iklan.category_id'      =>  $category_id
        ));
        $this->db->order_by('iklan.id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    // Iklan User
    public function iklan_user($username, $limit, $start)
    {
        $this->db->select('iklan.*,category.category_name, category.category_slug, user.user_name, user.user_image, province.province_name');
        $this->db->from('iklan');
        // Join
        $this->db->join('category', 'category.id = iklan.category_id', 'LEFT');
        $this->db->join('user', 'user.id = iklan.user_id', 'LEFT');
        $this->db->join('province', 'province.id = iklan.province_id', 'left');
        //End Join
        $this->db->where(array(
            'iklan_status'           =>  'Active',
            'user.username'          =>  $username
        ));
        $this->db->order_by('iklan.id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
    public function total_user($user_id)
    {
        $this->db->select('iklan.*,category.category_name, category.category_slug, user.user_name');
        $this->db->from('iklan');
        // Join
        $this->db->join('category', 'category.id = iklan.category_id', 'LEFT');
        $this->db->join('user', 'user.id = iklan.user_id', 'LEFT');
        //End Join
        $this->db->where(array(
            'iklan_status'           =>  'Active',
            'iklan.user_id'      =>  $user_id
        ));
        $this->db->order_by('iklan.id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }




    public function getDataIklan($rowno, $rowperpage)
    {

        $this->db->select('iklan.*,category.category_name, category.category_slug, user.user_name, province.province_name');
        $this->db->from('iklan');
        // Join
        $this->db->join('category', 'category.id = iklan.category_id', 'LEFT');
        $this->db->join('user', 'user.id = iklan.user_id', 'LEFT');
        $this->db->join('province', 'province.id = iklan.province_id', 'LEFT');
        //End Join
        $this->db->limit($rowno, $rowperpage);
        $query = $this->db->get();

        return $query->result_array();
    }

    // Select total records
    public function getrecordCountIklan()
    {

        $this->db->select('count(*) as allcount');
        $this->db->from('iklan');
        $query = $this->db->get();
        $result = $query->result_array();

        return $result[0]['allcount'];
    }

    // Fungsi Pencarian
    // Fetch records
    public function getData($rowno, $rowperpage, $search = "")
    {

        $this->db->select('iklan.*,category.category_name, category.category_slug, user.user_name, province.province_name');
        $this->db->from('iklan');
        // Join
        $this->db->join('category', 'category.id = iklan.category_id', 'LEFT');
        $this->db->join('user', 'user.id = iklan.user_id', 'LEFT');
        $this->db->join('province', 'province.id = iklan.province_id', 'LEFT');
        //End Join

        if ($search != '') {
            $this->db->like('iklan_title', $search);
            $this->db->or_like('province_id', $search);
        }

        $this->db->limit($rowperpage, $rowno);
        $query = $this->db->get();

        return $query->result_array();
    }

    // Select total records
    public function getrecordCount($search = '')
    {

        $this->db->select('count(*) as allcount');
        $this->db->from('iklan');

        if ($search != '') {
            $this->db->like('iklan_title', $search);
            $this->db->or_like('province_id', $search);
        }

        $query = $this->db->get();
        $result = $query->result_array();

        return $result[0]['allcount'];
    }
}
