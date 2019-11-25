<template>
    <div class="modal fade" id="editEmail">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Actualizar Correo</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form
                    :action="base_url + '/correos/' + email.id"
                    method="POST"
                    autocomplete="off"
                    @submit="sendForm"
                >
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="login">Login</label>
                            <input id="login" class="form-control" type="email" name="login" required v-model="email.login">

                            <p class="text-danger" v-if="errors.login">{{ errors.login[0] }}</p>
                        </div>

                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            <input id="password" class="form-control" type="text" name="password" required v-model="email.password">

                            <p class="text-danger" v-if="errors.password">{{ errors.password[0] }}</p>
                        </div>

                        <div class="form-group">
                            <label for="solicitante">Solicitante del cambio</label>
                            <input id="solicitante" class="form-control" type="text" name="solicitante" required>

                            <p class="text-danger" v-if="errors.solicitante">{{ errors.solicitante[0] }}</p>
                        </div>

                        <div class="form-row">
                            <div class="form-group col">
                                <label for="medium">Medio de solicitud</label>
                                <select class="form-control" name="medium" id="medium" value="" required>
                                    <option value="">- Elegir -</option>
                                    <option value="Ticket">Ticket</option>
                                    <option value="Oficio">Oficio</option>
                                </select>
                            </div>

                            <div class="form-group col">
                                <label for="status">Estatus</label>
                                <select class="form-control" name="status" id="status" value="" required v-model="email.status">
                                    <option value="">- Elegir -</option>
                                    <option value="Activo">Activo</option>
                                    <option value="Suspendido">Suspendido</option>
                                    <option value="Eliminado">Eliminado</option>
                                </select>
                            </div>
                        </div>                        
                    </div>
                    
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button class="btn btn-warning" type="submit">Actualizar</button>
                        <button class="btn btn-danger" type="button">Eliminar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';
export default {
    computed: {
        ...mapState(['email', 'response', 'errors', 'base_url'])
    },

    methods: {
        ...mapActions(['sendPostForm']),

        sendForm(e) {
            let dataJson = new FormData(e.target)

            this.sendPostForm({ url: e.target.action, data: dataJson })
            .then(() => {
                if (this.response) {
                    $('#editEmail').modal('hide')
                    this.$emit('formSended')
                }
            })
            e.preventDefault()
        }
    }
}
</script>