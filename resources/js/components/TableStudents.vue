<template>
<div class="table-responsive">
    <table id="tableStudents" class="table table-striped text-center border-bottom shadow">
        <thead>
            <tr class="thead-dark">
                <th>MATRÍCULA</th>
                <th>CORREO</th>
                <th>NOMBRE</th>
                <th>CARRERA</th>
            </tr>
        </thead>

        <tbody>
            <tr v-for="student in students" v-bind:key="student.matricula">
                <td>{{ student.matricula }}</td>
                <td>{{ student.email }}</td>
                <td>{{ student.nombre + ' ' + student.ap_paterno + ' ' + student.ap_materno }}</td>
                <td>{{ student.carrera }}</td>
            </tr>
        </tbody>
    </table>
</div>
</template>

<script>
import Swal from 'sweetalert2';

export default {
    data: function () {
        return {
            students: []
        }
    },
    created() {
        Swal.showLoading();
        this.getStudents('alumnos/todos')
        .then(() => Swal.close())
    },
    methods: {
        getStudents(url) {
            return axios.get(url)
            .then(res => {
                console.log(res.data)
                this.students = res.data;
            })
        }
    }
}
</script>
