<?php

namespace App\Http\Controllers;

use App\Website;
use App\WebsiteAbout;
use App\WebsiteContact;
use App\WebsiteMenu;
use App\WebsitePage;
use App\WebsitePortfolio;
use App\WebsiteService;
use App\WebsiteSlide;
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
        $this->Website = Website::where('domain', $account)->orWhere('subdomain', $account)->first(['id', 'status', 'title', 'description', 'domain', 'subdomain', 'ga', 'template', 'work_group_id', 'created_at', 'updated_at']);

        unset( $this->Website->title );

        Session::put('work_group', WorkGroup::find($this->Website->work_group_id) );
    }

    public function getPage ($Url)
    {
        $Info = (object) pathinfo($Url);

        if ( strstr($Info->filename, 'google') && $Info->extension == 'html' ) {

            return $this->openGoogleSearchConsole( $Info->basename );
        }

        $Page = WebsitePage::where('url', $Url)->where('website_id', $this->Website->id);

        return $Page->first();
    }

    public function build (Request $request)
    {

        $Url   = '/' . implode('/', $request->segments());
        $Page  = $this->getPage($Url);
        $Build = '';

        $Website    = $this->Website;
        $Menu       = WebsiteMenu::where('website_id', $this->Website->id)->where('status', 1)->orderBy('position', 'ASC')->get();
        $About      = WebsiteAbout::where('website_id', $this->Website->id)->where('status', 1)->first();
        $Services   = WebsiteService::where('website_id', $this->Website->id)->where('status', 1)->get();
        $Portfolios = WebsitePortfolio::where('website_id', $this->Website->id)->where('status', 1)->get();
        $Contact    = WebsiteContact::where('website_id', $this->Website->id)->where('status', 1)->first();
        $Social     = WebsiteSocial::where('website_id', $this->Website->id)->first();

        // Get multiple images
        $SlidersObj = WebsiteSlide::where('website_id', $this->Website->id)->first();
        $Sliders = scandir(public_path('img' . $SlidersObj->pics));

        foreach ($Sliders as $key => $Image) {
            if (is_dir('img' . $SlidersObj->pics . $Image)) {
                unset($Sliders[$key]);
            } else {
                $Sliders[$key] = 'img' . $SlidersObj->pics . $Image;
            }
        }

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

                $Build .= view("website.templates.{$this->Website->template}.{$Json->require}", compact('Website','Menu', 'About', 'Services', 'Portfolios', 'Contact', 'Social', 'Json', 'Sliders'))->render();
            } catch (\Exception $e) {

                $Build .= "Error {$Json->require} msg: {$e->getMessage()} <br>";
            }
        }

        return view("website.templates.{$this->Website->template}.index", compact('Website', 'Build', 'Menu', 'About', 'Services', 'Portfolios', 'Contact', 'Social', 'Json', 'Sliders'))->render();
    }

    public function sendMail (Request $request)
    {

        $Validation = $this->validate($request, [
            'contactName'      => 'required|min:3',
            'contactEmail'     => 'required|email',
            'contactMessage'   => 'required|min:5', ]);

        $Details = (object) $request->all();

        $Mail = new MailController;
        $Send = $Mail->Send(
            [   'Title' => $request->contactSubject ?: 'Sem título',
                'To'    => env('SMTP_USERNAME', 'kelvin.developer@icloud.com'),
                'name'  => $request->contactName,
                'request'   =>  $Details,
                'Website'   =>  $this->Website], 'website');

        if ($Send) {
            return response()->json(['status' => true]);
        }

        return response()->json(['status' => false]);
    }

    private function openGoogleSearchConsole ($file)
    {
        if ( file_exists( public_path( $this->Website->domain ) . '/' . $file ) ) {

            echo file_get_contents(public_path( $this->Website->domain ) . '/' . $file );
            exit;
        }

        abort(404);
    }
}
