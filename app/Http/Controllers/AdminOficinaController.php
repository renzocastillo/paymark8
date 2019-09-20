<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;

	class AdminOficinaController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "id";
			$this->limit = "20";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_bulk_action = true;
			$this->button_action_style = "button_icon";
			$this->button_add = false;
			$this->button_edit = false;
			$this->button_delete =false;
			$this->button_detail = false;
			$this->button_show = false;
			$this->button_filter = false;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "cms_users";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Imagen","name"=>"imagen","image"=>true];
			$this->col[] = ["label"=>"Url","name"=>"url"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Imagen','name'=>'imagen','type'=>'upload','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Url','name'=>'url','type'=>'text','validation'=>'required|url','width'=>'col-sm-10','placeholder'=>'Please enter a valid URL'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ["label"=>"Imagen","name"=>"imagen","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Url","name"=>"url","type"=>"text","required"=>TRUE,"validation"=>"required|url","placeholder"=>"Please enter a valid URL"];
			# OLD END FORM

			/* 
	        | ---------------------------------------------------------------------- 
	        | Sub Module
	        | ----------------------------------------------------------------------     
			| @label          = Label of action 
			| @path           = Path of sub module
			| @foreign_key 	  = foreign key of sub table/module
			| @button_color   = Bootstrap Class (primary,success,warning,danger)
			| @button_icon    = Font Awesome Class  
			| @parent_columns = Sparate with comma, e.g : name,created_at
	        | 
	        */
	        $this->sub_module = array();


	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add More Action Button / Menu
	        | ----------------------------------------------------------------------     
	        | @label       = Label of action 
	        | @url         = Target URL, you can use field alias. e.g : [id], [name], [title], etc
	        | @icon        = Font awesome class icon. e.g : fa fa-bars
	        | @color 	   = Default is primary. (primary, warning, succecss, info)     
	        | @showIf 	   = If condition when action show. Use field alias. e.g : [id] == 1
	        | 
	        */
	        $this->addaction = array();


	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add More Button Selected
	        | ----------------------------------------------------------------------     
	        | @label       = Label of action 
	        | @icon 	   = Icon from fontawesome
	        | @name 	   = Name of button 
	        | Then about the action, you should code at actionButtonSelected method 
	        | 
	        */
	        $this->button_selected = array();

	                
	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add alert message to this module at overheader
	        | ----------------------------------------------------------------------     
	        | @message = Text of message 
	        | @type    = warning,success,danger,info        
	        | 
	        */
	        $this->alert        = array();
	                

	        
	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add more button to header button 
	        | ----------------------------------------------------------------------     
	        | @label = Name of button 
	        | @url   = URL Target
	        | @icon  = Icon from Awesome.
	        | 
	        */
	        $this->index_button = array();



	        /* 
	        | ---------------------------------------------------------------------- 
	        | Customize Table Row Color
	        | ----------------------------------------------------------------------     
	        | @condition = If condition. You may use field alias. E.g : [id] == 1
	        | @color = Default is none. You can use bootstrap success,info,warning,danger,primary.        
	        | 
	        */
	        $this->table_row_color = array();     	          

	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | You may use this bellow array to add statistic at dashboard 
	        | ---------------------------------------------------------------------- 
	        | @label, @count, @icon, @color 
	        |
			*/
			$ganancia_x_vista=DB::table('parametros')->where('name','gvista')->value('content');
			$ganancia_x_afiliaciones=DB::table('parametros')->where('name','gafiliacion')->value('content');
			$pago_minimo=DB::table('parametros')->where('name','pmin')->value('content');
			$vistas_x_afiliacion=DB::table('parametros')->where('name','vreg')->value('content');
			$vistas_totales=DB::table('reproducciones')->where('cms_users_id')->count();
			$id=CRUDBooster::myId();
			$user=DB::table('cms_users')->where('id',$id)->first();
			$afiliaciones_actuales=$user->afiliaciones_actuales;
			$vistas_actuales=$user->vistas_actuales;
			$ganancia_total_actual=($ganancia_x_vista*$vistas_actuales)+($ganancia_x_afiliaciones*$afiliaciones_actuales);
			$capacidad_de_vistas_a_favor=$user->capacidad_vistas_a_favor;
			$capacidad_de_vistas=$afiliaciones_actuales*$vistas_x_afiliacion+$capacidad_de_vistas_a_favor;
			$capacidad_de_retiro=$capacidad_de_vistas >= $vistas_actuales ? $vistas_actuales*$ganancia_x_vista+$afiliaciones_actuales*$ganancia_x_afiliaciones : $capacidad_de_vistas*$ganancia_x_vista+$afiliaciones_actuales*$ganancia_x_afiliaciones;
			$capacidad_de_retiro= $capacidad_de_retiro >= $pago_minimo ? $capacidad_de_retiro : 0;
			$dolares_x_ganar=($capacidad_de_vistas-$vistas_actuales)*$ganancia_x_vista;
			$ganancia_x_vistas_actuales=$vistas_actuales*$ganancia_x_vista;
			$ganancia_x_afiliados_actuales=$afiliaciones_actuales*$ganancia_x_afiliaciones;
			$solicitud=DB::table('solicitudes_de_pago')->where('cms_users_id',$id)->latest()->first();
			$fecha_solicitud=$solicitud->created_at ? $solicitud->created_at :'2000-01-01 00:00:00';
			$vistas_actuales_reales=DB::table('reproducciones')->where('cms_users_id',CRUDBooster::myId())->where('created_at','>',$fecha_solicitud)->count();
			$vistas_a_favor=$vistas_actuales-$vistas_actuales_reales;
			$dolares_x_efectuarse=$ganancia_x_vista*$vistas_a_favor;

	        $this->index_statistic[] = ['label'=>'Total Histórico de Ganancias: Dólares ganados en vistas y afiliaciones hasta la fecha.','count'=>' $'.DB::table('solicitudes_de_pago')->where('cms_users_id',$id)->sum('monto'),'icon'=>'fa fa-line-chart','color'=>'blue','width'=>'col-sm-3 col-lg-6'];
			$this->index_statistic[] = ['label'=>'Ganancias por Vistas y Afiliaciones Actuales: Dólares ganados desde el último cobro hasta la fecha','count'=>' $'.$ganancia_total_actual,'icon'=>'fa fa-usd','color'=>'blue','width'=>'col-sm-3 col-lg-6 '];
			$this->index_statistic[] = ['label'=>'Capacidad de Retiro: 01 afiliación por cada 10 vistas y $20 como mínimo.','count'=>' $'.$capacidad_de_retiro,'icon'=>'fa fa-trophy','color'=>'blue','width'=>'col-sm-3 col-lg-6'];
			$this->index_statistic[] = ['label'=>'Dólares por Ganar: Dólares que ganarías si solo compartes tu link.','count'=>' $'.$dolares_x_ganar,'icon'=>'fa fa-download','color'=>'blue','width'=>'col-sm-3 col-lg-6'];
			$this->index_statistic[] = ['label'=>'Ganancia por Vistas Actuales: Dólares generados por compartir tu link','count'=>' $'.$ganancia_x_vistas_actuales,'icon'=>'fa fa-video-camera','color'=>'blue','width'=>'col-sm-3 col-lg-6'];
			$this->index_statistic[] = ['label'=>'Ganancia por Afiliados Actuales','count'=>' $'.$ganancia_x_afiliados_actuales,'icon'=>'fa fa-users','color'=>'blue','width'=>'col-sm-3 col-lg-6'];
			$this->index_statistic[] = ['label'=>'Dolares por Efectuarse','count'=>' $'.$dolares_x_efectuarse,'icon'=>'fa fa-usd','color'=>'blue','width'=>'col-sm-2 col-lg-6'];


	        /*
	        | ---------------------------------------------------------------------- 
	        | Add javascript at body 
	        | ---------------------------------------------------------------------- 
	        | javascript code in the variable 
	        | $this->script_js = "function() { ... }";
	        |
	        */
	        $this->script_js = NULL;


            /*
	        | ---------------------------------------------------------------------- 
	        | Include HTML Code before index table 
	        | ---------------------------------------------------------------------- 
	        | html code to display it before index table
	        | $this->pre_index_html = "<p>test</p>";
	        |
	        */
	        $this->pre_index_html = null;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include HTML Code after index table 
	        | ---------------------------------------------------------------------- 
	        | html code to display it after index table
	        | $this->post_index_html = "<p>test</p>";
	        |
	        */
	        $this->post_index_html = null;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include Javascript File 
	        | ---------------------------------------------------------------------- 
	        | URL of your javascript each array 
	        | $this->load_js[] = asset("myfile.js");
	        |
	        */
	        $this->load_js = array();
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Add css style at body 
	        | ---------------------------------------------------------------------- 
	        | css code in the variable 
	        | $this->style_css = ".style{....}";
	        |
	        */
	        $this->style_css = NULL;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include css File 
	        | ---------------------------------------------------------------------- 
	        | URL of your css each array 
	        | $this->load_css[] = asset("myfile.css");
	        |
	        */
	        $this->load_css[] = asset("css/backoffice.css");
	        
	        
	    }


	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for button selected
	    | ---------------------------------------------------------------------- 
	    | @id_selected = the id selected
	    | @button_name = the name of button
	    |
	    */
	    public function actionButtonSelected($id_selected,$button_name) {
	        //Your code here
	            
	    }


	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate query of index result 
	    | ---------------------------------------------------------------------- 
	    | @query = current sql query 
	    |
	    */
	    public function hook_query_index(&$query) {
	        //Your code here
	            
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate row of index table html 
	    | ---------------------------------------------------------------------- 
	    |
	    */    
	    public function hook_row_index($column_index,&$column_value) {	        
	    	//Your code here
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before add data is execute
	    | ---------------------------------------------------------------------- 
	    | @arr
	    |
	    */
	    public function hook_before_add(&$postdata) {        
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after add public static function called 
	    | ---------------------------------------------------------------------- 
	    | @id = last insert id
	    | 
	    */
	    public function hook_after_add($id) {        
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before update data is execute
	    | ---------------------------------------------------------------------- 
	    | @postdata = input post data 
	    | @id       = current id 
	    | 
	    */
	    public function hook_before_edit(&$postdata,$id) {        
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after edit public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_edit($id) {
	        //Your code here 

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command before delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_before_delete($id) {
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_delete($id) {
	        //Your code here

	    }
		public function getIndex(){
			$data['page_title']= 'Oficina';
			$data['dolares_x_pagar']=$dolares_x_ganar;
			$data['capacidad_de_retiro']=$capacidad_de_retiro;
			$data['monto_total']=$monto_total;
			$this->cbView('modules.oficina',$data);
		}


	    //By the way, you can still create your own method in here... :) 


	}