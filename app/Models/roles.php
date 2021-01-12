<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class roles
 * @package App\Models
 * @version December 14, 2020, 6:32 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $userRoles
 * @property string $name
 * @property boolean $is_admin
 * @property boolean $is_superadmin
 */
class roles extends Model
{

    public $table = 'role';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';




    public $fillable = [
        'name',
        'is_admin',
        'is_superadmin'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        'name' => 'string',
        'is_admin' => 'boolean',
        'is_superadmin' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'nullable|string|max:64',
        'is_admin' => 'nullable|boolean',
        'is_superadmin' => 'nullable|boolean'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function userRoles()
    {
        return $this->hasMany(\App\Models\UserRole::class, 'role_id');
    }
}
