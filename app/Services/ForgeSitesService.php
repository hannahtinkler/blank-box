<?php

namespace App\Services;

use Cache;
use Exception;
use Carbon\Carbon;
use App\Models\Page;
use Themsaid\Forge\Forge;
use InvalidArgumentException;
use App\Models\PageForgeLink;

class ForgeSitesService
{
    /**
     * @var Forge
     */
    public $api;

    /**
     * @param Forge $api
     */
    public function __construct(Forge $api)
    {
        $this->api = $api;
    }

    /**
     * @return array
     */
    public function getForPage(Page $page)
    {
        try {
            $sites = $page->forgeLinks->map(function ($link) {
                $site = $this->api->site($link->server_id, $link->site_id);
                $site->internalId = $link->id;
                $site->lastDeployment = $this->getLastDeploymentTime($link);

                return $site;
            });
        } catch (Exception $e) {
            if (json_decode($e->getMessage())->message ?? false === 'Too Many Attempts.') {
                return json_decode(Cache::get('forge-sites-last-request'));
            }

            throw $e;
        }

        Cache::put('forge-sites-last-request', json_encode($sites->toArray()), 60);

        return $sites;
    }

    /**
     * @param  PageForgeLink $link
     * @return string
     */
    private function getLastDeploymentTime(PageForgeLink $link)
    {
        $log = $this->api->siteDeploymentLog($link->server_id, $link->site_id);
        $dateString = explode(PHP_EOL, $log)[0];

        try {
            $lastDeployment = Carbon::createFromFormat('D M j H:i:s e Y', $dateString);
        } catch(InvalidArgumentException $e) {
            $lastDeployment = Carbon::createFromFormat('D j M H:i:s e Y', $dateString);
        }

        return $lastDeployment->format('jS F Y H:ia');
    }
}
