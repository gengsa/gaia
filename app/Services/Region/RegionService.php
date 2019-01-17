<?php
namespace Gaia\Services\Region;

use Gaia\Models\Country;

class RegionService implements RegionServiceInterface {

    /**
     * 
     * {@inheritDoc}
     * @see \Gaia\Services\Region\RegionServiceInterface::getCountryList()
     */
    public function getCountryList(array $columns = ['id', 'local_name'], $enable = true, $orderBy = 'local_name ASC')
    {
        $query = getQuery(Country::class);
        if ($enable !== null) {
            $query->where('enable', $enable);
        }
        if ($orderBy !== null) {
            $query->orderByRaw($orderBy);
        }
        return $query->get($columns);
    }
}