<?php
class Sitemap_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function create() {
        $this->db->select('berita_slug, date_created');
        $this->db->from('berita');
        $this->db->order_by('id',"ASC");
        $query = $this->db->get();
        return $query->result();
    }
}
?>
