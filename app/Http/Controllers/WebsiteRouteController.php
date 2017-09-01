<?php

namespace App\Http\Controllers;

use App\Website;
use App\WebsiteAbout;
use App\WebsiteContact;
use App\WebsiteMenu;
use App\WebsitePage;
use App\WebsitePortfolio;
use App\WebsiteService;
use App\WebsiteSocial;
use App\WorkGroup;
use App\WorkGroupUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class WebsiteRouteController extends Controller
{
    public $Website;

    public function __construct(Request $request)
    {
        $account = $request->route()->parameter('account');
        $this->Website = Website::where('domain', $account)->orWhere('subdomain', $account)->first();

        unset( $this->Website->title );

        $WorkGroup = WorkGroupUser::where('id', $this->Website->id )->first();
        Session::put('work_group', WorkGroup::find($WorkGroup->work_group_id) );
    }

    public function getPage ($Url) {

        $Page = WebsitePage::where('url', $Url)->where('website_id', $this->Website->id);

        return $Page->first();
    }

    public function build (Request $request)
    {

        $Url   = '/' . implode('/', $request->segments());
        $Page  = $this->getPage($Url);
        $Build = '';

        $Website    = $this->Website;
        $Menu       = WebsiteMenu::where('website_id', $this->Website->id)->where('status', 1)->get();
        $About      = WebsiteAbout::where('website_id', $this->Website->id)->where('status', 1)->first();
        $Services   = WebsiteService::where('website_id', $this->Website->id)->where('status', 1)->get();
        $Portfolios = WebsitePortfolio::where('website_id', $this->Website->id)->where('status', 1)->get();
        $Contact    = WebsiteContact::where('website_id', $this->Website->id)->where('status', 1)->first();
        $Social     = WebsiteSocial::where('website_id', $this->Website->id)->first();

        unset( $About->title, $Page->title );

        $Contents = preg_split('/\n|\r\n?/', $Page->content);

        foreach ($Contents as $Content) {

            $Json = json_decode( $Content );

            if (! $Json) {

                $Build .= $Content;
                continue;
            }

            if (! is_object($Json)) continue;

            try {

                $Build .= view("website.templates.{$this->Website->template}.{$Json->require}", compact('Website','Menu', 'About', 'Services', 'Portfolios', 'Contact', 'Social', 'Json'))->render();
            } catch (\Exception $e) {

                $Build .= "Error {$Json->require} msg: {$e->getMessage()} <br>";
            }
        }

        return view("website.templates.{$this->Website->template}.index", compact('Website', 'Build'))->render();
    }
}
