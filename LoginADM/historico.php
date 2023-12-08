<?php
require_once '../Config/config.php';
require_once 'App/Controller/emprestimoController.php';

$emprestimoController = new emprestimoController($pdo);

$emprestimos = $emprestimoController->listarHistorico();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Histórico</title>
</head>
<body>
    <a href="index.php">Voltar</a>
    <h1>Histórico de Empréstimos</h1>
    <ul>
        <?php foreach ($emprestimos as $emprestimo): ?>
            <li><strong>Livro: </strong><?php echo $emprestimo['nome_livro']; ?>;<br> <strong>Usuário:</strong> <?php echo $emprestimo['nome_aluno']; ?><br> <strong>Horário da devolução:</strong> <?php echo $emprestimo['hora']; ?><br><br></li>
        <?php endforeach; ?>
    </ul>

</body>
</html>