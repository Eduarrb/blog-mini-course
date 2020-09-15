<?php
    if(isset($_GET['posts_edit'])){
        $id = escape_string(trim($_GET['posts_edit']));
        // echo $id;
        $query = query("SELECT * FROM posts WHERE post_id = {$id}");
        confirm($query);
        $row = fetch_array($query);

        // print_r($row);
    }
?>

<h1 class="mt-4">Posts</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Editar publicaciones</li>
</ol>
<div class="row">
    <div class="col-md-4">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="post_titulo">Título</label>
                <input type="text" id="post_titulo" name="post_titulo" class="form-control" value="<?php echo $row['post_titulo']; ?>">
            </div>
            <div class="form-group">
                <label for="post_cat_id">Categoria</label>
                <select name="post_cat_id" id="post_cat_id" class="form-control">
                    <?php
                        $query = query("SELECT * FROM categorias");
                        confirm($query);
                        while($row_categoria = fetch_array($query)){
                            $cat_id = $row_categoria['cat_id'];
                            $cat_name = $row_categoria['cat_name'];

                            // echo $cat_name;
                            if($cat_id == $row['post_cat_id']){
                                echo "<option value='{$cat_id}' selected>{$cat_name}</option>";
                            }
                            else{
                                echo "<option value='{$cat_id}'>{$cat_name}</option>";
                            }
                        }
                        
                    ?>
                    <!-- <option value="">Javascript</option> -->
                </select>
            </div>
            <div class="form-group">
                <label for="post_img">Imagen</label>
                <br>
                <img src="../img/<?php echo $row['post_img']; ?>" alt="" style="width: 350px;" class="mb-2">
                <input type="file" name="post_img" id="post_img" class="form-control">
            </div>
            <div class="form-group">
                <label for="post_contenido">Contenido</label>
                <textarea name="post_contenido" id="post_contenido" cols="30" rows="5" class="form-control"><?php echo $row['post_contenido']; ?></textarea>
            </div>
            <div class="fomr-group">
                <label for="post_tags">Tags</label>
                <input type="text" id="post_tags" name="post_tags" class="form-control" value="<?php echo $row['post_tags']; ?>">
            </div>
            <div class="form-group">
                <label for="post_status">Estatus</label>
                <select name="post_status" id="post_status" class="form-control">
                    <option value="<?php echo $row['post_status']; ?>"><?php echo $row['post_status']; ?></option>
                    <?php
                        if($row['post_status'] == 'publicado'){
                            ?>
                            <option value="pendiente">pendiente</option>
                        <?php }
                        else{
                            ?>
                            <option value="publicado">publicado</option>
                        <?php }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" value="Editar" name="guardar" class="btn btn-success">
            </div>
        </form>
        <?php post_edit($id); ?>
    </div>
</div>