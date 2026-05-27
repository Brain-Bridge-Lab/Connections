<html>
<?php
	// ?s are the indicators of PHP code!

	// Here's the login data for your online database. Many web hosts have this as a feature and your university may allow it to! I personally use Ionos (though I have not tried other hosts so I cannot vouch for them either way). It allows me to create and maintain an unlimited number of MySQL databases on my web server. I then interact with it using this PHP script uploaded to my website.
	$host_name = "";
	$database = "";
	$user_name = "";
	$password = "";

	// Connect to the database
	$connect = mysqli_connect($host_name, $user_name, $password, $database);

	global $message;
	$message = "";

	// Check the connection, and return an error if there is an issue.
	if(mysqli_connect_errno()){
		$message = 'There was a connection error: ' . mysqli_connect_error();
	}

	// Clean up the data to prevent security risks.
	// Note: added 'ENT_QUOTES' here because quotes were breaking the code for some reason
	// Quotes get spitted out as '&#039;' 
	function testinput($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data, ENT_QUOTES);
		return $data;
	}

	// You can use this to get the IP address of your participant, if you want general location information
	function get_client_ip() {
        $ipaddress = '';
		// Essentially, different browsers have different syntax for IP address, so this is trying all of them.
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
	}

	// This encompasses anything from an <input> tag and it's identifying it from what is under "name".

	// Puzzle info
	$rid = testinput($_POST["rowid"]);
    $shufor = testinput($_POST["shuffledorder"]);
	// Performance
    $cont = testinput($_POST["connectionTimes"]);
    $cona = testinput($_POST["connectionAcc"]);
	$allselect = testinput($_POST["allSelectedWords"]);
	$mclick = testinput($_POST["mouseClick"]);
	$clickt = testinput($_POST["clickTimes"]);
    // Demographics + attention checks
	$pid = testinput($_POST["pid"]);
	$anid = testinput($_POST["anid"]);
    $ac1 = testinput($_POST["month"]);
	$ac2 = testinput($_POST["pennies"]);
    $age = testinput($_POST["age"]);
	$gen = testinput($_POST["gender"]);
    $race = testinput($_POST["race"]);
	$ethn = testinput($_POST["ethnicity"]);
	$flu = testinput($_POST["fluent"]);
	$ip = testinput($_POST["ip"]);
	$rec = testinput($_POST["recontact"]);
	// VVIQ + other questions
    $vviq = testinput($_POST["vviq"]);
	$osiq = testinput($_POST["osiq"]);
    $fq = testinput($_POST["finalQ"]);
    $fq2 = testinput($_POST["finalQ2"]);
    $fq3 = testinput($_POST["finalQ3"]);
    $fq4 = testinput($_POST["finalQ4"]);


		// Note: have to make osiq array into a string to see results on server

// Now this is the main line! This inserts the data into the database!
// The first set of items in () are the names of the columns in the MySQL database. While they are the same as the names of inputs from example4.html, this is just to keep the names consistent when analyzing the data -- they don't have to be the same! The second set of items (after VALUES) are the values we just extracted that we're uploading into each of the columns. We're essentially creating a new row in the database.
$sql = "INSERT INTO connectionsdata (rowid,shuffledorder,connectionTimes,connectionAcc,allSelectedWords,mouseClick,clickTimes,pid,anid,month,pennies,age,gender,race,ethnicity,fluent,ip,recontact,vviq,osiq,finalQ,finalQ2,finalQ3,finalQ4)
VALUES ('$rid','$shufor','$cont','$cona','$allselect','$mclick','$clickt','$pid','$anid','$ac1','$ac2','$age','$gen','$race','$ethn','$flu','$ip','$rec','$vviq','$osiq','$fq','$fq2','$fq3','$fq4')";

// You can use PHP to interact with the webpage. It can also do things like work with variables, use logic, and do basic math. Here, if it successfully sends the data, it will post a thank you. If it doesn't, it will return an error.

// As a silly example, I will also have it return the participant's age and do simple math on it, so you can see how to integrate data between PHP and HTML.

if (mysqli_query($connect, $sql)){ // If successfully uploaded

	// You can write HTML code right into a String!
	$displayperformance = "<div style='font-family:helvetica;font-size:18px'>Many thanks for being in our study!<br><br>
	</div>";
} else{
	$displayperformance = "Error: " . $sql . "<br>" . mysqli_error($connect);
}

mysqli_close($connect); // Now close the connection

?>
<title>Experiment Complete</title>
<center>
<br><br>
<div style='font-family:helvetica;font-size:24px'>Thank you!</div>
<br><br>
<!-- Here is how that message is inserted from the PHP to the HTML! -->	
<p><?php echo $displayperformance ?></p>
</center>


</html>