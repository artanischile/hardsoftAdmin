<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $titulo_pagina ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!--  set de js an css files  -->
    <?php echo  put_headers() ?>


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-blue-light sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

    
    <!-- =============================================== -->
    <?php  $this->load->view('backend/layout/header'); ?>
    <!-- =============================================== -->
    <!-- =============================================== -->
    <?php  $this->load->view('backend/layout/sidebar'); ?>
    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <?php  $this->load->view('backend/layout/breadcrum'); ?>
        <!-- Main content -->
        <section class="content">
            <?php
            if (isset($content)){
                $this->load->view($content) ;
            }else{
                echo "<h1>No existe Contenido</h1>";
            }
            ?>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <?php  $this->load->view('backend/layout/footer'); ?>
    </footer>


    
</div>
<!-- ./wrapper -->


</body>
</html>
