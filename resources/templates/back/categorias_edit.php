<?php
    if(isset($_GET['categorias']) && isset($_GET['edit'])){
        $cat_id = escape_string($_GET['edit']);
        $query = query("SELECT * FROM categorias WHERE cat_id = {$cat_id}");
        confirm($query);
        $row = fetch_array($query);
    }
?>
<hr>
<form action="" method="post">
    <div class="form-group">
        <label for="cat_name_edit">Editar Categoria</label>
        <input type="text" id="cat_name_edit" name="cat_name_edit" class="form-control" value="<?php echo $row['cat_name']; ?>" required>
    </div>
    <div class="form-group">
        <input type="submit" value="Editar" class="btn btn-success" name="editar">
    </div>
</form>

<?php categoria_edit($cat_id); ?>