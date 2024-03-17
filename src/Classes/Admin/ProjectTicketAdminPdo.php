<?php
namespace Src\Classes\Admin;
use App\Providers\Response\Response;
use App\Providers\Constants\StatusConstants;
use App\Providers\TraitService\DBConnectServiceTrait;
class ProjectTicketAdminPdo{
	use DBConnectServiceTrait;
	public function maSomaneSaveProject(string $projectName = "",string $Decription = "",int $Sprint = 0,int $user=0):array{
		$sql = "insert into masomane_projects(name,sprint,description,time_added,added_by)values(?,?,?,NOW(),?)";
		$params = [$projectName,$Sprint,$Decription,$user];
		$strParams = "ssss";
		return $this->connect->postDataSafely($sql,$strParams,$params);
	}
	public function maSomaneGetProject(int $status=1):array{
		$sql = "select 
					ms_p.id as project_id,
					ms_p.name as project_name,
					ms_p.sprint as project_sprint,
					ms_p.description project_description,
					ms_p.phase project_phase,
					ms_p.added_by,
					ms_p.time_added,	
					m_p_s.status as status
				from masomane_projects as ms_p 
					left join masomane_project_status as m_p_s on m_p_s.id = ms_p.status
				where m_p_s.id =? order by m_p_s.id ASC ";
		$params = [$status];
		$strParams = "s";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)??[];
	}
	public function maSomaneGetProjects(){
		$sql="select id as id, name as name, description from masomane_projects where status !=3 order by id desc";
		$params = [];
		$strParams = "";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)??[];
	}
	public function maSomaneSaveTicket($editorEDS,$projectStatsI,$textTicketDescription,$textTicketWeight,$user){
		$sql = "insert into masomane_tickets(project_id,ticket_description,ticket_weight,ticket_details,added_by,date_time)values(?,?,?,?,?,NOW())";
		$params = [$projectStatsI,$textTicketDescription,$textTicketWeight,$editorEDS,$user];
		$strParams = "sssss";
		return $this->connect->postDataSafely($sql,$strParams,$params);
	}
	public function maSomaneGetThisProjectTicket(int $projects=0):array{
		$sql = "select
					ts.id as ticket_status_id,
					ts.ticket_status as status,
					ms_t.project_id as project_id,
					ms_t.ticket_description as ticket_description,
					ms_t.ticket_weight as ticket_weight,
					ms_t.ticket_details as ticket_details,
					ms_t.added_by as added_by,
					ms_t.id as ticket_id,
				
					if(
							ms_t.assigned_to='',
							'NOT ASSIGNED',
					  	if(
					  		(
					  			select 
								concat(name,' ',surname)
								from masomane_users 
								where id=ms_t.assigned_to and status='A'
							)='','NOT ASSIGNED'
							,
					 		(
					 			select 
								concat(name,' ',surname) 
								from masomane_users 
								where id=ms_t.assigned_to and status='A'
							)

						)	
					)as assigned_to,
					(select logo from masomane_users where id=ms_t.assigned_to and status='A') as logo,
					(select id from masomane_users where id=ms_t.assigned_to and status='A') as user_id
				from masomane_tickets as ms_t
					left join ticket_statuses as ts on ts.id = ms_t.status
					
				where ms_t.project_id = ? ";
		$params = [$projects];
		$strParams = "s";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)??[];
	}
	public function masomaneGetThisTicket(int $ticket = 0):array{
		$sql = "select
					ts.id as ticket_status_id,
					ts.ticket_status as status,
					ms_t.project_id as project_id,
					ms_t.ticket_description as ticket_description,
					ms_t.ticket_weight as ticket_weight,
					ms_t.ticket_details as ticket_details,
					ms_t.added_by as added_by,
					ms_t.id as ticket_id,
				
					if(
							ms_t.assigned_to='',
							'NOT ASSIGNED',
					  	if(
					  		(
					  			select 
								concat(name,' ',surname)
								from masomane_users 
								where id=ms_t.assigned_to and status='A'
							)='','NOT ASSIGNED'
							,
					 		(
					 			select 
								concat(name,' ',surname) 
								from masomane_users 
								where id=ms_t.assigned_to and status='A'
							)

						)	
					)as assigned_to,
					(select logo from masomane_users where id=ms_t.assigned_to and status='A') as logo,
					(select id from masomane_users where id=ms_t.assigned_to and status='A') as user_id
				from masomane_tickets as ms_t
					left join ticket_statuses as ts on ts.id = ms_t.status
					
				where ms_t.id = ? ";
		$params = [$ticket];
		$strParams = "s";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)[0]??[];
	}
	public function getStatuses():void{
		$sql="select*from ticket_statuses";
		$params = [];
		$strParams = "";
		$Rap = $this->connect->getAllDataSafely($sql,$strParams,$params)??[];
		foreach($Rap as $row){
			?>
			<option value="<?php echo $row['id']?>"><?php echo $row['ticket_status']?></option>
			<?php
		}

	}
	public function maSomaneSaveTicketUpdate($ticket_status,$ticket_id):array{
		$sql="update masomane_tickets set status = ? where id = ?";
		$strParams = "ss";
		$params = [$ticket_status,$ticket_id];
		$response = $this->connect->postDataSafely($sql,$strParams,$params);
	}
}
?>