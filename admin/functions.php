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

function requests($conn, $limit = 50, $offset = 0, $page = 1)
{
    $search = [];
    $offset = $conn->escape_string($offset);
    $limit = $conn->escape_string($limit);

    if($page > 1){
        $offset = ($page - 1) * $limit;
    }

    $searchQuery = <<<sql
        SELECT id, query, created_at
        FROM requests
        LIMIT $offset, $limit;
sql;

    $queryTime = microtime(true); // start time

    $results = $conn->query($searchQuery);

    $queryTime = microtime(true) - $queryTime; // total time took


    // fetch total rows
    // same query without LIMIT
    $resultsCount = <<<count
        SELECT id, query
        FROM requests
count;
    
    $resultsCount = $conn->query($resultsCount);

    $results = boolval($results) ? $results : false;
    if ($results) {
        if ($results->num_rows > 0) {
            return[
                'data' => $results,
                'page_count' => $results->num_rows,
                'per_page' => $limit,
                'page' => $page,
                'total_count' => $resultsCount->num_rows,
                'search' => $search
            ];
        }
    }

    return null; // no result
}

function viewRequest($conn, $query_id)
{
    $$query_id = $conn->escape_string($query_id);

    $searchQuery = <<<sql
        SELECT *
          FROM requests
          WHERE id = '$query_id';
sql;

    $queryTime = microtime(true); // start time

    $result = $conn->query($searchQuery);

    $queryTime = microtime(true) - $queryTime; // total time took

    $result = boolval($result) ? $result : false;
    
    if ($result) {
        return $result->fetch_assoc();
    }

    return null;
}

function deleteRequest($conn, $query_id)
{
    $now = date('Y-m-d H:i:s');
    $query_id = $conn->escape_string($query_id);

    $insertQuery = <<<sql
        DELETE FROM `requests` WHERE `id` = $query_id;
sql;

    return $conn->query($insertQuery);
}

function answerRequest($conn, $query_id, $query, $query_ans)
{
    $now = date('Y-m-d H:i:s');
    $id = $conn->escape_string($query_id);
    $query = $conn->escape_string($query);
    $query_ans = $conn->escape_string($query_ans);

    $insertQuery = <<<sql
        UPDATE requests SET `is_answered` = '1' WHERE `id` = $id;
sql;

    $result = $conn->query($insertQuery);

    if($result){
        return addQuery($conn, $query, $query_ans);
    }

    return null;
}


function queries($conn, $limit = 50, $offset = 0, $page = 1)
{
    $search = [];
    $offset = $conn->escape_string($offset);
    $limit = $conn->escape_string($limit);

    if($page > 1){
        $offset = ($page - 1) * $limit;
    }

    $searchQuery = <<<sql
        SELECT query_id, query, query_ans, created_at
        FROM q_and_a
        LIMIT $offset, $limit;
sql;

    $queryTime = microtime(true); // start time

    $results = $conn->query($searchQuery);

    $queryTime = microtime(true) - $queryTime; // total time took


    // fetch total rows
    // same query without LIMIT
    $resultsCount = <<<count
        SELECT query_id, query, query_ans
        FROM q_and_a
count;
    
    $resultsCount = $conn->query($resultsCount);

    $results = boolval($results) ? $results : false;
    if ($results) {
        if ($results->num_rows > 0) {
            return[
                'data' => $results,
                'page_count' => $results->num_rows,
                'per_page' => $limit,
                'page' => $page,
                'total_count' => $resultsCount->num_rows,
                'search' => $search
            ];
        }
    }

    return null; // no result
}

function addQuery($conn, $query, $query_ans)
{
    $now = date('Y-m-d H:i:s');
    $query = $conn->escape_string($query);
    $query_ans = $conn->escape_string($query_ans);

    $insertQuery = <<<sql
        INSERT INTO q_and_a(query, query_ans, created_at, updated_at)
        VALUES('$query', '$query_ans', '$now', '$now');
sql;

    $result = $conn->query($insertQuery);

    if($result){
        return $conn->insert_id;
    }

    return null;
}

function updateQuery($conn, $query_id, $query, $query_ans)
{
    $now = date('Y-m-d H:i:s');
    $query = $conn->escape_string($query);
    $query_id = $conn->escape_string($query_id);
    $query_ans = $conn->escape_string($query_ans);

    $insertQuery = <<<sql
        UPDATE q_and_a SET `query` = '$query', `query_ans` = '$query_ans' WHERE `query_id` = $query_id;
sql;

    return $conn->query($insertQuery);
}


function viewQuery($conn, $query_id)
{
    $$query_id = $conn->escape_string($query_id);

    $searchQuery = <<<sql
        SELECT *
          FROM q_and_a
          WHERE query_id = '$query_id';
sql;

    $queryTime = microtime(true); // start time

    $result = $conn->query($searchQuery);

    $queryTime = microtime(true) - $queryTime; // total time took

    $result = boolval($result) ? $result : false;
    
    if ($result) {
        return $result->fetch_assoc();
    }

    return null;
}

function deleteQuery($conn, $query_id)
{
    $now = date('Y-m-d H:i:s');
    $query_id = $conn->escape_string($query_id);

    $insertQuery = <<<sql
        DELETE FROM `q_and_a` WHERE `query_id` = $query_id;
sql;

    return $conn->query($insertQuery);
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
