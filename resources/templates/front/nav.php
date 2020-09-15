  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="./">Blog Eduardo</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">

          <?php 
            // $query = mysqli_query($conexion, "SELECT * FROM categorias");
            $query = query("SELECT * FROM categorias");
            // echo $resultado;
            // $resultado = mysqli_fetch_array($query);
            // print_r($resultado);
            // echo $resultado;

            // if(!$query){
            //   die("Fallo en la conexion " . mysqli_error($conexion));
            // }
            confirm($query);

            // while($row = mysqli_fetch_array($query)){
            while($row = fetch_array($query)){
              // print_r($row);
              // echo $row["cat_id"];
              // echo $row["cat_name"];
              ?>

                <li class="nav-item">
                  <a class="nav-link" href="#"><?php echo $row["cat_name"]; ?></a>
                </li>

            <?php }


            // $array = ["name" => "marcos", "apellido" => "contreras"];
            // echo $array["name"];
          ?>
          <!-- <li class="nav-item active">
            <a class="nav-link" href="#">Home
              <span class="sr-only">(current)</span>
            </a>
          </li> -->
          <li class="nav-item">
            <a class="nav-link" href="admin">ADMIN</a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="#">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li> -->
        </ul>
      </div>
    </div>
  </nav>