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
