<?php

/*
	This Class will render the Pages of Folder view
*/
namespace examples\mvc\index;

use TStuff\Php\Logging\ITLogger;
 



class IndexController{

	private $indexRepository;
	private $logger;
	public function __construct(IndexRepository $indexRepo, ITLogger $logger){
		$this->indexRepository = $indexRepo;
		$logger->info("Create Index Controller");
		$this->logger = $logger;
	}



	public function showModuleInformation(){
		$moduleData = $this->indexRepository->getModuleData();
		$this->logger->info("Get ModuleData and show View!");
		include BASE_PATH. "examples/mvc/index/view/index.php";
	}
}