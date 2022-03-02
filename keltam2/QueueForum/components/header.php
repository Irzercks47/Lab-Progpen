<nav>
    <div class="container">
        <span href="index.php">QueueForum</span>
        <?php
        if (isset($_SESSION['user_id'])) {
        ?>
            <a href="index.php">Home</a>
            <a href="mydiscussion.php">My Discussion</a>
            <a href="opendiscussion.php">Open Discussion</a>
            <a href="auth/auth.php?action=logout">Logout</a>
        <?php
        } else {
        ?>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        <?php
        }
        ?>
    </div>
</nav>