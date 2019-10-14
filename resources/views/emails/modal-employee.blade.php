<div class="modal fade" id="addTrabajador">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Correo Trabajador</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form id="formTrabajador" action="{{ route('correo.employee.store') }}" method="POST" autocomplete="off">
                @csrf
                <input id="editMode" type="hidden" name="_editMode" value="false">
                
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="card-body">
                        Número de control
                        <input list="empleados" class="form-control" type="text" name="control_number" value="{{ old('control_number') }}">

                        <datalist id="empleados">
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->control_number }}"> {{ $employee->control_number }} </option>
                            @endforeach
                        </datalist>
                    </div>                      
                </div>
                
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Continuar</button>
                </div>
            </form>
        </div>
    </div>
</div>