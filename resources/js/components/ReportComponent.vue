<template>
    <div>
        <div class="toolbar btn-group">
            <button class="btn btn-secondary" :class="{ 'active' : isView('trabajadores') }" @click="changeView('trabajadores')">Trabajadores</button>
            <button class="btn btn-secondary" :class="{ 'active' : isView('alumnos') }" @click="changeView('alumnos')">Alumnos</button>
        </div>

        <div class="trabajadores" v-if="isView('trabajadores')">
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

        <div class="alumnos" v-if="isView('alumnos')">
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
        changeView(view) {
            this.view = view
        },

        isView(view) {
            if (this.view === view)
            return true
            else
            return false
        }
    }
}
</script>