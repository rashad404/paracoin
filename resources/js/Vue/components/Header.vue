<template>
    <div>
        <flash-component></flash-component>
        <div ref="allSite" class="all-site" @click="toggleSidebar"></div>
        <section ref="leftSideBar" class="admin-left-sidebar" >
            <div class="title">
                {{title}}
            </div>
            <ul>
                <li v-for="link in links">
                    <router-link :to=link.url active-class="active-menu" exact>
                        <i :class="link.icon"></i> {{link.name}}
                    </router-link>
                </li>
            </ul>
        </section>
        <section ref="headerTop" class="admin-header-top">
            <div class="top-links">
                <i class="fas fa-bars" @click="toggleSidebar"></i> Dashboard
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="my-admin#/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="my-admin#/blog">Blog</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>
        </section>
    </div>
</template>

<script>
    import { mapState} from 'vuex';
    import Flash from "./Flash";
    export default{
        data(){
            return{
                window: {
                    width: 0
                },
                'sideBarView': null,
                'links': [
                    {'name':'Dashboard',    'url':'/',          'icon':'fas fa-tachometer-alt'},
                    {'name':'Menu',         'url':'/menu',      'icon':'fas fa-bars'},
                    {'name':'Blog',         'url':'/blog',      'icon':'fas fa-newspaper'},
                    {'name':'Team',         'url':'/team',      'icon':'fas fa-users'},
                    {'name':'Text',         'url':'/text',      'icon':'fas fa-file-word'},
                    {'name':'Logout',       'url':'/logout',    'icon':'fas fa-sign-out-alt'},
                ]
            }
        },
        computed: {
            ...mapState('general',[
                'title'
            ])
        },

        mounted() {
            window.addEventListener('resize', this.handleResize);
            this.handleResize();
        },
        destroyed() {
            window.removeEventListener('resize', this.handleResize);
        },
        methods: {
            handleResize() {
                this.window.width = window.innerWidth;

                if(this.window.width<768 && this.sideBarView===null){
                    this.hideSideBar();
                }

                if(this.window.width>768 && this.sideBarView===false){
                    this.showSideBar();
                }
                
                if(this.window.width<768 && this.sideBarView===true){
                    this.$refs.allSite.style.display = 'block';
                }
                if(this.window.width>768){
                    this.$refs.allSite.style.display = 'none';
                }
            },
            showSideBar(){
                this.sideBarView = true;
                if(this.window.width<768) {
                    this.$refs.allSite.style.display = 'block';
                }
                this.$refs.leftSideBar.style.display = "block";
                this.$refs.headerTop.style.marginLeft = '255px';
                this.$parent.$parent.$refs.myAdmin.style.marginLeft = '255px';
                console.log('toggle','set true');
            },
            hideSideBar(){
                this.sideBarView = false;
                this.$refs.allSite.style.display = 'none';
                this.$refs.leftSideBar.style.display = "none";
                this.$refs.headerTop.style.marginLeft = '0';
                this.$parent.$parent.$refs.myAdmin.style.marginLeft = '0';
                console.log('toggle','set false');
            },

            toggleSidebar(){
                if(this.sideBarView===false){
                    this.showSideBar();
                }else{
                    this.hideSideBar();
                }
            }
        },

        components: {
            flashComponent: Flash
        },
    }
</script>
