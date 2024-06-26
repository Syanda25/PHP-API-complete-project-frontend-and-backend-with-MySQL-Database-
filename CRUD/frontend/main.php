<?php

//*********************************CREATE*********************************/
    function insert($data){

        $url = "http://localhost/CRUD/api/create.php";

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);
        if($data['status'] == 200){
            echo("<script> alert('User created') </script>");
        }else{
            echo("<script> alert("."Status: ".$data['status']."\nMessage: ".$data['message'].") </script>");
        }
        exit;
    }

//******************************GET ALL ENTITIES**************************/
    function getAll(){
        $url = "http://localhost/CRUD/api/read.php";

        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPGET, true);

        $response = curl_exec($ch);
        curl_close($ch);

        $_data = json_decode($response, true);


        if($_data['status']==200){
            foreach($_data['data'] as $data){
                echo("<tr>
                <td>". $data['name']."</td>
                <td>". $data['surname']."</td>
                <td>". $data['email']."</td>
                <td>
                    <form method='post'>
                        <input type='submit' value='DELETE' class='btn btn-primary' name='delete'/>
                    </form>
                </td>
                </tr>");
            }
        }else if($_data['status'] == 500){
            echo("<script> alert('Internal Server Error') </script>");
            exit;
        }else{
            echo("<script> alert('Something went wrong. Please try agin later')</script>");
            exit;
        }
    }

//********************************GET SINGLE ENTITY***********************/
    function getSingle($email){
        $url = "http://localhost/CRUD/api/read.php?email=".($email);

        //$url = "http://localhost/project/api/read.php?email=".($email)."&table=tablename";  To specify the Id and the table where you want to process the data

        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPGET, true);

        $response = curl_exec($ch);
        curl_close($ch);

        $_data = json_decode($response, true);

        if($_data['status']==200){

        }else if($_data['status'] == 404){
            echo("<script> alert('User Not Found')</script>");
            exit;
        }else if($_data['status'] == 500){
            echo("<script> alert('Internal Server Error') </script>");
            exit;
        }else{
            echo("<script> alert(.'".$_data['status']."\n".$_data['message']."')</script>");
            exit;
        }

        return $_data;
    } //found

//***********************************DELETE*******************************/
    function delete($_data){
        $url = "http://localhost/CRUD/api/delete.php";

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($_data));

        $response = curl_exec($ch);
        curl_close($ch);

        
        $data = json_decode($response, true);

        if($data['status'] == 200){
            echo("<script> alert('User deleted') </script>");
            exit;
        }else if($data['status'] == 404){
            echo("<script> alert('User Not Found') </script>");
            exit;
        }else if($data['status'] == 500){
            echo("<script> alert('Internal Server Error') </script>");
            exit;
        }else{
            echo("<script> alert('Something went wrong. Please try agin later')</script>");
            exit;
        }
    }

    //*******************************UPDATE*******************************/

    function update($data, $email){
        $url = "http://localhost/CRUD/api/update.php?email=".($email);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($ch);
        curl_close($ch);

        var_dump($response);
        
        $data = json_decode($response, true);

        if($data['status'] == 200){
            echo("<script> alert('User Updated') </script>");
            exit;
        }else if($data['status'] == 404){
            echo("<script> alert('User Not Found') </script>");
            exit;
        }else if($data['status'] == 500){
            echo("<script> alert('Internal Server Error') </script>");
            exit;
        }else{
            echo("<script> alert('Something went wrong. Please try agin later')</script>");
            exit;
        }
    }

?>