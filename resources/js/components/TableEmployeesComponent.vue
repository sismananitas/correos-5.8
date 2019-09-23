<template>
<div class="table">
    <datatable :columns="columns" :data="rows"></datatable>
    <datatable-pager v-model="page" type="abbreviated" :per-page="per_page"></datatable-pager>
</div>
</template>

<script>
import Axios from 'axios';
import Swal from 'sweetalert2';
import DatatableFactory from 'vuejs-datatable/node_modules/object-path/index';

export default {
    components: { DatatableFactory },
    data: function () {
        return {
            columns: [
                { label: 'id', field: 'numconemp' }, 
                { label: 'Name', field: 'nombre' },
                { label: 'Email', field: 'email' }
            ],

            rows: [],
            page: 1,
            per_page: 10,
            // employees: [],
            // tableEmployeesEl: $('#tableEmployees'),
            // data: [
            //     {
            //         name: "Tiger Nixon",
            //         position: "System Architect",
            //         office: "Edinburgh",
            //         salary: "$3,120"
            //     },
            //     {
            //         name: "Garrett Winters",
            //         position: "Director",
            //         office: "Edinburgh",
            //        salary:  "$5,300"
            //     }
            // ]
        }
    },
    methods: {
        getUsers: function() {
            axios.get('empleados/todos')
            .then(function(response) {

                this.rows = response.data;

            }.bind(this));

        }
    },
    created() {
        this.getUsers()
        // this.tableEmployeesEl.DataTable({
        //     data: this.data,
        //     columns: [
        //         { data: 'name' },
        //         { data: 'position' },
        //         { data: 'salary' },
        //         { data: 'office' }
        //     ]
        // })

        // Axios.get('empleados/todos')
        // .then(res => {
        //     console.log(res.data)
        //     console.log('Montado ' + this.employees);
        // })
    }
}
</script>