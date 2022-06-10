<?php
echo "<a href='add'>Add</a><br/><br/>";

//foreach (array_reverse($usersData) as $userData) {
//    echo $view->renderTemplate('user.php', ['userData' => $userData]);
//}


foreach ($usersData as $userData) {
    $id = $userData->id; 
    echo $id.' '.$userData->username.' '.$userData->name.' '.$userData->email." <a href='edit/$id'>Edit</a> <a href='delete/$id'>Delete</a><br/>";   
}
