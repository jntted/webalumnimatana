<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;
    
<<<<<<< HEAD
    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $keyType = 'bigint';
    
    // TAMBAHKAN INI: Karena nama tabel di database adalah 'alumni' (tunggal)
    protected $table = 'alumni';
=======
    // TAMBAHKAN INI: Karena nama tabel di database adalah 'alumni' (tunggal)
    protected $table = 'alumni';
    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $keyType = 'bigint';
>>>>>>> 62dc70436d02a99397b71efb2127efecf0548a37
    
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
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
<<<<<<< HEAD
=======
}
>>>>>>> 62dc70436d02a99397b71efb2127efecf0548a37

    public function tracerStudy()
    {
        return $this->hasOne(TracerStudy::class, 'alumni_id', 'user_id');
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 62dc70436d02a99397b71efb2127efecf0548a37
