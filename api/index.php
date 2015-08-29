<?php

session_start();

// Get the Slim framework
require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();

// Create new object of Slim
$app = new \Slim\Slim();

// Set the HTTP Header of the Content-Type (MIME Type) to be JSON
$app->contentType( 'application/json' );

require_once dirname( __FILE__ ) . '/../lib/DB.class.php';

// Get the class that controls all the users functions
require_once dirname( __FILE__ ) . '/../core/Users.class.php';
$user = new User();

// Get the class that controls all the posts functions
require_once dirname( __FILE__ ) . '/../core/Post.class.php';
$post = new Post();

// Get the class that controls all the friends functions
require_once dirname( __FILE__ ) . '/../core/Friends.class.php';
$friend = new Friends();

// Get the class that controls all the login functions
require_once dirname( __FILE__ ) . '/../core/Login.class.php';
$login = new Login();

/**
 * User
 */

$app->get( '/users', function() use ( $user ) {
	$user_list = $user->getAllUsers();
	echo json_encode( $user_list );
});

$app->get( '/user/:id', function( $id ) use ( $user ) {
	echo json_encode( $user->getUserById( $id ) );
});

$app->post( '/user', function() use ( $user, $app, $login ) {
	$user_details = $app->request->getBody();
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

$app->put( '/changePassword', function() use ( $user, $app ) {
    $passwords = json_decode( $app->request->getBody(), true );
    echo json_encode($user->changePassword( $_SESSION['auth']['user_id'], $passwords ));
});

/**
 * Posts
 */

$app->get( '/posts/:type/:user_id/:offset/:limit', function($type, $user_id, $offset, $limit) use ( $post, $app ) {
    echo json_encode($post->getPosts( $type, $user_id, null, $offset, $limit ));
});

$app->get( '/post/:id', function($id) use ( $post ) {
    echo json_encode($post->getPostById( $id ));
});

$app->post( '/post', function() use ( $post, $app ) {
    $data = json_decode( $app->request->getBody() );
    echo json_encode($post->publishPost( $_SESSION['auth']['user_id'], $data->friend_id, $data->content ));
});

$app->delete( '/post', function() use ( $post, $app ) {
    $post_id = json_decode( $app->request->getBody() );
    echo json_encode($post->deletePost( $_SESSION['auth']['user_id'], $post_id ));
});

/**
 * Posts - Like
 */

$app->put( '/post/like', function() use ( $post, $app ) {
    $post_id = json_decode( $app->request->getBody() );
    echo json_encode($post->likePost( $_SESSION['auth']['user_id'], $post_id ));
});

$app->put( '/post/unlike', function() use ( $post, $app ) {
    $post_id = json_decode( $app->request->getBody() );
    echo json_encode($post->unlikePost( $_SESSION['auth']['user_id'], $post_id ));
});

/**
 * Posts - comment
 */

$app->get( '/post/comments/:post_id/:offset/:limit', function($post_id, $offset, $limit) use ( $post ) {
    echo json_encode([$post_id => $post->getComments($post_id, $offset, $limit)]);
});

$app->post( '/post/comment', function() use ( $post, $app ) {
    $data = json_decode( $app->request->getBody() );
    echo json_encode($post->publishComment( $_SESSION['auth']['user_id'], $data->post_id, $data->content ));
});

/**
 * Friends
 */

$app->post( '/friend', function() use ( $friend, $app ) {
    $data = json_decode( $app->request->getBody() );
    echo json_encode($friend->addFriend( $_SESSION['auth']['user_id'], $data->friend_id ));
});

$app->delete( '/friend', function() use ( $friend, $app ) {
    $data = json_decode( $app->request->getBody() );
    echo json_encode($friend->deleteFriend( $_SESSION['auth']['user_id'], $data->friend_id ));
});

$app->delete( '/friends', function() use ( $friend, $app ) {
    $data = json_decode( $app->request->getBody() );
    echo json_encode($friend->deleteFriends( $_SESSION['auth']['user_id'], $data->friends_to_remove ));
});

/**
 * Notifications
 */

$app->get( '/notifications/:type/:offset/:limit', function($type, $offset, $limit) use ( $friend ) {
    echo json_encode($friend->getNotifications($type, $offset, $limit));
});

/**
 * Login
 */

$app->post( '/login', function() use ( $app, $login, $user ) {
    $body = json_decode($app->request->getBody());
	$email = $body[0]->value;
	$password = $body[1]->value;
    $status = $login->login( $email, $password, $user );

    echo json_encode($status);
});

$app->post( '/logout', function() use ( $login ) {
    $login->logout();

    echo json_encode('');
});

$app->run();