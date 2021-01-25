<?php
defined('BASEPATH') or exit('No direct script access allowed');

class transaction_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_alltransaction()
    {
        $this->db->select('*');
        $this->db->from('transaction');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function transaksi_baru()
    {
        $this->db->select('*');
        $this->db->from('transaction');
        $this->db->limit(4);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_transaction($limit, $start, $transaction_code)
    {
        $this->db->select('transaction.*, user.user_name, user.user_phone,');
        $this->db->from('transaction');
        // Join
        $this->db->join('user', 'user.id = transaction.user_id', 'LEFT');
        //End Join
        $this->db->like('transaction_code', $transaction_code);
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    //Total transaction Main Page
    public function total_row()
    {
        $this->db->select('transaction.*, user.user_name');
        $this->db->from('transaction');
        // Join
        $this->db->join('user', 'user.id = transaction.user_id', 'LEFT');
        //End Join
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function transaction_detail($id)
    {
        $this->db->select('transaction.*, user.user_name, user.user_phone, user.user_address');
        $this->db->from('transaction');
        // Join
        $this->db->join('user', 'user.id = transaction.user_id', 'LEFT');
        //End Join
        $this->db->where('transaction.id', $id);
        $query = $this->db->get();
        return $query->row();
    }


    //Kirim Data transaction ke database
    public function create($data)
    {
        $this->db->insert('transaction', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    // Last transaction Jika Sukses
    public function last_transaction($id)
    {
        $this->db->select('transaction.*, user.user_name, bank.bank_name, bank.bank_logo, bank.bank_number, bank.bank_account, bank.bank_branch');
        $this->db->from('transaction');
        // Join
        $this->db->join('user', 'user.id = transaction.user_id', 'LEFT');
        $this->db->join('bank', 'bank.id = transaction.bank_id', 'LEFT');
        //End Join
        $this->db->where('transaction.id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    //Update Data
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('transaction', $data);
    }
    //Hapus Data Dari Database
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('transaction', $data);
    }

    // Halaman transaction user
    public function total_row_transaction_user($id)
    {
        $this->db->select('transaction.*, user.user_name');
        $this->db->from('transaction');
        // Join
        $this->db->join('user', 'user.id = transaction.user_id', 'LEFT');
        //End Join
        $this->db->where(['user_id' => $id]);
        $this->db->order_by('transaction.id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    // transaction BY USER
    public function get_transaction_user($limit, $start, $user_id)
    {
        $this->db->select('transaction.*, user.user_name');
        $this->db->from('transaction');
        $this->db->where(['user_id' => $user_id]);
        // Join
        $this->db->join('user', 'user.id = transaction.user_id', 'LEFT');
        //End Join

        $this->db->order_by('transaction.id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    public function transaction_user($user_id)
    {
        $this->db->select('*');
        $this->db->from('transaction');
        $this->db->where(['transaction.user_id' => $user_id, 'transaction_status' => 'Pending']);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result();
    }


    //Cek Detail transaction
    public function cek_transaction($transaction_code, $email)
    {
        $this->db->select('*');
        $this->db->from('transaction');
        $this->db->like('transaction_code', $transaction_code);
        $this->db->like('email', $email);
        // $this->db->where('kode_transaction',$kode_transaction);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->row();
    }
    public function detail_konfirmasi($transaction_code)
    {
        $this->db->select('*');
        $this->db->from('transaction');
        $this->db->where('transaction_code', $transaction_code);
        $query = $this->db->get();
        return $query->row();
    }
}
