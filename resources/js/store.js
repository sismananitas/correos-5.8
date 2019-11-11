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

    actions: {
        getEmails(state) {
            Axios.get('api/emails')
            .then(res => {
                state.emails = res.data;
            })
        },
        getStudents(state) {
            Axios.get('api/students')
            .then(res => {
                state.students = res.data;
                console.log(res);
                
            })
        }
    }
})