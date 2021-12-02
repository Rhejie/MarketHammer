<template>
	<div class="card-actions">
		<div class="header-title">
            <h5>{{ __('Form Field Management') }}</h5>
        </div>
        <div class="search-container" style="margin-right: 15px;">
            <el-input
	            class="input-search"
	            v-model="search"
	            :placeholder="__('Type to search')"
	            @blur="applySearch('blur')"
	            @keyup.enter.native="applySearch('enter')">
	            <i slot="suffix" class="el-input__icon el-icon-search"></i>
            </el-input>
        </div>
        <div class="add-new-button">
            <button
                type="button"
                class="btn btn-primary btn-black"
                @click="openForm">
                <i class="fas fa-plus"></i> {{ currentTab === 'form-field' ? __("Add Form Field") : __("Add Form Group") }}
            </button>
        </div>
    </div>
</template>

<script>
	export default {
		name: "FormFieldManagementHeader",
		props: {
			currentTab: {
				required: true,
				type: String
			}
		},
		data() {
			return {
				search: null
			}
		},
		methods: {
			applySearch(action) {
				this.$EventDispatcher.fire("FORM_FIELD_MANAGEMENT_SEARCH_APPLIED", {
					action: action,
					search: this.search
				})
			},
			openForm() {
				this.$EventDispatcher.fire("FORM_FIELD_MANAGEMENT_CREATE_NEW")
			}
		}
	}
</script>