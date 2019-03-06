<?php

namespace bigpaulie\fractal\Serializer;

use League\Fractal\Serializer\DataArraySerializer;

/**
 * Class ApiSerializer
 * @package bigpaulie\fractal
 */
class ApiSerializer extends DataArraySerializer
{

    /**
     * @param string $resourceKey
     * @param array $data
     * @return array
     */
    public function collection($resourceKey, array $data)
    {
        return [
            'success' => true,
            'data' => $data,
        ];
    }

    /**
     * @param string $resourceKey
     * @param array $data
     * @return array
     */
    public function item($resourceKey, array $data)
    {
        return [
            'success' => true,
            'data' => $data,
        ];
    }

    /**
     * Merges any relations into the data. The 'data' field is also removed.
     *
     * @param  array $transformedData
     * @param  array $includedData
     * @return array
     */
    public function mergeIncludes($transformedData, $includedData)
    {
        $keys = array_keys($includedData);
        foreach ($keys as $key) {
            $includedData[$key] = $includedData[$key]['data'];
        }
        return array_merge($transformedData, $includedData);
    }
}