<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-32x32.png" type="image/x-icon">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-180x180.png" type="image/x-icon">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-192x192.png" type="image/x-icon">
    <link rel="stylesheet" href="./public/node_modules/bootstrap/dist/css/bootstrap.css">
    <script src="./public/node_modules/jquery/dist/jquery.min.js"></script>
    <style> #back_to_main {height: 100vh;}.form-control {width: 150px;height: 150px;}#time_clock {margin-top: 15px;width: 150px;}.progress-bar {transition: width 1s linear;}</style>
    <title>Código de Retiro de Llaves</title>
</head>

<body>
    <section id="back_to_main" class="d-flex text-center justify-content-center align-items-center flex-column px-3">
        <h1 style="color: #164166;">Código de acceso para retiro de llaves</h1>
        <p class="fs-5 text-center" style="max-width: 60ch;">Seleccione el siguiente código en su dispositivo para retirar las
            llaves correspondientes:</p>
        <div class="shadow form-control p-5 rounded d-flex justify-content-center align-items-center">
            <div id="code" class="" style="color:#164166;">
                <div class="spinner-border text-secondary" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
        <div id="time_clock" class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="100"
            aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar progress-bar-striped progress-bar-animated" id="progress_bar"></div>
        </div>
    </section>

    <a href="index" class="d-block w-100 btn-dark btn rounded-0 text-center py-3 fw-semibold fs-5"
        style="text-decoration: none">Volver</a>

    <script>
      $(document).ready((function(){let e=0,t=0;localStorage.getItem("tablet_code_permission");const a=$("#progress_bar");a.css("width","100%");const o='<div class="spinner-border text-secondary fw-light" role="status">\n                  <span class="visually-hidden">Loading...</span>\n                </div>';function s(a){$("#code").removeClass("fw-semibold fs-1").html(o),$.ajax({url:"cod_retiro",type:"POST",data:{req_type:a},dataType:"JSON",success:function(a){$("#code").addClass("fw-semibold fs-1").html(a.retiro_llave_access_code_mfa);const o=a.datetime_act,s=new Date(o.replace(" ","T")),c=new Date,r=Math.floor((s-c)/1e3);t=e=Math.max(r,1)},error:function(){window.location.reload();}})}function c(){let e=localStorage.getItem("tb_permission");s(e&&"tb_1910_req_code_ret"==e?"set_ret_code":"get_ret_code")}c(),setInterval((()=>{if(e>0){e--;const o=e/t*100;a.css("width",`${o}%`)}else c()}),1e3)}));


// $(document).ready(function () {
//             let timeLeft = 0;
//             let totalTime = 0;
//             const tb_permission = localStorage.getItem("tablet_code_permission");
        
//             const $progressBar = $("#progress_bar");
        
//             // Establecer barra de progreso al 100% al inicio
//             $progressBar.css("width", "100%");
        
//             const loader_code = `<div class="spinner-border text-secondary fw-light" role="status">
//                   <span class="visually-hidden">Loading...</span>
//                 </div>`
            
//             function update_code(req_kind){
                
//                 $('#code').removeClass('fw-semibold fs-1').html(loader_code);
                
//                 $.ajax({
//                 url: "cod_retiro",
//                 type: "POST",
//                 data: { req_type: req_kind},
//                 dataType: "JSON",
//                 success: function (response) {
//                   $("#code").addClass('fw-semibold fs-1').html(response.retiro_llave_access_code_mfa);
        
//                   // Obtener datetime_act del backend y calcular diferencia
//                   const datetimeAct = response.datetime_act; // Asegúrate de que viene en el response
//                   const fechaObjetivo = new Date(datetimeAct.replace(" ", "T"));
//                   const ahora = new Date();
        
//                   const diferenciaSegundos = Math.floor((fechaObjetivo - ahora) / 1000);
        
//                   // Evitar que sea negativa o 0 (mínimo 1 segundo)
//                   totalTime = timeLeft = Math.max(diferenciaSegundos, 1);
//                 },
//                 error: function () {
//                   alert("Hubo un error en la actualización del código!");
//                   location.href = 'index';
//                 }
//               });
//             }
            
//             function actualizarCodigoRetiro() {
//                 let tb_permission = localStorage.getItem("tb_permission");

//                 if(tb_permission && tb_permission == 'tb_1910_req_code_ret') {
//                     update_code('set_ret_code');
//                 } else{
//                   update_code('get_ret_code'); 
//                 }  
                
                
//             }
//             // Ejecutar la primera carga
//             actualizarCodigoRetiro();
        
//             // Actualizar barra de progreso cada segundo
//             setInterval(() => {
//               if (timeLeft > 0) {
//                 timeLeft--;
//                 const porcentaje = (timeLeft / totalTime) * 100;
//                 $progressBar.css("width", `${porcentaje}%`);
//               } else {
//                 actualizarCodigoRetiro();
//               }
//             }, 1000);
//           });
    </script>   

</body>

</html>