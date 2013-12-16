<h1> Lista de Editoras </h1>
<nav>
    <ul>
        <li> <a href='index.php?mod=Editora&page=add'> Cadastrar Editora </a> </li>
    </ul>

</nav>

<br>
<table>
    <tr>
        <th> ID </th>
        <th> Editora </th>
        <th>  </th>
    </tr>
    <?php foreach ($editoras as $editora): ?>
    <tr>
        <td><a href='index.php?mod=Editora&page=view&id=<?= $editora->getCod(); ?>'><?= $editora->getCod(); ?></a></td>
        <td><?= $editora->getNome(); ?></td>
        <td> <a href='index.php?mod=Editora&page=edit&id=<?= $editora->getCod(); ?>'>Editar</a> </td>
        <td> <form method="post" action='index.php?mod=Editora&page=delete'> <input type='hidden' name='cod' value='<?= $editora->getCod(); ?>'> <input type="submit" value="Deletar" name='btnenviardelete'> </form> </td>
    </tr>
    <?php endforeach; ?>
</table>
