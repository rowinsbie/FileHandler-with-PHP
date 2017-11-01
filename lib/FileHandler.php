<?php
include "traits/Error.php";
class FileHandler
{

	use Error;

	public $file = [];
	public $isAllowed = true;


	public function selectFile($file)
	{
		$this->file['filename'] = $_FILES[$file];
	}


	public function get_file($key)
	{
		return $this->file['filename'][$key];
	}

	public function set_allowed_ext(array $extensions)
	{
		$this->file['extensions'] = $extensions;
	}




	public function get_allowed_ext()
	{
		return $this->file['extensions'];
	}

	public function get_file_ext()
	{
		return pathinfo($this->file['filename']['name'],PATHINFO_EXTENSION);
	}

	public function Validate_extension()
	{
		if(!in_array($this->get_file_ext(), $this->get_allowed_ext()))
		{
			$this->set_error("file_err",$this->file['filename']['name'] . " file extension is not allowed");
			$this->isAllowed = false;
			return false;
		}
		
		return true;
	}

	public function isFileAllowed()
	{
		if(!$this->isAllowed)
		{
			return false;
		}
		return true;
	}

	public function setDirectory($dir)
	{
		$this->file['dir'] = $dir;
	}

	public function getDirectory()
	{
		return $this->file['dir'];
	}



	public function RenameFile()
	{
		$this->file['filename']['name'] =  sha1(uniqid(rand(date('Y'),100000))).".".$this->get_file_ext();
	}



	public function Upload()
	{
		$this->RenameFile();
		if(!move_uploaded_file($this->get_file("tmp_name"), $this->getDirectory().$this->get_file("name")))
		{
			$this->set_error("file_err","Upload operation is failed....");
			return false;
		}
		return true;
	}



}