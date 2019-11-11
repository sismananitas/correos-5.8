<template>
    <table class="table table-striped text-center border-bottom shadow">
        <thead>
            <tr class="thead-dark">
                <th>ID</th>
                <th>CORREO</th>
                <th>PASSWORD</th>
                <!-- <th>MEDIO SOLICITUD</th> -->
                <th>TIPO</th>
                <th>STATUS</th>
                <th>SOLICITÓ</th>
                <th>CREACIÓN</th>
                <th class="pt-1 pb-1">
                    <div class="dropdown" data-item="">
                        <button id="menuRow" class="btn btn-primary dropdown-toggle w-100"
                        type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Agregar
                        </button>
                        
                        <div class="dropdown-menu shadow correo-actions" aria-labelledby="menuRow">
                            <a class="dropdown-item btn-primary" type="button" data-toggle="modal" data-target="#addTrabajador">Trabajador</a>
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
                <!-- <td>{{ email.tasks.first().medium }}</td> -->

                <td>{{ email.emailable_type }}</td>

                <td>{{ email.status }}</td>
                <td>{{ email.delivered_to }}</td>

                <td title=""
                data-toggle="tooltip" data-placement="top">
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
                            <a class="dropdown-item btn-warning" href="#">Editar </a>
                            
                            <form action="" method="post">
                                <button class="dropdown-item btn-danger" type="submit">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
            
            <div v-if="emails.length" class="alert alert-warning">
                No hay correos registrados
            </div>
        </tbody>
    </table>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
    computed: {
        ...mapState(['emails'])
    },

    methods: {
        ...mapActions(['getEmails'])
    },

    mounted() {
        this.getEmails();
    }
}
</script>