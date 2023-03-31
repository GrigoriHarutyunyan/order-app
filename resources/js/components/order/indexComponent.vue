<template>
    <div>
        <div class="row g-5 g-xl-8">
            <div class="col-xl-2">
                <elem-button type="primary" plain @click="openCreateModal" style="margin: 5px 0 0 40px">Create Order</elem-button>
                <elem-button type="primary" plain @click="openFilterModal" style="margin: 5px 0 0 40px">Filter Orders</elem-button>
                <elem-button type="danger" plain @click="resetFilter" style="margin: 5px 0 0 40px">Reset Filter</elem-button>
            </div>

            <div class="col-xl-8">
                <div class="card card-xl-stretch mb-5 mb-xl-8">
                    <div class="card-body pt-0">
                        <div id="kt_table_users_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div v-if="orders" class="table-responsive">
                                <table class="table align-middle table-row-dashed fs-6 gy-5 no-footer"
                                       id="kt_table_users">
                                    <thead>
                                    <tr class="text-start text-muted fw-bolder fs-7 gs-0 text-center">
                                        <th>ID</th>
                                        <th>Product Name</th>
                                        <th>Weight</th>
                                        <th>Description</th>
                                        <th>Total Price</th>
                                        <th>Created</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody class="text-gray-600 fw-bold">
                                    <tr v-for="order in orders">
                                        <td class="text-center">
                                            <span class="align-items-center">{{ order.id}}</span>
                                        </td>
                                        <td class="text-center">
                                            <span class="align-items-center">{{ order.product_name }}</span>
                                        </td>
                                        <td class="text-center">
                                            <span class="align-items-center">{{ order.weight }}</span>
                                        </td>
                                        <td class="text-center">
                                            <span class="align-items-center">{{ order.description }}</span>
                                        </td>
                                        <td class="text-center">
                                            <span class="align-items-center">{{ order.total_price }}</span>
                                        </td>
                                        <td class="text-center">
                                            <span class="align-items-center">{{ dateFormat(order.created_at)}}</span>
                                        </td>
                                        <td class="text-center">
                                            <elem-button type="primary" plain @click="openEditOrderModal(order.id)">Edit
                                                order
                                            </elem-button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <elem-pagination
                                    @current-change="pagination"
                                    :page-size="orders.per_page"
                                    :current-page="orders.current_page"
                                    layout="prev, pager, next"
                                    :total="orders.total">
                                </elem-pagination>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <create-modal
            v-if="showCreateModal"
            @close="closeCreateModal"
        />

        <edit-modal
            v-if="showEditModal"
            @close="closeOrderEditModal"
            :order-id="selectedOrderId"
        />
        <filter-modal
            v-if="showFilterModal"
            @filtered-orders="handleFilteredOrders"
            @close="closeFilterModal"
        />
    </div>
</template>

<script>

import createModal from "./createComponent";
import editModal from "./editComponent";
import filterModal from "./filterComponent"
import moment from 'moment'


import {
    Pagination as elemPagination,
    Button as elemButton,
} from "element-ui"

export default {
    name: "index",
    components: {
        createModal,
        editModal,
        elemPagination,
        elemButton,
        filterModal,
    },
    data() {
        return {
            showCreateModal: false,
            showEditModal: false,
            showFilterModal: false,
            visible: false,
            orders: null,
            selectedOrderId: null,
            currentPage: null
        }
    },
    mounted() {
        this.getOrders()
    },
    methods: {
        openCreateModal() {
            this.showCreateModal = true;
        },
        closeCreateModal() {
            this.showCreateModal = false;
        },

        openEditOrderModal(orderId) {
            this.showEditModal = true;
            this.selectedOrderId = orderId;
        },
        closeOrderEditModal() {
            this.showEditModal = false;
            this.selectedOrderId = null;
        },

        openFilterModal() {
            this.showFilterModal = true
        },

        closeFilterModal () {
            this.showFilterModal = false
        },

        dateFormat(date) {
            return moment(date).format('MM/DD/YYYY hh:mm')
        },

        getOrders(page = null) {
            if (!page) {
                page = 1
            }
            this.$axios.get(`orders?page=${page}`
            ).then((res) => {
                this.orders = res.data.orders.data
            }).catch(error => {
                if (error) {
                    console.log(error)
                }
            });
        },
        pagination(val) {
            this.currentPage = val
            this.getOrders(val)
        },

        handleFilteredOrders(data) {
            this.orders = data.data
        },

        resetFilter() {
            location.reload()
        }
    }
}
</script>

