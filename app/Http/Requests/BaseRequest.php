<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{
	/**
	 * Build validation rules from the given columns 
	 *
	 * @param $columns <array> - the columns that are to be validated
	 * @param $validation <string> - the type of validation to apply to the colunns
	 * @param $replacements <array> - used for translations
	 *
	 * @return <array>
	 */
	protected function buildMessages(array $columns, string $validation, array $replacements = [])
	{
		$validationMessages = [];

		$messages = __get_messages($replacements)['validation'];

		foreach ($columns as $col) {
			$validationMessages["$col.$validation"] = $messages[$validation];
		}

		return $validationMessages;
	}

	/**
	 * Build default validation for the given validation.
	 *
  	 * @param $validations <array> - default validation
  	 *
  	 * @return <array>
	 */
	protected function getDefault(array $validations = [])
	{
		$messages = __get_messages()['validation'];

		$validationMessages = [];

		if ($validations) {
			foreach ($validations as $validation) {
				$validationMessages[$validation] = $messages[$validation];
			}

			return $validationMessages;
		}

		return [
			'required' => $messages['required'],
			'integer' => $messages['integer'],
			'string' => $messages['string'],
			'date' => $messages['date'],
			'in' => $messages['in']
		];
	}
}