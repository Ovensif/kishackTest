<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaction extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Nasabah_model', 'nasabah');
        $this->load->model('Transaction_model', 'transaction');
    }

    public function index()
    {

        $data['css_files'] = [
            base_url() . "assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css",
            base_url() . "assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css"
        ];
        $data['js_files'] = [
            base_url() . "assets/plugins/datatables/jquery.dataTables.min.js",
            base_url() . "assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js",
            base_url() . "assets/plugins/moment/moment.min.js",
            base_url() . "assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js",
            base_url() . "assets/js/customJS/transaction.js",
        ];

        load_template('Menu/transaction.php', $data);
    }

    public function register()
    {
        $name = $this->input->post('name', TRUE);
        $description = $this->input->post('description', TRUE);
        $amount = $this->input->post('amount', TRUE);
        $credit_status = $this->input->post('credit_status', TRUE);
        $transaction_date = $this->input->post('transaction_date', TRUE);
        $point = 0;
        $update_point = false;

        // Check if Any special charactrer input, except space!
        $check  = preg_match('/[#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/', $name);

        if ($check >= 1 || $check === FALSE) :
            $this->session->set_flashdata('alert', 'Tidak boleh ada special character pada nama anda!');
            redirect(base_url('Transaction'));
        endif;

        // Check Nama Nasabah ada atau tidak!
        $get_nasabah = (array)$this->nasabah->get_data([
            "select"    => ["name", "id", "point"],
            "where"     => ["name" => $name],
            "single"     => true
        ]);

        if (empty($get_nasabah)) :
            $this->session->set_flashdata('alert', "Nasabah {$name}, Tidak di temukan!");
            redirect(base_url('Transaction'));
        endif;

        // Check if Amount only contain Number
        $check_amount = preg_match('/^[0-9]+$/', $amount);

        if ($check_amount == 0 || $check === FALSE) :
            $this->session->set_flashdata('alert', 'Amount hanya boleh di isi dengan angka!');
            redirect(base_url('Transaction'));
        endif;

        // Check credit status
        if (!in_array($credit_status, ['C', 'D'])) :
            $this->session->set_flashdata('alert', 'Type Credit Status tidak di temukan!');
            redirect(base_url('Transaction'));
        endif;

        // Set if description is 'Bayar Pulsa' or 'Bayar Listrik', then it will get a point
        if ($description == 'bayar_listrik' || $description == 'beli_pulsa') :
            $point = $this->point_accumulation($amount, $description);
            $update_point = true;
        endif;

        // Write data Transaction
        $data_transaction = [
            'id_nasabah' => $get_nasabah['id'],
            'amount' => $amount,
            'description' => $description,
            'type' => $credit_status,
            'transaction_ticket' => $transaction_ticket = $credit_status . date("YmdHis") . $get_nasabah['id'],
            'transaction_date' => date("Y-m-d", strtotime($transaction_date))
        ];

        $register_transaction = $this->transaction->write($data_transaction);

        if ($register_transaction > 0) :

            // If updated point is true!
            if ($update_point) :
                $point_update = $this->transaction->update(['id' => $get_nasabah['id']], ['point' => $point + (int)$get_nasabah['point']]);
            endif;

            $this->session->set_flashdata('success', 'Sukses memasukan data transaksi!');
            redirect(base_url('Transaction'));
        else :
            $this->session->set_flashdata('alert', 'Tidak bisa memasukan data transaksi!');
            redirect(base_url('Transaction'));
        endif;
    }

    public function point_accumulation($amount, $description)
    {
        $type_purchase = (stripos($description, 'pulsa') !== FALSE) ? 'pulsa' : 'listrik';

        switch ($type_purchase):
            case 'pulsa':

                // Set Rule
                if($amount >= 10001):

                elseif($amount >= 30001):

                else :
                    return 0;
                endif;


                break;

            case 'listrik' :
            default:

                break;
        endswitch;
    }
}
