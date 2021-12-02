/**
 * List of matrix options. Feel free to add additional matrix options here. 
 * If you update this list make sure to also update the \App\Repositories\FormField\FormFieldReporitory::getMatrixOptions() method
 * and vice versa so they will contain consistent data.
 * 
 * @return matrixOptions
 * 
 * @author Chaps
 */
export const matrixOptions = [
	{
        id: 0,
        label: 'Define',
        value: null,
        columns: [],
    },
    {
        id: 1,
        label: 'Business Contact',
        value: 'business_contact',
        columns: [
            {
                label: 'Title',
                value: 'title',
                type: 'Single Text',
            },
            {
                label: 'Name',
                value: 'name',
                type: 'Single Text',
            },
            /*{
                label: 'Role',
                value: 'role_id',
                type: 'Dropdown Select',
                type_option: {source_table: 'contact_role', field_options: {]]
            },*/
            {
                label: 'Email',
                value: 'email',
                type: 'Single Text',
            },
            {
                label: 'Phone',
                value: 'phone',
                type: 'Single Text'
            }
        ]
    },
    {
        id: 2,
        label: 'Business Revenue',
        value: 'business_finances',
        columns: [
            {
                label: 'Year',
                value: 'year',
                type: 'Unformatted Number',
            },
            {
                label: 'Revenue',
                value: 'revenue',
                type: 'Formatted Number',
            },
            {
                label: 'Ebit',
                value: 'ebit',
                type: 'Formatted Number',
            }
        ]
    },
    {
        id: 3,
        label: 'Business Partners',
        value: 'business_partner',
        columns: [
            {
                label: 'Company Name',
                value: 'company_name',
                type: 'Single Text',
            },
            {
                label: 'Type',
                value: 'type',
                type: 'Single Text',
            },
            {
                label: 'Website',
                value: 'website',
                type: 'Single Text',
            },
            {
                label: 'Contact Person',
                value: 'contact_person',
                type: 'Single Text',
            },
            {
                label: 'Contact Email',
                value: 'contact_email',
                type: 'Single Text',
            },
            {
                label: 'Contact Phone',
                value: 'contact_phone',
                type: 'Single Text',
            }
        ]
    },
]