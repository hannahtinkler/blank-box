<?php

namespace App\Http\Controllers;

use Event;
use Illuminate\Http\Request;
use App\Http\Requests\PageResourceRequest;

use App\Events\ResourceWasAdded;
use App\Services\PageResourceService;
use App\Services\ResourceTypeService;

class PageResourceController extends Controller
{
    /**
     * @var PageResourceService
     */
    private $resourceTypes;

    /**
     * @var ResourceTypeService
     */
    private $pageResources;

    /**
     * @param ResourceTypeService $resourceTypes
     * @param PageResourceService $pageResources
     */
    public function __construct(
        ResourceTypeService $resourceTypes,
        PageResourceService $pageResources
    ) {
        $this->pageResources = $pageResources;
        $this->resourceTypes = $resourceTypes;
    }

    /**
     * @return Redirect
     */
    public function store(PageResourceRequest $request)
    {
        $data = $request->input();
        $data['user_id'] = $request->user()->id;
        
        $resource = $this->pageResources->store($data);

        $message = "This resource has been saved!";

        Event::fire(new ResourceWasAdded($resource));

        return redirect($resource->page->searchResultUrl)->with(
            'message',
            sprintf('<i class="fa fa-check"></i>%s', $message)
        );
    }

    /**
     * @param  int $id
     * @return View
     */
    public function edit($id)
    {
        $resource = $this->pageResources->getById($id);
        $resourceTypes = $this->resourceTypes->getAllCategorised();

        return view('pageresources.edit', compact('resource', 'resourceTypes'));
    }

    /**
     * @param  PageRequest $request
     * @param  int      $id
     * @return Redirect
     */
    public function update(PageResourceRequest $request, $id)
    {
        $resource = $this->pageResources->update($id, $request->input());

        $message = "This resource has been updated.";
        
        return redirect($resource->page->searchResultUrl)->with(
            'message',
            sprintf('<i class="fa fa-check"></i>%s', $message)
        );
    }

    public function destroy($id)
    {
        $resource = $this->pageResources->getById($id);
        $redirect = $resource->page->searchResultUrl;

        $this->pageResources->delete($resource->id);

        $message = "This resource has been deleted.";

        return redirect($redirect)->with(
            'message',
            sprintf('<i class="fa fa-check"></i>%s', $message)
        );
    }
}
