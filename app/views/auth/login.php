<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-32x32.png" type="image/x-icon">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-180x180.png" type="image/x-icon">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-192x192.png" type="image/x-icon">
    <link rel="stylesheet" href="./public/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./public/css/auth/login.css">
    <meta name="application-name" content="SALI COVAO · Iniciar sesión">
    <meta name="description" content="Sistema Administrativo de Llaves Institucional de Colegio Vocacional de Artes y Oficios (COVAO).">
    <meta name="author" content="Sequeira Design">
    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="index, follow">
    <meta property="og:title" content="SALI - COVAO">
    <meta property="og:description" content="Sistema Administrativo de Llaves Institucional de Colegio Vocacional de Artes y Oficios (COVAO).">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://salicovao.com/login">
    <meta name="keywords" content="SALI, COVAO, Colegio Vocacional, Administración de llaves, institucional, login, iniciar sesion, llaves, horarios, aulas, profesores, solicitud de llave, nocturno, diurno">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="SALI - Iniciar sesión en COVAO">
    <meta name="twitter:description" content="Acceda al sistema administrativo de llaves institucional del Colegio Vocacional de Artes y Oficios (COVAO).">
    <meta name="twitter:image" content="https://salicovao.com/public/assets/images/covao/logo-full-covao.webp">
    <link rel="canonical" href="https://salicovao.com/login">


    <title>SALI · Iniciar sesión</title>
</head>

<body>

    <main class="container-fluid d-flex justify-content-center">
        <section id="form-login" class=" col-md-5 col-12 mx-auto">
            <form id="fm_login_jq" action="login" method="post">
                <div id="logocovao" class="d-flex justify-content-center align-items-center">
                    <img src="./public/assets/images/covao/logo-full-covao.webp" alt="Logo COVAO">
                </div>
                <p class="sali-title">Sistema de Administración de Llaves Institucional</p>

                <h1>Inicio de sesión</h1>
                <div class="mb-3">
                    <label for="userEmail" class="form-label">Correo electrónico institucional</label>
                    <input type="text" class="form-control mb-1" id="userEmail" name="userEmail" required minlength="15">
                    <p class="tooltip-login">Formato: usuario<b>@covao.ed.cr</b></p>
                </div>
                <div class="mb-3">
                    <label for="userPassword" class="form-label">Contraseña <b>(8 caractéres mínimo)</b></label>
                    <div class="passwordContainer">
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" name="userPassword" id="userPassword" required disabled minlength="8">
                            <span id="seepassword" class="input-group-text" id="seepassword" style="border-color:#1b4c766c">
                                <img id="seepasswordimg" src="./public/assets/images/icons/eye_open.svg" alt="Mostrar/Ocultar contraseña">
                            </span>
                        </div>
                    </div>
                    <a href="contraseña" class="tooltip-login forgotpassword">¿Olvidó su contraseña?</a>
                </div>
                <button id="loginBtn" type="submit" class="btn w-100 btn-primary d-flex justify-content-center align-items-center">
                    <span id="loginBtn_text">Iniciar sesión</span>
                    <div id="loginBtn_loader" class="spinner-border text-light" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </button>
                <p class="tooltip-register mb-2">¿No tiene una cuenta en el sistema? <a href="registro">Regístrese</a></p>
            </form>
        </section>
    </main>

    <div id="message-error" class="alert alert-danger">Credenciales inválidas</div>

    <script src="./public/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="./public/js/loader.js"></script>
    <script src="./public/js/auth/login.js"></script>
</body>

</html>