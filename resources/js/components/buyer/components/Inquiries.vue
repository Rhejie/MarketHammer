<template>
    <div>
        <el-col :span="24">
            <el-card class="box-card inquiries-content">
                <div slot="header" class="clearfix">
                    <span class="inquiries_title">Inquiries & Quotations</span>
                    <div class="inquiries_progress">
                        <el-button class="btn btn-orange btn-black" round>Request for a Quote</el-button>
                        <div class="unread">
                            <p>
                                <span>0</span> Unread |
                                <router-link to="#">View All</router-link>
                            </p>
                        </div>
                    </div>
                </div>
                <div>
                    <el-card class="box-card message" shadow="never">
                        <div class="messages">
                            <div class="avatar_user">
                                <el-avatar src="https://cube.elemecdn.com/0/88/03b0d39583f48206768a7534e55bcpng.png" class="user_avatar"></el-avatar>
                            </div>
                            <div class="message">
                                <h4 class="message_title">Inquiry for SSID Aluminum Case </h4>
                                <a href="#">Shenzen Sunbow international Technology Co., Ltd</a>

                                <div class="message_content">
                                    <p>Hello John,</p>
                                    <p>Greetings from Shenzen Sunbow!</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex nulla fugit molestias maxime earum culpa laudantium, debitis sapiente dolores quo autem placeat rem. Officiis porro, saepe error nam doloribus est.</p>
                                </div>
                            </div>
                            <div class="inquiry-date-details">
                                <p>Inquiry ID: INQ-0000123</p>
                                <p class="date">2021-02-20 12:00</p>
                            </div>
                        </div>
                    </el-card>
                </div>
            </el-card>
        </el-col>
    </div>
</template>
<script>
export default {
    name: "InquiriesQuotations",
    data() {
        return {};
    },
};
</script>

<style lang="scss" scoped>

.inquiries_progress {
    float: right;
    display: flex;
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
.message {
    padding: 10px;
    width: 100%;
}

.inquiries_title {
    font-size: 20px;
}

.inquiries-content {
    width: 100%;
    margin-top: 15px;
}
.unread{
    vertical-align: center;
    margin-left: 30px;
}
.messages {
    display: flex;
    flex-direction: row;
    border-bottom: 1px solid grey;
    .avatar_user {
        .user_avatar{
            width: 70px;
            height: 70px;
        }
    }
    .message {
        .message_content{
            p{
                line-height: 1.1;
            }
        }
        a{
            text-decoration: underline;
        }

        .message_content {
            padding-top: 10px;
            margin-top: 20px;
        }
    }
    .message_title {
        font-weight: bold;
    }
    .inquiry-date-details {
        display: flex;
        flex-direction: row;
        width: 400px;
        p{
            margin-left: 20px;
        }
        .date {
            color: grey;
        }
    }
}
</style>
