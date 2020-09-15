<h1 class="mt-4">Posts</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Agregar posts</li>
</ol>
<div class="row">
    <div class="col-md-4">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="post_titulo">Título</label>
                <input type="text" id="post_titulo" name="post_titulo" class="form-control">
            </div>
            <div class="form-group">
                <label for="post_cat_id">Categoria</label>
                <select name="post_cat_id" id="post_cat_id" class="form-control">
                    <?php
                        $query = query("SELECT * FROM categorias");
                        confirm($query);
                        while($row = fetch_array($query)){
                            ?>
                            <option value="<?php echo $row['cat_id']; ?>"><?php echo $row['cat_name']; ?></option>
                        <?php }
                    ?>
                    <!-- <option value="">Javascript</option> -->
                </select>
            </div>
            <div class="form-group">
                <label for="post_img">Imagen</label>
                <input type="file" name="post_img" id="post_img" class="form-control">
            </div>
            <div class="form-group">
                <label for="post_contenido">Contenido</label>
                <textarea name="post_contenido" id="post_contenido" cols="30" rows="5" class="form-control"></textarea>
            </div>
            <div class="fomr-group">
                <label for="post_tags">Tags</label>
                <input type="text" id="post_tags" name="post_tags" class="form-control">
            </div>
            <div class="form-group">
                <label for="post_status">Estatus</label>
                <select name="post_status" id="post_status" class="form-control">
                    <option value="Publicado">Publicado</option>
                    <option value="Pendiente">Pendiente</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" value="Guardar" name="guardar" class="btn btn-success">
            </div>
        </form>
        <?php post_add(); ?>
    </div>
</div>