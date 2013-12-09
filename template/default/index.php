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
                        <li>Inicio</li>
                        <li>Editoras</li>
                        <li>Livros</li>
                        <li>Autores</li>
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
