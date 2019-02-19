<?php

/* This class will loadingg the needed Dependencies over the Constructor */

namespace Modul\Core;

use Modul\Index\IndexController;
use Modul\Index\IndexRepository;
use PDO;

class Container{

	private $instandcedInstances = array();
	private $buildConstructions = array();

	public function __construct(){

		$this->buildConstructions = [
			"indexController" => function(){
				return new IndexController( $this->create("indexRepository") );
			},
			"indexRepository" => function(){
				return new IndexRepository( $this->create("pdo") );
			},
			"pdo" => function(){
				$pdo = new PDO("mysql:host=localhost;
								dbname=modules;
								charset=utf8",
								"root",
								""
							);

				$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

				return $pdo;
			}

		];

	}

	/* This function is the main Function of this Class. */

	public function create($name){

		if(isset($this->instandcedInstances[$name])){
			return $instandcedInstances[$name];
		}

		if(isset($this->buildConstructions[$name])){
			$this->instandcedInstances[$name] = $this->buildConstructions[$name]();
		}

		return $this->instandcedInstances[$name];


	}

}