<template>
    <div>
        <div class="toolbar btn-group mb-3">
            <button class="btn btn-secondary" :class="{ 'active' : isView('trabajadores') }" @click="changeView('trabajadores')">Trabajadores</button>
            <button class="btn btn-secondary" :class="{ 'active' : isView('alumnos') }" @click="changeView('alumnos')">Alumnos</button>
        </div>

        <div class="trabajadores" v-if="isView('trabajadores')">
            <h3>Trabajadores</h3>
            <form class="form-inline" action="api/reportes/trabajadores" @submit="sendForm">
                <input type="hidden" name="category" value="trabajadores">
                <label class="sr-only" for="search">Search...</label>
                <input class="form-control" :class="{ 'is-invalid' : errors.search ? true : false }" type="text" name="search" placeholder="Search...">
                
                <!-- <select name="category">
                    <option value=""></option>
                </select> -->

                <label class="sr-only" for="field">Buscar por</label>
                <input class="form-control mx-2" :class="{ 'is-invalid' : errors.field ? true : false }" type="text" name="field" placeholder="Campo">

                <label class="sr-only" for="results">Resultados</label>
                <input class="form-control mr-2" :class="{ 'is-invalid' : errors.results ? true : false }" type="number" name="results" min="1" value="1">

                <button class="btn btn-primary">Buscar</button>
            </form>

            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>Id</th>
                    </tr>
                </thead>
            </table>
        </div>

        <div class="alumnos" v-if="isView('alumnos')">
            <h3>Alumnos</h3>
            <form class="form-inline" action="api/reportes/alumnos" @submit="sendForm">
                <input type="hidden" name="category" value="alumnos">
                <label class="sr-only" for="search">Search...</label>
                <input class="form-control" :class="{ 'is-invalid' : errors.search ? true : false }" type="text" name="search" placeholder="Search...">
                
                <!-- <select name="category">
                    <option value=""></option>
                </select> -->

                <label class="sr-only" for="field">Buscar por</label>
                <input class="form-control mx-2" :class="{ 'is-invalid' : errors.field ? true : false }" type="text" name="field" placeholder="Campo">

                <label class="sr-only" for="results">Resultados</label>
                <input class="form-control mr-2" :class="{ 'is-invalid' : errors.results ? true : false }" type="number" name="results" min="1" value="1">
                <button class="btn btn-primary">Buscar</button>
            </form>

            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>Id</th>
                    </tr>
                </thead>
            </table>
        </div>        
    </div>
</template>

<script>
import { mapActions } from 'vuex'
import jsPDF from 'jspdf'

export default {
    data() {
        return {
            view: 'trabajadores',
            trabajadores: [],
            alumnos: [],
            errors: {}
        }
    },

    methods: {
        ...mapActions(['sendPostForm']),

        changeView(view) {
            this.view = view
        },

        isView(view) {
            if (this.view === view)
            return true
            else
            return false
        },

        sendForm(e) {
            let dataJson = new FormData(e.target)
            //axios = 'http://148.218.66.73/correos/public'
            swal.fire({ type: 'toast', title: 'Cargando...' })
            this.errors = {}
            
            axios.post(e.target.action, dataJson)
            .then(res => {
                swal.close()
            })
            .catch(error => {
                swal.close()
                if (error.response.status === 422) {
                    this.errors = error.response.data.errors
                }
            })
            e.preventDefault()
        }
    }
}
</script>