<?php

namespace App\Http\Controllers;

use App\Models\Parent;
use App\Models\Spouse;
use App\Models\Suspect;
use App\Models\Associate;
use Illuminate\Http\Request;
use App\Models\TelephoneNumber;

class SuspectController extends Controller
{
    public function store(Request $request)
    {
        $suspect = Suspect::create([
            'case_ref' => $request->case_ref,
            'station' => $request->station,
            'offence' => $request->offence,
            'briefs_on_case' => $request->briefs_on_case,
            'name' => $request->name,
            'sex' => $request->sex,
            'age' => $request->age,
            'nationality' => $request->nationality,
            'nin' => $request->nin,
            'other_id_no' => $request->other_id_no,
            'tribe' => $request->tribe,
            'religion' => $request->religion,
            'marital_status' => $request->marital_status,
            'place_of_birth' => $request->place_of_birth,
            'present_address' => $request->present_address,
            'distinguishing_features' => $request->distinguishing_features,
            'height' => $request->height,
            'bodybuild' => $request->bodybuild,
            'eye_color' => $request->eye_color,
            'hair_color' => $request->hair_color,
            'level_of_education' => $request->level_of_education,
            'languages_spoken' => $request->languages_spoken,
            'travel_history' => $request->travel_history,
            'previous_crime_records' => $request->previous_crime_records,
            'occupation' => $request->occupation,
        ]);

        if($request->has('associates')) {
            foreach($request->associates as $associateData) {
                $associate = Associate::create([
                    'name' => $associateData['name'],
                    'residence' => $associateData['residence'],
                    'case_id' => $suspect->id,
                ]);
                if($associateData['telephone_numbers']) {
                    foreach($associateData['telephone_numbers'] as $telephoneNumber) {
                        TelephoneNumber::create([
                            'number' => $telephoneNumber,
                            'phoneable_id' => $associate->id,
                            'phoneable_type' => Associate::class,
                        ]);
                    }
                }
            }
        }
        if($request->has('spouses')) {
            foreach($request->spouses as $spouseData) {
                $spouse = Spouse::create([
                    'name' => $associateData['name'],
                    'residence' => $associateData['residence'],
                    'suspect_id' => $suspect->id,
                ]);
                if($spouseData['telephone_numbers']) {
                    foreach($spouseData['telephone_numbers'] as $telephoneNumber) {
                        TelephoneNumber::create([
                            'number' => $telephoneNumber,
                            'phoneable_id' => $spouse->id,
                            'phoneable_type' => Spouse::class,
                        ]);
                    }
                }
            }
        }
        if($request->has('parents')) {
            foreach($request->parents as $parentData) {
                $parent = Parent::create([
                    'name' => $parentData['name'],
                    'residence' => $parentData['residence'],
                    'suspect_id' => $suspect->id,
                ]);
                if($parentData['telephone_numbers']) {
                    foreach($parentData['telephone_numbers'] as $telephoneNumber) {
                        TelephoneNumber::create([
                            'number' => $telephoneNumber,
                            'phoneable_id' => $parent->id,
                            'phoneable_type' => Parent::class,
                        ]);
                    }
                }
            }
        }
    }
}