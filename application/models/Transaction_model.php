<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Transaction_model extends CI_Model
{

	private $_table = 'tb_transaction';

	/**
	 * Get data from database with filter
	 *
	 * @param   array  $options
	 * @return  object
	 */
	public function get_data($options = array())
	{

		if (!empty($options['select'])) {
			$this->db->select($options['select']);
		}

		if (!empty($options['select_sum'])) {
			$this->db->select_sum($options['select_sum']);
		}

		if (!empty($options['select_min'])) {
			$this->db->select_min($options['select_min']);
		}

		if (!empty($options['select_max'])) {
			$this->db->select_max($options['select_max']);
		}

		if (!empty($options['select_avg'])) {
			$this->db->select_avg($options['select_avg']);
		}

		if (!empty($options['where'])) {
			$this->db->where($options['where']);
		}

		if (!empty($options['or_where'])) {
			$this->db->or_where($options['or_where']);

			if (!empty($options['or_and'])) {
				$this->db->where($options['or_and']);
			}

			if (!empty($options['or_case'])) {
				$this->db->where($options['or_case'], null, false);
			}
		}

		if (!empty($options['where_in'])) :
			$this->db->where_in($options['where_in']['field'], $options['where_in']['value']);
		endif;

		if (!empty($options['or_where_in'])) :
			$this->db->or_where_in($options['or_where_in']['field'], $options['or_where_in']['value']);
		endif;

		if (!empty($options['where_not_in'])) :
			$this->db->where_not_in($options['where_not_in']['field'], $options['where_not_in']['value']);
		endif;

		if (!empty($options['or_where_not_in'])) :
			$this->db->or_where_not_in($options['or_where_not_in']['field'], $options['or_where_not_in']['value']);
		endif;

		if (!empty($options['like'])) {
			$this->db->like($options['like']);
		}

		if (!empty($options['or_like'])) {
			$this->db->or_like($options['or_like']);
		}

		if (!empty($options['order'])) {
			$this->db->order_by($options['order']['key'], $options['order']['sort']);
		}

		if (!empty($options['join'])) {
			foreach ($options['join'] as $key => $value) {
				$this->db->join($key, $value);
			}
		}

		if (!empty($options['left_join'])) {
			foreach ($options['left_join'] as $key => $value) {
				$this->db->join($key, $value, 'left');
			}
		}
		if (!empty($options['right_join'])) {
			foreach ($options['right_join'] as $key => $value) {
				$this->db->join($key, $value, 'right');
			}
		}

		if (!empty($options['limit'])) {
			if (!empty($options['offset'])) {
				$this->db->limit($options['limit'], $options['offset']);
			} else {
				$this->db->limit($options['limit']);
			}
		}

		if (!empty($options['from'])) {
			$this->db->from($options['from']);
		}

		if (!empty($options['group_by'])) :
			$this->db->group_by($options['group_by']);
		endif;

		$data = $this->read();

		if (!empty($options['count'])) {
			return $data->num_rows();
		} elseif (!empty($options['single'])) {
			return $data->row();
		} elseif (!empty($options['array'])) {
			return $data->result_array();
		} else {
			return $data->result();
		}
	}


	/**
	 * Insert data into database
	 *
	 * @param   array  $params
	 * @return  bool
	 */
	public function write($params)
	{
		$this->db->insert($this->_table, $params);

		if ($this->db->affected_rows() == 1) {
			return $this->db->insert_id();
		}

		return FALSE;
	}

	/**
	 * Insert batch data into database
	 *
	 * @param   array  $params
	 * @return  bool
	 */
	public function batch_write($params)
	{
		$this->db->insert_batch($this->_table, $params);

		if ($this->db->affected_rows() > 0) {
			return $this->db->insert_id();
		}

		return FALSE;
	}

	/**
	 * Get data from database
	 *
	 * @return  object
	 */
	public function read()
	{
		$result = $this->db->get($this->_table);

		return $result;
	}


	/**
	 * Update data into database
	 *
	 * @param   array  $params
	 * @return  int
	 */
	public function update($update_params, $data)
	{
		if (empty($update_params)) return false;

		$this->db->update($this->_table, $data, $update_params);

		return $this->db->affected_rows() > 0;
	}

	/**
	 * Batch update data into database
	 *
	 * @param   array  $params
	 * @return  int
	 */
	public function batch_update($params, $where)
	{
		$this->db->update_batch($this->_table, $params, $where);

		return $this->db->affected_rows() > 0;
	}


	/**
	 * Delete data from database
	 *
	 * @param   array  $params
	 * @return  int
	 */
	public function delete($params)
	{
		$this->db->delete($this->_table, $params);

		return $this->db->affected_rows() > 0;
	}
}

/* End of file Reset_model.php */
/* Location: ./application/models/Reset_model.php */