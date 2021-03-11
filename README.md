# MySQL to SleekDB Export
### Attention my dear friend
This tool is a first version, I will surely give it more love in the next versions. But don't panic, this tool does what it says.

This is the first export tool for SleekDB, an excellent [rakibtg/SleekDB](https://github.com/rakibtg/SleekDB) project, a project that I have taken up with love.

This tool was born with my need to want to export different MySQL databases and test the performance of SleekDB with a large volume of information, which turned out to be perfect... both products, of course.

That is why I decided to share the experiment for those who require it.
Soon it will have a GUI, for now it is only handled as a timely tool that you can integrate your way! 


## How do I get it? 
This is easy. We are going to use Composer to be able to download MySQL to SleekDB and SleekDB with the following command:

```
composer require gusgeek/mysqltosleekdb
```

As I said earlier, this will download a copy of the latest MySQL to SleekDB and SleekDB tools. You can immediately invoke both of them using the following Script. 

```
<?php
  include('./vendor/autoload.php'); 
?>
```

##  How do I make it work?
This is easy. It is based on four functions, of which 3 work independently and 1 will do all the work.

#### MYSQLITables
You will get the tables from the database that you have indicated in Array format
#### MYSQLIContent
You will get the data from the indicated table in Array format
#### SleekDBImport
You can enter the data to SleekDB according to the Database and Table indicated
#### MySQLtoSleekDB
By indicating the Database and the path where SleekDB will save the data, this tool will export the MySQL database completely automatically. 


### Practical Example N ° 1
You could consult with the MYSQLITables function the Table (s) you want to export and with MYSQLIContent filter the content that you want to give to SleekDB with SleekDBImport.

```
<?php

  include('./vendor/autoload.php'); 
  
  $db = 'metronica_dbc_wrcganc'; // Here enter the Database Name
  $user = 'root'; // MySQL username
  $pass = '';  // MySQL password
  $server = 'localhost'; // Server where is MySQL
  $route = "./data/".$db; // Path on Disk to save the copy exported to SleekDB (In this case we indicate a folder and the name of the Original Database) 

  $getTables = MYtoSL\Importer::MYSQLITables($server, $user, $pass, $db);
  $getContent = MYtoSL\Importer::MYSQLIContent($server, $user, $pass, $db, $getTables[0]);
  $postContent = MYtoSL\Importer::SleekDBImport($route, $getContent[0], $getTables[0]);

?>
```

In this case, we are selecting the first table of the query, and exporting the first content of the table queried to SleekDB. Additionally with a For Loop you could go through both making the import to SleekDB. 


### Practical Example N ° 2
You can bring a complete MySQL database to SleekDB with a single function, Indicating the basic data as follows.

```
<?php

  include('./vendor/autoload.php'); 
  
  $db = 'metronica_dbc_wrcganc'; // Here enter the Database Name
  $user = 'root'; // MySQL username
  $pass = '';  // MySQL password
  $server = 'localhost'; // Server where is MySQL
  $route = "./data/".$db; // Path on Disk to save the copy exported to SleekDB (In this case we indicate a folder and the name of the Original Database) 

  $return = MYtoSL\Importer::MySQLtoSleekDB($server, $user, $pass, $db, $route); 
  
?>
```

This way you will export all the data from a single enter! 

## What do I do after exporting my database?
For SleekDB to take the data that I export correctly, it is important that ***respect the directory branching that will be made***, if you want your project to respect the order of the tables in MySQL, SleekDB will organize the content with that order, for this reason it is important that when you want to request data from SleekDB INDICATE THE CORRECT STORE ***(Store = Table)***, and that the Database directory BE WHERE I LOCATE THE EXPORTED FOLDERS 


For more help on how SleekDB works visit the documentation: https://sleekdb.github.io/ It has many functions that will help you organize your data in a very concrete way!

# CRUD Manager
The data handlers provided by SleekDB will be the ones that you can use with CRUD Manager. It is not in our interest to replace those functions. Below, we leave some examples of Reading and Writing data. 

Check out this `$activity->Manager()` is the Crud Manager in this example. `findAll()` is the SleekDB handler. 
`FormatData(array)`, is a CRUD handler that will format the array into a two-part element. Count that will provide the amount of data that is in Data. 

```
<?php 

require_once('./vendor/autoload.php');
$activity = new CRUD\Activity('products', './data/');

    # Show all Entry's

      $return1 = $activity->Manager()->findAll();

    # Insert data in DB

      $data = array(
        'category' => 5, 
        'brand' => 'Saps', 
        'color' => 'Green' 
      );

      $return1 = $activity->Manager()->insert($data);



      $return2 = $activity->FormatData($return1);

    echo "<pre>";
      print_r($return2);
    echo "</pre>";
    
?>   
```
<br><br>
<p align="center">
    <img src="https://img.shields.io/github/downloads/gusgeek/MySQLtoSleekDB/total">  
    <img src="https://img.shields.io/github/v/release/gusgeek/MySQLtoSleekDB">  
    <img src="https://img.shields.io/github/release-date/gusgeek/MySQLtoSleekDB">  
    <img src="https://img.shields.io/github/languages/code-size/gusgeek/MySQLtoSleekDB">
  <br><br>
  <strong>:pencil2: con :heart:</strong>
</p>


