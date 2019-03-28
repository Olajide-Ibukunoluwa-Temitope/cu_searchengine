<?php

/**
 * This function loads the database for our searched row
 *
 * @param [resource] $conn    mysql connection
 * @param [int]   $query_id   row_id
 *
 * @return [array]             search results
 */
function doLogin($conn, $email, $password)
{
    $email = $conn->escape_string($email);
    $password = $conn->escape_string($password);

    $searchQuery = <<<sql
        SELECT *
          FROM admins
          WHERE email = '$email' 
          AND password = '$password';
sql;

    $queryTime = microtime(true); // start time

    $result = $conn->query($searchQuery);

    $queryTime = microtime(true) - $queryTime; // total time took

    $result = boolval($result) ? $result : false;
    
    if ($result) {
        return $result->fetch_assoc();
    }
    
    return null; // no result
}


function user($conn, $id)
{
	$searchQuery = <<<sql
        SELECT *
          FROM admins
          WHERE id = '$id';
sql;

    $queryTime = microtime(true); // start time

    $result = $conn->query($searchQuery);

    $queryTime = microtime(true) - $queryTime; // total time took

    $result = boolval($result) ? $result : false;
    
    if ($result) {
        return $result->fetch_assoc();
    }
    
    throw new Exception("Error Processing Request", 1);
    
}
