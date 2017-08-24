<?php
/**
 * User: Zhanybek Seitaliev
 * Email: zhandev312@gmail.com
 * Date: 23.08.17
 * Time: 23:22
 */

namespace App\Http\Controllers\Auth;

use App\Helpers\Shopify\Shopify;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function install( Request $request ) {

        $redirect_uri = $request->header('host') . "/cross-selling/auth/callback";

        return redirect(
            Shopify::generateInstallUrl(
                $request->shop,
                env('API_KEY'),
                env('SCOPES'),
                $redirect_uri
            )
        );

    }

    public function auth( Request $request ) {

        $mysShopifyDomain = $request->shop;
        $code = $request->code;

        $shopify = Shopify::auth(
            $mysShopifyDomain,
            $code,
            env('API_KEY'),
            env('SECRET_KEY')
        );

        $shopData = $shopify->get('shop');

    }

}