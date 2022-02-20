<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaction extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Nasabah_model', 'nasabah');
        $this->load->model('Transaction_model', 'transaction');
        $this->load->model('Datatable_model', "datatable_model");
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
            'transaction_date' => date("Y-m-d", strtotime($transaction_date)),
            'point' => $point
        ];

        $register_transaction = $this->transaction->write($data_transaction);

        if ($register_transaction > 0) :

            // If updated point is true!
            if ($update_point) :
                $point_update = $this->nasabah->update(['id' => $get_nasabah['id']], ['point' => $point + (int)$get_nasabah['point']]);
            endif;

            $this->session->set_flashdata('success', 'Sukses memasukan data transaksi!');
            redirect(base_url('Transaction'));
        else :
            $this->session->set_flashdata('alert', 'Tidak bisa memasukan data transaksi!');
            redirect(base_url('Transaction'));
        endif;
    }

    public function list_data()
    {
        // Const Variable
        $table_name = "tb_transaction";

        $select     = array("id_nasabah", "tb_nasabah.name", "transaction_date", "description", "type", "amount", "tb_transaction.point");
        $order_col  = array(null, "id_nasabah", "tb_nasabah.name", "tb_transaction", "point");
        $search_col = array();
        $group_by   = array();
        $order      = array("id_transaction" => "DESC");
        $join       = array(
            "tb_nasabah" => "tb_transaction.id_nasabah = tb_nasabah.id"
        );
        $left_join  = array();
        $where      = array();
        $where_in   = array();

        $optionsAll = array(
            "table_name" => $table_name,
            "select"     => $select,
            "join"       => $join,
            "left_join"  => $left_join,
            "order"      => $order,
            "like"       => !empty($like) ? $like : array(),
            "group_by"   => $group_by,
        );

        $options    = array_merge($optionsAll, array(
            "order_col" => $order_col,
            "search"    => $search_col,
            "where"     => $where,
            "where_in"  => $where_in
        ));

        $listdata   = $this->datatable_model->dt_get($options);
        $data       = array();
        $no         = $_POST['start'];

        // Loop data
        foreach ($listdata as $list) :
            $no++;
            $row              = array();

            // Print data!
            $row[] = $list->id_nasabah;
            $row[] = $list->name;
            $row[] = $list->point;

            $data[] = $row;
        endforeach;

        echo json_encode(array(
            "draw"              => $_POST['draw'],
            "recordsTotal"      => $this->datatable_model->dt_all($optionsAll),
            "recordsFiltered"   => $this->datatable_model->dt_filtered($options),
            "data"              => $data
        ));
    }


    public function point_accumulation($amount, $description)
    {
        $type_purchase = (stripos($description, 'pulsa') !== FALSE) ? 'pulsa' : 'listrik';
        $current_point = 0;
        $first_diffrence = 0;
        $first_bonus_point = 0;
        $second_diffrence = 0;
        $second_bonus_point = 0;

        switch ($type_purchase):
            case 'pulsa':

                if ($amount <= 10000) return $current_point;

                // Check if amounth get second point!
                $second_diffrence = $amount - 30000;
                if ($second_diffrence > 0) :
                    $second_bonus_point = ($second_diffrence / 1000) * 2;
                endif;

                // Check if amounth get first point!
                $first_diffrence = ($second_diffrence > 0) ? ($amount - 10000) - $second_diffrence : $amount - 10000;
                if ($first_diffrence > 0) :
                    $first_bonus_point = ($first_diffrence / 1000) * 1;
                endif;

                // Update current_point
                $current_point = $first_bonus_point + $second_bonus_point;
                return $current_point;
                break;

            case 'listrik':
                if ($amount <= 10000) return $current_point;

                // Check if amounth get second point!
                $second_diffrence = $amount - 100000;
                if ($second_diffrence > 0) :
                    $second_bonus_point = ($second_diffrence / 2000) * 2;
                endif;

                // Check if amounth get first point!
                $first_diffrence = ($second_diffrence > 0) ? ($amount - 50000) - $second_diffrence : $amount - 50000;
                if ($first_diffrence > 0) :
                    $first_bonus_point = ($first_diffrence / 2000) * 1;
                endif;

                // Update current_point
                $current_point = $first_bonus_point + $second_bonus_point;
                return $current_point;
                break;

            default:
                return $current_point;
                break;
        endswitch;
    }
}
