<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyStat extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function record($company_id, $type)
    {
        $date = new \DateTime();
        $company = Company::with(['stats'])->find($company_id);

        if($company)
        {
            try {

                $company->stats()->updateOrCreate([
                    'company_id' => $company_id, 'type' => $type, 'date' => $date->format('Y-m-d')
                ])->increment('hits');

                return true;

            } catch(\Throwable $e) {
                report($e);
            }
        }

        return false;
    }
}
