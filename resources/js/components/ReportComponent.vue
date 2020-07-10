<template>
    <div>
        <h4>Reportes</h4>

        <form class="col-md-6" action="" method="post" @submit="sendForm">
            <div class="form-group">
                <label for="type_user">Tipo de Usuario</label>
                <select class="form-control" name="type_user" id="type_user" v-model="type_user">
                    <option value="">- Eligir -</option>
                    <option value="all">Todos</option>
                    <option value="alumno">Alumno</option>
                    <option value="trabajador">Trabajador</option>
                </select>
                <p v-if="errors.type_user" class="text-red">{{ errors.type_user[0] }}</p>
            </div>

            <div class="form-group" v-if="type_user == 'trabajador'">
                <label for="type_worker">Tipo de trabajador</label>
                <select class="form-control" name="type_worker" id="type_worker">
                    <option value="">- Elegir -</option>
                    <option value="planta">Planta</option>
                    <option value="eventual">Eventual</option>
                </select>
                <p v-if="errors.type_worker" class="text-red">{{ errors.type_worker[0] }}</p>
            </div>

            <div class="form-group form-row">
                <div class="col">
                    <label for="start">Inicio</label>
                    <input id="start" class="form-control" type="date" name="start">
                    <p v-if="errors.start" class="text-red">{{ errors.start[0] }}</p>
                </div>

                <div class="col">
                    <label for="end">End</label>
                    <input id="end" class="form-control" type="date" name="end">
                    <p v-if="errors.end" class="text-red">{{ errors.end[0] }}</p>
                </div>
            </div>

            <div class="form-group form-row">
                <button class="btn btn-success" type="submit">Enviar</button>
            </div>
        </form>
    </div>
</template>

<script>
import { mapActions } from 'vuex'
import jsPDF from 'jspdf'
import 'jspdf-autotable'

export default {
    data() {
        return {
            type_user: '',
            errors: ''
        }
    },

    methods: {
        /**
         * Crea el reporte y lo emprime en otra pestaña
         */
        sendForm(e) {
            let data = new FormData(e.target)

            axios.post('api/reportes/make-report', data)
            .then(res => {
                console.log(res)
            })
            .catch(thrown => {
                if (thrown.response.status == 422) {
                    swal.fire({
                        type: 'error',
                        title: thrown.response.message
                    })
                }
                console.log(thrown.response.errors)
            })
            e.preventDefault()
        }
    }
}
</script>