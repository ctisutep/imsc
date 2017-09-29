<?php
//TODO: make page return json instead of printing
	session_start();
	include('utils.php');
	if(isset($_POST['submit'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		if(checkEmpty($username) OR checkEmpty($password)){
            echo "Must input both values";
        }
		else {
            require('config.php');
            $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
            if ($conn -> connect_error) {
                die("Connection failed: " . $conn -> connecterror);
            }
            $sql = "SELECT * FROM users WHERE username = '" . $username . "'";
            $response = $conn -> query($sql);
            if($response -> num_rows > 0){
                $row = $response->fetch_assoc();
                $salt = $row['salt'];
                $password = $password . $salt;
                $hash = md5($password);
                if($hash == $row['password'] AND $row['approved'] == 1){
                		$_SESSION['in'] = true;
                    $_SESSION['username'] = $username;
                    $_SESSION['id'] = $row['id'];
										header('Location: index2.php');
                }
                else{
                    echo "Username or password incorrect";
                }
            }
            else{
                echo "Username or password incorrect";
            }
        }
    }
    else if(isset($_POST['logout'])){
        $_SESSION = array();
    }
	else if(isset($_POST['register'])){
		$username = $_POST['uid'];
		$password = $_POST['pwd'];
		$email = $_POST['eml'];
		$fname = $_POST['fna'];
		$lname = $_POST['lna'];
		$phone = $_POST['phn'];
		if(checkEmpty($username) OR
		checkEmpty($password) OR
		checkEmpty($email) OR
		checkEmpty($fname) OR
		checkEmpty($lname) OR
		checkEmpty($phone)){
			echo "Must input all values";
		}
		else{
			require('config.php');
			require_once 'random/random.php';
			$salt = bin2hex(random_bytes(6));
			$password = $password . $salt;
			$password = md5($password);
            $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
            if ($conn -> connect_error) {
                die("Connection failed: " . $conn -> connecterror);
            }
            $email_parts = explode("@", $email);
			if($email_parts[1] === "txdot.gov" OR $email_parts[1] === "miners.utep.edu" OR $email_parts[1] === "utep.edu"){
				$sql = "INSERT INTO users (name, lname, username, password, salt, email, phone, approved) VALUES('$fname', '$lname', '$username', '$password', '$salt', '$email', '$phone', 1)"; //removed a one
			}
			else{
				echo "Please contact UTEP for help logging in.";
				$sql = "INSERT INTO users (name, lname, username, password, salt, email, phone) VALUES('$fname', '$lname', '$username', '$password', '$salt', '$email', '$phone')";
			}
			$result = $conn->query($sql);
			if($result){
				echo "created successfully";
				header('Location: index2.php');
			}
			else
				echo $sql;
		}
	}
	$conn->close();
?>
