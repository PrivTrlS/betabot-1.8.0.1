<!DOCTYPE html>
<html lang="en" class="body-full-height">
<head>        
        <!-- META SECTION -->
        <title>iSpy Premium - Login</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="css/theme-night.css"/>             
        <!-- EOF CSS INCLUDE -->                                     
    </head>
    <body>
        
        <div class="login-container">
        
            <div class="login-box animated fadeInDown">
                <div class="login-logo"></div>
                <div class="login-body">
                    <center><div class="login-title"><strong>Welcome</strong>, Please login</div></center>
                    <?php if ($invalid) { ?>
                    <div class="alert alert-danger" role="alert">
                        <li style="margin-left: 20px;">Invalid username or password.</li>
                    </div>
                    <?php } if (validation_errors()) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo validation_errors(); ?>
                    </div>
                    <?php } echo form_open('do_login', 'class="form-horizontal"'); ?>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="username" id="username" placeholder="iSpyPanel Username"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="password" class="form-control" name="password" id="password" placeholder="iSpyPanel Password"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <a href="forgot" class="btn btn-link btn-block">Forgot your password?</a>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-info btn-block">Sign In</button>
                        </div>
                    </div>
                    <center>Don't have an account yet? <a href="register">Create an account</a></center>
                    </form>
                </div>
                <div class="login-footer">
                    <div class="pull-left">
                        Copyright &copy; <a href="http://www.ispysoft.com">2015-2016 iSpySoft</a>
                    </div>
                </div>
            </div>
            
        </div>
        
    </body>
</html>