<?php
/**
 * User: Zhanybek Seitaliev
 * Email: zhandev312@gmail.com
 * Date: 23.08.17
 * Time: 23:49
 */

namespace App\Helpers;

class Shopify
{

    /**
     * @param string $myShopifyDomain
     * @param string $apiKey
     * @param string $scopes
     * @param string $redirectUrl
     * @return string
     */
    public static function generateInstallUrl(
        string $myShopifyDomain,
        string $apiKey,
        string $scopes,
        string $redirectUrl
    ) {

        return "https://$myShopifyDomain/admin/oauth/authorize?client_id=$apiKey&scope=$scopes&redirect_uri=https://$redirectUrl&state={nonce}";


    }
}