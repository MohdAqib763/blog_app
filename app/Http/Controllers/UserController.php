<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;
use App\User;
use App\Posts;
use DB;

class UserController extends Controller
{

   

    
    public function PostPage(){

        return view('create_post');
    }

    public function HomePage(){

        $user_id = Auth::id();
        $posts = DB::table('posts')->where('user_id',$user_id)->get();

        return view('home',['posts'=>$posts]);
    }

    public function Register(Request $request)
    {
        $request->validate([
            'full_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
 
        User::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $data = [
            'full_name' =>  $request->full_name,
            'email' =>  $request->email,
        ];

        //\Mail::to($request->email)->send(new VerifyEmail($data));
 
        return redirect('/login')->with('success', 'Registration successful! Please log in.');
    }


    public function LoginUser(Request $request){

        $validator =  $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
    
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/')
                        ->withSuccess('Signed in');
        }
        $validator['emailPassword'] = 'Email address or password is incorrect.';
        return redirect("login")->withErrors($validator);
    }

    public function Logout(Request $request){
        Auth::logout();
        return redirect('/login');
    }

    public function SavePost(Request $request){
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'post_title' => 'required|string',
                'post_desc' => 'required|string',
            ]);

            // Create a new post instance
            $post = new Posts();
            $post->post_title = $validatedData['post_title'];
            $post->post_desc = $validatedData['post_desc'];
            $post->user_id = Auth::id();

            // Save the post to the database
            $post->save();

            // Return a success response
            return redirect()->back()->with('success','Post saved successfully');
            
        } catch (\Exception $e) {
            // Return an error response
            return redirect()->back()->with('error' , 'Error saving post: ' . $e->getMessage());
        }

    }


    public function UpdatePost(Request $request){
        $post = $request->post_id;

        if (!$post) {
            return redirect()->back()->with('error' , 'Error updating post: ' . $e->getMessage());
        }

        $validatedData = $request->validate([
            'post_title' => 'required|string',
            'post_desc' => 'required|string',
        ]);

        if($validatedData){
            DB::table('posts')->where('post_id',$post)->update(['post_title'=>$request->post_title,'post_desc'=>$request->post_desc]);
        }

        return redirect()->back()->with('success','Post updated successfully');
    }


    public function DeletePost($id){
        if($id){
            Posts::where('post_id',$id)->delete();
            

            return redirect()->back()->with('success','Post deleted successfully');
        }
    }

    public function EmailVerification(Request $request){

        $email = $request->email;

        if($email){

            User::where('email', $email)->update([
                'email_verified' => 'yes'
             ]);
     
             return redirect('/login')->with('success','Email verification completed');
        }else{

            return redirect('/login')->with('errors','Email verification Failed');

        }
     
    }


    public function ViewPost($id){

        if($id){
            $post = DB::table('posts')->where('post_id',$id)->first();
            return view('post_details',['post'=>$post]);
        }
    }

    public function EditPost($id){

        if($id){
            $post = DB::table('posts')->where('post_id',$id)->first();
            return view('edit_post',['post'=>$post]);
        }
    }
}
