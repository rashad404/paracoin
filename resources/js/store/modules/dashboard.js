

const state = {
    counter:12,
};
const getters = {
    counter: state => {
        return state.counter;
    },
    doubleCounter: state => {
        return state.counter * 2;
    },
};
const mutations = {
    increment: (state, payload) => {
        state.counter += payload;
    },
    decrement: state => {
        state.counter--;
    },
};
const actions = {
    increment: ({commit}, payload) => {
        commit('increment', payload);
    },
    decrement: ({commit}) => {
        commit('decrement');
    },
    asyncIncrement: ({commit}, payload) => {
        setTimeout(() => {
            commit('increment', payload.by);
        },payload.duration);
    },
    asyncDecrement: ({commit}) => {
        setTimeout(() => {
            commit('decrement');
        },1000);
    },
};

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}