<template>
  <div class="form-field p-3">
    <el-table
        class="table-list-container"
        :data="formFields"
        style="width: 100%"
        v-loading="loading"
		@row-click="update">
		<el-table-column
			prop="form_group.name"
			:label="__('Form Group')"
			:sortable="true">
				<template slot-scope="scope">
					<template v-if = scope.row.form_group>
						{{ __dt(scope.row.form_group.translations[0], 'form_group.name', $sf.ucwords(scope.row.form_group.name[0])) }}
					</template>
				</template>
		</el-table-column>
		<el-table-column
			prop="field_label"
			:label="__('Label')"
			:sortable="true">
				<template slot-scope="scope">
					{{ __dt(scope.row.translations, 'field_label', $sf.ucwords(scope.row.field_label)) }}
				</template>
		</el-table-column>
		<el-table-column
			prop="field_type"
			:label="__('Type')"
			:sortable="true">
				<template slot-scope="scope">
					{{ __dt(scope.row.translations, 'field_type', $sf.ucwords(scope.row.field_type)) }}
				</template>
		</el-table-column>
		<el-table-column
			prop="field_description"
			:label="__('Description')"
			:sortable="true">
				<template slot-scope="scope">
					{{ __dt(scope.row.translations, 'field_description', $sf.ucwords(scope.row.field_description)) }}
				</template>
		</el-table-column>

		<el-table-column :label="__('Actions')">
			<template slot-scope="scope">
				<div>
					<button class="btn btn-default text-red" @click="deleteData(scope.row)">
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

    <form-field-form
        :model="model"
        v-if="showForm"
        :form-groups="formFieldGroups"
        :visible.sync="showForm"
        @close="handleClose">
    </form-field-form>
  </div>
</template>

<script>
	import cloneDeep from "lodash/cloneDeep";
	import pagination from "../../../mixins/pagination";

	export default {
		name: "FormField",
		mixins: [pagination],
		props: {
			formFieldGroups: {
				required: true,
				type: Array,
			},
  		},
  		data() {
  			/*let columns = [
	  			{ label: this.__("Form Group"), prop: "form_group.name", sortable: true },
	  			{ label: this.__("Label"), prop: "field_label", sortable: true },
	  			{ label: this.__("Type"), prop: "field_type", sortable: true },
	  			{ label: this.__("Description"), prop: "field_description", sortable: true },
  			];*/

  			return {
  				filters: {
  					searchString: null,
  				},
  				//columns: columns,
  				showForm: false,
  				loading: false,
  				model: null,
  				formFields: [],
  				optionReferenceList: [],
  			};
  		},
  		created() {
  			this.fetch();

  			this.$EventDispatcher.listen("FORM_FIELD_MODULE_ITEM_CREATED", (formField) => {
  				this.formFields.unshift(formField);
  				this.filters.total++;
  			});

  			this.$EventDispatcher.listen("FORM_FIELD_MODULE_ITEM_UPDATED", (formField) => {
  				let index = this.formFields.findIndex((fg) => fg.id == formField.id);

  				if (index > -1) {
  					this.formFields.splice(index, 1, formField);
  				}
  			});
  		},
 	methods: {
	  	fetch() {
	  		let postData = cloneDeep(this.filters);

	  		this.loading = true;

	  		this.$API.FormField.fetch(postData)
	  		.then((res) => {
	  			this.formFields = cloneDeep(res.data.data);
	  			this.filters.total = res.data.total;
	  		})
	  		.catch((err) => {
	  			console.log(err);
	  		})
	  		.finally((_) => {
	  			this.loading = false;
	  		});
	  	},
	  	update(formField) {
	  		this.showForm = true;
	  		this.model = cloneDeep(formField);
	  	},
	  	deleteData(formField) {
	  		this.$confirm(this.$msg.notif.confirm_delete, this.__("Warning"), {
	  			confirmButtonText: this.__("Delete"),
	  			cancelButtonText: this.__("Cancel"),
	  			type: "warning",
	  			confirmButtonClass: "el-button--danger",
	  		})
	  		.then(() => {
	  			this.loading = true;

	  			this.$API.FormField.delete(formField.id)
	  			.then((res) => {
	  				if (res.data) {
	  					this.$notify({
	  						title: this.__("Successful"),
	  						message: this.$msg.notif.success_delete,
	  						type: "success",
	  					});

	  					let index = this.formFields.findIndex((co) => co.id == formField.id);

	  					if (index > -1) {
	  						this.formFields.splice(index, 1);
	  						this.model = null;
	  					}

	  					return;
	  				}

	  				this.$notify({
	  					title: this.__("Delete Failed"),
	  					message: this.$msg.notif.failed_delete,
	  					type: "error",
	  				});
	  			})
	  			.catch((err) => {
	  				console.log(err);

	  				this.$notify({
	  					title: this.__("Error"),
	  					message: this.$msg.notif.service_error,
	  					type: "error",
	  				});
	  			})
	  			.finally((_) => {
	  				this.loading = false;
	  			});
	  		})
	  		.catch(() => {});
	  	},
	  	handleClose() {
	  		this.showForm = false;
	  		this.model = null;
	  	}
  	},
};
</script>

<style lang="scss"></style>

