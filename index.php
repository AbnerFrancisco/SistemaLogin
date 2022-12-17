<?php
    include_once './db/db_connect.php'; 
    session_start();

    if(isset($_POST["btn-entrar"])):
        $erros = array();
        $login = mysqli_escape_string($connect,$_POST["login"]);
        $senha = mysqli_escape_string($connect,$_POST["senha"]);
        if(empty($login) || empty($senha)):
            $erros[]="<li>o campo login ou senha não foi preenchido</li>";
        else:
            $sql = "SELECT login FROM usuarios WHERE login = '{$login}'";
            $resultado = mysqli_query($connect,$sql);
            if(mysqli_num_rows($resultado)>0):
                $senha = md5($senha);
                $sql = "SELECT * FROM usuarios WHERE login = '{$login}'AND senha='{$senha}'";
                $resultado = mysqli_query($connect,$sql);

                if(mysqli_num_rows( $resultado )==1):
                    $dados = mysqli_fetch_assoc($resultado);
                    $_SESSION['logado'] = true;
                    $_SESSION['id_usuario'] = $dados['id'];
                    header('Location: home.php');
                endif;
            else:
                $erros[] = "<li>Usuário não existe.<li>";  
            endif; 
        endif; 
    endif;

    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Login</title>
</head>
<body>
    <h1>Sistema login</h1>
    <?php
    if(!empty($erros)):
        foreach($erros as $erro):
            echo $erro;
        endforeach;
    endif;
    ?>
        <div>
            <form action="" method="post">
                Login:<input type ="text" name="login">
                Senha:<input type ="password" name="senha">
              <button type="submit" name="btn-entrar" value="entrar">
                  Entrar
              </button>
            </form>
        </div>
</body>
</html>