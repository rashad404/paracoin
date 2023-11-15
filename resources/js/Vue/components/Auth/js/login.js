
import { moduleName, moduleTitle } from '../moduleConfig.js';

export default {
    data: function (){
        return {

            //form
            form: {
                email: '',
                password: '',
            },

            //extra defaults

            errorHints: {
                email: '',
                password: '',
                auth: '',
            },
            showModal: false,
            submitDisable: true,

        }
    },
    computed: {
        moduleTitle(){
            return moduleTitle;
        },
    },

    methods: {

        submit(){

            this.errorHints = {
                email: '',
                password: '',
                auth: '',
            }
            let formData = new FormData();

            formData.append('email', this.form.email)
            formData.append('password', this.form.password)

            axios.post('/'+moduleName+'/login', formData)
                .then(response => {
                    console.log('response',response.data);
                    window.location = '/';
                }).catch(err => {
                this.errorHints.auth = err.response.data.auth;
                })

        },

        checkSubmitDisable(){
            if(this.errorHints.email === false && this.errorHints.password === false ){
                this.submitDisable = false;
            }else{
                this.submitDisable = true;
            }
        },

        updateError(inputKey){

            this.$delete(this.errorHints, inputKey);

            let inputValue = this.form[inputKey];
                console.log('inputValue',inputValue);

            //VALIDATION
            if(inputValue.length===0){
                this.errorHints[inputKey] = inputKey+' can not be empty';
            }else if(inputValue.length<4){
                this.errorHints[inputKey] = inputKey+' must contain at least 4 chars';
            }
            else if (inputKey==='email' && !/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(inputValue)){
                this.errorHints[inputKey] = inputKey+' is not valid';
            }else{
                this.errorHints[inputKey] = false;
            }

            this.checkSubmitDisable();
        },

        reset(){
            this.showModal = false;
            this.form = {
                email: '',
                password: '',
            };
            this.errorHints = {
                email: '',
                password: '',
                auth: '',
            }
        },

    },

}