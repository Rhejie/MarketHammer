<template>
	<el-drawer
		title="Search"
	  	custom-class="custom-search"
	  	:visible.sync="drawer"
	  	:modal="modal"
	  	:size="drawerSize"
	  	:modal-append-to-body="modal"
	   	direction="ttb">

	   	<el-input
            v-model="search"
            suffix-icon="el-icon-search"
            @keyup.enter.native="buttonSearch">
        </el-input>

        <div class="search-tags">
	        <el-tag
			  v-for="tag in tags"
			  :key="tag.keyword"
			  closable
			  size="mini"
			  @close="handleClose(tag)"
			  :type="tagType"
			  @click="searchFromTags(tag.keyword)">
			  {{tag.keyword}}
			</el-tag>
		</div>

	    <el-container>
	      <el-main class="bg-white" v-if="categories.length > 0">
	      	<el-row>
			 <!--  <el-col :span="4" :offset="2" class="category-col">
			  	<i class="el-icon-fork-spoon" style="color: "></i>
			  	<span class="category-span">Category</span>
			  </el-col> -->
			  <a @click="searchByCategory(category.name)" v-for="category in categories" :key="category.id" >
				  <el-col :span="4" class="category-col">
					<!-- <i class="el-icon-shopping-bag-2"></i><br> -->
					<img v-if="category.categoryImagePath" :src="'../storage/' + category.categoryImagePath" :alt="category.categoryImagePath" width="50px">
                    <img v-else :src="'/image/no_image.png'" alt="no_image.png" width="50px"><br>
					<span class="category-span">{{ category.name }}</span>
				</el-col>
			  </a>
			<!--   <el-col :span="4" class="category-col">
			  	<i class="el-icon-shopping-cart-2"></i>
			  	<span class="category-span">Category</span>
			  </el-col>
			  <el-col :span="4" class="category-col">
			  	<i class="el-icon-brush"></i>
			  	<span class="category-span">Category</span>
			  </el-col>
			  <el-col :span="4" class="category-col">
			  	<i class="el-icon-present"></i>
			  	<span class="category-span">Category</span>
			  </el-col>
			  <el-col :span="2"></el-col> -->
			</el-row>
	      </el-main>
	    </el-container>
	</el-drawer>
</template>

<script>
  export default {
	props: ['searchTags'],
    data() {
      return {
        drawer: false,
        direction: 'rtl',
        withHeader: false,
        modal: false,
        search: '',
        tags: this.searchTags.data,
        tagType: 'info',
        drawerSize: '10',
        categories: [],
        searchHistory: [],
		searchResults: [],
		loading: false,
      };
    },
    created(){
        this.$EventDispatcher.listen('SHOW_SEARCH', data => {
            this.drawer = true;
        })
    },
    methods: {
    	handleClose(tag) {
	        this.tags.splice(this.tags.indexOf(tag), 1);
	    },
    	buttonSearch() {

    		if (this.search != '') {
				if(!this.tags.some(t => t.keyword.toLowerCase() === this.search.toLowerCase())) {
                    this.tags.push({keyword:this.search});
                }
	    		// this.searchHistory = {
	      //   		userID: this.$userData.activeUserId,
	      //   		keyword: this.search
	      //   	};

	    		// this.$API.Home.saveSearchHistory(this.searchHistory)
			    //     .then(result => {
			    //     })
			    //     .catch(err => {
			    //         console.log('Error saving search history!', err)
			    //     })
			    //     .finally(_ => {
			    //         this.pageLoading = false;
			    //     })
    		}
    		
    		// console.log(this.tags)
			// console.log(this.search)
			this.drawer = false;
			this.$EventDispatcher.fire('SHOW_SEARCH_RESULTS');
			this.$API.GlobalSearch.searchBusiness(this.search).then(res => {
				this.searchResults = res.data.searchResults;
				this.$EventDispatcher.fire('SEARCH_RESULTS_FETCHED', {
					searchResults: this.searchResults,
					search: this.search
				});
			}).catch(err => {
				
			});
    	},
    	resetSearchHistory() {
    		this.searchHistory = [];
		},
		searchFromTags(tag) {
			this.search = tag;
			this.buttonSearch();
		},
		searchByCategory(categoryName) {
			this.search = categoryName;
			this.buttonSearch();
		}
    },
    mounted(){
      this.$API.Category.getCategories()
        .then(result => {
            // console.log('cate', result)
            // console.log(result.data.categories)
            this.categories = result.data.categories

        })
        .catch(err => {
            console.log('Error!', err)
        })
        .finally(_ => {
            this.pageLoading = false
		})
		
		this.$EventDispatcher.listen('UPDATE_SEARCH_TAGS', tags => {
			this.tags = tags;
		});
    }

  };
</script>

<style lang="scss">
.custom-search{
	background-color: #EC3434;
	
	.el-drawer__header {
	    align-items: center;
	    color: #ffffff !important;
	    display: flex;
	     margin-bottom: 0px !important; 
	    text-align: center !important;
	    padding: 20px 20px !important;
	    font-size: 20px !important;
		border-bottom: 1px solid white !important;
		background-color: #EC3434 !important;
		height: 50px !important;
		
		.el-dialog__close {
			margin-right: -10px !important;
		}

		span {
			font-size: 17px !important;
			font-weight: bold !important;
			outline: 0 !important;
		}
	}

	.el-drawer__header>:first-child {
	    border: none !important;
	}

	.el-input {
		padding: 5px !important;
	}

	.el-tag + .el-tag {
		margin-left: 5px;
		margin-top: 5px;
	}
	.button-new-tag {
		margin-left: 5px;
		padding-top: 0;
		padding-bottom: 0;
	}
}
</style>