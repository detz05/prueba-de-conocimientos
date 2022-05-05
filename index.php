<?php 
require_once("connect.php");
$sql = new Connection();
if($sql->isConnected):
$get = $sql->query("SELECT * FROM students");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calcular nota promedio</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/fonts/fontawesome-webfont.woff2" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/fonts/fontawesome-webfont.woff" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/fonts/fontawesome-webfont.ttf" />

</head>
<body>

    <div class="container">
        <div class="row d-flex justify-content-center mt-4">
            <div class="card col-lg-12">
              <img class="card-img-top" src="holder.js/100px180/" alt="">
              <div class="card-body">
                <h4 class="card-title text-center">Calcular nota promedio</h4>
                <div class="d-flex flex-wrap">
                    <div class="col-md-5 col-sm-12">
                        <form onsubmit="submitForm(event)">
                            <div class="form-group">
                              <label for="">Nombre y Apellido</label>
                              <input type="text" id="name" class="form-control" onchange="onlytext(event)" onkeypress="onlytext(event)" onkeyup="onlytext(event)" placeholder="Nombre y Apellido">
                            </div>
                            <div class="form-group">
                              <label for="">Parcial °1</label>
                              <input type="text" id="par_one" class="form-control" onchange="onlyfloat(event)" onkeypress="onlyfloat(event)" onkeyup="onlyfloat(event)" placeholder="Parcial °1">
                            </div>
                            <div class="form-group">
                              <label for="">Parcial °2</label>
                              <input type="text" id="par_two" class="form-control" onchange="onlyfloat(event)" onkeypress="onlyfloat(event)" onkeyup="onlyfloat(event)" placeholder="Parcial °2">
                            </div>
                            <div class="form-group">
                              <label for="">Parcial °3</label>
                              <input type="text" id="par_three" class="form-control" onchange="onlyfloat(event)" onkeypress="onlyfloat(event)" onkeyup="onlyfloat(event)" placeholder="Parcial °3">
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-success" id="btn_submit">Guardar</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-7 col-sm-12">
                        <table class="table table-striped table-inverse table-responsive" id="list">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>#</th>
                                    <th>Nombre y Apellido</th>
                                    <th>Parcial °1</th>
                                    <th>Parcial °2</th>
                                    <th>Parcial °3</th>
                                    <th>Final</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($get as $st): ?>
                                        <tr>
                                            <td><?php print($st->id); ?></td>
                                            <td><?php print($st->name); ?></td>
                                            <td><?php print($st->p_one); ?></td>
                                            <td><?php print($st->p_two); ?></td>
                                            <td><?php print($st->p_three); ?></td>
                                            <td><?php print(round((($st->p_one + $st->p_two) + $st->p_three) / 3, 2)); ?></td>
                                            <td>
                                                <button onclick="edit(this)" type="button" class="btn btn-sm btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                <button onclick="del(this)" type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                        </table>
                    </div>

                </div>
              </div>
            </div>
        </div>
    </div>
    
    <script src="main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>
</html>
<?php else: ?>

<h3>Conexión con la base de datos no establecida.</h3>

<?php endif;




