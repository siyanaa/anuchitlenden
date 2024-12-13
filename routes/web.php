<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NatureController;
use App\Http\Controllers\PurposeController;
use App\Http\Controllers\OffenderController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\VictimApplicationsController;
use App\Http\Controllers\Admin\HistoriesController;
use App\Http\Controllers\TransactionProofController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\CountController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\LoanGivingVictimController;
use App\Http\Controllers\LoanTakingVictimController;
use App\Http\Controllers\TransactionNatureController;
use App\Http\Controllers\TransactionPurposeController;
use App\Http\Controllers\NoTransactionPurposeController;
use App\Http\Controllers\ProofController;
use App\Http\Controllers\ReleaseController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\UtilityFunctions;
use App\Models\LoanGivingVictim;

use App\Http\Controllers\LandAreaConverterController;

Auth::routes();

Route::get('/', function () {
    return redirect()->route('login');
});


Route::prefix('/admin')->namespace('Admin')->name('admin.')->middleware(['web', 'auth'])->group(function () {

    Route::get('/inactive-registrations', [ReleaseController::class, 'activateRegistrations'])->name('inactive-registrations');


    Route::get('/dashboard', [AdminController::class, 'index'])->name('index');
    Route::post('/import',    [AdminController::class, 'import'])->name('import');
    Route::get('/release_no_transaction',    [AdminController::class, 'generateReleaseCounts'])->name('no_transaction');
    Route::get('/import_index',    [AdminController::class, 'importIndex'])->name('import_index');
    Route::post('/get-notran-data-for-district', [AdminController::class, 'getDataForDistrict'])->name('getDataForDistrict');
    Route::post('/get-offender-refund-data-for-district', [AdminController::class,  'getOffenderRefundDataForDistrict']);

    Route::get('/select-state', [AdminController::class, 'selectState']);
    Route::get('/get-districts/{state}', [AdminController::class, 'getDistrictsByState']);
    Route::get('/get-local-governments/{district}', [AdminController::class, 'getLocalGovernmentsByDistrict']);



    // For Land ARea Converter

    // Route::get('/convert-land-area', [LandAreaConverterController::class, 'convert'])->name('convert-land-area');




    Route::as('count.')->prefix('/count')->name('count.')->group(function () {
        Route::get('/count', [CountController::class, 'index'])->name('index');
        Route::get('/createcount', [CountController::class, 'create'])->name('create');
        Route::get('/edit/{id}', [CountController::class, 'edit'])->name('edit');
        Route::post('/createcount', [CountController::class, 'store'])->name('store');
        Route::post('/update', [CountController::class, 'update'])->name('update');
    });

    Route::as('utilities.')->prefix('/utilities')->name('utilities.')->group(function () {

        //Ajax call
        Route::get('get-districts/{state_id}',              [UtilityFunctions::class, 'getDistricts'])->name('getDistricts');
        Route::get('get-local-governments/{district_id}',   [UtilityFunctions::class, 'getLocalGovernments'])->name('getLocalGovernments');
        Route::get('/search',                               [UtilityFunctions::class, 'search'])->name('search');
        Route::get('/search-district',                      [UtilityFunctions::class, 'searchDistrict'])->name('search.district');
    });


    Route::as('reports.')->prefix('/reports')->name('reports.')->group(function () {
        //R-1
        Route::get('/registrations-details',                [ReportsController::class, 'registrationDetails'])->name('registrations-details'); //R-1 दर्ता उजुरी विवरण जिल्लागत
        Route::get('/registrations-detailsshow',                [ReportsController::class, 'registrationDetailsShow'])->name('registrations-detailsshow'); //R-1 दर्ता उजुरी विवरण जिल्लागत
        Route::Post('/registrations-details',               [ReportsController::class, 'registrationDetails'])->name('registrations-details'); //R-1 दर्ता उजुरी विवरण जिल्लागत

        //R-2
        Route::get('release-details',                       [ReportsController::class, 'releaseDetails'])->name('releaseDetails'); // R-2 फर्छ्यौट उजुरी विवरण
        Route::get('release-detailsshow',                       [ReportsController::class, 'releaseDetailsShow'])->name('releaseDetailsShow'); // R-2 फर्छ्यौट उजुरी विवरण
        Route::Post('release-details',                       [ReportsController::class, 'releaseDetails'])->name('releaseDetails'); // R-2 फर्छ्यौट उजुरी विवरण

        //R-3
        Route::get('integrated-no-transaction-detailsshow',        [ReportsController::class, 'showintrigatedNoTransactionDetails'])->name('integrated_no_transaction_detailsshow'); // R-3 लिनदिननपर्ने फरछयौट एकीकृत

        Route::get('integrated-no-transaction-details',        [ReportsController::class, 'intrigatedNoTransactionDetails'])->name('integrated_no_transaction_details')->middleware(['restrictUser']); // R-3 लिनदिननपर्ने फरछयौट एकीकृत

        Route::Post('integrated-no-transaction-details',       [ReportsController::class, 'intrigatedNoTransactionDetails'])->name('integrated_no_transaction_details')->middleware(['restrictUser']); // R-3 लिनदिननपर्ने फरछयौट एकीकृत

        //R-4
        Route::get('integrated-with-transaction-releases-detailsshow',        [ReportsController::class, 'showintrigatedTransactionDetails'])->name('integrated_with_transaction_detailsshow'); // R-4 लिनदिनपर्ने एकीकृत

        Route::get('integrated-with-transaction-releases-details',        [ReportsController::class, 'intrigatedTransactionDetails'])->name('integrated_with_transaction_details')->middleware(['restrictUser']); // R-4 लिनदिनपर्ने एकीकृत

        Route::Post('integrated-with-transaction-releases-details',       [ReportsController::class, 'intrigatedTransactionDetails'])->name('integrated_with_transaction_details')->middleware(['restrictUser']); // R-4 लिनदिनपर्ने एकीकृत

        //R-5
        Route::get('collectives',                           [ReportsController::class, 'collectives'])->name('collectives')->middleware(['restrictUser']); // r5

        Route::get('collectivesshow',                           [ReportsController::class, 'showCollectives'])->name('collectivesshow'); // r5



        //R-6


        Route::get('agreement-no-implementation-details',      [ReportsController::class, 'agreementNoImplementationDetails'])->name('agreement_no_implementation_details'); // r6
        Route::get('agreement-no-implementation-detailsshow',      [ReportsController::class, 'agreementNoImplementationDetailsShow'])->name('agreement_no_implementation_detailsshow'); // r6
        Route::Post('agreement-no-implementation-details',      [ReportsController::class, 'agreementNoImplementationDetails'])->name('agreement_no_implementation_details'); // r6
        //R-7
        Route::get('no-agreement-on-discussion-details',        [ReportsController::class, 'noAgreementOnDiscussionDetails'])->name('no_agreement_on_discussion_details'); // r7
        Route::get('no-agreement-on-discussion-detailsshow',        [ReportsController::class, 'noAgreementOnDiscussionDetailsShow'])->name('no_agreement_on_discussion_detailsshow'); // r7
        Route::Post('no-agreement-on-discussion-details',        [ReportsController::class, 'noAgreementOnDiscussionDetails'])->name('no_agreement_on_discussion_details'); // r7
        //R-8
        Route::get('under-discussion-details',        [ReportsController::class, 'underDiscussionDetails'])->name('under_discussion_details'); // r8
        Route::get('under-discussion-detailsshow',        [ReportsController::class, 'underDiscussionDetailsShow'])->name('under_discussion_detailsshow'); // r8
        Route::Post('under-discussion-details',        [ReportsController::class, 'underDiscussionDetails'])->name('under_discussion_details'); // r8

        //R-2
        Route::get('release-details',                       [ReportsController::class, 'releaseDetails'])->name('releaseDetails'); // R-2 फर्छ्यौट उजुरी विवरण
        Route::Post('release-details',                      [ReportsController::class, 'releaseDetails'])->name('releaseDetails'); // R-2 फर्छ्यौट उजुरी विवरण


        // EXPORTS
        Route::get('/export/registration_details', [ReportsController::class, 'exportRegistrationDetails'])->name('export_registration_details');
        Route::get('/export/release_details', [ReportsController::class, 'exportReleaseDetails'])->name('export_release_details');
        Route::get('/export/agreement_no_implementation_details', [ReportsController::class, 'exportAgreementNoImplementationDetails'])->name('export_agreement_no_implementation_details');
        Route::get('/export/no_agreement_on_discussion_details', [ReportsController::class, 'exportNoAgreementOnDiscussionDetails'])->name('export_no_agreement_on_discussion_details');
        Route::get('/export/under_discussion_details', [ReportsController::class, 'exportUnderDiscussionDetails'])->name('export_under_discussion_details');
        Route::get('/export/collective_details', [ReportsController::class, 'exportCollectiveDetails'])->name('export_collective_details');
        Route::get('/export/integrated_no_transaction_details', [ReportsController::class, 'exportIntrigatedNoTransactionDetails'])->name('export_integrated_no_transaction_details');
        Route::get('/export/integrated_transaction_needed_details', [ReportsController::class, 'exportIntrigatedTransactionNeededDetails'])->name('export_integrated_transaction_needed_details');

        // Route::get('export-registration-details', 'ReportsController@exportRegistrationDetails')->name('export_registration_details');

        Route::get('/clear-search', [ReportsController::class, 'clearSearch'])->name('clear-search');
    });

    Route::as('users.')->prefix('users')->group(function () {

        Route::get('/',                        [UsersController::class, 'index'])->name('index');
        Route::get('create',                   [UsersController::class, 'create'])->name('create');
        Route::post('store',                   [UsersController::class, 'store'])->name('store');
        Route::get('edit/{id}',                [UsersController::class, 'edit'])->name('edit');
        Route::post('update',                  [UsersController::class, 'update'])->name('update');
        Route::get('delete/{id}',              [UsersController::class, 'destroy'])->name('destroy');
        Route::get('deleted',                  [UsersController::class, 'viewDeleted'])->name('viewDeleted');
        Route::get('restore/{id}',             [UsersController::class, 'restore'])->name('restore');
        Route::get('deletePermanent/{id}',     [UsersController::class, 'permanentDestroy'])->name('permanentDestroy');
        Route::get('/get-districts/{stateId}', [UsersController::class, 'getDistricts'])->name('get-districts');
        Route::get('edit-password/{id}',            [UsersController::class, 'editProfile'])->name('edit-password');
        Route::post('update-password',         [UsersController::class, 'updateProfile'])->name('update-password');
    });

    Route::as('roles.')->prefix('roles')->group(function () {
        Route::get('/',                    [RolesController::class, 'index'])->name('index');
        Route::get('create',               [RolesController::class, 'create'])->name('create');
        Route::post('store',               [RolesController::class, 'store'])->name('store');
        Route::get('edit/{id}',            [RolesController::class, 'edit'])->name('edit');
        Route::post('update',              [RolesController::class, 'update'])->name('update');
        Route::get('delete/{id}',          [RolesController::class, 'destroy'])->name('destroy');
    });


    Route::as('permissions.')->prefix('permissions')->group(function () {
        Route::get('/',                    [PermissionsController::class, 'index'])->name('index');
        Route::get('create',               [PermissionsController::class, 'create'])->name('create');
        Route::post('store',               [PermissionsController::class, 'store'])->name('store');
        Route::get('edit/{id}',            [PermissionsController::class, 'edit'])->name('edit');
        Route::post('update',              [PermissionsController::class, 'update'])->name('update');
        Route::get('delete/{id}',          [PermissionsController::class, 'destroy'])->name('destroy');
    });

    // ROUTE FOR HISTORY
    Route::get('/application-history/',    [HistoriesController::class, 'application_index'])->name('application-history');
    Route::get('/system-history/',         [HistoriesController::class, 'system_index'])->name('system-history');



    
    Route::as('registration.')->prefix('/registration')->name('registrations.')->group(function () {
        Route::get('index',                [RegistrationController::class, 'index'])->name('index');
        Route::get('create',               [RegistrationController::class, 'create'])->name('create');
        Route::get('edit/{id}',            [RegistrationController::class, 'edit'])->name('edit');
        Route::post('update',              [RegistrationController::class, 'update'])->name('update');
        Route::delete('destroy/{id}',      [RegistrationController::class, 'destroy'])->name('destroy');
        Route::post('store',               [RegistrationController::class, 'store'])->name('store');

        Route::post('get',                 [RegistrationController::class, 'getAllRegistration'])->name('get');
        Route::post('show',                 [RegistrationController::class, 'show'])->name('show');

        //Ajax call
        Route::get('get-districts/{state_id}',            [RegistrationController::class, 'getDistricts'])->name('getDistricts');
        Route::get('get-local-governments/{district_id}', [RegistrationController::class, 'getLocalGovernments'])->name('getLocalGovernments');
    });


    Route::as('release.')->prefix('/release')->name('releases.')->group(function () {
        Route::get('index',                [ReleaseController::class, 'index'])->name('index');
        Route::get('create',               [ReleaseController::class, 'create'])->name('create');
        Route::get('create/{id}',               [ReleaseController::class, 'createRelease'])->name('create.release');
        Route::post('store',               [ReleaseController::class, 'store'])->name('store');
        Route::get('edit/{id}',            [ReleaseController::class, 'edit'])->name('edit');
        Route::post('update',              [ReleaseController::class, 'update'])->name('update');
        Route::delete('destroy/{id}',      [ReleaseController::class, 'destroy'])->name('destroy');

        Route::post('get',                 [ReleaseController::class, 'getAllReseaseById'])->name('get');
        Route::post('show',                 [ReleaseController::class, 'show'])->name('show');

        Route::get('/search', [ReleaseController::class, 'search'])->name('search');
    });

    Route::as('applicant.')->prefix('applicant')->group(function () {
        Route::get('index',                               [ApplicantController::class, 'index'])->name('index');
        Route::get('create',                              [ApplicantController::class, 'create'])->name('create');
        Route::get('edit/{id}',                           [ApplicantController::class, 'edit'])->name('edit');
        Route::post('update',                             [ApplicantController::class, 'update'])->name('update');
        Route::get('destroy/{id}',                        [ApplicantController::class, 'destroy'])->name('destroy');
        Route::post('store',                              [ApplicantController::class, 'store'])->name('store');

        Route::get('get-districts/{state_id}',            [ApplicantController::class, 'getDistricts'])->name('getDistricts');
        Route::get('get-local-governments/{district_id}', [ApplicantController::class, 'getLocalGovernments'])->name('getLocalGovernments');
    });


    Route::as('offender.')->prefix('offender')->group(function () {
        Route::get('index',                               [OffenderController::class, 'index'])->name('index');
        Route::get('create',                              [OffenderController::class, 'create'])->name('create');
        Route::get('edit/{id}',                           [OffenderController::class, 'edit'])->name('edit');
        Route::post('update',                             [OffenderController::class, 'update'])->name('update');
        Route::get('destroy/{id}',                        [OffenderController::class, 'destroy'])->name('destroy');
        Route::post('store',                              [OffenderController::class, 'store'])->name('store');
        Route::get('get-districts/{state_id}',            [ApplicantController::class, 'getDistricts'])->name('getDistricts');
        Route::get('get-local-governments/{district_id}', [ApplicantController::class, 'getLocalGovernments'])->name('getLocalGovernments');
    });


    Route::as('transaction.')->prefix('transaction')->group(function () {
        Route::get('index',                     [TransactionController::class, 'index'])->name('index');
        Route::get('create',                    [TransactionController::class, 'create'])->name('create');
        Route::get('edit/{id}',                 [TransactionController::class, 'edit'])->name('edit');
        Route::post('update',                   [TransactionController::class, 'update'])->name('update');
        Route::get('destroy/{id}',              [TransactionController::class, 'destroy'])->name('destroy');
        Route::post('store',                    [TransactionController::class, 'store'])->name('store');
    });

    Route::as('purpose.')->prefix('purpose')->group(function () {
        Route::get('index',                     [PurposeController::class, 'index'])->name('index');
        Route::get('create',                    [PurposeController::class, 'create'])->name('create');
        Route::post('update/{id}',              [PurposeController::class, 'update'])->name('update');
        Route::get('destroy/{id}',              [PurposeController::class, 'destroy'])->name('destroy');
        Route::post('store',                    [PurposeController::class, 'store'])->name('store');
    });


    Route::as('nature.')->prefix('nature')->group(function () {
        Route::get('index',                     [NatureController::class, 'index'])->name('index');
        Route::get('create',                    [NatureController::class, 'create'])->name('create');
        Route::post('update/{id}',              [NatureController::class, 'update'])->name('update');
        Route::get('destroy/{id}',              [NatureController::class, 'destroy'])->name('destroy');
        Route::post('store',                    [NatureController::class, 'store'])->name('store');
    });


    Route::as('proof.')->prefix('proof')->group(function () {
        Route::get('index',                     [ProofController::class, 'index'])->name('index');
        Route::get('create',                    [ProofController::class, 'create'])->name('create');
        Route::post('update/{id}',              [ProofController::class, 'update'])->name('update');
        Route::get('destroy/{id}',              [ProofController::class, 'destroy'])->name('destroy');
        Route::post('store',                    [ProofController::class, 'store'])->name('store');
    });

    Route::as('notransactionpurpose.')->prefix('notransactionpurpose')->group(function () {
        Route::get('index',                     [NoTransactionPurposeController::class, 'index'])->name('index');
        Route::get('create',                    [NoTransactionPurposeController::class, 'create'])->name('create');
        Route::post('update/{id}',              [NoTransactionPurposeController::class, 'update'])->name('update');
        Route::delete('destroy/{id}',              [NoTransactionPurposeController::class, 'destroy'])->name('destroy');
        Route::post('store',                    [NoTransactionPurposeController::class, 'store'])->name('store');
    });


    Route::as('loangivingvictim.')->prefix('/loangiving-victim')->name('loangiving-victim.')->group(function () {
        Route::get('index',                [LoanGivingVictimController::class, 'index'])->name('index');
        Route::get('create',                [LoanGivingVictimController::class, 'create'])->name('create');
        Route::post('store',                [LoanGivingVictimController::class, 'store'])->name('store');
        Route::get('show/{id}',              [LoanGivingVictimController::class, 'show'])->name('show');
        Route::get('edit/{id}',              [LoanGivingVictimController::class, 'edit'])->name('edit');
        Route::post('update/{id}',              [LoanGivingVictimController::class, 'update'])->name('update');
        Route::delete('destroy/{id}',              [LoanGivingVictimController::class, 'destroy'])->name('destroy');
    });

    Route::as('loantakingvictim.')->prefix('/loantaking-victim')->name('loantaking-victim.')->group(function () {
        Route::get('index',                [LoanTakingVictimController::class, 'index'])->name('index');
        Route::get('create',                [LoanTakingVictimController::class, 'create'])->name('create');
        Route::post('store',                [LoanTakingVictimController::class, 'store'])->name('store');
        Route::get('show/{id}',              [LoanTakingVictimController::class, 'show'])->name('show');
        Route::get('edit/{id}',              [LoanTakingVictimController::class, 'edit'])->name('edit');
        Route::post('update/{id}',              [LoanTakingVictimController::class, 'update'])->name('update');
        Route::get('destroy/{id}',              [LoanTakingVictimController::class, 'destroy'])->name('destroy');
    });




    Route::as('discussion.')->prefix('discussion')->group(function () {
        Route::get('index',                         [DiscussionController::class, 'index'])->name('index');
        Route::get('create',                        [DiscussionController::class, 'create'])->name('create');
        // Route::get('show/{id}',                     [DiscussionController::class, 'show'])->name('show');
        Route::get('show/{registration_id}/{id}',   [DiscussionController::class, 'show'])->name('show');

        Route::post('store',                        [DiscussionController::class, 'store'])->name('store');
        Route::get('edit/{id}',                     [DiscussionController::class, 'edit'])->name('edit');
        Route::post('update',                       [DiscussionController::class, 'update'])->name('update');
        Route::delete('destroy/{id}',               [DiscussionController::class, 'destroy'])->name('destroy');
        Route::post('get',                          [DiscussionController::class, 'getAllDiscussion'])->name('get');
        // Route::post('show',                         [DiscussionController::class, 'show'])->name('show');

        Route::get('/search',                       [DiscussionController::class, 'search'])->name('search');
        Route::get('/searchDiscussion',             [DiscussionController::class, 'searchDiscussion'])->name('searchDiscussion');

        Route::get('/get-previous-dates',           [DiscussionController::class, 'getPreviousDates'])->name('getPreviousDates');
    });


    // FOR TEST
    Route::get('form', function () {
        return view('admin.trials.registration-form');
    });
});

Route::prefix('/profile')->name('profile.')->middleware(['web', 'auth'])->group(function () {
    Route::get('/', 'ProfilesController@index')->name('index');
    Route::post('/update/info', 'ProfilesController@updateInfo')->name('update.info');
    Route::post('/update/password', 'ProfilesController@updatePassword')->name('update.password');
});
