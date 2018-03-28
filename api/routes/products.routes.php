<?php

$app->post( '/products', 'giftj_add_product')->add( $auth );

$app->get( '/products/{option:[a-zA-z]+}/limit/{limit:[0-9]+}/offset/{offset:[0-9]+}', 'giftj_get_products' )->add( $auth );

$app->get( '/products/{option:[a-zA-z]+}', 'giftj_get_products' )->add( $auth );

$app->get( '/products/{option:[a-zA-z]+}/category/{id:[0-9]+}/limit/{limit:[0-9]+}/offset/{offset:[0-9]+}', 'giftj_get_products_by_cat' )->add( $auth );

$app->get( '/products/{option:[a-zA-z]+}/category/{id:[0-9]+}', 'giftj_get_products_by_cat' )->add( $auth );

$app->get( '/products-datatable/{option:[a-zA-z]+}/category/{id:[0-9]+}', 'giftj_get_products_datatable_by_cat' )->add( $auth );

$app->get( '/products/{id:[0-9]+}', 'giftj_get_product' )->add( $auth );

$app->post( '/products/{id:[0-9]+}/update', 'giftj_product_update' )->add( $auth );

$app->delete( '/products/{id:[0-9]+}', 'giftj_product_delete' )->add( $auth );

$app->put( '/products/{id:[0-9]+}/trend_rating/{tr:[0-9]+}', 'giftj_product_update_trend' )->add( $auth );

$app->get( '/categories', 'giftj_product_categories' );