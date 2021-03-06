<?php namespace App\Http\Controllers;

use App\Services\ProductOPGService;
use crocodicstudio\crudbooster\helpers\CRUDBooster;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Request;
use App\Models\Course;
use App\Models\CmsUserCourse;
use App\Models\FavoriteUserCourse;


use Session;

class AdminCoursesController extends \crocodicstudio\crudbooster\controllers\CBController
{

    public function cbInit()
    {

        # START CONFIGURATION DO NOT REMOVE THIS LINE
        $this->title_field = "title";
        $this->limit = "20";
        $this->orderby = "id,desc";
        $this->global_privilege = true;
        $this->button_table_action = false;
        $this->button_bulk_action = true;
        $this->button_action_style = "button_icon";
        $this->button_add = true;
        $this->button_edit = true;
        $this->button_delete = true;
        $this->button_detail = true;
        $this->button_show = false;
        $this->button_filter = true;
        $this->button_import = false;
        $this->button_export = false;
        $this->table = "courses";
        # END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Titulo","name"=>"title"];
			$this->col[] = ["label"=>"Categoría","name"=>"category_id","join"=>"course_categories,nombre"];
			$this->col[] = ["label"=>"Author","name"=>"author"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
        $this->form = [];
        $this->form[] = [
            'label' => 'Titulo',
            'name' => 'title',
            'type' => 'text',
            'validation' => 'required|string|min:3|max:70',
            'width' => 'col-sm-10',
            'placeholder' => ''
        ];
        $this->form[] = [
            'label' => 'Descripción',
            'name' => 'description',
            'type' => 'textarea',
            'validation' => 'required|string|min:5|max:5000',
            'width' => 'col-sm-10'
        ];

        $this->form[] = [
            'label' => 'Categoría',
            'name' => 'course_category_id',
            'type' => 'select2',
            'validation' => 'required|integer|min:0',
            'width' => 'col-sm-10',
            'datatable' => 'course_categories,nombre'
        ];

        $this->form[] = [
            'label' => 'Autor',
            'name' => 'author',
            'type' => 'text',
            'validation' => 'required|string|min:3|max:70',
            'width' => 'col-sm-10',
            'placeholder' => ''
        ];

        $this->form[] = [
            'label' => 'Precio',
            'name' => 'price',
            'type' => 'number',
            'decimal'=>2,
            'validation' => '',
            'width' => 'col-sm-10',
            'placeholder' => ''
        ];

        $this->form[] = [
            'label' => 'Duración',
            'name' => 'duration',
            'type' => 'number',
            'validation' => 'integer|max:70',
            'width' => 'col-sm-10',
            'placeholder' => 'Número de horas que durará el curso'
        ];

        $this->form[] = [
            'label' => 'Imagen del card',
            'name' => 'featured_image',
            'type' => 'upload',
            'validation' => 'required',
            'width' => 'col-sm-10',
            'placeholder' => 'Seleccionar imagen'
        ];
        
        $columns[] = ['label'=>'Url','name'=>'url','type'=>'upload','required'=>true];
        $this->form[] = [
            'label'=>'Galería de imágenes',
            'name'=>'course_galleries',
            'type'=>'child',
            'columns'=>$columns,
            'table'=>'course_galleries',
            'foreign_key'=>'course_id'
        ];

        $columns2[] = ['label'=>'Título','name'=>'title','type'=>'text','required'=>true];
        //$columns2[] = ['label'=>'Descripción','name'=>'description','type'=>'textarea','required'=>true];
        $this->form[] = [
            'label'=>'Módulos',
            'name'=>'modules',
            'type'=>'child',
            'columns'=>$columns2,
            'table'=>'modules',
            'foreign_key'=>'course_id'
        ];
        # END FORM DO NOT REMOVE THIS LINE

        # OLD START FORM
        //$this->form = [];
        //$this->form[] = ["label"=>"Title","name"=>"title","type"=>"text","required"=>TRUE,"validation"=>"required|string|min:3|max:70","placeholder"=>"Puedes introducir solo una letra"];
        //$this->form[] = ["label"=>"Value","name"=>"value","type"=>"textarea","required"=>TRUE,"validation"=>"required|string|min:5|max:5000"];
        //$this->form[] = ["label"=>"Product Type Id","name"=>"product_type_id","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"product_type,id"];
        //$this->form[] = ["label"=>"Enterprise Id","name"=>"enterprise_id","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"enterprise,id"];
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
        $this->alert = array();


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
        $this->index_statistic = array();


        /*
        | ----------------------------------------------------------------------
        | Add javascript at body
        | ----------------------------------------------------------------------
        | javascript code in the variable
        | $this->script_js = "function() { ... }";
        |
        */
        $this->script_js = "
                window.myId = '" . CRUDBooster::myId() . "'
                ";


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
        $this->post_index_html = view('modules.cursos.action_buttons')->render(); 

        /*
        | ----------------------------------------------------------------------
        | Include Javascript File
        | ----------------------------------------------------------------------
        | URL of your javascript each array
        | $this->load_js[] = asset("myfile.js");
        |
        */
        $this->load_js = 
        [
            asset("js/slick.min.js"),
            asset("js/backoffice.js"),
            asset("js/checkout.js"),
            asset("js/content-courses.js"),
        ];
   

        /*
        | ----------------------------------------------------------------------
        | Add css style at body
        | ----------------------------------------------------------------------
        | css code in the variable
        | $this->style_css = ".style{....}";
        |
        */
        $this->style_css = null;


        /*
        | ----------------------------------------------------------------------
        | Include css File
        | ----------------------------------------------------------------------
        | URL of your css each array
        | $this->load_css[] = asset("myfile.css");
        |
        */
        $this->load_css[] = asset("css/backoffice.css");
        $this->load_css[] = asset("css/slick.css");
        $this->load_css[] = asset("css/slick-theme.css");

    }


    /*
    | ----------------------------------------------------------------------
    | Hook for button selected
    | ----------------------------------------------------------------------
    | @id_selected = the id selected
    | @button_name = the name of button
    |
    */
    public function actionButtonSelected($id_selected, $button_name)
    {
        //Your code here

    }


    /*
    | ----------------------------------------------------------------------
    | Hook for manipulate query of index result
    | ----------------------------------------------------------------------
    | @query = current sql query
    |
    */
    public function hook_query_index(&$query)
    {
        //Your code here

    }

    /*
    | ----------------------------------------------------------------------
    | Hook for manipulate row of index table html
    | ----------------------------------------------------------------------
    |
    */
    public function hook_row_index($column_index, &$column_value)
    {
        //Your code here
    }

    /*
    | ----------------------------------------------------------------------
    | Hook for manipulate data input before add data is execute
    | ----------------------------------------------------------------------
    | @arr
    |
    */
    public function hook_before_add(&$postdata)
    {
        //Your code here

    }

    /*
    | ----------------------------------------------------------------------
    | Hook for execute command after add public static function called
    | ----------------------------------------------------------------------
    | @id = last insert id
    |
    */
    public function hook_after_add($id)
    {
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
    public function hook_before_edit(&$postdata, $id)
    {
        //Your code here

    }

    /*
    | ----------------------------------------------------------------------
    | Hook for execute command after edit public static function called
    | ----------------------------------------------------------------------
    | @id       = current id
    |
    */
    public function hook_after_edit($id)
    {
        //Your code here

    }

    /*
    | ----------------------------------------------------------------------
    | Hook for execute command before delete public static function called
    | ----------------------------------------------------------------------
    | @id       = current id
    |
    */
    public function hook_before_delete($id)
    {
        //Your code here

    }

    /*
    | ----------------------------------------------------------------------
    | Hook for execute command after delete public static function called
    | ----------------------------------------------------------------------
    | @id       = current id
    |
    */
    public function hook_after_delete($id)
    {
        //Your code here

    }

    public function getMyIndex()
    {

        $category_id = Request::get('category_id', 0);
        //Create your own query
        $data = [];
        $data['tipo'] = Request::get('tipo');
        if ($data['tipo'] == 'video') {
            $data['page_title'] = 'Tutoriales';
        } else {
            $data['page_title'] = 'Cursos';
        }
        $query = CmsUserCourse::with('course')->where('cms_user_id',CRUDBooster :: myid ());

                $courses = $query->Paginate(100);
        $data['products'] = $courses;
        $data['categories'] = DB::table('course_categories')->orderBy('nombre')->get();
        $data['current_empresa'] = DB::table('course_categories')->where('id', $category_id)->first();

        $this->cbView('modules.myproducts', $data);

    }
    public function ajaxMyCouseAdded(Request $req)
    {
        $course_id = Request::get('course_id', 0);
        $course = FavoriteUserCourse::where([['cms_user_id',CRUDBooster :: myid ()],['course_id',$course_id]]);
        if($course->get()->count())
            $course->delete();
        else
            $query = FavoriteUserCourse::create(['cms_user_id'=>CRUDBooster :: myid (),'course_id'=>$course_id]);
        
    }
    
    public function getIndex()
    {

        $category_id = Request::get('category_id', 0);
        $favourite = Request::get('my_favourite');
        if(isset($favourite))
        {
    
            //Create your own query
            $data = [];
            $data['tipo'] = Request::get('tipo');
            if ($data['tipo'] == 'video') {
                $data['page_title'] = 'Tutoriales';
            } else {
                $data['page_title'] = 'Cursos';
            }
            $query = FavoriteUserCourse::with('course')->where('cms_user_id',CRUDBooster :: myid ());
    
                    $courses = $query->Paginate(100);
            $data['products'] = $courses;
            $data['categories'] = DB::table('course_categories')->orderBy('nombre')->get();
            // $data['current_empresa'] = DB::table('course_categories')->where('id', $category_id)->first();
    
            $this->cbView('modules.myproducts', $data);
        }
        else
        {
            //Create your own query
            $data = [];
            $data['tipo'] = Request::get('tipo');
            if ($data['tipo'] == 'video') {
                $data['page_title'] = 'Tutoriales';
            } else {
                $data['page_title'] = 'Cursos';
            }
            $query = DB::table('courses');

            if ($category_id > 0) {
                $query->where('course_category_id', $category_id);
            }
            $courses = $query->orderby('id', 'desc')->Paginate(100);

            $data['products'] = $courses;
            $data['categories'] = DB::table('course_categories')->orderBy('nombre')->get();
            $data['current_empresa'] = DB::table('course_categories')->where('id', $category_id)->first();

            $this->cbView('modules.products', $data);
        }

    }

    //By the way, you can still create your own method in here... :)

    public function getDetail ($id){
        $data=
        [
            'annual_membership_amount'=>CRUDBooster::getSetting('annual_membership_amount'),
            'annual_membership_amount_format'=>number_format(CRUDBooster::getSetting('annual_membership_amount'), 2),
            'monthly_membership_amount_format'=>number_format(CRUDBooster::getSetting('monthly_membership_amount', 2)),
            'categories'=> DB::table('course_categories')->orderBy('nombre')->get(),
            'course'=>Course::find($id), 
            'galleryimages'=>DB::table('course_galleries')->where('course_id',$id)->get(),
        ];        
        $this->cbView('modules.cursos.detail', $data);
    }

    public function getContent ($id){
        $data=
        [
            'open_module'=>Request::input('module_id'),
            'course'=>Course::find($id), 
        ];
        $this->cbView('modules.cursos.content',$data);
    }
}