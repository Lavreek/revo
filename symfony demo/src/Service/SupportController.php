<?php
	namespace App\Service;

	class Support
	{
    	const CHARSET = "utf8";

		private $log = __DIR__."/support.log";
    	private $filesample = ["host" => "host", "user" => "user", "password" => "password", "dbname" => "dbname", "port" => "3306"];

		function __construct() { }

		protected function db_connection(string $filepath)
		{
			$file = json_decode(file_get_contents($filepath));

			$link = new \mysqli($file->host,$file->user,$file->password,$file->dbname, $file->port);

	        $this->append_log_file("connect to db by: $filepath");

			return $link;
		}

		protected function set_settings(string $filepath, array $request)
    	{
	        $this->get_file_status($filepath);

	        foreach ($request as $key => $value)
	        {
	        	if (isset($this->filesample[$key]))
	            	$this->filesample[$key] = $value;
			}

	        $this->append_log_file("update settings: $filepath");

	        return file_put_contents($filepath, json_encode($this->filesample));
	    }

	    /**
	     *  Получение данных о подключении. 
	     */
	    protected function get_file_connection(string $filepath)
	    {        
	        if ($this->get_file_status($filepath))
	            return json_decode(file_get_contents($filepath));
	        else
	            return;
	    }

		 /**
	     *  Создание образца.
	     */
	    private function get_file_status($filepath)
	    {
	        if (!file_exists($filepath))
	            touch($filepath);
	        else
	            return true;

	        file_put_contents($filepath, json_encode($this->filesample));
	        $this->append_log_file("create file: $filepath");
	    }

	    protected function append_log_file(string $message)
	    {
	    	$filepath = $this->log;

	        if (!file_exists($filepath))
	            touch($filepath);

	        file_put_contents($filepath, date("d/m/y H:i:s")." ".$message."\n", FILE_APPEND);
	    }
	}