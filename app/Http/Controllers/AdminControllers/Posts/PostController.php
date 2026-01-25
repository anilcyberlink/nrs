<?php

namespace App\Http\Controllers\AdminControllers\Posts;

use App\Models\Posts\PostTypeModel;
use App\Models\Posts\PostModel;
use App\Models\Portfolios\PortfolioModel;
use App\Models\Posts\PostCategoryModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($uri)
    {
      $posttype = PostTypeModel::where('uri',$uri)->first();
      if($posttype){
        $posttypeId = $posttype->id;
        $data = PostModel::where(['post_type'=>$posttypeId,'post_parent'=>0])->orderBy('post_order','asc')->get();
        return view('admin.posts.index', compact('data'));
      }
      return redirect('/dashboard');
    }

    public function list($uri){

      $posttype = PostTypeModel::where('uri',$uri)->first();
      if($posttype){
      $posttypeId = $posttype->id;
      $data = PostModel::where(['post_type'=>$posttypeId,'post_parent'=>0])->orderBy('post_order','asc')->get();
        return view('admin.posts.index', compact('data'));
      }
      return redirect('/dashboard');

    }

    public function childlist($uri,$id){
      $posttype = PostTypeModel::where('uri',$uri)->first();
      if($posttype){
        $posttype_id = $posttype->id;
        $data = PostModel::where(['post_type'=>$posttype_id,'post_parent'=>$id])->orderBy('post_order','asc')->get();
        return view('admin.posts.index', compact('data'));
      }
      return redirect('/dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      // List Template
      $fileList = scandir(resource_path('views/themes/default/'));
      $filterArray = $this->filter_template($fileList);

      $filename = array();
      foreach ($filterArray as $filterArr) {
        $filename[] = $this->remove_extention($filterArr);
      }
      $file1 = array('single'=>'Choose Template');
      foreach ($filename as $file) {
        $file1[$file] = $file;
      }
      $templates = $file1;

      // List Template Child
      $fileListChild = scandir(resource_path('views/themes/default/'));
      $filterArrayChild = $this->filter_template_child($fileListChild);
      $filenameChild = array();
      foreach ($filterArrayChild as $filterArrChild) {
        $filenameChild[] = $this->remove_extention($filterArrChild);
      }
      $file1Child = array('single'=>'Choose Child Template');
      foreach ($filenameChild as $fileChild) {
        $file1Child[$fileChild] = $fileChild;
      }
      $templates_child = $file1Child;

     // Get parent list by post type ID
      $posttype_uri = request()->segment(2);
      $posttype = $this->getPostTypeId($posttype_uri);
      $posttype_id = $posttype->id;
      $parent_post = PostModel::where(['post_type'=>$posttype_id,'post_parent'=>0])->get();
      $ord = PostModel::max('post_order');
      $post_order = $ord+1;
      $category = PostCategoryModel::where('post_type',$posttype_id)->get();
      $post_portfolio = PortfolioModel::all();
      return view('admin.posts.create', compact('category','parent_post','templates','templates_child','post_order','post_portfolio'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if($request->has('post_type')){
        $post_type = $request->input('post_type');
      }else{
        return "Invalid Post Type";
      }

      $request->validate([
        'post_title'=>'required',
        'uri'=>'required|unique:cl_posts'
      ]);

      $medium_width = env('MEDIUM_WIDTH');
      $medium_height = env('MEDIUM_HEIGHT');
      $destinationPath_medium = public_path('uploads/medium');
      $destinationOriginal = public_path('uploads/original');

      $data = $request->all();
      $thumbnail =  $request->file('thumbnail');
      $page_thumbnail =  $request->file('page_thumbnail');
      $banner =  $request->file('banner');
      $icon =  $request->file('icon');
      $thumbnail_name = '';
      $page_thumbnail_name = '';
      $banner_name = '';
      $icon_name = '';

      //upload audio
        if ($request->hasFile('audio')) {
            $image = $request->file('audio');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/audio/');

            $image->move($destinationPath, $name);
            $data['audio'] = $name;
        }

         // Upload Icon
       if ($request->hasFile('icon')) {
        $icon = $request->file('icon');
        $name = time().rand(5000,999999). '.' . $icon->getClientOriginalExtension();
        $destinationPath = public_path('/uploads/large/');
        $icon->move($destinationPath, $name);
        $data['icon'] = $name;
    }

      // Upload Thumbnail
      if($request->hasfile('thumbnail')){
        $_thumbnail = $request->file('thumbnail')->getClientOriginalName();
        $thumbnail_extension = $request->file('thumbnail')->getClientOriginalExtension();
        $_thumbnail = explode('.', $_thumbnail);
        $thumbnail_name = Str::slug($_thumbnail[0]) . '-' . Str::random(5) . '.' . $thumbnail_extension;

        if($thumbnail_extension != 'svg' && $thumbnail_extension != 'webp'){
        $thumbnail_picture = Image::make($thumbnail->getRealPath());
        $width = Image::make($thumbnail->getRealPath())->width();
        $height = Image::make($thumbnail->getRealPath())->height();
        /*Upload Original Image*/
        $thumbnail_picture->save($destinationOriginal .'/'. $thumbnail_name );
        $thumbnail_picture->resize($medium_width, $medium_height, function($constraint){
          $constraint->aspectRatio();
        })->save($destinationPath_medium .'/'. $thumbnail_name );


        }else{
          move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $destinationPath_medium.'/'.$thumbnail_name);
        }
      }

       // Upload Page Thumbnail
       if($request->hasfile('page_thumbnail')){
        $_page_thumbnail = $request->file('page_thumbnail')->getClientOriginalName();
        $page_thumbnail_extension = $request->file('page_thumbnail')->getClientOriginalExtension();
        $_page_thumbnail = explode('.', $_page_thumbnail);
        $page_thumbnail_name = Str::slug($_page_thumbnail[0]) . '-' . Str::random(5) . '.' . $page_thumbnail_extension;

        if($page_thumbnail_extension != 'svg' && $page_thumbnail_extension != 'webp'){
        $page_thumbnail_picture = Image::make($page_thumbnail->getRealPath());
        $width = Image::make($page_thumbnail->getRealPath())->width();
        $height = Image::make($page_thumbnail->getRealPath())->height();
         /*Upload Original Image*/
        $page_thumbnail_picture->save($destinationOriginal .'/'. $page_thumbnail_name );
        $page_thumbnail_picture->resize($medium_width, $medium_height, function($constraint){
          $constraint->aspectRatio();
        })->save($destinationPath_medium .'/'. $page_thumbnail_name );


        }else{
          move_uploaded_file($_FILES["page_thumbnail"]["tmp_name"], $destinationPath_medium.'/'.$page_thumbnail_name);
        }
      }

       // Upload Banner
       if($request->hasfile('banner')){
        $_banner = $request->file('banner')->getClientOriginalName();
        $banner_extension = $request->file('banner')->getClientOriginalExtension();
        $_banner = explode('.', $_banner);
        $banner_name = Str::slug($_banner[0]) . '-' . Str::random(5) . '.' . $banner_extension;

        if($banner_extension != 'svg' && $banner_extension != 'webp'){
        $banner_picture = Image::make($banner->getRealPath());
        $width = Image::make($banner->getRealPath())->width();
        $height = Image::make($banner->getRealPath())->height();
         /*Upload Original Image*/
        $banner_picture->save($destinationOriginal .'/'. $banner_name );
        $banner_picture->resize($medium_width, $medium_height, function($constraint){
          $constraint->aspectRatio();
        })->save($destinationPath_medium .'/'. $banner_name );

        /*Upload Original Image*/
        // $banner_picture->resize($width, $height, function($constraint){
        //   $constraint->aspectRatio();
        // })->save($destinationOriginal .'/'. $banner_name );
        }else{
          move_uploaded_file($_FILES["banner"]["tmp_name"], $destinationPath_medium.'/'.$banner_name);
        }
      }

      $data['page_key'] = time().rand(500000,999999999);
      $posttypeId = $this->getPostTypeId($request->post_type);
      $data['post_type'] = $posttypeId->id;
      $data['uri'] = Str::slug($request->uri);
      $data['thumbnail'] = $thumbnail_name;
      $data['page_thumbnail'] = $page_thumbnail_name;
      $data['icon'] = $icon_name;
      $data['banner'] = $banner_name;
      $isChecked = $request->has('project_status');
      $data['project_status'] = ($isChecked)?'1':'0';
      $isChecked = $request->has('show_in_home');
      $data['show_in_home'] = ($isChecked)?'1':'0';
      $result = PostModel::create($data);
      $last_id = $result->id;

      /************Attach******************/
      $_data = PostModel::find($last_id);
      $_data->portfolio()->attach($request->portfolios);

      /************************************/
      if($result){
        return redirect( 'admin/'. $post_type.'/'.$last_id.'/edit')->with('message','Successfully added.');
      }else{
        return 'Error';
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Posts\PostModel  $postModel
     * @return \Illuminate\Http\Response
     */
    public function show(PostModel $postModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Posts\PostModel  $postModel
     * @return \Illuminate\Http\Response
     */
    public function edit(PostModel $postModel, $posttype, $id)
    {
      $fileList = scandir(resource_path('views/themes/default/'));
      $filterArray = $this->filter_template($fileList);

      $filename = array();
      foreach ($filterArray as $filterArr) {
        $filename[] = $this->remove_extention($filterArr);
      }
      $file1 = array('single'=>'Choose Template');
      foreach ($filename as $key=>$file) {
       $file1[$file] = $file;
     }
     $templates = $file1;

     // List Template Child
      $fileListChild = scandir(resource_path('views/themes/default/'));
      $filterArrayChild = $this->filter_template_child($fileListChild);

      $filenameChild = array();
      foreach ($filterArrayChild as $filterArrChild) {
        $filenameChild[] = $this->remove_extention($filterArrChild);
      }
      $file1Child = array('single'=>'Choose Child Template');
      foreach ($filenameChild as $fileChild) {
        $file1Child[$fileChild] = $fileChild;
      }
      $templates_child = $file1Child;

      $data = PostModel::find($id);
      $checked_portfolio = array();
       foreach($data->portfolio as $value){
         $checked_portfolio[] = $value->pivot->portfolio_id;
        }
      $post_portfolio = PortfolioModel::all();

     // Get parent list by post type ID
     $posttype_uri = request()->segment(2);
     $posttype = $this->getPostTypeId($posttype_uri);
     $posttype_id = $posttype->id;
     $parent_post = PostModel::where(['post_type'=>$posttype_id,'post_parent'=>0])->get();
     $category = PostCategoryModel::where('post_type',$posttype_id)->get();
     $data = PostModel::find($id);
     return view('admin.posts.edit', compact('category','data','parent_post','templates','templates_child','category','checked_portfolio','post_portfolio'));
   }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Posts\PostModel  $postModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PostModel $postModel, $posttype, $id)
    {
      $medium_width = env('MEDIUM_WIDTH');
      $medium_height = env('MEDIUM_HEIGHT');
      $destinationPath_medium = public_path('uploads/medium');
      $destinationOriginal = public_path('uploads/original');

      $data = PostModel::find($id);
      $thumbnail = $request->file('thumbnail');
      $page_thumbnail = $request->file('page_thumbnail');
      $banner = $request->file('banner');
      $icon = $request->file('icon');
      $thumbnail_name = '';
      $page_thumbnail_name = '';
      $banner_name = '';
      $icon_name = '';

      // Update Icon
       if ($request->hasFile('icon')) {
           $data = PostModel::find($id);
        if($data->icon){
          if(file_exists(env('PUBLIC_PATH').'uploads/large/' . $data->icon)){
            unlink(env('PUBLIC_PATH').'uploads/large/' . $data->icon);
          }
        }
        $icon = $request->file('icon');
        $name = time().rand(5000,999999). '.' . $icon->getClientOriginalExtension();
        $destinationPath = public_path('/uploads/large/');
        $icon->move($destinationPath, $name);
        $data['icon'] = $name;
    }

      // Update Thumbnail
      if($request->hasfile('thumbnail')){
        $data = PostModel::find($id);
        if($data->thumbnail){
          if(file_exists(env('PUBLIC_PATH').'uploads/medium/' . $data->thumbnail)){
            unlink(env('PUBLIC_PATH').'uploads/medium/' . $data->thumbnail);
          }
          if(file_exists(env('PUBLIC_PATH').'uploads/original/' . $data->thumbnail)){
            unlink(env('PUBLIC_PATH').'uploads/original/' . $data->thumbnail);
          }
        }
        $_thumbnail = $request->file('thumbnail')->getClientOriginalName();
        $thumbnail_extension = $request->file('thumbnail')->getClientOriginalExtension();
        $_thumbnail = explode('.', $_thumbnail);
        $thumbnail_name = Str::slug($_thumbnail[0]) . '-' . Str::random(5) . '.' . $thumbnail_extension;

        if($thumbnail_extension != 'svg' && $thumbnail_extension != 'webp'){
        $thumbnail_picture = Image::make($thumbnail->getRealPath());
        $width = Image::make($thumbnail->getRealPath())->width();
        $height = Image::make($thumbnail->getRealPath())->height();
         /*Upload Original Image*/
        $thumbnail_picture->save($destinationOriginal .'/'. $thumbnail_name );
        $thumbnail_picture->resize($medium_width, $medium_height, function($constraint){
          $constraint->aspectRatio();
        })->save($destinationPath_medium .'/'. $thumbnail_name );


        }else{
          move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $destinationPath_medium.'/'.$thumbnail_name);
        }
        $data->thumbnail = $thumbnail_name;
      }

       // Update Page Thumbnail
       if($request->hasfile('page_thumbnail')){
        $data = PostModel::find($id);
        if($data->page_thumbnail){
          if(file_exists(env('PUBLIC_PATH').'uploads/medium/' . $data->page_thumbnail)){
            unlink(env('PUBLIC_PATH').'uploads/medium/' . $data->page_thumbnail);
          }
          if(file_exists(env('PUBLIC_PATH').'uploads/original/' . $data->page_thumbnail)){
            unlink(env('PUBLIC_PATH').'uploads/original/' . $data->page_thumbnail);
          }
        }
        $_page_thumbnail = $request->file('page_thumbnail')->getClientOriginalName();
        $page_thumbnail_extension = $request->file('page_thumbnail')->getClientOriginalExtension();
        $_page_thumbnail = explode('.', $_page_thumbnail);
        $page_thumbnail_name = Str::slug($_page_thumbnail[0]) . '-' . Str::random(5) . '.' . $page_thumbnail_extension;

        if($page_thumbnail_extension != 'svg' && $page_thumbnail_extension != 'webp'){
        $page_thumbnail_picture = Image::make($page_thumbnail->getRealPath());
        $width = Image::make($page_thumbnail->getRealPath())->width();
        $height = Image::make($page_thumbnail->getRealPath())->height();
         /*Upload Original Image*/
        $page_thumbnail_picture->save($destinationOriginal .'/'. $page_thumbnail_name );
        $page_thumbnail_picture->resize($medium_width, $medium_height, function($constraint){
          $constraint->aspectRatio();
        })->save($destinationPath_medium .'/'. $page_thumbnail_name );


        }else{
          move_uploaded_file($_FILES["page_thumbnail"]["tmp_name"], $destinationPath_medium.'/'.$page_thumbnail_name);
        }
        $data->page_thumbnail = $page_thumbnail_name;
      }

      // Update Banner
      if($request->hasfile('banner')){
        $data = PostModel::find($id);
        if($data->banner){
          if(file_exists(env('PUBLIC_PATH').'uploads/medium/' . $data->banner)){
            unlink(env('PUBLIC_PATH').'uploads/medium/' . $data->banner);
          }
          if(file_exists(env('PUBLIC_PATH').'uploads/original/' . $data->banner)){
            unlink(env('PUBLIC_PATH').'uploads/original/' . $data->banner);
          }
        }
        $_banner = $request->file('banner')->getClientOriginalName();
        $banner_extension = $request->file('banner')->getClientOriginalExtension();
        $_banner = explode('.', $_banner);
        $banner_name = Str::slug($_banner[0]) . '-' . Str::random(5) . '.' . $banner_extension;

        if($banner_extension != 'svg' && $banner_extension != 'webp'){
        $banner_picture = Image::make($banner->getRealPath());
        $width = Image::make($banner->getRealPath())->width();
        $height = Image::make($banner->getRealPath())->height();
         /*Upload Original Image*/
        $banner_picture->save($destinationOriginal .'/'. $banner_name );
        $banner_picture->resize($medium_width, $medium_height, function($constraint){
          $constraint->aspectRatio();
        })->save($destinationPath_medium .'/'. $banner_name );

        /*Upload Original Image*/
        // $banner_picture->resize($width, $height, function($constraint){
        //   $constraint->aspectRatio();
        // })->save($destinationOriginal .'/'. $banner_name );
        }else{
          move_uploaded_file($_FILES["banner"]["tmp_name"], $destinationPath_medium.'/'.$banner_name);
        }
        $data->banner = $banner_name;
      }

        //upload audio
        if ($request->hasFile('audio')) {
            $data = PostModel::find($id);
            if($data->audi){
                if(file_exists(env('PUBLIC_PATH').'audio/' . $data->audio)){
                    unlink(env('PUBLIC_PATH').'audio/' . $data->audio);
                }
                if(file_exists(env('PUBLIC_PATH').'audio/' . $data->audio)){
                    unlink(env('PUBLIC_PATH').'audio/' . $data->audio);
                }
            }
            $image = $request->file('audio');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/audio/');

            $image->move($destinationPath, $name);
            $data['audio'] = $name;
        }

      $posttypeId = $this->getPostTypeId($request->post_type);
      $data->post_date = $request->post_date;
      $data->template = $request->template;
      $data->template_child = $request->template_child;
      $data->post_title = $request->post_title;
      $data->uri = Str::slug($request->uri);
      $data->sub_title = $request->sub_title;
      $data->uid = $request->uid;
      $data->post_content = $request->post_content;
      $data->post_excerpt = $request->post_excerpt;
      $data->post_type = $posttypeId->id;
      $data->post_category = $request->category;
      $data->post_parent = $request->post_parent;
      $data->post_order = $request->post_order;
      $data->page_video = $request->page_video;
      $data->meta_keyword = $request->meta_keyword;
      $data->meta_description = $request->meta_description;
      $data->associated_title = $request->associated_title;
      $data->external_link = $request->external_link;
      $data->price = $request->price;
      $data->post_tags = $request->post_tags;
       $isChecked = $request->has('project_status');
      $data->project_status = ($isChecked)?'1':'0';
      $isChecked = $request->has('show_in_home');
      $data->show_in_home = ($isChecked)?'1':'0';
        $data->home_order = $request->home_order;
          /************Detach******************/
      $_data = PostModel::find($id);
      $_data->portfolio()->detach();
      $_data->portfolio()->attach($request->portfolios);

    /************Detach******************/
      if($data->save()){
        return redirect()->back()->with('message','Update Sucessfully.');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Posts\PostModel  $postModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostModel $postModel,$posttype,$id)
    {
      $data = PostModel::find($id);
      if($data->icon != NULL){
         if(file_exists(env('PUBLIC_PATH').'uploads/large/' . $data->icon)){
            unlink(env('PUBLIC_PATH').'uploads/large/' . $data->icon);
          }
      }
      if($data->thumbnail != NULL){
        if(file_exists(env('PUBLIC_PATH').'uploads/medium/' . $data->thumbnail)){
          unlink(env('PUBLIC_PATH').'uploads/medium/' . $data->thumbnail);
        }
        if(file_exists(env('PUBLIC_PATH').'uploads/original/' . $data->thumbnail)){
          unlink(env('PUBLIC_PATH').'uploads/original/' . $data->thumbnail);
        }
      }
      if($data->page_thumbnail != NULL){
        if(file_exists(env('PUBLIC_PATH').'uploads/medium/' . $data->page_thumbnail)){
          unlink(env('PUBLIC_PATH').'uploads/medium/' . $data->page_thumbnail);
        }
        if(file_exists(env('PUBLIC_PATH').'uploads/original/' . $data->page_thumbnail)){
          unlink(env('PUBLIC_PATH').'uploads/original/' . $data->page_thumbnail);
        }
      }
      if($data->banner != NULL){
        if(file_exists(env('PUBLIC_PATH').'uploads/medium/' . $data->banner)){
          unlink(env('PUBLIC_PATH').'uploads/medium/' . $data->banner);
        }
        if(file_exists(env('PUBLIC_PATH').'uploads/original/' . $data->banner)){
          unlink(env('PUBLIC_PATH').'uploads/original/' . $data->banner);
        }
      }
      $data->delete();

      return 'Are you sure to delete?';
    }

    // Return Post Type uri
    private function getPostTypeId($uri){
      $posttype = PostTypeModel::where('uri',$uri)->first();
      return $posttype;
    }

    // Filter Template
    private function filter_template($template){
      $tmpl = array();
      if(!empty($template)){
        foreach($template as $tmp){
          if(strpos($tmp, "template-") !== false){
            $tmpl[] = $tmp;
          }
        }
      }
      return $tmpl;
    }

    // Filter Template Child
    private function filter_template_child($template){
      $tmpl2 = array();
      if(!empty($template)){
        foreach($template as $tmpl){
          if(strpos($tmpl, "templatechild-") !== false){
            $tmpl2[] = $tmpl;
          }
        }
      }
      return $tmpl2;
    }

     // Remove Extention
     private function remove_extention($filename){
      $exp = explode('.',$filename);
      $file = $exp[0];
      return $file;
    }

    // Delete Post Thumbnail
    function delete_pagethumbnail(PostModel $postModel, $id){
     $data = PostModel::find($id);
     if($data->page_thumbnail){
      if(file_exists(env('PUBLIC_PATH').'uploads/medium/' . $data->page_thumbnail)){
        unlink(env('PUBLIC_PATH').'uploads/medium/' . $data->page_thumbnail);
      }
      if(file_exists(env('PUBLIC_PATH').'uploads/original/' . $data->page_thumbnail)){
        unlink(env('PUBLIC_PATH').'uploads/original/' . $data->page_thumbnail);
      }
    }
    $data->page_thumbnail = NULL;
    $data->save();
    return response('Delete Successful.');
  }

     // Delete Post Thumbnail
   function delete_icon(PostModel $postModel, $id){
     $data = PostModel::find($id);
     if($data->icon){
      if(file_exists(env('PUBLIC_PATH').'uploads/large/' . $data->icon)){
        unlink(env('PUBLIC_PATH').'uploads/large/' . $data->icon);
      }
    }
    $data->icon = NULL;
    $data->save();
    return response('Delete Successful.');
  }


     // Delete Post Thumbnail
    function delete_thumbnail(PostModel $postModel, $id){
     $data = PostModel::find($id);
     if($data->thumbnail){
      if(file_exists(env('PUBLIC_PATH').'uploads/medium/' . $data->thumbnail)){
        unlink(env('PUBLIC_PATH').'uploads/medium/' . $data->thumbnail);
      }
      if(file_exists(env('PUBLIC_PATH').'uploads/original/' . $data->thumbnail)){
        unlink(env('PUBLIC_PATH').'uploads/original/' . $data->thumbnail);
      }
    }
    $data->thumbnail = NULL;
    $data->save();
    return response('Delete Successful.');
  }

     // Delete Post Thumbnail
    function delete_banner(PostModel $postModel, $id){
     $data = PostModel::find($id);
     if($data->banner){
      if(file_exists(env('PUBLIC_PATH').'uploads/medium/' . $data->banner)){
        unlink(env('PUBLIC_PATH').'uploads/medium/' . $data->banner);
      }
      if(file_exists(env('PUBLIC_PATH').'uploads/original/' . $data->banner)){
        unlink(env('PUBLIC_PATH').'uploads/original/' . $data->banner);
      }
    }
    $data->banner = NULL;
    $data->save();
    return response('Delete Successful.');
  }


    // Delete Post Audio
    function delete_audio(PostModel $postModel, $id){
        $data = PostModel::find($id);
        if($data->audio){
            if(file_exists(env('PUBLIC_PATH').'audio/' . $data->audio)){
                unlink(env('PUBLIC_PATH').'audio/' . $data->audio);
            }
            if(file_exists(env('PUBLIC_PATH').'audio/' . $data->audio)){
                unlink(env('PUBLIC_PATH').'audio/' . $data->audio);
            }
        }
        $data->audio = NULL;
        $data->save();
        return response('Audio Delete Successful.');
    }

  public function poststatus($id){
    $data = PostModel::find($id);
    if($data->status == '1'){
      $data->status = '0';
      $data->save();
      return 'Success';
    }else if($data->status == '0'){
      $data->status = '1';
      $data->save();
      return 'Success';
    }
    return 'Not success';
  }

  public function globalpost($id){
    $data = PostModel::find($id);
    if($data->global_post == '1'){
      $data->global_post = '0';
      $data->save();
      return 'Success';
    }else if($data->global_post == '0'){
      $data->global_post = '1';
      $data->save();
      return 'Success';
    }
    return 'Not success';
  }

}
