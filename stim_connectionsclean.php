<?php
// ?s are the indicators of PHP code!

    header('Content-type: application/json; charset=utf-8');
    header('Access-Control-Allow-Origin: *');

	// Here's the login data for your online database. Many web hosts have this as a feature and your university may allow it to! I personally use Ionos (though I have not tried other hosts so I cannot vouch for them either way). It allows me to create and maintain an unlimited number of MySQL databases on my web server. I then interact with it using this PHP script uploaded to my website.
	// Note: these will have to be changed if you create a new database on your server
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


// Select a row of stimuli URLs from the database, retrieve it and send it to HTML, so the participants can see the stimuli 
$row_used = 1;
$row_id = 0;
while ($row_used==1) {
    $query = "SELECT * FROM randomizedstim_connections ORDER BY RAND() LIMIT 1"; // Select a random row that hasn't been shown to participants
    // $query = "SELECT * FROM randomizedURL_av WHERE id=208"; // Used for testing
    $returned = mysqli_query($connect, $query);
    $result = mysqli_fetch_object($returned);
    
    $row_used = $result->used;
    $row_id = $result->id;

    if ($row_used==0) {
        // Comment out for testing
        // Update the used column once the row of stimuli URLs is selected for a participant
        $query = "UPDATE randomizedstim_connections SET used=1 WHERE id='$row_id'";
        mysqli_query($connect, $query);  
        
        # Array of images for each tile
        $so = $result->COL1;
        $r1c1 = $result->COL2;
        $r1c2 = $result->COL3;
        $r1c3 = $result->COL4;
        $r1c4 = $result->COL5;
        $r2c1 = $result->COL6;
        $r2c2 = $result->COL7;
        $r2c3 = $result->COL8;
        $r2c4 = $result->COL9;
        $r3c1 = $result->COL10;
        $r3c2 = $result->COL11;
        $r3c3 = $result->COL12;
        $r3c4 = $result->COL13;
        $r4c1 = $result->COL14;
        $r4c2 = $result->COL15;
        $r4c3 = $result->COL16;
        $r4c4 = $result->COL17;

        # Image type for each title
        $tr1c1 = $result->COL18;
        $tr1c2 = $result->COL19;
        $tr1c3 = $result->COL20;
        $tr1c4 = $result->COL21;
        $tr2c1 = $result->COL22;
        $tr2c2 = $result->COL23;
        $tr2c3 = $result->COL24;
        $tr2c4 = $result->COL25;
        $tr3c1 = $result->COL26;
        $tr3c2 = $result->COL27;
        $tr3c3 = $result->COL28;
        $tr3c4 = $result->COL29;
        $tr4c1 = $result->COL30;
        $tr4c2 = $result->COL31;
        $tr4c3 = $result->COL32;
        $tr4c4 = $result->COL33;

        # Row number in database
        $rid = $result->id;
    }
}
 
// Now close the connection
mysqli_close($connect);

// Now save everything in a JSON (data sending to HTML)
$myObj->shuffledorder = $so; // Block 1 encoding stimulus 1
$myObj->r1c1stim = $r1c1;
$myObj->r1c2stim = $r1c2;
$myObj->r1c3stim = $r1c3;
$myObj->r1c4stim = $r1c4;
$myObj->r2c1stim = $r2c1;
$myObj->r2c2stim = $r2c2;
$myObj->r2c3stim = $r2c3;
$myObj->r2c4stim = $r2c4;
$myObj->r3c1stim = $r3c1;
$myObj->r3c2stim = $r3c2;
$myObj->r3c3stim = $r3c3;
$myObj->r3c4stim = $r3c4;
$myObj->r4c1stim = $r4c1;
$myObj->r4c2stim = $r4c2;
$myObj->r4c3stim = $r4c3;
$myObj->r4c4stim = $r4c4;
$myObj->r1c1stimtype = $tr1c1;
$myObj->r1c2stimtype = $tr1c2;
$myObj->r1c3stimtype = $tr1c3;
$myObj->r1c4stimtype = $tr1c4;
$myObj->r2c1stimtype = $tr2c1;
$myObj->r2c2stimtype = $tr2c2;
$myObj->r2c3stimtype = $tr2c3;
$myObj->r2c4stimtype = $tr2c4;
$myObj->r3c1stimtype = $tr3c1;
$myObj->r3c2stimtype = $tr3c2;
$myObj->r3c3stimtype = $tr3c3;
$myObj->r3c4stimtype = $tr3c4;
$myObj->r4c1stimtype = $tr4c1;
$myObj->r4c2stimtype = $tr4c2;
$myObj->r4c3stimtype = $tr4c3;
$myObj->r4c4stimtype = $tr4c4;
$myObj->rowid = $rid;

$myJSON = json_encode($myObj);

echo $myJSON; // Push myJSON to HTML, where myObj will be accessed 
?>