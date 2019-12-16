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
import { mapState } from 'vuex';
export default {
    data: function () {
        return {
            students: []
        }
    },

    computed: {
        ...mapState(['response']),
    },

    created() {
        swal.showLoading();
        this.getStudents('alumnos/todos')
        .then(() => swal.close())
    },

    methods: {
        showResponseToast() {
            swal.fire({
                toast: true,
                type: 'success',
                position: 'top-right',
                title: this.response.success,
                timer: 200,
                showConfirmButton: false
            })
        },

        getStudents(url) {
            return axios.get(url)
            .then(res => {
                this.students = res.data;
            })
        }
    }
}
</script>
