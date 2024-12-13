<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\State;
use App\Models\District;
use App\Models\LocalGovernment;
use App\Models\Proof;
use App\Models\Purpose;
use Yajra\DataTables\Html\Builder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
//     public function boot(): void
//     {
//         Schema::defaultStringLength(191);
//         Paginator::useBootstrap();
//         Builder::useVite();

//         View::composer('*', function ($view) {
//             $view->with('getStateName', function ($stateId) {
//                 return $this->getName($stateId, State::class);
//             });

//             $view->with('getDistrictName', function ($districtId) {
//                 return $this->getName($districtId, District::class);
//             });

//             $view->with('getLocalName', function ($localId) {
//                 return $this->getName($localId, LocalGovernment::class);
//             });

//             $view->with('getProofName', function ($proofId) {
//                 return $this->getName($proofId, Proof::class);
//             });

//             $view->with('getPurposeName', function ($purposeId) {
//                 return $this->getName($purposeId, Purpose::class);
//             });
//         });
//     }

//     /**
//      * Get name(s) based on ID(s) and model class.
//      *
//      * @param mixed $id
//      * @param string $class
//      * @return mixed
//      */
//     private function getName($id, $class)
//     {
//         if (is_array($id)) {
//             $items = $class::whereIn('id', $id)->pluck('name')->toArray();
//             return implode(', ', $items);
//         } else {
//             // Handle the case when $id is a string
//             if (!empty($id)) {
//                 $item = $class::find($id);
//                 return $item ? $item->name : '';
//             } else {
//                 return '';
//             }
//         }
//     }
 }