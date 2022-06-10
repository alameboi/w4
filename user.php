<?php
$id = $userData->id; 
echo $id.' '.$userData->username.' '.$userData->name.' '.$userData->email." <a href='edit/$id'>Edit</a> <a href='delete/$id'>Delete</a><br/>";    
