<?php
    include ('main.php');
?>

<!doctype html><html>
<head>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	
	<title>CRUD</title>
	
	<style>
	    .inline-80 {
		    display: inline-block; 
		    width: 80px;
	    }
        .container {
            display: flex;
        }

        .half {
            flex: 1;
        }
	</style>
</head>
<body>

  <div class="container" id="new-entry">
        <div class="half left-half">
		    <h3>Add New User</h3>
		    <form method="post">
			    <div class="form-group">
				    <label class="inline-80">Name</label> &nbsp;
				    <input type="text" id="code" name="name"/>
			    </div>
			    <div class="form-group">
				    <label class="inline-80">Surname</label> &nbsp;
				    <input type="text" id="descr" name="surname"/>
			    </div>
			    <div class="form-group">
				    <label class="inline-80">Email</label> &nbsp;
				    <input type="email" id="uom" name="email"/>
			    </div>

			    <div class="form-group">
                    <input type="submit" value="ADD" class="btn btn-primary" name="submit"/>
			    </div>
                <br>
                <div class="form-group">
                    <input type="submit" value="Get All Users" class="btn btn-primary" name="get_data"/>
			    </div>
		    </form>
        </div>
        <div class="half right-half">
            <h3>Update User</h3>
		    <form method="post">
                <div class="form-group">
                    <label class="inline-80">Old Email</label> &nbsp;
                    <input type="email" id="uom" name="get_email"/>
                    <input type="hidden" name="old_email"> <!-- Hidden input field which holds the old email for update-->
                </div>
			    <div class="form-group">
                    <input type="submit" value="Search User" class="btn btn-primary" name="get_user"/>
			    </div>
                <?php
                    function displayUpdate(){
                        echo("
                        <div class='form-group'>
                            <label class='inline-80'>Name</label> &nbsp;
                            <input type='text' id='code' name='newName'placeholder='New Name'/>
                        </div>

                        <div class='form-group'>
                            <label class='inline-80'>Surname</label> &nbsp;
                            <input type='text' id=descr' name='newSurname'placeholder='New Surname'/>
                        </div>

                        <div class='form-group'>
                            <label class='inline-80'>New Email</label> &nbsp;
                            <input type='email' id='uom' name='newEmail' placeholder='New Email'/>
                        </div>

                        <div class='form-group'>
                            <input type='submit' value='UPDATE' class='btn btn-primary' name='update'/>
                        </div>
                        ");
                    }
                    if (isset($_POST['get_email'])) {
                        $textboxValue = $_POST['get_email'];
                        // Store the value in the hidden input field
                        $_POST['old_email'] = $textboxValue;
                    }

                    if(isset($_REQUEST['get_user'])){
                       
                        $email = $_POST['get_email'];
                        $_POST['old_email'] = $email;
                        if($email == null){
                            echo("<script>alert('Provide email')</script>");
                            return;
                        }
                        //getSinf user function from main
                        $_data = getSingle($email);
                        if($_data['status'] == 200){
                            foreach($_data['data'] as $data){
                                $email = $data['email'];
                                $surname = $data['surname'];
                                $name = $data['name'];
                                print("Email: ".$email."<br>Name: ".$name."<br>Surname: ".$surname."<br> <br>");
                                displayUpdate();
                            }
                        }
                    }
                ?>
		    </form>
        </div>
	</div>

	
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>

<?php

//********************************CREATE**********************************/
    if(isset($_REQUEST['submit'])){
        $name = $_REQUEST['name'];
        $email = $_REQUEST['email'];
        $surname = $_REQUEST['surname'];

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
        header("Location: http://localhost/CRUD/frontend/user_data.php");
        exit;
    }
//************************************Get All******************************/
    if(isset($_REQUEST['get_data'])){
        header("Location: http://localhost/CRUD/frontend/all_user_data.php");
        exit;
    }


//********************************UPDATE**********************************/
    if(isset($_REQUEST['update'])){
        print($_POST['old_email']);
        $name = $_REQUEST['newName'];
        $surname = $_REQUEST['newSurname'];
        $email = $_REQUEST['newEmail'];
        $old_Email = $_POST['old_email'];

        if($name == null){
            echo("<script>alert('Provide new name')</script>");
            return;
        }
        
        if($surname == null){
            echo("<script>alert('Provide new surname')</script>");
            return;
        }

        if($email == null){
            echo("<script>alert('Provide new email')</script>");
            return;
         }

        $data = [
            "name"=>$name,
            "surname" => $surname,
            "email" => $email
        ];

        //upadate function from the main
        update($data, $old_Email);
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

?>