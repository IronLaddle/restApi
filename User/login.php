<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/user.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare user object
$user = new user($db);

// set ID property of user to be edited
$user->username = isset($_GET['username']) ? $_GET['username'] : die();
$user->password = isset($_GET['password']) ? $_GET['password'] : die();
//$user->firstname = isset($_GET['firstname']) ? $_GET['firstname'] : die();
//$user->lastname = isset($_GET['lastname']) ? $_GET['lastname'] : die();
//$user->password = base64_encode(isset($_GET['password']) ? $_GET['password'] : die());

// read the details of user to be edited
$stmt = $user->login();
if($stmt->rowCount() > 0){
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // create array
    $user_arr=array(
        "status" => true,
        "message" => "Successfully Login!",
        "user_id" => $row['user_id'],
        "username" => $row['username']
    );
}
else{
    $user_arr=array(
        "status" => false,
        "message" => "Invalid Username or Password!",
    );
}
// make it json format
print_r(json_encode($user_arr));
?>