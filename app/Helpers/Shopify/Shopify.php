<?php
/**
 * User: Zhanybek Seitaliev
 * Email: zhandev312@gmail.com
 * Date: 23.08.17
 * Time: 23:49
 */

namespace App\Helpers\Shopify;

use GuzzleHttp\Client;
use Illuminate\Support\Collection;

class Shopify
{

    protected $myShopifyDomain, $token;

    protected $baseUrl = '/admin/';

    private function __construct(
        string $myShopifyDomain,
        string $token
    ) {

        $this->myShopifyDomain = $myShopifyDomain;
        $this->token = $token;

    }

    /**
     * Generate installing url
     *
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

    public static function auth(

        string $myShopifyDomain,
        string $code,
        string $apiKey,
        string $secretKey

    ): Shopify {

        $client = new Client();

        $response = $client->request(
            'POST',
            "https://" .
            $myShopifyDomain .
            "/admin/oauth/access_token",
            ['query' => [
                'client_id' => $apiKey,
                'client_secret' => $secretKey,
                'code' => $code
            ]]);

        $accessToken = json_decode($response->getBody(),true)['access_token'];


        return new static($myShopifyDomain, $accessToken);

    }

    /**
     * Get new instance
     *
     * @param string $myShopifyDomain
     * @param string $token
     * @return static
     */
    public static function getInstance(

        string $myShopifyDomain,
        string $token

    ): Shopify {

        return new static($myShopifyDomain, $token);

    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken(): string {

        return $this->token;

    }

    public function get(string $resourceName, array $attr = null):Collection {

        $client = new Client();

        $attr = $attr ? http_build_query($attr) : '';

        $resource = $this->baseUrl . $resourceName . '.json';

        $response = $client->request('GET', "https://" . $this->myShopifyDomain . $resource . '?' . $attr, ['headers' => [
            'X-Shopify-Access-Token' => $this->token,
            'X-Frame-Options' => 'allow'
        ]]);

        $collections = collect(
            json_decode(
                $response->getBody()->getContents(), true)[$resourceName]
        );

        return $collections;

    }
}