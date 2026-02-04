<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Promotions;
use App\Models\Student;
use App\Repository\IPromotion;
use App\Repository\PromotionRepository;
use DB;
use Exception;
use Illuminate\Http\Request;

class PromotionsController extends Controller
{
    protected IPromotion $promotions;

    public function __construct(IPromotion $promotions) {
        $this->promotions = $promotions;
    }

    public function index() {
        return $this->promotions->index();
    }

    public function store(Request $request) {
        return $this->promotions->store($request);
    }
    public function create() {
        return $this->promotions->create();
    }

    public function getClassroomsInPormotions($id) {
        $grades = Classroom::where('grade_id', $id)->pluck('name_class','id');
        return $grades;
    }
}
