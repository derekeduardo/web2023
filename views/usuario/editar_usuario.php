<?php include '../components/session.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .invalid{
            color: red;
        }

        .errorM {
            color: red;
            font-size: 12px;
            margin-top: 5px;
            display: none;
        }

        .errorMu{
            color: red;
            font-size: 12px;
            margin-top: 5px;
            display: none;
        }

        .error__message__email{
            display: none;
            color: red;
            font-size: 20px;
            margin-top: 5px;
        }

        .error__message__pass{
            display: none;
            color: red;
            font-size: 12px;
            margin-top: 5px;
        }
    </style>
</head>
<body>

    <h1>Editar Datos del Usuario</h1>

    <div class="form__cambio__username">
        <h3>Nombre de usuario: <?php echo $_SESSION['user'] ?></h3>
        <form action="../../api.php" method="post">
            <input type="text" style="display: none;" name="column" value="usuario">
            <input type="text" style="display: none;" name="resource" value="usuarios">
            <input type="text" style="display: none;" name="service" value="edit">
            <input type="text" name="new_data" id="entradaUsername" oninput="validarUsername(this, 8)">
            <button type="submit" id="guardarBtn" disabled>Guardar</button>
            <div id="errorMessage" class="errorM">Debe tener al menos 8 caracteres.</div>
            <div id="errorMessageUser" class="errorMu">No puede puede ingresar el mismo nombre de usuario</div>
        </form>
    </div>

    <div class="form__cambio__email">
        <h3>Correo: <?php echo $_SESSION['email'] ?></h3>
        <form action="../../api.php" method="post">
            <input type="text" style="display: none;" name="column" value="correo">
            <input type="text" style="display: none;" name="resource" value="usuarios">
            <input type="text" style="display: none;" name="service" value="edit">
            <input type="email" name="new_data" id="entradaCorreo" oninput="validarCorreo(this)">
            <div id="errorMessageEmail" class="error__message__email">Ha ingresado su correo actual 🤡</div>
            <button type="submit" id="guardarBtn2" disabled>Guardar</button>
        </form>
    </div>

    <div class="form__cambio__password">
        <h3>Contraseña:</h3>
        <form action="../../api.php" method="post">
            <input type="text" style="display: none;" name="column" value="contrasena">
            <input type="text" style="display: none;" name="resource" value="usuarios">
            <input type="text" style="display: none;" name="service" value="edit">
            <label>Contraseña Actual</label>
            <div id="errorOldPass" class="error__old__pass"></div>
            <input type="password" oninput="validarOldPassword(this)">
            <label>Nueva Contraseña</label>
            <input type="password" id="new_password" name="new_data" disabled oninput="validarNewPassword(this)" >
            <div id="errorPass" class="error__message__pass"></div>
            <button type="submit" id="guardarBtn3" disabled>Guardar</button>
        </form>
    </div>
    
    <script>
        function validarUsername(input, minLength){
            let guardarBtn = document.getElementById("guardarBtn");
            let errorM = document.getElementById("errorMessage");
            let errorMu = document.getElementById("errorMessageUser")
            let data = input.value.trimStart().trimEnd();
            let username = '<?php echo $_SESSION['user']?>';

            if(data.length < minLength){
                input.classList.add("invalid");
                guardarBtn.disabled = true;
                errorM.style.display = "block";
            }else{
                input.classList.remove("invalid");
                guardarBtn.disabled = false;
                errorM.style.display = "none";
            }

            if (data === username){
                errorMu.style.display = "block";
                guardarBtn.disabled = true;
            }else{
                errorMu.style.display = "none";
                guardarBtn.disabled = false;
            }
        }

        function validarCorreo(input){
            let btn = document.getElementById("guardarBtn2");
            let email = "<?php echo $_SESSION['email'] ?>";
            let data = input.value.trimStart().trimEnd();
            let error = document.getElementById("errorMessageEmail");

            if (data === email){
                error.style.display = "block";
                btn.disabled = true;
            }else{
                if(data.length < 6){
                    btn.disabled = true;
                }else{
                    btn.disabled = false;
                }
            }

            
        }


        function validarOldPassword (input) {
            let errorMessage = document.getElementById("errorPass");
            let currentPassword = "<?php echo $_SESSION['pass'] ?>";
            let inputNewPassword = document.getElementById("new_password");
            let data = input.value.trimStart().trimEnd();
            let btn = document.getElementById("guardarBtn3");

            if(data !== currentPassword){
                errorMessage.innerHTML = "Esta no es su contraseña actual ☠️";
                errorMessage.style.display = "block";
                btn.disabled = true;
                inputNewPassword.disabled = true;
                
            }else{
                errorMessage.style.display = "none";
                inputNewPassword.disabled = false;
            }

        }
        
        function validarNewPassword (input) {
            let btn = document.getElementById("guardarBtn3");
            let data = input.value.trimStart().trimEnd();
            let errorMessage = document.getElementById("errorPass");
            let currentPassword = "<?php echo $_SESSION['pass'] ?>";

            

            if(data.length < 8){
                errorMessage.innerHTML = "La contraseña debe tener un mínimo de 8 carácteres 🔒";
                errorMessage.style.display = "block";
            }else{
                errorMessage.style.display = "none";
                if(data === currentPassword){
                    errorMessage.innerHTML = "Has escrito la misma contraseña 🤡";
                    errorMessage.style.display = "block";
                }else{
                    errorMessage.style.display = "none";
                    btn.disabled = false;
                }
            }
        }
    </script>
</body>
</html>