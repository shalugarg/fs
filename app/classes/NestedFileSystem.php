<?php

require_once '../app/models/NestedFiles.php';
use Illuminate\Database\Capsule\Manager as DB;

class NestedFileSystem{
	
	protected $nestedfiles;

	/**
     * Constructor
     *
     */
	public function __construct(){
		$this->nestedfiles = new NestedFiles();
	}

	/**
     * Function for adding a file in the file system
     *
     */
	public function addNode($file, $parentNode, $parentNodeLeft){
		//Node Does not exists
		if(!$fileObj = $this->ifNodeExists($file,$parentNode, $parentNodeLeft)){
			//Always add new nodes to the left hand side
			$newFile = new NestedFiles();
			$newFile->name = $file;
			$newFile->parent = $parentNode;
			$newFile->lft=$parentNodeLeft+1;
			$newFile->rht=$parentNodeLeft+2;
			if ($newFile->save()) {
				$this->reBuild($newFile->id, $newFile->lft, $newFile->rht);
				return $newFile;
			}
		}else{
			return $fileObj;
		}
	}

	/**
     * Function for updating the tree after inserting a new file
     *
     */
	public function reBuild($nodeId, $nodeLft, $nodeRht){
		$this->nestedfiles::where([
			['lft', '>=', $nodeLft],
			['id', '!=', $nodeId]
		])->increment('lft', 2);

		$this->nestedfiles::where('id', '!=', $nodeId)->increment('rht', 2);
	}

	/**
     * Function for checking if file already exist.
     *
     */
	public function ifNodeExists($file, $parentNode){
		$fileObj = $this->nestedfiles::where([
			['name', '=', $file],
			['parent', '=', $parentNode],
		])->first();
		if (empty($fileObj)) {
			return false;
		}else{
			return $fileObj;
		}
	}

	/**
     * Function for creating the file structure
     *
     */
	public function create($filePath){
		 
		if(!empty($filePath)){
			$files=explode("\\",$filePath);
			$parentNode=0;
			$parentNodeLeft=0;
			foreach($files as $file){
				$newNode = $this->addNode($file, $parentNode, $parentNodeLeft);
				$parentNode = $newNode->id;
				$parentNodeLeft = $newNode->lft;
			}


		}
		$files=explode('/',$filePath);
	}

	/**
     * Function for reading the txt file containing the file structure
     *
     */
	public function read(){
		$filepath='../public/FileSystemStructure.txt';
		if(file_exists($filepath)){
			$structure = fopen($filepath,'r') or die('Unable to open file');
			//Clearing the File structure before creating new.
			$this->clear();
			//Reading files until  end-of-file
			while(!feof($structure)){
				$filePath = '';
				$filePath = fgets($structure);
				$this->create($filePath);
			}
		}
	}

	/**
     * Function for truncating the file structure table
     *
     */
	public function clear(){
		$this->nestedfiles->truncate();
	}

	/**
     * Function for search in the file Structure
     *
     * @var bool
     */
	public function search($keyword){
		$files=$this->nestedfiles::select('*')->where('name','like',$keyword.'%')->get();
		$resultPaths=array();
		if(!empty($files)){
			foreach($files as $filenode){
				$pathObject=DB::select ("SELECT parent.name from nested_files as node,nested_files as parent where (node.lft between parent.lft and parent.rht) and node.name ='".$filenode->name."' order by parent.lft");
				if(!empty($pathObject)){
					$resultPaths[] = implode('\\',array_map(function($obj) { return $obj->name; }, $pathObject ));
				}
			}
		}
		return $resultPaths;
	}
}
?>