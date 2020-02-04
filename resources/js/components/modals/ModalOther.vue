<template>
    <div id="modalOther" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form
                        ref="formRegisterOther"
                        action="#"
                        @submit="sendForm"
                    >
                        <input type="hidden" name="emailable_type" value="other">
                        <label for="name">Nombre</label>
                        <input id="name" class="form-control" type="text" name="name" required>
                        <label for="lastname">Apellidos</label>
                        <input id="lastname" class="form-control" type="text" name="lastname" required>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="client_name">Solicitante del cambio</label>
                                <input id="client_name" class="form-control" type="text" name="client_name" required>
                                <p class="text-danger" v-if="errors.client_name">{{ errors.client_name[0] }}</p>
                            </div>
                            <div class="form-group col">
                                <label for="delivered_to">Entregado a</label>
                                <input class="form-control" type="text" name="delivered_to" required>
                                <p class="text-danger" v-if="errors.delivered_to">{{ errors.delivered_to[0] }}</p>
                            </div>                 
                        </div>
                        <div class="form-group">
                            <label for="login">Login</label>
                            <input id="login" class="form-control" type="email" name="login" required>
                            <p class="text-danger" v-if="errors.login">{{ errors.login[0] }}</p>
                        </div>
                        <div class="form-grou">
                            <label for="password">Contraseña</label>
                            <input id="password" class="form-control" type="text" name="password" required>
                            <p class="text-danger" v-if="errors.password">{{ errors.password[0] }}</p>
                        </div>
                        <div class="form-row">
                            <div class="col form-group">
                                <label for="medium">Medio de solicitud</label>
                                <select class="form-control" name="medium" id="medium" required>
                                    <option value="">- Elegir -</option>
                                    <option value="Ticket">Ticket</option>
                                    <option value="Oficio">Oficio</option>
                                </select>
                                <p class="text-danger" v-if="errors.medium">{{ errors.medium[0] }}</p>
                            </div>
                            <div class="col form-group">
                                <label for="status">Estatus</label>
                                <select class="form-control" name="status" id="status" required>
                                    <option value="">- Elegir -</option>
                                    <option value="Activo">Activo</option>
                                    <option value="Suspendido">Suspendido</option>
                                    <option value="Eliminado">Eliminado</option>
                                </select>
                                <p class="text-danger" v-if="errors.status">{{ errors.status[0] }}</p>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Registrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            errors: {}
        }
    },
    methods: {
        sendForm(e) {
            let data = new FormData(e.target)
            axios.post('/api/emails', data)
            .then(res => {
                showToast(res.data.success)
                //
            })
            .catch(err => {
                showToast(err.response.data.message, 'error')
                if (err.status == 422)
                    this.errors = err.response.data.errors
            })
            e.preventDefault()
        }
    }
}
</script>