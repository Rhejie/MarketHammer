<template>
  <div class="home-categories" style="height:190px;">
    <!-- <el-cascader-panel :options="categories" :props="cascaderProps"></el-cascader-panel> -->
    <el-table
      :data="categories" :show-header="false"
      height="190">
      <el-table-column
        prop="name">
        <template slot-scope="scope">
          <el-popover
            v-if="scope.row.children.length > 0"
            placement="right"
            trigger="hover">
            
            <el-table
              :data="scope.row.children" :show-header="false">
              <el-table-column
                prop="name">
                <template slot-scope="scope">
                  <el-popover
                    v-if="scope.row.children.length > 0"
                    placement="right"
                    trigger="hover">
                    <el-table
                      :data="scope.row.children" :show-header="false">
                      <el-table-column
                        prop="name">
                        <template slot-scope="scope">
                          <el-popover
                            v-if="scope.row.children.length > 0"
                            placement="right"
                            trigger="hover">
                            <el-table
                              :data="scope.row.children" :show-header="false">
                              <el-table-column
                                prop="name">
                                <template slot-scope="scope">
                                  <el-popover
                                    v-if="scope.row.children.length > 0"
                                    placement="right"
                                    trigger="hover">
                                    <el-table
                                      :data="scope.row.children" :show-header="false">
                                      <el-table-column
                                        prop="name">
                                        <template slot-scope="scope">
                                            {{ scope.row.name }}
                                        </template>
                                      </el-table-column>
                                    </el-table>
                                    <div slot="reference">
                                      <span >{{ scope.row.name }}</span>
                                      <i style="float: right;" class="el-icon-arrow-right"></i>
                                    </div>
                                    
                                  </el-popover>

                                  <span v-else>{{ scope.row.name }}</span>

                                </template>
                              </el-table-column>
                            </el-table>
                            <div slot="reference">
                              <span >{{ scope.row.name }}</span>
                              <i style="float: right;" class="el-icon-arrow-right"></i>
                            </div>
                            
                          </el-popover>

                          <span v-else>{{ scope.row.name }}</span>

                        </template>
                      </el-table-column>
                    </el-table>
                    <div slot="reference">
                      <span >{{ scope.row.name }}</span>
                      <i style="float: right;" class="el-icon-arrow-right"></i>
                    </div>
                    
                  </el-popover>

                  <span v-else>{{ scope.row.name }}</span>

                </template>
              </el-table-column>
            </el-table>

            <div slot="reference">
              <span >{{ scope.row.name }}</span>
              <i style="float: right;" class="el-icon-arrow-right"></i>
            </div>
            
          </el-popover>

          <span v-else>{{ scope.row.name }}</span>

        </template>
      </el-table-column>
    </el-table>
  </div>
<!--   <div class="home-categories">
    <el-menu :default-active="activeIndex" class="el-menu-demo scroll" mode="horizontal" @select="handleCategorySelect" active-text-color="#EC3434">
      <el-menu-item index="all" key="all" class="category-item">All</el-menu-item>
      <el-menu-item v-for="category in categories" :index="category.id+''" :key="category.id" class="category-item">
        {{ category.name }}
      </el-menu-item>
    </el-menu>
  </div> -->
</template>

<script>
  export default {
    data() {
      return {
        cascaderProps: {
          expandTrigger: 'hover',
          value: 'id',
          label: 'name'
        },
        activeIndex: 'all',
        categories: []
      };
    },
    methods: {
      handleCategorySelect(selected) {
        // console.log(selected);
        this.$EventDispatcher.fire('CATEGORY_SELECTED', selected)
      },
      getImagePath(path){
        if (path == null) {
          return '/image/no_image.png'
        } else {
          return path
        }
      }
    },
    mounted(){
      this.$API.Category.getParentCategories()
        .then(result => {
          this.categories = result.data.categories

            
          this.$EventDispatcher.fire('CATEGORY_SELECTED', 'all')
        })
        .catch(err => {
            console.log('Error!', err)
        })
        .finally(_ => {
            this.pageLoading = false
        })
    }
  }
</script>
<style>
  .el-scrollbar .el-cascader-menu{
    background-color: white;
  }
</style>
