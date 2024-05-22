<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title ?></title>
  <?php echo $this->load->view('components/header', [], true); ?>
</head>
<body data-scrollbar-auto-hide="n">
<div class="wrapper">
  
  <?php $this->load->view('/components/sideBar'); ?>
  <div class="content-wrapper">

    <?php $this->load->view($view) ?>
  </div>
</div>
<?php $this->load->view('/components/scripts'); ?>

  
</body>
</html>