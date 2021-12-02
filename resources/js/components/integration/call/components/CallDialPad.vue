<template>
	<div class="dial_pad_container">
		<slot name="action"></slot>

		<el-input 
			v-if="showInputField"
			v-model="dialedNum" 
			class="wit_input_default"
			@change="inputNumChanged"
			@keyup.enter.native="inputNumChanged"
			:placeholder="placeholder">
		</el-input>

		<div class="dial_pad_inner">
			<el-row :gutter='20' class="dial_row">
				<el-col :span='8' align="center">
					<div class="dial_item" @click="dialNum('1')">
						<div class="number">1</div>
						<div class="letter"></div>
					</div>
				</el-col>

				<el-col :span='8' align="center">
					<div class="dial_item" @click="dialNum('2')">
						<div class="number">2</div>
						<div class="letter">ABC</div>
					</div>
				</el-col>

				<el-col :span='8' align="center">
					<div class="dial_item" @click="dialNum('3')">
						<div class="number">3</div>
						<div class="letter">DEF</div>
					</div>
				</el-col>
			</el-row>

			<el-row :gutter='20' class="dial_row">
				<el-col :span='8' align="center">
					<div class="dial_item" @click="dialNum('4')">
						<div class="number">4</div>
						<div class="letter">GHI</div>
					</div>
				</el-col>

				<el-col :span='8' align="center">
					<div class="dial_item" @click="dialNum('5')">
						<div class="number">5</div>
						<div class="letter">JKL</div>
					</div>
				</el-col>

				<el-col :span='8' align="center">
					<div class="dial_item" @click="dialNum('6')">
						<div class="number">6</div>
						<div class="letter">MNO</div>
					</div>
				</el-col>
			</el-row>

			<el-row :gutter='20' class="dial_row">
				<el-col :span='8' align="center">
					<div class="dial_item" @click="dialNum('7')">
						<div class="number">7</div>
						<div class="letter">PQRS</div>
					</div>
				</el-col>

				<el-col :span='8' align="center">
					<div class="dial_item" @click="dialNum('8')">
						<div class="number">8</div>
						<div class="letter">TUV</div>
					</div>
				</el-col>

				<el-col :span='8' align="center">
					<div class="dial_item" @click="dialNum('9')">
						<div class="number">9</div>
						<div class="letter">WXYZ</div>
					</div>
				</el-col>
			</el-row>

			<el-row :gutter='20' class="dial_row">
				<el-col :offset="8" :span='8' align="center">
					<div class="dial_item" @click="dialNum('0')">
						<div class="number">0</div>
					</div>
				</el-col>

				<el-col :span='8' align="center" @click="clearNum">
					<div class="dial_item" @click="clearNum">
						<div class="action"><i class="fas fa-times"></i></div>
					</div>
				</el-col>
			</el-row>
		</div>
	</div>
</template>

<script>

import cloneDeep from 'lodash/cloneDeep'

export default {

  	name: 'CallDialPad',

  	props: {
		value : {default: ""},
		placeholder : {default: null},
		showInputField : {default : true}
		//enableCall: {default: false}
	},

  	data () {
    	return {
    		dialedNum: this.value,
    	}
  	},

  	watch: {
  		value(newVal, oldval){
  			this.dialedNum = newVal
  		}
  	},

  	methods: {
  		dialNum(num){
  			if(!this.dialedNum) this.dialedNum = ''

  			this.dialedNum+=num
  			this.$emit('input', this.dialedNum)
  			this.$emit("change", this.dialedNum);
  		},
  		clearNum(){
  			this.dialedNum = ""
  			this.$emit('input', this.dialedNum)
  			this.$emit("change", this.dialedNum);
  		},
  		inputNumChanged(){
  			let inputValue = this.$sf.formatPhoneNumber(this.dialedNum)
  			this.dialedNum = inputValue
  			this.dialOk()
  		},
  		dialOk(){
  			this.$emit("dial-complete", this.dialedNum);
  		},
  	}
}
</script>
