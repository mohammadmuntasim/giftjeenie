<?php

$app->post( '/user/register', 'giftj_user_register' );

$app->post( '/user/login', 'giftj_user_login' );

$app->post( '/user/loginexisting', 'giftj_user_loginExisting' );

$app->post( '/user/forgotpassword', 'giftj_user_forgotpassword');

$app->post( '/user/{id:[0-9]+}/changepassword', 'giftj_user_changepassword');

$app->post( '/user/logout', 'giftj_user_logout' )->add( $auth );

$app->get( '/users-datatable', 'giftj_users_info_datatable' )->add( $auth );

$app->get( '/users', 'giftj_users_info' )->add( $auth );

$app->get( '/user/{id:[0-9]+}', 'giftj_user_info' )->add( $auth );

$app->post( '/user/{id:[0-9]+}/update', 'giftj_user_update' )->add( $auth );

$app->delete( '/user/{id:[0-9]+}', 'giftj_user_delete' )->add( $auth );

$app->put( '/user/{id:[0-9]+}/product/{pid:[0-9]+}/addtograntlist', 'giftj_user_add_to_grant')->add( $auth );

$app->delete( '/user/{id:[0-9]+}/product/{pid:[0-9]+}/removefromgrantlist', 'giftj_user_remove_from_grant')->add( $auth );

$app->get( '/user/{id:[0-9]+}/grantlist', 'giftj_user_grantlist')->add( $auth );

$app->post('/user/{id:[0-9]+}/feedback', 'giftj_user_feedback')->add( $auth );

$app->get('/user/feedbacks', 'giftj_user_getfeedbacks')->add( $auth );  // modified on 13 Feb

$app->get( '/user/feedbacks/{fid:[0-9]+}', 'giftj_user_getfeedback')->add( $auth ); // modified on 13 Feb

$app->get( '/user/notifications', 'giftj_user_getnotifications')->add( $auth );

$app->get( '/user/notificationscount', 'giftj_user_getnotificationscount')->add( $auth );

$app->put( '/user/notifications/{nid:[0-9]+}', 'giftj_user_notification_markread')->add( $auth );

$app->delete( '/user/notifications/{nid:[0-9]+}', 'giftj_user_notification_clear')->add( $auth );

$app->put( '/user/{id:[0-9]+}/status', 'giftj_user_status_active')->add( $auth );

$app->delete( '/user/{id:[0-9]+}/status', 'giftj_user_status_inactive')->add( $auth );

$app->get( '/user/{id:[0-9]+}/status', 'giftj_user_status_get')->add( $auth );

$app->get( '/user/birthday', 'giftj_user_birthday_get');

// $app->get( '/user/{id:[0-9]+}/activate/{key}', 'giftj_user_activate' );

$app->post('/user/{id:[0-9]+}/address', 'giftj_user_address_add');

$app->post('/user/{id:[0-9]+}/categories', 'giftj_user_categories_add');

$app->get( '/user/faqs', 'giftj_user_getfaqs');

$app->post( '/user/search', 'giftj_user_search');