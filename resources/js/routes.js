import Login from "./components/MyAdmin/Login";
import Dashboard from "./components/MyAdmin/Dashboard";
import Header from "./components/MyAdmin/Header";
import Logout from "./components/MyAdmin/Logout";





import BlogTemplate from "./components/MyAdmin/Blog/Template";
import BlogList from "./components/MyAdmin/Blog/List";
import BlogInfo from "./components/MyAdmin/Blog/Info";
import BlogEdit from "./components/MyAdmin/Blog/Edit";
import BlogAdd from "./components/MyAdmin/Blog/Add";


import MenuTemplate from "./components/MyAdmin/Menu/Template";
import MenuList from "./components/MyAdmin/Menu/List";
import MenuInfo from "./components/MyAdmin/Menu/Info";
import MenuEdit from "./components/MyAdmin/Menu/Edit";
import MenuAdd from "./components/MyAdmin/Menu/Add";


import CoinAddressTemplate from "./components/MyAdmin/CoinAddress/Template";
import CoinAddressList from "./components/MyAdmin/CoinAddress/List";
import CoinAddressInfo from "./components/MyAdmin/CoinAddress/Info";
import CoinAddressEdit from "./components/MyAdmin/CoinAddress/Edit";
import CoinAddressAdd from "./components/MyAdmin/CoinAddress/Add";
import CoinAddressBalance from "./components/MyAdmin/CoinAddress/Balance";




export const routes = [



    //named component ROUTE
    {
        path: '', components: {
            default: Login,
            'header': Header
        }, name: 'home'
    },


    //simple ROUTE
    { path: '/dashboard', component: Dashboard },
    { path: '/logout', component: Logout },


    //Blog
    {
        path: '/blog', component: BlogTemplate, children: [
            { path: '', component: BlogList, name: 'blogList' },
            { path: 'add', component: BlogAdd, props: true, name: 'blogAdd' },
            { path: ':id', component: BlogInfo, props: true, name: 'blogInfo' },
            { path: ':id/edit', component: BlogEdit, props: true, name: 'blogEdit' },
        ]
    },

    //Menu
    {
        path: '/menu', component: MenuTemplate, children: [
            { path: '', component: MenuList, name: 'menuList' },
            { path: 'add', component: MenuAdd, props: true, name: 'menuAdd' },
            { path: ':id', component: MenuInfo, props: true, name: 'menuInfo' },
            { path: ':id/edit', component: MenuEdit, props: true, name: 'menuEdit' },
        ]
    },


    //coinAddress
    {
        path: '/coinAddress', component: CoinAddressTemplate, children: [
            { path: '', component: CoinAddressList, name: 'coinAddressList' },
            { path: 'add', component: CoinAddressAdd, props: true, name: 'coinAddressAdd' },
            { path: ':id', component: CoinAddressInfo, props: true, name: 'coinAddressInfo' },
            { path: ':id/edit', component: CoinAddressEdit, props: true, name: 'coinAddressEdit' },
            { path: ':id/balance', component: CoinAddressBalance, props: true, name: 'coinAddressBalance' },
        ]
    },

    //Redirect ROUTE
    { path: '/redirect-me', redirect: '/users' },

    //Redirect ROUTE 2nd way
    {
        path: '/redirect-me-2',
        redirect: to => { return '/dashboard'; }
    },

    //Redirect all routes ROUTE
    // {path: '*', redirect: '/'}`
];
