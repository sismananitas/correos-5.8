<template>
    <div>
        <div class="toolbar btn-group mb-3">
            <button class="btn btn-secondary" :class="{ 'active' : isView('trabajadores') }" @click="changeView('trabajadores')">Trabajadores</button>
            <button class="btn btn-secondary" :class="{ 'active' : isView('alumnos') }" @click="changeView('alumnos')">Alumnos</button>
            <button class="btn btn-secondary" :class="{ 'active' : isView('correos') }" @click="changeView('correos')">Correos</button>
        </div>

        <div class="trabajadores" v-if="isView('trabajadores')">
            <h3>Trabajadores</h3>
            <form
                class="form-inline"
                action="api/reportes/trabajadores"
                @submit="sendForm"
            >
                <input type="hidden" name="category" value="trabajadores">
                <label class="sr-only" for="search">Search...</label>
                <input
                    class="form-control"
                    :class="{ 'is-invalid' : errors.search ? true : false }"
                    type="text" name="search"
                    placeholder="Search..."
                >

                <label class="sr-only" for="field">Buscar por</label>
                <select
                    class="form-control mx-2"
                    :class="{ 'is-invalid' : errors.field ? true : false }"
                    name="field"
                >
                    <option value="emplea_numconemp"># control</option>
                    <option value="emplea_nombre">Nombre</option>
                    <option value="emplea_apepat">Apellido paterno</option>
                </select>

                <label class="sr-only" for="results">Resultados</label>
                <input
                    class="form-control mr-2"
                    :class="{ 'is-invalid' : errors.results ? true : false }"
                    type="number" name="results"
                    min="1" value="5"
                >
                <button class="btn btn-primary">Buscar</button>
            </form>

            <button class="btn btn-success mt-3" @click="showTrabajadoresPdf">Generar reporte</button>
            <table class="table table-striped text-center mt-3">
                <thead class="thead-dark">
                    <tr>
                        <th>Curp</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Dependencia</th>
                        <th>Tipo Empleado</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="trabajador in trabajadores" :key="trabajador.id">
                        <td>{{ trabajador.curp }}</td>
                        <td>{{ trabajador.nombre }}</td>
                        <td>{{ trabajador.paterno }} {{ trabajador.materno }}</td>
                        <td>{{ trabajador.nomdep }}</td>
                        <td>{{ trabajador.tipemp }}</td>
                    </tr>
                </tbody>
            </table>
            <div v-if="!trabajadores.length" class="alert alert-secondary">No hay resultados.</div>
        </div>

        <div class="alumnos" v-if="isView('alumnos')">
            <h3>Alumnos</h3>
            <form
                class="form-inline"
                action="api/reportes/alumnos"
                @submit="sendForm"
            >
                <input type="hidden" name="category" value="alumnos">
                <label class="sr-only" for="search">Search...</label>
                <input
                    class="form-control"
                    :class="{ 'is-invalid' : errors.search ? true : false }"
                    type="text" name="search"
                    placeholder="Search..."
                >

                <label class="sr-only" for="field">Buscar por</label>
                <select
                    class="form-control mx-2"
                    :class="{ 'is-invalid' : errors.field ? true : false }"
                    name="field"
                >
                    <option value="alu_matricula">Matricula</option>
                    <option value="alu_nombre">Nombre</option>
                </select>

                <label class="sr-only" for="results">Resultados</label>
                <input
                    class="form-control mr-2"
                    :class="{ 'is-invalid' : errors.results ? true : false }"
                    type="number" name="results"
                    min="1" value="5"
                >
                <button class="btn btn-primary">Buscar</button>
            </form>

            <button class="btn btn-success mt-3" @click="showAlumnosPdf">Generar reporte</button>
            <table class="table table-striped text-center mt-3">
                <thead class="thead-dark">
                    <tr>
                        <th>Matricula</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Status</th>
                        <th>Grado</th>
                        <th>Unidad</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="alumno in alumnos" :key="alumno.id">
                        <td>{{ alumno.matricula }}</td>
                        <td>{{ alumno.nombre }}</td>
                        <td>{{ alumno.ap_paterno }} {{ alumno.ap_materno }}</td>
                        <td>{{ alumno.status }}</td>
                        <td>{{ alumno.grado }}</td>
                        <td>{{ alumno.unidad }}</td>
                    </tr>
                </tbody>
            </table>
            <div v-if="!alumnos.length" class="alert alert-secondary">No hay resultados.</div>
        </div>

        <div class="correos" v-if="isView('correos')">
            <h3>Correos</h3>
            <form
                class="form-inline"
                action="api/reportes/correos"
                @submit="sendForm"
            >
                <input type="hidden" name="category" value="correos">
                <label class="sr-only" for="search">Search...</label>
                <input
                    class="form-control"
                    :class="{ 'is-invalid' : errors.search ? true : false }"
                    type="text" name="search"
                    placeholder="Search..."
                >

                <label class="sr-only" for="field">Buscar por</label>
                <select
                    class="form-control mx-2"
                    :class="{ 'is-invalid' : errors.field ? true : false }"
                    name="field"
                >
                    <option value="">- Elegir -</option>
                    <option value="email">Login</option>
                    <option value="alumno">Tipo alumno</option>
                    <option value="trabajador">Tipo trabajador</option>
                    <option value="alu_nombre">Nombre</option>
                </select>

                <label class="sr-only" for="results">Resultados</label>
                <input
                    class="form-control mr-2"
                    :class="{ 'is-invalid' : errors.results ? true : false }"
                    type="number" name="results"
                    min="1" value="5"
                >
                <button class="btn btn-primary">Buscar</button>
            </form>

            <button class="btn btn-success mt-3" @click="showEmailPdf">Generar reporte</button>
            <table class="table table-striped text-center mt-3">
                <thead class="thead-dark">
                    <tr>
                        <th>Matricula</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="correo in correos" :key="correo.id">
                        <td>{{ correo.matricula }}</td>
                        <td>{{ correo.nombre }}</td>
                        <td>{{ correo.ap_paterno }} {{ correo.ap_materno }}</td>
                        <td>{{ correo.status }}</td>
                    </tr>
                </tbody>
            </table>
            <div v-if="!correos.length" class="alert alert-secondary">No hay resultados.</div>
        </div>
    </div>
</template>

<script>
import { mapActions } from 'vuex'
import jsPDF from 'jspdf'

export default {
    data() {
        return {
            view: 'trabajadores',
            trabajadores: [],
            alumnos: [],
            correos: [],
            errors: {},
            campos_trabajador: [
                { slug: 'emplea_nombre', name: 'Nombre' },
                { slug: 'emplea_apellidos', name: 'Apellido' }
            ],
            campos_alumno: [
                { slug: 'alu_matricula', name : 'Matricula' },
                { slug: 'alu_nombre', name: 'Nombre' },
                { slug: 'alu_apellido', name: 'Apellido' }
            ]
        }
    },

    methods: {
        ...mapActions(['sendPostForm']),

        changeView(view) {
            this.view = view
        },

        isView(view) {
            if (this.view === view)
            return true
            else
            return false
        },

        showTrabajadoresPdf() {
            var doc = new jsPDF();
            let users    = this.trabajadores
            let cursorX  = 20
            let cursorY  = 20
            let lineStep = 6

            doc.setFontSize(10)
            doc.text(cursorX, cursorY, 'Trabajadores', 'center')
            cursorY += lineStep

            for (let i in users) {
                let name = users[i].nombre + ' ' + users[i].paterno + ' ' + users[i].materno
                doc.text(cursorX, cursorY, name)
                cursorY += lineStep
            }
            doc.save('reporte.pdf')
            
            window.open(doc.output('bloburl'), '_blank')
        },

        showAlumnosPdf() {
            var doc = new jsPDF();
            doc.text(20, 20, 'Hola mundo')
            for (let alum of this.alumnos) {
                console.log(alum)
                //doc.text(20, 20, alum.nombre)
            }
            //doc.save('reporte.pdf')
            
            window.open(doc.output('bloburl'), '_blank')
        },

        showEmailPdf() {
            var doc = new jsPDF();
            doc.text(20, 20, 'Hola mundo')
            //doc.save('reporte.pdf')
            
            window.open(doc.output('bloburl'), '_blank')
        },

        sendForm(e) {
            let dataJson = new FormData(e.target)
            swal.fire({ toast: true, title: 'Cargando...', showConfirmButton: false })
            this.errors = {}

            axios.post(e.target.action, dataJson)
            .then(res => {
                swal.close()
                if (res.data.type === 'empleados') {
                    this.trabajadores = res.data.data
                } else if (res.data.type === 'alumnos') {
                    this.alumnos = res.data.data
                } else {
                    this.correos = res.data.data
                }
            })
            .catch(error => {
                if (error.response.status === 422) {
                    swal.close()
                    this.errors = error.response.data.errors
                }
            })
            e.preventDefault()
        }
    }
}
</script>