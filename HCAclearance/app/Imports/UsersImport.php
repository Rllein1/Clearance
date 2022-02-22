<?php

namespace App\Imports;

use App\Models\Student;
use App\Models\User;
use App\Models\Classroom;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    private $class;

    public function __construct(){
        $this->class=Classroom::all();
    }

    public function adduser($username){
        $user=New User;
        $user->rank='student';
        $user->role='student';
        $user->username=$username;
        $user->password=Hash::make("eclearance");
        $user->save();
        return $user->id;
    }

    public function model(array $row)
    {
        $room=$this->class->where('class_name',$row[4])->first();
        $userid= UsersImport::adduser($row[0]);
        return new Student([
            'user_id' => $userid,
            'student_id' => $row[0],
            'fname' => $row[1],
            'lname' => $row[2],
            'grade' => $row[3],
            'classroom_id' => $room->id,
        ]);
    }
}
