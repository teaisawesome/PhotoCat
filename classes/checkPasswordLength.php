<?php
	class CheckPassword
	{
		protected $pwd;

		function __construct($pwd)
		{
			$this->pwd = $pwd;
		}
		function checkLength()
		{
			if(strlen($this->pwd) < 5)
			{
				//kisebb, mint 5 karakter
				return false;
			}
			else
			{
				//nagyobb vagy egyenlo, mint 5 karakter
				return true;
			}
		}
	}
?>