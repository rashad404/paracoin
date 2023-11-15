<template>
    <div>
        <div style="margin-bottom: 20px;">
            <router-link
                    tag="a"
                    :to="{path: getAddLink()}"
                    style="cursor:pointer;"
                    class="btn btn-primary">Add new {{moduleTitle}}</router-link>
        </div>

        <table class="table table-hover">
            <thead class="thead-dark">
            <tr>
                <th v-for="(field) in listFields" scope="col">{{field.name}}</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(item, index) in list">
                <td v-for="(field) in listFields" scope="col">
                    <div v-if="field.type==='upload'"><img :src="item[field.key]" style="width:50px;" alt=""></div>
                    <div v-else>{{item[field.key]}}</div>

                </td>
                <td class="obButtons">
                    <router-link
                            tag="a"
                            :to="{path: getViewLink(index)}"
                            style="cursor:pointer;">
                            <i class="far fa-eye"></i>
                    </router-link>

                    <router-link
                            tag="a"
                            :to="{path: getEditLink(index)}"
                            style="cursor:pointer;">
                            <i class="fas fa-pencil-alt"></i>
                    </router-link>

                    <i class="fas fa-trash deleteButton" @click="deleteItem(item.id, index)"></i>
                </td>
            </tr>

            </tbody>
        </table>
    </div>
</template>

<script>
    import { moduleName, moduleTitle } from './moduleConfig.js';

    import { mapGetters } from 'vuex';
    export default {

        computed: {
            ...mapGetters(moduleName,[
                'list', 'listFields'
            ]),
            moduleTitle(){
                return moduleTitle;
            }

        },
        mounted() {
            if(Object.keys( this.list ).length === 0) {
                axios.get('/my-admin/'+moduleName+'/list').then(response => {
                    this.$store.dispatch(moduleName+'/updateList', response.data);
                });
            }
        },
        methods:{
            getAddLink(){
                return moduleName+'/add';
            },
            getViewLink(index){
                return moduleName+'/'+index;
            },
            getEditLink(index){
                return moduleName+'/'+index+'/'+'edit';
            },

            deleteItem(id, index) {
                if(confirm("Do you really want to delete?")) {
                    console.log('delete', id);
                    axios.post('/my-admin/'+moduleName+'/delete', {'id': id}).then(response => {
                        if(response.data){
                            console.log('response',response.data);
                            this.$store.dispatch(moduleName+'/deleteItem', index);
                            this.$store.dispatch('flash/setSuccess', 'Successfully Deleted');
                        }else{
                            this.$store.dispatch('flash/setError', 'Delete Error');
                        }


                    });
                }
            }
        }
    }
</script>

<style scoped>
    a:active, a:hover, a.router-link-active{
        color: #ababdc !important;
        border: 0!important;
        margin: 0!important;
    }
    tr:nth-child(even) {
        background-color: #fff;
    }
    .table-hover tbody tr:hover {
        color: #212529;
        background-color: rgba(0, 0, 0, 0.02);
    }

    td.obButtons{
        width: 120px;
    }
    td{
        text-align: left;
        padding-left: 10px!important;
    }
    td.obButtons i{
        color: #fff;
        padding: 5px;
        border-radius: 2px;
        margin: 1px;
    }
    td.obButtons i:hover{
        background-color: gray!important;
    }
    td.obButtons i.fa-eye{
        background-color: #007a00;
    }
    td.obButtons i.fa-pencil-alt{
        background-color: #673194;
    }
    td.obButtons i.fa-trash{
        background-color: #dd4b39;
    }
</style>
