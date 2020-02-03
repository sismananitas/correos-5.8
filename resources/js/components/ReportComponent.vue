<template>
    <div>
        <div class="toolbar btn-group mb-3">
            <button class="btn btn-secondary" :class="{ 'active' : isView('trabajadores') }" @click="changeView('trabajadores')">Trabajadores</button>
            <button class="btn btn-secondary" :class="{ 'active' : isView('alumnos') }" @click="changeView('alumnos')">Alumnos</button>
            <button class="btn btn-secondary" :class="{ 'active' : isView('correos') }" @click="changeView('correos')">Correos</button>
        </div>

        <h4>Campos a mostrar</h4>
        <div class="d-flex align-items-center">
            <div class="form-group mr-3">
                <label for="curp">Curp / Matricula</label>
                <input id="curp" type="checkbox" v-model="showCurp">
            </div>

            <div class="form-group mr-3">
                <label for="depend">Dependencia / Unidad</label>
                <input id="depend" type="checkbox" v-model="showDepend">
            </div>

            <div class="form-group mr-3">
                <label for="grade">Grado</label>
                <input id="grade" type="checkbox" v-model="showGrade">
            </div>

            <div class="form-group mr-3">
                <label for="type-emplea">Tipo Empleado</label>
                <input id="type-emplea" type="checkbox" v-model="showTypeEmplea">
            </div>
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
            <table id="table_trabajadores" class="table table-striped text-center mt-3">
                <thead class="thead-dark">
                    <tr>
                        <th v-if="showCurp">Curp</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th v-if="showDepend">Dependencia</th>
                        <th v-if="showTypeEmplea">T. Empleado</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="trabajador in trabajadores" :key="trabajador.id">
                        <td v-if="showCurp">{{ trabajador.curp }}</td>
                        <td>{{ trabajador.nombre }}</td>
                        <td>{{ trabajador.paterno }} {{ trabajador.materno }}</td>
                        <td v-if="showDepend">{{ trabajador.nomdep }}</td>
                        <td v-if="showTypeEmplea">{{ trabajador.tipemp }}</td>
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
            <table id="table_alumnos" class="table table-striped text-center mt-3">
                <thead class="thead-dark">
                    <tr v-if="showCurp">
                        <th>Matricula</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Status</th>
                        <th v-if="showGrade">Grado</th>
                        <th v-if="showDepend">Unidad</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="alumno in alumnos" :key="alumno.id">
                        <td v-if="showCurp">{{ alumno.matricula }}</td>
                        <td>{{ alumno.nombre }}</td>
                        <td>{{ alumno.ap_paterno }} {{ alumno.ap_materno }}</td>
                        <td>{{ alumno.status }}</td>
                        <td v-if="showGrade">{{ alumno.grado }}</td>
                        <td v-if="showDepend">{{ alumno.unidad }}</td>
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
                    <option value="email">Login</option>
                    <option value="alumno">Tipo alumno</option>
                    <option value="trabajador">Tipo trabajador</option>
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
            <table id="table_correos" class="table table-striped text-center mt-3">
                <thead class="thead-dark">
                    <tr>
                        <th>Id</th>
                        <th>Login</th>
                        <th>Password</th>
                        <th>Tipo</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="correo in correos" :key="correo.id">
                        <td>{{ correo.id }}</td>
                        <td>{{ correo.login }}</td>
                        <td>{{ correo.password }}</td>
                        <td>{{ correo.type }}</td>
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
import 'jspdf-autotable'

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
            ],
            showCurp: true,
            showDepend: true,
            showGrade: true,
            showTypeEmplea: true
        }
    },

    methods: {
        changeView(view) {
            this.view = view
        },

        isView(view) {
            if (this.view === view)
            return true
            else
            return false
        },

        /**
         * Crea el reporte y lo emprime en otra pestaña
         */
        showTrabajadoresPdf() {
            var doc = new jsPDF();
            let users    = this.trabajadores
            let cursorX  = 20
            let cursorY  = 20
            let lineStep = 6

            doc.setFontSize(30)
            doc.text(100, cursorY, 'Trabajadores', 'center')
            cursorY += lineStep
            cursorY += lineStep
            doc.setFontSize(9)

            doc.autoTable({
                html: '#table_trabajadores',
                margin: { top: 32 }
            })

            doc.save('reporte.pdf')
            
            window.open(doc.output('bloburl'), '_blank')
        },

        /**
         * Crea el reporte de los alumnos y los imprime en otra pestaña.
         */
        showAlumnosPdf() {
            var doc = new jsPDF();
            let users    = this.alumnos
            let cursorX  = 20
            let cursorY  = 20
            let lineStep = 6

            doc.setFontSize(30)
            doc.text(100, cursorY, 'Alumnos', 'center')
            cursorY += lineStep
            cursorY += lineStep
            doc.setFontSize(9)

            doc.autoTable({
                html: '#table_alumnos',
                margin: { top: 32 }
            })

            doc.save('reporte.pdf')
            
            window.open(doc.output('bloburl'), '_blank')
        },

        showEmailPdf() {
            var doc = new jsPDF();
            let users    = this.correos
            let cursorX  = 20
            let cursorY  = 20
            let lineStep = 6

            doc.setFontSize(30)
            doc.text(100, cursorY, 'Correos', 'center')
            cursorY += lineStep
            cursorY += lineStep
            doc.setFontSize(9)

            doc.autoTable({
                html: '#table_correos',
                margin: { top: 32 }
            })

            doc.save('reporte.pdf')
            
            window.open(doc.output('bloburl'), '_blank')
        },

        sendForm(e) {
            let data = new FormData(e.target)
            showLoading()
            this.errors = {}

            axios.post(e.target.action, data)
            .then(res => {
                closeLoading()
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
                    closeLoading()
                    this.errors = error.response.data.errors
                }
            })
            e.preventDefault()
        }
    }
}
</script>