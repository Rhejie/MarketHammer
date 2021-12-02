<template>
    <div class =  "business-form" v-loading = "pageLoading">
        <div class="container mt-3">
            <el-form :model="eventData" :rules="rulesForm" label-position = "top" ref="eventData" class="demo-ruleForm">
                <el-row :gutter = "20">
                    <el-col :span= "24">
                        <el-carousel :interval="5000" arrow="always" :height="500">
                            <el-carousel-item v-for="eventMedias in eventData.event_medias" :key="eventMedias">
                                <img :src="'/storage/' + eventMedias.mediaPath" style="width:100%;height:auto;"/>
                            </el-carousel-item>
                        </el-carousel>
                        <br><br>
                    </el-col>
                    <el-col :span = "12">
                        <el-form-item :label="'Event Name'" prop="name">
                            <el-input ref="eventName" v-model="eventData.name" class="full-width" ></el-input>
                        </el-form-item>
                        <el-form-item :label="'From'" prop="startDate">
                            <el-date-picker type="datetime" ref="eventStartDate" v-model="eventData.startDate" class="full-width" placeholder="Select date and time"></el-date-picker>
                        </el-form-item>
                        <el-form-item :label="'Redirect URL'" prop="link">
                            <el-input ref="eventLink" v-model="eventData.link" class="full-width"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span = "12">
                        <el-form-item :label="'Active'" prop="is_active">
                            <el-checkbox  ref="eventIsActive" v-model="eventData.is_active" checked v-if="eventData.is_active == 1" class="full-width" ></el-checkbox>
                            <el-checkbox  ref="eventIsActive" v-model="eventData.is_active" v-else class="full-width" ></el-checkbox>
                        </el-form-item>
                        
                        <el-form-item :label="'To'" prop="endDate">
                            <el-date-picker type="datetime" ref="eventEndDate" v-model="eventData.endDate" class="full-width" placeholder="Select date and time"></el-date-picker>
                        </el-form-item>
                    </el-col>
                </el-row>
            </el-form>
        </div>
    </div>
</template>

<script>
window.noty = require('noty')
import Noty from 'noty'

import _forEach from 'lodash/forEach'
import cloneDeep from 'lodash/cloneDeep'
import __message from '../../mixins/messageAlert.js'

export default {
    props: {
        eventData : {
            required: false
        },
        host: {
            required: false
        }
    },
    data() {
        return {
            host            : this.location.host,
            eventData       : this.event-data,
            rulesForm       : {},
            pageLoading     : false,
            formError       : {eventName : ["This is sample error"]},
        }
    },
    mixins: [__message],
    created(){
        this.rulesForm = {

        }
    },
    mounted() {
    },
    methods: {
        showUploadBanner(){
			this.$EventDispatcher.fire('BUSINEESS_BANNER_SHOW')
		}
    },
    watch:{
    }

}
</script>

<style lang="scss">

.business-form
{
    
    table{

        td, th{
            padding: 5px 10px;
        }
    }

    .operation-hours i{
        cursor: pointer;
        font-size: 20px
    }
}
</style>
