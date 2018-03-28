<?php

$app->post( '/wishlist', 'giftj_create_wishlist' )->add( $auth ); // Create Wishlist ~

$app->get( '/wishlist', 'giftj_get_wishlists' )->add( $auth ); // Get All Wishlists for current user ~

$app->get( '/wishlist/group', 'giftj_get_group_wishlists' )->add( $auth ); // Get All Wishlists for current user ~

$app->get( '/wishlist/all', 'giftj_get_all_wishlists' )->add( $auth ); // Get All Wishlists ~

$app->get('/wishlist/user/{id:[0-9]+}', 'giftj_get_wishlists' )->add( $auth ); // Get All Wishlists for user with id = 1 ~

$app->get( '/wishlist/{id:[0-9]+}', 'giftj_get_wishlist' )->add( $auth ); // Get Wishlist with id = 1

$app->put( '/wishlist/{id:[0-9]+}/product/{pid:[0-9]+}', 'giftj_wishlist_add_product' )->add( $auth ); //Add Product to Wishlist with id = 1 ~

$app->delete( '/wishlist/{id:[0-9]+}/product/{pid:[0-9]+}', 'giftj_wishlist_remove_product' )->add( $auth ); //Remove Product from wishlist with id = 1 ~

$app->delete( '/wishlist/{id:[0-9]+}', 'giftj_delete_wishlist' )->add( $auth ); // Delete wishlist with id = 1 ~

$app->post( '/wishlist/share', 'giftj_wishlist_share' )->add($auth); // Share wishlist with user with id = 1 ~

$app->get( '/wishlist/sharedlist', 'giftj_get_wishlists_shared' )->add($auth); // Share wishlist with user with id = 1 ~

$app->put( '/wishlist/{id:[0-9]+}/product/{pid:[0-9]+}/claim', 'giftj_wishlist_mark_claim')->add( $auth );

$app->delete( '/wishlist/{id:[0-9]+}/product/{pid:[0-9]+}/claim', 'giftj_wishlist_unmark_claim')->add( $auth );

$app->put( '/wishlist/{id:[0-9]+}/product/{pid:[0-9]+}/grant', 'giftj_wishlist_mark_grant')->add( $auth );

$app->delete( '/wishlist/{id:[0-9]+}/product/{pid:[0-9]+}/grant', 'giftj_wishlist_unmark_grant')->add( $auth );

// $app->get( '/wishlist/user/{id:[0-9]+}/sharedby', 'giftj_get_wishlists_sharedby' )->add( $auth ); // Get All Wishlists shared by user with id = 1 ~

// $app->get( '/wishlist/user/{id:[0-9]+}/sharedwith', 'giftj_get_wishlists_sharedwith' )->add( $auth ); // Get All Wishlists shared with user with id = 1 ~

// $app->get( '/wishlist/sharedby', 'giftj_get_wishlists_sharedby' )->add( $auth ); // Get All Wishlists shared by current user ~

// $app->get( '/wishlist/sharedwith', 'giftj_get_wishlists_sharedwith' )->add( $auth ); // Get All Wishlists shared with current user ~

$app->get('/wishlist/recent', 'giftj_wishlist_recent');

$app->post( '/wishlist/recentinsert', 'giftj_wishlist_recentinsert' ); 

$app->post( '/wishlist/recentlist', 'giftj_wishlist_recent_list' ); 

$app->post( '/wishlist/recentdetails', 'giftj_wishlist_recent_details' ); 

$app->post( '/wishlist/addgroup', 'giftj_wishlist_add_group' ); 
