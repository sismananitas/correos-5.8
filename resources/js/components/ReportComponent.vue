<template>
    <div>
        <h4>Reportes</h4>

        <form class="col-md-6" action="" method="post" @submit="sendForm">
            <div class="form-row">
                <label for="type_user">Tipo de Usuario</label>
                <input id="type_user" class="form-control" type="text" name="type_user">
            </div>

            <div class="form-row">
                <label for="start">Inicio</label>
                <input class="col form-control" type="text" name="start">

                <label for="end">End</label>
                <input class="col form-control" type="text" name="end">
            </div>

            <div class="form-row">
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
            //
        }
    },

    methods: {
        /**
         * Crea el reporte y lo emprime en otra pestaña
         */
        sendForm(e) {
            let data = new FormData(e.target)

            axios.post('/api/reportes/make-report', data)
            .then(res => {
                console.log(res)
            })
            .catch(trown => {
                console.log(trown)
            })
            e.preventDefault()
        }
    }
}
</script>