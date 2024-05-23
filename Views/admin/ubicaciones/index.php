<?php include_once 'Views/template/header-admin.php'; ?>

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <h4 class="page-title m-0">Ubicaciones</h4>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end page-title-box -->
    </div>
</div>
<!-- end page title -->

<button class="btn btn-primary mb-2" type="button" id="nuevo_registro">Nuevo</button>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover display nowrap align-middle" style="width: 100%;" id="tblUbicaciones">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Manzana</th>
                        <th>Sector</th>
                        <th>Nombre Extinto</th>
                        <th>Descripción</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="nuevoModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModal"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frmRegistro" autocomplete="off">
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="id" name="id">

                        <div class="col-md-6 mb-3">
                            <label for="">Manzana <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                <select id="id_manzana" class="form-control" name="id_manzana">
                                    <option value="">Seleccionar</option>
                                    <?php foreach ($data['manzanas'] as $manzana) { ?>
                                        <option value="<?php echo $manzana['id_manzana']; ?>"><?php echo $manzana['descripcion']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="">Sector <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                                <select id="id_sector" class="form-control" name="id_sector">
                                    <option value="">Seleccionar</option>
                                    <?php foreach ($data['sectores'] as $sector) { ?>
                                        <option value="<?php echo $sector['id_sector']; ?>"><?php echo $sector['descripcion']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="">Nombre Extinto <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-sign"></i></span>
                                <input id="nombre_extinto" class="form-control" type="text" name="nombre_extinto" placeholder="Nombre Extinto">
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="">Descripción </label>
                            <textarea id="descripcion" name="descripcion" class="form-control" rows="3" placeholder="Descripción"></textarea>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit" id="btnAccion">Registrar</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include_once 'Views/template/footer-admin.php'; ?>

<script src="<?php echo BASE_URL . 'public/admin/js/page/ubicaciones.js'; ?>"></script>

</body>
</html>
