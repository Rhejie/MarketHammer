<template>
	<div class="p-3 product-general-component">
		<div class="d-flex align-items-center">
			<h4 class="text-black">{{ __('BASIC INFO') }}</h4>
			<el-button
				v-if="!isUpdating"
				type="text"
				class="ml-3 text-yellow"
				@click="enableUpdating">
				<u>{{ __("Update Profile") }}</u> 
			</el-button>

			<div class="ml-auto" v-if="isUpdating">
				<el-button
					type="text"
					class="text-black"
					@click="cancelUpdate">
					<u>{{ __("Cancel") }}</u>
				</el-button>

				<el-button
					:disabled="loading"
					round
					class="btn btn-orange"
					@click="updateProduct">
					{{ __("Save") }}
				</el-button>
			</div>
		</div>

		<product-form
			ref = "refProductForm"
            :page-data="formPageData"
            :model = "productForm">
        </product-form>

        <div class="row" v-if = "productForm">
			<div class="col-md-12">
				<div slot="label">
					<label>{{ __('Product Images') }}</label>
				</div><br>

				<div class="d-flex align-items-center">
					<el-upload
						v-loading = "uploadLoading"
						ref="productMedias"
						name="productMedias"
						action="/product-media"
						:data = "{product_id : productForm.id}"
						:limit="5"
                        :on-exceed="handleExceed"
                        :before-upload="beforeUpload"
                        :headers = "headers"
                        :file-list="productImages"
                        :http-request="uploadFiles" 
                        accept=".jpeg,.png,.svg,.jpg"
						multiple
						list-type="picture-card"
						class="avatar-uploader-2"
						:auto-upload="true">
						<i slot='default' class="fas fa-camera avatar-uploader-icon"></i>
						<div slot="file" slot-scope="{file}">
							<img class="el-upload-list__item-thumbnail" :src="file.url" alt="">
							<span class="el-upload-list__item-actions">
								<span
									class="el-upload-list__item-preview"
									@click="handlePictureCardPreview(file, file.id )">
									<i class="el-icon-zoom-in"></i>
								</span>
								<span
									class="el-upload-list__item-delete"
									@click="handleRemove(file)">
									<i class="el-icon-delete"></i>
								</span>
							</span>
						</div>
					</el-upload>
				</div>
			</div>
		</div>

		<!-- Image Preview -->
	    <el-dialog
	    	:visible.sync="showImage"
	    	@close="closeImagePreview"
	    	top="5vh">
            <img width="100%" :src="dialogImageUrl" alt="">
		</el-dialog>
		<!-- End of Image Preview -->

	</div>
</template>

<script>
	import cloneDeep from 'lodash/cloneDeep'

	export default {
		name: 'ProductGeneral',
		props: {
			pageData: {
				type: Object,
				required: true
			},
			product: {}
		},
		data() {
			return {
				loading: false,
				isUpdating: false,
				productForm: this.product,
				productFormCopy: cloneDeep(this.product),
				formPageData : {
					categories : this.pageData.categories,
					measurements : this.pageData.measurements,
					forceDisable : true,
					business : this.pageData.business ? this.pageData.business : null
				},
				productImages	: [],
				dialogImageUrl  : null,
				showImage 		: false,
				headers: {
		            'X-CSRF-TOKEN': window.Laravel.csrfToken
		        },
		        uploadLoading 	: false

			}
		},
		created() {
			this.initialize()

			this.$EventDispatcher.listen('PRODUCT_ITEM_UPDATE', product => {
				console.log('PRODUCT_ITEM_UPDATE', product)
				this.isUpdating = false
				this.formPageData.forceDisable = true
			})
		},
		methods: {
			updateProduct() {
				console.log('this.$refs.refProductForm', this.$refs.refProductForm)
				this.$refs.refProductForm.updateForm()
			},
			enableUpdating() {
				this.isUpdating = true
				this.formPageData.forceDisable = false
			},
			cancelUpdate() {
				this.isUpdating = false
				this.formPageData.forceDisable = true

				if (this.productFormCopy) {
					this.businessForm = cloneDeep(this.productFormCopy)
				}
			},
			initialize() {
				this.productForm = cloneDeep(this.product)
				this.productFormCopy = cloneDeep(this.product)
				if(this.product && this.product.media){
					this.productImages = this.product.media.map(med => {
	                    let exploded = med.media_url.split('/')
	                    med.name = exploded[exploded.length - 1]
	                    med.url = `/storage/${med.media_url}`
	                    return med
	                })
				}
				this.productImages = this.product && this.product.media ? this.product.media : []
			},
			handleRemove(file) {
            	console.log('consolidate', file)
            	this.uploadLoading = true

                this.$API.ProductMedia.destroy(file.id)
	            .then(res => {
	                let result = res.data
	                console.log('destroy', result)
	                let index = this.productImages.findIndex(f => f.id == file.id)
                    if (index > -1) {
                        this.productImages.splice(index, 1)
                    }
	            })
	            .catch(err => {
	                console.log(err)
	            })
	            .finally(_ => {
	                this.uploadLoading = false
	            })
            },
            handleExceed(file, fileList) {
            	this.$notify({
                    title: this.__("File Limit Exceed"),
                    message: this.__('The limit is 5, you cannot select files more than 5.'),
                    type: "warning"
                })
            },
            handleChange(file, fileList) {
            	const fileSize = file.size / 1024 / 1024 < 2;
				const fileType = ['image/jpeg', 'image/png', 'image/jpg', 'image/svg'].includes(file.raw.type)

				if (!fileType) {
					fileList.pop()
					this.$notify.error({
						title: this.__('Invalid File'),
						message: this.__('Not a supported file type (JPEG, JPG, PNG, SVG)')
					})
					return
				}

				if (!fileSize) {
					fileList.pop()
					this.$notify.error({
						title: this.__('Max Size'),
						message: this.__('File size should not exceed 2MB')
					});
					return
				}

            	this.productImages.push(file)
            },
            handlePictureCardPreview(file, id) {
		        this.dialogImageUrl = file.url;
		        this.showImage = true;
                this.fileID = id;
		    },
		    closeImagePreview() {
		    	this.dialogImageUrl = null
		    	this.showImage = false
		    },
		    handleUploadSuccess(res, file) {
		    	console.log("handleUploadSuccess", res, file)
		    	this.productImages = res.data
		   	},
		    beforeUpload(file){
		    	const fileSize = file.size / 1024 / 1024 < 2;
				const fileType = ['image/jpeg', 'image/png', 'image/jpg', 'image/svg'].includes(file.type)

				if (!fileType) {
					this.$notify.error({
						title: this.__('Invalid File'),
						message: this.__('Not a supported file type (JPEG, JPG, PNG, SVG)')
					})
					return false
				}

				if (!fileSize) {
					this.$notify.error({
						title: this.__('Max Size'),
						message: this.__('File size should not exceed 2MB')
					});
					return false
				}
		    },
		    uploadFiles(files){
		    	let form = new FormData();
		    	form.append('product_id', this.productForm.id);
		    	form.append('productMedias', files.file);
		    	this.uploadLoading = true

		    	this.$API.ProductMedia.store(form)
	            .then(res => {
	                let result = res.data
	                if(result.data){
	                	let med = result.data

	                	let exploded = med.media_url.split('/')
	                	med.name = exploded[exploded.length - 1]
	                    med.url = `/storage/${med.media_url}`

	                    this.productImages.push(med)
	                }
	                
	            })
	            .catch(err => {
	                console.log(err)
	            })
	            .finally(_ => {
	                this.uploadLoading = false
	            })
		    }

		},
		computed: {
		},
		watch: {
			product() {
				this.initialize()
			}
		}
	}
</script>

<style lang="scss">
	.product-general-component {
		margin-bottom: 30px;
	}
</style>
