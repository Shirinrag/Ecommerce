<?php 
    $unit_id = $_GET['unit_id'];
    $array_1000k = array('1','2','3','6'); //1:kg,2:Gram,3:Liter,6:Mili liter
    $array_1pcs = array('4','7'); //4:Piece, 7:Bunch,
    $array_12dozen = array('5'); //5:Dozen
    if(in_array($unit_id, $array_1000k)){ ?>
        <option value="100">100 gm</option>
        <option value="250">250 gm</option>
        <option value="500">500 gm</option>
        <option value="1000" selected>1 Kg</option>
    <?php }else if(in_array($unit_id, $array_1pcs)){ ?>
        <option value="1" selected>1 pcs/pkt</option>
        <option value="2">2 pcs/pkt</option>
        <option value="3">3 pcs/pkt</option>
        <option value="4">4 pcs/pkt</option>
        <option value="5">5 pcs/pkt</option>
    <?php }else if(in_array($unit_id, $array_12dozen)){?>
        <option value="6">6 pcs</option>
        <option value="12" selected>1 dozen</option>
    <?php }else{?>
        <option value="" selected>No Unit</option>
    <?php } 
?>
