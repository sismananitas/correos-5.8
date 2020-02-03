import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex)

export default new Vuex.Store({
    state: {        
        response: null,
        errors: [],
        emails: {},
        email: {
            login: null,
            password: null,
            status: null
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
            axios.get('/api/emails')
            .then(res => {
                commit('setEmails', res.data);
            })
        },
        showEmail({ commit }, id) {
            return axios.get('/api/emails/' + id)
            .then(res => {
                commit('setEmail', res.data)
            })
        },
        getStudents({ commit }) {
            return axios.get('/api/students')
            .then(res => {
                commit('setStudents', res.data);
            })
        },
        showStudent({ commit }, id) {
            axios.get('/api/students/' + id)
            .then(res => {
                commit('setStudent', res.data)
            })
        },

        getEmployees({ commit }) {
            swal.showLoading()
            axios.get('/api/employees')
            .then(res => {
                commit('setEmployees', res.data)
                swal.close()
            })
        },

        sendPostForm({ commit }, { url, data }) {
            showLoading()

            commit('setResponse', null)
            commit('setErrors', [])

            return axios.post(url, data)
            .then(res => {
                commit('setResponse', res.data)
            })
            .catch(failue => {
                commit('setErrors', failue.response.data.errors)
                swal.fire({ type: 'error', title: 'Datos incorrectos' })                
            })
        }
    }
})