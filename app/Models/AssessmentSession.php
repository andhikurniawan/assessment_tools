<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\JobTargets;
use app\AssessmentCompetencyResults;
use Log;
/**
 * Class AssessmentSession
 * @package App\Models
 * @version August 17, 2019, 11:37 am UTC
 *
 * @property \App\Models\Company company
 * @property \App\Models\CompetencyGroup competencygroup
 * @property \Illuminate\Database\Eloquent\Collection assessmentCompetencyResults
 * @property \Illuminate\Database\Eloquent\Collection assessorMaps
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property string name
 * @property string status
 * @property string start_date
 * @property string end_date
 * @property integer company_id
 * @property integer competencygroup_id
 * @property string|\Carbon\Carbon deleted_at
 */
class AssessmentSession extends Model
{
    public $table = 'assessment_session';

    public $fillable = [
        'name',
        'status',
        'start_date',
        'end_date',
        'company_id',
        'competency_group_id',
        'deleted_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'status' => 'string',
        'start_date' => 'date',
        'end_date' => 'date',
        'company_id' => 'integer',
        'competency_group_id' => 'integer',
        'deleted_at' => 'datetime'
    ];

    public static $listStatus = [
        'not_started' => 'Not Started',
        'open' => 'Open',
        'finished' => 'Finished',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function teams()
    {
        return $this->hasMany(\App\Models\Team::class)->pluck('name','id');
    }

    public function jobs()
    {
        return $this->hasMany(\App\Models\JobTargets::class)->pluck('job_name','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function company()
    {
        return $this->belongsTo(\App\Models\Company::class, 'company_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function competencygroup()
    {
        return $this->belongsTo(\App\Models\CompetencyGroup::class, 'competency_group_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function assessmentCompetencyResults()
    {
        return $this->hasMany(\App\AssessmentCompetencyResults::class, 'session_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function assignmentHeaders()
    {
        return $this->hasMany(\App\Models\AssignmentHeader::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function assessorMaps()
    {
        return $this->hasMany(\App\Models\AssessorMap::class,'session_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function assessorMapsCount()
    {
        return $this->hasMany(\App\Models\AssessorMap::class,'session_id')->select('userid_assessee')->distinct('userid_assessee');
    }

    public function competencyModels()
    {
        return $this->belongsToMany('App\Models\CompetencyModels', 'assessment_relation', 'assessment_session_id', 'competency_models_id');
    }

    public function getListStatus()
    {
        return $listStatus;
    }

    public function doAssignment($mode='')
    {
        $ortoolsLib = "../or-tools/lib";
        $myId = $this->id;
        $classpath = $ortoolsLib."/com.google.ortools.jar".":".$ortoolsLib."/protobuf.jar".":../simpleOR";
        $params = "-cp $classpath -Djava.library.path=$ortoolsLib TeamAssignmentCase B ".$myId;
        $persons_handle = fopen($myId."_persons.in","w");
        $results = $this->assessmentCompetencyResults;
        $empmaster = array();
        foreach ($results as $r)
        {
            $empId = $r->user->id."|".$r->user->employee_id;
            if (array_key_exists($empId,$empmaster) == false)
                $empmaster [$empId] = array();
            $arr1 = $empmaster [$empId];
            $arr1[] = $r;
            $empmaster [$empId] = $arr1;
        }
        Log::debug('Jumlah Person: '.count($empmaster));
        
        fwrite($persons_handle,count($empmaster));
        fwrite($persons_handle,"\n");
        foreach ($empmaster as $empId => $arr)
        {
            fwrite($persons_handle,$empId);
            fwrite($persons_handle," ");
            fwrite($persons_handle,count($arr));
            fwrite($persons_handle,"\n");
            foreach ($arr as $r)
            {
                fwrite($persons_handle,$r->competency->code);
                fwrite($persons_handle," ");
                if ($mode=='modus')
                    fwrite($persons_handle,intval($r->modus_level));
                else
                    fwrite($persons_handle,intval($r->median_level));
                fwrite($persons_handle,"\n");
            }
        }
        fclose($persons_handle);

        // Bagian Job Target
        $jobs_handle = fopen($myId."_jobs.in","w");
        $jobTargets = JobTargets::where('assessment_session_id',$myId)->get();
        fwrite($jobs_handle,count($jobTargets));
        fwrite($jobs_handle,"\n");
        $totalPos=0;
        foreach ($jobTargets as $key => $jobTarget) {
            fwrite($jobs_handle,"J".$jobTarget->id);
            fwrite($jobs_handle," ");
            $reqs = $jobTarget->jobTargets;
            fwrite($jobs_handle,count($reqs)); fwrite($jobs_handle,"\n");
            foreach ($reqs as $req) {
                fwrite($jobs_handle,$req->competency->code." ".$req->skill_level."\n");
            }
            $totalPos += $jobTarget->number_position;
        }
        fclose($jobs_handle);


        $pos_handle = fopen($myId."_positions.in","w");
        fwrite($pos_handle,$totalPos);
        fwrite($pos_handle,"\n");
        foreach ($jobTargets as $key => $jobTarget) {
            for ($i=1; $i<=$jobTarget->number_position;$i++)
            {    
                fwrite($pos_handle,"".$jobTarget->id."|".$jobTarget->team_id."|".$jobTarget->job_code."-".$i);
                fwrite($pos_handle," ");
                fwrite($pos_handle,"J".$jobTarget->id);
                fwrite($pos_handle,"\n");
            }
            
        }
        fclose($pos_handle);
        
        $outlines=array();
        $cmdline = "java $params";
        // dd($outlines);
        // $a = exec($cmdline, $outlines);
        // dd($a);
        exec($cmdline,$outlines);
        if (count($outlines)>=3)
        {
            $existingHeaders = $this->assignmentHeaders;
            $header = new \App\Models\AssignmentHeader();
            $header->run_date = date('Y-m-d H:i:s');
            $header->run_counter = count($existingHeaders)+1;
            $header->is_effective = 0;
            $this->assignmentHeaders()->save($header);
            
            for ($i = 3; $i< count($outlines); $i++)
            {
                $theline = $outlines[$i];
                $fields = explode(",",$theline);
                $user_field = explode("|",$fields[0]);
                $user_id = $user_field[0];
                $emp_id = $user_field[1];
                $jobtarget_field = explode("|",$fields[1]);
                $jobtarget_id = $jobtarget_field[0];
                $team_id = $jobtarget_field[1];
                $row = new \App\Models\AssignmentResult();
                $row->user_id = $user_id;
                $row->job_target_id = $jobtarget_id;
                $row->team_id = $team_id;
                $row->employee_id = $emp_id;
                $row->gap = $fields[2];
                $row->jobcode = $jobtarget_field[2];
                $header->details()->save($row);
            }
        }
        return $header->id;
        //java -cp ../../or-tools_Ubuntu-18.04-64bit_v7.4.7247/lib/com.google.ortools.jar:../../or-tools_Ubuntu-18.04-64bit_v7.4.7247/lib/protobuf.jar:. -Djava.library.path=../../or-tools_Ubuntu-18.04-64bit_v7.4.7247/lib TeamAssignmentCase T 1
    }
}
