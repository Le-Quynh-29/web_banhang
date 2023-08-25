<?php

namespace App\Http\Controllers;

use App\Repositories\ContentRepository;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    protected $contentRepo;

    public function __construct(ContentRepository $contentRepo)
    {
        $this->contentRepo = $contentRepo;
    }

    /**
     * Show storage file
     * @param string $path
     * @param Request $request
     * @return mixed
     */
    public function show($path)
    {
        if ($path == '') {
            abort(404);
        }
        return $this->contentRepo->responseFile($path);
    }

}
