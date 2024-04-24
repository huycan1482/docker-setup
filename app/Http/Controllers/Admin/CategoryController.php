<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Repository\CategoryRepository;
use App\Service\ImageBBService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    private $categoryRepository;
    private $imageBBService;

    public function __construct(CategoryRepository $categoryRepository, ImageBBService $imageBBService)
    {
        $this->categoryRepository = $categoryRepository;
        $this->imageBBService = $imageBBService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $newStr = '';
        $str = -12301;
        $str = str_replace(' ', '', (string)$str);
        $arr = array_count_values(str_split($str));
        
        foreach ($arr as $key => $value) {
            if ($value === 1) {
                $newStr .= $key;
            }
        }

        if ($newStr != '') {
            dd($newStr);
        } else {
            dd(-1);
        }

        $categories = $this->categoryRepository->paginate([], [], [], 10);
        return view('admin.category.index', compact('categories'));
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

        dd($request->all());

        $data = $request->only('name', 'parent_id', 'image', 'active');
        $data['slug'] = str_slug($data['name']);
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
