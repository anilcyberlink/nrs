<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\view;
use App\Models\Posts\PostTypeModel;
use App\Models\Posts\PostModel;
use App\Models\Settings\SettingModel;
use App\Models\Event\EventModel;

class HeaderComposer{

	 public function __construct()
    {
        // Dependencies automatically resolved by service container...
    }

	public function compose(View $view){
		$view->with('navigations', PostTypeModel::where(['is_menu'=>'1'])
			->orderBy('ordering','asc')
			->get());
			
	    $view->with('race_events',EventModel::where(['status'=>'1'])
			->orderBy('id','asc')
			->get());
	}

}
