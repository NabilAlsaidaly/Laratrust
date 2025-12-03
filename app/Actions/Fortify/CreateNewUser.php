<?php

namespace App\Actions\Fortify;

use App\Models\company;
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
        // تحقق من صحة البيانات المدخلة
        $validator = Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'phone' => ['required', 'regex:/\d{10,14}/'],
            'account_type' => ['required', 'string', 'in:customer,company'],
            'company_name' => ['nullable', 'required_if:account_type,company', 'string', 'max:255'],
            'website' => ['nullable', 'required_if:account_type,company', 'string', 'max:255'],
            'company_phone' => ['nullable', 'required_if:account_type,company', 'string', 'max:255'],
            'location' => ['nullable', 'required_if:account_type,company', 'string', 'max:255'],
            'comm_id' => ['nullable', 'required_if:account_type,company', 'integer'],
            'combank_id' => ['nullable', 'required_if:account_type,company', 'integer'],
        ]);

        if ($validator->fails()) {
            throw new \Illuminate\Validation\ValidationException($validator);
        }

        // إنشاء سجل المستخدم
        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'phone' => $input['phone'],
            'usertype' => $input['account_type'] === 'company' ? 'company' : 'user',
        ]);
        if ($user->wasRecentlyCreated && $input['account_type'] === 'company') {
            $company = new Company;
            $company->name = $input['company_name'];
            $company->website = $input['website'];
            $company->phone = $input['company_phone'];
            $company->location = $input['location'];
            $company->comm_id = $input['comm_id'];
            $company->combank_id = $input['combank_id'];
            $company->user_id = $user->id;
            $company->save();
        }

        return $user;
    }
}

