<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title ?></title>
  <?php echo $this->load->view('components/header', [], true); ?>
</head>

<body>
  <div class="container g-0">

    <?php $this->load->view($view) ?>
  </div>
  <?php $this->load->view('/components/scripts'); ?>
</body>

</html>