/**
 * List of option references. Feel free to add additional option reference here. 
 * If you update this list make sure to also update the \App\Repositories\FormField\FormFieldReporitory::getOptionReferences() method
 * and vice versa so they will contain consistent data. 
 * Note: Also update App\Repositories\FormField\FormFieldReporitory::optionFromDatabase() method to setup fetch function for options list
 * 
 * @return matrixOptions
 * 
 * @author Chaps
 */
export const optionReferences = [
	{
	    id: 1,
	    label: 'Define',
	    value: null
	},
	{
	    id: 2,
	    label: 'Business Category',
	    value: 'business_category'
	},
	{
	    id: 3,
	    label: 'Contact Role',
	    value: 'contact_role'
	},
	{
	    id: 4,
	    label: 'Countries',
	    value: 'country'
	},
	{
	    id: 5,
	    label: 'States',
	    value: 'state'
	},
	{
	    id: 6,
	    label: 'Number of Employees',
	    value: 'employee_count'
	},
]