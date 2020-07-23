<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user;
use App\Contact;
use App\Mail\NewsLetter;
use Mail;
use Illuminate\Support\Facades\Storage;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('auth');
        $this->middleware('checkrole');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      return view('home', [
        'users'=> User::latest()->paginate(3),
        'total_user' => User::count(),
        'contacts' => Contact::all()
      ]);
    }
    // public function index()
    // {
    //   $users=User::latest()->paginate(3);
    //   $total_user=User::count();
    //   return view('home', compact('users','total_user'));
    // }
    public function sendsendnewslatter()
    {
    //    foreach ( User::all()->pluck('email') as $email) {
    // //      Mail::to($email)->send(new NewsLetter());
    // //    }
    // //    return back();
    $email = User::find(18)->email;
    Mail::to($email)->send(new NewsLetter());
    echo "SEND";
    }
    public function contactuploadfile($contact_id)
    {

      return Storage::download(Contact::findOrFail($contact_id)->contact_attectment);
    }
}
