<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $fillable = [
        'project_id',
        'name',
        'pp_no',
        'phone_no',
        'interview_date_from',
        'age',
        'agent_id',
        'status',
        'category',
        'medical',
        'takamul',
        'pc',
        'dl',
        'final_status_id',
        'company_id',
        's_entry',
        'entry_date',
        'pic',
        'tasheer',
        'entry_final_status',
        'mofa_date',
        'mofa_status',
        'comments',
        'f_company_id',
        'sent_for_mofa_agency',
        'occupation',
        'visa_inport',
        'status_in_visa_section',
        'embassy_handover',
        'stamping',
        'training',
        'finger',
        'man_p',
        'f_date_from',
        'exp_date',
        'fit_card',
        'hand_over_to_visa_section',
        'delivery',
        'delivery_date'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    public function agency()
    {
        return $this->belongsTo(Agency::class,'agent_id');
    }
    public function category_info()
    {
        return $this->belongsTo(Category::class,'category','id');
    }
    public function final_status()
    {
        return $this->belongsTo(FinalStatus::class,'final_status_id');
    }
    public function entry_final_status()
    {
        return $this->belongsTo(FinalStatus::class,'entry_final_status');
    }
    public function company()
    {
        return $this->belongsTo(Company::class,'company_id');
    }
    public function fcompany()
    {
        return $this->belongsTo(Company::class,'f_company_id');
    }
}
