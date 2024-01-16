<?php 

namespace App\Observers;

use App\Models\Support;
use Illuminate\Support\Facades\Auth;

class SupportObserver {
    public function creating(Support $support): void {
        $support->user_id = Auth::user()->id;
    }
}