<?php

// Registro de usuario
if (isset($_POST['register'])) {
  $nombre = $_POST['register']['nombre'];
  $apellido = $_POST['register']['apellido'];
  $edad = $_POST['register']['edad'];
  $genero = $_POST['register']['genero'];
  $lugar_nacimiento = $_POST['register']['lugar_nacimiento'];
  $ciudad = $_POST['register']['ciudad'];
  $condicion_desplazamiento = $_POST['register']['condicion_desplazamiento'];
  $ciudad_desplazamiento = $_POST['register']['ciudad_desplazamiento'];
  $ciudad_desplazamiento = $_POST['register']['ciudad_desplazamiento'];


  //echo $nombre, $apellido, $edad, $genero, $lugar_nacimiento, $ciudad, $condicion_desplazamiento, $ciudad_desplazamiento;

  // conectar a la base de datos

  $host = "localhost";
  $usuario = "root";
  $contraseña = "";
  $nombre_bd = "usuarios_bd";

  //crear conexion a la base de datos

  $conexion = new mysqli($host, $usuario, $contraseña, $nombre_bd);

  //verifica si hay errores en la conexion

  if ($conexion->connect_error) {
    die("error de conexion " . $conexion->connect_error);
  }

  // insertar datos en la base de datos

  $sql = "INSERT INTO usuarios (nombre, apellido, edad, genero, lugar_nacimiento, ciudad, condicion_desplazamiento,ciudad_desplazamiento) VALUES ('$nombre', '$apellido', '$edad', '$genero', '$lugar_nacimiento', '$ciudad', '$condicion_desplazamiento', '$ciudad_desplazamiento'); ";

  //echo $sql;

  if ($conexion->query($sql) === TRUE) {
    echo "Creado satisfactoriamente";
  } else {
    echo "Error: " . $sql . "<br>" . $conexion->error;
  }
  $conexion->close();
  die();
}

// editar usuarios
if (isset($_POST['edit'])) {
  $nombre = $_POST['edit']['nombre'];
  $apellido = $_POST['edit']['apellido'];
  $edad = $_POST['edit']['edad'];
  $genero = $_POST['edit']['genero'];
  $lugar_nacimiento = $_POST['edit']['lugar_nacimiento'];
  $ciudad = $_POST['edit']['ciudad'];
  $condicion_desplazamiento = $_POST['edit']['condicion_desplazamiento'];
  $ciudad_desplazamiento = $_POST['edit']['ciudad_desplazamiento'];
  $id_editar = $_POST['edit']['id'];

  $host = "localhost";
  $usuario = "root";
  $contraseña = "";
  $nombre_bd = "usuarios_bd";

  // Crea la conexion
  $conn = new mysqli($host, $usuario, $contraseña, $nombre_bd);
  // Checkea la conexion
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "UPDATE usuarios SET nombre='$nombre', apellido='$apellido', edad='$edad', genero='$genero', lugar_nacimiento='$lugar_nacimiento', ciudad='$ciudad', condicion_desplazamiento='$condicion_desplazamiento', ciudad_desplazamiento='$ciudad_desplazamiento' WHERE id=$id_editar";


  if ($conn->query($sql) === TRUE) {
    echo "Actualizado con exito";
  } else {
    echo "Error " . $conn->error;
  }

  $conn->close();
}

// eliminar usuarios
if (isset($_POST["deleteUser"])) {

  $id_eliminar = $_POST['deleteUser'];

  $host = "localhost";
  $usuario = "root";
  $contraseña = "";
  $nombre_bd = "usuarios_bd";

  // Crea la conexion
  $conn = new mysqli($host, $usuario, $contraseña, $nombre_bd);
  // Checkea la conexion
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "DELETE FROM usuarios WHERE id=$id_eliminar";

  if ($conn->query($sql) === TRUE) {
    echo "Eliminado con exito";
  } else {
    echo "Error " . $conn->error;
  }

  $conn->close();
}
;

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <title>Formulario</title>
  <link rel="stylesheet" type="text/css" href="../bootstrap-5.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <meta charset="UTF-8">
</head>

<body class="bg-white">

  <div class="container">
    <div class="d-flex justify-content-between">
      <button type="button" class="btn btn-dark mt-5">
        <a class="navbar-brand" href="../index.php">Atras</a>
      </button>
      <button type="button" class="btn btn-dark mt-5" data-bs-toggle="modal" data-bs-target="#modalData">
        Ver Registros
      </button>
    </div>
  </div>

  <div class="container my-container mt-5">
    <div class="card bg-primary">
      <div class="card-body">
        <h1 id='titleForm' class="text-center">Formulario</h1>
        <form action="" method="POST">

          <div class="mb-3 d-none" id='idUserContainer'>
            <label for="txtIdUsuario" class="form-label">Id Usuario</label>
            <input type="text" class="form-control" name="txtIdUsuario" id="txtIdUsuario" disabled>
          </div>

          <div class="mb-3">
            <label for="txtName" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="txtName" id="txtName" placeholder="Escribe tu nombre">
          </div>

          <div class="mb-3">
            <label for="txtLastName" class="form-label">Apellido</label>
            <input type="text" class="form-control" name="txtLastName" id="txtLastName"
              placeholder="Escribe tu apellido">
          </div>

          <div class="mb-3">
            <label for="slAge" class="form-label">Edad</label>
            <input type="number" class="form-control" name="slAge" id="slAge" placeholder="Escribe tu edad">
          </div>

          <div class="mb-3">
            <label for="rdGender" class="form-label">Género:</label>

            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="rdGender" id="rdMale" value="male">
              <label class="form-check-label" for="rdMale">Masculino</label>
            </div>

            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="rdGender" id="rdFemale" value="female">
              <label class="form-check-label" for="rdFemale">Femenino</label>
            </div>

          </div>

          <div class="mb-3">
            <label for="slDepartment" class="form-label">Lugar de nacimiento</label>
            <select id="slDepartment" name="slDepartment" class="form-select">
              <option value="" selected>Selecciona departamento</option>
              <option value="Antioquia">Antioquia</option>
              <option value="Meta">Meta</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="slCity" class="form-label">Ciudad</label>
            <select id="slCity" name="slCity" class="form-select" disabled>
              <option selected>Selecciona ciudad</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="rdDisplaced" class="form-label">Condición de desplazamiento:</label>

            <div class="form-check form-check-inline">
              <input class="form-check-input radio-button" type="radio" name="rdDisplaced" id="rdDisplacedYes"
                value="yes">
              <label class="form-check-label" for="rdDisplacedYes">Si</label>
            </div>

            <div class="form-check form-check-inline">
              <input class="form-check-input radio-button" type="radio" name="rdDisplaced" id="rdDisplacedNo"
                value="no">
              <label class="form-check-label" for="rdDisplacedNo">No</label>
            </div>

          </div>

          <div id="displacedField" class="mb-3 d-none">
            <label for="txtPlaceCondition" class="form-label">Lugar de desplazamiento</label>
            <input type="text" class="form-control" name="txtPlaceCondition" id="txtPlaceCondition"
              placeholder="Escribe tu lugar de desplazado">
          </div>

          <div class="d-flex justify-content-center">
            <button name="btnSubmit" id="btnSubmit" type="button" class="btn btn-dark">Enviar</button>
          </div>

        </form>
      </div>
    </div>
  </div>

  <script type="text/javascript" src="../js/jquery-3.7.1.min.js"></script>
  <script type="text/javascript" src="../bootstrap-5.3.1/js/bootstrap.min.js"></script>
  <script type="text/javascript">

    // Variable que contiene el input del departamento

    var selectDepartment = $('#slDepartment');

    // Esta funcion de jQuery (on) controla el cambio del select del departamento

    selectDepartment.on('change', function () {
      loadCity(this.value)
    });

    // Agrega el evento click a los radio buttons de condicion de desplazamiento
    $('.radio-button').on('click', function () {
      // Capturo el valor del radio seleccionado
      var radioDisplaced = $("input[name='rdDisplaced']:checked").val().toLowerCase();

      // Valido si el radio es seleccionado y quito la clase "d-none"
      if (radioDisplaced == 'yes') {
        $('#displacedField').removeClass('d-none');
      }
      else {
        $('#displacedField').addClass('d-none');
      }
    });

    function loadCity(department) {
      // Variable que contiene el input de la ciudad
      var selectCity = $('#slCity');
      if (department == '') {
        selectCity.attr('disabled', true);
      } else {
        // LLenar select de ciudades de Antioquia
        if (department == 'Antioquia') {
          let cityOptions = '';
          cityOptions += '<option value="" selected>Selecciona ciudad</option>';
          cityOptions += '<option value="Medellin">Medellin</option>';
          cityOptions += '<option value="Bello">Bello</option>';
          selectCity.html(cityOptions);
        }
        // LLenar select de ciudades de Meta
        if (department == 'Meta') {
          let cityOptions = '';
          cityOptions += '<option value="" selected>Selecciona ciudad</option>';
          cityOptions += '<option value="Villavicencio">Villavicencio</option>';
          cityOptions += '<option value="Puerto Lleras">Puerto Lleras</option>';
          selectCity.html(cityOptions);
        }
        // Deshabilita el select de ciudad
        selectCity.removeAttr('disabled');
      }
    }

    // Evento para el boton de Registro/Editar

    document.getElementById("btnSubmit").addEventListener("click", function () {
      var idUser = document.getElementById("txtIdUsuario").value;
      var nombre = document.getElementById("txtName").value;
      var apellido = document.getElementById("txtLastName").value;
      var edad = document.getElementById("slAge").value;
      var rdMale = $("#rdMale:checked").val();
      var rdFemale = $("#rdFemale:checked").val();
      var genero = '';
      if (rdMale == 'male') {
        genero = "Masculino";
      }

      if (rdFemale == 'female') {
        genero = "Femenino";
      }
      var lugar_nacimiento = document.getElementById("slDepartment").value;
      var ciudad = document.getElementById("slCity").value;
      var condicion_desplazamiento = '';
      var ciudad_desplazamiento = document.getElementById("txtPlaceCondition").value;
      var radioDisplacedYes = $("#rdDisplacedYes:checked").val();
      var radioDisplacedNo = $("#rdDisplacedNo:checked").val();

      if (radioDisplacedYes == 'yes') {
        condicion_desplazamiento = "Si";
      }

      if (radioDisplacedNo == 'no') {
        condicion_desplazamiento = "No";
      }

      // Crea variable "data" para el js

      var register_data = {
        register: {
          nombre: nombre,
          apellido: apellido,
          edad: edad,
          genero: genero,
          lugar_nacimiento: lugar_nacimiento,
          ciudad: ciudad,
          condicion_desplazamiento: condicion_desplazamiento,
          ciudad_desplazamiento: ciudad_desplazamiento,
        }
      };

      if (ciudad_desplazamiento == '') {
        ciudad_desplazamiento = 'No Aplica';
      }

      var mensaje = "Nombre: " + nombre + "\nApellido: " + apellido + "\nEdad: " + edad + "\nGenero: " + genero + "\nLugar de Nacimiento: " + lugar_nacimiento + "\nCiudad: " + ciudad + "\nCondicion de Desplzamiento: " + condicion_desplazamiento + "\nCiudad de Desplazamiento: " + ciudad_desplazamiento;
      console.log(mensaje);
      alert(mensaje);

      // Si existe el ID del usuario procede a editar
      if (idUser) {
        var edit_data = {
          edit: {
            nombre: nombre,
            apellido: apellido,
            edad: edad,
            genero: genero,
            lugar_nacimiento: lugar_nacimiento,
            ciudad: ciudad,
            condicion_desplazamiento: condicion_desplazamiento,
            ciudad_desplazamiento: ciudad_desplazamiento,
            id: idUser,
          }
        };

        // Edita los datos al archivo PHP usando AJAX
        $.ajax({
          type: "POST",
          url: "formulario.php",
          data: edit_data,
          success: function (response) {
            //console.log("respuesta del PHP: ", response);
            alert('Editado con exito');
            window.location.reload();
          }
        });
      }
      // Si no existe el ID del usuario procede a registrar
      else {
        // Registra los datos al archivo PHP usando AJAX
        $.ajax({
          type: "POST",
          url: "formulario.php",
          data: register_data,
          success: function (response) {
            //console.log("respuesta del PHP: ", response);
            alert('Registro agregado con exito');
            window.location.reload();
          }
        });
      }

    });

  </script>


  <?php

  $conexion = mysqli_connect('localhost', 'root', '', 'usuarios_bd');

  ?>

  <div class="modal" id='modalData' tabindex="-1">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title">Usuarios BD</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="table-responsive">
            <table class="table table-bordered border-primary">

              <tr>
                <td>id</td>
                <td>nombre</td>
                <td>apellido</td>
                <td>edad</td>
                <td>genero</td>
                <td>lugar_nacimiento</td>
                <td>ciudad</td>
                <td>condicion_desplazamiento</td>
                <td>ciudad_desplazamiento</td>
                <td>editar</td>
                <td>eliminar</td>
              </tr>

              <?php

              $sql = "SELECT * from usuarios";
              $result = mysqli_query($conexion, $sql);

              while ($mostrar = mysqli_fetch_array($result)) {
                ?>

                <tr>

                  <td>
                    <?php echo $mostrar['id'] ?>
                  </td>

                  <td>
                    <?php echo $mostrar['nombre'] ?>
                  </td>

                  <td>
                    <?php echo $mostrar['apellido'] ?>
                  </td>

                  <td>
                    <?php echo $mostrar['edad'] ?>
                  </td>

                  <td>
                    <?php echo $mostrar['genero'] ?>
                  </td>

                  <td>
                    <?php echo $mostrar['lugar_nacimiento'] ?>
                  </td>

                  <td>
                    <?php echo $mostrar['ciudad'] ?>
                  </td>

                  <td>
                    <?php echo $mostrar['condicion_desplazamiento'] ?>
                  </td>

                  <td>
                    <?php echo $mostrar['ciudad_desplazamiento'] ?>
                  </td>

                  <td style="text-align:center">
                    <a href="#"
                      onclick="editUser('<?php echo $mostrar['id'] ?>','<?php echo $mostrar['nombre'] ?>', '<?php echo $mostrar['apellido'] ?>', '<?php echo $mostrar['edad'] ?>', '<?php echo $mostrar['genero'] ?>', '<?php echo $mostrar['lugar_nacimiento'] ?>', '<?php echo $mostrar['ciudad'] ?>', '<?php echo $mostrar['condicion_desplazamiento'] ?>', '<?php echo $mostrar['ciudad_desplazamiento'] ?>')"><img
                        src="../images/edit.png" class="card-img-center w-50 eliminar" style="cursor: pointer"></a>
                  </td>

                  <td style="text-align:center">
                    <a href="#" onclick="deleteUser('<?php echo $mostrar['id'] ?>')"><img src="../images/delete.png"
                        class="card-img-center w-50 eliminar" style="cursor: pointer"></a>
                  </td>

                </tr>
                <?php
              }
              ?>
            </table>
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>

      </div>
    </div>
  </div>

  <script>

    // editar el usuario y cierra el modal
    function editUser(idUser, nombre, apellido, edad, genero, lugar_nacimiento, ciudad, condicion_desplazamiento, ciudad_desplazamiento) {
      alert('Prueba: ' + idUser + nombre + apellido + edad + genero + lugar_nacimiento + ciudad + condicion_desplazamiento + ciudad_desplazamiento);
      $('#modalData').modal('hide');
      $('#titleForm').html('Editar Usuario');
      $('#idUserContainer').removeClass('d-none');
      $('#txtIdUsuario').val(idUser);
      $('#txtName').val(nombre);
      $('#txtLastName').val(apellido);
      $('#slAge').val(edad);
      if (genero == 'Masculino') {
        $('#rdMale').prop('checked', true);
      }
      if (genero == 'Femenino') {
        $('#rdFemale').prop('checked', true);
      }
      $('#slDepartment').val(lugar_nacimiento);
      loadCity(lugar_nacimiento);
      $('#slCity').val(ciudad);

      if (condicion_desplazamiento == 'Si') {
        $('#rdDisplacedYes').prop('checked', true);
        $('#displacedField').removeClass('d-none');
      }
      if (condicion_desplazamiento == 'No') {
        $('#rdDisplacedNo').prop('checked', true);
        $('#displacedField').addClass('d-none');
      }

      $('#txtPlaceCondition').val(ciudad_desplazamiento);
      $('#btnSubmit').html('Guardar');
    }

    // eliminar usuario

    function deleteUser(idUser) {
      var deleteData = {
        deleteUser: idUser
      };
      $.ajax({
        type: "POST",
        url: "formulario.php",
        data: deleteData,
        success: function (response) {
          //console.log("respuesta del PHP: ", response);
          alert('Eliminado con exito');
          window.location.reload();
        }
      });
    }
  </script>

</body>

</html>