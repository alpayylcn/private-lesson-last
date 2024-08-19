<?php

namespace App\Http\Controllers\Backend\Teacher;

use App\Models\Backend\TeacherAdvertisement;
use App\Http\Requests\StoreTeacherAdvertisementRequest;
use App\Http\Requests\UpdateTeacherAdvertisementRequest;
use App\Http\Controllers\Controller;
use App\Models\Backend\Duration;
use App\Models\Backend\Reason;
use App\Models\Backend\Wallet;
use App\Services\Backend\CreditService;
use App\Services\Backend\TeacherAdvertisementService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TeacherAdvertisementController  extends Controller
{
    public function __construct(
        protected  TeacherAdvertisementService $teacherAdvertisementService,
        protected CreditService $creditService
        
        ){}

    
   
    // İlan verme formunu göstermek için method
    public function showCreateAdvertisementForm()
    {
        $user = Auth::user();
        $durations = Duration::all();
        $reasons = Reason::all();
        $balance=Wallet::where('user_id',$user->id)->first();
        $advertisements = $this->teacherAdvertisementService->getTeacherAdvertisements(auth()->id());
        
        return view('teachers.create-advertisement', [
            'durations' => $durations,
            'reasons' => $reasons,
            'balance'=>$balance->balance,
            'advertisements'=>$advertisements
        ]);

        // Öğretmenin ilanlarını al
        

        
    }

    // Kredi harcama işlemini gerçekleştiren method
    public function spendCredits(Request $request)
    {
        $user = Auth::user();
        $durationId = $request->input('duration_id');
        $reasonId = $request->input('reason_id'); // Güncellenmiş şekilde reason_id

        return $this->teacherAdvertisementService->spendCredits($user, $durationId, $reasonId);
    }
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeacherAdvertisementRequest $request)
    {
        $data = $request->validate([
            
            'duration_id' => 'required',
        ]);

        $this->teacherAdvertisementService->createAdvertisement($data);

        return redirect()->route('teacher_advertisements.index')->with('success', 'Advertisement created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(TeacherAdvertisement $teacherAdvertisement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TeacherAdvertisement $teacherAdvertisement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTeacherAdvertisementRequest $request, TeacherAdvertisement $teacherAdvertisement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->teacherAdvertisementService->deleteAdvertisement($id);

        return redirect()->route('teacher_advertisements.index')->with('success', 'Advertisement deleted successfully!');
    }

    public function restore($id)
    {
        $this->teacherAdvertisementService->restoreAdvertisement($id);

        return redirect()->route('teacher_advertisements.index')->with('success', 'Advertisement restored successfully!');
    }
}
