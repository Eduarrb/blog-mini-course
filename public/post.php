<?php require_once("../resources/config.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>
  <!-- Navigation -->
  <?php include(TEMPLATE_FRONT . DS . "nav.php"); ?>

  <?php 
    if(isset($_GET['id'])){
      // echo $_GET['id'];
      $id = escape_string(trim($_GET['id']));
      // $query = query("SELECT * FROM posts WHERE post_id = {$id}");
      // confirm($query);
      // $row = fetch_array($query);
      $query = query("UPDATE posts SET post_vistas = post_vistas + 1 WHERE post_id = {$id}");
      confirm($query);
    }
  ?>
  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- Post Content Column -->
      <div class="col-lg-8">

        <?php posts_show_one($id); ?>

        <hr>

        <!-- Comments Form -->
        <div class="card my-4">
          <h5 class="card-header">Deja tu comentario:</h5>
          <div class="card-body">
            <form action="" method="post">
              <div class="form-group">
                <label for="com_name">Tu Nombre:</label>
                <input type="text" class="form-control" id="com_name" required>
              </div>
              <div class="form-group">
                <label for="com_email">Tu Correo:</label>
                <input type="email" class="form-control" id="com_email" required>
              </div>
              <div class="form-group">
                <label for="com_mensaje">Tu Mensaje:</label>
                <textarea class="form-control" id="com_mensaje" rows="3"></textarea>
              </div>
              <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
              <input type="submit" value="Enviar mensaje" class="btn btn-primary">
            </form>
          </div>
        </div>

        <!-- Single Comment -->
        <div class="media mb-4">
          <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
          <div class="media-body">
            <h5 class="mt-0">Commenter Name</h5>
            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
          </div>
        </div>

        <!-- Comment with nested comments -->
        <div class="media mb-4">
          <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
          <div class="media-body">
            <h5 class="mt-0">Commenter Name</h5>
            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.

            <div class="media mt-4">
              <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
              <div class="media-body">
                <h5 class="mt-0">Commenter Name</h5>
                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
              </div>
            </div>

            <div class="media mt-4">
              <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
              <div class="media-body">
                <h5 class="mt-0">Commenter Name</h5>
                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
              </div>
            </div>

          </div>
        </div>

      </div>

      <!-- Sidebar Widgets Column -->
      <?php include(TEMPLATE_FRONT . DS . "side.php"); ?>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>
  