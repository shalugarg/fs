<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
  font-family: Arial;
}

* {
  box-sizing: border-box;
}

form.example input[type=text] {
  padding: 10px;
  font-size: 17px;
  border: 1px solid grey;
  float: left;
  width: 80%;
  background: #f1f1f1;
}

form.example button {
  float: left;
  width: 20%;
  padding: 10px;
  background: #2196F3;
  color: white;
  font-size: 17px;
  border: 1px solid grey;
  border-left: none;
  cursor: pointer;
}

form.example button:hover {
  background: #0b7dda;
}

form.example::after {
  content: "";
  clear: both;
  display: table;
}
</style>
</head>
<body>

<h2>Search File System</h2>

<form class="example" action="/public/home/search" method="post">
  <input type="text" required placeholder="Search.." name="search">
  <button type="submit"><i class="fa fa-search"></i></button>
</form>

<?php if (!empty($_POST)) { 
		if(!empty($data['resultPaths'])){
		?><br/><br/><h3>Search Results:</h3><?php
			foreach($data['resultPaths'] as $path){
				?><h4><?php echo $path; ?></h4><?php
			}
			echo '<br/>';
	}else{
		?><h4>No Results Found.</h4><?php
	}
}
?>

</body>
</html> 
