<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        computed: {
            currentRouteName() {
                return this.$route.name;
            }
        },
    }
</script>
