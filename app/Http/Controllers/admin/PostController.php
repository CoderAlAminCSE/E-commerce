<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;

class PostController extends Controller
{
    public function BlogCatList(){
        $blogcat = DB::table('post_categorie')->get();
        return view('admin.blog.category.index',compact('blogcat'));
    }


    public function BlogCatStore(Request $request){
        $validateDate = $request->validate([
            'category_name_en' => 'required|max:255',
            'category_name_bn' => 'required|max:255',
          
            ]);
          
            $data = array();
            $data['category_name_en'] = $request->category_name_en;
            $data['category_name_bn'] = $request->category_name_bn;
            DB::table('post_categorie')->insert($data);
            $notification=array(
                      'messege'=>'Blog Category Added Successfully',
                      'alert-type'=>'success'
                       );
                     return Redirect()->back()->with($notification);
    }


    public function BlogCatEdit($id){
        $blogcatedit = DB::table('post_categorie')->where('id',$id)->first();
        return view('admin.blog.category.edit',compact('blogcatedit'));
    }



    public function BlogCatUpdate(Request $request,$id){
        $data = array();
        $data['category_name_en'] = $request->category_name_en;
        $data['category_name_bn'] = $request->category_name_bn;
        DB::table('post_categorie')->where('id',$id)->update($data);
        $notification=array(
                  'messege'=>'Blog Category Update Successfully',
                  'alert-type'=>'success'
                   );
                 return Redirect()->route('add.blog.categorylist')->with($notification); 
    }


    public function BlogCatDelete($id){
        DB::table('post_categorie')->where('id',$id)->delete();
        $notification=array(
               'messege'=>'Blog Category Deleted Successfully',
               'alert-type'=>'success'
                );
              return Redirect()->back()->with($notification);
    }







    public function ViewBlogPost(){
        $post = DB::table('posts')
        ->join('post_categorie','posts.category_id','post_categorie.id')
        ->select('posts.*','post_categorie.category_name_en')
        ->get();
       return view('admin.blog.index',compact('post'));
    }



    public function CreatBlogPost(){
        $blogcategory = DB::table('post_categorie')->get();
        return view('admin.blog.create',compact('blogcategory'));
    }


    public function StoreBlogPost(Request $request){
        $data = array();
        $data['post_title_en'] = $request->post_title_en;
        $data['post_title_bn'] = $request->post_title_bn;
        $data['category_id'] = $request->category_id;
        $data['details_en'] = $request->details_en;
        $data['details_bn'] = $request->details_bn;
      
        $post_image = $request->file('post_image');
      
        if ($post_image) {
           $post_image_name = hexdec(uniqid()).'.'.$post_image->getClientOriginalExtension();
           Image::make($post_image)->resize(400,200)->save('upload/post/'.$post_image_name);
           $data['post_image'] = 'upload/post/'.$post_image_name;
      
           DB::table('posts')->insert($data);
           $notification=array(
                  'messege'=>'Post Inserted Successfully',
                  'alert-type'=>'success'
                   );
                 return Redirect()->back()->with($notification);
      
        }else{
            $data['post_image']='';
            DB::table('posts')->insert($data);
           $notification=array(
                  'messege'=>'Post Inserted Without Image',
                  'alert-type'=>'success'
                   );
                 return Redirect()->back()->with($notification);
       
             }
    }



    public function DeleteBlogPost($id){
        $post = DB::table('posts')->where('id',$id)->first();
        $image = $post->post_image;
        unlink($image);
      
        DB::table('posts')->where('id',$id)->delete();
         $notification=array(
                  'messege'=>'Post Deleted Successfully',
                  'alert-type'=>'success'
                   );
                 return Redirect()->back()->with($notification);
    }


    public function EditBlogPost($id){
        $post = DB::table('posts')->where('id',$id)->first();
  	return view('admin.blog.edit',compact('post'));
    }



    public function UpdateBlogPost(Request $request,$id){
        $oldimage = $request->old_image;

        $data = array();
          $data['post_title_en'] = $request->post_title_en;
          $data['post_title_bn'] = $request->post_title_bn;
          $data['category_id'] = $request->category_id;
          $data['details_en'] = $request->details_en;
          $data['details_bn'] = $request->details_bn;
        
          $post_image = $request->file('post_image');
        
          if ($post_image) {
              unlink($oldimage);
             $post_image_name = hexdec(uniqid()).'.'.$post_image->getClientOriginalExtension();
             Image::make($post_image)->resize(400,200)->save('upload/post/'.$post_image_name);
             $data['post_image'] = 'upload/post/'.$post_image_name;
        
             DB::table('posts')->where('id',$id)->update($data);
             $notification=array(
                    'messege'=>'Post Updated Successfully',
                    'alert-type'=>'success'
                     );
                   return Redirect()->route('all.blogpost')->with($notification);
        
          }else{
              $data['post_image']= $oldimage;
               DB::table('posts')->where('id',$id)->update($data);
             $notification=array(
                    'messege'=>'Post Updated Without Image',
                    'alert-type'=>'success'
                     );
                    return Redirect()->route('all.blogpost')->with($notification);
         
               } 
    }




}
