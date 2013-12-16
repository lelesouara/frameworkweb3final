<h1> Livros da editora </h1>
<table>
    <tr>
        <td>Titulo Livro</td>
    </tr>
    <?php foreach ($livrosEditora as $livro): ?>
    <tr>
        <td> <?= utf8_encode($livro->getTitulo()); ?> </td>
    </tr>
    <?php endforeach; ?>
</table>