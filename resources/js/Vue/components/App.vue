<template>
    <div>
        <div class="content">
            <header-component
                    v-if="
                    $route.name!='home'
                    && $route.name!='AuthLogin'
                    && $route.name!='AuthReg'
                    && $route.name!='ListingAdd'
                    "
            ></header-component>
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    import Header from "./Header";

    export default {
        components: {
            headerComponent: Header
        },
    }
</script>


<style scoped>

    .btn.btn-primary {
        background-color: #8324d4 !important;
    }

    input.small-text{
        width:100px;
    }
    input.checkBox{
        width: 15px;
        height: 15px;
        margin-left: 110px;
    }
    label{
        font-size: 14px;
        font-weight:bold;
        min-width: 200px;
    }

    .dropbox {
        outline: 2px dashed grey; /* the dash box */
        outline-offset: -10px;
        background: lightcyan;
        color: dimgray;
        padding: 10px 10px;
        min-height: 200px; /* minimum height */
        position: relative;
        cursor: pointer;
    }

    .input-file {
        opacity: 0; /* invisible but it's there! */
        width: 100%;
        height: 200px;
        position: absolute;
        cursor: pointer;
    }

    .dropbox:hover {
        background: lightblue; /* when mouse over to the drop zone, change color */
    }

    .dropbox p {
        font-size: 1.2em;
        text-align: center;
        padding: 50px 0;
    }

    #preview img {
        max-width: 100%;
        max-height: 200px;
    }
    #preview img:hover {
        cursor:pointer;
    }
    div.change-button{
        border: 0;
        border-radius: 4px;
        color: #fff;
        background-color: orangered;
        padding: 10px;
        max-width: 200px;
        cursor:pointer;
    }
    div.change-button:hover{
        background-color: #bf3400;
    }
</style>
