<?php

namespace App\Livewire;

use App\Models\Nationalities;
use App\Models\ParentAttachment;
use App\Models\Religion;
use App\Models\TypeBlood;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use App\Models\SParent;
use Livewire\WithFileUploads;

class AddParent extends Component
{
    use WithFileUploads;
     // Father_INPUTS
       public $Email, $Password,
        $Name_Father, $Name_Father_en,
        $National_ID_Father, $Passport_ID_Father,
        $Phone_Father, $Job_Father, $Job_Father_en,
        $Nationality_Father_id, $Blood_Type_Father_id,
        $Address_Father, $Religion_Father_id,
        $Parent_id,$photos,
        $show_table = true,
        $updateMode = false,

        // Mother_INPUTS
        $Name_Mother, $Name_Mother_en,
        $National_ID_Mother, $Passport_ID_Mother,
        $Phone_Mother, $Job_Mother, $Job_Mother_en,
        $Nationality_Mother_id, $Blood_Type_Mother_id,
        $Address_Mother, $Religion_Mother_id;

    public $currentStep = 1;
    public $successMessage;
    public $catchError;
    public function render()
    {
      return view('livewire.add-parent', [
            'Nationalities' => Nationalities::all(),
            'Type_Bloods' => TypeBlood::all(),
            'Religions' => Religion::all(),
            'my_parents' => SParent::all()
        ]);
    }

    public function updated($nameProp) {

        $valid = $this->validateOnly($nameProp, [
                'Email' => 'required|email',
                'National_ID_Father' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
                'Passport_ID_Father' => 'min:10|max:10',
                'Phone_Father' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'National_ID_Mother' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
                'Passport_ID_Mother' => 'min:10|max:10',
                'Phone_Mother' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
        ]);

    }

 //firstStepSubmit
    public function firstStepSubmit()
    {
       $this->validate([
            'Email' => 'required|unique:s_parent,Email',
            'Password' => 'required',
            'Name_Father' => 'required',
            'Name_Father_en' => 'required',
            'Job_Father' => 'required',
            'Job_Father_en' => 'required',
            'National_ID_Father' => 'required|unique:s_parent,National_ID_Father',
            'Passport_ID_Father' => 'required|unique:s_parent,Passport_ID_Father',
            'Phone_Father' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'Nationality_Father_id' => 'required',
            'Blood_Type_Father_id' => 'required',
            'Religion_Father_id' => 'required',
            'Address_Father' => 'required',
        ]);

        $this->currentStep = 2;
    }

    //secondStepSubmit
    public function secondStepSubmit()
    {

        $this->validate([
            'Name_Mother' => 'required',
            'Name_Mother_en' => 'required',
            'National_ID_Mother' => 'required|unique:s_parent,National_ID_Mother',
            'Passport_ID_Mother' => 'required|unique:s_parent,Passport_ID_Mother',
            'Phone_Mother' => 'required',
            'Job_Mother' => 'required',
            'Job_Mother_en' => 'required',
            'Nationality_Mother_id' => 'required',
            'Blood_Type_Mother_id' => 'required',
            'Religion_Mother_id' => 'required',
            'Address_Mother' => 'required',
        ]);

        $this->currentStep = 3;
    }

    public function submitForm(){

        try {
            $My_Parent = new SParent();
                        // Father_INPUTS
                        // Father
            $My_Parent->email = $this->Email;
            $My_Parent->password = Hash::make($this->Password);

            $My_Parent->name_father = [
                'en' => $this->Name_Father_en,
                'ar' => $this->Name_Father
            ];

            $My_Parent->national_id_father = $this->National_ID_Father;
            $My_Parent->passport_id_father = $this->Passport_ID_Father;
            $My_Parent->phone_father = $this->Phone_Father;

            $My_Parent->job_father = [
                'en' => $this->Job_Father_en,
                'ar' => $this->Job_Father
            ];

            $My_Parent->nationality_father_id = $this->Nationality_Father_id;
            $My_Parent->blood_type_father_id = $this->Blood_Type_Father_id;
            $My_Parent->religion_father_id = $this->Religion_Father_id;
            $My_Parent->address_father = $this->Address_Father;


            // Mother
            $My_Parent->name_mother = [
                'en' => $this->Name_Mother_en,
                'ar' => $this->Name_Mother
            ];

            $My_Parent->national_id_mother = $this->National_ID_Mother;
            $My_Parent->passport_id_mother = $this->Passport_ID_Mother;
            $My_Parent->phone_mother = $this->Phone_Mother;

            $My_Parent->job_mother = [
                'en' => $this->Job_Mother_en,
                'ar' => $this->Job_Mother
            ];

            $My_Parent->nationality_mother_id = $this->Nationality_Mother_id;
            $My_Parent->blood_type_mother_id = $this->Blood_Type_Mother_id;
            $My_Parent->religion_mother_id = $this->Religion_Mother_id;
            $My_Parent->address_mother = $this->Address_Mother;


            $My_Parent->save();

            if(!empty($this->photos)) {

                foreach($this->photos as $photo) {

                    $photo->storeAs($this->National_ID_Father, $photo->getClientOriginalName() . '_' . time(), $disk = 'parent_attachments');

                    $attchments = ParentAttachment::create([
                        'file_name' => $photo->getClientOriginalName(),
                        'parent_id' => SParent::latest()->first()->id
                    ]);

                }

            }


            $this->successMessage = trans('messages.success');
            $this->clearForm();
            $this->currentStep = 1;
        }

        catch (\Exception $e) {
            $this->catchError = $e->getMessage();
        };



    }


    //clearForm
    public function clearForm()
    {
        $this->Email = '';
        $this->Password = '';
        $this->Name_Father = '';
        $this->Job_Father = '';
        $this->Job_Father_en = '';
        $this->Name_Father_en = '';
        $this->National_ID_Father ='';
        $this->Passport_ID_Father = '';
        $this->Phone_Father = '';
        $this->Nationality_Father_id = '';
        $this->Blood_Type_Father_id = '';
        $this->Address_Father ='';
        $this->Religion_Father_id ='';

        $this->Name_Mother = '';
        $this->Job_Mother = '';
        $this->Job_Mother_en = '';
        $this->Name_Mother_en = '';
        $this->National_ID_Mother ='';
        $this->Passport_ID_Mother = '';
        $this->Phone_Mother = '';
        $this->Nationality_Mother_id = '';
        $this->Blood_Type_Mother_id = '';
        $this->Address_Mother ='';
        $this->Religion_Mother_id ='';

    }


    //back
    public function back($step)
    {
        $this->currentStep = $step;
    }

    // Edit Parent

    public function edit($id) {

        $My_Parent = SParent::where('id', $id)->first();


        $this->updateMode = true;
        $this->show_table = false;

        // dd($My_Parent);

        $this->Parent_id = $id;
        $this->Email = $My_Parent->email;
        $this->Password = $My_Parent->password;
        $this->Name_Father = $My_Parent->getTranslation('name_Father', 'ar');
        $this->Name_Father_en = $My_Parent->getTranslation('name_Father', 'en');
        $this->Job_Father = $My_Parent->getTranslation('job_father', 'ar');;
        $this->Job_Father_en = $My_Parent->getTranslation('job_father', 'en');
        $this->National_ID_Father =$My_Parent->national_ID_father;
        $this->Passport_ID_Father = $My_Parent->passport_ID_father;
        $this->Phone_Father = $My_Parent->phone_father;
        $this->Nationality_Father_id = $My_Parent->nationality_father_id;
        $this->Blood_Type_Father_id = $My_Parent->blood_type_father_id;
        $this->Address_Father =$My_Parent->address_father;
        $this->Religion_Father_id =$My_Parent->religion_father_id;

        $this->Name_Mother = $My_Parent->getTranslation('name_mother', 'ar');
        $this->Name_Mother_en = $My_Parent->getTranslation('name_Father', 'en');
        $this->Job_Mother = $My_Parent->getTranslation('job_mother', 'ar');;
        $this->Job_Mother_en = $My_Parent->getTranslation('job_mother', 'en');
        $this->National_ID_Mother =$My_Parent->national_ID_mother;
        $this->Passport_ID_Mother = $My_Parent->passport_ID_mother;
        $this->Phone_Mother = $My_Parent->phone_mother;
        $this->Nationality_Mother_id = $My_Parent->nationality_mother_id;
        $this->Blood_Type_Mother_id = $My_Parent->blood_type_mother_id;
        $this->Address_Mother =$My_Parent->address_mother;
        $this->Religion_Mother_id =$My_Parent->religion_mother_id;


    }

    public function showformadd() {

        $this->show_table = false;

    }


     //firstStepSubmit
    public function firstStepSubmit_edit()
    {
        $this->updateMode = true;
        $this->currentStep += 1;

    }

    //secondStepSubmit_edit
    public function secondStepSubmit_edit()
    {
        $this->updateMode = true;
        $this->currentStep += 1;

    }

    public function submitForm_edit()
{
    $this->validate([
        'Email' => 'required|email',
        'Name_Father' => 'required',
        'Name_Father_en' => 'required',
        'Job_Father' => 'required',
        'Job_Father_en' => 'required',
        'National_ID_Father' => 'required|min:10|max:10',
        'Passport_ID_Father' => 'required|min:10|max:10',
        'Phone_Father' => 'required|min:10',
        'Nationality_Father_id' => 'required',
        'Blood_Type_Father_id' => 'required',
        'Religion_Father_id' => 'required',
        'Address_Father' => 'required',

        'Name_Mother' => 'required',
        'Name_Mother_en' => 'required',
        'National_ID_Mother' => 'required|min:10|max:10',
        'Passport_ID_Mother' => 'required|min:10|max:10',
        'Phone_Mother' => 'required|min:10',
        'Nationality_Mother_id' => 'required',
        'Blood_Type_Mother_id' => 'required',
        'Religion_Mother_id' => 'required',
        'Address_Mother' => 'required',
    ]);

    $parent = SParent::findOrFail($this->Parent_id);

    $parent->update([
        'email' => $this->Email,

        'name_father' => [
            'en' => $this->Name_Father_en,
            'ar' => $this->Name_Father
        ],

        'national_id_father' => $this->National_ID_Father,
        'passport_id_father' => $this->Passport_ID_Father,
        'phone_father' => $this->Phone_Father,

        'job_father' => [
            'en' => $this->Job_Father_en,
            'ar' => $this->Job_Father
        ],

        'nationality_father_id' => $this->Nationality_Father_id,
        'blood_type_father_id' => $this->Blood_Type_Father_id,
        'religion_father_id' => $this->Religion_Father_id,
        'address_father' => $this->Address_Father,

        'name_mother' => [
            'en' => $this->Name_Mother_en,
            'ar' => $this->Name_Mother
        ],

        'national_id_mother' => $this->National_ID_Mother,
        'passport_id_mother' => $this->Passport_ID_Mother,
        'phone_mother' => $this->Phone_Mother,

        'job_mother' => [
            'en' => $this->Job_Mother_en,
            'ar' => $this->Job_Mother
        ],

        'nationality_mother_id' => $this->Nationality_Mother_id,
        'blood_type_mother_id' => $this->Blood_Type_Mother_id,
        'religion_mother_id' => $this->Religion_Mother_id,
        'address_mother' => $this->Address_Mother,
    ]);

    return redirect()->to('/add_parent');
}


    public function delete($id){

        SParent::findOrFail($id)->delete();
        return redirect()->to('/add_parent');

    }

}