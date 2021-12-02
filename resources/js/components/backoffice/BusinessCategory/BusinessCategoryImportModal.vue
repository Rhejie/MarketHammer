<template>
    <el-dialog
        title="Import Business Category"
        :visible.sync="dialogVisible"
        width="50%"
        :close-on-press-escape="false"
        :close-on-click-modal="false"
        >
        <div v-loading="show_loader">
            <h3>Download Business Category Import Template</h3>
            <a href="/category-template" target="_blank">
                <button type="button" class="btn btn-primary">Download</button>
            </a>
            <hr />
            <vue-xlsx-table @on-select-file="importItems">Import Business Category</vue-xlsx-table>
            <span slot="footer" class="dialog-footer" style="float: right;">
                <el-button @click="dialogVisible = false">Cancel</el-button>
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
                console.log(excel_items, item)

                if(number_of_items > 0) {
                    //this.$API.BusinessCategory.updateImportCategory(excel_items)
                    this.$API.BusinessCategory.importCategory(excel_items)
                    .then(result => {
                        let res = result.data
                        console.log(res)
                        if(res.success){
                            this.$EventDispatcher.fire('IMPORT_DONE');
                            this.dialogVisible = false
                        }
                        else{
                            this.$notify({
                                title: "Error",
                                message: "Error importing business category. Some data were not saved.",
                                type: "warning"
                            });
                        }
                        this.show_loader = false;


                    })
                    .catch(error => {
                        this.show_loader = false;
                        this.$notify({
                            title: "Service Error",
                            message: this.$msg.notif.service_error,
                            type: "error"
                        });

                        return;
                    });
                }
            },
        }
    }
</script>