<?php use Core\Helper;
      use Core\Input;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>ERP system</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="<?=PROOT . DS . 'css/bootstrap.min.css'?>" rel="stylesheet" />
  <link href="<?=PROOT . DS . 'css/paper-dashboard.css?v=2.0.0'?>" rel="stylesheet" />
  <link rel="stylesheet" href="<?=PROOT . DS . 'css/jquery-ui.css'?>">
  <style type="text/css">
    /*css for autocomplete*/
    body .ui-autocomplete{
      /*font-family: 'Tenali Ramakrishna', tahoma, sans-serif;*/
        color: #333;
        background: #f7f5f0;
        border-radius: 5px;
        z-index: 999999;
      }
    .ui-state-active,
    .ui-widget-content .ui-state-active,
    .ui-widget-header .ui-state-active,
    a.ui-button:active,
    .ui-button:active,
    .ui-button.ui-state-active:hover {
      border: none;
      background-color: grey;
    }
    /*======*/
  </style>
</head>

<body>

 <div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo">
        <a href="#" class="simple-text logo-normal">
          Sales & Outbound
          <!-- <div class="logo-image-big">
            <img src="../assets/img/logo-big.png">
          </div> -->
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="<?= Helper::firstElementUrl() == 'material'? 'active':''; ?>">
            <a href="<?=PROOT?>material">
              <i class="nc-icon nc-bank"></i>
              <p>Material </p>
            </a>
          </li>
          <li class="<?= Helper::firstElementUrl() == 'customer'? 'active':''; ?>">
            <a href="<?=PROOT?>customer">
              <i class="nc-icon nc-book-bookmark"></i>
              <p>Customer</p>
            </a>
          </li>
          <li class="<?= Helper::firstElementUrl() == 'sales'? 'active':''; ?>">
            <a href="<?=PROOT?>sales/create">
              <i class="nc-icon nc-delivery-fast"></i>
              <p>Sales Order</p>
            </a>
          </li>
          <li class="<?= Helper::firstElementUrl() == 'outbound'? 'active':''; ?>">
            <a href="<?=PROOT?>outbound">
              <i class="nc-icon nc-bell-55"></i>
              <p>Outbound</p>
            </a>
          </li>
          <li>
            <a href="<?=PROOT?>auth/logout">
              <i class="nc-icon nc-spaceship"></i>
              <p>Log out</p>

              
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo">Sales & Outbound</a>
          </div>

        </div>
      </nav>
      <!-- End Navbar -->
      
      <div class="content">
        <!-- alert -->
       <?php if(isset($this->_success)) :?>  
            <div class="alert alert-success alert-dismissible fade show">
              <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                <i class="nc-icon nc-simple-remove"></i>
              </button>
              <span><?= $this->_success?></span>
            </div>
  
        <?php elseif(isset($this->_error)) :?>
           <div class="alert alert-danger alert-dismissible fade show">
            <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
              <i class="nc-icon nc-simple-remove"></i>
            </button>
            <span><?= $this->_error?></span>
           </div>     

        <?php elseif(isset($this->_errors)):?>
           <div class="alert alert-danger alert-dismissible fade show">
            <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
              <i class="nc-icon nc-simple-remove"></i>
            </button>
            <?php foreach($this->_errors as $_error):?>
            <span><?= $_error?></span>
            <?php endforeach ?>
           </div>              


        <?php endif ?>
        <!-- end of alert -->
        <?= $this->content('body')?>  
      </div>
      <footer class="footer footer-black  footer-white ">
        <div class="container-fluid">
          <div class="row">
            <nav class="footer-nav">
            </nav>
            <div class="credits ml-auto">
              <span class="copyright">
                ©
                <script>
                  document.write(new Date().getFullYear())
                </script>, made with <i class="fa fa-heart heart"></i> by Creative Tim
              </span>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>


  <!--   Core JS Files   -->
  <script src="<?=PROOT . DS . 'js/core/jquery.min.js'?>"></script>
  <script src="<?=PROOT . DS . 'js/core/popper.min.js'?>"></script>
  <script src="<?=PROOT . DS . 'js/core/bootstrap.min.js'?>"></script>
  <script src="<?=PROOT . DS . 'js/plugins/perfect-scrollbar.jquery.min.js'?>"></script>
  <!--  Google Maps Plugin    -->
<!--   <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->
  <!-- Chart JS -->
  <script src="<?=PROOT . DS . 'js/plugins/chartjs.min.js'?>"></script>
  <!--  Notifications Plugin    -->
  <script src="<?=PROOT . DS . 'js/plugins/bootstrap-notify.js'?>"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="<?=PROOT . DS . 'js/paper-dashboard.min.js?v=2.0.0'?>" type="text/javascript"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <?= $this->content('script')?>
</body>

</html>