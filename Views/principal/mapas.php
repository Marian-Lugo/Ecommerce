<?php include "Views/template/header.php"; ?>

<!-- Breadcrumb Section Begin -->
<section class="" data-setbg="<?php echo BASE_URL; ?>public/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">

                <h3>Buscar Extinto</h3>
                <form id="buscarForm">
                    <label for="nombre"><h3>Nombre:</h3></label>
                    <input type="text" id="nombre" name="nombre" required>
                    <button type="submit">Buscar</button>
                </form>
                <div id="resultado"></div>
                <script src="../js/script.js"></script>
                    
                
            </div>
        </div>
    </div>
</section>


<!-- Contact Form Begin -->

<!-- Contact Form End -->


<?php include "Views/template/footer.php"; ?>
<script src="<?php echo BASE_URL; ?>public/js/buscarExtinto.js"></script>

</html>