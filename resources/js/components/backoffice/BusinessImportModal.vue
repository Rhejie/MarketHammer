<template>
    <el-dialog
        :title="__('Import Business')"
        :visible.sync="dialogVisible"
        width="50%"
        :close-on-press-escape="false"
        :close-on-click-modal="false"
        >
        <div v-loading="show_loader">
            <h3>{{ __("Download Business Import Template") }}</h3>
            <a href="/excel" target="_blank">
                <button type="button" class="btn btn-primary">{{ __('Downloads') }}</button>
            </a>
            <hr />
            <vue-xlsx-table @on-select-file="importItems">{{ __('Import Business') }}</vue-xlsx-table>
              <span slot="footer" class="dialog-footer" style="float: right;">
                    <el-button @click="dialogVisible = false">{{ __('Cancel') }}</el-button>
              </span>


        </div>
    </el-dialog>
</template>
<script type="text/javascript">

    export default {

        // props: ['itemData'],

        data() {
            return {
                show_loader: false,
                dialogVisible: false,
                done: false,
                error_message: '',
                filterDialogForm: false,
                index_importer: 0,
                businessData: {},
                matrixDetails: [
                    { id: null, values: [] }
                ],
                branchInventory: [],
                branchInventory: [],
            }
        },
        created(){
            this.$EventDispatcher.listen('SHOW_IMPORT_DIALOG', data => {
                this.dialogVisible = true;
            });
        },
        methods: {
            toCamel(o) {
              var newO, origKey, newKey, value
              if (o instanceof Array) {
                return o.map(function(value) {
                    if (typeof value === "object") {
                      value = toCamel(value)
                    }
                    return value
                })
              } else {
                newO = {}
                for (origKey in o) {
                  if (o.hasOwnProperty(origKey)) {
                    // newKey = (origKey.charAt(0).toLowerCase() + origKey.slice(1) || origKey).toString()
                    newKey = this.getCamelCase(origKey)
                    value = o[origKey]
                    if (value instanceof Array || (value !== null && value.constructor === Object)) {
                      value = toCamel(value)
                    }
                    newO[newKey] = value
                  }
                }
              }
              return newO
            },
            getCamelCase(str) {
                return str.replace(/(?:^\w|[A-Z]|\b\w)/g, function(word, index) {
                    return index === 0 ? word.toLowerCase() : word.toUpperCase();
                }).replace(/\s+/g, '');
            },

            // Recursive method
            importItems (excel_items) {
                this.show_loader = true;
                let number_of_items = excel_items.body.length;
                let item            = excel_items.body[this.index_importer];
                let newitem = this.toCamel(item); // convert keys to camelCase
                // console.log(item, newitem );
                // console.log(excel_items.body, item);

                // this.businessData.businessName      = item.businessName;
                // this.businessData.industryTypeID    = item.IndustryType;
                // this.businessData.planName          = item.Plan;
                // this.businessData.city              = item.city;
                // // this.businessData.email             = item.email;
                // this.businessData.state             = item.state;
                // this.businessData.street            = item.street;
                // this.businessData.zip               = item.zip;

                // // console.log(excel_items.body[this.index_importer]);

                if(this.index_importer !== number_of_items) {
                    // this.$API.Item.import(this.businessData, this.matrixDetails, this.branchInventory, vendors, categories)
                        this.$API.BusinessList.saveBusinessListFromExcel(newitem)
                        .then(res => {

                            this.show_loader = false;

                            if(this.index_importer < number_of_items)
                            {
                                this.index_importer++;
                                return this.importItems(excel_items);

                            } else {

                                this.show_loader = false;
                                this.dialogVisible = false;
                                this.index_importer = 0;
                                this.$EventDispatcher.fire('IMPORT_DONE');
                                return;

                            }

                        })
                        .catch(error => {
                            this.show_loader = false;
                            this.$EventDispatcher.fire('IMPORT_DONE');
                            this.dialogVisible = false;
                            // this.error_message = error.response.data.message;
                            console.log(error.response);
                            if(error.response.status === 422 && this.index_importer < number_of_items) {
                                this.index_importer++;
                                return this.importItems(excel_items);
                            } else {
                                this.index_importer = 0;
                                return;
                            }
                        });
                } else {
                    // this.done = true;
                    this.$notify({
                        title: this.__("Success"),
                        message: this.__("Successfully imported business from excel file."),
                        type: "success"
                    });
                    this.show_loader = false;
                    this.dialogVisible = false;
                    this.index_importer = 0;
                    this.$EventDispatcher.fire('IMPORT_DONE');
                    // window.location.reload(false);
                }
            },
        }
    }
</script>
