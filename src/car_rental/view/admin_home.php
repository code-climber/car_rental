<h1>Admin page</h1>

<form method="post" action="index.php?controller=back&method=addCarForm" enctype="multipart/form-data">
    <Legend>Add a car</Legend>
    <label for="brand">Brand</label>
    <select name="brand"> 
        <?php foreach($aBrands as $row): ?>
        <option><?php echo $row['brand']; ?></option>
        <?php endforeach; ?>    
    </select>
    
    <label for="model">Model</label>
    <input type="text" name="model" id="model">
    
    <label for="color">Color</label>
    <input type="text" name="color" id="color">
    
    <label for="desc">Description</label>
    <input type="text" name="desc" id="desc">
    
    <label for="img">Image</label>
    <input type="file" name="img" id="img">
    
    <label for="category">Category</label>
    <input type="text" name="category" id="category">
    
    <input type="submit" value="add">
</form>

