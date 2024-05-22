<?php include_once 'Views/template/header-admin.php'; ?>

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <h4 class="page-title m-0">Manzanas</h4>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end page-title-box -->
    </div>
</div>
<!-- end page title -->

<button class="btn btn-primary mb-2" type="button" id="nuevo_registro_manzana">Nuevo</button>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover display nowrap align-middle" style="width: 100%;" id="tblManzanas">
                <thead>
                    <tr>
                        <th>#</th>
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

<div id="nuevoModalManzana" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModalManzana"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frmRegistroManzana" autocomplete="off">
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="id_manzana" name="id_manzana">

                        <div class="col-md-12 mb-3">
                            <label for="descripcion_manzana">Descripción <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-list"></i></span>
                                <input id="descripcion_manzana" class="form-control" type="text" name="descripcion_manzana" placeholder="Descripción de la Manzana">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit" id="btnAccionManzana">Registrar</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include_once 'Views/template/footer-admin.php'; ?>

<script src="<?php echo BASE_URL . 'public/admin/js/page/manzanas.js'; ?>"></script>

</body>

</html>
