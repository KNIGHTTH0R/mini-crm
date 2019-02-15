<?php

namespace App;

use App\Mail\NewCompany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class Company extends Model
{
    protected $fillable = ['name', 'email', 'logo', 'website'];

    public $timestamps = false;

    protected static function boot()
    {
        parent::boot();

        self::creating(function($model){
           if($model->logo)
           {
              $path        = Storage::put('public/logos', $model->logo);
              $model->logo = Storage::url($path);
           }
        });

        self::updating(function($model){
            if($model->logo instanceof UploadedFile)
            {
                $original = explode('/logos/',$model->getOriginal()['logo'])[1];
                $status   = Storage::delete('public/logos/'.$original);

                if($status)
                {
                    $path        = Storage::put('public/logos', $model->logo);
                    $model->logo = Storage::url($path);
                }
            }
        });

        self::deleting(function($model){

                $original = explode('/logos/',$model->logo)[1];
                $status   = Storage::delete('public/logos/'.$original);

                if(!$status)
                {
                    info("Image file was not deleted. " . $model->logo);
                }
        });
    }

}
