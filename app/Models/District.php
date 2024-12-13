<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function localGovernments()
    {
        return $this->hasMany(LocalGovernment::class);
    }

    /**
     * Getting the users belonging to this district.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    //dynamic function 

    //issue in the code (0=>no, 1=>yes) && release_criteria (	0=>no transaction, 1=>transaction)
    //get sum of issue in the code 
    public function getSumOfIssueInCourtByIssueTypeAndReleaseCriteriaAttribute($release_criteria_id, $issue_in_court)
    {
        $district_id = $this->id;
        return Release::whereHas('registrations.user', function ($query) use ($district_id, $release_criteria_id, $issue_in_court) {
            $query->where('district_id', $district_id);
        })->where('release_criteria', $release_criteria_id)->where('issue_in_court', '=', $issue_in_court)->count();
    }


    public function getSumOfApplicantReceivedByNature($release_criteria_id, $nature_id = 1)
    {
        $district_id = $this->id;


        $releases = Release::whereHas('registrations.user', function ($query) use ($district_id, $nature_id) {
            $query->where('district_id', $district_id);
        })
            ->where('release_criteria', $release_criteria_id)
            ->withSum(['applicantRecive' => function ($query) use ($nature_id) {
                $query->where('nature_id', $nature_id);
            }], 'amount')
            ->first();
        return $releases->applicant_recive_sum_amount ?? 0;
    }

    public function getTotalSumOfApplicantReceived($release_criteria_id)
    {
        $district_id = $this->id;


        $releases = Release::whereHas('registrations.user', function ($query) use ($district_id, $release_criteria_id) {
            $query->where('district_id', $district_id);
        })
            ->where('release_criteria', $release_criteria_id)
            ->withSum(['applicantRecive' => function ($query) {
                $query->whereHas('nature', function ($query) {
                    $query->where('type', '=', 'cash');
                });
            }], 'amount')
            ->first();
        return $releases->applicant_recive_sum_amount ?? 0;
    }

    public function getTotalNoOfOffenderDemandNotReveal()
    {
        $district_id = $this->id;

        return Discussion::whereHas('registrations.user', function ($query) use ($district_id) {
            $query->where('district_id', $district_id);
        })
            ->where('offender_demand_reveal', '=', 'no')
            ->whereIn('id', function ($subquery) {
                $subquery->selectRaw('MAX(id)')
                    ->from('discussions')
                    ->groupBy('registration_id');
            })
            ->count();
    }

    public function getTotalSumOfOffenderDemand()
    {
        $district_id = $this->id;

        return Discussion::whereHas('registrations.user', function ($query) use ($district_id) {
            $query->where('district_id', $district_id);
        })
            ->where('offender_demand_reveal', '=', 'no')
            ->whereIn('id', function ($subquery) {
                $subquery->selectRaw('MAX(id)')
                    ->from('discussions')
                    ->groupBy('registration_id');
            })
            ->sum('offender_demand');
    }

    public function getTotalSumOfApplicantLand($release_criteria_id)
    {
        $district_id = $this->id;
        //dd($district_id);

        $amount = ApplicantReciveOnRelease::whereHas('releases', function ($query) use ($district_id, $release_criteria_id) {
            $query->whereHas('registrations.user', function ($query) use ($district_id) {
                $query->where('district_id', $district_id);
            })
            ->where('release_criteria', $release_criteria_id);
        })
        ->whereHas('nature', function ($query) {
            $query->where('type', '=', 'land');
        })
        ->pluck('amount')
        ->toArray();
        if(isset($amount) && count($amount) > 0){
            $total_land = $this->calculateTotalLand($amount);
        }
        return $total_land ?? 0;
    }

    public function getTotalSumOfApplicantLandKitta($release_criteria_id)
    {

        $district_id = $this->id;
        //dd($district_id);

        $amount = ApplicantReciveOnRelease::whereHas('releases', function ($query) use ($district_id, $release_criteria_id) {
            $query->whereHas('registrations.user', function ($query) use ($district_id) {
                $query->where('district_id', $district_id);
            })
            ->where('release_criteria', $release_criteria_id);
        })
        ->whereHas('nature', function ($query) {
            $query->where('type', '=', 'land');
        })
        ->pluck('kitta')
        ->toArray();
        if (isset($amount) && count($amount) > 0) {
            $total_kitta = array_sum($amount);
        } 
        return $total_kitta ?? 0;
    }

    public function getTotalSumOfOffenderLand($release_criteria_id)
    {
        $district_id = $this->id;
        //dd($district_id);

        $amount = OffenderRefundOnRelease::whereHas('releases', function ($query) use ($district_id, $release_criteria_id) {
            $query->whereHas('registrations.user', function ($query) use ($district_id) {
                $query->where('district_id', $district_id);
            })
            ->where('release_criteria', $release_criteria_id);
        })
        ->whereHas('nature', function ($query) {
            $query->where('type', '=', 'land');
        })
        ->pluck('amount')
        ->toArray();
        if(isset($amount) && count($amount) > 0){

            $total_land = $this->calculateTotalLand($amount);
        }
        return $total_land ?? 0;
    }

    public function getTotalSumOfOffenderLandKitta($release_criteria_id)
    {
        $district_id = $this->id;


        $amount = OffenderRefundOnRelease::whereHas('releases', function ($query) use ($district_id, $release_criteria_id) {
            $query->whereHas('registrations.user', function ($query) use ($district_id) {
                $query->where('district_id', $district_id);
            })
            ->where('release_criteria', $release_criteria_id);
        })
        ->whereHas('nature', function ($query) {
            $query->where('type', '=', 'land');
        })
        ->pluck('kitta')
        ->toArray();
        if (isset($amount) && count($amount) > 0) {
            $total_kitta = array_sum($amount);
        } 
        return $total_kitta ?? 0;
    }

    public function getSumOfOffenderReturnByNature($release_criteria_id, $nature_id)
    {
        $district_id = $this->id;

        $releases = Release::whereHas('registrations.user', function ($query) use ($district_id, $nature_id) {
            $query->where('district_id', $district_id);
        })
            ->where('release_criteria', $release_criteria_id)
            
            ->withSum(['offenderRefund' => function ($query) use ($nature_id) {
                $query->where('nature_id', $nature_id);
            }], 'amount')->get();
            // ->sum('amount');
        return $releases->sum('offender_refund_sum_amount') ?? 0;
    }

    //releases
    //for notransaction

    public function getNoTransactionReleaseCountAttribute()
    {
        $district_id = $this->id;
        return Release::whereHas('registrations.user', function ($query) use ($district_id) {
            $query->where('district_id', $district_id);
        })->where('release_criteria', '=', 0)->count();
    }


    public function getCountByReasonOfNoTransactions($id)
    {
        $district_id = $this->id;
        return Release::whereHas('registrations.user', function ($query) use ($district_id, $id) {
            $query->where('district_id', $district_id);
        })->where('no_transaction_purpose_id', '=', $id)->count();
    }

    //registration
    //for notransaction
    public function getSumOfTransactionAmountAttribute()
    {
        $district_id = $this->id;
        return Registration::whereHas('user', function ($query) use ($district_id) {
            $query->where('district_id', $district_id);
        })
            ->whereHas('releases', function ($query) {
                $query->where('release_criteria', 0);
            })->sum('transaction_amount');
    }



    // releases with transaction 

    //releases
    public function getWithTransactionReleaseCountAttribute()
    {
        $district_id = $this->id;
        return Release::whereHas('registrations.user', function ($query) use ($district_id) {
            $query->where('district_id', $district_id);
        })->where('release_criteria', '=', 1)->count();
    }
    //registration
    public function getSumOfWithTransactionReleaseCountAttribute()
    {
        $district_id = $this->id;
        return Registration::whereHas('user', function ($query) use ($district_id) {
            $query->where('district_id', $district_id);
        })
            ->whereHas('releases', function ($query) {
                $query->where('release_criteria', 1);
            })->sum('transaction_amount');
    }

    // calculate sum of land
    public function calculateTotalLand($measurements)
    {
        $totalBigha = 0;
        $totalKattha = 0;
        $totalDhur = 0;

        foreach ($measurements as $measurement) {
            $parsed = $this->parseLandMeasurement($measurement);
            $totalBigha += $parsed['bigha'];
            $totalKattha += $parsed['kattha'];
            $totalDhur += $parsed['dhur'];
        }

        // Convert excess kattha and dhur to bigha
        // $totalBigha += floor($totalKattha / 20);
        // $totalKattha %= 20;
        // $totalBigha += floor($totalDhur / 400);
        // $totalDhur %= 400;
            // Convert excess kattha and dhur to bigha
        $totalKattha += floor($totalDhur / 20);
        $totalDhur %= 20;
        $totalBigha += floor($totalKattha / 20);
        $totalKattha %= 20;

        return "$totalBigha-$totalKattha-$totalDhur";
    }

    public function parseLandMeasurement($measurement)
    {
        list($bigha, $kattha, $dhur) = explode('-', $measurement);
        return [
            'bigha' => (int)$bigha,
            'kattha' => (int)$kattha,
            'dhur' => (int)$dhur,
        ];
    }
    //R-5

    public function getTotalRegistrationCountAttribute()
    {
        $district_id = $this->id;
        return Registration::whereHas('user', function ($query) use ($district_id) {
            $query->where('district_id', $district_id);
        })->count();
    }
    
    public function getTotalUnderDiscussionCountAttribute()
    {
        $district_id = $this->id;

        return Discussion::whereHas('registrations.user', function ($query) use ($district_id) {
            $query->where('district_id', $district_id);
        })
        ->whereHas('registrations', function ($query) {
            $query->where('is_active', '=', 0);
        })
        ->distinct()
        ->count('registration_id');
    }
    
    public function getSumOfIssueInCourtButReleasedAttribute($issue_in_court=1)
    {
        $district_id = $this->id;
        return Release::whereHas('registrations.user', function ($query) use ($district_id, $issue_in_court) {
            $query->where('district_id', $district_id);
        })->where('issue_in_court', '=', 1)->count();
    }

    public function getSumOfCollectiveTransactionAmountAttribute()
    {
        $district_id = $this->id;
        return Registration::whereHas('user', function ($query) use ($district_id) {
            $query->where('district_id', $district_id);
        })
            ->whereHas('releases', function ($query) {
            })->sum('transaction_amount');
    }



    //FOR TOTAL COUNT 

    public function getTotalSumOfTransactionAmountStateAttribute()
    {
        $state_id = $this->state_id;
        
        // Retrieve all districts for the state
        $districts = self::where('state_id', $state_id)->get();
        
        $totalSumOfTransactionAmount = 0;

        // Sum up the transaction amounts for all districts in the state
        foreach ($districts as $district) {
            $totalSumOfTransactionAmount += $district->sumOfTransactionAmount;
        }

        return $totalSumOfTransactionAmount;
    }

    public static function getGrandTotalSumOfTransactionAmount()
    {
        $districts = self::all();

        $grandTotalSumOfTransactionAmount = 0;

        // Sum up the transaction amounts for all districts across all states
        foreach ($districts as $district) {
            $grandTotalSumOfTransactionAmount += $district->sumOfTransactionAmount;
        }

        return $grandTotalSumOfTransactionAmount;
    }














    public function getTotalSumOfWithTransactionReleaseCountStateAttribute()
    {
        $state_id = $this->state_id;
        
        // Retrieve all districts for the state
        $districts = self::where('state_id', $state_id)->get();
        
        $totalSumOfWithTransactionReleaseCount = 0;

        // Sum up the counts for all districts in the state
        foreach ($districts as $district) {
            $totalSumOfWithTransactionReleaseCount += $district->sumOfWithTransactionReleaseCount;
        }

        return $totalSumOfWithTransactionReleaseCount;
    }


    // Add this method to your District model
    public function getTotalSumOfIssueInCourtByIssueTypeAndReleaseCriteriaStateAttribute($release_criteria_id, $issue_in_court)
    {
        $state_id = $this->state_id;
        
        // Retrieve all districts for the state
        $districts = self::where('state_id', $state_id)->get();
        
        $totalSumOfIssueInCourt = 0;

        // Sum up the counts by issue type and release criteria for all districts in the state
        foreach ($districts as $district) {
            $totalSumOfIssueInCourt += $district->getSumOfIssueInCourtByIssueTypeAndReleaseCriteriaAttribute($release_criteria_id, $issue_in_court);
        }

        return $totalSumOfIssueInCourt;
    }


    public function getTotalRegistrationStateCountAttribute()
    {
        $state_id = $this->state_id;
        
        // Retrieve all districts for the state
        $districts = self::where('state_id', $state_id)->get();
        
        $totalRegistrationCount = 0;

        // Sum up the registration counts for all districts
        foreach ($districts as $district) {
            $totalRegistrationCount += $district->getTotalRegistrationCountAttribute();
        }

        return $totalRegistrationCount;
    }


    public function getTotalUnderDiscussionStateCountAttribute()
    {
        $state_id = $this->state_id;

        // Retrieve all districts for the state
        $districts = self::where('state_id', $state_id)->get();
        
        $totalUnderDiscussionCount = 0;

        // Sum up the under discussion counts for all districts
        foreach ($districts as $district) {
            $totalUnderDiscussionCount += $district->getTotalUnderDiscussionCountAttribute();
        }

        return $totalUnderDiscussionCount;
    }

    public function getTotalNoTransactionReleaseStateCountAttribute()
    {
        $state_id = $this->state_id;

        // Retrieve all districts for the state
        $districts = self::where('state_id', $state_id)->get();
        
        $totalNoTransactionReleaseCount = 0;

        // Sum up the no transaction release counts for all districts
        foreach ($districts as $district) {
            $totalNoTransactionReleaseCount += $district->getNoTransactionReleaseCountAttribute();
        }

        return $totalNoTransactionReleaseCount;
    }

    public function getWithTransactionReleaseStateCountAttribute()
    {
        $state_id = $this->state_id;
        
        // Retrieve all districts for the state
        $districts = self::where('state_id', $state_id)->get();
        
        $totalWithTransactionReleaseCount = 0;
    
        // Sum up the with transaction release counts for all districts
        foreach ($districts as $district) {
            $totalWithTransactionReleaseCount += $district->getWithTransactionReleaseCountAttribute();
        }
    
        return $totalWithTransactionReleaseCount;
    }

    public function getSumOfIssueInCourtButReleasedStateAttribute($issue_in_court = 1)
    {
        $state_id = $this->state_id;
        
        // Retrieve all districts for the state
        $districts = self::where('state_id', $state_id)->get();
        
        $totalIssueInCourtButReleasedCount = 0;

        // Sum up the issue in court but released counts for all districts
        foreach ($districts as $district) {
            $totalIssueInCourtButReleasedCount += $district->getSumOfIssueInCourtButReleasedAttribute($issue_in_court);
        }

        return $totalIssueInCourtButReleasedCount;
    }

    public function getSumOfCollectiveTransactionAmountStateAttribute()
    {
        $state_id = $this->state_id;
        
        // Retrieve all districts for the state
        $districts = self::where('state_id', $state_id)->get();
        
        $totalCollectiveTransactionAmount = 0;

        // Sum up the collective transaction amounts for all districts
        foreach ($districts as $district) {
            $totalCollectiveTransactionAmount += $district->getSumOfCollectiveTransactionAmountAttribute();
        }

        return $totalCollectiveTransactionAmount;
    }

    public function getCountByReasonOfNoTransactionsStateAttribute($id)
    {
        $state_id = $this->state_id;
        
        // Retrieve all districts for the state
        $districts = self::where('state_id', $state_id)->get();
        
        $totalCountByReason = 0;

        // Sum up the counts by reason for all districts
        foreach ($districts as $district) {
            $totalCountByReason += $district->getCountByReasonOfNoTransactions($id);
        }

        return $totalCountByReason;
    }


    public function getTotalNoOfOffenderDemandNotRevealStateAttribute()
    {
        $state_id = $this->state_id;

        // Retrieve all districts for the state
        $districts = self::where('state_id', $state_id)->get();

        $totalCountNoDemandNotReveal = 0;

        // Sum up the counts for all districts
        foreach ($districts as $district) {
            $totalCountNoDemandNotReveal += $district->getTotalNoOfOffenderDemandNotReveal();
        }

        return $totalCountNoDemandNotReveal;
    }

    public function getTotalSumOfOffenderDemandStateAttribute()
    {
        $state_id = $this->state_id;

        // Retrieve all districts for the state
        $districts = self::where('state_id', $state_id)->get();

        $totalSumOfOffenderDemand = 0;

        // Sum up the sums for all districts
        foreach ($districts as $district) {
            $totalSumOfOffenderDemand += $district->getTotalSumOfOffenderDemand();
        }

        return $totalSumOfOffenderDemand;
    }

    public function getSumOfApplicantReceivedByNatureState($release_criteria_id, $nature_id = 1)
    {
        $state_id = $this->state_id;

        // Retrieve all districts for the state
        $districts = self::where('state_id', $state_id)->get();

        $totalSumOfApplicantReceivedByNature = 0;

        // Sum up the sums for all districts
        foreach ($districts as $district) {
            $totalSumOfApplicantReceivedByNature += $district->getSumOfApplicantReceivedByNature($release_criteria_id, $nature_id);
        }

        return $totalSumOfApplicantReceivedByNature;
    }

    public function getTotalSumOfApplicantReceivedState($release_criteria_id)
    {
        $state_id = $this->state_id;

        // Retrieve all districts for the state
        $districts = self::where('state_id', $state_id)->get();

        $totalSumOfApplicantReceived = 0;

        // Sum up the sums for all districts
        foreach ($districts as $district) {
            $totalSumOfApplicantReceived += $district->getTotalSumOfApplicantReceived($release_criteria_id);
        }

        return $totalSumOfApplicantReceived;
    }

    public function getTotalSumOfApplicantLandState($release_criteria_id)
    {
        $state_id = $this->state_id;
        
        // Retrieve all districts for the state
        $districts = self::where('state_id', $state_id)->get();
        
        $totalSumOfApplicantLand = '0-0-0'; // Initialize with default value

        // Sum up the sums for all districts
        foreach ($districts as $district) {
            $totalSumOfApplicantLand = $this->addLandMeasurements($totalSumOfApplicantLand, $district->getTotalSumOfApplicantLand($release_criteria_id));
        }

        return $totalSumOfApplicantLand;
    }

    // Function to add two land measurements together
    // Function to add two land measurements together
    private function addLandMeasurements($measurement1, $measurement2)
    {
        // Initialize default values
        $defaultBigha = 0;
        $defaultKattha = 0;
        $defaultDhur = 0;

        // Parse the first measurement or use default values if it's not set or invalid
        if ($measurement1) {
            list($bigha1, $kattha1, $dhur1) = explode('-', $measurement1);
        } else {
            $bigha1 = $defaultBigha;
            $kattha1 = $defaultKattha;
            $dhur1 = $defaultDhur;
        }

        // Parse the second measurement or use default values if it's not set or invalid
        if ($measurement2) {
            list($bigha2, $kattha2, $dhur2) = explode('-', $measurement2);
        } else {
            $bigha2 = $defaultBigha;
            $kattha2 = $defaultKattha;
            $dhur2 = $defaultDhur;
        }

        // Calculate the total land measurements
        $totalBigha = $bigha1 + $bigha2;
        $totalKattha = $kattha1 + $kattha2;
        $totalDhur = $dhur1 + $dhur2;

        // Convert excess kattha and dhur to bigha
        // $totalBigha += floor($totalKattha / 20);
        // $totalKattha %= 20;
        // $totalBigha += floor($totalDhur / 400);
        // $totalDhur %= 400;

            // Convert excess kattha and dhur to bigha
        $totalKattha += floor($totalDhur / 20);
        $totalDhur %= 20;
        $totalBigha += floor($totalKattha / 20);
        $totalKattha %= 20;
        return "$totalBigha-$totalKattha-$totalDhur";
    }

    public function getTotalSumOfApplicantLandKittaState($release_criteria_id)
    {
        $state_id = $this->state_id;

        // Retrieve all districts for the state
        $districts = self::where('state_id', $state_id)->get();

        $totalSumOfApplicantLandKitta = 0;

        // Sum up the sums for all districts
        foreach ($districts as $district) {
            $totalSumOfApplicantLandKitta += $district->getTotalSumOfApplicantLandKitta($release_criteria_id);
        }

        return $totalSumOfApplicantLandKitta;
    }

    public function getSumOfOffenderReturnByNatureState($release_criteria_id, $nature_id)
    {
        $state_id = $this->state_id;

        // Retrieve all districts for the state
        $districts = self::where('state_id', $state_id)->get();

        $totalSumOfOffenderReturnByNature = 0;

        // Sum up the sums for all districts
        foreach ($districts as $district) {
            $totalSumOfOffenderReturnByNature += $district->getSumOfOffenderReturnByNature($release_criteria_id, $nature_id);
        }

        return $totalSumOfOffenderReturnByNature;
    }

    public function getTotalSumOfOffenderLandState($release_criteria_id)
    {
        $state_id = $this->state_id;

        // Retrieve all districts for the state
        $districts = self::where('state_id', $state_id)->get();

        $totalSumOfOffenderLand = '0-0-0'; // Initialize with zero land measurement

        // Sum up the land measurements for all districts
        foreach ($districts as $district) {
            $totalSumOfOffenderLand = $this->addLandMeasurements(
                $totalSumOfOffenderLand,
                $district->getTotalSumOfOffenderLand($release_criteria_id)
            );
        }

        return $totalSumOfOffenderLand;
    }

    public function getTotalSumOfOffenderLandKittaState($release_criteria_id)
    {
        $state_id = $this->state_id;

        // Retrieve all districts for the state
        $districts = self::where('state_id', $state_id)->get();

        $totalSumOfOffenderLandKitta = 0;

        // Sum up the kitta measurements for all districts
        foreach ($districts as $district) {
            $totalSumOfOffenderLandKitta += $district->getTotalSumOfOffenderLandKitta($release_criteria_id);
        }

        return $totalSumOfOffenderLandKitta;
    }


    // FOR GRAND TOTAL 

    public static function getGrandTotalRegistrationCountForStates()
    {
        $districts = self::all();

        $grandTotalRegistrationCount = 0;

        foreach ($districts as $district) {
            $grandTotalRegistrationCount += $district->getTotalRegistrationCountAttribute();
        }

        return $grandTotalRegistrationCount;
    }

    public static function getGrandTotalUnderDiscussionCountForStates()
    {
        $districts = self::all();

        $grandTotalUnderDiscussionCount = 0;

        foreach ($districts as $district) {
            $grandTotalUnderDiscussionCount += $district->getTotalUnderDiscussionCountAttribute();
        }

        return $grandTotalUnderDiscussionCount;
    }

    public static function getGrandTotalNoTransactionReleaseCountForStates()
    {
        $districts = self::all();

        // dd($districts);

        $grandTotalNoTransactionReleaseCount = 0;

        foreach ($districts as $district) {

            $grandTotalNoTransactionReleaseCount += $district->no_transaction_release_count;
        }

        return $grandTotalNoTransactionReleaseCount;
    }

    public static function getGrandTotalWithTransactionReleaseCountForStates()
    {
        $districts = self::all();

        $grandTotalWithTransactionReleaseCount = 0;

        foreach ($districts as $district) {
            $grandTotalWithTransactionReleaseCount += $district->with_transaction_release_count;

            
        }

        return $grandTotalWithTransactionReleaseCount;
    }

    public static function getGrandTotalSumOfIssueInCourtButReleasedForStates()
    {
        $districts = self::all();

        $getGrandTotalSumOfIssueInCourtButRelease = 0;

        foreach ($districts as $district) {
            $getGrandTotalSumOfIssueInCourtButRelease += $district->sumOfIssueInCourtButReleased;
            
        }

        return $getGrandTotalSumOfIssueInCourtButRelease;
    }

    public static function getGrandTotalSumOfCollectiveTransactionAmountForStates()
    {
        $districts = self::all();

        $getGrandTotalSumOfCollectiveTransactionAmount = 0;

        foreach ($districts as $district) {
            $getGrandTotalSumOfCollectiveTransactionAmount += $district->sumOfCollectiveTransactionAmount;
            
        }

        return $getGrandTotalSumOfCollectiveTransactionAmount;
    }


    // Add this method to your District model
    public static function getGrandTotalCountByReasonOfNoTransactions($id)
    {
        $districts = self::all();

        $grandTotalCountByReason = 0;

        foreach ($districts as $district) {
            $grandTotalCountByReason += $district->getCountByReasonOfNoTransactions($id);
        }

        return $grandTotalCountByReason;
    }


    // Add this method to your District model
    public static function getGrandTotalNoOfOffenderDemandNotReveal()
    {
        $districts = self::all();

        $grandTotalNoOfOffenderDemandNotReveal = 0;

        foreach ($districts as $district) {
            $grandTotalNoOfOffenderDemandNotReveal += $district->getTotalNoOfOffenderDemandNotReveal();
        }

        return $grandTotalNoOfOffenderDemandNotReveal;
    }

    // Add this method to your District model
    public static function getGrandTotalSumOfOffenderDemand()
    {
        $districts = self::all();

        $grandTotalSumOfOffenderDemand = 0;

        foreach ($districts as $district) {
            $grandTotalSumOfOffenderDemand += $district->getTotalSumOfOffenderDemand();
        }

        return $grandTotalSumOfOffenderDemand;
    }

    public static function getGrandTotalSumOfApplicantReceivedByNature($release_criteria_id, $nature_id)
    {
        $districts = self::all();

        $grandTotalSumOfApplicantReceived = 0;

        foreach ($districts as $district) {
            $grandTotalSumOfApplicantReceived += $district->getSumOfApplicantReceivedByNature($release_criteria_id, $nature_id);
        }

        return $grandTotalSumOfApplicantReceived;
    }

    // Add this method to your District model
    public static function getGrandTotalSumOfApplicantReceived($release_criteria_id)
    {
        $districts = self::all();

        $grandTotalSumOfApplicantReceived = 0;

        foreach ($districts as $district) {
            $grandTotalSumOfApplicantReceived += $district->getTotalSumOfApplicantReceived($release_criteria_id);
        }

        return $grandTotalSumOfApplicantReceived;
    }


    // public static function getGrandTotalSumOfApplicantLand($release_criteria_id)
    // {
    //     $districts = self::all();
    //     $grandTotalLand = '0-0-0'; // Initialize with default value

    //     foreach ($districts as $district) {
    //         $totalLand = $district->getTotalSumOfApplicantLand($release_criteria_id);
    //         $grandTotalLand = self::addLandMeasurements($grandTotalLand, $totalLand);
    //     }

    //     return $grandTotalLand;
    // }

    public static function getGrandTotalSumOfApplicantLand($release_criteria_id)
    {
        $districts = self::all();
        $grandTotalLand = '0-0-0'; // Initialize with default value

        foreach ($districts as $district) {
            $totalLand = $district->getTotalSumOfApplicantLand($release_criteria_id);
            $grandTotalLand = $district->addLandMeasurements($grandTotalLand, $totalLand);
        }

        return $grandTotalLand;
    }



    public static function getGrandTotalSumOfApplicantLandKittaState($release_criteria_id)
    {
        $districts = self::all();
    
        $grandTotalSumOfKitta = 0;
    
        foreach ($districts as $district) {
            $grandTotalSumOfKitta += $district->getTotalSumOfApplicantLandKitta($release_criteria_id);
        }
    
        return $grandTotalSumOfKitta;
    }

    public static function getGrandTotalSumOfOffenderReturnByNature($release_criteria_id, $nature_id)
    {
        $districts = self::all();

        $grandTotalSumOfOffenderReturn = 0;

        foreach ($districts as $district) {
            $grandTotalSumOfOffenderReturn += $district->getSumOfOffenderReturnByNature($release_criteria_id, $nature_id);
        }

        return $grandTotalSumOfOffenderReturn;
    }

    public static function getGrandTotalSumOfOffenderLandKitta($release_criteria_id)
    {
        $districts = self::all();

        $grandTotalSumOfOffenderLandKitta = 0;

        foreach ($districts as $district) {
            $grandTotalSumOfOffenderLandKitta += $district->getTotalSumOfOffenderLandKitta($release_criteria_id);
        }

        return $grandTotalSumOfOffenderLandKitta;
    }

    // Add this method to your District model
    public static function getGrandTotalSumOfOffenderLandState($release_criteria_id)
    {
        $districts = self::all();
        $grandTotalOffenderLand = '0-0-0'; // Initialize with default value

        foreach ($districts as $district) {
            $totalOffenderLand = $district->getTotalSumOfOffenderLand($release_criteria_id);
            $grandTotalOffenderLand = $district->addLandMeasurements($grandTotalOffenderLand, $totalOffenderLand);
        }

        return $grandTotalOffenderLand;
    }


    public static function getGrandTotalSumOfWithTransactionReleaseCount()
    {
        $districts = self::all();

        $grandTotalSumOfWithTransactionReleaseCount = 0;

        foreach ($districts as $district) {
            $grandTotalSumOfWithTransactionReleaseCount += $district->sumOfWithTransactionReleaseCount;
        }

        return $grandTotalSumOfWithTransactionReleaseCount;
    }

    public static function getGrandTotalSumOfIssueInCourtByIssueTypeAndReleaseCriteria($release_criteria_id, $issue_in_court)
    {
        $districts = self::all();

        $grandTotalSumOfIssueInCourt = 0;

        foreach ($districts as $district) {
            $grandTotalSumOfIssueInCourt += $district->getSumOfIssueInCourtByIssueTypeAndReleaseCriteriaAttribute($release_criteria_id, $issue_in_court);
        }

        return $grandTotalSumOfIssueInCourt;
    }

}
