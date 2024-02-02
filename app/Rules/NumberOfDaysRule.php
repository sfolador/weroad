<?php

namespace App\Rules;

use App\Models\Travel;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class NumberOfDaysRule implements DataAwareRule, ValidationRule
{
    /**
     * All of the data under validation.
     *
     * @var array<string,mixed>
     */
    protected array $data = [];

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $startDate = $this->data['startingDate'] ?? null;
        if (! $startDate) {
            $fail('The starting date is required.');

            return;
        }
        $travelUuid = $this->data['travel'] ?? null;
        if (! $travelUuid) {
            $fail('The travel is required.');

            return;
        }

        $travel = Travel::find($travelUuid);
        if (! $travel) {
            $fail('The travel is invalid.');

            return;
        }

        $starDate = Carbon::parse($startDate);
        $endDate = Carbon::parse($value);
        $calculatedDiffInDays = $starDate->diffInDays($endDate);
        $numberOfDaysFromTravel = $travel->numberOfDays;

        if ($calculatedDiffInDays !== $numberOfDaysFromTravel) {
            $fail("The number of days must be equal to the number of days from the travel ($numberOfDaysFromTravel).");
        }

    }

    public function setData(array $data): void
    {
        $this->data = $data;
    }
}
