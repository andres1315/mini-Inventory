<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="row align-items-center pt-5">
  <div class="col-12 col-lg-6 overflow-auto mx-auto border rounded">

    <form id="formLogin" class="d-flex flex-column py-5">
      <div class="mb-3 ">
        <label for="user" class="form-label">Usuario</label>
        <input type="text" class="form-control" id="user" name="user" aria-describedby="user" placeholder="a.duque">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="***">
      </div>
      <div class="d-flex justify-content-center">

        <button type="submit" class="btn btn-primary text-center">Ingresar</button>
      </div>
    </form>
  </div>
</div>