<?php
namespace App\Helper;

use Validator;
use Image;

class fileUploadHelper{

    public static function fileUpload(array $files)
    {
        $error_messages['error_code'] = 0;

        //create validation
        $validation['image'] = 'required|image|mimes:jpg,png,jpeg,svg';
        $validation['video'] = 'required|mimes:video/x-flv,video/mp4,application/x-mpegURL,video/3gpp,video/MP2T,video/quicktime,video/x-msvideo,video/x-ms-wmv';


        //checking $files contain multiple array ?
        if(!is_array($files['file_type'])) {
            $data[] = $files;
        }
        else
        {
            $data = $files;
        }
        foreach($data as $file)
        {
//                get file type
            $file_type = $file['file_type'];

            if(is_array($file['file']))
            {
                foreach ($file as $f)
                {
                    $all_inputs[$file['html_input_name']] = $f['file'];

                    //check validations
                    $validator = Validator::make($all_inputs, [
                        $file['html_input_name'] => $validation[$file_type],
                    ]);

//                if validation fails store error in $error_messages
                    if($validator->fails())
                    {
                        foreach($validator->messages()->messages()[$file['html_input_name']] as $message)
                        {
                            $error_messages['error_code'] = 1;
                            $error_messages['errors'][] = $message;
                        }
                    }
                }
            }
            else
            {
                $all_inputs[$file['html_input_name']] = $file['file'];

                //check validations
                $validator = Validator::make($all_inputs, [
                    $file['html_input_name'] => $validation[$file_type],
                ]);

//                if validation fails store error in $error_messages
                if($validator->fails())
                {
                    foreach($validator->messages()->messages()[$file['html_input_name']] as $message)
                    {
                        $error_messages['error_code'] = 1;
                        $error_messages['errors'][] = $message;
                    }
                }
            }

        }
        //check if any error then return error messages
        if($error_messages['error_code'])
        {
            return $error_messages;
        }
        else
        {
            foreach ($data as $file)
            {
                if(is_array($file['file']))
                {
                    foreach($file as $f)
                    {
                        $photo = $f['file'];
                        $ext = $f['file']->getClientOriginalExtension();
                        $new_name = time() . '.' . $ext;

                        if($f['file_type'] == 'image' && isset($f['resize']) && $f['resize']['resize'] && isset($f['resize']['height']) && isset($f['resize']['width']) && $f['resize']['height'] != '' && $f['resize']['width'] != '')
                        {
                            $destinationPath = base_path().'/'.$f['resize']['resize_destination'];
                            $thumb_img = Image::make($photo->getRealPath())->resize($f['resize']['height'], $f['resize']['width']);
                            $thumb_img->save($destinationPath . '/' . $new_name);
                        }

                        $destinationPath = base_path().'/'.$f['destination'];
                        $photo->move($destinationPath, $new_name);
                        $success_arr[] = $new_name;
                    }
                }
                else
                {
                    $photo = $file['file'];
                    $ext = $file['file']->getClientOriginalExtension();
                    $new_name = time() . '.' . $ext;

                    if($file['file_type'] == 'image' && isset($file['resize']) && $file['resize']['resize'] && isset($file['resize']['height']) && isset($file['resize']['width']) && $file['resize']['height'] != '' && $file['resize']['width'] != '')
                    {
                        $destinationPath = base_path().'/'.$file['resize']['resize_destination'];
                        $thumb_img = Image::make($photo->getRealPath())->resize($file['resize']['height'], $file['resize']['width']);
                        $thumb_img->save($destinationPath . '/' . $new_name);
                    }

                    $destinationPath = base_path().'/'.$file['destination'];
                    $photo->move($destinationPath, $new_name);
                    $success_arr[] = $new_name;
                }

                return $success_arr;
            }
        }

    }
}