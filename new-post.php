<?php require('init.php'); ?>
<?php
   
    $error = false;
    $title = '';
    $excerpt = '';
    $content = '';

    if ( isset($_POST['submit-new-post']) ){
        
        //saneo los inputs del formulario a través de la función filter_input() que recibe como argumentos: una cte de PHP para decirle de dónde viene (si POST o GET). El 2º argumento se le dice el nombre del input del form. Y el 3º argumentos le decimos cómo queremos que lo sanee con el tipo de filtro (son ctes de PHP ya definidas)
        $title = filter_input( INPUT_POST, 'title', FILTER_SANITIZE_STRING );
        $excerpt = filter_input( INPUT_POST, 'excerpt', FILTER_SANITIZE_STRING );

        //con la función strip_tags me permite indicar que etiquetas html están permitidas. El primer argumento es el string de entrada, y el segundo argumento le decimos que etiquetas NO queremos que se quiten.
        $content = strip_tags($_POST['content'], '<br><p><a><img><div><h2><h3><h4><h5><h6>');

        if( empty( $title ) || empty( $content )  ){
            $error = true;
        }else{
            insert_post( $title, $excerpt, $content );
            redirect_to('index.php?success=true');
        }
        
    }

    //$title = '"onclick="alert()""';
   
?>
<?php require('templates/header.php'); ?>

    <h2>Crear nuevo post</h2>

    <?php if ($error): ?>
        <div class="error">
            Error en el formulario.
        </div>
    <?php endif; ?>

    <form action="" method="post">
        <label for="title">Título (requerido)</label>
        <input type="text" name="title" id="title" value="<?php echo htmlspecialchars( $title, ENT_QUOTES ); ?>">

        <label for="excerpt">Extracto</label>
        <input type="text" name="excerpt" id="excerpt" value="<?php echo htmlspecialchars( $excerpt, ENT_QUOTES ); ?>">

        <label for="content">Contenido (requerido)</label>
        <textarea name="content" id="content" cols="30" rows="30"><?php echo htmlspecialchars( $content, ENT_QUOTES ); ?></textarea>

        <p>
            <input type="submit" name="submit-new-post" value="Nuevo post">
        </p>
    </form>

<?php require('templates/footer.php'); ?>
    