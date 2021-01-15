<?php
defined('BASEPATH') or exit('No direct script access allowed');

class transaksi_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_alltransaksi()
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_transaksi($limit, $start)
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    //Total transaksi Main Page
    public function total_row()
    {
        $this->db->select('transaksi.*, user.user_name');
        $this->db->from('transaksi');
        // Join
        $this->db->join('user', 'user.id = transaksi.user_id', 'LEFT');
        //End Join
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function transaksi_detail($id)
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }


    //Kirim Data transaksi ke database
    public function create($data)
    {
        $this->db->insert('transaksi', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    // Last Transaksi Jika Sukses
    public function last_transaksi($id)
  {
    $this->db->select('*');
    $this->db->from('transaksi');
    $this->db->where('id', $id);
    $this->db->order_by('id');
    $query = $this->db->get();
    return $query->row();
  }
    //Update Data
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('transaksi', $data);
    }
    //Hapus Data Dari Database
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('transaksi', $data);
    }

    // Halaman Transaksi user
    public function total_row_transaksi_user($id)
    {
        $this->db->select('transaksi.*, user.user_name');
        $this->db->from('transaksi');
        // Join
        $this->db->join('user', 'user.id = transaksi.user_id', 'LEFT');
        //End Join
        $this->db->where(['user_id' => $id]);
        $this->db->order_by('transaksi.id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    // PEMASUKAN BY USER
    public function get_transaksi_user($limit, $start, $id)
    {
        $this->db->select('transaksi.*, user.user_name');
        $this->db->from('transaksi');
        $this->db->where(['user_id' => $id]);
        // Join
        $this->db->join('user', 'user.id = transaksi.user_id', 'LEFT');
        //End Join

        $this->db->order_by('transaksi.id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    //Cek Detail transaksi
  public function cek_transaksi($transaction_code, $email)
  {
    $this->db->select('*');
    $this->db->from('transaksi');
    $this->db->like('transaction_code', $transaction_code);
    $this->db->like('email', $email);
    // $this->db->where('kode_transaksi',$kode_transaksi);
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->row();
  }
  public function detail_konfirmasi($transaction_code)
  {
      $this->db->select('*');
      $this->db->from('transaksi');
      $this->db->where('transaction_code', $transaction_code);
      $query = $this->db->get();
      return $query->row();
  }


}
