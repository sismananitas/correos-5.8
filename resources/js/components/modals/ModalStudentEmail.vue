<template>
    <div class="modal fade" id="addAlumno">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Correo alumno</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form id="formAlumno" :action="PostUrl" method="POST" autocomplete="off">
                    <input id="editMode" type="hidden" name="_editMode" value="false">

                    <div class="modal-body">
                        <div class="card-body">
                            Matrícula
                            <input list="alumnos" class="form-control" type="text" name="enrollment" value="" required>

                            <datalist id="alumnos">
                                <option v-for="student in students" :key="student.matricula" :value="student.matricula">
                                    {{ student.matricula + ' - ' + student.ap_paterno + ' ' + student.ap_materno + ' ' + student.nombre }}
                                </option>
                            </datalist>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';
import Axios from 'axios';
export default {
    props: {
        PostUrl: String
    },

    data() {
        return {
            form: '',
            data: {}
        }
    },

    computed: {
        ...mapState(['students'])
    },

    methods: {
        ...mapActions(['getStudents'])
    },

    mounted() {
        this.getStudents();
        this.form = document.getElementById('formAlumno')

        this.form.addEventListener('submit', e => {
            e.preventDefault();
            this.data = new FormData(this.form);

            Axios.post(this.form.action, this.data)
            .then(res => {
                console.log(res);
                
            })
        })
    }
}
</script>