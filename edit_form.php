<form method="POST" action="" name="edit_form">
    <table>
        <tr>
            <td>Username</td>
            <td><input type="text" name="username" value=<?php echo $userData->username;?>></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" name="password" value=<?php echo $userData->password;?>></td>
        </tr>
        <tr>
            <td>Name</td>
            <td><input type="text" name="name" value=<?php echo $userData->name;?>></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="text" name="email" value=<?php echo $userData->email;?>></td>
        </tr>
        <tr>
            <td><input type="hidden" name="id" value=<?php echo $userData->id;?>></td>
            <td><input type="submit" name="edit" value="Edit"></td>
        </tr>
    </table>
</form>