<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\MasterCategories;
use App\Models\MasterItems;
use Image;
use DateTime;

class EmartController extends Controller
{
    public function Home()
    {
        
        if (auth()->check()) {
            $userRole = auth()->user()->role; // Assuming 'role' is the column in your users table
            $categories = MasterCategories::whereUserId(Auth::id())->get();
            $items = MasterItems::whereUserId(Auth::id())->get();
            return view('home', compact('userRole','categories','items'));
        } else {
            $categories = MasterCategories::whereUserId(Auth::id())->get();
            $items = MasterItems::whereUserId(Auth::id())->get();
            return view('home', compact('categories','items'));
        }
    }

    public function Signup()
    {
        return view('signup');
    }

    public function SaveAcount(Request $request)
    {
        $response['status'] = 'failed';
        try {

            // Check if there are any users in the database
            $existingUsersCount = User::count();

            // Determine the role based on the number of existing users
            $role = $existingUsersCount == 0 ? 'admin' : 'customer';

            $user = new User;
            $user->name = $request->full_name;
            $user->email = $request->email;            
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->role = $role;
            $user->save();

            $response['status'] = 'success';
        } catch (\Illuminate\Database\QueryException $e) {
            $response['error'] = $e; // something went wrong with the query
        } catch (\Exception $e) {
            $response['error'] = $e; // something else happened
        }
        return response()->json($response, 200);
    }

    public function Login()
    {
        return view('login');
    }

    public function UserLogin(Request $request)
    {
        $response['status'] = 'failed';
        $remember_me = $request->has('remember_me') ? true : false; 
        if (Auth::attempt(['username' => $request->input('username'), 'password' => $request->input('password')], $remember_me)) {
            $response['status'] = 'success';
        } else {
            $response['status'] = 'login_details_are_not_valid';
        }
        return response()->json($response, 200);
        // return view('home');
    }

    public function Logout(Request $request) {
        Auth::logout();
        return redirect()->route('emart_home');
    }

    public function MasterSaveCategory(Request $request)
    {
        $response['status'] = 'failed';
        try {
            $master_categories = new MasterCategories;
            $master_categories->category_name = $request->save_category;
            $master_categories->user_id = (Auth::id());
            $master_categories->save();
            $response['status'] = 'success';
        } catch (\Illuminate\Database\QueryException $e) {
            $response['error'] = $e; // something went wrong with the query
        } catch (\Exception $e) {
            $response['error'] = $e; // something else happened
        }
        return response()->json($response, 200);
    }

    public function MasterSaveItem(Request $request)
    {
        $response['status'] = 'failed';
        try {
            $master_items = new MasterItems;
            $master_items->item_name = $request->save_item;            
            $master_items->category_id = $request->category_id;
            $master_items->user_id = (Auth::id());                       
            $master_items->status = $request->status;
            $master_items->save();
            $response['status'] = 'success';
        } catch (\Illuminate\Database\QueryException $e) {
            $response['error'] = $e; // something went wrong with the query
        } catch (\Exception $e) {
            $response['error'] = $e; // something else happened
        }
        return response()->json($response, 200);
    }

    public function Upload(Request $request)
    {
        // dd($request->image, $request->productid);
        // generating random photo name
        $t = microtime(true);
        $micro = sprintf("%06d",($t - floor($t)) * 1000000);
        $d = new DateTime( date('Y-m-d H:i:s.'.$micro, $t) );
        $currentDate = $d->format("YmdHisu");
        $photo = rand(1,999).$currentDate;

        // saving the photo on a specific path
        $path = public_path('uploads/product_image/');
        $imagefile = $request->file('image');
        dump($imagefile);
        $img = Image::make($imagefile->getRealPath()); // open an image file
        $img->save($path.$photo.'.jpg', 80); // save image with quality, 30 is lower quality & 80 is better quality

        // updating the database
        $update_data = [
            'product_image' => $photo.'.jpg',
        ];

        MasterItems::where('id', $request->productid)->update($update_data);
        return redirect()->route('home');
    }

    public function Check()
    {
        return view('check');
    }
}
