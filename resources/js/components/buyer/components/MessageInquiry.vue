<template>
    <div>
        <el-card style="height: calc(100vh - 105px); overflow-y: scroll;" class="inquiry" :body-style="{ padding: '0px' }">
            <div slot="header" class="clearfix">
                <span class="inquiries_title">Inquiries & Quotations</span>
                <a class="float-right" style="font-size: 14px">X</a>
            </div>

            <div style="height: 512px">
                <el-card class="details">
                    <div
                        class="inquiry-date-details"
                    >
                        <p>Inquiry ID: INQ-0000123</p>
                        <p class="date">2021-02-20 12:00</p>
                    </div>

                    <br />

                    <div class="messages">
                        <div class="avatar_user">
                            <el-avatar
                                src="https://shop.westerndigital.com/content/dam/store/en-us/assets/products/portable/extreme-pro-usb-3-1-ssd/gallery/extreme-pro-usb-3-1-ssd-front.png.thumb.1280.1280.png"
                                class="user_avatar"
                            ></el-avatar>
                        </div>
                        <div class="message">
                            <h4 class="message_title">
                                Inquiry for SSID Aluminum Case
                            </h4>
                            <a href="#">
                                Shenzen Sunbow international Technology Co., Ltd
                            </a>

                            <div class="message_content">
                                <p>Hello John,</p>
                                <p>Greetings from Shenzen Sunbow!</p>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur
                                    adipisicing elit. Ex nulla fugit molestias
                                    maxime earum culpa laudantium, debitis
                                    sapiente dolores quo autem placeat rem.
                                    Officiis porro, saepe error nam doloribus
                                    est.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div
                        class="attachments"
                    >
                        <br>
                        <span class="attachment_label">Attachments</span>
                        <br /><br />
                        <div class="attachment">
                            <div class="avatar_attachment">
                                <el-avatar
                                    src="https://shop.westerndigital.com/content/dam/store/en-us/assets/products/portable/extreme-pro-usb-3-1-ssd/gallery/extreme-pro-usb-3-1-ssd-front.png.thumb.1280.1280.png"
                                    class="attachment_avatar"
                                ></el-avatar>
                            </div>
                            <div class="message">
                                <a>Sample 1</a>
                            </div>
                        </div>

                        <div class="attachment">
                            <div class="avatar_attachment">
                                <el-avatar
                                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS5PGtFh0hGCl9TUHEuSp-rkmFu1V9ciC98CQ&usqp=CAU"
                                    class="attachment_avatar"
                                ></el-avatar>
                            </div>
                            <div class="message">
                                <a>Sample 2</a>
                            </div>
                        </div>
                        <div class="attachment">
                            <div class="avatar_attachment">
                                <el-avatar
                                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSJBv7wfR2j8yQgv1kUoC-wC4UVDO8KsbfFJw&usqp=CAU"
                                    class="attachment_avatar"
                                ></el-avatar>
                            </div>
                            <div class="message">
                                <a>Sample 3</a>
                            </div>
                        </div>
                    </div>
                </el-card>
            </div>
        </el-card>
    </div>
</template>

<script>
export default {
    name: "MessageInquiry",
    data() {
        return {};
    }
};
</script>

<style lang="scss" scoped>
.inquiry {
    margin-right: 5px;
}

.attachment_label {
    font-size: 12px;
    margin-left: 15px;
}

.attachment {
    display: flex;
    flex-direction: row;
    margin-left: 20px;
    .avatar_attachment {
        .attachment_avatar {
            width: 30px;
            height: 30px;
        }
    }
}
.inquiries_title {
    font-size: 14px;
}

.inquiry-date-details {
    margin-top: 15px;
    display: flex;
    flex-direction: row;
    border-bottom: 1px solid #e9e9e9;
    p {
        margin-left: 20px;
    }
    .date {
        color: grey;
        float: right;
    }
}

.message {
    padding: 10px;
    width: 100%;
}

.messages {
    display: flex;
    flex-direction: row;
    border-bottom: 1px solid #e9e9e9;
    .avatar_user {
        margin-left: 5px;
        .user_avatar {
            width: 40px;
            height: 40px;
        }
    }
    .message {
        .message_content {
            p {
                line-height: 1.1;
            }
        }
        a {
            text-decoration: underline;
        }

        .message_content {
            padding-top: 10px;
            margin-top: 20px;
        }
    }
    .message_title {
        font-weight: bold;
        font-size: 12px;
    }

    .clearfix:before,
    .clearfix:after {
        display: table;
        content: "";
    }
    .clearfix:after {
        clear: both
    }
}
.el-card.is-always-shadow, .el-card.is-hover-shadow:focus, 
.el-card.is-hover-shadow:hover {
    box-shadow:none;
}
    .clearfix {
        margin-top: 10px;
    }
</style>
