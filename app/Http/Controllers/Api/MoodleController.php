<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\AppInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Saloon\XmlWrangler\XmlReader;

class MoodleController extends Controller
{
    private $baseurl;
    private $wstoken;
    
    /***************************************************************************************
     * IsnanMulia [20240416]:
     * Below are hard-coded data, as Moodle doesn't have facility to fetch such data
     * These are subjects to be updated in the future if there's any update on Moodle side
     ***************************************************************************************/
    private $dict_skemaPSCategories = [
        'HA'  => 'Hutan Adat',
        'HD'  => 'Hutan Desa',
        'HKm' => 'Hutan Kemasyarakatan',
        'HTR' => 'Hutan Tanaman Rakyat',
        'KK'  => 'Kemitraan Kehutanan',
    ];
    private $dict_skemaPSLearningPlans = [
        'HA'  => 'Hutan Adat (HA)',
        'HD'  => 'Hutan Desa (HD)',
        'HKm' => 'Hutan Kemasyarakatan (HKm)',
        'HTR' => 'Hutan Tanaman Rakyat (HTR)',
        'KK'  => 'Kemitraan Kehutanan (KK)',
    ];
    private $dict_skemaPSCohorts = [
        'HA'  => 'Cohorts HA',
        'HD'  => 'Cohorts HD',
        'HKm' => 'Cohorts HKm',
        'HTR' => 'Cohorts HTR',
        'KK'  => 'Cohorts KK',
    ];

    public function __construct() {
        $app_info = AppInfo::find(1);
        $this->baseurl = $app_info->moodle_url;
        $this->wstoken = $app_info->moodle_token;        
    }
    
    public function registerUser($id, $param) {
        $firstname = $param['name'];
        $lastname = $param['lastname'];
        $query = $this->baseurl.'/webservice/rest/server.php?wsfunction=core_user_create_users&wstoken='.$this->wstoken.'&users[0][username]='.$param['username'].'&users[0][firstname]='.$firstname.'&users[0][lastname]='.$lastname.'&users[0][email]='.$param['email'].'&users[0][auth]=oauth2';
        $response = Http::get($query);
        if ($response->status() == '200' && strpos($response->body(), '<KEY name="id">')) {
            $status = true;
            $updatedData['transferred_to_moodle'] = 'yes';
            $updatedData['modified_by'] = 'system';
            User::find($id)->update($updatedData);
        } else {
            $status = false;
        }
        return $status;
    }

    public function enrollUserToCourse($id, $skema_ps) {
        $id_moodle = $this->getUserID($id);
        $role = $this->getRoleStudent();
        $category = $this->getCourseCategory($skema_ps);
        $courses = $this->getCourses($category);
        $qstring = '';
        for ($i=0; $i<count($courses); $i++) {
            $qstring .= '&enrolments['.$i.'][roleid]='.$role.'&enrolments['.$i.'][userid]='.$id_moodle.'&enrolments['.$i.'][courseid]='.$courses[$i].'&enrolments['.$i.'][timestart]=0&enrolments['.$i.'][timeend]=0&enrolments['.$i.'][suspend]=0';
        }
        $query = $this->baseurl.'/webservice/rest/server.php?wsfunction=enrol_manual_enrol_users&wstoken='.$this->wstoken.$qstring;
        $response = Http::post($query);
        if ($response->status() == '200' && strpos($response->body(), '<RESPONSE>')) {
            $status = true;
            $status2 = $this->assignUserToCompPlan($id_moodle, $skema_ps);
            $status = $status && $status2;
            $status2 = $this->assignUserToCohorts($id_moodle, $skema_ps);
            $status = $status && $status2;
        } else {
            $status = false;
        }
        return $status;
    }

    public function assignUserToCompPlan($id, $skema_ps) {
        $learningPlan = $this->dict_skemaPSLearningPlans[$skema_ps];
        $template = $this->getTemplate($skema_ps);
        $query = $this->baseurl.'/webservice/rest/server.php?wsfunction=core_competency_create_plan&wstoken='.$this->wstoken.'&plan[name]='.$learningPlan.'&plan[userid]='.$id.'&plan[templateid]='.$template.'&plan[status]=1';
        $response = Http::post($query);
        if ($response->status() == '200' && strpos($response->body(), '<KEY name="userid">')) {
            $status = true;
        } else {
            $status = false;
        }
        return $status;
    }

    public function assignUserToCohorts($id, $skema_ps) {
        $cohort = $this->getCohorts($skema_ps);
        $query = $this->baseurl.'/webservice/rest/server.php?wsfunction=core_cohort_add_cohort_members&wstoken='.$this->wstoken.'&members[0][cohorttype][type]=id&members[0][cohorttype][value]='.$cohort.'&members[0][usertype][type]=id&members[0][usertype][value]='.$id;
        $response = Http::post($query);
        if ($response->status() == '200' && strpos($response->body(), '<MULTIPLE></MULTIPLE>')) {
            $status = true;
        } else {
            $status = false;
        }
        return $status;
    }
    
    public function getUserID($id) {
        $user = User::find($id);
        $uname = $user->username;
        $query = $this->baseurl.'/webservice/rest/server.php?wsfunction=core_user_get_users_by_field&wstoken='.$this->wstoken.'&field=username&values[0]='.$uname;
        $response = Http::get($query);
        if ($response->status() == '200' && strpos($response->body(), '<KEY name="id">')) {
            $reader = XmlReader::fromString($response->body());
            $result = $reader->element('RESPONSE.MULTIPLE.SINGLE.KEY.0.VALUE')->sole()->getContent();
        } else {
            $result = false;
        }
        return $result;
    }

    public function getRoleStudent() {
        // moodle doesn't have webservice function for obtain role id, so it's hard-coded for now
        // default role id for student = 5
        // to be updated in the future if such function exists
        return 5;
    }

    public function getCourseCategory($skema_ps) {
        $category_name = $this->dict_skemaPSCategories[$skema_ps];
        $query = $this->baseurl.'/webservice/rest/server.php?wsfunction=core_course_get_categories&wstoken='.$this->wstoken.'&criteria[0][key]=name&criteria[0][value]='.$category_name;
        $response = Http::get($query);
        if ($response->status() == '200' && strpos($response->body(), '<KEY name="id">')) {
            $reader = XmlReader::fromString($response->body());
            $result = $reader->element('RESPONSE.MULTIPLE.SINGLE.KEY.0.VALUE')->sole()->getContent();
        } else {
            $result = false;
        }
        return $result;
    }

    public function getCourses($category) {
        $query = $this->baseurl.'/webservice/rest/server.php?wsfunction=core_course_get_courses_by_field&wstoken='.$this->wstoken.'&field=category&value='.$category;
        $response = Http::get($query);
        if ($response->status() == '200' && strpos($response->body(), '<KEY name="id">')) {
            $reader = XmlReader::fromString($response->body());
            $result = $reader->xpathValue('//KEY[@name="courses"]/MULTIPLE/SINGLE/KEY[@name="id"]/VALUE')->get();
        } else {
            $result = false;
        }
        return $result;
    }
    
    public function getCohorts($skema_ps) {
        $cohort = $this->dict_skemaPSCohorts[$skema_ps];
        $query = $this->baseurl.'/webservice/rest/server.php?wsfunction=core_cohort_search_cohorts&wstoken='.$this->wstoken.'&context[contextid]=1&query='.$cohort;
        $response = Http::get($query);
        if ($response->status() == '200' && strpos($response->body(), '<KEY name="id">')) {
            $reader = XmlReader::fromString($response->body());
            $result = $reader->xpathValue('//KEY[@name="cohorts"]/MULTIPLE/SINGLE/KEY[@name="id"]/VALUE')->get()[0];
        } else {
            $result = false;
        }
        return $result;
    }

    public function getTemplate($skema_ps) {
        $learningPlan = $this->dict_skemaPSLearningPlans[$skema_ps];
        $query = $this->baseurl.'/webservice/rest/server.php?wsfunction=core_competency_list_templates&wstoken='.$this->wstoken.'&context[contextid]=1';
        $response = Http::post($query);
        if ($response->status() == '200' && strpos($response->body(), '<KEY name="id">')) {
            $reader = XmlReader::fromString($response->body());
            $ids = $reader->xpathValue('//KEY[@name="id"]/VALUE')->get();
            $names = $reader->xpathValue('//KEY[@name="shortname"]/VALUE')->get();
            $id_name = array_search($learningPlan, $names);
            $result = $ids[$id_name];
        } else {
            $result = false;
        }
        return $result;
    }
}
