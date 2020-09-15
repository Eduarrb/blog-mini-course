<?php require_once("../../resources/config.php"); ?>

<?php include(TEMPLATE_BACK . DS . "header.php"); ?>

        <?php include(TEMPLATE_BACK . DS . "top_nav.php"); ?>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">

                <?php include(TEMPLATE_BACK . DS . "sidenav.php"); ?>

            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <?php
                        
                            // echo $_SERVER['REQUEST_URI'];

                            if($_SERVER['REQUEST_URI'] == '/curso_php_mini/public/admin/' || $_SERVER['REQUEST_URI'] == '/curso_php_mini/public/admin/index.php'){
                                include(TEMPLATE_BACK . DS . "dashboard.php");
                            }
                            
                            if(isset($_GET['categorias'])){
                                include(TEMPLATE_BACK. DS . "categorias.php");
                            }
                            if(isset($_GET['posts'])){
                                include(TEMPLATE_BACK. DS . "posts.php");
                            }
                            if(isset($_GET['posts_add'])){
                                include(TEMPLATE_BACK. DS . "posts_add.php");
                            }
                            if(isset($_GET['posts_edit'])){
                                include(TEMPLATE_BACK. DS . "posts_edit.php");
                            }
                            

                        ?>
                    </div>
                </main>
                <?php include(TEMPLATE_BACK . DS . "footer.php"); ?>