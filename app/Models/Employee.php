<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Classes\Settings;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


/**
 * Class Employee
 *
 * @property int $id
 * @property string $employee_no
 * @property string $surname
 * @property string|null $other_names
 * @property string|null $gender
 * @property Carbon|null $dob
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $address
 * @property string|null $marital_status
 * @property string|null $photo
 * @property bool $status
 * @property int|null $scale_id
 * @property int|null $rank_id
 * @property int|null $designation_id
 * @property int|null $bank_id
 * @property string|null $bank_account_no
 * @property string|null $bank_account_name
 * @property float $salary
 * @property bool $permanent
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Bank|null $bank
 * @property Designation|null $designation
 * @property Rank|null $rank
 * @property Scale|null $scale
 * @property Collection|Allowance[] $allowances
 * @property Collection|Deduction[] $deductions
 * @property Collection|Payslip[] $payslips
 *
 * @package App\Models
 */
class Employee extends Model
{
	protected $table = 'employees';

	protected $casts = [
		'status' => 'bool',
		'scale_id' => 'int',
		'rank_id' => 'int',
		'designation_id' => 'int',
		'bank_id' => 'int',
		'salary' => 'float',
		'permanent' => 'bool'
	];

	protected $dates = [
		'dob'
	];

	protected $fillable = [
		'employee_no',
		'surname',
		'other_names',
		'gender',
		'dob',
		'email',
		'phone',
		'address',
		'marital_status',
		'photo',
		'status',
		'scale_id',
		'rank_id',
		'designation_id',
		'bank_id',
		'bank_account_no',
		'bank_account_name',
		'salary',
		'permanent'
	];


    public static $fields  = [
        'employee_no',
        'surname',
        'other_names',
        'gender',
        'dob',
        'email',
        'phone',
        'address',
        'marital_status',
        'photo',
        'status',
        'scale_id',
        'rank_id',
        'designation_id',
        'bank_id',
        'bank_account_no',
        'bank_account_name',
        'salary',
        'permanent'
    ];

    public static $validation  = [
        'surname' => 'required',
        'other_names' => 'required',
        //'salary' => 'required',
        //'gender' => 'required',
    ];

    protected $appends = ['image','name'];


    public function getNameAttribute()
    {
        return $this->surname." ".$this->other_names;
    }

    public function getSalaryAttribute()
    {
        if(isset($this->attributes['salary']) && $this->attributes['salary'] !== NULL) return $this->attributes['salary'];

        if(isset($this->rank_id) && $this->rank_id !== NULL) return $this->rank->salary;

        return "";
    }


    public function getImageAttribute()
    {
        if(empty($this->getOriginal('photo'))) return asset('assets/products.jpg');

        return app()->make('url')->to('/').'/'.$this->getOriginal('photo');
    }


    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        self::creating(function($model){

            if(request()->hasFile('photo'))
            {
                $fileName   = time() . request()->file('photo')->getClientOriginalName();
                $path = 'employee/photo/';
                Storage::disk('public')->put($path . $fileName, File::get(request()->file('photo')));
                $filePath   = 'storage/'.$path . $fileName;
                $model->photo = $filePath;
            }
            else
            {
                $model->photo = NULL;
            }

            $total = DB::table($model->table)->count();
            $total = $total + 1;
            $number = (app()->make(Settings::class)->get("emp_number_prefix") ?? ""). sprintf('%04d',$total);
            $model->employee_no = $number;

        });


        self::updating(function($model){

            if(request()->hasFile('photo'))
            {
                $fileName   = time() . request()->file('photo')->getClientOriginalName();
                $path = 'employee/photo/';
                Storage::disk('public')->put($path . $fileName, File::get(request()->file('photo')));
                $filePath   = 'storage/'.$path . $fileName;
                $model->photo = $filePath;
            }

        });

    }

    public function bank()
	{
		return $this->belongsTo(Bank::class);
	}

	public function designation()
	{
		return $this->belongsTo(Designation::class);
	}

	public function rank()
	{
		return $this->belongsTo(Rank::class);
	}

	public function scale()
	{
		return $this->belongsTo(Scale::class);
	}

	public function allowances()
	{
		return $this->belongsToMany(Allowance::class, 'employee_extra_allowances')
					->withPivot('id', 'percent', 'amount', 'total_amount', 'start_date', 'end_date', 'status', 'comment')
					->withTimestamps();
	}

	public function deductions()
	{
		return $this->belongsToMany(Deduction::class, 'employee_extra_deductions')
					->withPivot('id', 'percent', 'amount', 'total_amount', 'start_date', 'end_date', 'status', 'comment')
					->withTimestamps();
	}

    public function activeDeductions()
    {
        return $this->belongsToMany(Deduction::class, 'employee_extra_deductions')
            ->withPivot('id', 'percent', 'amount', 'total_amount', 'start_date', 'end_date', 'status', 'comment')
           ->wherePivot("status","=","1")
            ->wherePivot("start_date",'<=',getCurrentPeriod()->period)
            ->where(function($query){
                $query->where("employee_extra_deductions.end_date",'>=',getCurrentPeriod()->period)
                    ->orWhereNull("employee_extra_deductions.end_date");
            })
            ->withTimestamps();
    }

    public function activeAllowances()
    {
        return $this->belongsToMany(Allowance::class, 'employee_extra_allowances')
            ->withPivot('id', 'percent', 'amount', 'total_amount', 'start_date', 'end_date', 'status', 'comment')
            ->wherePivot("status","=","1")
            ->wherePivot("start_date",'<=',getCurrentPeriod()->period)
            ->where(function($query){
                $query->where("employee_extra_allowances.end_date",'>=',getCurrentPeriod()->period)
                    ->orWhereNull("employee_extra_allowances.end_date");
            })
            ->withTimestamps();
    }

	public function payslips()
	{
		return $this->hasMany(Payslip::class);
	}
}
