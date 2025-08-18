<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-32x32.png" type="image/x-icon">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-180x180.png" type="image/x-icon">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-192x192.png" type="image/x-icon">
    <link rel="stylesheet" href="./public/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./public/css/profesor/profesor_actividad.css">
    <title>SALI · Mi Actividad</title>
</head>

<body>

    <?php require_once 'includes/header.php';
    require_once 'includes/back_to_main.php' ?>
    

    <main class="px-3 pb-3" style="min-height: 90vh;">

        <div id="ryd_activity_list" style="max-width: 700px;" class="inbox opacity-100 mx-auto">
        <section id="ryd_activity_list_cont"
            class="d-flex flex-column justify-content-center align-items-center mx-auto gap-3 py-3 w-100">
            <div class="spinner-border text-primary" role="status">
  <span class="visually-hidden">Loading...</span>
</div>
        </section>
        </div>
        
        <div id="sol_activity_list" style="max-width: 700px;" class="inbox opacity-0 mx-auto d-none">
        <section id="sol_activity_list_cont"
            class="d-flex flex-column justify-content-center align-items-center mx-auto gap-3 py-3 w-100">
<div class="spinner-border text-primary" role="status">
  <span class="visually-hidden">Loading...</span>
</div>
        </section>
        </div>
        
    </main>
    
    <div class="position-sticky bottom-0 d-flex justify-content-center align-items-center border-top">
        <div id="inbox_ryd" class="inbox-act d-flex justify-content-center align-items-center fs-6 fw-bold w-50 p-3 bg-white border-end inbox-active" style="min-width: fit-content">
                Retiros y Devoluciones
            </div>
        <div id="inbox_solicitudes" class="inbox-act d-flex justify-content-center align-items-center fs-6 fw-bold w-50 p-3 bg-white border-end" style="min-width: fit-content">
                Solicitudes
        </div>
    </div>


    <footer>SALI · COVAO © <span id="app_year"></span></footer>
    <script src="./public/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="./public/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./public/js/profesor/profesor_actividad.js"></script>
</body>

</html>