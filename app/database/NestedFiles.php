<?php

require "../app/bootstrap.php";

use Illuminate\Database\Capsule\Manager as Capsule;

//Creating database table
if (!Capsule::schema()->hasTable('nested_files')) {
	Capsule::schema()->create('nested_files', function ($table) {

       $table->increments('id');

       $table->string('name');

       $table->integer('lft');

       $table->integer('rht');

       $table->integer('parent');

   });
}

