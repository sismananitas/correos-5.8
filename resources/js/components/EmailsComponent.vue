<template>
    <div>
        <table class="table table-striped text-center border-bottom shadow">
            <thead>
                <tr class="thead-dark">
                    <th>ID</th>
                    <th>CORREO</th>
                    <th>PASSWORD</th>
                    <th>TIPO</th>
                    <th>STATUS</th>
                    <th>SOLICITÓ</th>
                    <th>CREACIÓN</th>
                    <th class="pt-1 pb-1">
                        <div class="dropdown" data-item="">
                            <button
                                id="menuRow"
                                class="btn btn-primary dropdown-toggle w-100"
                                type="button"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                            >
                                Agregar
                            </button>
                            <div class="dropdown-menu shadow correo-actions" aria-labelledby="menuRow">
                                <a class="dropdown-item btn-primary" type="button" @click="openModal('#addEmpleado')">Trabajador</a>
                                <a class="dropdown-item btn-primary" type="button" data-toggle="modal" data-target="#addAlumno">Alumno</a>
                                <a class="dropdown-item btn-primary" type="button" data-toggle="modal" data-target="#addDepartamental">Departamental</a>
                                <a class="dropdown-item btn-primary" type="button" data-toggle="modal" data-target="#addOtro">Otro</a>
                            </div>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody id="tbody_correos">
                <tr v-for="email in emails" :key="email.id">
                    <td>{{ email.id }}</td>
                    <td>{{ email.login }}</td>
                    <td>{{ email.password }}</td>
                    <td>{{ email.emailable_type }}</td>
                    <td>{{ email.status }}</td>
                    <td>{{ email.delivered_to }}</td>
                    <td
                        title=""
                        data-toggle="tooltip"
                        data-placement="top"
                    >
                        {{ email.created_at }}
                    </td>
                    <td class="pt-1 pb-1">
                        <div class="dropdown">
                            <button id="menuRow" class="btn btn-secondary dropdown-toggle w-100"
                            type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-cog"></i> Sett
                            </button>
                            <div class="dropdown-menu" aria-labelledby="menuRow">
                                <a class="dropdown-item btn-secondary" href="#">Agregar grupo</a>
                                <a class="dropdown-item btn-warning" href="#" @click="editEmail(email)">Editar </a>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <modal-edit-email v-on:formSended="getEmails"></modal-edit-email>
        <modal-employee-email v-on:formSended="getEmails"></modal-employee-email>
        <modal-student-email v-on:formSended="getEmails"></modal-student-email>
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
    computed: {
        ...mapState(['emails', 'student', 'response'])
    },

    methods: {
        ...mapActions(['getEmails', 'showStudent', 'showEmail']),

        openModal(modalId) {
            $(modalId).modal('show')
        },

        editEmail(email) {
            this.showEmail(email.id)
            .then(() => {
                $('#editEmail').modal('show')
            })
        },

        showSuccessToast() {
            swal.fire({
                toast: true,
                type: 'success',
                position: 'top-right',
                title: this.response.success,
                timer: 2000,
                showConfirmButton: false
            })
        }
    },

    mounted() {
        this.getEmails()
    }
}
</script>