<?php

//echo json_encode( $_POST );

//echo json_encode( $_FILES );
//header('Content-Type: application/json');

$arr = array_merge( $_POST, $_FILES );

echo json_encode( $_POST );
