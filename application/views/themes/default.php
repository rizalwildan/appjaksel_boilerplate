<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aplikasi Absensi Karyawan</title>
    <?php
    /** -- Start from here -- */
    if(!empty($meta))
        foreach($meta as $name=>$content){
            echo "\n\t\t";
            ?><meta name="<?php echo $name; ?>" content="<?php echo $content; ?>" /><?php
        }
    echo "\n";

    if(!empty($canonical))
    {
        echo "\n\t\t";
        ?><link rel="canonical" href="<?php echo $canonical?>" /><?php

    }
    echo "\n\t";

    foreach($css as $file){
        echo "\n\t\t";
        ?><link rel="stylesheet" href="<?php echo $file; ?>" type="text/css" /><?php
    } echo "\n\t";

    /** -- to here -- */
    ?>

    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>

<body class="skin-purple sidebar-mini">
    <div class="wrapper">
        <?php
            echo $this->load->get_section('header');
            echo $this->load->get_section('sidebar');
            echo $output;
        ?>
        <footer class="main-footer">
            <div class="pull-right hidden-xs"><b>Version</b>1.0</div>
            <strong>Copyright 2018 <a href="#">NineTwentyOne.</a></strong>
        </footer>
    </div>

    <?php
    foreach($js as $file){
        echo "\n\t\t";
        ?><script src="<?php echo $file; ?>"></script><?php
    } echo "\n\t";
    ?>
</body>
</html>