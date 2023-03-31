<template>
    <el-dialog
        visible
        title="Order Edit"
        @update:visible="closeModal"
        top="5vh"
    >
        <el-form label-position="top" label-width="100px" ref="form" :inline="true">
            <el-row :span="20">
                <el-row>
                    <el-col :span="22" :offset="1">
                        <div v-for="error in errors" class="alert alert-danger">
                            {{ error[0] }}
                        </div>
                        <div v-if="success" class="alert alert-success">
                            {{ success }}
                        </div>
                    </el-col>
                </el-row>
                <el-col :span="10" :offset="1">
                    <el-form-item label="Product name">
                        <el-input v-model="data.product_name"></el-input>
                    </el-form-item>
                    <el-form-item label="Product weight" prop="desc">
                        <el-input v-model="data.weight"></el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="10" :offset="2">
                    <el-form-item label="Total price">
                        <el-input v-model="data.total_price"></el-input>
                    </el-form-item>
                    <el-form-item label="Description" prop="desc">
                        <el-input type="textarea" :rows="2" v-model="data.description"></el-input>
                    </el-form-item>
                </el-col>
            </el-row>
        </el-form>
        <template slot="footer">
            <el-button type="primary" @click="editOrder">Submit</el-button>
        </template>
    </el-dialog>
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
} from "element-ui"
export default {
    name: "edit-modal",
    components: {
        ElDialog,
        ElInput,
        ElForm,
        ElFormItem,
        ElButton,
        ElRow,
        ElCol
    },
    props: ["orderId"],
    data() {
        return {
            data: {
                product_name: "",
                weight: "",
                description: "",
                total_price: "",
            },
            errors: null,
            success: null
        }
    },
    mounted() {
        this.getOrder(this.orderId)
    },
    methods: {
        closeModal() {
            this.$emit("close")
        },
        getOrder(orderId) {
            this.$axios.get(`get-order/${orderId}`
            ).then((res) => {
                if (res.data.success) {
                    this.data.product_name = res.data.order.product_name
                    this.data.weight = res.data.order.weight
                    this.data.description = res.data.order.description
                    this.data.total_price = res.data.order.total_price
                }
            }).catch(error => {
                if (error) {
                    console.log(error)
                }
            });
        },
        editOrder() {
            this.$axios.put(`orders/${this.orderId}`,
                {
                    product_name: this.data.product_name,
                    weight: this.data.weight,
                    description: this.data.description,
                    total_price: this.data.total_price,
                }
            ).then((res) => {
                if (res.data.success) {
                    this.success = res.data.message
                    setTimeout(() => location.reload(), 1500)
                }
            }).catch(error => {
                if (error.response) {
                    this.errors = error.response.data.errors
                }
            });
        }
    }
}
</script>

