<section>
    <div class="front-page">
        <h1>Our Car List For you</h1>
    </div>
</section>

<section class="car-list">
    <?php foreach ($aCars as $oCar): ?>
        <div>
            <span><?php echo "STARTING FROM " . $oCar->getPrice() . "&euro;"; ?></span>
            <img src="<?php echo $oCar->getImage(); ?>" alt="<?php echo $oCar->getImage(); ?>">
            <h2><?php echo $oCar->getCategory() . " " . $oCar->getBrand() . " " . $oCar->getModel(); ?></h2>
            <p><?php echo $oCar->getDescription(); ?>
                <br>
                <span><a href="index.php?controller=front&method=showOneCar&idCar=<?php echo $oCar->getId(); ?>" <i class="fa fa-angle-double-right"></i>>
                        View Details</a>
                </span>
                <?php
                $aTags = $oCar->getTags();
                ?>
                <span class="tags">
                    <?php
                    $result = array();
                    foreach ($aTags as $tag) {
                        $result[] = $tag['tag'];
                    }
                    echo implode(" | ", $result);
                    ?>
                </span>
            <div class="clear"></div>
            </p>



        </div>
        <div class="clear"></div>
    <?php endforeach; ?>
</section>

