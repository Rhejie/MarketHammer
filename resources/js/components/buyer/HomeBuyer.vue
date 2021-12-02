<template>
    <div>
        <div class="Home-Buyer">
            <div class="container-fluid buyer-wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <el-col :span="24">
                            <el-card class="box-card b_h"  shadow="never" >
                                <div class="buyer-header">
                                    <div class="avatar-header">
                                        <el-avatar src="https://cube.elemecdn.com/0/88/03b0d39583f48206768a7534e55bcpng.png"></el-avatar>
                                    </div>
                                    <div class="user_name">
                                        <p class="user">{{pageData.first_name}} {{pageData.last_name}}</p>
                                        <p class="user_type">{{pageData.usertype.name}}</p>
                                    </div>
                                </div>
                            </el-card>
                        </el-col>
                    </div>
                    <div class="col-md-12">
                        <InquiresHome></InquiresHome>
                    </div>

                    <div class="col-md-12">
                        <OrderHome></OrderHome>
                    </div>

                    <div class="col-md-12">
                        <FavoritesHome></FavoritesHome>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import OrderHome from './components/OrderHome';
import FavoritesHome from './components/FavoritesHome';
import InquiresHome from './components/Inquiries';
export default {
    name: "HomeBuyer",
    props: {
        pageData: {
            type: Object,
            required: true
        }
    },
    components: {
        OrderHome,
        FavoritesHome,
        InquiresHome
    },
    data() {
        return {

        }
    }
};
</script>

<style lang="scss" scoped>
.buyer-wrapper {
    margin-top: 10px;
    padding: 2px;
}
.buyer-header {
    padding: 5px;
    padding-right: 5px;
    width: 100%;
    display: flex;
    flex-direction: row;
}
.inquery {
    margin-top: 10px;
    padding: 5px;
    padding-left: 10px;
}
.b_h {
    width: 100%;
}
.user_name {
    line-height: 0.3;
    padding-top: 15px;
    .user_type{
        color: grey;
    }
}
.avatar-header {
    margin-right: 10px;
}
.user {
    font-size: 20px;
}
</style>
