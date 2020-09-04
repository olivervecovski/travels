<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Activity
 *
 * @property int $id
 * @property string $name
 * @property string $latitude
 * @property string $longitude
 * @property string $description
 * @property int $activitable_id
 * @property string $activitable_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $activitable
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $images
 * @property-read int|null $images_count
 * @method static \Illuminate\Database\Eloquent\Builder|Activity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity query()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereActivitableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereActivitableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereUpdatedAt($value)
 */
	class Activity extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Destination
 *
 * @property int $id
 * @property string $longitude
 * @property string $latitude
 * @property string $description
 * @property string $start_date
 * @property string $end_date
 * @property int $trip_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $country
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $images
 * @property-read int|null $images_count
 * @property-read \App\Models\Trip $trip
 * @method static \Illuminate\Database\Eloquent\Builder|Destination newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Destination newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Destination query()
 * @method static \Illuminate\Database\Eloquent\Builder|Destination whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Destination whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Destination whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Destination whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Destination whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Destination whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Destination whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Destination whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Destination whereTripId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Destination whereUpdatedAt($value)
 */
	class Destination extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Image
 *
 * @property int $id
 * @property string $image_url
 * @property string $imageable_type
 * @property int $imageable_id
 * @property string $description
 * @property string $size
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $imageable
 * @method static \Illuminate\Database\Eloquent\Builder|Image newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image query()
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereImageableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereImageableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereUpdatedAt($value)
 */
	class Image extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Social_Account
 *
 * @property int $id
 * @property int $user_id
 * @property string $provider_user_id
 * @property string $provider
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Social_Account newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Social_Account newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Social_Account query()
 * @method static \Illuminate\Database\Eloquent\Builder|Social_Account whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Social_Account whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Social_Account whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Social_Account whereProviderUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Social_Account whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Social_Account whereUserId($value)
 */
	class Social_Account extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Trip
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string $start_date
 * @property string|null $end_date
 * @property int $user_id
 * @property int $private
 * @property string|null $image_url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Destination[] $destinations
 * @property-read int|null $destinations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $images
 * @property-read int|null $images_count
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Trip newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Trip newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Trip query()
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip wherePrivate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereUserId($value)
 */
	class Trip extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read int|null $clients_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Social_Account[] $social_accounts
 * @property-read int|null $social_accounts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @property-read int|null $tokens_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Trip[] $trips
 * @property-read int|null $trips_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent implements \Illuminate\Contracts\Auth\MustVerifyEmail {}
}

