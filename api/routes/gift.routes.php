<?php

$app->post( '/gift', 'giftj_gift_give' )->add($auth);

$app->get( '/gift/given', 'giftj_gift_given' )->add($auth);

$app->get( '/gift/user/{id:[0-9]+}/given', 'giftj_gift_given' )->add($auth);

$app->get( '/gift/received', 'giftj_gift_received' )->add( $auth );

$app->get( '/gift/user/{id:[0-9]+}/received', 'giftj_gift_received' )->add( $auth );

$app->get( '/gift/{id:[0-9]+}', 'giftj_gift_get' )->add($auth);

$app->post( '/gift/{id:[0-9]+}/deliverydate', 'giftj_gift_update_delivery_details' )->add($auth);

$app->post( '/gift/{id:[0-9]+}/orderdetails', 'giftj_gift_update_order_details' )->add($auth);

$app->get( '/gift/categories', 'giftj_gift_categories' )->add($auth);