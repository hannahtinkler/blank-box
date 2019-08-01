<?php

namespace App\Http\Controllers;

use Themsaid\Forge\Forge;
use Illuminate\Http\Request;
use App\Models\PageForgeLink;
use App\Http\Requests\PageForgeLinkRequest;
use App\Http\Requests\PageForgeLinkBranchRequest;

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
    public function store(PageForgeLinkRequest $request)
    {
        $link = PageForgeLink::create(
            array_merge(
                ['created_by' => $request->user()->id],
                $request->only('server_id', 'page_id', 'site_id')
            )
        );

        $message = "This forge link has been saved!";

        return redirect($link->page->searchResultUrl)->with(
            'message',
            sprintf('<i class="fa fa-check"></i> %s', $message)
        );
    }

    /**
     * @return Redirect
     */
    public function editEnv(Request $request, PageForgeLink $link)
    {
        return view('forge-sites.env', [
            'link' => $link,
            'site' => app(Forge::class)->site($link->server_id, $link->site_id),
            'env' => app(Forge::class)->siteEnvironmentFile($link->server_id, $link->site_id),
        ]);
    }

    /**
     * @return Redirect
     */
    public function updateEnv(Request $request, PageForgeLink $link)
    {
        app(Forge::class)->updateSiteEnvironmentFile(
            $link->server_id,
            $link->site_id,
            $request->input('env')
        );

        $message = "This .env file has been saved!";

        return redirect($link->page->searchResultUrl)->with(
            'message',
            sprintf('<i class="fa fa-check"></i> %s', $message)
        );
    }

    /**
     * @return Redirect
     */
    public function editBranch(Request $request, PageForgeLink $link)
    {
        return view('forge-sites.branch', [
            'link' => $link,
            'site' => app(Forge::class)->site($link->server_id, $link->site_id),
            'env' => app(Forge::class)->siteEnvironmentFile($link->server_id, $link->site_id),
        ]);
    }

    /**
     * @return Redirect
     */
    public function updateBranch(PageForgeLinkBranchRequest $request, PageForgeLink $link)
    {
        $site = app(Forge::class)->site($link->server_id, $link->site_id);

        $script = str_replace(
            $site->repositoryBranch,
            $request->input('branch'),
            app(Forge::class)->siteDeploymentScript($link->server_id, $link->site_id)
        );

        app(Forge::class)->updateSiteGitRepository(
            $link->server_id,
            $link->site_id,
            ['branch' => $request->input('branch')]
        );

        app(Forge::class)->updateSiteDeploymentScript(
            $link->server_id,
            $link->site_id,
            $script
        );

        $message = sprintf("This site has been switched to the %s branch!", $request->input('branch'));

        return redirect($link->page->searchResultUrl)->with(
            'message',
            sprintf('<i class="fa fa-check"></i> %s', $message)
        );
    }

    /**
     * @return Redirect
     */
    public function log(Request $request, PageForgeLink $link)
    {
        return view('forge-sites.log', [
            'link' => $link,
            'site' => app(Forge::class)->site($link->server_id, $link->site_id),
            'log' => app(Forge::class)->siteDeploymentLog($link->server_id, $link->site_id),
        ]);
    }

    /**
     * @return Redirect
     */
    public function script(Request $request, PageForgeLink $link)
    {
        return view('forge-sites.script', [
            'link' => $link,
            'site' => app(Forge::class)->site($link->server_id, $link->site_id),
            'script' => app(Forge::class)->siteDeploymentScript($link->server_id, $link->site_id),
        ]);
    }

    /**
     * @return Redirect
     */
    public function deploy(Request $request, PageForgeLink $link)
    {
        $site = app(Forge::class)->site($link->server_id, $link->site_id);

        app(Forge::class)->deploySite($link->server_id, $link->site_id);

        return redirect($link->page->searchResultUrl)->with(
            'message',
            sprintf('<i class="fa fa-check"></i> %s is being deployed!', $site->name)
        );
    }

    /**
     * @return Redirect
     */
    public function unlink(Request $request, PageForgeLink $link)
    {
        $link->delete();

        return redirect($link->page->searchResultUrl)->with(
            'message',
            '<i class="fa fa-check"></i> This forge link has been removed from this project'
        );
    }
}
