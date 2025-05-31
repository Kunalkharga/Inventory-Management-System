<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database and session initialization
require_once('includes/load.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addUser'])) {
    $errors = [];

    // Validate required fields
    if (empty($_POST['Name']) || empty($_POST['email']) || empty($_POST['username']) || empty($_POST['password']) || empty($_POST['level'])) {
        $errors[] = "All fields are required.";
    }

    if (empty($errors)) {
        // Sanitize inputs
        $name = remove_junk($db->escape($_POST['Name']));
        $username = remove_junk($db->escape($_POST['username']));
        $email = remove_junk($db->escape($_POST['email']));
        $password = remove_junk($db->escape($_POST['password']));
        $user_level = (int)$db->escape($_POST['level']);

        // Hash password
        $password = sha1($password);

        // SQL query
        $query = "INSERT INTO users (name, username, password, user_level, status, email) VALUES (";
        $query .= "'{$name}', '{$username}', '{$password}', '{$user_level}', '1', '{$email}')";
        
        if ($db->query($query)) {
            $session->msg('s', "User account has been created!");
            redirect('add_user.php', false);
        } else {
            echo "Database Error: " . $db->error; // Show database error
            $session->msg('d', 'Sorry, failed to create account!');
            redirect('add_user.php', false);
        }
    } else {
        foreach ($errors as $error) {
            echo "<p style='color: red;'>{$error}</p>";
        }
    }
}
?>