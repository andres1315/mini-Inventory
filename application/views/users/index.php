<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="row align-items-center pt-5 w-100">
  <div class="col-12 col-lg-10 overflow-auto mx-auto border rounded bg-white">
    <div class="my-4">
      <button class="btn btn-primary btn-xs" id="btnCreatedUser">Crear</button>
    </div>
    <table id="tableUsers" class="display " style="width:100%">
    </table>
  </div>
</div>


<!-- Modal Create users -->
<div class="modal fade" id="modalApp" tabindex="-1" aria-labelledby="modalApp" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalAppTitle">Crear Usuario</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <form id="formNewUser">
            <div class="row p-2 mb-3">
              <div class="col-12 col-md-6">
                <label for="name">Nombre</label>
                <input type="text" name="name" id="name" class="form-control" required>
              </div>
              <div class="col-12 col-md-6">
                <label for="email">Correo</label>
                <input type="text" class="form-control" name="email" id="email" required>
              </div>
            </div>
            <div class="row mb-3 p-2">
              <div class="col-12 col-md-6">
                <label for="user">Usuario</label>
                <input type="text" class="form-control" name="user" id="user" required>
              </div>
              <div class="col-12 col-md-6">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" name="password" id="password" required>
              </div>
            </div>
            <div class="d-flex justify-content-center">
              <button class="btn-sm btn-success btn-sm rounded w-50" type="submit">Guardar</button>
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

      </div>
    </div>
  </div>
</div>