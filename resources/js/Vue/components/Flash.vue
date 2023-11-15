<template>
    <div>
        <div v-if="display">


            <div v-if="flash && flash.error" class="flash-message error">
                <div class="float-left">
                    <div class="title">
                        Error
                    </div>
                    <div class="text">
                        <div v-for="(value) in flash.error">- {{ value }}</div>
                    </div>
                </div>
                <div class="flash-message-close" @click="closeFlash">
                    CLOSE
                </div>
                <div class="clearfix"></div>
            </div>

            <div v-else-if="flash && flash.success" class="flash-message">
                <div class="float-left">
                    <div class="title">
                        Success
                    </div>
                    <div class="text">
                        {{ flash.success }}
                    </div>
                </div>
                <div class="flash-message-close" @click="closeFlash">
                    CLOSE
                </div>
                <div class="clearfix"></div>
            </div>


            <div v-else></div>
        </div>


    </div>
</template>

<script>


    import { mapGetters } from 'vuex';

    export default {
        computed: {
            ...mapGetters('flash',[
                'flash','display'
            ]),
        },
        methods: {
            closeFlash() {
                this.$store.dispatch('flash/resetFlash');
            },
        }
    }
</script>

<style lang="scss">

    .error{
        color: red!important;
        -webkit-box-shadow: 0 0 6px 2px rgba(0, 162, 27, 0.38);
        box-shadow: 0 0 6px 2px rgba(0, 162, 27, 0.38);
    }

    .flash-message{
        position: fixed;
        background-color: #fff;
        color: green;
        z-index: 10000;
        top: 75px;
        left: 50%;
        -webkit-transform: translateX(50%);
        -ms-transform: translateX(50%);
        transform: translateX(-50%);
        -webkit-box-shadow: 0 0 2px 6px rgba(255, 0, 0, 0.35);
        box-shadow: 0 0 6px 2px rgba(255, 0, 0, 0.35);
        border-radius: 5px;
        max-width:600px;
        width:90%;



        .success{
            border-left: 8px solid green;
        }
        .error{
            border-left: 8px solid #FD3030;
        }
         .float-left{
            padding: 15px 20px;
            border-right: 1px solid rgba(208, 209, 231, 0.55);
            width: calc(100% - 100px);
        }
         .float-left .title{
            font-weight: bold;
            font-family: Arial, "Raleway", sans-serif;
            font-size: 16px;
        }
         .float-left .text{
            color: #b8b9cc;
        }
        .flash-message-close{
            position: absolute;
            top:50%;
            transform: translateY(-50%);
            right:0;
            color: #b8b9cc;
            font-size: 14px;
            width: 100px;
            text-align: center;
            font-weight: bold;
        }
        .flash-message-close:hover{
            color: #62636d;
            cursor: pointer;
        }
    }

</style>