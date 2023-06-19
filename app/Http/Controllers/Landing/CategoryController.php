<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;

class CategoryController extends Controller
{
  /**
   * Handle the incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function __invoke(Category $category)
  {
    /*
      tampung semua data course yang dimana "category_id" sesuai dengan variabel $category kedalam variabel $courses, kemudian kita memanggil relasi menggunakan withcount, selanjutnya pada saat melakukan pemanggilan relasi details yang kita ubah namanya menjadi enrolled, disini kita melakukan sebuah query untuk mengambil data transaksi yang memiliki status "success", disini kita juga menambahkan method search yang kita dapatkan dari sebuah trait hasScope, dan juga kita urutkan datanya dari yang paling baru.
    */
    $courses = Course::withCount(['review', 'videos', 'details as enrolled' => function ($query) {
      $query->whereHas('transaction', function ($query) {
        $query->where('status', 'success');
      });
    }])->where('category_id', $category->id)->search('name')->latest()->get();

    // passing variabel $course, $category, dan $avgRating kedalam view.
    return view('landing.category.show', compact('courses', 'category'));
  }
}
