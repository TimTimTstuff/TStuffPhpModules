<?php

/*
	 In this Repository are function which will fetching Data of the Database and put this to the class indexModal
*/

namespace Modul\Index;

use PDO;

class IndexRepository{

	private $database;

	public function __construct(PDO $database){
		$this->database = $database;
	}

	public function getModulData(){

		$stmt = $this->database->prepare("SELECT modul_name, modul_developers FROM modulInformations");
		$stmt->execute();

		$stmt->setFetchMode(PDO::FETCH_CLASS, "Modul\\Index\\IndexModal");
		$modulInformation = $stmt->fetch();

		return $modulInformation;

	}


}