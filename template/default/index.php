<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" href="template/default/css/style.css" type="text/css">
    </head>
    <body>
        <div id='main'>
            <header>
                <h1> La bibliothèque de Leandrê </h1>
            </header>
            <div id='content_container'>
                <nav>
                    <ul>
                        <li><a href='?mod=Editora&page=all'>Inicio</a></li>
                        <li><a href='?mod=Editora&page=all'>Editoras</a></li>
                        <li><a href='?mod=Livro&page=all'>Livros</a></li>
                        <li><a href='?mod=Autor&page=all'>Autores</a></li>
                    </ul>
                </nav>
                <article>
                    <?php include $view; ?>
                </article>
            </div>
            <footer>
                Meu Aplicativo usando o framework caseiro.
            </footer>
        </div>
    </body>
</html>
