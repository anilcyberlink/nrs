<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;
use App\Models\Posts\AssociatedPostModel;

class PostModel extends Model
{
    protected $table = 'cl_posts';
    protected $fillable = [
       'audio', 'post_date','post_author','price','template','template','post_title','sub_title','post_content','post_excerpt','uri','uid','page_key','post_type','post_parent','post_order','home_order','thumbnail','icon','page_thumbnail','banner','page_video','meta_keyword','meta_description','associated_title','external_link','post_tags','project_status','status','published','is_active','is_open','is_draft','is_trashed','show_in_home','is_password_protected','is_commentable','lang','post_category'
    ];

    public function associated_posts()
    {
      return $this->hasMany('App\Models\Posts\AssociatedPostModel','post_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Posts\PostCategoryModel','post_category');
    }

     public function portfolio(){
        return $this->belongsToMany('App\Models\Portfolios\PortfolioModel','cl_post_portfolio','post_id','portfolio_id');
    }
}
