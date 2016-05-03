<?php namespace jlourenco\comments\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use jlourenco\support\Traits\Creation;
use Sentinel;

class Comment extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Comment';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['comment'];

    /**
     * To allow soft deletes
     */
    use SoftDeletes;

    use Creation;

    /**
     * The User model name.
     *
     * @var string
     */
    protected static $usersModel = 'jlourenco\base\Models\BaseUser';

    /**
     * Returns the user model.
     *
     * @return string
     */
    public static function getUsersModel()
    {
        return static::$usersModel;
    }

    /**
     * Sets the user model.
     *
     * @param  string  $usersModel
     * @return void
     */
    public static function setUsersModel($usersModel)
    {
        static::$usersModel = $usersModel;
    }

    public function writter()
    {
        return $this->hasOne(static::$usersModel, 'id', 'created_by');
    }

    /**
     * Get all of the owning entity models.
     */
    public function entity()
    {
        return $this->morphTo();
    }

    /**
     * Get the user's first name.
     *
     * @param  string  $value
     * @return string
     */
    public function getCreatedByAttribute($value)
    {
        if ($value > 0)
            if ($user = Sentinel::findUserById($value))
                if ($user != null)
                    return $user;

        return $value;
    }

}
