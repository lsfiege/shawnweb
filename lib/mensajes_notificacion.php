<?php
$class_mensaje = "";
if ($_GET["err"] <> "") {
    $class_mensaje = "msj_error";
}

if ($_GET["ok"] <> "") {
    $class_mensaje = "msj_ok";
}

if ($_GET["err"] <> "") {
    $mensaje_error = urldecode($_GET["err"]);
    ?>
    <div class="alert alert-danger" role="alert">
        <strong><?= $mensaje_error; ?></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php
}
?>

<?php
if ($_GET["ok"] <> "") {
    $mensaje_error = urldecode($_GET["ok"]);
    ?>
    <div class="alert alert-success" role="alert">
        <strong><?= $mensaje_error; ?></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php
}
?>
