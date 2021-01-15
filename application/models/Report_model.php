<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_allreport($limit, $start)
    {
        $this->db->select('report.*, iklan.iklan_title, iklan.id_iklan');
        $this->db->from('report');
        // join
        $this->db->join('iklan', 'iklan.id = report.iklan_id', 'LEFT');
        // End Join
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_report_blog()
    {
        $this->db->select('*');
        $this->db->from('report');
        $this->db->where('report_type', 'Blog');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_report_iklan()
    {
        $this->db->select('*');
        $this->db->from('report');
        $this->db->where('report_type', 'Iklan');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_report_sidebar()
    {
        $this->db->select('*');
        $this->db->from('report');
        $this->db->where('report_type', 'Blog');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function detail_report($id)
    {
        $this->db->select('*');
        $this->db->from('report');
        $this->db->where('id', $id);
        $this->db->order_by('id');
        $query = $this->db->get();
        return $query->row();
    }
    //Read Berita
    public function read($report_slug)
    {
        $this->db->select('*');
        $this->db->from('report');
        // Join

        //End Join
        $this->db->where(array(
            'report.report_slug'      =>  $report_slug
        ));
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->row();
    }

    public function create($data)
    {
        $this->db->insert('report', $data);
    }
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('report', $data);
    }
    //Delete Data
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('report', $data);
    }

    public function total_row()
    {
        $this->db->select('*');
        $this->db->from('report');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
}
