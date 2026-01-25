<?php

namespace App\Http\ViewComposers;

use App\Models\Banners\BannerModel;
use App\Models\Posts\PostTypeModel;
use Illuminate\Contracts\View\view;
use App\Models\Posts\PostModel;
use App\Models\Settings\SettingModel;
use App\Models\Galleries\VideoGalleryModel;

class FrontpageComposer{

	 public function __construct()
    {
        // Dependencies automatically resolved by service container...
    }

	public function compose(View $view){
		
	}

}
