<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CarController extends Controller
{
    const PATH_VIEW = 'admin.cars.';
    const PATH_UPLOAD = 'cars';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Car::query()->with('brand')->paginate(5);

        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::query()->pluck('name', 'id')->toArray();

        return view(self::PATH_VIEW . __FUNCTION__, compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|unique:cars',
            'img_thumbnail' => 'nullable|image|max:2048',
            'describe' => 'nullable',
            'brand_id' => [
                Rule::exists('brands', 'id')
            ],
        ]);

        $data = $request->except('img_thumbnail');

        if ($request->hasFile('img_thumbnail')) {
            $data['img_thumbnail'] = Storage::put(self::PATH_UPLOAD, $request->file('img_thumbnail'));
        }

        Car::query()->create($data);

        return back()->with('msg', 'Thao tác thành công');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('car'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        $request->validate([
            'name' => 'required|max:50|unique:cars,name,' . $car->id,
            'img_thumbnail' => 'nullable|image|max:2048',
            'describe' => 'nullable',
            'brand_id' => [
                Rule::exists('brands', 'id')
            ],
        ]);

        $data = $request->except('img_thumbnail');

        $imgCurrent = $car->img_thumbnail;
        if ($request->hasFile('img_thumbnail')) {
            $data['img_thumbnail'] = Storage::put(self::PATH_UPLOAD, $request->file('img_thumbnail'));
        }

        $car->update($data);

        if ($request->hasFile('img_thumbnail') && Storage::exists($imgCurrent)) {
            Storage::delete($imgCurrent);
        }

        return back()->with('msg', 'Thao tác thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        $car->delete();

        if (Storage::exists($car->img_thumbnail)) {
            Storage::delete($car->img_thumbnail);
        }

        return back()->with('msg', 'Thao tác thành công');
    }
}
