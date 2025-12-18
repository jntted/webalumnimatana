<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;
    
    // Karena nama tabel di database adalah 'alumni' (tunggal)
    protected $table = 'alumni';
    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $keyType = 'bigint';
    public $timestamps = false; // Alumni table doesn't have created_at/updated_at
    
    protected $fillable = [
        'user_id',
        'nim',
        'graduation_year',
        'major',
        'current_job',
        'company_name',
        'job_position',
        'salary_range',
        'linkedin_profile',
        'phone',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tracerStudy()
    {
        return $this->hasOne(TracerStudy::class, 'alumni_id', 'user_id');
    }
}

