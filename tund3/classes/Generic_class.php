<?php
	class Generic{
		//muutujad, klassis omadused (properties)
		private $mysecret;
		public $yoursecret;
		
		function __construct(){
			$this->mysecret = mt_rand(0, 100);
			$this->yoursecret = mt_rand(0, 100);
			echo "loositud arvude korrutis on: " .$this->mysecret * $this->yoursecret;
			$this->tellsecret();
		}//construct lõppeb
		
		//funktsioonid, klassis meetodid (methods)
		private function tellsecret(){
			echo " näidisklass on mõttetu!"; 
		}//method lõppeb
		
		public function showValue(){
			echo " salajane arv on: " .$this->mysecret;
		}
		
	} //class lõppeb