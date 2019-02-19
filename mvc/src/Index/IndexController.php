<?php

/*
	This Class will render the Pages of Folder view
*/

namespace Modul\Index;

class IndexController{

	private $indexRepository;

	public function __construct(IndexRepository $indexRepository){
		$this->indexRepository = $indexRepository;
	}



	public function showModulInformations(){
		$modulData = $this->indexRepository->getModulData();

		include __DIR__ . "/../../view/index.php";
	}
}