<?php
/**
 * Part of the Easyrec package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the 3-clause BSD License.
 *
 * This source file is subject to the 3-clause BSD License that is
 * bundled with this package in the LICENSE file.
 *
 * @package    Easyrec
 * @version    0.0.1
 * @author     VerdeIT
 * @license    BSD License (3-clause)
 * @copyright  (c) 2017-2017, VerdeIT
 * @link       https://github.com/hafael/easyrec
 */

namespace Hafael\Easyrec;


class Utility
{

    /**
     * Returns true if an endpoint list items
     * @param $endpoint
     * @return bool
     */
    public static function doesEndpointListItems($endpoint)
    {
        return in_array($endpoint, [ 'otherusersalsoviewed',
            'otherusersalsobought',
            'itemsratedgoodbyotherusers',
            'recommendationsforuser',
            'mostvieweditems',
            'mostboughtitems',
            'mostrateditems',
            'bestrateditems',
            'worstrateditems',
            'actionhistoryforuser',
        ]);
    }

    /**
     * Encode the given parameters.
     *
     * @param  array  $parameters
     * @return array
     */
    public static function transformArrayIntoHttpQuery(array $parameters)
    {

        //Transforms the value of boolean parameters to string
        $parameters = array_map(function ($parameter) {
            return is_bool($parameter) ? ($parameter === true ? 'true' : 'false') : $parameter;
        }, $parameters);


        return preg_replace('/\%5B\d+\%5D/', '%5B%5D', http_build_query($parameters));
    }


}