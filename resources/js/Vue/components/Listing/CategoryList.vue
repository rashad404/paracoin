<template>
    <div class="dropdown form-group">
        <div v-if="Object.keys(selectedItem).length === 0">
            <input
                   ref="dropdowninput"
                   v-model.trim="inputValue"
                   @click="updateError"
                   class="dropdown-input" type="text"
                   placeholder=" "/>
            <span class="floating-label">Category</span>
        </div>


        <div v-else @click="resetSelection" class="dropdown-selected">
            <i :class="['fas', 'fa-'+selectedItem.icon, 'dropdown-item-icon']"></i>
            {{ selectedItem.name }}
        </div>

        {{this.selectError}}
        <div v-if="selectError" class="errorHints">{{this.selectError}}</div>

        <div v-show="inputValue && apiLoaded" class="dropdown-list">
            <div @click="selectItem(item)" v-show="itemVisible(item)" v-for="item in itemList" :key="item.name" class="dropdown-item">
                <i :class="['fas', 'fa-'+item.icon, 'dropdown-item-icon']"></i>
                {{ item.name }}
            </div>
        </div>
    </div>
</template>

<script>
    import { moduleName } from './moduleConfig.js';
    import axios from 'axios'
    export default {
        data () {
            return {
                selectError: '',
                selectedItem: {},
                inputValue: '',
                itemList: [],
                apiLoaded: false,
                apiUrl: '/'+moduleName+'/get/category_list'
            }
        },
        mounted () {
            this.getList()
        },
        methods: {
            updateError(){

                this.selectError = '';

                //VALIDATION

                if(this.inputValue.length===0){
                    this.selectError = 'Category can not be empty';
                // }else if(this.selectedItem.id<1){
                //     this.selectError = 'Category is not correct';
                }else{
                    this.selectError = false;
                }

            },
            resetSelection () {
                this.selectedItem = {}
                this.$nextTick( () => this.$refs.dropdowninput.focus() )
                this.$emit('on-item-reset')
            },
            selectItem (theItem) {
                this.selectedItem = theItem
                this.inputValue = ''
                this.$emit('on-item-selected', theItem)
            },
            itemVisible (item) {
                let currentName = item.name.toLowerCase()
                let currentInput = this.inputValue.toLowerCase()
                return currentName.includes(currentInput)
            },
            getList () {
                axios.get(this.apiUrl).then( response => {
                    this.itemList = response.data
                    this.apiLoaded = true
                })
            }
        }
    }
</script>

<style scoped>
    .dropdown{
        position: relative;
        width: 100%;
    }
    .dropdown-input{
        width: 100%;
        background: #ffffff;
        line-height: 1.5em;
        outline: none;
        font-size: 14px;
        padding: 0px 20px;
        border: 1px solid #E9E9E9;
        border-radius: 5px;
        max-width: 460px;
    }
    .dropdown-selected{
        width: 100%;
        background: #ffffff;
        line-height: 1.5em;
        outline: none;
        font-size: 14px;
        padding: 12px 20px;
        border: 1px solid #E9E9E9;
        border-radius: 5px;
        max-width: 460px;
    }
    .dropdown-input:focus, .dropdown-selected:hover{
        background: #fff;
        border-color: #e2e8f0;
    }
    .dropdown-input::placeholder{
        opacity: 0.7;
    }
    .dropdown-selected{
        font-weight: bold;
        cursor: pointer;
    }
    .dropdown-list{
        position: absolute;
        width: 100%;
        max-width: 460px;
        max-height: 500px;
        margin-top: 4px;
        overflow-y: auto;
        background: #ffffff;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        border-radius: 8px;
        z-index:100;
    }
    .dropdown-item{
        display: flex;
        width: 100%;
        padding: 11px 16px;
        vertical-align: middle;
        line-height: 40px;
        cursor: pointer;
    }
    .dropdown-item:hover{
        background: #edf2f7;
    }
    .dropdown-item-icon{
        margin: auto 12px auto 0px;
        font-size: 16px;
        padding: 10px;
        border-radius: 50%;
        background-color: #e6ecf5;
    }

    .floating-label {
        position: absolute;
        pointer-events: none;
        left: 20px;
        top: 22px;
        transition: 0.2s ease all;
        color: #6c7781;
        font-size: 14px;
    }


    div.form-group{
        position: relative;
    }
    input,textarea{
        font-size: 14px;
        padding: 30px 20px;
        border: 1px solid #E9E9E9;
        border-radius: 5px;
        max-width: 460px;
        margin-bottom: 10px;
    }
    input:focus ~ .floating-label,
    textarea:focus ~ .floating-label,
    input:not(:placeholder-shown) ~ .floating-label,
    textarea:not(:placeholder-shown) ~ .floating-label{
        top: 8px;
        bottom: 10px;
        left: 20px;
        font-size: 11px;
        opacity: 1;
        color: #54a1d1;
    }
    input:focus ,
    input:not(:focus):valid,
    input:not(:placeholder-shown){
        padding: 30px 20px 10px 20px!important;
    }
</style>