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
                </div>
                
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>