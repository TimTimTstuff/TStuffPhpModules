<?php




namespace examples\mvc\index  ; 

use TestClass\DbIndexModel;
use TStuff\Php\DBMapper\TDBMapper;

class IndexRepository{

	private $database;

	public function __construct(TDBMapper $dbmapper){
		
	}

	public function getModuleData(){

		/*
		$stmt = $this->database->prepare("SELECT modul_name, modul_developers FROM modulInformations");
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_CLASS, "Modul\\Index\\IndexModal");
		$modulInformation = $stmt->fetch();
		*/

		return DbIndexModel::firstOrDefault(" 1 = 1 ");


	}


}