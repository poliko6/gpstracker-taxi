<?php

/*
 * Following code will list all the products
 */

// array for JSON response
$response = array();


// include db connect class
include 'config.php';




// get all products from products table
$result = mysql_query('SELECT * FROM deviceDetail WHERE = "'.$_SESSION['deviceDetailID'].'"') or die(mysql_error());

// check for empty result
if (mysql_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["deviceDetailJson"] = array();
    
    while ($row = mysql_fetch_array($result)) {
        // temp user array
        $deviceDetailArr = array();
        $deviceDetailArr["deviceDetailIdJson"] = $row["deviceDetailID"];
        $deviceDetailArr["statusNameJson"] = $row["statusName"];
		$deviceDetailArr["latiTudeJson"] = $row["latiTude"];
		$deviceDetailArr["longtiTudeJson"] = $row["longtiTude"];
		$deviceDetailArr["speedJson"] = $row["speed"];
		$deviceDetailArr["dateJson"] = $row["date"];
		$deviceDetailArr["timeJson"] = $row["time"];
		$deviceDetailArr["totalTimeJson"] = $row["totalTime"];
		$deviceDetailArr["respondIDJson"] = $row["respondID"];

        // push single product into final response array
        array_push($response["deviceDetailJson"], $deviceDetailArr);
    }
    // success
    $response["success"] = 1;

    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "No products found";

    // echo no users JSON
    echo json_encode($response);
}
?>
