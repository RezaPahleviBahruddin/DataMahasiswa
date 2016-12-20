<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sign in | Data Mahasiswa</title>
  <!-- Tell the browser to be responsive to screen width Resources -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 Resources -->
  <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome Resources -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons Resources -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style Resources -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- Sweetalert Resources -->
  <link rel="stylesheet" type="text/css" href="../../dist/css/sweetalert.css">
  <script src="../../dist/js/sweetalert.min.js"></script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="index.php"><b>Data</b> Mahasiswa</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in</p>

    <form action="index.php" method="post">
      <div class="form-group has-feedback">
        <input required="Username tidak boleh kosong" name="username_email" type="text" class="form-control" placeholder="Username / Email">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input required="Password tidak boleh kosong" name="password" type="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-4">
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" name="btn_login" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <?php  
      session_start();
      
      require_once 'class.user.php';
      $login = new User();

      if ($login->is_logged_in() != "") 
        $login->redirect('home.php');

      if (isset($_POST['btn_login'])) {
        $uname = strip_tags($_POST['username_email']);
        $mail = strip_tags($_POST['username_email']);
        $password = strip_tags($_POST['password']);

        $log = $login->do_login($uname, $mail, $password);
        if ($log){
          echo "
            <script>
                swal({
                  title: 'Login',
                  text: 'Login Sukses !',
                  type: 'success'
                },
                function(){
                  location.href='home.php'
                });
            </script>
          ";
        }
        else{
          echo "
            <script>
              swal({
                title: 'Login',
                text: 'Login Gagal !',
                type: 'error'
              });
            </script>
          ";
        }
      }
    ?>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<!-- jQuery 2.2.3 -->
<script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>

</body>
</html>