<template>
    <div>
        <h3>Edit {{moduleTitle}}</h3>
        <p>{{moduleTitle}} ID: {{itemInfo.id}}</p>

        <form @submit.prevent="submit">

            <div class="form-group" v-for="(field,key) in fields">

                <label :for="field.key">{{field.name}}</label>


                <!--                Photo Upload-->
                <div v-if="field.type==='upload'">
                    <div id="preview" v-if="imageUrl || field.value">
                        <p><img :src="imageUrl?imageUrl:field.value" @click="selectImage"/></p>
                        <div class="change-button" @click="selectImage">Change image <i class="fas fa-edit"></i></div>
                    </div>

                    <div class="dropbox" v-show="!imageUrl && !field.value">
                        <input type="file"
                               ref="fileInput"
                               :name="field.key"
                               @change="onImageChange"
                               accept="image/*" class="input-file">

                        <p>
                            Drag your file(s) here to begin<br> or click to browse
                        </p>
                    </div>
                </div>

                <input v-if="field.type==='text'" class="form-control" type="text"
                       :id="field.key"
                       v-model="field.value"
                       @change="updateError(field.key)">

                <input v-if="field.type==='small-text'" class="form-control small-text" type="text"
                       :id="field.key"
                       v-model="field.value"
                       @change="updateError(field.key)">

                <input v-if="field.type==='checkBox'" class="checkBox"  type="checkbox" :id="field.key" v-model="field.value">

                <select class="form-control" v-if="field.type==='selectBox'" v-model="field.value">
                    <option :selected="field.value===0" value="">Please select one</option>
                    <option :selected="field.value===dataKey" v-for="(dataValue, dataKey) in field.data" :value="dataKey">
                        {{dataValue}}
                    </option>
                </select>

                <textarea v-if="field.type==='textarea'" class="form-control" @change="updateError(field.key)" v-model="field.value" rows="10"></textarea>



                <p class="alert-danger" style="padding:5px;margin-top:2px;"
                   v-if="errorHints && errorHints[field.key]">
                    {{errorHints[field.key]}}
                </p>
            </div>

            <button class="btn btn-primary" :disabled="isDisable" >Edit</button>
        </form>


    </div>
</template>

<script>
    import { moduleName, moduleTitle } from './moduleConfig.js';


    import {mapGetters} from 'vuex';

    export default {
        data(){
            return {
                errorHints: {},
                isDisable: false,
                image: '',//Photo Upload
                imageUrl: null//Photo Upload
            }
        },
        created(){
            this.$store.dispatch(moduleName+'/setFields', this.list[this.itemIndex]);
        },
        computed: {
            ...mapGetters(moduleName,[
                'list', 'fields'
            ]),
            moduleTitle(){
                return moduleTitle;
            },
            itemIndex: function () {
                return this.$route.params.id;
            },
            itemInfo: function () {
                return this.list[this.itemIndex];
            }
        },
        methods:{
            checkEmptyInputs(){

                let isEmpty = false;
                this.fields.forEach((item) => {
                    if(item.value.length<1 && item.key!=='image'){
                        isEmpty =true;
                    }
                });
                if(!isEmpty){
                    this.isDisable = false;
                }
            },

            updateError(inputKey){
                this.$delete(this.errorHints, inputKey);

                let inputData = this.getInputData();
                let inputValue = inputData[inputKey];

                //VALIDATION
                this.checkEmptyInputs();
                if(inputValue.length===0){
                    this.$set(this.errorHints, inputKey, inputKey+' can not be empty');
                }else if(inputValue.length<3){
                    this.$set(this.errorHints, inputKey, inputKey+' must contain at least 3 chars.');
                }

                if(this.errorHints && Object.keys( this.errorHints ).length >0){
                    this.isDisable = true;
                }

            },

            getInputData(){//get input data and check for empty field
                let inputData = {};
                this.fields.forEach((item) => {
                    inputData[item.key] = item.value;
                });
                return inputData;
            },
            submit(){
                const formData = new FormData();
                this.fields.forEach((item) => {
                    if(item.type==='upload'){//Photo Upload
                        formData.append(item.key, this.image);
                    }else{
                        formData.append(item.key, item.value);
                    }
                });


                axios.post('/my-admin/'+moduleName+'/edit/'+this.itemInfo.id, formData)
                    .then(response => {
                        this.$store.dispatch(moduleName+'/editItem', response.data);
                        this.$store.dispatch('flash/setSuccess', 'Updated')
                        // this.isDisable = true;
                    });

            },
            //Photo Upload
            onImageChange(e){
                this.image = e.target.files[0];
                if(this.image){
                    this.imageUrl = URL.createObjectURL(this.image);
                }
            },
            selectImage () {
                this.$refs.fileInput[0].click()
            },
        },

    }
</script>

<style scoped>
    img{
        width: 300px;
    }
</style>
