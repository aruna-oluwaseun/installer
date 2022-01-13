<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Geocoder\Laravel\ProviderAndDumperAggregator as Geocoder;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    public function index(Request $request, Geocoder $geocode)
    {
        //dd($request->all());
        $query = Company::query();
        $query->selectRaw('companies.*, AVG(IFNULL(reviews.rating,0)) as average_rating')
            ->join('company_service','company_service.company_id','=','companies.id')
            ->leftJoin('reviews', function ($join) {
                $join->on('reviews.company_id', '=', 'companies.id')->where('reviews.status', '=', 'approved');
            });
        $query->active();

        if($service = $request->input('service'))
        {
            if($service != 'all')
            {
                $service = (array) $service; // incase we use multiple select in future
                $query->whereIn('company_service.service_id',$service);
            }
        }

        if($request->exists('s'))
        {
            $search_term = $request->input('s');
            $query->where('companies.title','like', '%'.$search_term.'%');
        }

        if($postcode = $request->input('postcode'))
        {
            $radius = $request->input('radius');

            //dd($radius);

            if($radius != 'all' && $radius !== null)
            {
                // Geocode Postcode
                $geo_data = $geocode->geocode($postcode.', United Kingdom')->get();

                if($geo_data->count())
                {

                    $latitude = $geo_data->first()->getCoordinates()->getLatitude();
                    $longitude = $geo_data->first()->getCoordinates()->getLongitude();

                    $query->selectRaw("(
                          6371 * acos (
                          cos ( radians(".floatval($latitude).") )
                          * cos( radians( companies.gps_lat ) )
                          * cos( radians( companies.gps_lng ) - radians(".floatval($longitude).") )
                          + sin ( radians(".floatval($latitude).") )
                          * sin( radians( companies.gps_lat ) )
                        )
                    ) AS distance");
                    $query->having('distance', '<=', $radius);
                }
                else
                {
                    info('Could not geocode the following postcode in search '.$postcode);
                }
            }
        }

        $query->groupBy('companies.id');
        if($request->exists('sort_by'))
        {
            switch ($request->get('sort_by'))
            {
                case 'relevance' :
                    // do raw order by here
                    break;
                case 'rating' :
                    $query->orderBy('average_rating','DESC');
                    break;
                case 'distance' :
                    if(isset($radius) && isset($geo_data))
                    {
                        if($geo_data->count())
                        {
                            //$query->orderBy('distance','ASC');
                        }
                    }
                    break;
            }
        }
        else
        {
            $query->orderByRaw('average_rating DESC, companies.verified DESC');
        }

        $companies = $query->paginate(30);

        //dd($companies);
        set_active_menu('find-installer');
        set_page_title('Find an installer');
        return view('find-installer',compact(['companies']));
    }


}
