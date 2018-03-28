<?php

$app->post('/deals/brands', 'giftj_deals_brands_create')->add($auth);

$app->get('/deals/brands', 'giftj_deals_brands_get')->add($auth);

$app->get('/deals/brands/{id:[0-9]+}', 'giftj_deals_brand_get')->add($auth);

$app->post('/deals/brands/{id:[0-9]+}', 'giftj_deals_brand_update')->add($auth);

$app->delete('/deals/brands/{id:[0-9]+}', 'giftj_deals_brands_delete')->add($auth);

$app->get('/deals', 'giftj_deals_get');

$app->post('/deals/brands/{id:[0-9]+}/add', 'giftj_deals_brands_add_item')->add($auth);
