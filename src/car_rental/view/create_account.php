<?php if(isset($aShowErrors)): ?>
<div class="error-form">
    <?php foreach($aShowErrors as $error): ?>
    <span><?php echo $error; ?></span>
    <?php endforeach; ?>
</div>
<?php endif; ?>


<form method="post" action="index.php?controller=back&method=createAccount">
    <div>
        <label>first name:</label>
        <input type="text" id="first-name" name="first-name">
    </div>

    <div>
        <label>last name</label>
        <input type="text" id="last-name" name="last-name">
    </div>

    <div>
        <label>login:</label>
        <input type="text" id="login" name="login">
    </div>

    <div>
        <label>password:</label>
        <input type="password" id="password" name="password">
    </div>

    <div>
        <label>confirm password:</label>
        <input type="password" id="conf-password" name="conf-password">
    </div>

    <div>
        <label>email:</label>
        <input type="email" id="email" name="email">
    </div>

    <div>
        <label>confirm email:</label>
        <input type="email" id="conf-email" name="conf-email">
    </div>

    <div>
        <input type="submit" value="create an account">
    </div>
</form>


