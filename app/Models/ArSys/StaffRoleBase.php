<?php

namespace App\Models\ArSys;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffRoleBase extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = [];
    protected $table = 'arsys_staff_role_base';
}
