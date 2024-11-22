<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INOXSACH - CRUD</title>
    <style>
        .container { text-align: center; background-color: #000000; padding: 10px; }
        .container img { width: 200px; }
        .cont { display: flex; }
        .containerV {
            display: flex;
            flex-direction: column;
            justify-content: left;
            align-items: center;
            background-color: #555;
            width: 160px;
            height: 100vh;
            padding: 20px;
        }
        .containerG {
            flex-grow: 1;
            background-color: aliceblue;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: medium;
            color: black;
            padding: 20px;
        }
        .button {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            font-size: 16px;
            color: white;
            border-radius: 5px;
            border: 2px solid #fff;
            background-color: black;
            text-align: center;
        }
        .button:hover { background-color: #bd0101; }
        form { margin-top: 20px; }
        form label { display: block; margin-bottom: 5px; }
        form input { margin-bottom: 10px; width: 100%; padding: 8px; }
        .form-buttons button {
            margin: 5px;
            padding: 10px 15px;
            font-size: 14px;
            background-color: #000;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .form-buttons button:hover { background-color: #bd0101; }
    </style>
</head>
<body>
    <div class="container">
        <img src="tpm2.png" alt="INOXSACH Logo">
    </div>
    <div class="cont">
        <div class="containerV">
            <button class="button" onclick="showForm('Cliente')">Cliente</button>
            <button class="button" onclick="showForm('Empleado')">Empleado</button>
            <button class="button" onclick="showForm('Inventario')">Inventario</button>
            <button class="button" onclick="showForm('Ventas')">Ventas</button>
        </div>
        <div class="containerG">
            <div class="content" id="formContent">
                <!-- Formulario dinámico -->
    <form id="formularioPrincipal" method="post" action="Procesar.php">
        <input type="hidden" name="tipoFormulario" id="tipoFormulario">
        <input type="hidden" name="accion" id="accion">
        <div id="formFields"></div>
       
    </form>
            </div>
        </div>
    </div>

    

    <script>
        function showForm(tipo) {
            document.getElementById('tipoFormulario').value = tipo;

            let formFields = '';
            if (tipo === 'Cliente') {
                formFields = `
                    <label for="nombreCliente">Nombre del cliente:</label>
                    <input type="text" id="nombreCliente" name="nombreCliente">
                    <label for="correo">Correo:</label>
                    <input type="email" id="correo" name="correo">
                    <label for="telefono">Teléfono:</label>
                    <input type="tel" id="telefono" name="telefono">
                    <label for="direccion">Dirección:</label>
                    <input type="text" id="direccion" name="direccion">
                    <label for="numeroCliente">Número de cliente:</label>
                    <input type="text" id="numeroCliente" name="numeroCliente">
                     <div class="form-buttons">
            <button type="button" onclick="setAction('enviar')">Crear</button>
            <button type="button" onclick="setAction('editar')">Editar</button>
            <button type="button" onclick="setAction('eliminar')">Eliminar</button>
            <button type="button" onclick="setAction('buscar')">Buscar</button>
        </div>
                `;
            } else if (tipo === 'Empleado') {
                formFields = `
                    <label for="nombreEmpleado">Nombre del empleado:</label>
                    <input type="text" id="nombreEmpleado" name="nombreEmpleado">
                    <label for="apellidoEmpleado">Apellido del empleado:</label>
                    <input type="text" id="apellidoEmpleado" name="apellidoEmpleado">
                    <label for="puesto">Puesto:</label>
                    <input type="text" id="puesto" name="puesto">
                    <label for="correoE">Correo:</label>
                    <input type="email" id="correoE" name="correoE">
                    <label for="contraE">Contraseña:</label>
                    <input type="password" id="contraE" name="contraE">
                    <label for="sueldo">Sueldo:</label>
                    <input type="number" id="sueldo" name="sueldo" step="0.01">
                    <div class="form-buttons">
            <button type="button" onclick="setAction('enviar')">Crear</button>
            <button type="button" onclick="setAction('editar')">Editar</button>
            <button type="button" onclick="setAction('eliminar')">Eliminar</button>
            <button type="button" onclick="setAction('buscar')">Buscar</button>
        </div>
                `;
            } else if (tipo === 'Inventario') {
                formFields = `
                    <label for="nombreProducto">Nombre del producto:</label>
                    <input type="text" id="nombreProducto" name="nombreProducto">
                    <label for="descripcionProducto">Descripción del producto:</label>
                    <input type="text" id="descripcionProducto" name="descripcionProducto">
                    <label for="stock">Stock:</label>
                    <input type="number" id="stock" name="stock">
                    <label for="precio">Precio:</label>
                    <input type="number" id="precio" name="precio" step="0.01">
                    <div class="form-buttons">
            <button type="button" onclick="setAction('enviar')">Crear</button>
            <button type="button" onclick="setAction('editar')">Editar</button>
            <button type="button" onclick="setAction('eliminar')">Eliminar</button>
            <button type="button" onclick="setAction('buscar')">Buscar</button>
        </div>
                `;
            } else if (tipo === 'Ventas') {
                formFields = `
                    <label for="folio">Folio:</label>
                    <input type="text" id="folio" name="folio">
                    <label for="nombreClienteVenta">Nombre del cliente:</label>
                    <input type="text" id="nombreClienteVenta" name="nombreClienteVenta">
                    <label for="objetosVendidos">Objetos vendidos:</label>
                    <input type="text" id="objetosVendidos" name="objetosVendidos">
                    <label for="precioTotal">Precio total:</label>
                    <input type="number" id="precioTotal" name="precioTotal" step="0.01">
                    <label for="fecha">Fecha:</label>
                    <input type="date" id="fecha" name="fecha">
                    <div class="form-buttons">
            <button type="button" onclick="setAction('enviar')">Crear</button>
            <button type="button" onclick="setAction('editar')">Editar</button>
            <button type="button" onclick="setAction('eliminar')">Eliminar</button>
            <button type="button" onclick="setAction('buscar')">Buscar</button>
        </div>
                `;
            }

            // Insertar los campos en el formulario
            document.getElementById('formFields').innerHTML = formFields;
        }

        function setAction(action) {
            document.getElementById('accion').value = action;
            document.getElementById('formularioPrincipal').submit();
        }
    </script>
</body>
</html>
