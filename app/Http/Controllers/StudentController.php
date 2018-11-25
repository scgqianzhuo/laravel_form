<?php
/**
 * Created by PhpStorm.
 * User: qianzhuo
 * Date: 2018/11/11
 * Time: 14:09
 */

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use Validator;
use Illuminate\Support\Facades\Storage;
use App\libraries\classes\studentAct;


class StudentController extends Controller
{
    
    private $studentOb= '' ;//模型对象
    private $students = [];//学生数据

    public function __construct()
    {
        $this->studentOb = new student();
        $this->students = $this->studentOb->paginate(10);
    }

	//学员列表页面
    public function index()
    {

        $this->students = $this->studentOb->paginate(10);

        return view('student.index',[
        	'students'=>$this->students
        ]);

    }


    //学员添加页面
    public function create()
    {
    	return view('student.create',[
            'students'=>$this->students
        ]);
    }

    //学员数据保存(ajax)
    public function save(Request $request)
    {

        if($request->isMethod('POST')){
            $file = $request->file('file-2');
            if($file->isValid()){

                $originalName = $file->getClientOriginalName();

                //获取文件的扩展名
                $kuoname=$file->getClientOriginalExtension();

                //获取文件的类型
                $type=$file->getClientMimeType();

                //获取文件的绝对路径，但是获取到的在本地不能打开
                $path=$file->getRealPath();

                //要保存的文件名 时间+扩展名
                $filename=date('Y-m-d-H-i-s') . '_' . uniqid() .'.'.$kuoname;
                //保存文件          配置文件存放文件的名字  ，文件名，路径
                $bool= Storage::disk('uploads')->put($filename,file_get_contents($path));

            }
            

            Validator::make($request->input(), [
                'name' => 'required|min:2|max:255',
                'phone' => 'required',
            ])->validate();
            $data = [];
            $data['name'] = $request->input('name');
            $data['phone'] = $request->input('phone');
            $data['sex'] = $request->input('sex');
            $data['city'] = $request->input('city');
            $data['email'] = $request->input('email');
            $data['icon'] = isset($filename)?$filename:'';

            //待验证
            $res = Student::create($data);

            if($res){
                $data = ['code'=>'200','data'=>''];
            }else{
                $data = ['code'=>'201','data'=>'保存失败'];
            }

            exit(json_encode($data));

        }

    }


    //学员数据编辑

    public function edit(Request $request,$id)
    {
        $student = Student::find($id);
        if($request->isMethod('POST')){
            $file = $request->file('file-2');
            if($file){
                if($file->isValid()){

                    $originalName = $file->getClientOriginalName();

                    //获取文件的扩展名
                    $kuoname=$file->getClientOriginalExtension();

                    //获取文件的类型
                    $type=$file->getClientMimeType();

                    //获取文件的绝对路径，但是获取到的在本地不能打开
                    $path=$file->getRealPath();

                    //要保存的文件名 时间+扩展名
                    $filename=date('Y-m-d-H-i-s') . '_' . uniqid() .'.'.$kuoname;
                    //保存文件          配置文件存放文件的名字  ，文件名，路径
                    $bool= Storage::disk('uploads')->put($filename,file_get_contents($path));

                }
            }
            
            $data = $request->all();
            $student->name = $data['name'];
            $student->sex = $data['sex'];
            $student->phone = $data['phone'];
            $student->email = $data['email'];
            $student->city = $data['city'];
            if(isset($filename)){
                $student->icon = $filename;
            }
            $res = $student->save();

            $data = ['code'=>'200','data'=>''];


            exit(json_encode($data));

        }
        return view('student/edit',[
            'student'=>$student,
            'students'=>$this->students
        ]);
        
    }


    //修改学员状态
    public function status(Request $request)
    {
        if($request->ajax()){
            $id = $request->input('id');
            $student  = Student::find($id);
            $student->status  = abs($student->status-1);
            $res = $student->save();
            if($res){
                exit('1');
            }else{
                exit('0');
            }
        }
    }

    public function del(Request $request)
    {
        if($request->isMethod('POST')){
            //批量删除
            if($request->input('studentIds')){
                $ids = $request->input('studentIds');
                 if(!empty($ids)){
                    $res = Student::destroy($ids);
                    return redirect(url('student/index'));
                }

            }

            //单条删除
            if($request->ajax()){
                $ids = $request->input('ids');
                if(!empty($ids)){
                    $res = Student::destroy([$ids]);
                    exit('1');
                }else{
                    exit('0');
                }
            }else{
                exit('0');
            }
        }
        
    }


    public function show($id)
    {
        $student = Student::find($id);
        return view('student.show',[
            'students'=>$this->students,
            'student'=>$student

        ]);
    }


    //学生搜索
    public function search(Request $request)
    {
        if($request->isMethod('POST')){
            if(!empty($request->input('start_time'))){
                $where[] = ['created_at','>',strtotime($request->input('start_time'))];
            }
            if(!empty($request->input('end_time'))){
                $where[] = ['created_at','<',strtotime($request->input('end_time'))];
            }
            if(!empty($request->input('search_text'))){
                $where[] = ['name','like','%'.$request->input('search_text').'%'];
            }

            $students = Student::where($where)->paginate(10);

            return view('student/index',[
                'students'=>$students,
//                'start_time'=>$request->input('start_time'),
//                'end_time'=>!empty($request->input('end_time'))?$request->input('end_time'):date('Y-m-d',time()),
                'search_text'=>$request->input('search_text')
            ]);
        }
    }
}