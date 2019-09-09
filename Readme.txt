##For getting the solution of hierarchial file structure:
-> I have used MVC design
->This design inludes Factory design pattern for creating connection to the db(Eloquent).
->The MVC structure is self created and not inhereted from any framework.
->I have used Eloquent(ORM) for mapping database tables to models.
->Using Models in this problem helps in handling the database queries using objects.


##The tree structure mentioned in the problem statemnet
->Written in terms of paths to files in fileStstemStructure.txt inside public folder.
->Tree structure is written in path format to make it independent of technology used to solve this problem.


##Strategy used for inserting nodes/files into the database after reading file is
->The Nested Set Model instead of normal parent-child relationship.
->Reading Ref:http://mikehillyer.com/articles/managing-hierarchical-data-in-mysql/ 


##To run the code
->Run foloowing two commands from the root of the project if vendor folder is not there:
	1.composer update(To download the libraries in the vendor folder)
	2.composer dump-autoload (To generate the autoload file to include the libraries)
->Please make sure that you have created a database with name fs with user root and no password.
->You can change the configuration of the database by vistsing app/bootstrap.php file.
->Please go to following url:localhost/public/home/search
->Where localhost points to the root of the directory
->In the Controllers->Home Controller->search function, when the search page is loaded first time, the db table and file system creation is performed by default.
->we can call this to happen externally as well by visiting the url localhost/public/home/create


