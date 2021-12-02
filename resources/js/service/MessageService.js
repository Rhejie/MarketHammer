import Vue from 'vue'
import trans from '../mixins/trans'

const t = trans.methods
export default class MessageService{

	constructor(){
		this.notif = {
			success_add : t.__('Record has been successfully added.'),
			success_update : t.__('Record has been successfully updated.'),
			success_delete : t.__('Record has been successfully deleted.'),
			success_save : t.__('Record has been successfully saved.'),
			success_remove : t.__('Record has been successfully removed.'),

			failed_add : t.__('Failed to create new record.'),
			failed_update : t.__('Failed to update record.'),
			failed_delete : t.__('Failed to delete record.'),

			confirm_delete : t.__('Are you sure you want to delete selected record?'),

			service_error : t.__("An error occured. Please report this to your administrator.")
		}
	}

}
