<?php 
use App\Http\Controllers\AdminController;
?>
<body>
    <div>
        <h1>Login Admin</h1>
        <form action="{{ route('admin.iniciar') }}" method="POST">
            @csrf
            <label for="usuario">Usuario:</label><br>
            <input type="text" id="usuario" name="usuario" value="{{ old('usuario') }}" placeholder="Usuario"><br>
            {!! $errors->first('usuario', '<small>:message</small>') !!}<br>
            <label for="contra">Contraseña:</label><br>
            <input type="password" id="contra" name="contra" value="{{ old('contra') }}" placeholder="Contraseña"><br>
            {!! $errors->first('contra', '<small>:message</small>') !!}<br><br>
            <input type="submit" value="Iniciar">
        </form>
        <a href="{{ route('/') }}">Home</a>
    </div>
</body>
