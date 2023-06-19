<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationDatabaseController extends Controller
{
  public function readNotificatio($id)
  {
    Auth::user()->notifications->where('id', $id)->markAsRead();
    return back();
  }

  public function readAllNotification()
  {
    Auth::user()->unreadNotifications->markAsRead();
    return back();
  }
}
