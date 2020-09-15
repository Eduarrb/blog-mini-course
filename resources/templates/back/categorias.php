<h1 class="mt-4">Categorias</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Categorias</li>
</ol>
<div class="row">
    <div class="col-md-6">
        <div>
            <!-- <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> -->
            <?php show_msg(); ?>
        </div>
        <?php categoria_add(); ?>
        <form action="" method="post">
            <div class="form-group">
                <label for="cat_name">Agregar Categoria</label>
                <input type="text" class="form-control" name="cat_name" id="cat_name" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Agregar Categoria" class="btn btn-primary" name="guardar">
            </div>
        </form>

        <?php 
            if(isset($_GET['edit'])){
                include(TEMPLATE_BACK . DS . "categorias_edit.php");
            }

            if(isset($_GET['delete'])){
                $id_delete = escape_string(trim($_GET['delete']));
                // echo $id_delete;
                $query = query("DELETE FROM categorias WHERE cat_id = {$id_delete}");
                confirm($query);
                set_msg(display_success_msg('Categoria borrada exitosamente!!'));
                redirect("index.php?categorias");
            }
        ?>

    </div>
    <div class="col-md-6">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre Categoria</th>
                </tr>
            </thead>
            <tbody>
                <?php categorias_show(); ?>
                <!-- <tr>
                    <td>1</td>
                    <td>C#</td>
                    <td><a href="#" class="btn btn-success">editar</a></td>
                    <td><a href="#" class="btn btn-danger">borrar</a></td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>C#</td>
                    <td><a href="#" class="btn btn-success">editar</a></td>
                    <td><a href="#" class="btn btn-danger">borrar</a></td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>C#</td>
                    <td><a href="#" class="btn btn-success">editar</a></td>
                    <td><a href="#" class="btn btn-danger">borrar</a></td>
                </tr> -->
            </tbody>
        </table>
    </div>
</div>