<h1>Admin Connexion</h1>
<?php // if($bLoginError){ ?>
<p>
    <!--<strong>Sorry, impossible to connect. Please verify your login and password.</strong>-->
</p>
<?php // } ?>
<form method="post" action="index.php?controller=back&method=login">
    <label for="login">Login</label>
    <input type="text" name="login" id="login">
    <label for="passwd">Password</label>
    <input type="text" name="passwd" id="passwd">
    <input type="submit" value="Send" name="connect">
</form>

