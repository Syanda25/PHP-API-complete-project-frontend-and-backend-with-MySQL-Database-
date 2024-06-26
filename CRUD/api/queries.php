<?php

    require 'config.php';
    function getAllUsers(){
        global $conn;

        $query = "SELECT * FROM user";
        $query_run = mysqli_query($conn, $query);

        if($query_run){
            if(mysqli_num_rows($query_run)>0){

                $response = mysqli_fetch_all($query_run, MYSQLI_ASSOC);
                $data = [
                    'status' => 200,
                    'message' => "Users successfully found",
                    'data' => $response
                ];
                header("HTTP/1.0 200 OK");
                return $data;
            }else{
                $data = [
                    'status' => 404,
                    'message' => 'User Not Found',
                ];
                header("HTTP/1.0 404 User Not Foun");
                return $data;
            }
        }else{
            $data = [
                'status' => 500,
                'message' => 'Internal Server Error',
            ];
            header("HTTP/1.0 500 Internal Server Error");
            return $data;
        }
    }

    function getSingle($inputedData){
        global $conn;
        $email = mysqli_real_escape_string($conn, $inputedData["email"]);


        if($inputedData["email"] == null){
            $data = [
                'status' => "No email"
            ];
            return $data;
        }

        $query = "SELECT * FROM user WHERE email='$email'";
        $query_run = mysqli_query($conn, $query);

        if($query_run){
            if(mysqli_num_rows($query_run)>0){

                $response = mysqli_fetch_all($query_run, MYSQLI_ASSOC);
                $data = [
                    'status' => 200,
                    'message' => "OK",
                    'data' => $response
                ];
                header("HTTP/1.0 200 OK");
                return $data;
            }else{
                $data = [
                    'status' => 404,
                    'message' => "User Not Found",
                ];
                header("HTTP/1.0 404 User Not Found");
                return $data;
            }
        }else{
            $data=[
                'status' => 500,
                'message' => 'Internal server error'
            ];
            header("HTTP/1.0 500 Internal Server Error");

            return $data;
        }

    }

    function createUser($inputedData){
        global $conn;

        $name = mysqli_real_escape_string($conn, $inputedData["name"]);
        $email = mysqli_real_escape_string($conn, $inputedData["email"]);
<<<<<<< HEAD:CRUD/api/queries.php
        
=======
>>>>>>> 2e36f2a638a39b02906b9e5c92be6dbb4f02decf:project/api/queries.php
        $surname = mysqli_real_escape_string($conn, $inputedData["surname"]);

        $query = "INSERT INTO user(name, email, surname)
                  VALUES ('$name', '$email', '$surname')";
        $query_run = mysqli_query($conn, $query);

        if($query_run){
            $data = [
                'status' => 200,
                'message' => 'Ok',
            ];
            header("HTTP/1.0 200 Ok");
            return $data;
        }else{
            $data = [
                'status' => 500,
                'message' => 'Internal Server Error',
            ];
            header("HTTP/1.0 500 Internal Server Error");
            return $data;
        }
    }

    function deleteUser($inputData){
        global $conn;

        if($inputData == null){
            $data = [
                'status' => 1,
            ];

            return $data;
        }

        $email = mysqli_real_escape_string($conn, $inputData["email"]);

        $query = "SELECT * FROM user WHERE email='$email'";
        $query_run = mysqli_query($conn, $query);

        if($query_run){
            if(mysqli_num_rows($query_run)>0){ //Check if the user was found or not                
                //If user found, delete the user
                $del_query = "DELETE FROM user WHERE email ='$email'";
                $del_query_run = mysqli_query($conn, $del_query);

                if($del_query_run){
                    $data = [
                        'status' => 200,
                        'message' => 'Ok'
                    ];

                    header("HTTP/1.0 200 OK");
                    return $data;
                }else{
                    $data = [
                        'status' => 500,
                        'message' => 'Internal Server Error',
                        ];
                    header("HTTP/1.0 500 Internal Server Error");
                    return $data;
                }
            }else{ //User not found
                $data = [
                    'status' => 404,
                    'message' => 'User Not Found',
                ];
                header("HTTP/1.0 404 User Not Foun");
                return $data;
            }
        }else{
            $data = [
                'status' => 500,
                'message' => 'Internal Server Error',
                ];
            header("HTTP/1.0 500 Internal Server Error");
            return $data;
        }
    }

    function updateUser($inputData, $updt_email){
        global $conn;
        $updt_email = mysqli_real_escape_string($conn, $updt_email["email"]);
        $name = mysqli_real_escape_string($conn, $inputData["name"]);
        $email = mysqli_real_escape_string($conn, $inputData["email"]);
        $surname = mysqli_real_escape_string($conn, $inputData["surname"]);

        if($updt_email == null){
            $data = [
                'status' => 1,
                'message' => 'Please provide user email'
            ];
        }
        $query = "UPDATE user 
                  SET name='$name', email='$email', surname='$surname'
                  WHERE email='$updt_email'";
        $query_run = mysqli_query($conn, $query);

        if($query_run){
            
            $data = [
                'status' => 200,
                'message' => 'Ok',
            ];
            header("HTTP/1.0 200 Ok");
            return $data;
        }else{
            $data = [
                'status' => 500,
                'message' => 'Internal Server Error',
            ];
            header("HTTP/1.0 500 Internal Server Error");
            return $data;
        }
    }
?>