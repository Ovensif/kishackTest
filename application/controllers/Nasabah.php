<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nasabah extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Nasabah_model', 'nasabah');
    }

    public function index()
    {

        $data['css_files'] = [
        ];
        $data['js_files'] = [];

        load_template('Menu/nasabah.php', $data);
    }

    public function register()
    {
        $name = $this->input->post('name', TRUE);

        // Check if Any special charactrer input, except space!
        $check  = preg_match('/[#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/', $name);

        if ($check >= 1) :
            $this->session->set_flashdata('alert', 'Tidak boleh ada special character pada nama anda!');
            redirect(base_url('Nasabah'));
        endif;

        // Insert into database
        $insert_nasabah = $this->nasabah->write(['name' => $name]);

        if($insert_nasabah > 0):
            $this->session->set_flashdata('success', "Nasabah : {$name} Berhasil di Tambahkan!");
            redirect(base_url('Nasabah'));
        else :
            $this->session->set_flashdata('alert', "Gagal menambahkan Nasabah : {$name}");
            redirect(base_url('Nasabah'));
        endif;
    }
}
