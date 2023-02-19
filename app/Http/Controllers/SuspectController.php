<?php

namespace App\Http\Controllers;

use App\Models\Spouse;
use App\Models\Suspect;
use App\Models\Associate;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SuspectParent;
use App\Models\TelephoneNumber;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SuspectController extends Controller
{
    public function store(Request $request)
    {

        // Get the authenticated user
        $user = $request->user();   

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
            'user_id' => $user->id,

        ]);

        if ($request->has('associates')) {
            foreach ($request->associates as $associateData) {
                $associate = Associate::create([
                    'name' => $associateData['name'],
                    'residence' => $associateData['residence'],
                    'suspect_id' => $suspect->id,
                ]);
                if ($associateData['telephone_numbers']) {
                    foreach ($associateData['telephone_numbers'] as $telephoneNumber) {
                        TelephoneNumber::create([
                            'number' => $telephoneNumber,
                            'phoneable_id' => $associate->id,
                            'phoneable_type' => Associate::class,
                        ]);
                    }
                }
            }
        }
        if ($request->has('spouses')) {
            foreach ($request->spouses as $spouseData) {
                $spouse = Spouse::create([
                    'name' => $spouseData['name'],
                    'residence' => $spouseData['residence'],
                    'relationship' => $spouseData['relationship'],
                    'suspect_id' => $suspect->id,
                ]);
                if ($spouseData['telephone_numbers']) {
                    foreach ($spouseData['telephone_numbers'] as $telephoneNumber) {
                        TelephoneNumber::create([
                            'number' => $telephoneNumber,
                            'phoneable_id' => $spouse->id,
                            'phoneable_type' => Spouse::class,
                        ]);
                    }
                }
            }
        }
        if ($request->has('parents')) {
            foreach ($request->parents as $parentData) {
                $parent = SuspectParent::create([
                    'name' => $parentData['name'],
                    'residence' => $parentData['residence'],
                    'relationship' => $parentData['relationship'],
                    'suspect_id' => $suspect->id,
                ]);
                if ($parentData['telephone_numbers']) {
                    foreach ($parentData['telephone_numbers'] as $telephoneNumber) {
                        TelephoneNumber::create([
                            'number' => $telephoneNumber,
                            'phoneable_id' => $parent->id,
                            'phoneable_type' => SuspectParent::class,
                        ]);
                    }
                }
            }
        }

        if ($request->has('telephone_numbers')) {
            foreach ($request->telephone_numbers as $telephoneNumber) {
                TelephoneNumber::create([
                    'number' => $telephoneNumber,
                    'phoneable_id' => $suspect->id,
                    'phoneable_type' => Suspect::class,
                ]);
            }
        }

        $left = $request->left;
        $front = $request->front;
        $right = $request->right;
        $hind = $request->hind;
        $data = [];

        if ($left) {
            $left_path = $this->saveImage($left);
            $data[] = [
                'image_path' => $left_path,
                'position' => 'left',
                'suspect_id' => $suspect->id
            ];
        }

        if ($front) {
            $front_path = $this->saveImage($front);
            $data[] = [
                'image_path' => $front_path,
                'position' => 'front',
                'suspect_id' => $suspect->id
            ];
        }

        if ($right) {
            $right_path = $this->saveImage($right);
            $data[] = [
                'image_path' => $right_path,
                'position' => 'right',
                'suspect_id' => $suspect->id
            ];
        }

        if ($hind) {
            $hind_path = $this->saveImage($hind);
            $data[] = [
                'image_path' => $hind_path,
                'position' => 'hind',
                'suspect_id' => $suspect->id
            ];
        }

        DB::table('images')->insert($data);

        return response()->json([
            'message' => 'Suspect created successfully',
            'suspect' => $suspect,
            $request->all()
        ], 201);
    }

    public function index()
    {
        $suspects = Suspect::with("images")->orderBy('created_at', 'desc')->get();

        return response()->json([
            'message' => 'Suspects retrieved successfully',
            'suspects' => $suspects
        ], 200);
    }

    public function show($id)
    {
        $suspect = Suspect::with("associates", "associates.telephoneNumbers", "parents", "parents.telephoneNumbers", "spouses", "spouses.telephoneNumbers", "telephoneNumbers", "images")->find($id);

        return response()->json([
            'message' => 'Suspect retrieved successfully',
            'suspect' => $suspect
        ], 200);
    }

    
    private function saveImage($image)
    {
        // Check if image is valid base64 string
        if (preg_match('/^data:image\/(\w+);base64,/', $image, $type)) {
            // Take out the base64 encoded text without mime type
            $image = substr($image, strpos($image, ',') + 1);
            // Get file extension
            $type = strtolower($type[1]); // jpg, png, gif

            // Check if file is an image
            if (!in_array($type, ['jpg', 'jpeg', 'gif', 'png'])) {
                throw new \Exception('invalid image type');
            }
            $image = str_replace(' ', '+', $image);
            $image = base64_decode($image);

            if ($image === false) {
                throw new \Exception('base64_decode failed');
            }
        } else {
            throw new \Exception('did not match data URI with image data');
        }

        $dir = 'images/';
        $file = Str::random() . '.' . $type;
        $absolutePath = public_path($dir);
        $relativePath = $dir . $file;
        if (!File::exists($absolutePath)) {
            File::makeDirectory($absolutePath, 0755, true);
        }
        file_put_contents($relativePath, $image);

        return $relativePath;
    }
}