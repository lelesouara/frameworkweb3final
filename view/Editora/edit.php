<h1> Editar Editora </h1>
<form method="post" name='editarEditora'>
    <label>Nome Editora</label><br>
    <input type="text" name='nome' id='nome' value='<?= $editora->getNome(); ?>'>
    <input type="hidden" name='cod' value="<?= $editora->getCod(); ?>">
    <input type="submit" value="Editar">
</form>
