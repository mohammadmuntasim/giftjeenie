<?php

$app->post( '/message', 'giftj_message_create' )->add($auth);

$app->get( '/message/{id:[0-9]+}', 'giftj_message_get' )->add($auth);

$app->get( '/message/gift/{gid:[0-9]+}', 'giftj_message_get_gift' )->add($auth);

$app->delete('/message/{id:[0-9]+}', 'giftj_message_delete')->add( $auth );