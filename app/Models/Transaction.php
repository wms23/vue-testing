<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Transaction extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $guarded = ['id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'business_id',
        'account_id',
        'account_type_id',
        'transaction_type',
        'amount',
        'description'
    ];

    /**
     * @return mixed
     */
    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    /**
     * @return mixed
     */
    public function accountType()
    {
        return $this->belongsTo(AccountType::class);
    }

    /**
     * @return mixed
     */
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
