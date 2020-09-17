<?php

    /* VARIABLES */
    $meses = [
        'enero',
        'febrero',
        'marzo',
        'abril',
        'mayo',
        'junio',
        'julio',
        'agosto',
        'setiembre',
        'octubre',
        'noviembre',
        'diciembre'
    ];
    /***********************************/



    /* FUNCIONES BASE */
    function query($sql){
        global $conexion;
        return mysqli_query($conexion, $sql);
    }

    function fetch_array($query){
        return mysqli_fetch_array($query);
    }

    function confirm($query){
        global $conexion;
        if(!$query){
            die("Fallo en la conexion " . mysqli_error($conexion));
        }
    }

    function escape_string($string){
        global $conexion;
        return mysqli_real_escape_string($conexion, $string);
    }

    function redirect($location){
        header("Location: $location");
    }

    function set_msg($msg){
        if(!empty($msg)){
            $_SESSION['mensaje'] = $msg;
        }
        else{
            $msg = "";
        }
    }

    function show_msg(){
        if(isset($_SESSION['mensaje'])){
            echo $_SESSION['mensaje'];
            unset($_SESSION['mensaje']);
        }
    }

    function display_success_msg($msg){
        $msg = <<<DELIMITADOR
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Holy guacamole!</strong> $msg
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
DELIMITADOR;
        return $msg;
    }
    /******************************************/



    /* FUNCIONES FRONT */

    function posts_show(){
        $query = query("SELECT * FROM posts WHERE post_status = 'publicado' ORDER BY post_id DESC");
        confirm($query);
        while($row = fetch_array($query)){
            $posts = <<<DELIMITADOR
                <div class="card mb-4">
                    <img class="card-img-top" src="img/{$row['post_img']}" alt="Card image cap">
                    <div class="card-body">
                        <h2 class="card-title">{$row['post_titulo']}</h2>
                        <p class="card-text">{$row['post_contenido']}</p>
                        <a href="post.php?id={$row['post_id']}" class="btn btn-primary">Leer más &rarr;</a>
                    </div>
                    <div class="card-footer text-muted">
                        Publicado el {$row['post_fecha']} por
                        <a href="#">Eduardo</a>
                    </div>
                </div>
DELIMITADOR;
            echo $posts;
        }    
    }

    function posts_show_one($id){
        $query = query("SELECT * FROM posts WHERE post_id = {$id}");
        confirm($query);
        $row = fetch_array($query);
        $html = <<<DELIMITADOR
            <h1 class="mt-4">{$row['post_titulo']}</h1>
            <p class="lead">
            por
            <a href="#">Eduardo Arroyo</a>
            </p>
            <hr>

            <div class="d-flex justify-content-between">
                <p>Publicado el {$row['post_fecha']}</p>
                <div>
                    <i class="fas fa-eye"></i>
                    {$row['post_vistas']} vistas
                </div>
            </div>

            <hr>
            <img class="img-fluid rounded" src="img/{$row['post_img']}" alt="{$row['post_titulo']}">
            <hr>
            <p class="lead">{$row['post_contenido']}</p>

DELIMITADOR;
        echo $html;
    }

    function comentario_add($id){
        if(isset($_POST['guardar'])){
            // echo "funcionaaaaa";
            $com_name = escape_string(trim($_POST['com_name']));
            $com_email = escape_string(trim($_POST['com_email']));
            $com_mensaje = escape_string(trim($_POST['com_mensaje']));

            $query = query("INSERT INTO comentarios(com_post_id, com_name, com_email, com_mensaje, com_status, com_fecha) VALUES ({$id}, '{$com_name}', '{$com_email}', '{$com_mensaje}', 'pendiente', NOW())");
            confirm($query);
            set_msg(display_success_msg('Tu mensaje a sido enviado, espera a la aprobación del administrador'));
            redirect("post.php?id={$id}");
        }
    }


    function comentarios_show($id){
        global $meses;

        $query = query("SELECT *, YEAR(com_fecha) as anio, MONTH(com_fecha) as mes, DAY(com_fecha) as dia FROM comentarios WHERE com_post_id = {$id} AND com_status = 'aprobado'");
        confirm($query);
        while($row = fetch_array($query)){
            $comentarios = <<<DELIMITADOR
            <div class="media mb-4">
                <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                <div class="media-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="mt-0">{$row['com_name']}</h5>
                        <span>{$row['dia']} de {$meses[$row['mes'] - 1]}, {$row['anio']}</span>
                    </div>
                    {$row['com_mensaje']}
                </div>
            </div>
DELIMITADOR;
            echo $comentarios;
        }
    }

    /********************************************/

    /* FUNCIONES BACK */
    function categoria_add(){
        if(isset($_POST['guardar'])){
            // $cat_name = $_POST['cat_name'];
            $cat_name = escape_string(trim($_POST['cat_name']));
            // echo $cat_name;
            $query = query("INSERT INTO categorias (cat_name) VALUES ('{$cat_name}')");
            confirm($query);
            set_msg(display_success_msg("Categoria agregada correctamente"));
            redirect("index.php?categorias");
        }
    }

    function categorias_show(){
        $query = query("SELECT * FROM categorias");
        confirm($query);
        while($row = fetch_array($query)){
            $categorias = <<<DELIMITADOR
                <tr>
                    <td>{$row['cat_id']}</td>
                    <td>{$row['cat_name']}</td>
                    <td><a href="index.php?categorias&edit={$row['cat_id']}" class="btn btn-success">editar</a></td>
                    <td><a href="index.php?categorias&delete={$row['cat_id']}" class="btn btn-danger">borrar</a></td>
                </tr>
DELIMITADOR;
            echo $categorias;
        }
    }



    function categoria_edit($id){
        if(isset($_POST['editar'])){
            $cat_name = escape_string(trim($_POST['cat_name_edit']));
            $query = query("UPDATE categorias SET cat_name = '{$cat_name}' WHERE cat_id = {$id}");
            confirm($query);
            set_msg(display_success_msg("Categoría actualizada correctamente"));
            redirect("index.php?categorias");
        }
    }

    function posts_show_admin(){
        $query = query("SELECT * FROM posts ORDER BY post_id DESC");
        confirm($query);
        while($row = fetch_array($query)){
            $posts = <<<DELIMITADOR
                <tr>
                    <td>{$row['post_id']}</td>
                    <td>{$row['post_cat_id']}</td>
                    <td>{$row['post_titulo']}</td>
                    <td>Eduardo</td>
                    <td>{$row['post_fecha']}</td>
                    <td><img src="../img/{$row['post_img']}" alt="" style="width: 150px;"></td>
                    <td>{$row['post_contenido']}</td>
                    <td>{$row['post_tags']}</td>
                    <td>{$row['post_vistas']}</td>
                    <td>{$row['post_status']}</td>
                    <td>
                        <a href="index.php?posts_edit={$row['post_id']}" class="btn btn-success">editar</a>
                    </td>
                    <td>
                        <a href="javascript:void(0)" rel="{$row['post_id']}" class="btn btn-danger delete_link">borrar</a>
                    </td>
                </tr>
DELIMITADOR;
            echo $posts;
        }
    }
    function post_add(){
        if(isset($_POST['guardar'])){
            // echo 'funcionaaaaaaaaaa';
            $post_titulo = escape_string(trim($_POST['post_titulo']));
            $post_cat_id = escape_string(trim($_POST['post_cat_id']));
            $post_contenido = escape_string(trim($_POST['post_contenido']));
            $post_tags = escape_string(trim($_POST['post_tags']));
            $post_status = escape_string(trim($_POST['post_status']));

            // echo $post_cat_id;
            // $post_img = $_FILES['post_img'];
            // echo $post_img;
            // print_r($post_img);

            $post_img = escape_string(trim($_FILES['post_img']['name']));
            $post_img_temp = trim($_FILES['post_img']['tmp_name']);
            // echo $post_img;
            // echo $post_img_temp;
            move_uploaded_file($post_img_temp, "../img/{$post_img}");

            $query = query("INSERT INTO posts (post_cat_id, post_titulo, post_user_id, post_fecha, post_img, post_contenido, post_tags, post_vistas, post_status) VALUES ({$post_cat_id}, '{$post_titulo}', 1, NOW(), '{$post_img}', '{$post_contenido}', '{$post_tags}', 0, '{$post_status}')");
            confirm($query);
            set_msg(display_success_msg("Post creado correctamente"));
            redirect("index.php?posts");
        }
    }

    function post_edit($id){
        if(isset($_POST['guardar'])){
            // echo "funciona";
            $post_titulo = escape_string(trim($_POST['post_titulo']));
            $post_cat_id = escape_string(trim($_POST['post_cat_id']));
            $post_contenido = escape_string(trim($_POST['post_contenido']));
            $post_tags = escape_string(trim($_POST['post_tags']));
            $post_status = escape_string(trim($_POST['post_status']));

            $post_img = escape_string(trim($_FILES['post_img']['name']));
            $post_img_temp = trim($_FILES['post_img']['tmp_name']);

            move_uploaded_file($post_img_temp, "../img/{$post_img}");

            // VALIDAR SI SE SUBE UNA IMAGEN NUEVA
            if(empty($post_img)){
                $query = query("SELECT * FROM posts WHERE post_id = {$id}");
                confirm($query);
                $row = fetch_array($query);
                $post_img = $row['post_img'];
            }

            // echo $post_img;
            $query = query("UPDATE posts SET post_titulo = '{$post_titulo}', post_cat_id = {$post_cat_id}, post_contenido = '{$post_contenido}', post_img = '{$post_img}', post_tags = '{$post_tags}', post_status = '{$post_status}' WHERE post_id = {$id}");
            confirm($query);
            set_msg(display_success_msg("Post editado correctamente"));
            redirect("index.php?posts");
            
        }
    }


    /**************************/
?>