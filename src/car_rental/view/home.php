<h1>Find the best car for your trip !</h1>

<form method="post" action="index.php?controller=backController&method=searchCarForm">
    <div>
        <label for="pick-loc">pickup location</label>
        <select>
            <?php foreach ($aLocations as $oLoc): ?>
                <option><?php echo $oLoc->getLocation(); ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <label for="pick-date">Pickup date</label>
        <input type="text" id="datepicker" name="pick-date" class="datepicker">
        <select>
            <?php foreach ($aHours as $hour): ?>
                <option value="<?php echo $hour; ?>"><?php echo $hour ?></option>
            <?php endforeach; ?>
        </select>

        <span> : </span>

        <select>
            <option value="00">00</option>
            <option value="15">15</option>
            <option value="30">30</option>
            <option value="45">45</option>
        </select>
    </div>

    <div>
        <label for="drop-off-loc">drop off location</label>
        <select>
            <?php foreach ($aLocations as $oLoc): ?>
                <option><?php echo $oLoc->getLocation(); ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <label for="drop-date">drop off date</label>
        <input type="date" id="datepicker2" name="drop-date">
        <select>
            <?php foreach ($aHours as $hour): ?>
                <option value="<?php echo $hour; ?>"><?php echo $hour ?></option>
            <?php endforeach; ?>
        </select>

        <span> : </span>

        <select>
            <option value="00">00</option>
            <option value="15">15</option>
            <option value="30">30</option>
            <option value="45">45</option>
        </select>  
    </div>

    <div>
        <label>Category</label>
        <select>
            <?php foreach ($aCategories as $oCategory): ?>
                <option value="<?php echo $oCategory->getId(); ?>"><?php echo $oCategory->getCategory(); ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <input type="submit" value="find car">
    </div>



</form>

