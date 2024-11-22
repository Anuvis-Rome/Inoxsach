<?php
// Conexión a la base de datos
include 'Conexion.php';

// Captura de variables desde el formulario
$tipoFormulario = $_POST['tipoFormulario'];
$accion = $_POST['accion'];

// Función para mostrar resultados en una tabla
function imprimirTabla($result)
{
    if ($result->num_rows > 0) {
        echo "<table border='1' style='width:100%; text-align:left; border-collapse: collapse; margin-top: 20px;'>";
        echo "<thead>";
        echo "<tr>";

        // Encabezados de la tabla
        while ($field = $result->fetch_field()) {
            echo "<th style='padding: 10px; background-color: #f2f2f2;'>" . htmlspecialchars($field->name) . "</th>";
        }

        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        // Filas de la tabla
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td style='padding: 10px;'>" . htmlspecialchars($value) . "</td>";
            }
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<p>No se encontraron resultados.</p>";
    }
}

// Operaciones CRUD
switch ($accion) {
    case 'enviar': // Crear
        if ($tipoFormulario == 'Cliente') {
            $nombre = $_POST['nombreCliente'];
            $correo = $_POST['correo'];
            $telefono = $_POST['telefono'];
            $direccion = $_POST['direccion'];
            $numeroCliente = $_POST['numeroCliente'];

            $sql = "INSERT INTO cliente (nombreCliente, correo, telefono, direccion, numeroCliente) 
                    VALUES ('$nombre', '$correo', '$telefono', '$direccion', '$numeroCliente')";
        
    } elseif ($tipoFormulario == 'Empleado') {
            $nombre = $_POST['nombreEmpleado'];
            $apellido = $_POST['apellidoEmpleado'];
            $puesto = $_POST['puesto'];
            $correo = $_POST['correoE'];
            $contraseña = $_POST['contraE'];
            $numero = $_POST['numeroE'];
            $sueldo = $_POST['sueldo'];

            $sql = "INSERT INTO empleado (nombreEmpleado, apellidoEmpleado, puesto, correoE, contraE, numeroE, sueldo) 
                    VALUES ('$nombre', '$apellido', '$puesto', '$correo', '$contraseña', '$numero', '$sueldo')";
        }
         elseif ($tipoFormulario == 'Inventario') {
            $nombre = $_POST['nombreProducto'];
            $descripcion = $_POST['descripcionProducto'];
            $stock = $_POST['stock'];
            $precio = $_POST['precio'];

            $sql = "INSERT INTO inventario (nombreProducto, descripcionProducto, stock, precio) 
                    VALUES ('$nombre', '$descripcion', '$stock', '$precio')";
        } elseif ($tipoFormulario == 'Ventas') {
            $folio = $_POST['folio'];
            $nombreCliente = $_POST['nombreClienteVenta'];
            $objetosVendidos = $_POST['objetosVendidos'];
            $precioTotal = $_POST['precioTotal'];
            $fecha = $_POST['fecha'];

            $sql = "INSERT INTO ventas (folio, nombreCliente, objetosVendidos, precioTotal, fecha) 
                    VALUES ('$folio', '$nombreCliente', '$objetosVendidos', '$precioTotal', '$fecha')";
        }
        break;

    case 'buscar': // Leer/Buscar
        if ($tipoFormulario == 'Cliente') {
            $sql = "SELECT * FROM cliente";
        } elseif ($tipoFormulario == 'Empleado') {
            $sql = "SELECT * FROM empleado";
        } elseif ($tipoFormulario == 'Inventario') {
            $sql = "SELECT * FROM inventario";
        } elseif ($tipoFormulario == 'Ventas') {
            $sql = "SELECT * FROM ventas";
        }

        $result = $conn->query($sql);

        if ($result) {
            imprimirTabla($result); // Mostrar resultados en una tabla
        } else {
            echo "Error al buscar: " . $conn->error;
        }
        break;

    case 'editar': // Actualizar
        if ($tipoFormulario == 'Cliente') {
            $id = $_POST['numeroCliente'];
            $nombre = $_POST['nombreCliente'];
            $correo = $_POST['correo'];
            $telefono = $_POST['telefono'];
            $direccion = $_POST['direccion'];

            $sql = "UPDATE cliente SET nombreCliente='$nombre', correo='$correo', telefono='$telefono', direccion='$direccion' 
                    WHERE numeroCliente='$id'";
        } elseif ($tipoFormulario == 'Empleado') {
            $id = $_POST['numeroE'];
            $nombre = $_POST['nombreEmpleado'];
            $apellido = $_POST['apellidoEmpleado'];
            $puesto = $_POST['puesto'];
            $correo = $_POST['correoE'];
            $sueldo = $_POST['sueldo'];

            $sql = "UPDATE empleado SET nombreEmpleado='$nombre', apellido='$apellido', puesto='$puesto', correo='$correo', sueldo='$sueldo' 
                    WHERE telefono='$id'";
        } elseif ($tipoFormulario == 'Inventario') {
            $id = $_POST['nombreProducto'];
            $descripcion = $_POST['descripcionProducto'];
            $stock = $_POST['stock'];
            $precio = $_POST['precio'];

            $sql = "UPDATE inventario SET descripcionProducto='$descripcion', stock='$stock', precio='$precio' 
                    WHERE nombreProducto='$id'";
        } elseif ($tipoFormulario == 'Ventas') {
            $id = $_POST['folio'];
            $nombreCliente = $_POST['nombreClienteVenta'];
            $objetosVendidos = $_POST['objetosVendidos'];
            $precioTotal = $_POST['precioTotal'];
            $fecha = $_POST['fecha'];

            $sql = "UPDATE ventas SET nombreCliente='$nombreCliente', objetosVendidos='$objetosVendidos', precioTotal='$precioTotal', fecha='$fecha' 
                    WHERE folio='$id'";
        }
        break;

    case 'eliminar': // Eliminar
        if ($tipoFormulario == 'Cliente') {
            $id = $_POST['numeroCliente'];
            $sql = "DELETE FROM cliente WHERE numeroCliente='$id'";
        } elseif ($tipoFormulario == 'Empleado') {
            $id = $_POST['nombreEmpleado'];
            $sql = "DELETE FROM empleado WHERE nombreEmpleado='$id'";
        } elseif ($tipoFormulario == 'Inventario') {
            $id = $_POST['nombreProducto'];
            $sql = "DELETE FROM inventario WHERE nombreProducto='$id'";
        } elseif ($tipoFormulario == 'Ventas') {
            $id = $_POST['folio'];
            $sql = "DELETE FROM ventas WHERE folio='$id'";
        }
        break;
}

// Ejecutar la consulta (excepto buscar)
if ($accion !== 'buscar' && isset($sql)) {
    if ($conn->query($sql) === TRUE) {
        echo ("<script>alert('Operacion con exito');</script>
                <button class='btn'><a href='Proy.php' class='btn'>Regresar</a></button>
                ");//"<p>Operación '$accion' realizada con éxito.</p>";
    } else {
        echo "<script>alert('Error');</script>
                <button class='btn'><a href='Proy.php' class='btn'>Regresar</a></button> '$accion': " . $conn->error;
    }
}

// Cerrar conexión
$conn->close();
?>
