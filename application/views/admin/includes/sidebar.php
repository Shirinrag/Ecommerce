<style type="text/css">
select.input-sm,
select.form-group-sm .form-control {
    height: 30px;
    line-height: 10px;
}
</style>
<ul class="x-navigation">
    <li class="xn-logo">
        <a href="<?php echo base_url();?>Admin"><img
                src="<?php echo base_url();?>uploads/<?php echo $company[0]['company_logo']; ?>"
                style="width: 150px;height: 80px;object-fit: contain;"></a>
        <a href="#" class="x-navigation-control"></a>
    </li>


    <li class="xn-openable">
        <a href="<?php echo base_url();?>Admin"><span class="fa fa-desktop"></span> <span
                class="xn-text">Dashboard</span></a>
    </li>

    <li class="xn-openable">
        <a href="#"><i class="fa fa-user fa-lg"></i> Customers <span class="xn-text"></span></a>
        <ul>
            <li><a href="<?php echo base_url();?>Admin/user_list">Customer List</a></li>
        </ul>
    </li>
    <li class="xn-openable">
        <a href="#"><span class="fa fa-list-alt"></span> <span class="xn-text">Category</span></a>
        <ul>
            <li><a href="<?php echo base_url();?>Admin/add_new_category">Add Category</a></li>
        </ul>
    </li>
    <li class="xn-openable">
        <a href="#"><span class="fa fa-bars"></span> <span class="xn-text">Sub Category</span></a>
        <ul>
            <li><a href="<?php echo base_url();?>Admin/add_new_sub_category">Add SubCategory</a></li>
        </ul>
    </li>

    <li class="xn-openable">
        <a href="#"><span class="fa fa-child"></span> <span class="xn-text">Child Category</span></a>
        <ul>
            <li><a href="<?php echo base_url();?>Admin/add_new_child_category">Add Child Category</a></li>
        </ul>
    </li>

    <li class="xn-openable">
        <a href="#"><span class="fa fa-child"></span> <span class="xn-text">Banners</span></a>
        <ul>
            <li><a href="<?php echo base_url();?>Admin/add_banner">Add Banner</a></li>
        </ul>
    </li>

    <li class="xn-openable">
        <a href="#"><span class="fa fa-gift"></span> <span class="xn-text">Product</span></a>
        <ul>
            <li><a href="<?php echo base_url();?>Admin/add_new_product">Add Product</a></li>
            <li><a href="<?php echo base_url();?>Admin/product_list">Product List</a></li>
        </ul>
    <li class="xn-openable">
        <a href="#"><span class="fa fa-gift"></span> <span class="xn-text">Vendor</span></a>
        <ul>
            <li><a href="<?php echo base_url();?>Admin/add_supplier">Add Vendor</a></li>
            <li><a href="<?php echo base_url();?>Admin/supplier_list">Vendor List</a></li>
    </li>
</ul>
  <li class="xn-openable">
        <a href="<?php echo base_url();?>Admin/Order_history"><span class="fa fa-desktop"></span> <span
                class="xn-text">Order History</span></a>
    </li>

   

</ul>