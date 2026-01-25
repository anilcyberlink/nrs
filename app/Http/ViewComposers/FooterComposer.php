<?php

namespace App\Http\ViewComposers;

use App\Models\Posts\PostCategoryModel;
use Illuminate\Contracts\View\view;
use App\Models\Settings\SettingModel;
use App\Models\Posts\PostModel;
use App\Models\Posts\PostTypeModel;

class FooterComposer{

	 public function __construct()
    {
        // Dependencies automatically resolved by service container...
    }

	public function compose(View $view){

		$view->with('navigations', PostTypeModel::where(['is_menu'=>'1'])
			->orderBy('ordering','asc')
			->get());

        $view->with('about',PostModel::where(['post_type'=>'27','status'=>'1'])->take(5)->get());
        $view->with('company',PostModel::where(['post_type'=>'28','status'=>'1'])->orderby('post_order','asc')->take(5)->get());
        $view->with('category',PostCategoryModel::take(5)->get());

		}
}
