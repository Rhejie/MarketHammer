<template>
    <div>
        <el-col :span="24">
            <el-card class="box-card favorites-content">
                <div slot="header" class="clearfix">
                    <span class="favorites_title">Favorites</span>
                    <div class="favorites_progress">
                        <p>
                            <span>0</span> Favorites |
                            <router-link to="#">View All</router-link>
                        </p>
                    </div>
                </div>
                <div v-if="favorites == ''">
                    <div class="noFavorites">
                        <img src="/image/star_icon.png" alt="">
                        <h4>No Favorites yet!</h4>
                        <p>Your Favorites list is still empty.</p>
                    </div>
                </div>
            </el-card>
        </el-col>
    </div>
</template>
<script>
export default {
    name: "FavoriteHome",
    data() {
        return {
            favorites: []
        }
    },
};
</script>

<style lang="scss" scoped>

.favorites_progress {
    float: right;
    padding: 3px 0;
}
.noFavorites {
    text-align: center;
    margin-top: 20px;
    margin-bottom: 20px;
    p {
        color: grey;
    }
}


.favorites_title {
    font-size: 20px;
}

.favorites-content {
    width: 100%;
    margin-top: 15px;
    margin-bottom: 30px;
}
</style>
