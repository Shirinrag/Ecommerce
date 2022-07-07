<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <!--<link rel="shortcut icon" href="../images/favicon.png" type="image/png">-->
        
        <title>Circuit Store || Admin Login </title>
        <link rel="stylesheet" href="<?php echo base_url();?>assets_admin/lib/fontawesome/css/font-awesome.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets_admin/css/quirk.css">
        </style>
    </head>

    <body class="signwrapper">
        <div class="sign-overlay"></div>
        <div class="signpanel"></div>
        <div class="panel signin" style="background-image: url('https://img.rawpixel.com/s3fs-private/rawpixel_images/website_content/rm309-adj-14.jpg?w=800&dpr=1&fit=default&crop=default&q=65&vib=3&con=3&usm=15&bg=F4F4F3&ixlib=js-2.2.1&s=114b5874c6a2725f412c10e8d097e0a1');border-radius : 16px;
">
            <div class="panel-heading">
                <center>
                <!-- <img src="<?php echo base_url();?>uploads/logo.png" style="width: 80px;"> -->
                <img src="<?php echo base_url();?>uploads/<?php echo $company[0]['company_logo']; ?>" style="width: 150px;height: 100px">
                </center>
            </div>

            <div class="panel-body">
                <form id="frmadminlogin" novalidate="true" method="post" onsubmit="return validate_admin_login(this);">
                    <div class="alert alert-success" style="display:none;"></div>
                    <div class="alert alert-danger" style="display:none;"></div>
                    
                    <div class="form-group mb10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope" style="padding-right: 15px;"></i></span>
                            <input type="text" class="form-control" placeholder="Enter valid email address" name="user_id" id="user_id">
                        </div>
                    </div>
                    <div class="form-group nomargin">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock" style="padding-right: 15px;"></i></span>
                            <input type="password" class="form-control" placeholder="Enter Password" name="password" id="password">
                        </div>
                    </div>
                    <div><a href="#" class="forgot"></a></div>
                    <div class="form-group">
                        <button class="btn btn-success btn-quirk btn-block" style="background-color: #2a2727">Sign In</button><br>
                    </div>
                </form>
                   
                   <div class="bottom" style="background-color: white; margin-top: 4px;">       
          <center>        
            <img src="" style="width:120px;"><br>        
                <b style="color:black;">Contact for support</b><br>     
                <b style="font-weight: bold;color:black;"><i class="glyphicon glyphicon-envelope" style="padding-right: 4px; font-size: 9px;"></i>Info@Circuitstore.Qa</b><br>       
                <b style="font-weight: bold;color:black;"><i class="glyphicon glyphicon-earphone" style="padding-right: 4px;font-size: 9px;"></i>66655674</b>     
         </center>      
               </div>

            </div>
        </div>
    </body>
    <script src="<?php echo base_url();?>assets_admin/lib/jquery/jquery.js"></script>
    <script src="<?php echo base_url();?>assets_admin/lib/modernizr/modernizr.js"></script>
    <script src="<?php echo base_url();?>assets_admin/js/admin.js"></script>
    
</html>

