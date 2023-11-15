import DropdownList from '../DropdownList.vue'
import CategoryList from '../CategoryList.vue'

import { moduleName, moduleTitle } from '../moduleConfig.js';
import {mapGetters} from 'vuex';
import Flash from "../../Flash";

export default {
    data: function (){
        return {
            image: '',//Photo Upload
            imageUrl: null,//Photo Upload
            dropdownSelection: {},
            categorySelection: {},
            //form
            form: {
                category: '',
                title: '',
                price: '',
                brand: '',
                description: '',
                image: '',
            },

            //extra defaults


            errorHints: {
                category: '',
                title: '',
                price: '',
                brand: '',
                description: '',
                image: '',
                submit: '',
            },
            showModal: false,
            submitDisable: true,

        }
    },
    computed: {
        moduleTitle(){
            return moduleTitle;
        },
        ...mapGetters('flash',[
            'flash'
        ]),
    },

    methods: {
        dragover(event) {
            event.preventDefault();
            // Add some visual fluff to show the user can drop its files
            if (!event.currentTarget.classList.contains('bg-green-300')) {
                event.currentTarget.classList.remove('bg-gray-100');
                event.currentTarget.classList.add('bg-green-300');
            }
        },
        dragleave(event) {
            // Clean up
            event.currentTarget.classList.add('bg-gray-100');
            event.currentTarget.classList.remove('bg-green-300');
        },
        drop(event) {
            event.preventDefault();
            this.$refs.fileInput.files = event.dataTransfer.files;
            this.onChange(); // Trigger the onChange event manually
            // Clean up
            event.currentTarget.classList.add('bg-gray-100');
            event.currentTarget.classList.remove('bg-green-300');
        },

        validationErrors(errors){
            errors = Object.values(errors);
            errors = errors.flat();
            return errors;
        },

        submit(){

            this.errorHints = {
                category: '',
                title: '',
                price: '',
                brand: '',
                description: '',
                image: '',
                submit: '',
            }
            let formData = new FormData();

            formData.append('category_id', this.categorySelection.id)
            formData.append('title', this.form.title)
            formData.append('price', this.form.price);
            formData.append('brand', this.form.brand);
            formData.append('description', this.form.description);
            formData.append('image', this.form.image);

            axios.post('/'+moduleName+'/add', formData)
                .then(response => {
                    console.log('response',response.data);
                    window.location = '/';
                    this.$store.dispatch('flash/setSuccess', 'Successfully Added');
                }).catch(err => {

                    this.$store.dispatch('flash/setError', this.validationErrors(err.response.data.errors));
                })

        },

        checkSubmitDisable(){
            if(this.errorHints.category === false
                && this.errorHints.title === false
                && this.errorHints.price === false
                && this.errorHints.brand === false
                && this.errorHints.description === false
            ){
                this.submitDisable = false;
            }else{
                this.submitDisable = true;
            }
        },

        updateError(inputKey){

            this.$delete(this.errorHints, inputKey);

            let inputValue = this.form[inputKey];

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
        //Photo Upload
        onImageChange(e){
            this.image = e.target.files[0];
            if(this.image){
                this.imageUrl = URL.createObjectURL(this.image);
            }
        },

        selectImage () {
            this.$refs.fileInput.click()
        },

    },
    components: {
        DropdownList,
        CategoryList,
        flashComponent: Flash
    }

}