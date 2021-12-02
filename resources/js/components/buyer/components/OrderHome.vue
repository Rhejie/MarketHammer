<template>
    <div>
        <el-col :span="24">
            <el-card class="box-card orders-content">
                <div slot="header" class="clearfix">
                    <span class="order_title">Orders</span>
                    <div class="orders_progress">
                        <p>
                            <span>0</span> Orders in Progress |
                            <router-link to="#">View All</router-link>
                        </p>
                    </div>
                </div>
                <div v-if="orders == ''">
                    <div class="noOrders">
                        <img src="/image/box_icon.png" alt="">
                        <h4>No orders yet..</h4>
                        <p>
                            Once you have placed a Trade Assurance order, check
                            the status here.
                        </p>
                        <el-button class="btn btn-primary btn-black" round
                            >LEARN MORE</el-button
                        >
                    </div>
                </div>
            </el-card>
        </el-col>
    </div>
</template>
<script>
export default {
    name: 'OrdersHome',
    data() {
        return {
            orders: [],
        }
    }
}
</script>
<style lang="scss" scoped>

.orders_progress {
    float: right;
    padding: 3px 0;
}
.order_title {
    font-size: 20px;
}
.orders-content {
    width: 100%;
    margin-top: 15px;
}
.noOrders {
    text-align: center;
    margin-top: 20px;
    margin-bottom: 20px;
    p {
        color: grey;
    }
}
</style>
