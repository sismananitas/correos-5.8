<div class="modal fade" id="addAlumno">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Correo alumno</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form id="formAlumno" action="{{ route('correo.student.store') }}" method="POST" autocomplete="off">
                @csrf
                <input id="editMode" type="hidden" name="_editMode" value="false">

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="card-body">
                        Matrícula
                        <input list="alumnos" class="form-control" type="text" name="enrollment" value="{{ old('enrollment') }}" required>

                        <datalist id="alumnos">
                            @foreach ($students as $student)
                                <option value="{{ $student->enrollment }}"> {{ $student->enrollment }} </option>
                            @endforeach
                        </datalist>
                    </div>

                    {{-- <div class="form-row mt-2">
                        <div class="col">
                            <label for="solicitante">Solicitante del cambio</label>
                            <input id="solicitante" class="form-control" type="text" name="client_name" value="{{ old('client_name') }}" required>
                        </div>

                        <div class="col">
                            <label for="entregado_a">Entregado a</label>
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
                            <select class="form-control" name="medium" id="medium" required>
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
                    </div>                         --}}
                </div>
                
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>