import Vue from 'vue';
import Vuex from 'vuex';
import Swal from 'sweetalert2';

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        spinner: `<div class="spinner-border text-primary" role="status">
        <span class="sr-only">Loading...</span>
        </div>`,
        response: null,
        errors: null,
        emails: [],
        email: {
            login: null,
            password: null
        },

        employees: [],
        employee: null,
        
        students: [],
        student: {
            enrollment: ''
        }
    },

    mutations: {
        setResponse(state, response) {
            state.response = response;
        },

        setErrors(state, errors) {
            state.errors = errors;
        },

        setEmails(state, emails) {
            state.emails = emails;
        },
        setEmail(state, email) {
            state.email = email;
        },
        setStudents(state, students) {
            state.students = students;
        },
        setStudent(state, student) {
            state.student = student;
        },
        setEmployees(state, employees) {
            state.employees = employees;
        }
    },

    actions: {
        getEmails({ commit }) {
            axios.get('/correos/public/api/emails')
            .then(res => {
                commit('setEmails', res.data);
            })
        },
        showEmail({ commit }, id) {
            axios.get('/correos/public/api/emails/' + id)
            .then(res => {
                commit('setEmail', res.data)
            })
        },

        getStudents({ commit }) {
            axios.get('/correos/public/api/students')
            .then(res => {
                commit('setStudents', res.data);
            })
        },
        showStudent({ commit }, id) {
            axios.get('/correos/public/api/students/' + id)
            .then(res => {
                commit('setStudent', res.data)
            })
        },

        getEmployees({ commit }) {
            Swal.showLoading()
            axios.get('/correos/public/api/employees')
            .then(res => {
                commit('setEmployees', res.data)
                Swal.close()
            })
        },

        sendPostForm({ commit }, { url, data }) {
            Swal.fire({
                toast: true,
                title: 'Cargando...',
                showConfirmButton: false
            })

            commit('setResponse', null)
            commit('setErrors', [])

            return axios.post(url, data)
            .then(res => {
                commit('setResponse', res.data)
            })
            .catch(failue => {
                commit('setErrors', failue.response.data.errors)
                Swal.fire({ type: 'error', title: 'Datos incorrectos' })                
            })
        }
    }
})