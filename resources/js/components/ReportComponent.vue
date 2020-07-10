<template>
    <div>
        <h4>Reportes</h4>

        <form class="" action="" method="post" @submit="sendForm">
            Tipo de Usuario
            <input class="form-control" type="text" name="type_user">

            Inicio
            <input class="form-control" type="text" name="start">

            End
            <input class="form-control" type="text" name="end">

            <button class="btn btn-success" type="submit">Enviar</button>
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

            axios.post('api/reportes/make-report', data)
            .then(res => {
                console.log(res)
            })
            e.preventDefault()
        }
    }
}
</script>