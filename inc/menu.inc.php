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
        --><li><a href="index.php?controller=back&method=showLoginForm">login</a></li><!--
        --><li><a href="index.php?controller=back&method=showCreateAccountForm">create an account</a></li>
        <?php if(isset($_SESSION)): ?>
        <li><a href="index.php?controller=back&method=logout">Disconnect</a></li>
        <?php endif; ?>
    </ul>
</nav>


