<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Achivon Prestasi Abadi | Login</title>
  <!-- Font Awesome -->
  <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/icon/Logo2.png" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0-12/css/all.css">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <!-- AdminLTE -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/dist/css/adminlte.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/sweetalert2/sweetalert2.min.css">
  <!-- Custom CSS -->
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(to right, #4facfe, #00f2fe);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 0;
    }

    .login-box {
      width: 400px;
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .login-logo img {
      max-width: 150px;
      margin-bottom: 20px;
    }

    .login-box-msg {
      font-weight: 600;
      color: #333;
      margin-bottom: 20px;
    }

    .form-control {
      border-radius: 25px;
    }

    .input-group-text {
      background: #4facfe;
      color: #fff;
      border-radius: 25px 0 0 25px;
    }

    .btn-primary {
      background: #4facfe;
      border: none;
      border-radius: 25px;
      padding: 10px 20px;
      font-weight: 600;
      transition: background 0.3s;
    }

    .btn-primary:hover {
      background: #00c6ff;
    }

    .footer {
      text-align: center;
      margin-top: 20px;
      font-size: 14px;
      color: #666;
    }

    .toggle-password {
      cursor: pointer;
    }
  </style>
</head>

<body>
  <div class="login-box">
    <div class="login-logo text-center">
      <img src="<?= base_url() ?>assets/admin/dist/img/Logo4.png" alt="Logo">
    </div>
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Please Login</p>
        <form action="" method="post">
          <div class="input-group mb-3">
            <input type="text" id="user" class="form-control" placeholder="E-Mail/ID/NIK" name="username" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <i class="fas fa-user"></i>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" id="pswd" class="form-control" placeholder="Password" name="pswd" required>
            <div class="input-group-append">
              <div class="input-group-text toggle-password">
                <i class="fas fa-eye"></i>
              </div>
            </div>
          </div>
          <button type="button" id="btn" class="btn btn-primary btn-block">Sign In</button>
        </form>
      </div>
    </div>
    <div class="footer">
      &copy; 2025 Achivon Prestasi Abadi. All rights reserved.
    </div>
  </div>
  <!-- jQuery -->
  <script src="<?= base_url() ?>assets/admin/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url() ?>assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url() ?>assets/admin/dist/js/adminlte.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="<?= base_url() ?>assets/admin/plugins/sweetalert2/sweetalert2.min.js"></script>
  <script type="text/javascript">
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    $('#btn').on('click', function() {
      var user = $('#user').val();
      var pass = $('#pswd').val();
      if (!user || !pass) {
        Toast.fire({
          icon: 'warning',
          title: 'Please fill in all columns.'
        });
        return;
      }
      $.ajax({
        type: 'POST',
        url: "<?= base_url('login/dologin') ?>",
        data: {
          username: user,
          pswd: pass
        },
        dataType: 'json',
        success: function(res) {
          if (res.errorMsg) {
            Toast.fire({
              icon: 'error',
              title: res.errorMsg
            });
          } else {
            localStorage.removeItem('last_selected_node');
            localStorage.removeItem('jstree');
            Toast.fire({
              icon: 'success',
              title: res.message
            });
            setTimeout(function() {
              window.location.href = "<?= base_url('admin') ?>";
            }, 1000);
          }
        },
        error: function() {
          Toast.fire({
            icon: 'error',
            title: 'There is an error. Try again.'
          });
        }
      });
    });

    $(document).on('keypress', function(e) {
      if (e.which === 13) {
        $('#btn').click();
      }
    });

    $('.toggle-password').on('click', function() {
      const passwordField = $('#pswd');
      const passwordIcon = $(this).find('i');
      if (passwordField.attr('type') === 'password') {
        passwordField.attr('type', 'text');
        passwordIcon.removeClass('fa-eye').addClass('fa-eye-slash');
      } else {
        passwordField.attr('type', 'password');
        passwordIcon.removeClass('fa-eye-slash').addClass('fa-eye');
      }
    });
  </script>
</body>

</html>