<template>
    <div id="modalDepartament" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form
                        ref="formRegisterDepartament"
                        action="#"
                        @submit.prevent=""
                    >
                        <input type="hidden" name="emailable_type" value="departament">
                        <!-- <input type="hidden" name="dependency" :value="student.unidad"> -->
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
    }
}
</script>