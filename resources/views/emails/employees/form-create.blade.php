<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crear</title>
</head>
<body>
    <form action="" method="post" autocomplete="off">
        @csrf
        <input type="hidden" name="num_control" value="{{ $num_control }}">

        <label for="usuario">Usuario</label>
        <input type="radio" name="usuario" id="" value="123" checked>
        <input type="radio" name="usuario" id="" value="412">
        <input type="radio" name="usuario" id="" value="98">
        <input type="radio" name="usuario" id="" value="32">

        <div class="form-row mt-2">
            <div class="col">
                <label for="client_name">Solicitante del cambio</label>
                <input id="solicitante" class="form-control" type="text" name="client_name" value="{{ old('client_name') }}" required>
            </div>

            <div class="col">
                <label for="delivered_to">Entregado a</label>
                <input class="form-control" type="text" name="delivered_to" value="{{ old('delivered_to') }}" required>
            </div>
        </div>                    

        <label for="login">Login</label>
        <input id="login" class="form-control" type="email" name="login" value="{{ old('login') }}" required>

        <label for="password">Contraseña</label>
        <input id="password" class="form-control" type="text" name="password" required>

        <div class="form-row">
            <div class="col">
                <label for="medium">Medio de solicitud</label>
                <select class="form-control" name="medium" id="medium" value="{{ old('medium') }}" required>
                    <option value="">- Elegir -</option>
                    <option value="Ticket">Ticket</option>
                    <option value="Oficio">Oficio</option>
                </select>
            </div>

            <div class="col">
                <label for="status">Estatus</label>
                <select class="form-control" name="status" id="status" value="{{ old('status') }}" required>
                    <option value="">- Elegir -</option>
                    <option value="Activo">Activo</option>
                    <option value="Suspendido">Suspendido</option>
                    <option value="Eliminado">Eliminado</option>
                </select>
            </div>
        </div>
    </form>
</body>
</html>