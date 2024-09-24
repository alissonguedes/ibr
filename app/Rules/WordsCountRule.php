<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class WordsCountRule implements ValidationRule
{

	private $max_words;

	/**
	 * Create a new rule instance.
	 *
	 * @return void
	 */
	public function __construct($max_words = 500)
	{
		$this->max_words = $max_words;
	}

	/**
	 * Run the validation rule.
	 *
	 * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
	 */
	public function validate(string $attribute, mixed $value, Closure $fail): void
	{

		// $value = replace(strip_tags($value));
		$value = replace(html_entity_decode(strip_tags($value)), ' ');

		if (count(explode(' ', $value)) >= $this->max_words) {
			// $fail('The :attribute must be menor que ' . $this->max_words);
			$fail('O campo :attribute não pode conter mais que ' . ($this->max_words) . ' palavra' . ($this->max_words > 1 ? 's' : null));
		}

	}

	/**
	 * Determine if the validation rule passes.
	 *
	 * @param  string  $attribute
	 * @param  mixed  $value
	 * @return bool
	 */
	public function passes($attribute, $value)
	{

		// dump(str_word_count($value));
		// return str_word_count($value) <= $this->max_words;

	}

	/**
	 * Get the validation error message.
	 *
	 * @return string
	 */
	public function message()
	{
		return 'The :attribute cannot be longer than :s words.';
	}

}
