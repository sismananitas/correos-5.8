import Vue from 'vue';
import Vuex from 'vuex';
import Axios from 'axios';
// import Swal from 'sweetalert2';

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        emails: [],
        email: {},

        employees: [],
        employee: {},
        
        students: [],
        student: {
            enrollment: ''
        }
    },

    mutations: {
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
            Axios.get('api/emails')
            .then(res => {
                commit('setEmails', res.data);
            })
        },
        showEmail({ commit }, id) {
            Axios.get('api/emails/' + id)
            .then(res => {
                commit('setEmail', res.data)
            })
        },

        getStudents({ commit }) {
            Axios.get('api/students')
            .then(res => {
                commit('setStudents', res.data);
            })
        },
        showStudent({ commit }, id) {
            Axios.get('api/students/' + id)
            .then(res => {
                commit('setStudent', res.data)
            })
        },

        getEmployees({ commit }) {
            Axios.get('api/employess')
            .then(res => {
                commit('setEmployees', res.data)
            })
        }
    }
})