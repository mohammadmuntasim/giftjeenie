<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

function giftj_add_social_friend(Request $request, Response $response)
{
    $body = $request->getParsedBody();
    $headers = $request->getHeaders();
    
    $user_id = $body['user_id'];

    $db = new Database();

    $data = $db->addSocialFriend($friend, $user_id, $headers['PHP_AUTH_USER'][0]);

    return $response->withJson($data, 200);
}

function giftj_list_social_friends(Request $request, Response $response)
{
    $headers = $request->getHeaders();

    $user_id = $headers['PHP_AUTH_USER'][0];

    $db = new Database();

    $data = $db->listSocialFriends($user_id);

    return $response->withJson($data, 200);
}

function giftj_search_social_friend(Request $request, Response $response)
{
    // echo "Hie";exit;
   $body = $request->getParsedBody();

    $headers = $request->getHeaders();
    
    $email = $body['email'];
// var_dump($email);exit;
    $db = new Database();

    $data = $db->searchSocialFriend($email, $headers['PHP_AUTH_USER'][0]);

    return $response->withJson($data, 200);
}

function giftj_add_friend(Request $request, Response $response)
{
    $body = $request->getParsedBody();
    $headers = $request->getHeaders();
    
    $user_id = $body['user_id'];

    $friend_id = $body['friend_id'];

    $db = new Database();

    $data = $db->addFriend($user_id, $friend_id, $headers['PHP_AUTH_USER'][0]);

    return $response->withJson($data, 200);
}

function giftj_delete_friends(Request $request, Response $response)
{
    $user_id = $request->getAttribute('id');
    $headers = $request->getHeaders();
    
    
    if (strpos($user_id, ',') !== false) {
        $user_id = explode(',', $user_id);
    }

    $db = new Database();

    $data = $db->deleteFriend($user_id, $headers['PHP_AUTH_USER'][0]);

    return $response->withJson($data, 200);
}

function giftj_list_friends(Request $request, Response $response)
{
    $headers = $request->getHeaders();

    $user_id = $headers['PHP_AUTH_USER'][0];

    $db = new Database();

    $data = $db->listFriends($user_id);

    return $response->withJson($data, 200);
}
