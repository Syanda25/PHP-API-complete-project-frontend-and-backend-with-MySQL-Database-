<?php
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Method: GET');
    header('Access-Control-Allow-Header: Content-Type, Access-Control-Headers, Authorization, x-Request-With');

    include("queries.php");

    echo (getAll());
    function getAll(){
        $requsetMethod = $_SERVER["REQUEST_METHOD"];

        if($requsetMethod == "GET"){
            /*if(isset($_GET['id'] && $_GET['table'])){
                this will specify the id and the table where to retrieve data
                call the function that will retrieve data from the table
                    the function must take user id as parameter to get a sing recod
            }else if$_GET['table']{
                get all infor from the provided table
            }*/
            if(isset($_GET['email'])){
                $user = getSingle($_GET);
                return json_encode($user);
            }else{
                $data = getAllUsers();
                return json_encode($data);
            }
        }else{
            $data = [
                'status'=> 405,
                'message' => $requsetMethod." Method not allowes",
            ];
            header("HTTP/1.0 405 Method Not Allowed");

            return json_encode($data);
        }
    }
?>