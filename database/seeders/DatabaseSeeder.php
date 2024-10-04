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

        $user2 = User::factory()->create([
            'name' => 'Ese Dimi',
            'email' => 'esedimi@gmail.com',
            'password' => Hash::make('ptj5knm_beu1krf!YVW'),
        ]);

        $stripeCustomer = $user->first()->findStripeCustomerByEmail($user->getAttribute('email'));
        $stripeCustomer2 = $user2->first()->findStripeCustomerByEmail($user2->getAttribute('email'));

        if (!$stripeCustomer){
            $user->createAsStripeCustomer([
                'email' => $user->getAttribute('email'),
                'name' => $user->getAttribute('name'),
            ]);
        } else {
            $user->stripe_id = $stripeCustomer->id;
            $user->save();
        }

        if (!$stripeCustomer2){
            $user2->createAsStripeCustomer([
                'email' => $user2->getAttribute('email'),
                'name' => $user2->getAttribute('name'),
            ]);
        } else {
            $user2->stripe_id = $stripeCustomer2->id;
            $user2->save();
        }

        User::factory(10)->create();

        $this->call([
            CourseSeeder::class,
        ]);
    }
}
