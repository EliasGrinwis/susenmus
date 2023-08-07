<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        // Generate a random customer number
        $input['customer_number'] = $this->generateUniqueCustomerNumber();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'customer_number' => $input['customer_number'], // Assign the generated customer number
        ]);
    }

    protected function generateUniqueCustomerNumber(): int
    {
        do {
            $customerNumber = $this->generateCustomerNumber();
        } while (User::where('customer_number', $customerNumber)->exists());

        return $customerNumber;
    }

    protected function generateCustomerNumber(): int
    {
        // You can modify this function to generate the number as per your requirements.
        return mt_rand(100000, 999999);
    }
}
