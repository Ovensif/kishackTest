<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
	Copyright to Mbahcoding.com
	Source : http://mbahcoding.com/php/codeigniter/codeigniter-ajax-crud-using-bootstrap-modals-and-datatable.html
*/

class Datatable_model extends CI_Model {

	private function dt_query($options){
		$i = 0;

		if( ! empty($options['table_name']) ):
			$this->db->from($options['table_name']);
		endif;

		if( ! empty($options['select']) ):
			$this->db->select($options['select']);
		endif;

		// if ( ! empty($options['order']) ){
		// 	$this->db->order_by($options['order']['key'], $options['order']['sort']);
		// }
		
		if( ! empty($options['where']) ):
			$this->db->where($options['where']);
		endif;

		if( ! empty($options['or_where']) ):
			$this->db->or_where($options['or_where']['field'], $options['or_where']['value']);
		endif;

		if( ! empty($options['where_in']) ):
			if (is_array($options['where_in']) && !empty($options['where_in'][0])) {
                foreach ($options['where_in'] as $value) :
                    $this->db->where_in($value['field'], $value['value']);
                endforeach;
            }
            else{
                $this->db->where_in($options['where_in']['field'], $options['where_in']['value']);
            }
		endif;

		if( ! empty($options['or_where_in']) ):
			$this->db->or_where_in($options['or_where_in']['field'], $options['or_where_in']['value']);	
		endif;

		if( ! empty($options['where_not_in']) ):
			$this->db->where_not_in($options['where_not_in']['field'], $options['where_not_in']['value']);
		endif;

		if( ! empty($options['or_where_not_in']) ):
			$this->db->or_where_not_in($options['or_where_not_in']['field'], $options['or_where_not_in']['value']);
		endif;

		if ( ! empty($options['like']) ):
			$this->db->like($options['like']);
		endif;

		if ( ! empty($options['or_like'])) :
			$this->db->or_like($options['or_like']['field'], $options['or_like']['value']);
        endif;

		if( ! empty($options['join']) ):
			foreach ($options['join'] as $key => $value):
				$this->db->join($key, $value);
			endforeach;
		endif;

		if(!empty($options['left_join'])){
            foreach($options['left_join'] as $key => $value){
                $this->db->join($key, $value, 'left');
            }
		}
		if( ! empty($options['group_by']) ):
            $this->db->group_by( $options['group_by'] );
        endif;

		foreach ($options['search'] as $item) :
			if($_POST['search']['value']):
				if($i===0):
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				else:
					$this->db->or_like($item, $_POST['search']['value']);
				endif;

				if(count($options['search']) - 1 == $i) :
					$this->db->group_end();
				endif;
			endif;

			$i++;
		endforeach;

		if(isset($_POST['order'])):
			$this->db->order_by($options['order_col'][$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		elseif( ! empty($options['order']) ):
			$order = $options['order'];
			foreach($order AS $key => $value):
				$this->db->order_by($key, $value);
			endforeach;
		endif;
	}

	public function dt_get($options){
		$this->dt_query($options);

		if($_POST['length'] != -1):
			$this->db->limit($_POST['length'], $_POST['start']);
		endif;

		$query = $this->db->get();

		return $query->result();
	}

	public function dt_filtered($options){
		$this->dt_query($options);

		$query = $this->db->get();
		return $query->num_rows();
	}

	public function dt_all($options){

		if( ! empty($options['table_name']) ):
			$this->db->from($options['table_name']);
		endif;

		if( ! empty($options['select']) ):
			$this->db->select($options['select']);
		endif;

		if( ! empty($options['where']) ):
			$this->db->where($options['where']);
		endif;

		if( ! empty($options['where_in']) ):
			$this->db->where_in($options['where_in']['field'], $options['where_in']['value']);
		endif;

		if ( ! empty($options['like']) ):
			$this->db->like($options['like']);
		endif;

		if(!empty($options['left_join'])){
            foreach($options['left_join'] as $key => $value){
                $this->db->join($key, $value, 'left');
            }
		}

		if( ! empty($options['join']) ):
			foreach ($options['join'] as $key => $value):
				$this->db->join($key, $value);
			endforeach;
		endif;


		return $this->db->count_all_results();
	}

}

/* End of file Datatable_model.php */
/* Location: ./application/models/Datatable_model.php */