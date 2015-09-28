<h1>Find the best car for your trip !</h1>

<?php if(isset($aShowErrorMsg)): ?>
<div class="error-form">
    <?php foreach ($aShowErrorMsg as $error): ?>
    <span><?php echo $error; ?></span>
    <?php endforeach; ?>
</div>
<?php endif; ?>
<form method="post" action="index.php?controller=front&method=searchCarForm">
    <div>
        <label for="pick-loc">pickup location</label>
        <select name="pick-loc" id="pick-loc">
            <?php foreach ($aLocations as $oLoc): ?>
                <option value="<?php echo $oLoc->getIdLocation(); ?>"><?php echo $oLoc->getLocation(); ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <label for="pick-date">Pickup date</label>
        <input type="text" id="datepicker" name="pick-date" class="datepicker">
        <select name="pick-hour">
            <?php foreach ($aHours as $hour): ?>
                <option value="<?php echo $hour; ?>"><?php echo $hour ?></option>
            <?php endforeach; ?>
        </select>

        <span> : </span>

        <select name="pick-quarter">
            <option value="00">00</option>
            <option value="15">15</option>
            <option value="30">30</option>
            <option value="45">45</option>
        </select>
    </div>

    <div>
        <label for="drop-off-loc">drop off location</label>
        <select name="drop-off-loc">
            <?php foreach ($aLocations as $oLoc): ?>
                <option value="<?php echo $oLoc->getIdLocation(); ?>"><?php echo $oLoc->getLocation(); ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <label for="drop-date">drop off date</label>
        <input type="date" id="datepicker2" name="drop-date">
        <select name="drop-hour">
            <?php foreach ($aHours as $hour): ?>
                <option value="<?php echo $hour; ?>"><?php echo $hour ?></option>
            <?php endforeach; ?>
        </select>

        <span> : </span>

        <select name="drop-quarter">
            <option value="00">00</option>
            <option value="15">15</option>
            <option value="30">30</option>
            <option value="45">45</option>
        </select>  
    </div>

    <div>
        <label>Category</label>
        <select name="category">
            <?php foreach ($aCategories as $oCategory): ?>
                <option value="<?php echo $oCategory->getId(); ?>"><?php echo $oCategory->getCategory(); ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <input type="submit" value="find car">
    </div>



</form>

