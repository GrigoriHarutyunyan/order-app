import axios from "../../axios";

export default {
    actions: {
        getOrders: ({commit}, page = 1) => {
            return axios.get('orders?page=' + page).then(res => {
                commit('updateOrders', res.data.orders)
            })
        },

        async storeOrder({commit}, order) {
            const res = await axios.post('/orders/store', order)
            commit('storeOrder', res.data.order)
            return res.data
        },

        async getOrderById({commit}, orderId) {
            const res = await axios.get('get-order/' + orderId)
            commit('orderById', res.data)
            return res.data
        },

        async editOrder({commit},order) {
            const res = await axios.patch('orders/' + order.order_id, order);
            commit('editOrder', res.data)
            return res.data
        },

        async filterOrders({commit}, params) {
            const res = await axios.post('/orders', params)
            commit('filterOrders', res.data.orders)
            return res.data.orders
        },
    },
    mutations: {
        updateOrders(state, orders) {
            state.orders = orders
        },

        storeOrder(state, storeOrder) {
            state.storeOrder.push(storeOrder)
        },

        orderById(state, orderById) {
            state.orderById.push(orderById)
        },

        editOrder(state, editOrder) {
            state.editOrder.push(editOrder)
        },

        filterOrders(state, filteredOrders) {
            state.orders = filteredOrders
        },

    },
    state: {
        orders: [],
        storeOrder: [],
        orderById: [],
        editOrder: [],
    },
    getters: {
        allOrders(state) {
            return state.orders
        },

        storeOrderRes(state) {
            return state.storeOrder
        },

        orderByIdRes(state) {
            return state.orderById
        },

        editOrderRes(state) {
            return state.editOrder
        },

        filteredOrdersRes (state) {
            return state.orders;
        }
    }
}
