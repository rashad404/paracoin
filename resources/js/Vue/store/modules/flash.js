

const state = {
    errors: {},
    flash: {},
    display: false,
};



const getters = {
    errors: state => {
        return state.errors;
    },
    flash: state => {
        return state.flash;
    },
    display: state => {
        return state.display;
    },
};


const mutations = {
    resetFlash: (state) => {
        state.display = false;
    },

    setError: (state, payload) => {
        Vue.set(state.flash, 'error', payload);
        state.display = true;
    },

    setSuccess: (state, payload) => {
        Vue.set(state.flash, 'success', payload);
        state.display = true;

    },

    updateErrorKey: (state, payload) => {

        const key = payload[0];
        if(key==='email'){
            state.errors  = Object.assign({email:payload[1]},state.errors);
        }
        if(key==='password'){
            state.errors  = Object.assign({password:payload[1]},state.errors);
        }
    },
    updateErrors: (state, payload) => {
        state.errors = payload;
    },
};
const actions = {
    setError: ({commit}, payload) => {
        commit('setError', payload);
        setTimeout(function () { commit('resetFlash'); }, 300000);
    },
    setSuccess: ({commit}, payload) => {
        commit('setSuccess', payload);
        setTimeout(function () { commit('resetFlash'); }, 3000);
    },
    updateErrorKey: ({commit}, payload) => {
        commit('updateErrorKey', payload);
    },
    updateErrors: ({commit}, payload) => {
        commit('updateErrors', payload);
    },
    resetFlash: ({commit}, payload) => {
        commit('resetFlash', payload);
    },
};

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions,
}