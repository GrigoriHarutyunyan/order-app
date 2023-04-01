<template>
    <div>
        <el-dialog
            visible
            title="Order Create"
            @update:visible="close"
            top="5vh"
        >
            <el-form label-position="top" label-width="100px" ref="form" :inline="true">
                <el-row :span="20">
                    <el-row>
                        <el-col :span="22" :offset="1">
                            <div v-for="error in errors" class="alert alert-danger">
                                    {{error[0]}}
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
                <el-button type="primary" @click="store">Save</el-button>
            </template>
        </el-dialog>
    </div>
</template>

<script>
import {mapGetters, mapActions} from "vuex";
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
    name: "create-modal",
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
                product_name: "",
                weight: "",
                description: "",
                total_price: "",
            },
            errors: null,
            success: null
        }
    },
    computed: mapGetters(['storeOrderRes']),
    methods: {
        close() {
            this.$emit('close')
        },

        ...mapActions(['storeOrder']),

        store() {
            const order = {
                product_name: this.data.product_name,
                weight: this.data.weight,
                description: this.data.description,
                total_price: this.data.total_price
            }
            this.storeOrder(order).then(res => {
                if (res.success) {
                    this.errors = null
                    this.success = res.message
                    setTimeout(() => location.reload(), 1500)
                }
            }).catch(error => {
                if (error.response) {
                    this.errors = error.response.data.errors
                }
            });

        },

    }
}
</script>


