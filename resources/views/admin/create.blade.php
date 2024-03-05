<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Carrera</title>
    <!-- Agrega los enlaces a los archivos CSS de Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Crear Carrera</h1>

        <!-- Formulario para crear una nueva carrera -->
        <form action="{{ route('carreras.store') }}" method="post">
            @csrf <!-- Agrega el token CSRF para protección contra falsificación de solicitudes entre sitios -->
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label for="tipo">Tipo:</label>
                <select id="tipo" name="tipo" class="form-control" required>
                    <option value="plano">Plano</option>
                    <option value="vallas">Vallas</option>
                    <option value="campo a traves">Campo a través</option>
                    <option value="trote y arnes">Trote y arnes</option>
                    <option value="parejeras">Parejeras</option>
                </select>
            </div>

            <!-- <div class="form-group">
                <label for="lugar_foto">Lugar de la foto:</label>
                <input type="file" id="lugar_foto" name="lugar_foto" class="form-control-file" required>
            </div> -->

            <div class="form-group">
                <label for="patrocinio">Patrocinio:</label>
                <input type="number" id="patrocinio" name="patrocinio" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="fechaHora">Fecha y Hora:</label>
                <input type="datetime-local" id="fechaHora" name="fechaHora" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Guardar Carrera</button>
        </form>
    </div>
    <!-- Agrega los enlaces a los archivos JavaScript de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
