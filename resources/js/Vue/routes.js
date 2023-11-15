import PriceCalculator from "./components/PriceCalculator/Main";

import Dashboard from "./components/Dashboard";
import Header from "./components/Header";
import Logout from "./components/Logout";




import AuthTemplate from "./components/Auth/Template";
import AuthLogin from "./components/Auth/Login";
import AuthReg from "./components/Auth/Registration";

import ListingTemplate from "./components/Listing/Template";
import ListingAdd from "./components/Listing/Add";



export const routes = [



    //named component ROUTE
    {path: '', components: {
            default: PriceCalculator,
            'header': Header,
        }, name: 'home'},

    {path: '/dashboard', component: Dashboard},
    {path: '/logout', component: Logout},


    //Auth
    {path: '/', component: AuthTemplate, children: [
            {path: 'login', component: AuthLogin, name: 'AuthLogin'},
            {path: 'registration', component: AuthReg, props:true, name: 'AuthReg'},
        ]},

    //Listing
    {path: '/', component: ListingTemplate, children: [
            {path: 'add', component: ListingAdd, name: 'ListingAdd'},
        ]},



];
