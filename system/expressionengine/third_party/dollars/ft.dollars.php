<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * A really simple fieldtype for humans to use formatted dollar amounts while EE stores plain integers
 *
 * @author    Matt Stein <matt@workingconcept.com>
 * @copyright Copyright (c) 2012 Working Concept Inc
 */

class Dollars_ft extends EE_Fieldtype
{
	
	var $info = array(
		'name'		=> 'Dollars',
		'version'	=> '1.0.1',
		'author'	=> 'Matt Stein'
	);
	

	function Dollars_ft()
	{
		parent::EE_Fieldtype();
		$this->EE->lang->loadfile('dollars');
	}
	
	
	function display_field($data)
	{
		return form_input(array(
			'name'	=> $this->field_name,
			'id'	=> $this->field_id,
			'value'	=> ( ! empty($data) AND is_numeric($data)) ? '$'.number_format(intval($data), 2) : ''
		));
	}


	function display_cell($data)
	{
		return form_input(array(
			'name'	=> $this->cell_name,
			'id'	=> $this->col_id,
			'class' => 'matrix-textarea',
			'value'	=> ( ! empty($data) AND is_numeric($data)) ? '$'.number_format(intval($data), 2) : ''
		));
	}

	
	function install()
	{
		// defaults
		return array(
			'dollars' => ''
		);
	}
	
	function validate($data)
	{
		if ( ! empty($data)) 
		{
			if ( ! is_numeric($this->_strip_format($data)))
			{
				return $this->EE->lang->line('error_message');
			}
			else
			{
				return TRUE;
			}
		} 
		else 
		{
			return TRUE;
		}
	}


	function validate_cell($data)
	{
		return $this->validate($data);
	}


	function settings_modify_column($data)
	{
		$fields['field_id_'.$data['field_id']]['type']    = 'INT';
		$fields['field_id_'.$data['field_id']]['default'] = 0;
		
		return $fields;
	}
	

	function save($data)
	{
		return $this->_strip_format($data);
	}


	function save_cell($data)
	{
		return $this->_strip_format($data);
	}


	/**
	 * strip out dollar signs and commas, essentially making this an int
	 * 
	 * @param  string $formatted_dollar_amount formatted dollar amount ("$10", "312.59", "$5,342")
	 * 
	 * @return string input stripped of dollar signs and commas
	 */
	
	function _strip_format($formatted_dollar_amount)
	{
		// TODO: handle standard abbreviations like "1.5M" or "300K"
 
		return preg_replace('/[\$,]/', '', $formatted_dollar_amount);
	}
}

// END Dollars_ft class

/* End of file ft.dollars.php */
/* Location: ./system/expressionengine/third_party/dollars/ft.dollars.php */