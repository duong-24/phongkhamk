<ul class="pagination pagination-lg"> 
<?php 
$s=5;
    
        # code...
     for ($i=0 ;$i<12/9.0;$i++) {
    ?>
         <li class="pagination-item"><a class="pagination-item__link" href="service.php?page=<?php echo  $i+1 ?><?php
        echo isset($s)? "&s=$s": '' ?>"><?php echo  $i+1 ?></a></li>
    <?php
     }

     
?>
</ul>


