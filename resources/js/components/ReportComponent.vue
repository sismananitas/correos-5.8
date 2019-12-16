<template>
    <div>
        <div class="toolbar button-group">
            <button class="btn btn-secondary" @click="chView('trabajadores')">Trabajadores</button>
            <button class="btn btn-secondary" @click="chView('alumnos')">Alumnos</button>
        </div>

        <div class="trabajadores" v-if="view === 'trabajadores'">
            <h3>Trabajadores</h3>
            <form class="form-inline" action="#">
                <label for="search">Search...</label>
                <input class="form-control" type="text" name="search" placeholder="Search...">
                
                <select name="category">
                    <option value=""></option>
                </select>

                <label for="results">Resultados</label>
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

        <div class="alumnos" v-if="view === 'alumnos'">
            <h3>Alumnos</h3>
            <form class="form-inline" action="#">
                <label for="search">Search...</label>
                <input class="form-control" type="text" name="search" placeholder="Search...">
                
                <select name="category">
                    <option value=""></option>
                </select>

                <label for="results">Resultados</label>
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
export default {
    data() {
        return {
            view: 'trabajadores',
        }
    },

    methods: {
        chView(view) {
            this.view = view
        }
    }
}
</script>