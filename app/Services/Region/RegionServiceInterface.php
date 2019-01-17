<?php
namespace Gaia\Services\Region;

interface RegionServiceInterface
{
    /**
     *
     * @param array $columns
     * @param bool|null $enable
     * @param string|null $orderBy
     * @return \Gaia\Models\Country[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getCountryList(array $columns = ['id', 'local_name'], $enable = true, $orderBy = null);
}