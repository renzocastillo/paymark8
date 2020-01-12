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
		//$this->orderby="name,asc";
		$this->button_bulk_action = true;
		$this->button_import 	   = FALSE;	
		$this->button_export 	   = FALSE;
		$this->button_add = false;
		$this->button_show = false;
		if(CRUDBooster::myPrivilegeId()!=3){
			$this->button_filter = true;
			$this->button_edit=true;
		}else{
			$this->button_filter = false;
			$this->button_edit=false;
		}
		//$this->button_bulk_action = false;
		# END CONFIGURATION DO NOT REMOVE THIS LINE
	
		# START COLUMNS DO NOT REMOVE THIS LINE
		$this->col = array();
		//$this->col[] = array("label"=>"N°", "name"=>"id");
		$this->col[] = array("label"=>"Nombre","name"=>"name");
		if(CRUDBooster::myPrivilegeId()==2){
			$this->col[] = array("label"=>"Estado","name"=>"estado","callback_php"=>'$row->estado ? "Activo" : "Inactivo"');
			//$this->col[] = array("label"=>"Premium","name"=>"premium","callback_php"=>'$row->premium ? "Sí" : "No"');
			$this->col[] = array("label"=>"Correo Registro","name"=>"email");
			$this->col[] = array("label"=>"Correo Paypal","name"=>"email_paypal");
		}
		//$this->col[] = array("label"=>"Correo","name"=>"email");
		$this->col[] = array(
            "label"        => "Whatsapp",
            "name"         => "whatsapp",
            "callback"=>function($row) {
                $country = DB::table( 'countries' )->where( 'id', $row->country_id )->first();
                if($country == null){
                    return '<a href="https://wa.me/+'.$row->whatsapp.'" target="_blank">'.$row->whatsapp.'</a>';
                }
                return '<a href="https://wa.me/+'.$country->phonecode.$row->whatsapp.'" target="_blank">+'.$country->phonecode.$row->whatsapp.'</a>';
            }
        );
        $this->col[] = [ "label" => "País", "name" => "country_id", "join" => "countries,name" ];
		if(CRUDBooster::myPrivilegeId()==2){
			$this->col[] = array("label"=>"Linkers Actuales","name"=>"afiliaciones_actuales");
			$this->col[] = array("label"=>"Vistas Actuales","name"=>"vistas_actuales");
			//$this->col[] = array("label"=>"Vistas Actuales","name"=>"(SELECT count(*) FROM reproducciones where videos_id = (select id from videos order by videos.id desc limit 1) and cms_users_id=cms_users.id) as cantidad_reprod","callback_php"=>'$row->cantidad_reprod ? $row->cantidad_reprod : 0');
			$this->col[] = array("label"=>"Linkers Solicitud","name"=>"(SELECT IFNULL( (select afiliados from solicitudes_de_pago where cms_users_id=cms_users.id order by solicitudes_de_pago.id desc limit 1),0)) as linkers_solicitados");
			$this->col[] = array("label"=>"Vistas Solicitud","name"=>"(SELECT IFNULL( (select vistas from solicitudes_de_pago where cms_users_id=cms_users.id order by solicitudes_de_pago.id desc limit 1),0)) as vistas_solicitadas");
			$this->col[] = array("label"=>"Monto Solicitado", "name"=>"(SELECT IFNULL( (select monto from solicitudes_de_pago where cms_users_id=cms_users.id order by solicitudes_de_pago.id desc limit 1),0)) as monto");
			$this->col[] = array("label"=>"Estado Solicitud","name"=>"(select nombre from estados where id= ( select estados_id from solicitudes_de_pago where cms_users_id=cms_users.id order by solicitudes_de_pago.id desc limit 1)) as estado_solicitud","callback_php"=>'$row->estado_solicitud ? ( $row->estado_solicitud == "solicitado" ? "<label class=\"label label-info\">$row->estado_solicitud</label>" : "<label class=\"label label-success\">$row->estado_solicitud</label>" ) : "Sin solicitar"');
			$this->col[] = array("label"=>"Fecha Solicitud","name"=>"(select created_at from solicitudes_de_pago where cms_users_id=cms_users.id order by solicitudes_de_pago.id desc limit 1) as fecha_solicitud","callback_php"=>'$row->fecha_solicitud ? date("d/m/y",strtotime($row->fecha_solicitud)) : "Ninguna"');
			$this->col[] = array("label"=>"Patrocinador","name"=>"cms_users_id","join"=>"cms_users,name");
			$this->col[] = array("label"=>"Foto","name"=>"photo","image"=>1);
			$this->col[] = ["label"=>"Fecha Registro", "name"=>"created_at","callback_php"=>'date("d/m/Y h:i A",strtotime($row->created_at))'];	
			$this->col[] = ["label"=>"Fecha Activación", "name"=>"activated_at","callback_php"=>'$row->activated_at ? date("d/m/Y h:i A",strtotime($row->activated_at)) : "sin información"'];	
			//$this->col[] = array("label"=>"Tipo","name"=>"id_cms_privileges","join"=>"cms_privileges,name");	
		}
		if(CRUDBooster::myPrivilegeId()==3){
			$this->col[] = array("label"=>"N° Total de Linkers","name"=>"( SELECT COUNT(*) FROM cms_users b where b.cms_users_id=cms_users.id and b.estado=1) as linkers_totales");
		}
		# END COLUMNS DO NOT REMOVE THIS LINE

		# START FORM DO NOT REMOVE THIS LINE
		$this->form = array(); 		
		$this->form[] = array("label"=>"Name","name"=>"name",'required'=>true,'validation'=>'required|alpha_spaces|min:3');
		$this->form[] = array("label"=>"Email","name"=>"email",'required'=>true,'type'=>'email','validation'=>'required|email|unique:cms_users,email,'.CRUDBooster::getCurrentId());
		$this->form[] = array("label"=>"Paypal Email","name"=>"email_paypal",'type'=>'email','validation'=>'email');		
		$this->form[] = array("label"=>"Teléfono Whatsapp","name"=>"whatsapp",'required'=>true,'validation'=>'required|min:8');
		$this->form[] = array("label"=>"Foto","name"=>"photo","type"=>"upload","help"=>"Resolución recomendada: 200x200px",'validation'=>'image|max:10000','resize_width'=>90,'resize_height'=>90);											
		$this->form[] = array("label"=>"Tipo","name"=>"id_cms_privileges","type"=>"select","datatable"=>"cms_privileges,name","datatable_where"=>'id!=1','required'=>true);						
		$id = CRUDBooster::getCurrentId();
		$row = CRUDBooster::first($this->table,$id);
		//$arr=['row'=>$row,'field'=>'premium','checked'=>false,'cms_privileges_id'=>2];
		//$custom_element=view('components.toggle',$arr)->render();
		//$this->form[] = array("label"=>"Premium","name"=>"premium","type"=>"custom","html"=>$custom_element);
		$this->form[] = array("label"=>"Contraseña Actual","name"=>"password","type"=>"password","help"=>"Dejar vacío si no se cambiará la contraseña");
		$this->form[] = array("label"=>"Repita Contraseña","name"=>"password_confirmation","type"=>"password","help"=>"Dejar vacío si no se cambiará la contrasñea");
		# END FORM DO NOT REMOVE THIS LINE
		if(CRUDBooster::myPrivilegeId()==2){
			$this->addaction[] =['label'=>'','url'=>'#pagar_modal','icon'=>'fa fa-dollar','color'=>'warning','showIf'=>'[estado_solicitud]=="solicitado"'];
			$this->addaction[] =['label'=>'','url'=>'#activar_modal','icon'=>'fa fa-phone','color'=>'warning','showIf'=>'[estado]==0'];
			$this->sub_module[] = ['label'=>'pagos','path'=>'ganancias','foreign_key'=>'cms_users_id','button_color'=>'success','button_icon'=>'fa fa-dollar','parent_columns'=>'name','parent_columns_alias'=>'Linker'];
			//$this->addaction[] =['label'=>'detalle','url'=>''];
			//$url_vars=['return_url'=>Request::fullurl(),'parent_table'=>'cms_users','parent_columns'=>'name','parent_columns_alias'=>'patrocinador','parent_id'=>''];
			//$this->addaction[] =['label'=>'','url'=>'#premium_modal','icon'=>'fa fa-star','color'=>'warning','showIf'=>'[premium]==0'];
		}
		$this->sub_module[] = ['label'=>'linkers','path'=>'users','foreign_key'=>'cms_users_id','button_color'=>'info','button_icon'=>'fa fa-group','parent_columns'=>'name','parent_columns_alias'=>'Patrocinador'];
		$this->script_js =  "
							$( document ).ready(function() {
								$('a[href=\"#activar_modal\"]').replaceWith(\"<a class='btn btn-xs btn-warning' title='Activar al usuario' href='javascript:;' onclick='activado_popup();'>activar </button>\");
								$('a[href=\"#pagar_modal\"]').replaceWith(\"<a class='btn btn-xs btn-info' title='Marcar el monto como pagado' href='javascript:;' onclick='pagado_popup();'>marcar pagado </button>\");
								//$('a[href=\"#premium_modal\"]').replaceWith(\"<a class='btn btn-xs btn-warning' title='Hacer premium a este usuario' href='javascript:;' onclick='premium_popup();'><i class='fa fa-star'></i> premium </button>\");
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
										$('.sweet-alert button').prop('disabled', true);
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
								var estado_pagado=2;
								var nombre=users[length-2];
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
										$('.sweet-alert button').prop('disabled', true);
										location.href=document.location.origin+'/admin/users/change_solicitud_estado/'+id+'?return_url='+return_url+'&estados_id='+estado_pagado;
									}
								)
							};
							/*function premium_popup(e){
								console.log('hi');
								var row=$(event.target).parent().parent().prevAll().toArray();
								var users= [];
								$.each(row,function(i,val){
									users.push(val.innerHTML);
								});
								var length=users.length;
								var estado_pagado=2;
								var nombre=users[length-2];
								var html= $.parseHTML(users[length-1]);
								var id=$(html).val();
								console.log(id);
								var return_url= encodeURIComponent($(location).attr('href'));  
								console.log(return_url);
								swal({	
									title: '¿Quieres volver premium a '+nombre+'?',	
									text: 'Tendrá comisiones extras por los linkers de sus linkers',
									type: 'warning', 
									showCancelButton: true,
									confirmButtonClass: 'danger',
									confirmButtonText: '¡Sí!',
									cancelButtonText: 'No', 
									closeOnConfirm: false },
									function(){
										$('.sweet-alert button').prop('disabled', true);
										location.href=document.location.origin+'/admin/users/change_premium_estado/'+id+'?return_url='+return_url;
									}
								)
							};*/
							";
		if(CRUDBooster::myPrivilegeId()==3){
			$request=Request::all();
			if($request['parent_table']=='cms_users'){
				$id=$request['parent_id'];
			}else{
				$id=CRUDBooster::myId();
			}
			$ganancia_x_nietos=DB::table('parametros')->where('name','gnietos')->value('content');
			$vistas_x_afiliacion=DB::table('parametros')->where('name','vreg')->value('content');
			$user=DB::table('cms_users')->where('id',$id)->first();	
			$solicitud=DB::table('solicitudes_de_pago')->where('cms_users_id',$id)->latest();
			$fecha_solicitud=$solicitud->created_at ? $solicitud->created_at :'2000-01-01 00:00:00';
			$vistas_actuales=$user->vistas_actuales;
			$nietos_actuales=$user->nietos_actuales;
			$afiliaciones_actuales=$user->afiliaciones_actuales;
			$capacidad_de_vistas_a_favor=$user->capacidad_vistas_a_favor;
			$capacidad_de_vistas=$afiliaciones_actuales*$vistas_x_afiliacion+$capacidad_de_vistas_a_favor;
			$vistas_por_efectuar=$capacidad_de_vistas-$vistas_actuales;
			$vistas_por_efectuar= $vistas_por_efectuar >= 0 ? $vistas_por_efectuar : 0;
			$ganancia_premium=$ganancia_x_nietos*$nietos_actuales;
			$this->index_statistic[] = ['label'=>'N° Vistas Totales','count'=>DB::table('reproducciones')->where('cms_users_id',$id)->count(),'icon'=>'fa fa-line-chart','color'=>'blue','width'=>'col-sm-2'];
			$this->index_statistic[] = ['label'=>'N° Actual de Vistas','count'=>$vistas_actuales,'icon'=>'fa fa-video-camera','color'=>'blue','width'=>'col-sm-2'];
			$this->index_statistic[] = ['label'=>'N° Actual de Linkers afiliados','count'=>$afiliaciones_actuales,'icon'=>'fa fa-users','color'=>'blue','width'=>'col-sm-2'];
			$this->index_statistic[] = ['label'=>'N° de Linkers Totales','count'=>DB::table($this->table)->where('cms_users_id',$id)->where('estado',1)->count(),'icon'=>'fa fa-user-times','color'=>'blue','width'=>'col-sm-2'];					
			$this->index_statistic[] = ['label'=>'N° de Linkers sin Activarse','count'=>DB::table($this->table)->where('cms_users_id',$id)->whereNull('estado')->count(),'icon'=>'fa fa-user-times','color'=>'blue','width'=>'col-sm-2'];					
			//$this->index_statistic[] = ['label'=>'Vistas por Efectuar','count'=>$vistas_por_efectuar,'icon'=>'fa fa-download','color'=>'blue','width'=>'col-sm-2'];					
			$this->index_statistic[] = ['label'=>'Ganancia por Linkers Indirectos Actual: Ganancia generada por los linkers de sus linkers actualmente','count'=>' $'.$ganancia_premium,'icon'=>'fa fa-usd','color'=>'blue','width'=>'col-sm-2 col-lg-3'];
		}
		if(CRUDBooster::myPrivilegeId()==2){
			$request=Request::all();
			if($request['parent_table']=='cms_users'){
				$id=$request['parent_id'];
				$user=DB::table('cms_users')->where('id',$id)->first();
				//$this->index_statistic[] = ['label'=>'Total Histórico de Ganancias: Dólares ganados en vistas y linkers afiliados hasta la fecha.','count'=>' $'.DB::table('solicitudes_de_pago')->where('cms_users_id',$id)->where('estados_id',2)->sum('monto'),'icon'=>'fa fa-line-chart','color'=>'blue','width'=>'col-sm-3 col-lg-3'];
				$capacidad_de_retiro=$this->getCapacidadDeRetiro($user->id);
				$this->index_statistic[] = ['label'=>'Capacidad de Retiro Actual: Monto que puede solicitar el linker actualmente','count'=>' $'.$capacidad_de_retiro,'icon'=>'fa fa-trophy','color'=>'blue','width'=>'col-sm-3 col-lg-3'];
				//if($user->premium){
				$ganancia_x_nietos=DB::table('parametros')->where('name','gnietos')->value('content');
				$nietos_actuales=$user->nietos_actuales;
				$ganancia_premium=$ganancia_x_nietos*$nietos_actuales;
				$this->index_statistic[] = ['label'=>'Ganancia por Linkers Indirectos Actual: Ganancia generada por los linkers de sus linkers actualmente','count'=>' $'.$ganancia_premium,'icon'=>'fa fa-usd','color'=>'blue','width'=>'col-sm-2 col-lg-3'];
				//}
				$monto_ultima_solicitud=$this->getMontoUltimaSolicitud($user->id);
				$monto_ultima_solicitud= $monto_ultima_solicitud > 0 ? $monto_ultima_solicitud : 0;
				$this->index_statistic[] = ['label'=>'Monto última Solicitud: Monto total de la última solicitud de pago del usuario','count'=>' $'.$monto_ultima_solicitud,'icon'=>'fa fa-trophy','color'=>'blue','width'=>'col-sm-3 col-lg-3'];
				$monto_solicitud_premium=$this->getMontoSolicitudPremium($user->id);
				//if($user->premium){
					$this->index_statistic[] = ['label'=>'Monto por Linkers de Linkers -> Última Solicitud: Monto ganado en la última solicitud generado por linkers de linkers','count'=>' $'.$monto_solicitud_premium,'icon'=>'fa fa-trophy','color'=>'blue','width'=>'col-sm-3 col-lg-3'];
				//}
			}
		}
		//if($user->premium){
		if(CRUDBooster::myPrivilegeId()==2){
			if($request['parent_table']=='cms_users'){
				$hijos=$this->getHijos($request['parent_id']);
				$html='';
				if(!$hijos->isEmpty()){
					foreach($hijos as $hijo){
						$nietos=$this->getNietosFromLastSolicitud($hijo);
						if(!empty($nietos)){
							$html=$html.'<tr><td>Linkers Directos: '.$hijo->name.'</td>';
							$string_nietos=ucwords(implode(', ',$nietos));
							$html=$html.'<td>Linkers Indirectos: '.$string_nietos.'</td></tr>';
						}else{
							$html='<tr><td>Todavía no has solicitado tu ganancia por primera vez</td></tr>';
						}
					}
				}else{
					$html='<tr><td>Todavía no has solicitado tu ganancia por primera vez</td></tr>';
				}
				$this->pre_index_html ='<div class="box box-solid box-success">
				<div class="box-body table-responsive no-padding">
					<table class="table table-bordered">
						<tbody>
						<tr class="active">
							<td colspan="2"><strong><i class="fa fa-bars"></i> Linkers Directos e Indirectos en la Última Ganancia </strong></td>
						</tr>'.
						$html.'
						</tbody>
					</table>
				</div>
				</div>';
			}
		}
		//}
		$this->load_js[] =asset("js/bootstrap-toggle.min.js");
		$this->load_js[] =asset("js/toggle.js");
		$this->load_js[] =asset("js/boolean.js");
		$this->load_css[] = asset("css/backoffice.css");
		$this->load_css[] = "https://fonts.googleapis.com/css?family=Raleway:400,500,600&display=swap";
		$this->load_css []= asset("css/bootstrap-toggle.min.css");
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
		/*if(empty($postdata['premium'])){
			$postdata['premium']=0;
		}*/
	}
	public function hook_before_add(&$postdata) {      
	    unset($postdata['password_confirmation']);
	}
	public function hook_query_index(&$query) {
		$request= Request::all();
		if(CRUDBooster::myPrivilegeId()==2){
			$query->where($this->table.'.id_cms_privileges','=',3);
			if($request['parent_table']=='cms_users'){
				$query->where($this->table.'.estado','=',1);
			}
		}
		if(CRUDBooster::myPrivilegeId()==3){
			if($request['parent_table']=='cms_users'){
				$query->where($this->table.'.cms_users_id','=',$request['parent_id']);
			}else{
				$query->where($this->table.'.cms_users_id','=',CRUDBooster::myId());
			}
			$query->where($this->table.'.estado','=',1);
		}
	}
	public function hook_before_delete($id) {
		$request=Request::all();
		$user=DB::table('cms_users')->where('cms_users_id',$id)->first();
		if($user->cms_users_id){
			CRUDBooster::redirect(CRUDBooster::mainpath(),'No se puede eliminar este usuario porque otros depende de éste','warning');
		}

	}
	public function changeUserEstado($id){
		$request=Request::all();
		//recuperamos el usuario de la BD
		$user=DB::table('cms_users')->where('id',$id)->first();
		//evaluamos si el usuario está inactivo para según eso activarlo o no
		if(!$user->estado){
			//activamos al usuario en la BD cambiándole su estado
			DB::table('cms_users')->where('id',$id)->update(['estado'=>1,'activated_at'=>now()]);
			//aumentamos la cantidad de afiliados actuales del patrocinador en 1
			if($user->cms_users_id){
				DB::table('cms_users')->where('id',$user->cms_users_id)->increment('afiliaciones_actuales',1);
				$abuelo=$this->getAbuelo($user->cms_users_id);
				if(!empty($abuelo)){
					//if($abuelo->premium){
						DB::table('cms_users')->where('id',$abuelo->id)->increment('nietos_actuales',1);
					//}
				}
			}
		}
		//mandamos un email a la cuenta de correo de este usuario
		$link=url('/'.$user->slug);
		$data = ['nombre'=>$user->name,'link'=>$link];
		CRUDBooster::sendEmail(['to'=>$user->email,'data'=>$data,'template'=>'activacion_exitosa']);
		CRUDBooster::redirect(urldecode($request['return_url']),"Usuario activado con éxito ","success");	
	}
	public function getAbuelo($idpadre){
		$padre=DB::table('cms_users')->where('id',$idpadre)->first();
		if($padre->cms_users_id){
			$abuelo=DB::table('cms_users')->where('id',$padre->cms_users_id)->first();
			return $abuelo;
		}else{
			return null;
		}
	}
	public function changeSolicitudEstado($id){
		$request=Request::all();
		DB::table('solicitudes_de_pago')
			->where('cms_users_id',$id)
			->orderby('id','desc')
			->limit(1)
			->update(['estados_id'=>$request['estados_id'],'updated_at'=>now()]);
		
		CRUDBooster::redirect(urldecode($request['return_url']),"Pago registrado con éxito","success");	
	}
	public function changePremiumEstado($id){
		$request=Request::all();
		DB::table('cms_users')
			->where('id',$id)
			->update(['premium'=>1]);
		CRUDBooster::redirect(urldecode($request['return_url']),"Usuario premium con éxito","success");	
	}
	public function registerUser(){
		$request=Request::all();
		$name=($request['name']);
		$whatsapp=$request['whatsapp'];
		$email=$request['email'];
		$password=bcrypt($request['password']);
		$patrocinador=$request['patrocinador']; 
		//$patrocinador=$request['patrocinador'] ? $request['patrocinador'] : NULL ;
		$slug=$this->makeSlug($name);
		DB::table('cms_users')
			->insert(['name'=>$name, 'email'=>$email,'password'=>$password, 'id_cms_privileges'=>3,'created_at'=>now(),'slug'=>$slug,'whatsapp'=>$whatsapp,'cms_users_id'=>$patrocinador]);
		
		$url = CRUDBooster::adminpath('login');
		return redirect($url)->with('message', 'Gracias por Registrarte! Inicia sesión para comenzar');
	}
	public function validarSlug($slug){
		$pointer=strlen($slug)+1;
		$slug_numerado=DB::table('cms_users')
					->select(DB::raw('substring(slug,'.$pointer.') as recorte'))
					->where('slug','LIKE',$slug.'%')
					->where('id_cms_privileges',3)
					->havingRaw("recorte REGEXP '^[0-9]+$'")
					->latest()
					->first();
		if(!empty($slug_numerado)){
			$numero=(int)$slug_numerado->recorte;
			$slug=$slug.($numero+1);
		}else{
			$slug_existe=DB::table('cms_users')->where('slug','LIKE',$slug)->exists();
			if($slug_existe){
				$slug=$slug.'1';
			}
		}
		return $slug;
	}
	public function makeSlug($name){
		$names=explode(" ", $name); //array (raul,robledo,maza)
		foreach($names as &$value){
			$value=preg_replace("/[^a-zA-Z0-9\_\-]+/", "",$value);
		}
		$nombre=$names[0];
		$apellido= $names[1] ? substr($names[1],0,3) : '';
		$slug=strtolower($nombre.$apellido);
		$slug=$this->validarSlug($slug);
		return $slug;
	}
	public function checkEmail(){
		$request=Request::all();
		$email=$request['email'];
		$exists=DB::table('cms_users')->where('email',$email)->exists();
		if($exists){
			echo 'false';
		}else{
			echo 'true';	
		}	
	}
	public function getCapacidadDeRetiro($id){
		$user=DB::table('cms_users')->where('id',$id)->first();
		$ganancia_x_vista=DB::table('parametros')->where('name','gvista')->value('content');
		$ganancia_x_afiliaciones=DB::table('parametros')->where('name','gafiliacion')->value('content');
		$ganancia_x_nietos=DB::table('parametros')->where('name','gnietos')->value('content');
		$vistas_x_afiliacion=DB::table('parametros')->where('name','vreg')->value('content');
		$pago_minimo=DB::table('parametros')->where('name','pmin')->value('content');
		
		$afiliaciones_actuales=$user->afiliaciones_actuales;
		$vistas_actuales=$user->vistas_actuales;
		$nietos_actuales=$user->nietos_actuales;
		$ganancia_premium=$ganancia_x_nietos*$nietos_actuales;
		$ganancia_x_afiliados_actuales=$afiliaciones_actuales*$ganancia_x_afiliaciones;
		$capacidad_de_vistas_a_favor=$user->capacidad_vistas_a_favor;
		
		$monto_total=$ganancia_x_vista*$vistas_actuales+$ganancia_x_afiliados_actuales+$ganancia_premium;
		$capacidad_de_vistas=$afiliaciones_actuales*$vistas_x_afiliacion+$capacidad_de_vistas_a_favor;
		$vistas_x_cobrar= $vistas_actuales <= $capacidad_de_vistas ? $vistas_actuales : $capacidad_de_vistas;
		$capacidad_de_retiro=$vistas_x_cobrar*$ganancia_x_vista+$ganancia_x_afiliados_actuales+$ganancia_premium;
		$capacidad_de_retiro= $capacidad_de_retiro >= $pago_minimo ? $capacidad_de_retiro : 0;

		return $capacidad_de_retiro;
	}
	public function getUltimaSolicitud($id){
		$solicitud=DB::table('solicitudes_de_pago')
				->where('cms_users_id',$id)
				->latest()
				->first();
		return $solicitud;
	}
	public function getPenultimaSolicitud($id){
		$solicitud=DB::table('solicitudes_de_pago')
				->where('cms_users_id',$id)
				->orderby('id','desc')
				->skip(1)
				->first();
		return $solicitud;
	}
	public function getMontoUltimaSolicitud($id){
		$solicitud=DB::table('solicitudes_de_pago')
				->where('cms_users_id',$id)
				->latest()
				->first();
		return $solicitud->monto;
	}
	public function getMontoSolicitudPremium($id){
		$ganancia_x_nietos=DB::table('parametros')->where('name','gnietos')->value('content');
		$solicitud=DB::table('solicitudes_de_pago')
				->where('cms_users_id',$id)
				->latest()
				->first();
		return $solicitud->nietos*$ganancia_x_nietos;
	}

	public function getHijos($id){
		$hijos=DB::table('cms_users')
				->where('cms_users_id',$id)
				->get();
		return $hijos;
	}
	public function getNietosFromLastSolicitud($hijo){
		$ultima=$this->getUltimaSolicitud($hijo->cms_users_id);
		$penultima=$this->getPenultimaSolicitud($hijo->cms_users_id);
		$nietos=DB::table('cms_users')
					->where('cms_users_id',$hijo->id);
		if($ultima->created_at){
			$nietos->whereNotNull('activated_at')
					->whereDate('activated_at','<',$ultima->created_at);
			if($penultima->created_at){
				$nietos->whereDate('activated_at','>',$penultima->created_at);
			}
			return $nietos->pluck('name')->toArray();
		}else{
			return null;
		}									
	}
}
