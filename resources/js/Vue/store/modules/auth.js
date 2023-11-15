

const state = {
    id: 0,
};

const getters = {
    id: state => {
        return state.id;
    },
};

const mutations = {
    updateId: (state, payload) => {
        state.id = payload;
    },
};
const actions = {
    updateId: ({commit}, payload) => {
        commit('updateId', payload);
    },
};
export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions,
}