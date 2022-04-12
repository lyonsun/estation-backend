<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Company extends Model {
    use HasFactory;

    protected $table = 'companies';
    protected $fillable = ['name', 'parent_company_id'];

    public function parent() {
        return $this->belongsTo(Company::class, 'parent_company_id');
    }

    public function children() {
        return $this->hasMany(Company::class, 'parent_company_id');
    }

    public function getAllDescendants() {
        $companies = new Collection();

        foreach ($this->children as $company) {
            $companies->push($company);
            $companies = $companies->merge($company->getAllDescendants());
        }

        return $companies;
    }
}
