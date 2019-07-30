<?php

namespace App\Http\Controllers\Api;

use Themsaid\Forge\Forge;
use Illuminate\Http\Request;
use App\Models\PageForgeLink;

class PageForgeLinkController extends Controller
{
    /**
     * @var Forge
     */
    private $api;

    /**
     * @param Forge $api
     */
    public function __construct(Forge $api)
    {
        $this->api = $api;
    }

    /**
     * @return Redirect
     */
    public function deploy(Request $request, PageForgeLink $link)
    {
        $site = $this->api->site($link->server_id, $link->site_id);

        $this->api->deploySite($link->server_id, $link->site_id, true);

        return response()->json(['success' => true]);
    }
}
