<template>
    <div></div>
</template>

<script>

    export default {
        created: function(){
            console.log('logout');
            this.$store.dispatch('auth/updateId', 0);
            this.$router.push('/')

        },
    }
</script>
