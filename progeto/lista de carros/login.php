<?php
require_once('class/conf.php');
require_once('autoload.php');
//se exister email e senha e se nao for fazio vai pegar dados nos post
if(isset($_POST['email']) && isset($_POST['senha']) && !empty($_POST['email']) && !empty($_POST['senha']) ){
    $email = limpaPost($_POST['email']); //vai chamar metudo limparPost de config para limapar dados 
    $senha = limpaPost($_POST['senha']);

    $login = new Login();//instancia a clase login
    $login->auth($email,$senha); //chamar a funcao auth e mandar os parametus
}

?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
       <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="css/login.css" rel="stylesheet">
     <title>Login</title>
 </head>
 <body>
     <form method="POST">
        
     <h1>Login</h1>
     <div>
     <img src="images/Universidade-de-Santiago-Logo" alt="">
     </div>
       

         <?php if(isset($login->erro["erro_geral"])){?>
         <div class="erro-geral animate__animated animate__rubberBand">
             <?php echo $login->erro["erro_geral"]; ?>
         </div>
         <?php } ?>

         <div class="input-group">
                <!-- <img class="input-icon" src="img/user.png"> -->
            Email <input type="email" name="email" placeholder="Digite seu email" required>
         </div>
        
         <div class="input-group">
             <!-- <img class="input-icon" src="img/lock.png"> -->
             Senha<input type="password" name="senha" placeholder="Digite sua senha" required>
         </div>
       
         <button class="button" type="submit">Fazer Login</button>
        
     </form>
 </body>
 </html>
