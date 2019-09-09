<div class="modal fade" id="addDepartamental">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Correo Departamental</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form id="formDepartamental" action="{{ route('correo.departament.store') }}" method="POST" autocomplete="off">
                @csrf

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col">
                            <label for="name">Nombre</label>
                            <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" required>
                        </div>
    
                        <div class="col">
                            <label for="lastname">Apellidos</label>
                            <input id="lastname" class="form-control" type="text" name="lastname" value="{{ old('lastname') }}" required>
                        </div>
                    </div>

                    <label for="dependency">Dependencia</label>
                    <input id="dependency" class="form-control" type="text" name="dependency" value="{{ old('dependency') }}" required>

                    <div class="form-row">
                        <div class="col">
                            <label for="client_name">Solicitante del cambio</label>
                            <input id="client_name" class="form-control" type="text" name="client_name" value="{{ old('client_name') }}" required>
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
                </div>
                
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>