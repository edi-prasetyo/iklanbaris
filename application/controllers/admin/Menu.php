<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('menu_model');
        $this->load->library('pagination');

        $id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($id);
        if ($user->role_id == 2) {
            redirect('admin/dashboard');
        }
    }
    public function index()
    {

        $list_menu = $this->menu_model->get_menu();
        $data = [
            'title'             => 'Manajemen Menu',
            'list_menu'         => $list_menu,
            'content'           => 'admin/menu/index_menu'

        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    public function create()
    {
        $this->form_validation->set_rules(
            'menu_name',
            'Nama Menu',
            'required',
            [
                'required'      => 'Nama Menu harus di isi',
            ]
        );
        $this->form_validation->set_rules(
            'menu_url',
            'Menu Url',
            'required',
            [
                'required'      => 'Menu Url Harus di isi',
            ]
        );
        $this->form_validation->set_rules(
            'menu_location',
            'Menu Lokasi',
            'required',
            [
                'required'      => 'Menu Lokasi Harus di isi',
            ]
        );
        if ($this->form_validation->run() == false) {
            $data = [
                'title'         => "Create menu",
                'content'       => 'admin/menu/create_menu'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {

            $data = [
                'user_id'               => $this->session->userdata('id'),
                'menu_name'             => $this->input->post('menu_name'),
                'menu_url'              => $this->input->post('menu_url'),
                'menu_location'         => $this->input->post('menu_location'),
                'date_created'          => time()
            ];
            $this->menu_model->create($data);
            $this->session->set_flashdata('message', 'Data telah ditambahkan');
            redirect(base_url('admin/menu'), 'refresh');
        }
    }
    public function update($id)
    {
        $menu = $this->menu_model->detail_menu($id);
        $this->form_validation->set_rules(
            'menu_name',
            'Nama Menu',
            'required',
            [
                'required'      => 'Nama Menu harus di isi',
            ]
        );

        if ($this->form_validation->run() == false) {
            $data = [
                'title'         => "Update menu",
                'menu'          => $menu,
                'content'       => 'admin/menu/update_menu'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {
            $data = [
                'id'                    => $id,
                'user_id'               => $this->session->userdata('id'),
                'menu_name'             => $this->input->post('menu_name'),
                'menu_url'              => $this->input->post('menu_url'),
                'menu_location'         => $this->input->post('menu_location'),
                'date_updated'          => time()
            ];
            $this->menu_model->update($data);
            $this->session->set_flashdata('message', 'Data telah di ubah');
            redirect(base_url('admin/menu'), 'refresh');
        }
    }
    public function delete($id)
    {
        is_login();
        $menu = $this->menu_model->detail_menu($id);

        $data = array('id'   => $menu->id);
        $this->menu_model->delete($data);
        $this->session->set_flashdata('message', 'Data telah di Hapus');
        redirect(base_url('admin/menu'), 'refresh');
    }
}
