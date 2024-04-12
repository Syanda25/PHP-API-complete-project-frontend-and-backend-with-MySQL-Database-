<?php
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Method: PUT');
    header('Access-Control-Allow-Header: Content-Type, Access-Control-Headers, Authorization, x-Request-With');

    include("queries.php");

    echo(update());
    function update(){
        $requsetMethod = $_SERVER["REQUEST_METHOD"];

        if($requsetMethod == "PUT"){
    
            $inputData = json_decode(file_get_contents("php://input"), true); //getting data from the front end or postma...
            if(isset($_GET['email'])){
                //Use the get sing user to check if the user does exits in databse
                $user = getSingle($_GET);

                if($user['status'] == 200){
                    $inputData = json_decode(file_get_contents("php://input"), true);
                    $updt_user = updateUser($inputData, $_GET);
                    $data = json_encode($updt_user);
                    return $data;
                }else{
                    return json_encode($user);
                }
            }else{
                $data = [
                    'status' => 0,
                    'message' => 'Email to update not provided',
                ];
                return json_encode($data);
            }
        }else{
            $data = [
                'status'=> 405,
                'message' => $requsetMethod." Method not allowed",
            ];
    
            header("HTTP/1.0 405 Method Not Allowed");
            return json_encode($data);
        }
    }