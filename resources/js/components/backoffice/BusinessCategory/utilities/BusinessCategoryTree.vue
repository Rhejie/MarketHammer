<template>
	<div class="wit_form_group_container default mt-3">
		<!-- <div class="head">
			<el-input
				class="wit_input_search short"
				:placeholder="'Search business category'"
				suffix-icon="wit-search"
				v-model="filters.searchText">
			</el-input>
		</div> -->
		<el-row :gutter='20'>
			<el-col :row = "24">
				<el-tree
					class="wit_tree org_chart"
					ref="treeBusiness"
					:props="defaultProps"
					:data="parentCategory"
					:indent="30"
					:draggable="false"
					node-key="id"
					:check-strictly="true"
					:filter-node-method="filterTree"
					:expand-on-click-node = "false"
					:load="loadNode"
					lazy>

					<span
						slot-scope="{node,data}"
						class="c_tree_node"
						:title="node.name"
						:class="{ 'parent' : node.childNodes.length !== 0 }">
						<span class="c_node">
							<div class="c_node_content_container">
								<div class="description_container">
									<label class="clickable">
										{{ __dt(data.translations, 'name', data.name) }} ({{ data.ko_stat_code }})
									</label>
								</div>
								<div class="actions_container">
									<el-button
										v-if="!data.master_business_category_id || !data.main_business_category_id || !data.sub_business_category_id"
										icon="el-icon-plus"
										@click="addCategory(node, data)">
									</el-button>
									<el-button
										@click="updateCategory(node, data)"
										icon="el-icon-edit">
									</el-button>
									<el-button
										v-if="node.childNodes.length == 0"
										@click="deleteCategory(node, data)"
										icon="el-icon-delete-solid">
									</el-button>
								</div>
							</div>
						</span>
						</span>
					</span>
				</el-tree>
			</el-col>
		</el-row>
	</div>
</template>

<script type="text/javascript">

import axios from 'axios';
import merge from 'lodash/merge'
import cloneDeep from 'lodash/cloneDeep'
import split from 'lodash/split'
import swal from 'sweetalert2/dist/sweetalert2.all.min.js'

export default {
	props:['dataBusinessCategory', 'filterSearch'],
	data: function () {
		let defaultExpand = false

		return{
			businessCategory	: cloneDeep(this.dataBusinessCategory),
			parentCategory		: cloneDeep(this.dataBusinessCategory),
			filters				: {
				searchText 		: ''
			},
	        defaultProps		: {
	          	children: 'children',
	          	label: 'label'
	        },
	        defaultExpandAll 	: defaultExpand,
	        defaultExpandedKeys : [],
	        editCheckbox  		: false,
	        checkedId   		: [],
	        allowCheckbox 		: false,
	        selectedNode 		: null,
	        selectedData 		: null,
	        idTest 				: 100000
		}
	},
	created() {
        this.$EventDispatcher.listen('BUSINESS_CATEGORY_NEW_ITEM_CREATED', data => {
        	this.appendNode(data)
        })

        this.$EventDispatcher.listen('BUSINESS_CATEGORY_ITEM_UPDATED', data => {
        	this.updateNode(data)
        })

        this.$EventDispatcher.listen('BUSINESS_CATEGORY_ITEM_DELETED', data => {
        	let getData = this.businessCategory.find(fn => { return fn.id == data})
    		if (getData) {
    			this.$refs.treeBusiness.remove(getData)
    		}
        })
	},
	methods: {
		async loadNode(node, resolve) {
			if (node.level === 0) {
	          	return resolve(this.parentCategory);
	        }

	        if (node.data) {
	        	let data = node.data
	        	let isLastLevelData = false
	        	let params = {master_business_category_id : null, main_business_category_id : null, sub_business_category_id : null}

	        	//Last level category; no data to fecth
	        	if (data.master_business_category_id && data.main_business_category_id && data.sub_business_category_id ){
	        		isLastLevelData = true
	        	}
	        	//Sub level category; fetch last level category
	        	else if (data.master_business_category_id && data.main_business_category_id ){
	        		params.master_business_category_id = data.master_business_category_id
	        		params.main_business_category_id = data.main_business_category_id
	        		params.sub_business_category_id = data.id
	        	}
	        	//Main category; fetch sub category
	        	else if (data.master_business_category_id ){
	        		params.master_business_category_id = data.master_business_category_id
	        		params.main_business_category_id = data.id
	        	}
	        	//Master category; fetch main category
	        	else {
	        		params.master_business_category_id = data.id
	        	}

	        	if (!isLastLevelData) {
	        		let getChildren = await this.getChildren(params)
	        		return resolve(getChildren)
	        	}
	        }

        	return resolve([]);
	    },
		async getChildren(params) {
            //this.tableLoading = true;
            let data = []

            await this.$API.BusinessCategory.getCategoryList(params).then(result => {
            	let res = result.data
            	console.log('res', res)
            	data = res.categories
            	this.businessCategory = this.businessCategory.concat(res.categories)
            })
            .catch(_ => {

            });

            return data
        },
        updateNode(data) {
        	this.selectedData.name = data.name
        	this.selectedData.description = data.description
        	this.selectedData.sic_code = data.sic_code
        	this.selectedData.ko_stat_code = data.ko_stat_code
        	this.selectedData.tax_code = data.tax_code

        	//Check if exist in the node, then remove to update
        	/*let getNode = this.$refs.treeBusiness.getNode(data)
        	if(getNode){
        		this.$refs.treeBusiness.remove(getNode)
        	}

        	let newParentId = null
        	if(data.sub_business_category_id != this.selectedData.sub_business_category_id){
        		parentId = data.sub_business_category_id
        	}
        	else if(data.main_business_category_id != this.selectedData.main_business_category_id){
        		parentId = data.main_business_category_id
        	}
        	else if(data.sub_business_category_id != this.selectedData.sub_business_category_id){
        		parentId = data.sub_business_category_id
        	}

        	//If has new parent; remove to the current then add to another
        	if(newParentId){
        	}*/
        },
        appendNode(data, root = true) {
        	let parentId = null
        	if (data.sub_business_category_id) {
        		parentId = data.sub_business_category_id
        	}
        	else if (data.main_business_category_id) {
        		parentId = data.main_business_category_id
        	}
        	else if (data.master_business_category_id) {
        		parentId = data.master_business_category_id
        	}

        	if (parentId) {
        		let getParentNode = this.businessCategory.find(fn => { return fn.id == parentId})
        		if (getParentNode) {
        			this.$refs.treeBusiness.append(data, getParentNode)
        		}
        	} else {
        		if (root) {
        			this.parentCategory.push(data)
        		}
        		else if (!!this.parentCategory.length) {
        			let insertId = this.parentCategory.length - 1
        			console.log('insertId', insertId, this.parentCategory[insertId], data)
        			this.$refs.treeBusiness.insertAfter(data, this.parentCategory[insertId])
        			this.parentCategory.push(data)
        		}
        	}
        },
        addCategory(node, data) {
        	/*console.log('addCategory', node, data)
        	let getNode = this.$refs.treeBusiness.getNode(data)
        	console.log('getNode', getNode)
        	return*/
        	let params = {data : data}
        	this.$EventDispatcher.fire('BUSINESS_CATEGORY_ADD', params);
        },
        updateCategory(node, data){
        	console.log('updateCategory', data.id)

            // this.$API.BusinessCategory
        	this.selectedNode = node
        	this.selectedData = data
        	let params = {data : data}
        	this.$EventDispatcher.fire('BUSINESS_CATEGORY_UPDATE', params);
        },
        deleteCategory(node, data){
        	if(node.childNodes.length > 0){
        		this.$notify({
                    title: "Failed",
                    message: "Failed to delete business category." + " " + "Category has sub categories.",
                    type: "error"
                })
                return
        	}
        	let params = {data : data}
        	this.$EventDispatcher.fire('BUSINESS_CATEGORY_DELETE', params);
        },
		setHyperLink(data) {
			let link = null
			return link
		},
		filterTree(value, data){
			if(!value) return true;

			let isFound = false;
			if((data.name && ( 
					(data.name.toLowerCase()).includes(value.toLowerCase()) || data.name.toLowerCase() == value.toLowerCase() ))
				|| (data.code && ((data.code.toLowerCase()).includes(value.toLowerCase()) || data.code.toLowerCase() == value.toLowerCase())) ){
				isFound = true
			}
			if(!isFound){
				if(data.translations && data.translations.length > 0 && (
					data.translations.some(rfc => ( rfc.lang_en && (rfc.lang_en.toLowerCase()).includes(value.toLowerCase())) || 
						( rfc.lang_ko && (rfc.lang_ko.toLowerCase()).includes(value.toLowerCase())) || 
						( rfc.lang_jap && (rfc.lang_jap.toLowerCase()).includes(value.toLowerCase()))
						) 
					)
				)
				{ 
					isFound = true
				}
			}

			return isFound
		},
		dbClickHandler(data) {
			console.log('dbClickHandler')
			//Get data for certain parent
			if(data.children.length == 0){

			}
		},
        getParent(node, checkArr){
        	let arr = checkArr
        	arr.push(node.id)

        	if(node.parent_id && node.parent_id > 0 && node.type != 'Department'){
        		let getData = this.businessCategory.find(ci => {
					return ci.id == node.parent_id
        		})
        		arr = this.getParent(getData, arr)
        	}
        	return arr
        },
	    handleDragEnter(draggingNode, dropNode, ev) {
	        //console.log('tree drag enter: ', dropNode.label);
	    },
	    handleDragLeave(draggingNode, dropNode, ev) {
	        //console.log('tree drag leave: ', dropNode.label);
	    },
	    handleDragOver(draggingNode, dropNode, ev) {
	    },
	    handleDragEnd(draggingNode, dropNode, dropType, ev) {
	        //console.log('tree drag end: ', dropNode && dropNode.label, dropType);
	    },
	    handleDrop(draggingNode, dropNode, dropType, ev) {
	        //console.log('tree drop: ', dropNode && dropNode.label, dropType);
	    },
        allowDrop(draggingNode, dropNode, type) {
        	console.log('dropNode', dropNode.data.label)
        	console.log('type', type)
	    }
	},
	watch: {
		dataBusinessCategory() {
			this.businessCategory = cloneDeep(this.dataBusinessCategory)
			this.parentCategory = cloneDeep(this.dataBusinessCategory)
		},
		'filterSearch'(val){
			if(this.$refs && this.$refs.treeBusiness){
				this.$refs.treeBusiness.filter(val);
			}
		}
	},
}
</script>

<style lang="scss">
.el-tree{
    padding: 8px;
    border-radius: 2px !important;

	.el-tree-node__content:hover{
		background-color: unset;
	}
	.el-tree-node__content{
		border: 1px solid #dcdbe4;
	    border-radius: 2px !important;
	    margin-bottom: 8px;
	}


	.c_node_content_container {
		display: flex !important;
	    align-items: center !important;
	    padding: 8px 0 2px 0 !important;

	    .actions_container{
	    	padding-right: 16px !important;
		    position: absolute !important;
		    right: 0 !important;

			.el-button {
				background: transparent;
				padding: 0px;
				border: none;
			}
		}
	}
}

</style>
