<?php
	/****************************************
	* Methods registered here are global.
	* Make sure to prefix the method with __,
	* just to make sure we avoid conflict.
	*/

	function __get_messages(array $replacements = [])
	{
		return [
			'validation' => [
				'required' => __('messages.This field is required.'),
				'integer' => __('messages.Field should be an integer.'),
				'string' => __('messages.Field should be a string.'),
				'date' => __('messages.Field should be a date.'),
				'in' => __('messages.Invalid data.'),
				'after_or_equal' => __('messages.Field should be after or equal.', $replacements),
				'before_or_equal' => __('messages.Field should be before or equal.', $replacements),
				'email' => __('messages.Invalid email.'),
				'unique' => __('messages.Field should be unique.')
			]

		];
	}
