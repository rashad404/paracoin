const defaultFields = [
    {
        key: 'address', name: 'Address',
        value: '', defValue: '',
        type: 'text'
    },
];

const listFields = [
    { key: 'id', name: 'ID' },
    { key: 'address', name: 'Address' },
    { key: 'balance', name: 'Balance' },
];

const state = {
    list: [],
    fields: defaultFields,
    listFields: listFields,
};


const getters = {
    list: state => {
        return state.list;
    },
    fields: state => {
        return state.fields;
    },
    listFields: state => {
        return state.listFields;
    },
};

const mutations = {
    editItem: (state, payload) => {
        for (const [key, value] of Object.entries(payload)) {
            let find = state.list.find(item => Number(item.id) === Number(payload.id));
            find[key] = value;
        }
    },
    addBalance: (state, payload) => {
        let find = state.list.find(item => Number(item.id) === Number(payload.id));
        let newBalance = parseFloat(find['balance']) + parseFloat(payload.amount);
        find['balance'] = Number(newBalance).toFixed(6);

    },
    updateList: (state, payload) => {
        state.list = payload;
    },

    deleteItem: (state, payload) => {
        state.list.splice(payload, 1);
    },
    addToList: (state, payload) => {
        state.list.push(payload);
    },
    resetFields(state) {
        let newArray = [];
        state.fields.forEach((item) => {
            newArray.push({
                key: item.key,
                name: item.name,
                value: item.defValue,
                defValue: item.defValue,
                data: item.data,
                type: item.type,
            });
        });
        state.fields = newArray;
    },
    setFields(state, payload) {
        let newArray = [];
        let newData;
        state.fields.forEach((item) => {
            newData = item.data;
            newArray.push({
                key: item.key,
                name: item.name,
                defValue: item.defValue,
                data: newData,
                type: item.type,

                value: payload[item.key]
            });
        });

        state.fields = newArray;
    },

};

const actions = {
    updateList: ({ commit }, payload) => {
        commit('updateList', payload);
    },

    deleteItem: ({ commit }, payload) => {
        commit('deleteItem', payload);
    },
    editItem: (context, payload) => {
        context.commit('editItem', payload);
    },
    addBalance: (context, payload) => {
        context.commit('addBalance', payload);
    },
    addToList: ({ commit }, payload) => {
        commit('addToList', payload);
    },
    resetFields: ({ commit }) => {
        commit('resetFields');
    },
    setFields: (context, payload) => {
        context.commit('setFields', payload)
    },
};

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions,
}
