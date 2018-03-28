<?php

$app->post('/friends', 'giftj_add_friend');

$app->get('/friends', 'giftj_list_friends');

$app->delete('/friends/{id:[0-9]+}', 'giftj_delete_friends');

$app->get('/friends/social', 'giftj_list_social_friends')->add($auth);

$app->post('/friends/addSocial', 'giftj_add_social_friend');

$app->post('/friends/searchsocial', 'giftj_search_social_friend');