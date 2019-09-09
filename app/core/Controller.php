<?php
class Controller{


	/**
     * Function for loading models.
     *
     */
	public function model($model){
		if(file_exists('../models/'.$model.'.php')){
			require_once '../models/'.$model.'.php';
			return new $model;
		}
	}

	/**
     * Function for loading view.
     *
     */
	public function view($view, $data = []){
		if (file_exists('../app/view/'.$view.'.php')) {
			require_once '../app/view/'.$view.'.php';
		}
	}
}
?>