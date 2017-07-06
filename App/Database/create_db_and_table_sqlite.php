<?php
// 6 Forms and Lists
// 6.1 Forms
// 6.1.3 Examples
// 6.1.3.3 Recording on database

  try {
   
    // Create (connect to) SQLite database in file
    $file_db = new PDO('sqlite:book.db');
    // Set errormode to exceptions
    $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
    /**************************************
    * Create tables                       *
    **************************************/
 
  $file_db->exec("
        CREATE TABLE IF NOT EXISTS employee (
            id INTEGER PRIMARY KEY NOT NULL,
            name TEXT,
            address TEXT,
            email TEXT,
            department INTEGER,
            languages TEXT,
            hiring INTEGER
        )
    ");  
   
    /**************************************
    * Close db connections                *
    **************************************/
 
    // Close file db connection
    $file_db = null;
  }
  catch(PDOException $e) {
    // Print PDOException message
    echo $e->getMessage();
  }