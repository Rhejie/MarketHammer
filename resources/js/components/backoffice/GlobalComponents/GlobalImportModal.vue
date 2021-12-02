<template>
    <el-dialog
        :title="title"
        :visible.sync="dialogVisible"
        width="50%"
        :close-on-press-escape="false"
        :close-on-click-modal="false"  >
        <div v-loading="show_loader">
            <template v-if = "templateUrl">
                <h3>Download Import Template</h3>
                <a :href="templateUrl" target="_blank">
                    <el-button >Download</el-button>
                </a>
                <hr />
            </template>
            
            <vue-xlsx-table @on-select-file="importItems">{{ title }}</vue-xlsx-table>
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
                title           : "Import",
                show_loader     : false,
                dialogVisible   : false,
                done            : false,
                error_message   : '',
                filterDialogForm: false,
                index_importer  : 0,
                businessData    : {},
                matrixDetails   : [
                    { id: null, values: [] }
                ],
                branchInventory : [],
                urlImport       : null,
                templateUrl     : null
            }
        },
        created(){
            this.$EventDispatcher.listen('SHOW_IMPORT_DIALOG', data => {
                this.templateUrl = data.templateUrl ? data.templateUrl : null
                this.urlImport = data.urlImport ? data.urlImport : null
                this.title = data.title ? data.title : "Import"
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
                if(this.urlImport == null) {
                    return
                }

                this.show_loader = true;
                let number_of_items = excel_items.body.length;
                let item            = excel_items.body[this.index_importer];
                console.log(excel_items, item)

                if(number_of_items > 0) {

                    let pageData = {body : excel_items.body, header : excel_items.header}

                    axios.post(this.urlImport, pageData).then((res) => {
                        console.log('Upload success', res);
                        self.importLoading = false;

                        console.log(res)
                        this.show_loader = false;
                        this.$EventDispatcher.fire('IMPORT_DONE');
                        this.dialogVisible = false

                    })
                    .catch(error => {
                        this.show_loader = false;
                        this.$notify({
                            title: "Error",
                            message: "Something went wrong.",
                            type: "error"
                        });
                        return;
                    });
                }
            },
        }
    }
</script>