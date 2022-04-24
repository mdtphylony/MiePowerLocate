<?php
namespace App\Home\Controller;
//use Startmvc\Lib\Controller;
use App\Common\BaseController;
use Startmvc\Lib\Db\Sql;
use Startmvc\Lib\Http\Request;
use Startmvc\Lib\Http\Session;

class IndexController extends BaseController{
	protected $db;

	function __construct(){
		parent::__construct(); // 如果控制器有构造函数，就一定要调用父类的构造函数
		/*************
		控制器构造函数，主要用来在创建对象时初始化对象，控制器下所有成员方法都将执行此处代码
		**************/
		$dbconf=include ROOT_PATH . 'config/database.php';
		$this->db= new Sql($dbconf);
	}

	public function indexAction()
	{
		//获取隔离信息；
		$data=$this->db->select(['id','date','build_num'])->table('quarantine')->orderBy('id desc')->limit(10)->getAll();
		//获取新闻
		$date=$this->db->select("date")->table("news")->orderBy('date desc')->limit(1)->getAll();
		$data1=$this->db->select(['id','date','road_num','build_num','mie_status','build_status','build_desc'])->table('news')->orderBy('id desc')->where('date',$date[0]["date"])->getAll();
		$dates=new \DateTime($data[0]['date']);
		$month=$dates->format("n");
		$day=$dates->format("j");
		$this->assign("month",$month);
		$this->assign("day",$day);
		$this->assign("data",$data1);
		$this->view();
	}

	public function loginAction(){
		if(Session::get("mobile")){
			$this->redirect('/index.php/index/edit'); //重定向到/index/edit
		}
		if(Request::isPost()){
			$mobile= Request::post('mobile');
			$psw= Request::post("password");
			if($psw=='123456'){
				Session::set("mobile", $mobile); 
				$data=["result"=> "1","msg"=>"/index.php/index/edit"];
			}else{
				$data=["result"=> "0","msg"=>"login Failed".$psw];
			}
			$this->json($data);

		}else{
			$this->view();
		}
	}

	public function addLocation($input){
		$build_num=$input["build_num"];
		$location=$input["location"];
		$result= $this->db->select("build_num")->table("map")->where("build_num",$build_num)->getAll();
		if(empty( $result)){
			$update = [
				'build_desc' => '健康',
				'positive_time' => '2022/04/21',
				'mobile' => '18900000000',
				'latlng' => $location,
				'build_num' => $build_num
			];
			$this->db->table("map")->insert($update);

		}else{
			$update = [
				'latlng' => $location
			];
			$this->db->table("map")->where("build_num",$input["build_num"])->update($update);
		}
		$data=["result"=> "1","msg"=>"/index.php/index/build"];
		$this->json($data);
	}

	public function buildAction(){
		if(Session::get("mobile")){
			if(Request::isPost()){
				$input=[
					"build_num"=>Request::post("build_num"),
					"location" =>Request::post("location")
				];
				$this->addLocation($input);
	
			}else{
				$this->view();
			}
		}else{
			$this->redirect('/index.php/index/login'); //重定向到/index/login
		}

	}
	
	public function releaseAction(){
		if(Session::get("mobile")){
			if(Request::isPost()){
				if(Request::post("build_num")=="" || Request::post("date")==""){
					$data=["result"=> "0","msg"=>"/index.php/index/build"];
					$this->json($data);			
					return;
				}
				$input=[
					"build_num"=>Request::post("build_num"),
					"date" =>Request::post("release_date")
				];
				$this->db->table("quarantine")->insert($input);
				$data=["result"=> "1","msg"=>"/index.php/index/build#tab2"];
				$this->json($data);		

			}else{
				$data=$this->db->select(['id','date','build_num'])->table('quarantine')->orderBy('id desc')->limit(10)->getAll();
				$this->json($data);
			}
		}else{
			$this->redirect('/index.php/index/login'); //重定向到/index/login
		}

	}

	public function newsAction(){
		if(Session::get("mobile")){
			if(Request::isPost()){
				if(Request::post("build_num")=="" || Request::post("build_desc")==""){
					$data=["result"=> "0","msg"=>"/index.php/index/build"];
					$this->json($data);			
					return;
				}
				$input=[
					"date"=>Request::post("build_date"),
					"road_num" =>Request::post("road_num"),
					"build_num" =>Request::post("build_num"),
					"mie_status" =>Request::post("mie_status"),
					"build_status" =>Request::post("build_status"),
					"build_desc" =>Request::post("build_desc"),
				];
				$count=$this->db->count('id')->table("news")->where('date',$input['date'])->where('road_num',$input['road_num'])->where('build_num',$input['build_num'])->getAll();

				if($count[0]['COUNT(id)']==0){
					$this->db->table("news")->insert($input);
				}else{
					$da=$this->db->select(['id'])->table("news")->where('date',$input['date'])->where('road_num',$input['road_num'])->where('build_num',$input['build_num'])->getAll();
					$this->db->table("news")->where('id',$da[0]['id'])->update($input);
				}
				$data=["result"=>"1","msg"=>"/index.php/index/build#tab3"];

				$this->json($data);		
			}else{
				$date=$this->db->select("date")->table("news")->orderBy('date desc')->limit(1)->getAll();
				$data=$this->db->select(['id','date','road_num','build_num','mie_status','build_status','build_desc'])->table('news')->orderBy('id desc')->where('date',$date[0]["date"])->getAll();
				$this->json($data);
			}
		}else{
			$this->redirect('/index.php/index/login'); //重定向到/index/login
		}

	}

	public function uploadAction(){
		if(Session::get("mobile")){
			if(Request::isPost()){
				$input=[
					"build_num"=>Request::post("build_num"),
					"location" =>Request::post("location")
				];
				$this->addLocation($input);
	
			}else{
				$this->view();
			}
		}else{
			$this->redirect('/index.php/index/login'); //重定向到/index/login
		}
	}

	public function addData($input){
		var_dump($input);

		$data['build_num']=$input['build_num'];
		$data["description"]=htmlspecialchars($input["build_desc"]);
		$data["positive_date"]=$input["positive_time"];
		$data["contact_mobile"]=Session::get("mobile");
		var_dump($data);
		$update = [
			'build_desc' => $data['description'],
			'positive_time' => $data["positive_date"],
			'mobile' => Session::get("mobile")
			];
		$this->db->table("info")->insert($data);
		$this->db->table("map")->where("build_num",$input["build_num"])->update($update);
	}

	public function editAction(){
		if(Session::get("mobile")){
			$mobile=Session::get("mobile");
		}else{
			$this->redirect('/index.php/index/login'); //重定向到/index/edit
		}

		if(Request::isPost()){
			$input=[
				"build_num" => Request::post("build_num"),
				"build_desc" => Request::post("desc"),
				"positive_time" => Request::post("date")
			];
			$this->addData($input);
			$data=["result"=> "1","msg"=>"update succeed!"];
			$this->json($data);
		}else{
			$this->view();
		}

	}

	public function infoAction($build_num){
		$data=$this->db->select(['build_desc','positive_time'])->table("map")->where("build_num",$build_num)->getAll();
		$this->json($data);
	}

	public function moreAction($build_num){
		$data=$this->db->select(['description','positive_date'])->table("info")->where("build_num",$build_num)->getAll();
		$this->json($data);
	}



	public function mapAction(){
		$data=$this->db->select(["build_num","latlng","positive_time","build_desc","mobile"])->table("map")->getAll();
		$this->json($data);

	}
	
	public function edit_buildAction($build_num){
		
		$this->view();

	}

	public function __call($name,$arg)
	{
		$this->content("走丢了。。。。。。。。");
	}
}
