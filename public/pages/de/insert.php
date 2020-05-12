<?php 

	

	$name = $_POST['name'];
	$userid = $_POST['userid'];
	$email = $_POST['email'];
	$mno = $_POST['mno'];
	$rcheck = $_POST['rcheck'];
	$tid = $_POST['tid'];
	
	if(!empty($name) || !empty($userid) || !empty($email) || !empty($mno) || !empty($rcheck)){
		$host = "localhost";
		$dbusername = "ofgtdepi_sce";
		$dbpassword = "6MXMv1wHSgj0R";
		$dbname = "ofgtdepi_sce";

		//creating connection
		$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

		if(mysqli_connect_error()){
			die('Connect Error('. mysqli_connect_errorno().')'. mysqli_connect_error());
		}
		else{
			$SELECT = "SELECT email from registrations_dce where email = ? limit 1";
			$INSERT = "INSERT into registrations_dce (name, userid, email, mno, rcheck, tid) values(?,?,?,?,?,?)";

			//prepare statement
			$stmt = $conn->prepare($SELECT);
			$stmt->bind_param("s", $email);
			$stmt->execute();
			$stmt->bind_result($email);
			$stmt->store_result();

			$rnum = $stmt->num_rows;

			if(rnum==0){
				$stmt->close();

				$stmt = $conn->prepare($INSERT);
				$stmt->bind_param("sssiss", $name, $userid, $email, $mno, $rcheck, $tid);
				$stmt->execute();
				echo '<script type="text/javascript">
           window.location = "http://crunched.in/pages/success.html"
      </script>';
			}
			else{
				echo "All fields are required";
			}
			$stmt->close();
			$conn->close();
		}
	}
	else{
		echo "All fields are required";
		die();
	}
 ?>