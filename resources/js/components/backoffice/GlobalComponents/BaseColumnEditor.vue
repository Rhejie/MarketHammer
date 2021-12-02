<template>
	<el-dialog
		class="wit_dialog"
		:visible.sync="showDialog"
		@close="closeConfiguration"
		:width="width"
		:append-to-body="true"
		:title="'Edit Column Option'"
		:close-on-click-modal="$closeOnClickModal"
    	:close-on-press-escape="$closeOnPressEsc">

		<el-checkbox 
			class="wit_checkbox parent"
			:indeterminate="doesIndeterminate"
			v-model="isAllChecked"
			@change="checkAll">
			{{ 'Select All Columns' }}
		</el-checkbox>

		<el-checkbox-group
			class="wit_group_checkbox"
			v-model="checkedColumns">
			<el-row :gutter="20">
				<el-col 
					v-for="col in columns"
					:key="col.value"
					:span="spanColumn ? spanColumn : (col.child && col.child.length && !col.childHidden ? 24 : 6)">

					<template v-if="col.child && col.child.length && !col.childHidden">
						<el-checkbox 
							class="wit_checkbox"
							:disabled="col.disabled"
							@change="toggelCheckBox(col)"
							:indeterminate="col.indeterminate"
							:label="col.value">{{ col.label }}
						</el-checkbox>
						
						<el-checkbox-group
							class="wit_group_checkbox"
							v-model="checkedColumns">
							<el-row :gutter="20">
								<el-col 
									:span="6"
									v-for="ch in col.child"
									:key="ch.value">
									<el-checkbox 
										class="wit_checkbox"
										v-show="!ch.hidden"
										:disabled="ch.disabled"
										@change="toggelCheckBox(ch)"
										:label="ch.value">{{ ch.label }}
									</el-checkbox>
								</el-col>
							</el-row>
						</el-checkbox-group>
					</template>

					<template v-else>
						<el-checkbox 
							class="wit_checkbox"
							v-show="!col.hidden"
							:disabled="col.disabled"
							:label="col.value">
							{{ col.label }}
						</el-checkbox>
					</template>
				</el-col>
			</el-row>
		</el-checkbox-group>

		<span class="dialog-footer" slot="footer">
			<button
                type="button"
                class="btn btn-default"
                @click="closeConfiguration"
            >
                {{ __("Cancel") }}
            </button>

			<el-button
				@click="saveConfiguration"
				class="btn btn-primary btn-black">
				{{ 'Save' }}
			</el-button>
		</span>
	</el-dialog>
</template>

<script>
import cloneDeep from 'lodash/cloneDeep'
import {dialogComponent} from '../../../mixins/dialogComponent.js'
export default {
	name: 'BaseColumnEditor',
	mixins: [dialogComponent],
	props: {
		width: {
			type: String,
			default: "60%"
		},
		top: {
			type: String,
			default: "15vh"
		},
		columnsSelected: {},
		selectableOptions: {
			type: Array,
			required: true
		},
		/**
		 * Default columns to set. This will also be used to Localstorage.
		 */
		defaultColumns: { 
			type: Array,
			default: () => []
		},
		enableLocalStorage: { // If configuration will be saved to the PC's local storage
			type: Boolean,
			default: true
		},
		localStorageKey: { // Local storage key to store the configuration. Note: MUST BE UNIQUE.
			type: String
		},
		spanColumn: {
			type: Number,
			default: null
		},
		
	},
	data() {
		return {
			originalConfig: [],
			checkedColumns: [],
			columns: cloneDeep(this.selectableOptions),
			isAllChecked: false

		}
	},
	mounted() {
		this.retrieveStoredConfiguration()
	
	},
	methods: {
		checkAll(val) {
			if (val) {
				this.checkedColumns = cloneDeep(this.getColumnValues(this.columns))
				for (let x of this.columns) {
					x.indeterminate = false
				}
			} else {
				this.checkedColumns = this.defaultColumns
				for (let x of this.columns) {
					if (x.child && !!x.child.length) {
						x.indeterminate = x.child.some(c => this.defaultColumns.includes(c.value))
						this.defaultColumns.includes(x.value) ? 
							this.checkedColumns = [...this.checkedColumns, ...x.child.map(c => { return c.value })] : null
					}
				}
			}
		},
		/**
		 * Get column values from given set of column objects
		 * @param columns <array> - array of columns
		 * @return <array>
		 */
		getColumnValues(columns) {
			return columns.reduce((acc, cur) => {
					acc = [cur.value, ...acc]
					if (cur.child && !!cur.child.length) {
						acc = [this.getColumnValues(cur.child), ...acc]
					}

					return acc.flat()
				}, [])
		},
		toggelCheckBox(col, fromEvent = true) {
			let inSelectedCols = this.checkedColumns.includes(col.value)

			if (col.child && !!col.child.length) {
				let childCols = this.getColumnValues(col.child)
				
				if (inSelectedCols) {
					childCols.forEach(cc => {
						this.checkedColumns.includes(cc) ? null : this.checkedColumns = [cc, ...this.checkedColumns]
					})
				} else {
					if(col.value == 'work_type'){
						this.checkedColumns = this.checkedColumns.filter(cc => !childCols.includes(cc))
					}else{
						this.checkedColumns = this.checkedColumns.filter(cc => !childCols.includes(cc) || this.defaultColumns.includes(cc))
					}
					
				}

				if (!!col.parent) this.checkParentColumn()
				col.indeterminate = !inSelectedCols && col.child.some(c => this.defaultColumns.includes(c.value))
			} else {
				this.checkParentColumn()
			}
		},
		checkParentColumn() {
			for (let x of this.columns) {
				if (x.child && !!x.child.length && !x.childHidden) {
					if (x.child.every(i => this.checkedColumns.includes(i.value))) {
						this.addColumn(x)
						x.indeterminate = false
					}
					else if (x.child.find(i => this.checkedColumns.includes(i.value))) {
						x.indeterminate = true
						let index = this.checkedColumns.indexOf(x.value)
						index > -1 ? this.checkedColumns.splice(index, 1) : null
					}
					else { 
						x.indeterminate = false
						let index = this.checkedColumns.indexOf(x.value)
						index > -1 ? this.checkedColumns.splice(index, 1) : null
					}
				}
			}
		},
		/**
		 * Add column to checked colums. Used when for parent columns
		 * @param col <object>
		 */
		addColumn(col) {
			if (!this.checkedColumns.includes(col.value)) {
				this.checkedColumns = [col.value, ...this.checkedColumns]
			}
		},
		getColumnCount(columns) {
			return columns.reduce((acc, cur) => {
				acc++
				if (cur.child && !!cur.child.length) acc += this.getColumnCount(cur.child)
				return acc
			}, 0)
		},

		updateParentColumns() {
			this.$emit('update:columnsSelected', this.originalConfig)
		},
		closeConfiguration() {
			this.checkedColumns = cloneDeep(this.originalConfig)
			this.closeModal()
		},
		// Local storage management
		saveConfiguration() {
			const executeLocalstorage = this.verifyLocalStorage()

			if (!executeLocalstorage) {
				this.originalConfig = cloneDeep(this.checkedColumns)
			} else {
				this.$localStorage.updateLocalStorageEntry(this.localStorageKey, this.checkedColumns)
      			this.originalConfig = cloneDeep(this.checkedColumns)
			}

			this.closeConfiguration()
  			this.updateParentColumns()
		},
		retrieveStoredConfiguration() {
			const executeLocalstorage = this.verifyLocalStorage()

			if (!executeLocalstorage) {
				this.checkedColumns = cloneDeep(this.defaultColumns)
				this.originalConfig = cloneDeep(this.defaultColumns)
			} else {
				if (!this.$localStorage.checkValue(this.localStorageKey)) {
					this.checkedColumns = cloneDeep(this.defaultColumns)
					this.$localStorage.updateLocalStorageEntry(this.localStorageKey, this.checkedColumns)
				}

				this.checkedColumns = this.$localStorage.retrieveSpecificEntry(this.localStorageKey)
				this.originalConfig = cloneDeep(this.checkedColumns)
				let toToggle = this.$ah.flatColumns(this.columns, false)
				.filter(c => this.checkedColumns.includes(c.value))

				for (let x of toToggle) {
					this.toggelCheckBox(x, false)
				}
			}

			this.updateParentColumns()
		},
		verifyLocalStorage() {
			if (!this.enableLocalStorage) return false

			if (!this.localStorageKey) {
				console.warn('Base Column Editor Warning. Localstorage enabled but no key detected.') 
				return false
			}

			if (!this.$localStorage.verifyIfKeyRegistered(this.localStorageKey)) {
				console.warn('Base Column Editor Warning. LocalStorage key not registered. Go to services/LocalStorageManagement and register the key.') 
				return false
			}

			return true
		}
	},
	computed: {
		doesIndeterminate() {
			return this.checkedColumns.length > 0 && this.checkedColumns.length < this.getColumnCount(this.columns)
		}
	},
	watch: {
		selectableOptions(newVal, oldVal) {
			this.columns = newVal
		},
		checkedColumns(newVal, oldVal) {
			if (newVal.length === this.getColumnCount(this.columns)) this.isAllChecked = true
		}
	}
	
}
</script>
<style>
	.el-checkbox-group.wit_group_checkbox {
		display: flex;
		float: left;
	}
</style>