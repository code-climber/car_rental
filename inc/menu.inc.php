<nav>
    <ul id="scroll-menu">
        <li><a href="index.php?controller=front&method=home">Home</a></li><!--
        --><li> <a href="#">Choose cars</a>
            <ul>
                <li><a href="index.php?controller=front&method=showCarsList">Cars List</a></li>
                <li><a href="#">Locations List</a></li> 
                <li><a href="#">Search Form</a></li> 
            </ul>
        </li><!--
        --><li><a href="index.php?controller=front&method=map">Find Us</a></li><!--
        --><?php if(!array_key_exists('role', $_SESSION)): ?><!--
        --><li><a href="index.php?controller=back&method=showLoginForm">login</a></li><!--
        --><li><a href="index.php?controller=back&method=showCreateAccountForm">create an account</a></li><!--
        --><?php endif; if(array_key_exists('role', $_SESSION) && $_SESSION['role'] == 1): ?><!--
        --><li><a href="index.php?controller=back&method=home">Admin</a></li>
        <?php endif; if(array_key_exists('role',$_SESSION)): ?><!--
        --><li><a href="index.php?controller=back&method=logout">Disconnect</a></li>
        <?php endif; ?>
    </ul>
</nav>


