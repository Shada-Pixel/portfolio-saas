<?php

namespace App\Repositories;

use App\Models\PlanCurrency;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PlanCurrencyRepository
 */
class PlanCurrencyRepository extends BaseRepository
{
    /**
     * @var string[] 
     */
    private $fieldSearchable = [
      'currency_name',
      'currency_code',
      'currency_icon'
    ];

    /**
     * @return array|string[]
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * @return string
     */
    public function model()
    {
        return PlanCurrency::class;
    }

    /**
     * @param $input
     *
     * @return mixed
     */
    public function store($input)
    {
        $planCurrency = PlanCurrency::create($input);
        
        return $planCurrency;
    }

    /**
     * @param  array  $input
     *
     * @param $planCurrency
     * 
     * @return int
     */
    public function update($input, $planCurrency)
    {
        $planCurrency->update($input);
        
        return $planCurrency;
    }
}
