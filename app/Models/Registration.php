<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Applicant;
use App\Models\Offender;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Registration extends Model
{
    use HasFactory;
    protected $fillable = [
        'registration_id',
        'register_by',
        'transaction_amount',
        'tansaction_date',
        'is_active',
    ];

    protected $dates = ['tansaction_date'];

    public function user()
    {
        return $this->belongsTo(User::class, 'register_by', 'id');
    }

    public function discussions()
    {
        return $this->hasMany(Discussion::class, 'registration_id');
    }
    public function releases()
    {
        return $this->hasOne(Release::class);
    }

    public function transaction_nature()
    {
        return $this->hasMany(TransactionNature::class, 'registration_id');
    }

    public function transaction_purpose()
    {
        return $this->hasMany(TransactionPurpose::class, 'registration_id');
    }

    public function transaction_proofss()
    {
        return $this->hasMany(TransactionProof::class, 'registration_id');
    }

    public function applicant()
    {
        return $this->hasMany(Applicant::class, 'registration_id', 'id');
    }

    public function offender()
    {
        return $this->hasMany(Offender::class, 'registration_id', 'id');
    }

    //applicants section

    public function getApplicantsNamesAttribute()
    {
        return $this->applicant->pluck('full_name')->implode(', ');
    }

    public function getApplicantsLocalGovernmentsAttribute()
    {
        $applicants =  $this->applicant;
        //  dd(count($applicants));
        // echo count($applicants);
        if (count($applicants) > 0) {
            // dd('true');

            foreach ($applicants as $application) {
                $localGovernmentNames[] = $application->local_government->name ?? 'नखुलेको';
            }
            $commaSeparatedString = implode(',', $localGovernmentNames);

            return $commaSeparatedString;
        } else {
           //  dd('false');
            return "null";
        }
    }

    public function getApplicantsWadasAttribute()
    {
        return $this->applicant->pluck('wada_id')->implode(', ');
    }

    public function getApplicantsContactsAttribute()
    {
        return $this->applicant->pluck('contact')->implode(', ');
    }
    // offender sections
    public function getOffendersNamesAttribute()
    {
        return $this->offender->pluck('full_name')->implode(', ');
    }

    public function getOffendersLocalGovernmentsAttribute()
    {
        $offenders =  $this->offender;

        if (count($offenders) > 0) {

            foreach ($offenders as $offender) {
                $localGovernmentNames[] = $offender->local_government->name ?? 'नखुलेको';
            }
            $commaSeparatedString = implode(',', $localGovernmentNames);
            return $commaSeparatedString;
        } else {
            return null;
        }

    }

    public function getOffendersWadasAttribute()
    {
        return $this->offender->pluck('wada_id')->implode(', ');
    }

    public function getOffendersContactsAttribute()
    {
        return $this->offender->pluck('contact')->implode(', ');
    }

    //discussion section
    public function getOffenderDemandAttribute()
    {
        $offenders_demand = $this->discussions->last();

        return $offenders_demand->offender_demand ?? null;
    }

    public function getLastDiscussedDateAttribute()
    {
        $offenders_demand = $this->discussions->last();

        return $offenders_demand->discussion_date ?? null;
    }

    public function getReasonToDisagreementAttribute()
    {
        $offenders_demand = $this->discussions->last();

        return $offenders_demand->reason_to_disagreement ?? null;
    }
    //natures 
    public function getTransactionNaturesAttribute()
    {
        $natures = $this->transaction_nature;

        if (count($natures) > 0) {

            foreach ($natures as $nature) {
                $naturee[] = $nature->nature->title;
            }
            $commaSeparatedString = implode(',', $naturee);
    
            return $commaSeparatedString;

        } else {
            return null;
        }


    }
    //purpose 
    public function getTransactionPurposesAttribute()
    {
        $purposes = $this->transaction_purpose;

        if (count($purposes) > 0) {

            foreach ($purposes as $purpose) {
                $purpos[] = $purpose->purpose->title;
            }
            $commaSeparatedString = implode(',', $purpos);
    
            return $commaSeparatedString;

        } else {
            return null;
        }

    }

    //proof 
    public function getTransactionProofAttribute()
    {
        $this->transaction_proofss;
        $proofs = $this->transaction_proofss;

        if (count($proofs) > 0) {

            foreach ($proofs as $proof) {
                $proofes[] = $proof->proof->title;
            }
            $commaSeparatedString = implode(',', $proofes);
    
            return $commaSeparatedString;

        } else {
            return null;
        }


    }

    public function getTransactionProofAmountAttribute()
    {
        return $this->transaction_proofss->pluck('amount')->implode(', ');
    }

    // Releases

    public function getNoTransactionPurposeAttribute()
    {
        // dd($this->releases);
        // return $this->releases->noTransactionPurpose->pluck('title');
        if ($this->releases) {
            $this->releases->load('noTransactionPurpose');
            if ($this->releases->noTransactionPurpose) {
                return $this->releases->noTransactionPurpose->title;
            }
        }
        return null;
    }

    //NATURE_ID 1 == CASH

    public function getApplicantReceiveOnReleaseCashAttribute()
    {
        if (isset($this->releases) && $this->releases->applicantRecive) {
            $applicantReceiveRecords = $this->releases->applicantRecive;
            $amounts = [];

            foreach ($applicantReceiveRecords as $applicantReceive) {
                if ($applicantReceive->nature_id === 1) {
                    $amounts[] = $applicantReceive->amount;
                }
            }
            return array_sum($amounts);
        }
    }



    //NATURE_ID 2 == CHEQUE

    public function getApplicantReceiveOnReleaseChequeAttribute()
    {

        if (isset($this->releases) && $this->releases->applicantRecive) {
            $applicantReceiveRecords = $this->releases->applicantRecive;
            $amounts = [];

            foreach ($applicantReceiveRecords as $applicantReceive) {
                if ($applicantReceive->nature_id === 2) {
                    $amounts[] = $applicantReceive->amount;
                }
            }
            return array_sum($amounts);
        }
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
        $totalBigha += floor($totalKattha / 20);
        $totalKattha %= 20;
        $totalBigha += floor($totalDhur / 400);
        $totalDhur %= 400;

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

    // NATURE_ID 4 = LAND 

    public function getApplicantReceiveOnReleaseLandAttribute()
    {
        if (isset($this->releases) && $this->releases->applicantRecive) {
            $applicantReceiveRecords = $this->releases->applicantRecive;
            $measurements = [];

            foreach ($applicantReceiveRecords as $applicantReceive) {
                if ($applicantReceive->nature_id === 4) {
                    $measurements[] = $applicantReceive->amount;
                }
            }

            return $this->calculateTotalLand($measurements);
        }
    }

    public function getApplicantReceiveOnReleaseKittaAttribute()
    {
        if (isset($this->releases) && $this->releases->applicantRecive) {
            $applicantReceiveRecords = $this->releases->applicantRecive;
            $amounts = [];

            foreach ($applicantReceiveRecords as $applicantReceive) {
                if ($applicantReceive->nature_id === 4) {
                    $amounts[] = $applicantReceive->kitta;
                }
            }
            return array_sum($amounts);
        }
    }

    //NATURE_ID 8 == OTHERS

    public function getApplicantReceiveOnReleaseOtherNatureAttribute()
    {
        if (isset($this->releases) && $this->releases->applicantRecive) {
            $applicantReceiveRecords = $this->releases->applicantRecive;
            $amounts = [];

            foreach ($applicantReceiveRecords as $applicantReceive) {
                if ($applicantReceive->nature_id === 8) {
                    $amounts[] = $applicantReceive->amount;
                }
            }
            return array_sum($amounts);
        }
    }

    public function getApplicantReceiveOnReleaseOtherAmount()
    {
        $applicantReciveRecords = $this->releases->applicantRecive;

        foreach ($applicantReciveRecords as $applicantRecive) {
            if ($applicantRecive->nature_id === 8) {
                return $applicantRecive->amount;
            }
        };
    }


    // OFFENDER REFUND ON RELEASE

    // NATURE_ID 1 = CASH 
    public function getOffenderRefundOnReleaseCashAttribute()
    {
        if (isset($this->releases) && $this->releases->offenderRefund) {
            $offenderRefundRecords = $this->releases->offenderRefund;
            $amounts = [];

            foreach ($offenderRefundRecords as $offenderRefund) {
                if ($offenderRefund->nature_id === 1) {
                    $amounts[] = $offenderRefund->amount;
                }
            }
            return array_sum($amounts);
        }
    }

    // NATURE_ID 2 = CHEQUE

    public function getOffenderRefundOnReleaseChequeAttribute()
    {
        if (isset($this->releases) && $this->releases->offenderRefund) {
            $offenderRefundRecords = $this->releases->offenderRefund;
            $amounts = [];

            foreach ($offenderRefundRecords as $offenderRefund) {
                if ($offenderRefund->nature_id === 2) {
                    $amounts[] = $offenderRefund->amount;
                }
            }
            return array_sum($amounts);
        }
    }

    // NATURE_ID 4 = LAND 
    public function getOffenderRefundOnReleaseLandAttribute()
    {

        if (isset($this->releases) && $this->releases->offenderRefund) {
            $offenderRefundRecords = $this->releases->offenderRefund;
            $measurements = [];

            foreach ($offenderRefundRecords as $offenderRefund) {
                if ($offenderRefund->nature_id === 4) {
                    $measurements[] = $offenderRefund->amount;
                }
            }

            return $this->calculateTotalLand($measurements);
        }

    }

    public function getOffenderRefundOnReleaseKittaAttribute()
    {
        if (isset($this->releases) && $this->releases->offenderRefund) {
            $offenderRefundRecords = $this->releases->offenderRefund;
            $amounts = [];

            foreach ($offenderRefundRecords as $offenderRefund) {
                if ($offenderRefund->nature_id === 4) {
                    $amounts[] = $offenderRefund->kitta;
                }
            }
            return array_sum($amounts);
        }
    }

    // NATURE_ID 5 = TAMASUK

    public function getOffenderRefundOnReleaseTamasukAttribute()
    {

        if (isset($this->releases) && $this->releases->offenderRefund) {
            $offenderRefundRecords = $this->releases->offenderRefund;
            $amounts = [];

            foreach ($offenderRefundRecords as $offenderRefund) {
                if ($offenderRefund->nature_id === 5) {
                    $amounts[] = $offenderRefund->amount;
                }
            }
            return array_sum($amounts);
        }
    }

    // NATURE_ID 6 = GOLD

    public function getOffenderRefundOnReleaseGoldAttribute()
    {
        if (isset($this->releases) && $this->releases->offenderRefund) {
            $offenderRefundRecords = $this->releases->offenderRefund;
            $amounts = [];

            foreach ($offenderRefundRecords as $offenderRefund) {
                if ($offenderRefund->nature_id === 6) {
                    $amounts[] = $offenderRefund->amount;
                }
            }
            return array_sum($amounts);
        }
    }

    // NATURE_ID 7 = SILVER

    public function getOffenderRefundOnReleaseSilverAttribute()
    {
        if (isset($this->releases) && $this->releases->offenderRefund) {
            $offenderRefundRecords = $this->releases->offenderRefund;
            $amounts = [];

            foreach ($offenderRefundRecords as $offenderRefund) {
                if ($offenderRefund->nature_id === 7) {
                    $amounts[] = $offenderRefund->amount;
                }
            }
            return array_sum($amounts);
        }
    }


    //Search queryies
    public function scopeSearch($query, $keyword)
    {
        return $query->where(function ($query) use ($keyword) {
            if (isset($keyword['search_text'])) {

                $query->where('registration_id', 'like', '%' . $keyword['search_text'] . '%')

                    ->orWhereHas('applicant', function ($query) use ($keyword) {
                        $query->where('full_name', 'like', '%' . $keyword['search_text'] . '%')
                            ->orWhereHas('district', function ($query) use ($keyword) {
                                $query->where('name', 'like', '%' . $keyword['search_text'] . '%');
                            })
                            ->orWhereHas('local_government', function ($query) use ($keyword) {
                                $query->where('name', 'like', '%' . $keyword['search_text'] . '%');
                            });
                    })
                    ->orWhereHas('offender', function ($query) use ($keyword) {
                        $query->where('full_name', 'like', '%' . $keyword['search_text'] . '%');
                    });
            }
            $query->when(User::isAdmin(), function ($query) {

                return $query->where('register_by', Auth::user()->id);
            });

            // if (isset($keyword['state_name'])) {
            //     $query->whereHas('user', function ($query) use ($keyword) {
            //         $query->whereHas('state', function ($query) use ($keyword) {
            //             $query->where('name', $keyword['state_name']);
            //         });
            //     });
            // }

            if (isset($keyword['state_name'])) {
                $query->whereHas('user', function ($query) use ($keyword) {
                    $query->whereHas('state', function ($query) use ($keyword) {
                        $query->where('id', $keyword['state_name']);
                    });
                });
            }


            if (isset($keyword['district_name'])) {

                $query->whereHas('user', function ($query) use ($keyword) {
                    $query->whereHas('district', function ($query) use ($keyword) {
                        // dd($keyword);
                        $query->where('name', '=', $keyword['district_name']);
                    });
                });
            }

            if (isset($keyword['nature_type'])) {

                $query->whereHas('transaction_nature', function ($query) use ($keyword) {
                    $query->whereHas('nature', function ($query) use ($keyword) {
                        $query->where('title', $keyword['nature_type']);
                    });
                });
            }

            if (isset($keyword['proof_type'])) {

                $query->whereHas('transaction_proofss', function ($query) use ($keyword) {
                    $query->whereHas('proof', function ($query) use ($keyword) {
                        $query->where('title', 'like', $keyword['proof_type']);
                    });
                });
            }

            if (isset($keyword['purpose_type'])) {

                $query->whereHas('transaction_purpose', function ($query) use ($keyword) {
                    $query->whereHas('purpose', function ($query) use ($keyword) {
                        $query->where('title', $keyword['purpose_type']);
                    });
                });
            }

            if (isset($keyword['no_transaction_purpose'])) {
                $query->whereHas('releases', function ($query) use ($keyword) {
                    $query->whereHas('noTransactionPurpose', function ($query) use ($keyword) {
                        $query->where('title', $keyword['no_transaction_purpose']);
                    });
                });
            }

            // if (isset($keyword['transaction_date'])) {
            //     $query->where('tansaction_date', $keyword['transaction_date']);
            // }

            // $query->orderBy('tansaction_date', 'desc');

            if (isset($keyword['transaction_date_start']) && isset($keyword['transaction_date_end'])) {
                // Use a date range query to filter transactions between the start and end dates.
                $query->whereBetween('tansaction_date', [$keyword['transaction_date_start'], $keyword['transaction_date_end']]);
            }
            
        });
        // $rawquery = $query->dumpRawSql();

        // dd($rawquery);
    }
}
