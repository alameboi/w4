<?php
return array (
    '/users' => 'users/viewAll',
    '/add' => 'users/add',
    '/edit/([0-9]+)' => 'users/edit/$1',
    '/delete/([0-9]+)' => 'users/delete/$1',
);