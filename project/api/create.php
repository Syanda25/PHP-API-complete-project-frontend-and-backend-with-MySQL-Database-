<?php
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Method: GET');
    header('Access-Control-Allow-Header: Content-Type, Access-Control-Headers, Authorization, x-Request-With');

    include("queries.php");

    echo(create());
    function create(){
        $requsetMethod = $_SERVER["REQUEST_METHOD"];

        if($requsetMethod == "POST"){
    
            $inputData = json_decode(file_get_contents("php://input"), true); //getting data from the front end or postma...

            $_createUser = createUser($inputData);
            return json_encode($_createUser);
        }else{
            $data = [
                'status'=> 405,
                'message' => $requsetMethod." Method not allowed",
            ];
    
            header("HTTP/1.0 405 Method Not Allowed");
            return json_encode($data);
        }
    }
?>