<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;
use Laravel\Cashier\Billable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use function Illuminate\Events\queueable;
use Stripe\StripeClient;
use Laravel\Cashier\Cashier;

class User extends Authenticatable
{
    use Billable;
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::updated(queueable(function (User $customer) {
            if ($customer->hasStripeId()) {
                $customer->syncStripeCustomerDetails();
            }
        }));
    }

    public function isAdmin(): bool
    {
        return $this->id === 1;
    }

    public function findStripeCustomerByEmail($email)
    {
        $stripe = new StripeClient(config('cashier.secret'));

        try {
            $customers = $stripe->customers->search([
                'query' => "email:'{$email}'",
                'limit' => 1,
            ]);

            if (!empty($customers->data)) {
                return $customers->data[0];
            }
        } catch (\Exception $e) {
            // Handle any errors
            Log::error('Stripe API error: ' . $e->getMessage());
        }

        return null;
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'enrollments')->withTimestamp('enrolled_at');
    }

    public function completedLessons()
    {
        return $this->belongsToMany(Lesson::class, 'lesson_completions')->withTimestamp('completed_at');
    }
}
