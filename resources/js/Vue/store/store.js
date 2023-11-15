import Vue from 'vue';
import Vuex from 'vuex';

import general from './modules/general';
import auth from './modules/auth';
import flash from './modules/flash';


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
    }
});
