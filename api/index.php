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

/**
 * User
 */

// GET Route /user/ - Fetch the list of all the users
/*
 *	"use ( $user )" is like "global $user"
 *	Why do we use it? Because the var $user (that contains the user object)
 *	is written outside(!) of the function, and we want to use it
 */
$app->get( '/users', function() use ( $user ) {
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
$app->get( '/user/:id', function( $id ) use ( $user ) {
	echo json_encode( $user->getUserById( $id ) );
});

// POST Route: /user/ - Insert new user
/*
 *	Notice that this route is the same as the above (Like GET)
 *	The only difference between them is the HTTP Method that has been sent
 */
$app->post( '/user', function() use ( $user, $app, $login ) {
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
	$error = $user->createNewUser( $data, $login );

    echo json_encode($error);
});

$app->delete( '/user/:id', function( $id ) use ( $user ) {
	echo $user->deleteUser( $id );
});

$app->put( '/user', function() use ( $user, $app, $login ) {
	$details = json_decode( $app->request->getBody(), true );
	echo json_encode($user->updateUserGeneral( $_SESSION['auth']['user_id'], $details, $login ));
});

/**
 * User profile
 */

$app->post( '/uploadPhoto', function() use ( $user, $app, $login ) {
    echo json_encode($user->uploadPhoto( $_SESSION['auth']['user_id'], $_FILES['photo'], $login ));
});

$app->post( '/uploadCover', function() use ( $user, $app, $login ) {
    echo json_encode($user->uploadCover( $_SESSION['auth']['user_id'], $_FILES['cover'], $login ));
});


/**
 * Login
 */

$app->post( '/login', function() use ( $app, $login ) {
    $body = json_decode($app->request->getBody());
	$email = $body[0]->value;
	$password = $body[1]->value;
    $status = $login->login( $email, $password );

    echo json_encode($status);
});

$app->post( '/logout', function() use ( $login ) {
    $login->logout();

    echo json_encode('');
});

$app->run();