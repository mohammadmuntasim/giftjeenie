<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

function giftj_trends_lists_create(Request $request, Response $response)
{
    $body = $request->getParsedBody();
    $headers = $request->getHeaders();

    if (isset($body['list_name'])) {
        $name = $body['list_name'];
    } else {
        $data = array( 'error' => 'List Name not provided.' );
        return $response->withJson($data, 422);
    }

    if (isset($_FILES["list_image"]["tmp_name"])) {
        if ($check = getimagesize($_FILES["list_image"]["tmp_name"])) {
            move_uploaded_file($_FILES["list_image"]["tmp_name"], dirname(__DIR__) . '/uploads/lists/' . $_FILES['list_image']['name']);
            $image = 'http://' . $_SERVER['HTTP_HOST'] . '/api/uploads/lists/' . $_FILES['list_image']['name'];
        }
    } elseif (isset($body['list_image'])) {
        $img = array();

        $image = $body['list_image'];
    } else {
        $data = array( 'error' => 'List Image not provided.' );
        return $response->withJson($data, 422);
    }

    if (isset($body['list_gradient_id'])) {
        $gradient_id = $body['list_gradient_id'];
    } else {
        $data = array( 'error' => 'List Gradient not provided.' );
        return $response->withJson($data, 422);
    }


    $img = array();

    $size = getimagesize($image);

    $img['url'] = $image;
    $img['width'] = $size[0];
    $img['height'] = $size[1];
    
    $db = new Database();

    $data = $db->createList($name, $img, $gradient_id, $headers['PHP_AUTH_USER'][0]);

    return $response->withJson($data, 200);
}

function giftj_trends_list_update(Request $request, Response $response)
{
    $body = $request->getParsedBody();
    $headers = $request->getHeaders();
    $list_id = $request->getAttribute('id');


    if (isset($body['list_name'])) {
        $name = $body['list_name'];
    } else {
        $data = array( 'error' => 'List Name not provided.' );
        return $response->withJson($data, 422);
    }

    if (isset($_FILES["list_image"]["tmp_name"])) {
        if ($check = getimagesize($_FILES["list_image"]["tmp_name"])) {
            move_uploaded_file($_FILES["list_image"]["tmp_name"], dirname(__DIR__) . '/uploads/lists/' . $_FILES['list_image']['name']);
            $image = 'http://' . $_SERVER['HTTP_HOST'] . '/api/uploads/lists/' . $_FILES['list_image']['name'];
        }
    } elseif (isset($body['list_image'])) {
        $img = array();

        $image = $body['list_image'];
    } else {
        $data = array( 'error' => 'List Image not provided.' );
        return $response->withJson($data, 422);
    }

    if (isset($body['list_gradient_id'])) {
        $gradient_id = $body['list_gradient_id'];
    } else {
        $data = array( 'error' => 'List Gradient not provided.' );
        return $response->withJson($data, 422);
    }


    $img = array();

    $size = getimagesize($image);

    $img['url'] = $image;
    $img['width'] = $size[0];
    $img['height'] = $size[1];
    
    $db = new Database();

    $data = $db->updateList($list_id, $name, $img, $gradient_id, $headers['PHP_AUTH_USER'][0]);

    return $response->withJson($data, 200);
}


function giftj_trends_get(Request $request, Response $response)
{
    $db = new Database();

    $data = $db->getTrends();

    return $response->withJson($data, 200);
}

function giftj_trends_lists_add_item(Request $request, Response $response)
{
    $body = $request->getParsedBody();

    $product_id = $body['product_id'];
    if (strpos($product_id, ',') !== false) {
        $product_id = explode(',', $product_id);
    }
    $list_id = $request->getAttribute('id');

    $db = new Database();
    
    $data = $db->addProductToList($product_id, $list_id);

    return $response->withJson($data, 200);
}

function giftj_trends_lists_get(Request $request, Response $response)
{
    $body = $request->getParsedBody();
    $draw = $body['draw'];

    $db = new Database();

    $data = $db->getLists();
    $data['draw'] = $draw;

    return $response->withJson($data, 200);
}

function giftj_trends_list_get(Request $request, Response $response)
{
    $body = $request->getParsedBody();
    $list_id = $request->getAttribute('id');
    
    $db = new Database();

    $data = $db->getList($list_id);
    $data['draw'] = $body['draw'];

    return $response->withJson($data, 200);
}

function giftj_trends_lists_delete(Request $request, Response $response)
{
    $list_id = $request->getAttribute('id');
    $db = new Database();

    $data = $db->deleteList($list_id);

    return $response->withJson($data, 200);
}

function giftj_trends_lists_gradients_get( Request $request, Response $response )
{
    $db = new Database();

    $data = $db->getGradients();

    return $response->withJson($data, 200);
}