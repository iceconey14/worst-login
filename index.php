<?php
// if you want to make this the best login system in the world, feel free to.
$db = new PDO("sqlite:users.db");
$db->exec("CREATE TABLE IF NOT EXISTS users (username TEXT, password TEXT)");

if (isset($_GET['action']) && $_GET['action'] === 'signup') {
  
    if (rand(1, 5) === 1) {
        $db->exec("INSERT INTO users (username, password) VALUES ('{$_POST['user']}', '{$_POST['pass']}')");
        echo "you're lucky! now gamble on logging in.";
    } else {
        echo "the sign up failed, lulz try again";
    }
}
elseif (isset($_GET['action']) && $_GET['action'] === 'login') {
    if (rand(1, 5) === 1) {
        $stmt = $db->query("SELECT * FROM users WHERE username = '{$_POST['user']}' AND password = '{$_POST['pass']}'");
        if ($stmt && $stmt->fetch()) {
            echo "logged in as " . htmlspecialchars($_POST['user']) . "!<br>";
            echo "<a href='?auth=yes&user=" . urlencode($_POST['user']) . "'>go to secret page</a>";
        } else {
            echo "wrong creds. (or not, idk)";
        }
    } else {
        echo "da login failed. try your luck again";
    }
}
?>

<h1>the worst login system in the world (or call it login system russian roulette)</h1>
<p>you have a 1 in 5 chance to login or signup</p>
<h2>sign up</h2>
<form action="?action=signup" method="post">
    username: <input name="user"><br>
    password: <input name="pass"><br>
    <button>try your luck signing up</button>
</form>

<h2>Log In</h2>
<form action="?action=login" method="post">
    Username: <input name="user"><br>
    Password: <input name="pass"><br>
    <button>try your luck logging in</button>
</form>
