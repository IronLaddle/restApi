<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/user.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
$user = new user($db);
 
// set user property values
// $user->username = $_POST['username'];
// $user->password = $_POST['password'];
// $user->firstname = $_POST['firstname'];
// $user->lastname = $_POST['lastname'];

$user->username = isset($_POST['username']) ? $_POST['username'] : die();
$user->password = isset($_POST['password']) ? $_POST['password'] : die();
$user->firstname = isset($_POST['firstname']) ? $_POST['firstname'] : die();
$user->lastname = isset($_POST['lastname']) ? $_POST['lastname'] : die();

//$user->password = base64_encode($_POST['password']);

 
// create the user
if($user->signup()){
    $user_arr=array(
        "status" => true,
        "message" => "Successfully Signup!",
        "user_id" => $user->user_id,
        "username" => $user->username
    );
}
else{
    $user_arr=array(
        "status" => false,
        "message" => "Username already exists!"
    );
}
print_r(json_encode($user_arr));
?>