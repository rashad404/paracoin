
import { moduleName, moduleTitle } from './moduleConfig.js';

export default {
    data: function (){
        return {
            // Default prices
            logoSimplePrice: 300,
            logoCustomPrice: 1200,
            pagePrice: 100,

            prices: {
                responsive: 500,
                member_login: 1000,
                blog: 500,
                forum: 700,
                messaging: 1200,
                live_chat: 200,
                gallery: 600,
                contact: 200,

                search: 500,
                map: 800,
                booking: 600,
                social_integration: 200,
                analytics: 50,

                seo_meta: 500,
                seo_keyword: 800,
                seo_advanced: 1200,
                seo_tags: 400,
                seo_sitemap: 100,
            },
            costs: {
                add_ons: 0,
                seo: 0,
            },

            //inputs
            page_count: 1,
            design_type: 1,
            logo_type: 0,

            //form
            form: {
                name: '',
                phone: '',
                email: '',
                note: '',
            },

            //extra defaults
            pageCountMin: 1,
            pageCountMax: 20,
            errorHints: {
                name: '',
                phone: '',
                email: '',
            },
            showModal: false,
            submitDisable: true,
            successModal: false,

        }
    },
    computed: {
        moduleTitle(){
            return moduleTitle;
        },
        pageCost: function () {
            return this.page_count * this.pagePrice * this.design_type
        },
        logoCost: function () {
            if(this.logo_type === "1"){
                return this.logoSimplePrice
            }else if(this.logo_type === "2"){
                return this.logoCustomPrice
            }else{
                 return 0;
            }
        },
        totalEstimate: function () {
            return this.pageCost + this.costs.add_ons + this.costs.seo + this.logoCost
        }
    },

    mounted() {

        //if default checked call relevant function on mounted
        this.selectedCheck('add_ons', 'responsive','plusOnly')
        this.selectedCheck('seo', 'seo_meta','plusOnly')
    },
    methods: {

        submit(){

            let formData = new FormData();

            formData.append('name', this.form.name)
            formData.append('phone', this.form.phone)
            formData.append('email', this.form.email)
            formData.append('note', this.form.note)

            formData.append('page_count', this.page_count)
            formData.append('design_type', this.design_type)
            formData.append('logo_type', this.logo_type)

            let appendList = this.prices;

            $.each(appendList, (key, value) => {
                console.log(key+ ', ' + value);
                formData.append(key, this.$refs[key].checked ?'1':'0')
            });


            // for (var pair of formData.entries()) {
            //     console.log(pair[0]+ ', ' + pair[1]);
            // }

            axios.post('/'+moduleName+'/send', formData)
                .then(response => {
                    console.log('response',response.data);
                    this.successModal = true;
                });

        },

        checkSubmitDisable(){
            if(this.errorHints.name === false && this.errorHints.phone === false && this.errorHints.email === false ){
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
            }else if(inputValue.length<3){
                this.errorHints[inputKey] = inputKey+' must contain at least 3 chars';
            }
            else if (inputKey==='email' && !/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(inputValue)){
                this.errorHints[inputKey] = inputKey+' is not valid';
            }
            else if (inputKey==='phone' && !/^([+]?[0-9]{10,14})+$/.test(inputValue)){
                this.errorHints[inputKey] = inputKey+' is not valid';
            }else{
                this.errorHints[inputKey] = false;
            }

            this.checkSubmitDisable();
        },

        reset(){
            this.showModal = false;
            this.successModal = false;
            this.form = {
                name: '',
                phone: '',
                email: '',
                note: '',
            };
            this.errorHints = {
                name: '',
                    phone: '',
                    email: '',
            }
        },

        selectedCheck: function (target, name, type) {
            if(this.$refs[name].checked === true) {
                this.costs[target] += this.prices[name];
            }else if(type!=='plusOnly'){
                this.costs[target] -= this.prices[name];
            }
        },
    },

}