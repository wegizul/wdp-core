<!DOCTYPE html>
<html lang="en">

<!-- This Application made with love by Wegi Zulianda
author: wegizulianda@gmail.com
company: https://webdeveloperpku.com -->

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="WDP Core Application - Login">
  <title>Core Aplikasi | Login</title>
  
  <link rel="apple-touch-icon" href="<?= base_url('assets/') ?>files/logo.png">
  <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/') ?>files/logo.png">
  
  <!-- Google Font: Source Sans 3 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" crossorigin="anonymous">
  
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" crossorigin="anonymous">
  
  <!-- AdminLTE 4 CSS -->
  <link rel="stylesheet" href="<?= base_url("adminlte4"); ?>/css/adminlte.min.css">
  
  <!-- Toastr -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

  <style>
    .login-page {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .login-box {
      width: 400px;
      max-width: 95%;
    }
    
    .card {
      border: none;
      border-radius: 15px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
    }
    
    .card-header {
      background: transparent;
      border-bottom: none;
      padding: 30px 30px 10px;
      text-align: center;
    }
    
    .card-body {
      padding: 20px 30px 30px;
    }
    
    .form-control {
      padding: 12px 15px;
      border-radius: 8px;
      border: 1px solid #e0e0e0;
    }
    
    .form-control:focus {
      box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.25);
      border-color: #667eea;
    }
    
    .btn-primary {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      border: none;
      padding: 12px;
      border-radius: 8px;
      font-weight: 600;
      transition: transform 0.2s, box-shadow 0.2s;
    }
    
    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
    }
    
    .input-group-text {
      border-radius: 8px 0 0 8px;
      border: 1px solid #e0e0e0;
      background: #f8f9fa;
    }
    
    .input-group .form-control {
      border-radius: 0 8px 8px 0;
    }
  </style>
</head>

<body class="login-page bg-body-secondary">
  <div class="login-box">
    <div class="card">
      <div class="card-header">
        <img src="<?= base_url('assets/files/logo.png') ?>" width="60px" class="mb-3">
        <h4 class="fw-bold mb-0">WDP CORE</h4>
        <p class="text-muted">Silahkan login untuk melanjutkan</p>
      </div>
      <div class="card-body">
        <form action="<?= base_url("Login/proses"); ?>" method="POST">
          <div class="mb-3">
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
              <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
            </div>
          </div>
          <div class="mb-4">
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
              <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            </div>
          </div>
          <div class="d-grid">
            <button type="submit" class="btn btn-primary">
              <i class="bi bi-box-arrow-in-right me-2"></i>Login
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  
  <!-- Popper.js -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
  
  <!-- Bootstrap 5 -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
  
  <!-- AdminLTE 4 -->
  <script src="<?= base_url("adminlte4"); ?>/js/adminlte.js"></script>
  
  <!-- Toastr -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <script>
    const notifError = "<?= $this->session->flashdata('error') ?>";
    const notifSuccess = "<?= $this->session->flashdata('success') ?>";

    $(document).ready(function() {
      if (notifError) {
        toastr.error(notifError);
      } else if (notifSuccess) {
        toastr.success(notifSuccess);
      }
    });
  </script>

  <!-- This Application made with love by Wegi Zulianda
  author: wegizulianda@gmail.com
  company: https://webdeveloperpku.com -->
</body>
</html>