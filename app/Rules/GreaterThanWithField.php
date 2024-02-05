<?php

namespace App\Rules;

use App\Models\Travel;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class GreaterThanWithField implements DataAwareRule, ValidationRule
{
    /**
     * All of the data under validation.
     *
     * @var array<string,mixed>
     */
    protected array $data = [];



    public function __construct(protected string $otherField)
    {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $startDate = $this->data[$this->otherField] ?? null;

        if (is_null($startDate)) {
            /**
             * @phpstan-ignore-next-line
             */
            $endDate = Carbon::parse($value);

            if ($endDate->isPast()) {
                $fail("The $attribute must be a date in the future.");
            }
            return;
        }

        /**
         * @phpstan-ignore-next-line
         */
        $starDate = Carbon::parse($startDate);
        /**
         * @phpstan-ignore-next-line
         */
        $endDate = Carbon::parse($value);


        if ($endDate->isBefore($starDate)) {
            $fail("The $attribute must be greater than the $this->otherField.");
        }


    }

    /**
     * Set the data under validation.
     *
     * @param  array<string,mixed>  $data
     * @return $this
     */
    public function setData(array $data): static
    {
        $this->data = $data;
        return $this;
    }
}
