<?php include '../components/session.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <title>Document</title>
</head>
<body>

<!-- navbar -->
<?php if(isset($_SESSION['id_usuario'])) { ?>
        <nav class="navbar">
            <div class="logo"> 
                <a href="../../index.php"> <h1>F&F</h1> </a>
            </div>
        
            <div class="navlink">
                <a href="../about.php">About</a>
                <a href="servicios.html">Services</a>
                <a href="../v_favoritos.php">Favoritos</a>
            </div>

            <div class="autorizacion">
                <a href="./views/usuario/editar_usuario.php">Perfil</a>
                <a href="./backup/logout.php">Logout</a> 
            </div>
        </nav>
    <?php } else { ?>
        <nav class="navbar">
            <div class="logo"> 
                <h1>F&F</h1>
            </div>
        
            <div class="navlink">
                <a href="/views/about.php">About</a>
                <a href="servicios.html">Services</a>
            </div>

            <div class="autorizacion">
                <a href="./views/login.php">Iniciar sesión</a>
                <a href="./views/registro.php">Registrarse</a>
            </div>
        </nav>
    <?php } ?>


    <div class="contenedor">
        <img class="img" src="../../assets/perfil.png">
        <div class="contenidoU">
            <img class="logo-grande" src="../../assets/User.png">
            <br>
            <h1 class="titulo">Editar Datos del Usuario</h1>

            <div>
                <div class="form__cambio__username">
                    <h3 class="label">Nombre de usuario: <?php echo $_SESSION['user'] ?></h3>
                    <form action="../../api.php" method="post">
                        <input type="text" style="display: none;" name="column" value="usuario">
                        <input type="text" style="display: none;" name="resource" value="usuarios">
                        <input type="text" style="display: none;" name="service" value="edit">
                        <input class="input" type="text" name="new_data" id="entradaUsername" oninput="validarUsername(this, 8)">
                        <br>
                        <button class="test"  type="submit" id="guardarBtn" disabled>Guardar</button>
                        <div id="errorMessage" class="errorM">Debe tener al menos 8 caracteres.</div>
                        <div id="errorMessageUser" class="errorMu">No puede puede ingresar el mismo nombre de usuario</div>
                    </form>
                </div>
                <br>
                <div class="form__cambio__email">
                    <h3 class="label">Correo: <?php echo $_SESSION['email'] ?></h3>
                    <form action="../../api.php" method="post">
                        <input type="text" style="display: none;" name="column" value="correo">
                        <input type="text" style="display: none;" name="resource" value="usuarios">
                        <input type="text" style="display: none;" name="service" value="edit">
                        <input class="input" type="email" name="new_data" id="entradaCorreo" oninput="validarCorreo(this)">
                        <div id="errorMessageEmail" class="error__message__email">Ha ingresado su correo actual </div>
                        <br>
                        <button class="test"  type="submit" id="guardarBtn2" disabled>Guardar</button>
                    </form>
                </div>
                <br>
                <div class="form__cambio__password">
                    <h3 class="label">Contraseña:</h3>
                    <form action="../../api.php" method="post">
                        <input type="text" style="display: none;" name="column" value="contrasena">
                        <input type="text" style="display: none;" name="resource" value="usuarios">
                        <input type="text" style="display: none;" name="service" value="edit">
                        <label>Contraseña Actual</label>
                        <div id="errorOldPass" class="error__old__pass"></div>
                        <input class="input" type="password" oninput="validarOldPassword(this)">
                        <label>Nueva Contraseña</label>
                        <input class="input"type="password" id="new_password" name="new_data" disabled oninput="validarNewPassword(this)" >
                        <div id="errorPass" class="error__message__pass"></div>
                        <br>
                        <button class="test" type="submit" id="guardarBtn3" disabled>Guardar</button>
                    </form>
                </div>

            </div>
        </div>
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
                errorMessage.innerHTML = "La contraseña debe tener un mínimo de 8 carácteres";
                errorMessage.style.display = "block";
            }else{
                errorMessage.style.display = "none";
                if(data === currentPassword){
                    errorMessage.innerHTML = "Has escrito la misma contraseña ";
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