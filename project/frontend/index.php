<!DOCTYPE HTML>

<html>
    <head>
        <title>
            Test
        </title>
    </head>

    <body>
        <form method="post">
            Name: <input type="text" name="name" placeholder="Insert or Update"/>
            <br>
            Email: <input type="email" name="email" placeholder="Insert or Update"/>
            <br>
            Password: <input type="text" name="surname" placeholder="Insert or Update"/>
            <br>

            <div>
                <br>
                <input type="submit" name="submit" value="Insert User " />
                <input type="submit" name="get_data" value="Get All Users"/>
            </div>
            
            <div>
                <br>
                <input type="email" name="updt_email" placeholder="Email (Update)"/>
                <input type="submit" name="update" value="Update User" />
            </div>

            <div>
                <br>
                <input type="email" name="get_email" placeholder="Email (Retrieve)"/>
                <input type="submit" name="get_user" value="Get User"/>
            </div>

            <div>
                <br>
                <input type="email" name="rm_email" placeholder="Email (Delete)"/>
                <input type="submit" name="delete" value="Delete User"/>
            </div>
        </div>
    </body>
</html>

<?php
include ('main.php');

//********************************CREATE**********************************/
    if(isset($_REQUEST['submit'])){
        $name = $_REQUEST['name'];
        $surname = $_REQUEST['surname'];
        $email = $_REQUEST['email'];

        if($name == null){
            echo("<script>alert('Provide name')</script>");
            return;
        }
        if($surname == null){
            echo("<script>alert('Provide surname')</script>");
            return;
        }
        if($email == null){
            echo("<script>alert('Provide email')</script>");
            return;
        }

        $data = [
            "name"=>$name,
            "surname" => $surname,
            "email" => $email
        ];

        //insert function from the main
        insert($data);
    }

    if(isset($_REQUEST['get_data'])){
        getAll();
    }

//********************************DELETE**********************************/
    if(isset($_REQUEST['delete'])){
        $email = $_REQUEST['rm_email'];

        if($email == null){
            echo("<script>alert('Provide email')</script>");
            return;
        }

        $_data = [
            "email"=>$email
        ];

        //delete function from the main
        delete($_data);
    }

//********************************UPDATE**********************************/
    if(isset($_REQUEST['update'])){
        $name = $_REQUEST['name'];
        $surname = $_REQUEST['surname'];
        $email = $_REQUEST['email'];
        $updt_email = $_REQUEST['updt_email'];

        $email = $_REQUEST['get_email'];
        if($updt_email == null){
            echo("<script>alert('Provide user(email) to update')</script>");
            return;
        }

        $data = [
            "name"=>$name,
            "surname" => $surname,
            "email" => $email
        ];

        //upadate function from the main
        update($data, $updt_email);
    }

//*********************************Get sing user**************************/
    if(isset($_REQUEST['get_user'])){
        $email = $_REQUEST['get_email'];
        if($email == null){
            echo("<script>alert('Provide email')</script>");
            return;
        }

        //getSinf user function from main
        getSingle($email);
    }
?>
