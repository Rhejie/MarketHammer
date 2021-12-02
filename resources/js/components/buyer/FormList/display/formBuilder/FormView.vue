<template>
  <div>
    <div class="form-builder-form" v-for="(form, index) in formTemplate" :key="index">
      <div class="form-builder-form-header">
        {{ form.form_builder_group.name }}
      </div>
      <div class="form-builder-form-content">
        <div
          class="form-builder-form-content-input"
          v-for="(formInput, index) in form.form_field_template"
          :key="index"
        >
          {{ formInput.fomr_builder_field.field_label }}
          <el-input
            v-if="formInput.fomr_builder_field.field_type === 'Single Text'"
            :placeholder="__(`Please Enter ${formInput.fomr_builder_field.field_label}`)"
          >
          </el-input>
          <el-input
            v-else-if="formInput.fomr_builder_field.field_type === 'Multiline Text'"
            type="textarea"
            :placeholder="__(`Please Enter ${formInput.fomr_builder_field.field_label}`)"
          >
          </el-input>
          <el-input
            v-else-if="formInput.fomr_builder_field.field_type === 'Single Checkbox'"
            :placeholder="__(`Please Enter ${formInput.fomr_builder_field.field_label}`)"
          >
          </el-input>

          <!--<el-checkbox-group
            v-else-if="formInput.fomr_builder_field.field_type === 'Multiple Checkboxes'"
          >
            <el-checkbox
              v-for="(option, index) in JSON.parse(
                formInput.fomr_builder_field.field_options
              )"
              :key="index"
              :label="option.value"
            >
              {{ option.label }}
            </el-checkbox>
          </el-checkbox-group> -->

          <el-checkbox-group
            v-model="sample"
            v-else-if="formInput.fomr_builder_field.field_type === 'Multiple Checkboxes'"
          >
            <el-checkbox
              v-for="option in formInput.fomr_builder_field.field_options"
              :key="option.key"
              :label="option.label"
            ></el-checkbox>
          </el-checkbox-group>

          <el-radio-group
			v-else-if="formInput.fomr_builder_field.field_type === 'Radio Select'"
			v-model="sample">
				<el-radio
				    v-for="option in JSON.parse(formInput.fomr_builder_field.field_options)"
					:key="option.key"
					:label="option.value">
						{{ option.label }}
				</el-radio>
		    </el-radio-group>

            <el-select
				v-else-if="['Dropdown Select', 'Currency'].some(o => o === formInput.fomr_builder_field.field_type)"
		        v-model="sample"
				class="full-width">
					<el-option
				        v-for="option in JSON.parse(formInput.fomr_builder_field.field_options)"
					    :key="option.key"
					    :value="option.value"
						:label="option.label">
					</el-option>
		    </el-select>

            <el-input-number
				v-else-if="['Unformatted Number', 'Formatted Number'].some(o => o === formInput.fomr_builder_field.field_type)"
			    v-model="sample"
				class="full-width">
			</el-input-number>

            <el-upload
				v-else-if="formInput.fomr_builder_field.field_type === 'File'"
				class="upload-demo"
				drag
				action="">
				<i class="el-icon-upload"></i>
				<div class="el-upload__text">Drop file here or <em>click to upload</em></div>
			</el-upload>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import _forEach from "lodash/forEach";
export default {
  name: "FormView",
  props: {
    formTemplate: {
      type: Array,
      required: true,
    },
  },
  data() {
    return {
      sample: "",
      templateData: [],
    };
  },
  created() {
    if (this.formTemplate.length != 0) {
      this.templateData = this.formTemplate;
    }
  },
  methods: {},
  watch: {},
};
</script>
<style lang="scss">
.form-builder-form {
  padding: 5px;
  .form-builder-form-header {
    font-size: 15px;
    color: #6f6f6f;
    font-weight: bold;
    padding: 0;
  }

  .form-builder-form-content {
    display: flex;
    flex-wrap: wrap;

    .form-builder-form-content-input {
      width: 50%;
      font-size: 14px;
      color: #6f6f6f;
    }
  }
}
</style>
