<div class="modal fade" id="editEmail">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Actualizar Correo</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form id="formEditar" action="{{ route('correos.update', ['correo' => 1]) }}" method="POST" autocomplete="off">
                @csrf @method('PUT')

                <!-- Modal body -->
                <div class="modal-body">
                    <label for="login">Login</label>
                    <input id="login" class="form-control" type="email" name="login" required>

                    <label for="password">Contraseña</label>
                    <input id="password" class="form-control" type="text" name="password" required>

                    <label for="solicitante">Solicitante del cambio</label>
                    <input id="solicitante" class="form-control" type="text" name="solicitante" required>

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
                    <button class="btn btn-warning" type="submit">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>