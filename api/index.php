<?php

session_start();

// Get the Slim framework
require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();

// Create new object of Slim
$app = new \Slim\Slim();

// Set the HTTP Header of the Content-Type (MIME Type) to be JSON
$app->contentType( 'application/json' );

// Get the class that controls all the users functions
require_once dirname( __FILE__ ) . '/../core/Users.class.php';
$user = new User();

// Get the class that controls all the login functions
require_once dirname( __FILE__ ) . '/../core/Login.class.php';
$login = new Login();

// GET Route /user/ - Fetch the list of all the users
/*
 *	"use ( $user )" is like "global $user"
 *	Why do we use it? Because the var $user (that contains the user object)
 *	is written outside(!) of the function, and we want to use it
 */
$app->get( '/user/', function() use ( $user ) {
	
	$user_list = $user->getAllUsers();
	echo json_encode( $user_list );
});

// GET Route /user/:id/ - Fetch the list of all the users
/*
 *	The ":id" is used to get a parameter from the URI
 *	For example: /user/23234/ - We'll get 23234 as the id
 *	
 *	We have to pass the id (:id) from the URI to the function
 *	because we need to use this id
 */
$app->get( '/user/:id/', function( $id ) use ( $user ) {
	echo json_encode( $user->getUserById( $id ) );
});

// POST Route: /user/ - Insert new user
/*
 *	Notice that this route is the same as the above (Like GET)
 *	The only difference between them is the HTTP Method that has been sent
 */
$app->post( '/user/', function() use ( $user, $app, $login ) {
	/*
	 *	What the hell is $app->request->getBody()?
	 *	getBody is a method inside the Slim framework that 
	 *	bring us the RAW Data that has been sent from the client
	 *	RAW Data is just a stock of data without any key and value
	 *	Unlike $_POST['...'] or $_REQUEST['...'], RAW data has NO order
	 *	with key and values
	 *
	 *	We'll see how to use POST params in the next routes
	 */
	$user_details = $app->request->getBody();

	/*
	 *	json_decode gets a string and return object
	 *	if we add "true" in the second param we'll get an array
	 */
	$data = json_decode( $user_details, true );

	// And finally send all the array to the createNewuser method
	$error = $user->createNewUser( $data );
    if (!$error) {
        $login->fillSession($data);
    }

    echo json_encode($error);
});

$app->delete( '/user/:id/', function( $id ) use ( $user ) {
	echo $user->deleteUser( $id );
});

$app->put( '/user/:id/', function( $id ) use ( $user, $app ) {
	$details = json_decode( $app->request->getBody() );

	echo $user->updateUser( $id, $details );
});







require_once dirname( __FILE__ ) . '/../core/Login.class.php';

$app->post( '/login/', function() use ( $app ) {
	$username = $app->request->post('username');
	$password = $app->request->post('password');

	var_dump( $login->match( $username, $password ) );
});

$app->run();