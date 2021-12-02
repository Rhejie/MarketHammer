<template>
  <div>
    <div class="col-md-12 form-list-data" v-loading="tableLoading">
      <el-card class="box-card list-data" v-for="form in formList" :key="form.id">
        <div @click="formListDetails(form)">
          <div class="row">
              <div class="col-md-12">
                <div class="list-data-title">
                  {{ form.form_title }}
                </div>
              </div>
              <div class="col-md-5">
                <div class="status-content-open" v-if="form.form_status.name == 'Open'">
                  {{ form.form_status.name }}
                </div>
                <div
                  class="status-content-progress"
                  v-if="form.form_status.name == 'In Progress'">
                  {{ form.form_status.name }}
                </div>
                <div
                  class="status-content-closed"
                  v-if="form.form_status.name == 'Closed'">
                  {{ form.form_status.name }}
                </div>
                <div
                  class="status-content-closed"
                  v-if="form.form_status.name == 'MOU Sealed' || form.form_status.name == 'MOU sealed'">
                  {{ form.form_status.name }}
                </div>
                <div
                  class="status-content-danger"
                  v-if="form.form_status.name == 'NDA signed'">
                  {{ form.form_status.name }}
                </div>
            </div>
          </div>
          <div class="second-content">
            <div class="row">
              <div class="col-md-12">
                <div class="subtitle">{{__('Form ID')}}:
                <span class="value-list">{{ form.form_id }}</span>
                </div>
              </div>
              <div class="col-md-12">
                <div class="subtitle">{{__('Form Type')}}:
                <span class="value-list">{{ form.form_type.name }}</span>
                </div>
              </div>
              <div class="col-md-12">
                <div class="subtitle">{{__('Ref ID')}}:
                <span class="value-list">{{ form.refrence_id }}</span>
                </div>
              </div>
            </div>
          </div>
          <div class="third-content">
            <div class="row">
              <div class="col-md-4">
                <div class="third-title">{{__('SUBMITTED')}}</div>
                <div class="third-content-data">
                  {{ form.form_to_supplier_count_count }}
                </div>
              </div>
              <div class="col-md-4 noBorder">
                <div class="third-title">{{__('RECEIVED')}}</div>
                <div class="third-content-data receive-content">
                    {{form.form_recieved_supplier_count_count}}
                </div>
              </div>
              <div class="col-md-4 noBorder">
                <div class="third-title">{{__('DECLINED')}}</div>
                <div class="third-content-data declined-content">
                    {{form.form_declined_supplier_count_count}}
                </div>
              </div>
            </div>
          </div>
          <div class="fourth-content">
            <div class="row">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-12">
                    <div class="modified-content">
                      <div class="modified_description">{{__('Last Modified by')}}:</div>
                      <div class="modified_name">
                        {{ form.user.first_name }}
                        <!-- {{form.user.last_name}} -->
                      </div>
                    </div>
                  </div>
                  <div class="col-md-7">
                    <div class="expire-content">
                      <div class="expire_description"><i class="far fa-clock"></i>{{__('Expires in')}}:
                        <span class="expired_date">
                          {{ form.expiration_date }}
                        </span>
                      </div>
                    </div>
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </el-card>
    </div>
  </div>
</template>
<script>
export default {
  name: "FormGridList",
  props: {
    formList: {
      type: Array,
      required: true,
    },
    tableLoading: {
      type: Boolean,
      required: true,
    },
  },
  methods: {
    alertData() {
      alert("adsdasd");
    },
    formListDetails(data) {
      this.$emit("formListDetailsData", data);
    },
  },
};
</script>
<style lang="scss">
.form-grid-view-wrapper{
    overflow-y: auto;
    -webkit-overflow-scrolling: touch;
    height: 600px;
}
.form-grid-view-wrapper::-webkit-scrollbar-thumb {
  background: #ffd25a;
  border-radius: 25px;
}
.list-data:hover {
        box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
}
.form-list-data {
  display: flex;
  flex-wrap: wrap;
  padding: 0;
  width: 100%;
  .list-data {
    margin-right: 10px;
    margin-bottom: 10px;
    width: 31%;
    padding: 10px;
    cursor: pointer;
    border: 1px solid #ebeef5;
    margin: 10px;
    border-radius: 5px;
    .status-content-open {
      float: left;
      background-color: #28a745;
      width: 60px;
      text-align: center;
      border-radius: 20px;
      color: #ffffff;
      font-size: 11px;
      padding: 2px;
      margin-bottom: 10px;
    }
    .status-content-progress {
      float: left;
      background-color: #007bff;
      width: 80px;
      text-align: center;
      border-radius: 20px;
      color: #ffffff;
      font-size: 11px;
      padding: 2px;
      margin-bottom: 10px;
    }
    .status-content-closed {
      float: left;
      background-color: #6c757d;
      width: 80px;
      text-align: center;
      border-radius: 20px;
      color: #ffffff;
      font-size: 11px;
      padding: 2px;
      margin-bottom: 10px;
    }
    .status-content-danger {
      float: left;
      border-style: solid;
      border-width: 1px;
      background-color: #dc3545;
      width: 80px;
      text-align: center;
      border-radius: 20px;
      color: #ffffff;
      font-size: 11px;
      padding: 2px;
      margin-bottom: 10px;
    }
    .expire-content {
        border-radius: 20px;
        color: #484848;

        i.far.fa-clock {
            margin-right: 5px;
        }
    }
    .list-data-title {
      font-size: 14px;
      padding: 1px;
      margin-bottom: 8px;
    }
    .second-content {
      margin-bottom: 13px;
      .subtitle {
        color: #929292;
      }
      .value-list {
        color: #484848;
        float: right;
        width: 70%;
      }
    }
    .third-content {
        border: 1px solid #e9e9e9;
        border-radius: 5px;
        padding: 10px;
    }
    .third-content {
      .third-title {
        text-align: center;
        color: #929292;
        margin-bottom: 5px;
      }

      .third-content-data {
        text-align: center;
        font-size: 16px;
      }

      .receive-content {
        color: #28a745;
      }

      .declined-content {
        color: #dc3545;;
      }
    }

    .fourth-content {
      margin-top: 10px;
      border-width: 1px;
      border-color: #bfbfbf;

      .modified-content {
        display: flex;
        flex-wrap: wrap;

        .modified_description {
          color: #929292;
          margin-right: 5px;
        }

        .modified_name {
          font-weight: 100;
        }
      }
    }
  }
}

</style>
