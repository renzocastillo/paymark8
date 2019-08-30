<?php namespace App\Http\Controllers;

use Session;
use Request;
use DB;
use CRUDbooster;

class AdminCmsUsersController extends \crocodicstudio\crudbooster\controllers\CBController {


	public function cbInit() {
		# START CONFIGURATION DO NOT REMOVE THIS LINE
		$this->table               = 'cms_users';
		$this->primary_key         = 'id';
		$this->title_field         = "name";
		$this->button_action_style = 'button_icon';	
		$this->button_import 	   = FALSE;	
		$this->button_export 	   = FALSE;	
		# END CONFIGURATION DO NOT REMOVE THIS LINE
	
		# START COLUMNS DO NOT REMOVE THIS LINE
		$this->col = array();
		//$this->col[] = array("label"=>"N°", "name"=>"id");
		$this->col[] = array("label"=>"Nombre","name"=>"name");
		$this->col[] = array("label"=>"Estado","name"=>"estado","callback_php"=>'$row->estado ? "Activo" : "Inactivo"');
		if(CRUDBooster::myPrivilegeId()==2){
			$this->col[] = array("label"=>"Correo Paypal","name"=>"email_paypal");
		}
		//$this->col[] = array("label"=>"Correo","name"=>"email");
		$this->col[] = array("label"=>"Whatsapp","name"=>"whatsapp",'callback_php'=>'"<a href=\"https://wa.me/".$row->whatsapp."\" target=\"_blank\">$row->whatsapp</a>"');
		if(CRUDBooster::myPrivilegeId()==2){
			$this->col[] = array("label"=>"N° Reg. Actuales","name"=>"(select count(*) from cms_users p where p.cms_users_id=cms_users.id) as cantidad_reg");
		$this->col[] = array("label"=>"N° Reprod. Actuales","name"=>"(SELECT count(*) FROM reproducciones where videos_id = (select id from videos order by videos.id desc limit 1) and cms_users_id=cms_users.id) as cantidad_reprod","callback_php"=>'$row->cantidad_reprod ? $row->cantidad_reprod : 0');
			$this->col[] = array("label"=>"Monto a Pagar", "name"=>"(SELECT IFNULL( (select monto from solicitudes_de_pago where cms_users_id=cms_users.id order by solicitudes_de_pago.id desc),0)) as monto");
			$this->col[] = array("label"=>"Estado Depósito","name"=>"(select nombre from estados where id= ( select estados_id from solicitudes_de_pago where cms_users_id=id order by solicitudes_de_pago.id desc limit 1)) as estado_solicitud","callback_php"=>'$row->estado_solicitud ? $row->estado_solicitud : "Sin solicitar"');
			$this->col[] = array("label"=>"Fecha Solicitud","name"=>"(select created_at from solicitudes_de_pago where cms_users_id=id order by solicitudes_de_pago.id desc limit 1) as fecha_solicitud","callback_php"=>'$row->fecha_solicitud ? $row->fecha_solicitud : "Ninguna"');
			$this->col[] = array("label"=>"Patrocinador","name"=>"cms_users_id","join"=>"cms_users,name");
			$this->col[] = array("label"=>"Foto","name"=>"photo","image"=>1);	
			//$this->col[] = array("label"=>"Tipo","name"=>"id_cms_privileges","join"=>"cms_privileges,name");	
		}
		# END COLUMNS DO NOT REMOVE THIS LINE

		# START FORM DO NOT REMOVE THIS LINE
		$this->form = array(); 		
		$this->form[] = array("label"=>"Name","name"=>"name",'required'=>true,'validation'=>'required|alpha_spaces|min:3');
		$this->form[] = array("label"=>"Email","name"=>"email",'required'=>true,'type'=>'email','validation'=>'required|email|unique:cms_users,email,'.CRUDBooster::getCurrentId());
		$this->form[] = array("label"=>"Paypal Email","name"=>"email_paypal",'required'=>true,'type'=>'email','validation'=>'required|email|unique:cms_users,email_paypal,'.CRUDBooster::getCurrentId());		
		$this->form[] = array("label"=>"Foto","name"=>"photo","type"=>"upload","help"=>"Recommended resolution is 200x200px",'required'=>true,'validation'=>'required|image|max:1000','resize_width'=>90,'resize_height'=>90);											
		$this->form[] = array("label"=>"Tipo","name"=>"id_cms_privileges","type"=>"select","datatable"=>"cms_privileges,name","datatable_where"=>'id!=1','required'=>true);						
		// $this->form[] = array("label"=>"Password","name"=>"password","type"=>"password","help"=>"Please leave empty if not change");
		$this->form[] = array("label"=>"Password","name"=>"password","type"=>"password","help"=>"Please leave empty if not change");
		$this->form[] = array("label"=>"Password Confirmation","name"=>"password_confirmation","type"=>"password","help"=>"Please leave empty if not change");
		# END FORM DO NOT REMOVE THIS LINE
		if(CRUDBooster::myPrivilegeId()==2){
			if(empty($row->monto)){
				$this->addaction[] =['label'=>'','url'=>'#pagar_modal','icon'=>'fa fa-dollar','color'=>'warning'];
			}
			$this->addaction[] =['label'=>'','url'=>'#activar_modal','icon'=>'fa fa-phone','color'=>'warning'];
		}
		$this->script_js =  "
							$( document ).ready(function() {
								$('a[href=\"#activar_modal\"]').replaceWith(\"<a class='btn btn-xs btn-warning' title='Activar al usuario' href='javascript:;' onclick='activado_popup();'>activar </button>\");
								$('a[href=\"#pagar_modal\"]').replaceWith(\"<a class='btn btn-xs btn-warning' title='Marcar el monto como pagado' href='javascript:;' onclick='pagado_popup();'>pagar </button>\");
							});
							function activado_popup(e){
								console.log('script de activacion');
								var row=$(event.target).parent().parent().prevAll().toArray();
								var users= [];
								$.each(row,function(i,val){
									users.push(val.innerHTML);
								});
								var length=users.length;
								var nombre=users[length-2];
								var html= $.parseHTML(users[length-1]);
								var id=$(html).val();
								console.log(id);
								var return_url= encodeURIComponent($(location).attr('href'));  
								console.log(return_url);
								swal({	
									title: '¿Quieres activar al usuario '+nombre+'?',	
									text: 'Asegúrate que el usuario haya realizado el pago de su registro ',
									type: 'warning', 
									showCancelButton: true,
									confirmButtonClass: 'danger',
									confirmButtonText: '¡Sí!',
									cancelButtonText: 'No', 
									closeOnConfirm: false },
									function(){
										location.href=document.location.origin+'/admin/users/change_user_estado/'+id+'?return_url='+return_url;
									}
								)
							};
							function pagado_popup(e){
								console.log('hi');
								var row=$(event.target).parent().parent().prevAll().toArray();
								var users= [];
								$.each(row,function(i,val){
									users.push(val.innerHTML);
								});
								var length=users.length;
								var nombre=users[length-2];
								var estado=pagado=2;
								var html= $.parseHTML(users[length-1]);
								var id=$(html).val();
								console.log(id);
								var return_url= encodeURIComponent($(location).attr('href'));  
								console.log(return_url);
								swal({	
									title: '¿Ya le has pagado el monto solicitado al usuario '+nombre+'?',	
									text: 'Asegúrate que el monto haya sido abonado',
									type: 'warning', 
									showCancelButton: true,
									confirmButtonClass: 'danger',
									confirmButtonText: '¡Sí!',
									cancelButtonText: 'No', 
									closeOnConfirm: false },
									function(){
										location.href=document.location.origin+'/admin/users/change_solicitud_estado/'+id+'?return_url='+return_url+'&estados_id='+estado_pagado;
									}
								)
							};
							";
		if(CRUDBooster::myPrivilegeId()==3){
			$id=CRUDBooster::myId();
			$vistas_x_afiliacion=DB::table('parametros')->where('name','vreg')->value('content');
			$user=DB::table('cms_users')->where('id',$id)->first();	
			$solicitud=DB::table('solicitudes_de_pago')->where('cms_users_id',$id)->latest();
			$fecha_solicitud=$solicitud->created_at ? $solicitud->created_at :'2000-01-01 00:00:00';
			$vistas_actuales=$user->vistas_actuales;
			$afiliaciones_actuales=$user->afiliaciones_actuales;
			$capacidad_de_vistas_a_favor=$user->capacidad_vistas_a_favor;
			$capacidad_de_vistas=$afiliaciones_actuales*$vistas_x_afiliacion+$capacidad_de_vistas_a_favor;
			$vistas_por_efectuar=$capacidad_de_vistas-$vistas_actuales;
			$vistas_por_efectuar= $vistas_por_efectuar >= 0 ? $vistas_por_efectuar : 0;
			$this->index_statistic[] = ['label'=>'N° Vistas Totales','count'=>DB::table('reproducciones')->where('cms_users_id',$id)->count(),'icon'=>'fa fa-bars','color'=>'red','width'=>'col-sm-2'];
			$this->index_statistic[] = ['label'=>'N° Actual de Vistas','count'=>$vistas_actuales,'icon'=>'fa fa-bars','color'=>'green','width'=>'col-sm-2'];
			$this->index_statistic[] = ['label'=>'N° Actual de Afiliaciones ','count'=>$afiliaciones_actuales,'icon'=>'fa fa-users','color'=>'red','width'=>'col-sm-2'];
			$this->index_statistic[] = ['label'=>'N° Usuarios sin Afiliarse','count'=>DB::table($this->table)->where('cms_users_id',$id)->whereNull('estado')->count(),'icon'=>'fa fa-users','color'=>'red','width'=>'col-sm-2'];					
			$this->index_statistic[] = ['label'=>'Vistas por Efectuar','count'=>$vistas_por_efectuar,'icon'=>'fa fa-users','color'=>'aqua','width'=>'col-sm-2'];					
		}
	}

	public function getProfile() {			

		$this->button_addmore = FALSE;
		$this->button_cancel  = FALSE;
		$this->button_show    = FALSE;			
		$this->button_add     = FALSE;
		$this->button_delete  = FALSE;	
		$this->hide_form 	  = ['id_cms_privileges'];

		$data['page_title'] = trans("crudbooster.label_button_profile");
		$data['row']        = CRUDBooster::first('cms_users',CRUDBooster::myId());		
		$this->cbView('crudbooster::default.form',$data);				
	}
	public function hook_before_edit(&$postdata,$id) { 
		unset($postdata['password_confirmation']);
	}
	public function hook_before_add(&$postdata) {      
	    unset($postdata['password_confirmation']);
	}
	public function hook_query_index(&$query) {
		if(CRUDBooster::myPrivilegeId()==2){
			$query->where($this->table.'.id_cms_privileges','=',3);
		}
		if(CRUDBooster::myPrivilegeId()==3){
			$query->where($this->table.'.cms_users_id','=',CRUDBooster::myId());
		}

	}
	public function changeUserEstado($id){
		$request=Request::all();
		DB::table('cms_users')
			->where('id',$id)
			->update(['estado'=>1]);
		CRUDBooster::redirect(urldecode($request['return_url']),"Usuario activado con éxito ","success");	
	}
	public function changeSolicitudEstado($id){
		$request=Request::all();
		DB::table('solicitudes_de_pago')
			->where('cms_users_id',$id)
			->orderby('id','desc')
			->limit(1)
			->update(['estados_id'=>$request['estados_id']]);
		CRUDBooster::redirect(urldecode($request['return_url']),"Usuario marcado como pagado con éxito","success");	
	}
}
