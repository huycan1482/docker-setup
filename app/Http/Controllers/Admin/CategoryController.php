<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Repository\CategoryRepository;
use App\Service\DropBoxService;
use App\Service\ImageBBService;
use Dcblogdev\Dropbox\Dropbox as DropboxDropbox;
use Dcblogdev\Dropbox\Facades\Dropbox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CategoryController extends Controller
{
    private $categoryRepository;
    private $imageBBService;
    private $dropBoxService;

    public function __construct(CategoryRepository $categoryRepository, ImageBBService $imageBBService, DropBoxService $dropBoxService)
    {
        $this->categoryRepository = $categoryRepository;
        $this->imageBBService = $imageBBService;
        $this->dropBoxService = $dropBoxService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // $del = Storage::disk('dropbox')->delete('uploads/1716803285_01_gettyimages-521106495_super_resized.jpg');
        // dd($del);

        $directory = 'uploads';
        $allFiles = collect(Storage::disk('dropbox')->files($directory))->map(function($file) {
            dd($file);
            return Storage::disk('dropbox')->url($file);
        });

        $categories = $this->categoryRepository->paginate([], [], [], 10);
        return view('admin.category.index', compact('categories', 'allFiles'));
    }

    public function getCategories(Request $request): array
    {
        return response()->json(['success' => true]);                
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categoryRepository->get(['parent_id' => 0], ['id' => 'desc']);
        return view('admin.category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $category = new Category;
        // $category->name = $request->name;
        // $category = Category::create($data);

        // dd($request->all());

        $data = $request->only('name', 'parent_id', 'image', 'active');
        $data['slug'] = str_slug($data['name']);


        // $file = $request->file('image');
        // $ert = $file->getClientOriginalExtension();
        // $file_src=$request->file("filesend"); //file src
        // $is_file_uploaded = Storage::disk('dropbox')->put('public-uploads',$ert);

        $image = $request->file('image');
        $fileName = time().'_'.$image->getClientOriginalName();


        $path = Storage::disk('dropbox')->putFileAs(
           'uploads', $image, $fileName
        );

        dd($path);
        // $encode = base64_encode(file_get_contents($request->file('image')));
        // $res = $this->imageBBService->sendImage($encode);
        // dd($res);

        $category = $this->categoryRepository->create($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
