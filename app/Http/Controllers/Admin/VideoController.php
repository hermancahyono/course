<?php

namespace App\Http\Controllers\Admin;

use App\Models\Video;
use App\Models\Course;
use App\Http\Requests\VideoRequest;
use App\Http\Controllers\Controller;

class VideoController extends Controller
{
  public function index($slug)
  {
    //tampung data course ke dalam variabel $course, yang mana slug-nya sama dengan variabel $slug.
    $course = Course::where('slug', $slug)->first();

    //tampung seluruh data video ke dalam variabel $videos, yang mana course_id nya sama dengan variabel $course->id
    $videos = Video::where('course_id', $course->id)->get();

    //passing variabel $videos dan $course ke view
    return view('admin.video.index', compact('videos', 'course'));
  }

  public function create($slug)
  {
    //tampung data course ke dalam variabel $course, yang mana slug-nya sama dengan variabel $slug.
    $course = Course::where('slug', $slug)->first();
    //passing variabel $course ke view
    return view('admin.video.create', compact('course'));
  }

  public function store($slug, VideoRequest $request)
  {
    //tampung data course ke dalam variabel $course yang mana slug-nya sama dengan variabel $slug
    $course = Course::where('slug', $slug)->first();
    //masukan data baru video dengan course_id sesuai variabel $course.
    $course->videos()->create([
      'name' => $request->name,
      'episode' => $request->episode,
      'intro' => $request->intro,
      'video_code' => $request->video_code,
    ]);
    //kembali ke halaman admin/video/index dengan membawa toastr.
    return redirect(route('admin.video.index', $course))->with('toast_success', 'Video berhasil ditambahkan');
  }

  public function edit($slug, Video $video)
  {
    //tampung data course ke dalam variabel $course yang mana slug-nya sama dengan variabel $slug
    $course = Course::where('slug', $slug)->first();
    //passing variabel $video ke view
    return view('admin.video.edit', compact('course', 'video'));
  }

  public function update($slug, VideoRequest $request, Video $video)
  {
    //tampung data course ke dalam variabel $course yang mana slug-nya sama dengan variabel $slug
    $course = Course::where('slug', $slug)->first();
    //update data video berdasarkan id
    $video->update([
      'name' => $request->name,
      'episode' => $request->episode,
      'intro' => $request->intro,
      'video_code' => $request->video_code
    ]);

    //kembali ke halaman admin/video/index dengan membawa toastr.
    return redirect(route('admin.video.index', $course))->with('toast_success', 'Video berhasil diupdate');
  }

  public function destroy(Video $video)
  {
    //hapus data video berdasarkan id
    $video->delete();

    //kembali ke halaman admin/video/index dengan membawa toastr.
    return back()->with('toast_success', 'Video berhasil dihapus');
  }
}
