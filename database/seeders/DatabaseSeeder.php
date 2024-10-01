<?php

namespace Database\Seeders;

use App\Models\User;
use Laravel\Jetstream\Jetstream;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Laravel\Cashier\Cashier;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Create a user
        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
        ]);

        $stripeCustomer = $user->findStripeCustomerByEmail($user->email);

        if (!$stripeCustomer){
            $user->createAsStripeCustomer([
                'email' => $user->email,
                'name' => $user->name,
            ]);
        } else {
            $user->stripe_id = $stripeCustomer->id;
            $user->save();
        }

        User::factory(10)->create();

        $this->call([
            CourseSeeder::class,
        ]);
    }
}
