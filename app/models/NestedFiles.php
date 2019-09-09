<?php

use Illuminate\Database\Eloquent\Model;

class NestedFiles extends Model{

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'nested_files';

	/**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'lft', 'rht', 'parent'];
	
}

?>