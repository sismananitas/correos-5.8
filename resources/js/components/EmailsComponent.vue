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
                                <a class="dropdown-item btn-primary" href="#" type="button" @click.prevent="openModal('#addEmpleado')">Trabajador</a>
                                <a class="dropdown-item btn-primary" href="#" type="button" @click.prevent="openModal('#addAlumno')">Alumno</a>
                                <a class="dropdown-item btn-primary" href="#" type="button" @click.prevent="openModal('#modalDepartament')">Departamental</a>
                                <a class="dropdown-item btn-primary" href="#" type="button" @click.prevent="openModal('#modalOther')">Otro</a>
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
                            <button
                                id="menuRow"
                                class="btn btn-secondary dropdown-toggle w-100"
                                type="button"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                            >
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
        <modal-employee-email @formSended="getEmails"></modal-employee-email>
        <modal-departament @formSended="getEmails"></modal-departament>
        <modal-other @formSended="getEmails"></modal-other>
        <modal-student-email @formSended="getEmails"></modal-student-email>
        <modal-edit-email @formSended="getEmails"></modal-edit-email>
    </div>
</template>
<script>
import { mapState, mapActions } from 'vuex';

export default {
    computed: {
        ...mapState(['emails', 'student'])
    },
    methods: {
        ...mapActions(['getEmails', 'showEmail']),

        openModal(modalId) {
            $(modalId).modal('show')
        },

        editEmail(email) {
            this.showEmail(email.id)
            .then(() => {
                $('#editEmail').modal('show')
            })
        }
    },

    mounted() {
        this.getEmails()
    }
}
</script>