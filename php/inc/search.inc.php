<?php


if (!defined('included')) {
    exit("Sorry you cannnot access this file directly");
}

/**
 * This function searches the database for our query
 *
 * @param [resource] $conn    mysql connection
 * @param [string]   $query   search query
 * @param [int]      $startAt pagination start index
 *
 * @return [array]             search results
 */
function search($conn, $query, $startAt)
{
    $query = $conn->escape_string($query);
    $startAt = $conn->escape_string($startAt);

    $searchQuery = <<<sql
	    SELECT query_id, query, query_ans
	    FROM q_and_a
	    WHERE MATCH (query, query_ans) AGAINST('$query')
	    LIMIT $startAt, 10;
sql;

    $queryTime = microtime(true); // start time

    $results = $conn->query($searchQuery);

    $queryTime = microtime(true) - $queryTime; // total time took


    // fetch total rows
    // same query without LIMIT
    $resultsCount = <<<count
	    SELECT query_id, query, query_ans
        FROM q_and_a
        WHERE MATCH (query, query_ans) AGAINST('$query')
count;
    
    $resultsCount = $conn->query($resultsCount);

    $results = boolval($results) ? $results : false;
    if ($results) {
        if ($results->num_rows > 0) {
            return [$results, $queryTime, $resultsCount->num_rows];
        }

        $results = false;
    }


    if (!$results) {
        // invalid query or no result
        // try different search technique

        $sqlQuery = "SELECT query_id, query, query_ans FROM q_and_a WHERE query_ans";
        $words = explode(" ", $query);

        for ($i = 0; $i < $count = count($words); $i += 1) {
            if ($i === $count - 1) { // last loop
                $sqlQuery .= " LIKE '%$words[$i]%' LIMIT $startAt, 10";
            } else {
                $sqlQuery .= " LIKE '%$words[$i]%' OR query_ans";
            }
        }

        $queryTime = microtime(true); // start time

        $results = $conn->query($sqlQuery);

        $queryTime = microtime(true) - $queryTime; // total time took


        // fetch total rows
        // same query without LIMIT
        $qry = "SELECT query_id, query, query_ans FROM q_and_a WHERE query_ans";

        for ($i = 0; $i < $count = count($words); $i += 1) {
            if ($i === $count - 1) {
                $qry .= " LIKE '%$words[$i]%';";
            } else {
                $qry .= " LIKE '%$words[$i]%' OR query_ans";
            }
        }

        $allResults = $conn->query($qry);
    }


    if (!!$results && $results->num_rows > 0) {
        return [$results, $queryTime, $allResults->num_rows];
    }

    return null; // no result
}


/**
 * This function loads the database for our searched row
 *
 * @param [resource] $conn    mysql connection
 * @param [int]   $query_id   row_id
 *
 * @return [array]             search results
 */
function view_result($conn, $query_id)
{
    $query_id = $conn->escape_string($query_id);

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
        return $result->fetch_row();
    }
    
    return null; // no result
}

/**
 * This function loads the database for our searched row
 *
 * @param [resource] $conn    mysql connection
 * @param [int]   $query_id   row_id
 *
 * @return [array]             search results
 */
function add_request($conn, $query)
{
    $now = date('Y-m-d H:i:s');
    $query = $conn->escape_string($query);

    $insertQuery = <<<sql
        INSERT INTO requests(query, created_at, updated_at)
        VALUES('$query', '$now', '$now');
sql;

    $result = $conn->query($insertQuery);

    if($result){
        return $conn->insert_id;
    }

    return null;
}

