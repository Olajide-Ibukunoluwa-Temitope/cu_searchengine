<?php
/**
 * This file is part of the cu_searchengine project
 *
 * Copyright (c) 2017, Sochima Biereagu
 * Under MIT License
 */

/* this script creates the cu_searchengine database and its' tables if the're not yet created */
/* also makes the mysql $conn variable abailable for use */

require_once "helpers.inc.php";

$config_file = __DIR__."/../../config.json";

if (!defined('included')) {
    exit(PHP_EOL."Sorry, you cannot access this script directly".PHP_EOL);
}

// creates config file if missing or corrupted
prepareConfigFile($config_file);

// get config data
$json = json_decode(file_get_contents($config_file), true);
extract($json);

$conn = @new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD);

// called from command line?
$isCMD = false;
if (isset($_SERVER['argc']) && isset($_SERVER['argv'])) {
    $isCMD = true;
}

if ($conn -> connect_error) {
    if ($isCMD) {
        exit(PHP_EOL."Error establishing a MySQL database connection, run ".PHP_EOL." $ ../bin/cu_searchengine config".PHP_EOL);
    }

    $str = <<<text
         <big>
          <br> <br> <br>
          <fieldset>
           <legend> cu_searchengine &lt; MySQL Connection Error &gt; </legend>
             Error establishing a MySQL database connection, please setup cu_searchengine by <code>`cd`</code>ing into cu_searchengines directory and run <br>
              <pre>$ ./bin/cu_searchengine config</pre>
             and make sure MySQL is running on your computer.
          </fieldset>
          <br>
          <b> $conn->connect_error </b>
         </big>
    text;

        exit($str);
    }

$database = $conn->escape_string($DB_NAME); // database name, extracted from $json
$conn->select_db($database);

$tablesQuery = <<<sql

INSERT INTO `admins` (`id`, `username`, `email`, `image`, `password`, `remember_token`, `created_at`, `updated_at`) 
VALUES (NULL, 'admin', 'admin@cu.edu.ng', NULL, 'admin', NULL, '2019-03-28 00:00:00', '2019-03-28 00:00:00');

sql;

if (!$conn->query($tablesQuery)){
    exit("Failed to alter tables in the database<br>\n\n<br>".$conn->error);
}