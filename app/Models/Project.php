<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable=['project_name','country','company_name','waqala_visa_number','profession','ref_no','initiate_date','status'];
}