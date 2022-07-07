
<div class="columns-container">
    <div class="container" id="columns">

        <!-- page heading-->

        <h2 class="page-heading no-line">
            <span class="page-heading-title2">My Order Summary</span>
        </h2>
        <!-- ../page heading-->
        <!-- -->
        <div class="page-content page-order">
            <?php if($status=='1'){ ?>

                <table  class="table table-bordered table-responsive cart_summary">
                    <thead>
                        <tr>
                            <th>Sr No</th>
                            <th>ORDER NO</th>
                            <th>ORDER DATE</th>
                            <th>TOTAL AMOUNT</th>
                        </tr>
                    </thead>
                    <tbody>
                   <?php foreach ($order_summary as $key => $value) {
                        $strQry = "SELECT SUM(unit_total) AS TOTAL FROM km_order_item WHERE order_number='".$value['order_number']."'";
                        $totalAmount = $this->model->getSqlData($strQry);
                    ?>
                       <tr> 
                            <td><?php echo ++$key; ?></td>
                            <td><?php echo $value['order_number'];?></td>
                            <td><?php echo $value['order_date_time'];?></td>
                            <td><?php echo '$'.$totalAmount[0]['TOTAL'];?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            <?php }else{?>
                    <div id="message-box-conact">
                        <div class="alert alert-danger" style="display:block"><i class="fa fa-exclamation-triangle"></i> 
                            <span><?php echo $msg; ?></span>
                        </div>
                    </div> 
            <?php } ?>
        </div>
        <!-- </form> -->

       
    </div>
</div>
<!-- ./page wapper-->
<?php include_once(APPPATH.'views/includes/footer.php'); ?>

<a href="#" class="scroll_top" title="Scroll to Top" style="display: inline;">Scroll</a>
<!-- Script-->
<script type="text/javascript" src="<?php echo base_url();?>assets/lib/jquery/jquery-1.11.2.min.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/lib/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/lib/select2/js/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/lib/jquery.bxslider/jquery.bxslider.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/lib/owl.carousel/owl.carousel.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/lib/jquery.countdown/jquery.countdown.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/lib/jquery.elevatezoom.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/lib/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/lib/fancyBox/jquery.fancybox.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.actual.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/theme-script.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/peekABar/js/jquery.peekabar.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>kart2mart.js"></script>

</body>
</html>