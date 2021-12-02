<template>
	<div class="form-group p-3">
		<el-table
            class="table-list-container"
            :data="formGroups"
            style="width: 100%;"
            v-loading="loading"
            @row-click="update">
            <el-table-column
            	prop="name"
            	:label="__('Label')"
                :sortable="true">
                    <template slot-scope="scope">
                        {{ __dt(scope.row.translations, 'name', $sf.ucwords(scope.row.name)) }}
                    </template>
            </el-table-column>
            <el-table-column
            	prop="description"
            	:label="__('Description')"
                :sortable="true">
                    <template slot-scope="scope">
                        {{ __dt(scope.row.translations, 'description', $sf.ucwords(scope.row.description)) }}
                    </template>
            </el-table-column>
            <el-table-column :label="__('Actions')">
                <template slot-scope="scope">
                    <div>
                        <button class="btn btn-default text-red" @click.stop @click="deleteData(scope.row)">
                            <i class="fas fa-trash-alt"></i> {{ __('Delete') }}
                        </button>
                    </div>
                </template>
            </el-table-column>
        </el-table>

        <div class="text-right mb-3">
			<global-pagination
                :current_page="filters.page"
                :current_size="filters.size"
                :pagination="filters"
                @handleSizeChange="handleSize"
                @handleCurrentChange="handlePage">
            </global-pagination>
        </div>

        <form-field-group-form
            :model="model"
            v-if="showForm"
            :visible.sync="showForm"
            @close="handleClose">
        </form-field-group-form>
	</div>
</template>

<script>
    import cloneDeep from 'lodash/cloneDeep'
    import pagination from '../../../mixins/pagination'
    import translationForm from '../../../mixins/translationForm.js'

	export default {
		name: 'FormGroup',
		mixins: [translationForm, pagination],
		data() {
			return {
                filters: {
                    searchString: null
                },
				formGroups: [],
				loading: false,
                showForm: false,
                model: null
			}
		},
        created() {
            this.fetch()

            this.$EventDispatcher.listen('FORM_FIELD_GROUPS_MODULE_ITEM_CREATED', formGroup => {
                this.formGroups.unshift(formGroup)
                this.filters.total++

                this.updateParentList('add', formGroup)
            })

            this.$EventDispatcher.listen('FORM_FIELD_GROUPS_MODULE_ITEM_UPDATED', formGroup => {
                let index = this.formGroups.findIndex(fg => fg.id == formGroup.id)

                if (index > -1) {
                    this.formGroups.splice(index, 1, formGroup)

                    this.updateParentList('update', formGroup)
                }
            })
        },
		methods: {
            fetch() {
                let postData = cloneDeep(this.filters)

                this.loading = true

                this.$API.FormFieldGroup.fetch(postData)
                .then(res => {
                    this.formGroups = cloneDeep(res.data.data)
                    this.filters.total = res.data.total
                })
                .catch(err => {
                    console.log(err)
                })
                .finally(_ => {
                    this.loading = false
                })
            },

            update(formGroup) {
                this.showForm = true
                this.model = cloneDeep(formGroup)
            },
            deleteData(formGroup) {
                this.$confirm(this.$msg.notif.confirm_delete, this.__('Warning'), {
                    confirmButtonText: this.__('Delete'),
                    cancelButtonText: this.__('Cancel'),
                    type: 'warning',
                    confirmButtonClass: 'el-button--danger'
                })
                .then(() => {
                    this.loading = true

                    this.$API.FormFieldGroup.delete(formGroup.id)
                    .then(res => {
                        if (res.data) {
                            this.$notify({
                                title: this.__("Successful"),
                                message: this.$msg.notif.success_delete,
                                type: "success"
                            })

                            let index = this.formGroups.findIndex(co => co.id == formGroup.id)

                            if (index > -1) {
                                this.formGroups.splice(index, 1)
                                this.model = null

                                this.updateParentList('delete', formGroup)
                            }

                            return
                        }

                        this.$notify({
                            title: this.__("Delete Failed"),
                            message: this.$msg.notif.failed_delete,
                            type: "error"
                        });
                    })
                    .catch(err => {
                        console.log(err)

                        this.$notify({
                            title: this.__("Error"),
                            message: this.$msg.notif.service_error,
                            type: "error"
                        });
                    })
                    .finally(_ => {
                        this.loading = false
                    })
                })
                .catch(() => {})
            },
            handleClose() {
                this.showForm = false
                this.model = null
            },
            updateParentList(action, item) {
                this.$EventDispatcher.fire('FORM_FIELD_GROUPS_MODULE_UPDATE_PARENT', {
                    action,
                    item
                })
            }
		}
	}
</script>

<style lang="scss">

</style>
