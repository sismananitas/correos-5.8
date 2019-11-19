import Vue from 'vue';
import Vuex from 'vuex';
import Swal from 'sweetalert2';

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        response: null,
        errors: null,
        emails: [],
        email: null,

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
            axios.get('/api/emails/' + id)
            .then(res => {
                commit('setEmail', res.data)
            })
        },

        getStudents({ commit }) {
            axios.get('/api/students')
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
            Swal.showLoading()
            axios.get('/api/employees')
            .then(res => {
                commit('setEmployees', res.data)
                Swal.close()
            })
        }
    }
})