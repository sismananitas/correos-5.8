<template>
    <div>
        <div class="toolbar btn-group">
            <button class="btn btn-secondary" :class="{ 'active' : isView('trabajadores') }" @click="changeView('trabajadores')">Trabajadores</button>
            <button class="btn btn-secondary" :class="{ 'active' : isView('alumnos') }" @click="changeView('alumnos')">Alumnos</button>
        </div>

        <div class="trabajadores" v-if="isView('trabajadores')">
            <h3>Trabajadores</h3>
            <form class="form-inline my-2" action="/api/reportes/trabajadores" @submit="sendForm">
                <input type="hidden" name="category" value="trabajadores">
                <label class="sr-only" for="search">Search...</label>
                <input class="form-control" type="text" name="search" placeholder="Search...">
                
                <!-- <select name="category">
                    <option value=""></option>
                </select> -->

                <label class="sr-only" for="results">Resultados</label>
                <input class="form-control" type="number" name="results" min="1" value="1">

                <button class="btn btn-primary">Buscar</button>
            </form>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                    </tr>
                </thead>
            </table>
        </div>

        <div class="alumnos" v-if="isView('alumnos')">
            <h3>Alumnos</h3>
            <form class="form-inline my-2" action="/api/reportes/alumnos" @submit="sendForm">
                <input type="hidden" name="category" value="alumnos">
                <label class="sr-only" for="search">Search...</label>
                <input class="form-control" type="text" name="search" placeholder="Search...">

                <label class="sr-only" for="field">Buscar por</label>
                <input class="form-control" type="text" name="field" placeholder="Campo">
                
                <!-- <select name="category">
                    <option value=""></option>
                </select> -->

                <label class="sr-only" for="results">Resultados</label>
                <input class="form-control" type="number" name="results" min="1" value="1">
                <button class="btn btn-primary">Buscar</button>
            </form>

            <table class="table table-striped">
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
            alumnos: []
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
            let dataJson = e.target
            axios.post(e.target.action, dataJson)
            .then(res => {
                console.log(res)
            })
            e.preventDefault()
        }
    }
}
</script>