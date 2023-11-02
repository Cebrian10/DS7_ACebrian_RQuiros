<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="public/img/utp-icon.png">
    <title>Iniciar Sesion</title>
    <link rel="stylesheet" href="public/css/login.css">
</head>

<body>
    <div class="flotante">
        <a href="?=./">
            <img src="public/img/atras.png" alt="atras">
            <button>Volver</button>
        </a>
    </div>    
    <section class="section-principal">        
        <section class="section-2">
            <form method="post" action="?op=verificar">
                <h2>Iniciar Sesión</h2>
                <div class="flex-column">
                    <label>Correo electronico</label>
                    <input name="email" type="email" placeholder="name@example.com" required>
                </div>
                <div class="flex-column">
                    <label>Contraseña</label>
                    <input name="pass" type="password" placeholder="Password" required>
                </div>

                <button type="submit">Entrar</button>
                <div class="enlaces">
                    <a href="?op=register">¿No tienes cuenta? <span style="color: #7a1d78; font-weight: bold;" >Regístrate</span></a>
                    <a href="#">¿Olvidó su Contraseña?</a>
                </div>
            </form>
        </section>
        <section class="section-1">
            <img src="public/img/utp-icon.png" alt="utp-logo" class="img-login">
        </section>
    </section>
</body>

</html>