<h1 class="mt-4">Posts</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Lista de publicaciones</li>
</ol>
<div class="row">
    <div class="col-md-12 mb-4">
        <a href="index.php?posts_add" class="btn btn-primary">+ Agregar posts</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <?php show_msg(); ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cat ID</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Fecha</th>
                    <th>Imagen</th>
                    <th>Contenido</th>
                    <th>TAGS</th>
                    <th>Vistas</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php posts_show_admin(); ?>
                <!-- <tr>
                    <td>1</td>
                    <td>1</td>
                    <td>Curso PHP</td>
                    <td>Eduardo</td>
                    <td>2020-08-10</td>
                    <td><img src="../img/01.png" alt="" style="width: 150px;"></td>
                    <td>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Expedita, eligendi?</td>
                    <td>tags</td>
                    <td>1500</td>
                    <td>publicado</td>
                    <td>
                        <a href="#" class="btn btn-success">editar</a>
                    </td>
                    <td>
                        <a href="index.php?posts&delete={$row['post_id']}" class="btn btn-danger">borrar</a>
                    </td>
                </tr> -->
            </tbody>
        </table>
    </div>
</div>
<?php
    if(isset($_GET['delete'])){
        $delete_id = escape_string(trim($_GET['delete']));
        $query = query("DELETE FROM posts WHERE post_id = {$delete_id}");
        confirm($query);
        set_msg(display_success_msg("Publicación borrada exitosamente!!!"));
        redirect("index.php?posts");
    }
?>
<script type="text/javascript">
    $(document).ready(function(){
        $('.delete_link').on('click', function(){
            var id = $(this).attr('rel');
            var delete_url = "index.php?posts&delete=" + id + "";
            $('.modal-title').html("Borrar publicaciones");
            $('.modal-body').html("¿Estas seguro de borrar esta publicación?");
            $('.modal_delete_link').attr("href", delete_url);


            $('#exampleModal').modal('show');
        })
    })
</script>