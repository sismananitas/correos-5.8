<template>
<div class="table-responsive">
    <div class="search-bar mb-2">
        <form id="formSearch" action="#" class="form-inline" v-on:submit.prevent="buscar">
            <input class="form-control mr-2" type="text" v-model="numero_control" placeholder="Matrícula...">
            <button class="btn btn-primary" type="submit">Enviar</button>
        </form>
    </div>

    <table id="tableEmployees" class="table table-striped text-center border-bottom shadow">
        <thead>
            <tr class="thead-dark">
                <th>N.C.</th>
                <th>CORREO</th>
                <th>NOMBRE</th>
                <th>DEPENDENCIA</th>
            </tr>
        </thead>

        <tbody>
            <tr v-for="employee in employees" v-bind:key="employee.numconemp">
                <td>{{ employee.numconemp }}</td>
                <td>{{ employee.email }}</td>
                <td>{{ employee.nombre + ' ' + employee.apepat + ' ' + employee.apemat }}</td>
                <td>{{ employee.dependencia }}</td>
            </tr>
        </tbody>
    </table>
</div>
</template>

<script>
import { mapActions, mapState } from 'vuex'
export default {
    data: function () {
        return {
            numero_control: ''
        }
    },

    created() {
        this.getEmployees()
    },

    computed: {
        ...mapState(['employees']),
    },

    methods: {
        ...mapActions(['getEmployees']),

        // buscar() {
        //     Swal.showLoading();
        //     this.getEmployees('/empleados/todos', {
        //         params: {
        //             numero_control: this.numero_control
        //         }
        //     })
        //     .then(() => Swal.close())
        // }
    }
}
</script>