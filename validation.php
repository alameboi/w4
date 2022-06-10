<?php
function usernameTaken(Database $db, $username, $id = 0): bool {
    $data = $db->getData("SELECT * FROM users WHERE username = '$username' AND id <> $id");

    if (count($data) > 0) {
        return true;
    }
    return false;
}

function emailTaken(Database $db, $username, $id = 0): bool {
    $data = $db->getData("SELECT * FROM users WHERE email='$email' AND id <> $id");

    if (count($data) > 0) {
        return true;
    }
    return false;
}
