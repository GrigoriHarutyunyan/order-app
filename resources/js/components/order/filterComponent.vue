<template>
    <div>
        <el-dialog
            visible
            title="Filter"
            @update:visible="close"
            top="5vh"
        >
            <el-form label-position="top" label-width="100px" ref="form" :inline="true">
                <el-row :span="20">
                    <el-col :span="10" :offset="1">
                        <el-form-item label="Product name">
                            <el-input v-model="data.product_name"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="10" :offset="2">
                        <el-form-item label="Total price">
                            <el-input v-model="data.total_price"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
            </el-form>
            <template slot="footer">
                <el-button type="primary" @click="filter">Filter</el-button>
            </template>
        </el-dialog>
    </div>
</template>

<script>
import {
    Dialog as ElDialog,
    Input as ElInput,
    Button as ElButton,
    Form as ElForm,
    FormItem as ElFormItem,
    Col as ElCol,
    Row as ElRow,
} from "element-ui";

export default {
    name: "filter-modal",
    components: {
        ElDialog,
        ElInput,
        ElButton,
        ElForm,
        ElFormItem,
        ElCol,
        ElRow,
    },
    data() {
        return {
            data: {
                product_name: '',
                total_price: '',
            },
            filteredOrders: null,
            errors: null,
            success: null
        }
    },
    methods: {
        close() {
            this.$emit('close')
        },
        filter() {
            this.$axios.post('orders',
                {
                    product_name: this.data.product_name,
                    total_price: this.data.total_price,
                },
            ).then((res) => {
                if (res.data.success) {
                    this.errors = null
                    this.success = res.data.message
                    this.filteredOrders = res.data.orders
                    this.sendDataToIndex(this.filteredOrders)
                    this.close()
                }
            }).catch(error => {
                if (error.response) {
                    this.errors = error.response.data.errors
                }
            });
        },

        sendDataToIndex(filteredOrders) {
            this.$emit('filtered-orders', filteredOrders)
        }
    }
}
</script>


