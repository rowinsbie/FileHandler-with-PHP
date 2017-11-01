<?php
trait Error
{

	private $errors = array();


	public function set_error($key,$value)
	{
		$this->errors[$key] = $value;
	}

	public function get_error($key)
	{
		if(isset($this->errors[$key]))
		{
			return $this->errors[$key];
		}
	}

	public function scan_errors()
	{
		if(!empty($this->errors))
		{
			return false;
		}
		return true;
	}



}