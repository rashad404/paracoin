<template>
    <div>

        <div class="half_box_with_title">
            <div class="half_box_title">{{itemInfo.id}} Info
                <router-link
                        tag="button"
                        :to="{path: getEditLink(itemIndex)}"
                        class="btn btn-primary"><i class="fas fa-pencil-alt"></i></router-link>
            </div>
            <div class="half_box_body">

                <table class="default_vertical">
                    <tbody>

                    <tr v-for="(field) in fields">
                        <td>{{field.name}}:</td>
                        <td v-if="field.key==='image'">
                            <img :src="itemInfo[field.key]" alt="" width="300px">

                        </td>
                        <td v-else>{{itemInfo[field.key]}}</td>
                    </tr>

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</template>

<script>
    import { moduleName, moduleTitle } from './moduleConfig.js';

    import { mapGetters } from 'vuex';

    export default {
        computed: {
            ...mapGetters(moduleName,[
                'list','fields'
            ]),
            itemIndex: function () {
                return this.$route.params.id;
            },
            itemInfo: function () {
                return this.list[this.itemIndex];
            }
        },
        methods: {
            getEditLink(index){
                return index+'/'+'edit';
            },
        }
    }
</script>

<style>
    .half_box_with_title {
        border-radius: 3px;
        background: #ffffff;
        margin: 10px 0;
        /* padding: 15px 0; */
        box-shadow: 0 1px 1px rgba(0,0,0,0.1);
    }

    .half_box_title {
        border-radius: 3px 3px 0 0;
        background-color: #590594;
        color: #fff;
        padding: 10px 0 10px 20px;
        font-size: 16px;
    }
    .half_box_body {
        background-color: #fff;
        /* color: #fff; */
        padding: 10px;
        font-size: 14px;
    }

    table.default_vertical {
        width: 100%;
        border-collapse:collapse!important
    }
    table.default_vertical tr td:first-child {
        width: 30%;
        font-weight: bold;
        text-align: right;
    }

    table.default_vertical td {
         border: none;
        padding: 5px 20px;
        text-align: left;
        font-size: 16px;
        background-color: #fff;
    }
</style>
