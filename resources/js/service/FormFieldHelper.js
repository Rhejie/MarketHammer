import _forEach from 'lodash/forEach'
import { fieldTypeList } from '../constants/field-type-list'

export default class FormFieldHelper { 

	getPropertyFieldType(property_field, key = 'type') {

      let findField = fieldTypeList.find(fn => fn.value == property_field)
        if(findField){
        	if(findField['options'] !== undefined) {
        		let findSubField = findField['options'].find(fn =>fn.value == property_field)
                if(findSubField){
                	return findSubField[key]
                }
            }
            
            return findField[key]
        }
        return null
    }
}