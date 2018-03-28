<?php

$app->post('/trends/lists', 'giftj_trends_lists_create')->add($auth);

$app->get('/trends/lists', 'giftj_trends_lists_get')->add($auth);

$app->get('/trends/lists/{id:[0-9]+}', 'giftj_trends_list_get')->add($auth);

$app->post('/trends/lists/{id:[0-9]+}', 'giftj_trends_list_update')->add($auth);

$app->delete('/trends/lists/{id:[0-9]+}', 'giftj_trends_lists_delete')->add($auth);

$app->get('/trends', 'giftj_trends_get');

$app->post('/trends/lists/{id:[0-9]+}/add', 'giftj_trends_lists_add_item')->add($auth);

$app->get('/trends/lists/gradients', 'giftj_trends_lists_gradients_get')->add($auth);