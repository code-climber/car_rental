<?php if(!isset($_SESSION['pick-date'])): ?>
<h1>welcome</h1>
<?php endif; ?>

<section class="car-list">
    <div>
        <img src="<?php echo $oCar->getImage(); ?>">
        <span>
            <?php echo $oCar->getCategory(); ?>
        </span>
        <h1><?php echo $oCar->getBrand(); ?> <?php echo $oCar->getModel(); ?></h1>
        <div>
            <span>
                Starting from <?php echo $oCar->getPrice(); ?>
            </span>  
        </div>

        <div>
            <ul>
                <?php
                $aTags = array();
                foreach ($oCar->getTags() as $row) {
                    $aTags[] = $row['tag'];
                }
                for ($i = 0; $i < count($aTags); $i++) {
                    echo "<li>" . $aTags[$i] . "</li>";
                }
                ?>
            </ul>
        </div>

    </div>
    <div>
        <p><?php echo $oCar->getDescription(); ?></p>
    </div>
</section>

<section>
    
</section>

