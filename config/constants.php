<?php
define('ENTITY_MESSAGE','Message');
define('ENTITY_USER','User');
const USER_PERMISSIONS= [
    'message_view' => [0b00000001,'Message View'],
    'message_reply' =>[0b00000010,'Message Reply'],
    'message_delete'=>[0b00000100,'Message Delete'],
    'user_view'=>    [0b00001000,'User View'],
    'user_edit'=>    [0b00010000,'User Edit'],
    'user_delete'=>  [0b00100000,'User Delete'],
];