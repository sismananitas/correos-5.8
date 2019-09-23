<template>
<table id="tableEmployees" class="table table-striped text-center border-bottom">
    <thead>
        <tr class="thead-dark">
            <th>N. CONTROL</th>
            <th>NOMBRE</th>
            <th>ACTUALIZADO</th>
            <th>CREADO</th>
            <th class="pt-1 pb-1"><button class="btn btn-primary col-12" type="button" data-toggle="modal" data-target="#addTrabajador">Agregar</button></th>
        </tr>
    </thead>

    <tbody>
        <tr v-for="employee in employees" v-bind:key="employee.curp">
            <td>{{ employee.numconemp }}</td>
            <td>{{ employee.nombre + ' ' + employee.apepat }}</td>
            <td>{{ employee.dependencia }}</td>

            <td class="pt-1 pb-1">
                <div class="dropdown" :data-item="employee.numconemp">
                    <button :id="'menuRow' + employee.nombre" class="btn btn-secondary dropdown-toggle w-100" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        settings
                    </button>
                    
                    <div class="dropdown-menu shadow trabajador-actions" :aria-labelledby="'menuRow' + employee.nombre">
                        <a class="dropdown-item btn-warning" type="button" data-toggle="modal" data-target="#editTrabajador">Editar</a>
                        <a class="dropdown-item btn-danger" :href="'{$base_url}trabajador/borrar/' + employee.numconemp">Eliminar</a>
                    </div>
                </div>
            </td>
        </tr>
    </tbody>
</table>
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
        Axios.get('empleados/todos')
        .then(res => {
            console.log(res.data)
            this.employees = res.data;
            console.log('Montado ' + this.employees);
        })
    }
}
</script>