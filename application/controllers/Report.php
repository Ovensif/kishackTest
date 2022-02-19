<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
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
            base_url() . "assets/js/customJS/report.js",
        ];

        load_template('Menu/report.php', $data);
    }

    public function list_data()
    {
        // Post Variable
        $start_date = $this->input->post('start_date', TRUE);
        $end_date = $this->input->post('end_date', TRUE);
        $account_id = $this->input->post('account_id', TRUE);

        // Const Variable
        $table_name = "tb_transaction";

        $select     = array("transaction_date", "description", "type", "amount");
        $order_col  = array("transaction_date", "description", "type", "amount");
        $search_col = array();
        $group_by   = array();
        $order      = array("transaction_date" => "DESC");
        $join       = array();
        $left_join  = array();
        $where      = array(
            "transaction_date >=" => date("Y-m-d", strtotime($start_date)),
            "transaction_date <=" => date("Y-m-d",strtotime($end_date)),
            "id_nasabah" => $account_id
        );
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
            $debit            = '-';
            $credit           = '-';

            // Decide Type
            if($list->type == 'C'):
                $credit = $list->amount;
            else:
                $debit = $list->amount;
            endif;
            
            // Print data!
            $row[] = $list->transaction_date;
            $row[] = strtoupper(str_replace("_", " ", $list->description));
            $row[] = "Rp. ".$credit;
            $row[] = "Rp. ".$debit;
            $row[] = $list->amount;

            $data[] = $row;
        endforeach;

        echo json_encode(array(
            "draw"              => $_POST['draw'],
            "recordsTotal"      => $this->datatable_model->dt_all($optionsAll),
            "recordsFiltered"   => $this->datatable_model->dt_filtered($options),
            "data"              => $data
        ));
    }
}
