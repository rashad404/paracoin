import Vue from 'vue';
import Vuex from 'vuex';

import general from './modules/general';
import auth from './modules/auth';
import flash from './modules/flash';
import blog from './modules/blog';
import studio from './modules/studio';
import photo from './modules/photo';
import gift from './modules/gift';
import master from './modules/master';
import clothing from './modules/clothing';
import tech from './modules/tech';
import campaign from './modules/campaign';
import menu from './modules/menu';
import category from './modules/category';
import text from './modules/text';
import aboutus from './modules/aboutus';
import faq from './modules/faq';
import contactemail from './modules/contactemail';
import contactphone from './modules/contactphone';
import social from './modules/social';
import product from './modules/product';
import coinAddress from './modules/coinAddress';


import * as getters from './getters';
import * as mutations from './mutations';
import * as actions from './actions';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        value: 0,
    },
    getters,
    mutations,
    actions,
    modules: {
        general,
        auth,
        flash,
        blog,
        menu,
        category,
        text,
        aboutus,
        faq,
        contactemail,
        contactphone,
        social,
        studio,
        photo,
        gift,
        master,
        clothing,
        tech,
        campaign,
        product,
        coinAddress,
    }
});
