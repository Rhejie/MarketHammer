<template>
  <div>
        <el-table
        class="table-list-container"
        fit
        v-loading="tableLoading"
        style="overflow-y: scroll;"
        :data="formList"
        @row-click="formListDetails">
          <el-table-column :label="__('Form ID')" :sortable="true">
            <template slot-scope="scope">
                {{ scope.row.form_id }}
            </template>
          </el-table-column>
          <el-table-column prop="form_type.name" :label="__('Type')" :sortable="true">
          </el-table-column>
          <el-table-column
            v-for="column in columns"
            :key="column.prop"
            :label="column.label"
            :show-overflow-tooltip="column.showTooltip"
            :sortable="column.sortable"
            :prop="column.prop"
          >
            <template slot-scope="scope">
              <template v-if="column.prop === 'created_at'">
                {{ $df.formatDate(scope.row.created_at, "YYYY-MM-DD") }}
              </template>

              <template v-else>
                {{ scope.row[column.prop] }}
              </template>
            </template>
          </el-table-column>
          <el-table-column
            prop="form_to_supplier_count_count"
            :label="__('Submitted')"
            align="center"
            :sortable="true"
          >
          </el-table-column>

          <el-table-column
            prop="form_recieved_supplier_count_count"
            :label="__('Received')"
            align="center"
            :sortable="true"
          >
          </el-table-column>

          <el-table-column
            prop="form_declined_supplier_count_count"
            :label="__('Declined')"
            align="center"
            :sortable="true"
          >
          </el-table-column>
          <el-table-column
            prop="expiration_date"
            :label="__('Exp Date')"
            :sortable="true"
          >
          </el-table-column>
          <el-table-column prop="form_status.name" :label="__('Status')" :sortable="true">
          </el-table-column>

          <el-table-column prop="instruction"  show-overflow-tooltip :label="__('Instruction')" :sortable="true">
          </el-table-column>

          <el-table-column :label="__('Actions')" align="center">
            <!--<template slot-scope="scope">
                            <div>
                                <button
                                    class="btn btn-default"
                                    @click="editComplex(scope.row)"
                                >
                                    {{ __("Edit") }}
                                </button>
                                <button
                                    class="btn btn-default"
                                    @click="
                                        askToDeleteComplex(
                                            scope.row.id,
                                            scope.$index
                                        )
                                    "
                                >
                                    {{ __("Delete") }}
                                </button>
                            </div>
                        </template> -->
            <template slot-scope="scope">
              <el-dropdown trigger="click" @command="handleAction">
                <el-button class="text-black" type="text" icon="fas fa-ellipsis-v" @click.stop>
                </el-button>
                <el-dropdown-menu slot="dropdown">
                  <el-dropdown-item
                    :command="{
                      action: 'update',
                      data: scope.row,
                    }"
                  >
                    <span class="text-blue">
                      <i class="fas fa-edit"></i>
                      {{ __("Update") }}
                    </span>
                  </el-dropdown-item>
                  <el-dropdown-item
                    divided
                    :command="{
                      action: 'delete',
                      data: scope.row.id,
                      index: scope.$index,
                    }"
                  >
                    <span class="text-red">
                      <i class="fas fa-trash-alt"></i>
                      {{ __("Delete") }}
                    </span>
                  </el-dropdown-item>
                </el-dropdown-menu>
              </el-dropdown>
            </template>
          </el-table-column>
        </el-table>
  </div>
</template>
<script>
export default {
  name: "FormListView",
  props: {
    formList: {
      type: Array,
      required: true,
    },
    tableLoading: {
      type: Boolean,
      required: true,
    },
  },
  data() {
    return {
      columns: [
        {
          label: this.__("Ref ID"),
          prop: "refrence_id",
          showTooltip: true,
          sortable: true,
        },
        {
          label: this.__("Title"),
          prop: "form_title",
          showTooltip: true,
          sortable: true,
        },
      ],
    };
  },
  created() {},
  methods: {
    formListDetails(data) {
      this.$emit("formListDetailsData", data);
    },

    handleAction(info) {
      if (info.action === "delete") {
        this.$emit("deleteFormList", info.data, info.index);
      } else if (info.action === "update") {
        // this.editBusiness(info.data)
        this.$emit("editFormList", info.data);
      }
    },
  },
};
</script>

<style lang="scss">
.data-content {
  margin-top: 10px;
}
</style>
