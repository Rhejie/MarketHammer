import { matrixOptions } from './matrix-options'

/**
 * List of field types. If you want to add additional field type, just add it here.
 * If you update this list make sure to also update the \App\Repositories\FormField\FormFieldReporitory::getFieldTypeList() method
 * and vice versa so they will contain consistent data.
 * 
 * @return fieldTypeList <array>
 * 
 * @author Chaps
 */
export const fieldTypeList = [
	{
        id: 1,
        label: 'Single Text',
        value: 'Single Text',
        type: 'single',
        value_type: 'single',
        separate: false,
        disabled: false
    },
    {
        id: 2,
        label: 'Multiline Text',
        value: 'Multiline Text',
        type: 'single',
        value_type: 'single',
        separate: false,
        disabled: false
    },
    {
        id: 3,
        label: 'Single Checkbox',
        value: 'Single Checkbox',
        type: 'single',
        value_type: 'single',
        separate: true,
        disabled: false
    },
    {
        id: 4,
        label: 'Multiple Checkboxes',
        value: 'Multiple Checkboxes',
        type: 'option',
        value_type: 'multiple',
        separate: true,
        disabled: false
    },
    {
        id: 5,
        label: 'Radio Select',
        value: 'Radio Select',
        type: 'option',
        value_type: 'single',
        separate: true,
        disabled: false
    },
    {
        id: 6,
        label: 'Dropdown Select',
        value: 'Dropdown Select',
        type: 'option',
        value_type: 'single',
        separate: true,
        disabled: false
    },
    {
        id: 7,
        label: 'Number',
        options: [
            {
                id: 8,
                label: 'Formatted Number',
                value: 'Formatted Number',
                type: 'single',
                value_type: 'single',
                separate: false,
                disabled: false
            },
            {
                id: 9,
                label: 'Unformatted Number',
                value: 'Unformatted Number',
                type: 'single',
                value_type: 'single',
                separate: false,
                disabled: false
            },
            {
                id: 10,
                label: 'Currency',
                value: 'Currency',
                type: 'option',
                value_type: 'single',
                separate: false,
                disabled: false
            },
        ]
    },
    {
        id: 11,
        label: 'File',
        value: 'File',
        type: 'single',
        value_type: 'multiple',
        separate: true,
        disabled: false
    },
    {
        id: 12,
        label: 'Matrix',
        value: 'Matrix',
        type: 'matrix',
        value_type: 'matrix',
        separate: true,
        option_reference: matrixOptions,
        disabled: false
    },
    {
        id: 13,
        label: 'Instruction',
        value: 'Instruction',
        type: 'single',
        value_type: 'single',
        separate: false,
        disabled: true
    },
]
