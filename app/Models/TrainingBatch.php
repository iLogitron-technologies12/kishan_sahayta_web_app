<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingBatch extends Model
{
    use HasFactory;
    protected $table = 'training_batches';

    protected $fillable = [
        'id',
        'application_id',
        'training_under',
        'applicant_batch_name',
        'training_start_date',
        'training_end_date',
    ];
}
