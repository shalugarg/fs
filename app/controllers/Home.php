<?php

class Home extends Controller{

	/**
     * Index function
     *
     */
	public function index(){
	}

	/**
     * Function for searching file in file system
     *
     */
	public function search(){
		if(!empty($_POST)){
			require_once '../app/classes/NestedFileSystem.php';
			$nestedFileSystem = new NestedFileSystem();
			$resultPaths = $nestedFileSystem->search($_POST['search']);

			$this->view('home/search',['resultPaths'=> $resultPaths]);
		}	
		//For reading data from file structure text file and inserting into db 
		$this->create();
		$this->view('home/search');
	}

	/**
     * Function for creating database tabel and inserting adata into it
     *
     */
	public function create(){
		//Creating database table if not exists
		require_once '../app/database/NestedFiles.php';
		//For reading data from file structure text file and inserting into db 
		require_once '../app/classes/NestedFileSystem.php';
		$nestedFileSystem = new NestedFileSystem();
		$nestedFileSystem->read();
	}

}
?>