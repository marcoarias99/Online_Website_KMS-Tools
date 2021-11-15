<?php
    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // Include database and works_for object
    include_once '../config/config.php';
    include_once '../objects/works_for.php';
    
    // Get database connection
    $database = new Config();
    $db = $database->getConnection();
    
    // Prepare works_for object
    $works_for = new Works_for($db);
    
    // Get SID of the works_for to be updated
    $data = json_decode(file_get_contents("php://input"));

    // Set SID of the works_for to be updated
    $works_for->SID = $data->SID;
     
    // Set works_for property values
    $works_for->branch_id = $data->branch_id;
    $works_for->shift = $data->shift;

    // Update the works_for
    if($works_for->update()){
        // set response code - 200 ok and message the user
        http_response_code(200);
        echo json_encode(array("message" => "works_for was updated."));
    }
    
    // Unable to update the works_for
    else{    
        // set response code - 503 service unavailable and message the user
        http_response_code(503);
        echo json_encode(array("message" => "Unable to update works_for."));
    }

?>