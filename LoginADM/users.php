<?php
require_once '../Config/config.php';
require_once 'App/Controller/UserController.php';

$userController = new UserController($pdo);

if (isset($_POST['nome']) && 
    isset($_POST['email']) &&
    isset($_POST['senha']) &&
    isset($_POST['tipo_usuario'])) 
{
    $userController->criarUser($_POST['nome'], $_POST['email'], $_POST['senha'], $_POST['tipo_usuario']);
    header('Location: #');
}

// Atualiza User
if (isset($_POST['id']) && isset($_POST['atualizar_nome']) && isset($_POST['atualizar_email']) && isset($_POST['atualizar_senha']) && isset($_POST['atualizar_tipo_usuario'])) {
    $userController->atualizarUser($_POST['id'], $_POST['atualizar_nome'], $_POST['atualizar_email'], $_POST['atualizar_senha'], $_POST['atualizar_tipo_usuario']);
}

// Excluir User
if (isset($_POST['excluir_id'])) {
    $userController->excluirUser($_POST['excluir_id']);
}

$users = $userController->listarUsers();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Public/Css/style2.css">
    <title>Usuários</title>
</head>
<body>
    <header> 
        <fieldset>
            <div class= "bot"><a href="index.php">Voltar</a></div>
       
       </fieldset>
       <fieldset>
        <legend><h1>Usuários</h1></legend>
    </header>

    <form method="post">
        <input type="text" name="nome" placeholder="Nome Usuário" required>
        <input type="text" name="email" placeholder="E-mail" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <input type="number" name="tipo_usuario" placeholder="Nível de Permissão">
        <button type="submit">Adicionar Usuário</button>
    </form>

    <?php
        $userController->exibirListaUsers();
    ?>
    </fieldset>
<fieldset>
    <legend><h2>Atualizar Usuário</h2></legend>
    <form method="post">
        <select name="id">
            <?php foreach ($users as $user): ?>
                <option value="<?php echo $user['id']; ?>"><?php echo $user['id']; ?></option>
            <?php endforeach; ?>
        </select>
        <input type="text" name="atualizar_nome" placeholder="Novo Nome" required>
        <input type="text" name="atualizar_email" placeholder="Novo E-mail" required>
        <input type="password" name="atualizar_senha" placeholder="Nova Senha" required>
        <input type="number" name="atualizar_tipo_usuario" placeholder="Novo Nível de Permissão" required>
        <button type="submit">Atualizar Usuário</button>
    </form>
    </fieldset>

    <fieldset>
    <legend><h2>Excluir Usuário</h2></legend>
    <form method="post">
        <select name="excluir_id">
            <?php foreach ($users as $user): ?>
                <option value="<?php echo $user['id']; ?>"><?php echo $user['nome']; ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Excluir Usuário</button>
    </form>
            </fieldset>
</body>
</html>