<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property string $correct_sentence
 * @property string|null $comment
 * @property int $exercise_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Exercise $exercise
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Correction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Correction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Correction query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Correction whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Correction whereCorrectSentence($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Correction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Correction whereExerciseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Correction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Correction whereUpdatedAt($value)
 */
	class Correction extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $sentence
 * @property string $translation
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Correction> $corrections
 * @property-read int|null $corrections_count
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\ExerciseFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exercise newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exercise newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exercise query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exercise whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exercise whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exercise whereSentence($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exercise whereTranslation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exercise whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exercise whereUserId($value)
 */
	class Exercise extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Exercise> $exercises
 * @property-read int|null $exercises_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Word> $words
 * @property-read int|null $words_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $word
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property string|null $last_used_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Word newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Word newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Word query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Word whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Word whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Word whereLastUsedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Word whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Word whereWord($value)
 */
	class Word extends \Eloquent {}
}

