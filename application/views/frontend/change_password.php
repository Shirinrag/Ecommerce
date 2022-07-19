<!DOCTYPE html>
<html lang="en">

<head>
    <!-- css
         ============================================ -->
    <?php include('common/cssfiles.php');?>
    <style type="text/css">
    body {
        font-family: 'Roboto', sans-serif
    }
    </style>
</head>

<body class="res layout-1 layout-subpage">
    <div id="wrapper" class="wrapper-fluid banners-effect-5">
        <!-- Header Container  -->
        <?php include('common/header.php');?>
        <!-- //Header Container  -->

        <!-- Main Container  -->
        <div class="main-container container">
            <ul class="breadcrumb">
                <li><a href="#"><i class="fa fa-home"></i></a></li>
                <li><a href="#">Account</a></li>
                <li><a href="#">My Account</a></li>
                <li><a href="#">Change Password</a></li>
            </ul>
            <div class="row">
                <!--Middle Part Start-->
                <div class="col-sm-9" id="content">
                    <h2 class="title">My Account</h2>

                    <form>
                        <div class="row">
                            <div class="col-sm-12">
                                <fieldset>
                                    <legend>Change Password</legend>
                                    <div class="form-group required">
                                        <label for="input-password" class="control-label">Old Password</label>
                                        <input type="password" class="form-control" placeholder="Old Password" value=""
                                            name="old-password">
                                    </div>
                                    <div class="form-group required">
                                        <label for="input-password" class="control-label">New Password</label>
                                        <input type="password" class="form-control" placeholder="New Password" value=""
                                            name="new-password">
                                    </div>
                                    <div class="form-group required">
                                        <label for="input-confirm" class="control-label">New Password Confirm</label>
                                        <input type="password" class="form-control" id="input-confirm"
                                            placeholder="New Password Confirm" value="" name="new-confirm">
                                    </div>
                                </fieldset>

                            </div>
                        </div>
                        <div class="buttons clearfix">
                            <div class="pull-left">
                                <input type="submit" class="btn btn-md btn-primary" value="Save Changes">
                            </div>
                        </div>
                    </form>
                </div>
                <!--Middle Part End-->
                <!--Right Part Start -->
                <?php include('common/myaccountsidepart.php');?>
                <!--Right Part End -->
            </div>
        </div>
        <!-- //Main Container -->

        <!-- Footer Container -->
        <?php include('common/footer.php');?>
        <!-- //end Footer Container -->

        <!-- Include Libs & Plugins
         ============================================ -->

        <?php include('common/jsfiles.php');?>

</body>

</html>