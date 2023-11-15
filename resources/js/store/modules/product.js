const defaultFields = [
    {
        key:'image',name:'Image',
        value:'', defValue: '',
        type: 'upload'
    },
    {
        key:'name',name:'Name',
        value:'', defValue: '',
        type: 'text'
    },
    {
        key:'price',name:'Price',
        value:'', defValue: '',
        type: 'text'
    },
    {
        key:'text',name:'Description',
        value:'', defValue: '',
        type: 'textarea'
    },
];

const listFields = [
    {key:'image',name:'Image', type:'upload'},
    {key:'name',name:'Name'},
    {key:'price',name:'Price'},
];

const state = {
    list: [],
    tags: [],
    fields: defaultFields,
    listFields: listFields,
};


const getters = {
    list: state => {
        return state.list;
    },
    tags: state => {
        if(Array.isArray(state.tags)){
            return state.tags;
        }else{
            return state.tags.split(',')
        }
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
            let find = state.list.find(item =>  Number(item.id) ===  Number(payload.id));
            find[key] = value;
        }
    },
    updateList: (state, payload) => {
        state.list = payload;
    },
    updateTags: (state, payload) => {
        state.tags = payload;
    },
    deleteItem: (state, payload) => {
        state.list.splice(payload, 1);
    },
    addToList: (state, payload) => {
        state.list.push(payload);
    },
    resetFields (state) {
        let newArray = [];
        state.fields.forEach((item) =>{
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
    setFields (state, payload) {
        let newArray = [];
        let newData;
        state.fields.forEach((item) =>{
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
    updateList: ({commit}, payload) => {
        commit('updateList', payload);
    },
    updateTags: ({commit}, payload) => {
        commit('updateTags', payload);
    },
    deleteItem: ({commit}, payload) => {
        commit('deleteItem', payload);
    },
    editItem: (context, payload) => {
        context.commit('editItem', payload);
    },
    addToList: ({commit}, payload) => {
        commit('addToList', payload);
    },
    resetFields: ({commit}) => {
        commit('resetFields');
        state.tags = [];
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
