<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Slider;
use App\Http\Requests\SliderRequest;
use DB;
use Image;
use File;

class SliderController extends Controller
{
    

    public function index()
    {

        return view('admin.slider.index');
    }

    public function getData(){
    	  $slider = Slider::all();

        return DataTables::of($slider)
            ->addIndexColumn()
            ->addColumn('image',function ($slider){
                
                  $url=asset("assets/slider/$slider->image");
                    return '<img src='.$url.' border="0" width="400"  height="100" class="img-rounded" align="center" />';
            })
             ->addColumn('status',function ($slider){

               if($slider->status == 1)
                {

                    return '<div>
                            <label class="switch patch">
                                <input type="checkbox" class="status_toggle slider_stataus_change" data-value="'.$slider->id.'" value="'.$slider->id.'" checked>
                                <span class="slider"></span>
                            </label>
                          </div>';
                }else{
                    return '<div>
                        <label class="switch patch">
                            <input type="checkbox"  class="status_toggle slider_stataus_change" data-value="'.$slider->id.'"  value="'.$slider->id.'" >
                            <span class="slider"></span>
                        </label>
                      </div>';
                }
            })
             ->editColumn('action', function ($slider) {
                $return = "<div class=\"btn-group\">";
                if (!empty($slider->id))
                {
                    $return .= "
                                  <a href=\"/slider/edit/$slider->id\" class=\"btn btn-sm btn-clean btn-icon btn-icon-md\" title=\"View\">
                                      <i class=\"fa fa-edit\"></i>
                                    </a>
                                    
                                    <a rel=\"$slider->id\" rel1=\"slider/destroy\" href=\"javascript:\" style='margin-right: 5px' class=\"btn btn-sm btn-clean btn-icon btn-icon-md deleteRecord \"><i class='fa fa-trash'></i></a>
                                  ";
                }
                $return .= "</div>";
                return $return;
            })
            ->rawColumns([
                'action','image','status'
            ])
            ->make(true);
    }

    public function edit($id){
    	$slider = Slider::findOrFail($id);

        return view('admin.slider.edit', compact('slider'));

    }


      public function update(SliderRequest $request, $id)
    {
        if ($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{
                if($request->hasFile('image')){

                    $image_tmp = $request->file('image');
                    if($image_tmp->isValid()){
                        $extension = $image_tmp->getClientOriginalExtension();
                        $filename = rand(111,99999).'.'.$extension;

                        $original_image_path = public_path().'/assets/slider/'.$filename;
                       
                        //Resize Image
                        Image::make($image_tmp)->save($original_image_path);
                       
                    }
                }else{
                    $filename = $request->current_image;
                }

                $slider = Slider::findOrFail($id);
                $slider->image = $filename;
                $slider->status = 1;
                $slider->save();

                DB::commit();

                return response()->json([
                    'message' => 'Slider Updated Successful',
                    'status_code' => 200
                ], 200);


            }catch(QueryException $e){
                DB::rollBack();

                $error = $e->getMessage();

                return response()->json([
                    'error' => $error,
                    'status_code' => 500
                ], 500);
            }
        }
    }


    public function delete_image($id)
    {
        $slider = Slider::findOrFail($id);

        if ($slider->image != null)
        {
            $original_path = public_path().'/assets/slider/'.$slider->image;
   			if (File::exists($original_path)) {
   				 unlink($original_path);
   			}
        }

        $slider->update(['image' => null]);

        return response()->json([
            'message' => 'Slider Image Deleted Successful',
            'status_code' => 200
        ], 200);
    }

   public function destroy($id)
    {
        $slider_images = Slider::findOrFail($id);
        if ($slider_images->image != null)
        {

            $original = public_path().'/assets/slider/'.$slider_images->image;
            if (File::exists($original)) {
            	  unlink($original);
            }
          
        }

        $slider = Slider::findOrFail($id);
        $slider->delete();

        return response()->json([
            'message' => 'Slider Image Destroy Successful',
            'status_code' => 200
        ], 200);
    }

    public function change(Request $request){
          $slider = Slider::findOrFail($request->id);

          if ($slider->status == 1)
          {
              $slider->update(['status' => 2]);

              return response()->json([
                  'message' => 'Status Changed',
                  'status_code' => 200
              ], 200);
          }else{
              $slider->update(['status' => 1]);

              return response()->json([
                  'message' => 'Status Change',
                  'status_code' => 200
              ], 200);
          }
    }
}
