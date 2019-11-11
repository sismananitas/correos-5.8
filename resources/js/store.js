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
        setStudents(state, students) {
            state.students = students;
        }
    },

    actions: {
        getEmails({ commit }) {
            Axios.get('api/emails')
            .then(res => {
                commit('setEmails', res.data);
            })
        },
        getStudents({ commit }) {
            Axios.get('api/students')
            .then(res => {
                commit('setStudents', res.data);
                console.log(res); 
            })
        }
    }
})