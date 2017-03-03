<?php 
    
?>

<section class="content-header">
    <h1>
        <?php echo $titulo_pagina ?><br>
        <small><?php echo $subtitulo_pagina ?></small>
    </h1>
    <ol class="breadcrumb">
        <?php if (count($uri)>2):?>
        <li>
        	<a href="<?php echo BASE_URL . $uri[1]?>"><i class="fa fa-dashboard"></i> Home</a>
        </li>
        <li>
            <a href="<?php echo BASE_URL . $uri[1] .'/'. $uri[2]  ?>"><?php echo ucfirst(strtolower($uri[2]))  ?></a>
        </li>
        <li class="active">
           <?php echo ucfirst(strtolower($uri[3]))  ?>
        </li>
       <?php else : ?>
           	<li>
            	<a href="<?php echo BASE_URL . $uri[1]?>"><i class="fa fa-dashboard"></i> Home</a>
            </li>
            
            <li class="active">
                <?php echo ucfirst(strtolower($uri[2]))  ?>
            </li>
       <?php endif ?> 
    </ol>
</section>