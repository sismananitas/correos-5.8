<template>
<div class="table-responsive">
    <table id="tableEmployees" class="table table-striped text-center border-bottom">
        <thead>
            <tr class="thead-dark">
                <th>N.C.</th>
                <th>CORREO</th>
                <th>NOMBRE</th>
                <th>DEPENDENCIA</th>
            </tr>
        </thead>

        <tbody>
            <tr v-for="employee in employees" v-bind:key="">
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
import Axios from 'axios';
import Swal from 'sweetalert2';

export default {
    data: function () {
        return {
            employees: []
        }
    },
    created() {
        Swal.showLoading();
        this.getEmployees('empleados/todos')
        .then(() => Swal.close())
    },
    methods: {
        getEmployees(url) {
            return Axios.get(url)
            .then(res => {
                console.log(res.data)
                this.employees = res.data;
            })
        }
    }
}
</script>
