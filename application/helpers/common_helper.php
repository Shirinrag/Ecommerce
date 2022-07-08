<?php
	function token_get(){
        $tokenData = array();
        $tokenData['id'] = mt_rand(10000,99999); //TODO: Replace with data for token
        $output['token'] = AUTHORIZATION::generateToken($tokenData);
        return $output['token'];
    }

    function redirect_controller($user_type='')
    {
		switch ($user_type) {
		    case "1":
		       	return "admin";
		        break;
		    case "2":
		        return "user";
		        break;
		    case "3":
		        return "business";
		        break;
		    case "4":
		        return "partner";
				break;			
		    default:
		        return "superadmin";
		}
    }

    function get_session_name($user_type='')
    {
		switch ($user_type) {
		    case "admin":
		       	return "blockchain_logged_in";
		        break;
            case "user":
                return "user_logged_in";
                break;
		    case "business":
		        return "business_logged_in";
		        break;
		    case "partner":
		        return "partner_logged_in";
		        break;		    
		    default:
		        return "blockchain_logged_in";
		}
    }

    function get_chat_date_time($datetime='')
    {
		$datetime = date_create($datetime);
		$date = date_format($datetime,"Y-m-d");
		$time = date_format($datetime,"H:i");
		$now = new DateTime;
		$otherDate = new DateTime($date);
		$now->setTime( 0, 0, 0 );
		$otherDate->setTime( 0, 0, 0 );
		if ($now->diff($otherDate)->days === 0) {
			$time = new DateTime($time);
			$msg_date = 'Today '.$time->format('h:ia') ;
		} else {
			$time = new DateTime($time);
			$msg_date = $date.' '.$time->format('h:ia') ;
		}
		return $msg_date;
    }

    function chat_container_html($chat_message='',$receiver_id='',$receiver_profile='',$user_id='',$sender_info='')
    {
    	$html = '';
    	$html .= '<ul class="message_container_'.$receiver_id.'">';
    	if (!empty($chat_message)) {
			foreach ($chat_message as $chat_message_key => $chat_message_row) { 
				if ($chat_message_row['receiver_id']==$user_id) {
					$html .='<li class="sent">';
					$html .='<div class="msgs">';
	                $html .= '<img src="'.$receiver_profile.'" alt="" />';
	                $html .= '<p>'.$chat_message_row['message'].'</p>';
					$html .= '<div class="times"><span><small>'.get_chat_date_time($chat_message_row['date']).'</small></span></div>';
					$html .= '</div>';
					$html .= '</li>';
				} else {
					$html .= '<li class="replies">';
					$html .= '<div class="msgr">';
					$html .= '<img src="'.$sender_info['profile_img'].'" alt="" />';
					$html .= '<p>'.$chat_message_row['message'].'</p>';
					$html .= '<div class="timer"><span><small>'.get_chat_date_time($chat_message_row['date']).'</small></span></div>';
					$html .= '</div>';
                    $html .= '</li>';
				}
			}
		}
    	$html .= '</ul>';
    	return $html;
    }

    function chat_user_info_html($receiver_name='',$receiver_profile='')
    {
    	$html = '';
    	$html .='<img src="'.$receiver_profile.'" alt="" />';
		$html .='<p>'.$receiver_name.'</p>';
    	return $html;
    }

    function check_validation($service_id_name='',$price_name='',$service_id='',$price='')
    {
    	$result = array();
    	if (!empty($service_id[0]) && !empty($price[0])) {
    		foreach ($service_id as $service_id_key => $service_id_row) {
    			if (empty($service_id_row)) {
    				$result[$service_id_name.'_'.$service_id_key]='Required';
    			}
    			if (empty($price[$service_id_key])) {
    				$result[$price_name.'_'.$service_id_key]='Required';
    			} else if (!is_numeric($price[$service_id_key])) {
    				$result[$price_name.'_'.$service_id_key]='Use Numeric';
    			}
    		}
    	} else {
    		if (empty($service_id[0])) {
    			$result[$service_id_name.'_0']='Required';
    		}
    		if (empty($price[0])) {
    			$result[$price_name.'_0']='Required';
    		}
    		
    	} 
    	return $result;
    }

    function check_org_validation($range_to_name='',$price_name='',$rangefrom='',$price='')
    {
    	$result = array();
    	if (!empty($rangefrom[0]) && !empty($price[0])) {
    		foreach ($rangefrom as $rangefrom_key => $rangefrom_row) {
    			if (empty($rangefrom_row)) {
    				$result[$range_to_name.'_'.$rangefrom_key]='Required';
    			} else if (!is_numeric($rangefrom_row)) {
    				$result[$range_to_name.'_'.$rangefrom_key]='Use Numeric';
    			} 

    			if (empty($price[$rangefrom_key])) {
    				$result[$price_name.'_'.$rangefrom_key]='Required';
    			} else if (!is_numeric($price[$rangefrom_key])) {
    				$result[$price_name.'_'.$rangefrom_key]='Use Numeric';
    			}
    		}
    	} else {
    		if (empty($rangefrom[0])) {
    			$result[$range_to_name.'_0']='Required';
    		}
    		if (empty($price[0])) {
    			$result[$price_name.'_0']='Required';
    		}
    	} 
    	return $result;
    }

    function make_directory_file($folder_name='')
    {
    	$folder_name = trim($folder_name);
		if (!is_dir(APPPATH.'language/'.$folder_name.'/')) {
		    mkdir(APPPATH.'language/'.$folder_name.'/', 0777, TRUE);
		}
		$file = fopen(APPPATH."language/".$folder_name."/locale_lang.php","w");
		fwrite($file,"<?php");
		fclose($file);
		// chmod($file, 0777);
    }

    function test_report_class($report='')
    {
        // $text = $report;
        // preg_match('#\((.*?)\)#', $text, $match);
        // switch(@$match[1]){
        switch($report){
        case "Positive":
            return "red";
            break;
        case "Negative":
            return "green";
            break;
        case "Invalid":
            return "yellow";
            break;
        default:
            return "gray";
            break;
        }
    }


    function test_report_class_color($report='')
    {
        switch($report){
            case "Pending":
                return "(253, 255, 0)";
                break;
            case "Positive":
                return "(255, 0, 0)";
                break;
            case "NotDetected":
                return "(14, 193, 62)";
                break;
            case "Inconclusive":
                return "(23, 66, 219)";
                break;
            case "Negative":
                return "(14, 193, 62)";
                break;
            case "Invalid":
                return "(8, 8, 9)";
                break;
            default:
                return "gray";
                break;
        }
    }

    function kit_order_class($status='')
    {
        $text = $status;
        switch($text){
        case "Pending":
            return "warning";
            break;
        case "Completed":
            return "success";
            break;
        case "Accepted":
            return "success";
            break;
        case "Reschedule":
            return "info";
            break;
        case "Rejected":
            return "danger";
            break;
        case "Submitted":
            return "success";
            break;
        case "Not Submitted":
            return "warning";
            break;
        default:
            return "warning";
            break;
        }
    }

    function get_date($format='')
    {
        $CI = get_instance();
        $controller = $CI->uri->segment(1);
        $controller = lcfirst($controller);
        $session_name = get_session_name($controller);
        $session_data = $CI->session->userdata($session_name);
        if (!empty($session_data['timezone'])) {
            $timezone_identifier = $session_data['timezone'];
        } else {
            $timezone_identifier = 'America/new_york';
        }
        
        
        date_default_timezone_set($timezone_identifier);
        if (empty($format)) {
            $format = 'm/d/Y H:i:s';
        }
        $date = date($format);
        return $date;
    }

    function sftp_upload($filename='',$folder_name='',$sftp_folder_name='',$sample_type='',$update='')
    {
        $CI = get_instance();
        $CI->load->library('ftp');
        if ($update) {
            $CI->load->library('phpseclib');
            $CI->phpseclib->delete_file($filename,$credentials);
        }
        $credentials = get_sftp_credentials($sample_type);
        $config['hostname'] = 'helixds.exavault.com'; 
        $config['username'] = $credentials['username'];
        $config['password'] = $credentials['password'];
        $config['debug']    = TRUE;

        $CI->ftp->connect($config);
        $CI->ftp->upload(FCPATH.'/'.$folder_name.'/'.$filename, $sftp_folder_name.'/'.$filename);
        $CI->ftp->close();
    }

    function get_sftp_credentials($sample_type='')
    {
        if ($sample_type==1) {
            $credentials['username']='SCITECK';
            $credentials['password']='SCITECK';
        } else {
            $credentials['username']='MAKO';
            $credentials['password']='MAKO';
        }
        return $credentials;
    } 

function generate_sample_id($value='')
{
    $CI = get_instance();
    $varchar = generate_varchar_string(3);
    $rand = mt_rand(1000000, 9999999);
    $randTemp = $varchar.$rand;
    $isUnique = true;
    return $randTemp;
}

function generate_varchar_string($strength = '') {
    $input = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
    $random_character = $input[mt_rand(0, $input_length - 1)];
    $random_string .= $random_character;
    }
    return $random_string;
}

function encrypt($string) {
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'block key';
    $secret_iv = 'block iv';
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
    $output = base64_encode($output);
    return $output;
}

function decrypt($string) {
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'block key';
    $secret_iv = 'block iv';
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    return $output;
}

function readMoreFunction($story_desc,$char='') {  
//Number of characters to show  
    if (empty($char)) {
        $chars = 25;
    }
    $story_desc_1 = substr($story_desc,0,$chars);  
    $story_desc_2 = substr($story_desc_1,0,strrpos($story_desc_1,' ')); 
    $story_desc_3 = "<span class='teaser'>".$story_desc_2."</span><span class='complete'>";
    $story_desc=str_replace($story_desc_2,$story_desc_3,$story_desc); 
    $story_desc_1= $story_desc."</span><span class='more'>more...</span>";
    return htmlspecialchars($story_desc_1);  
}



function get_file_type($file_extension=''){
    if(!empty($file_extension)){
        $file_extension = strtolower($file_extension);
        $image_extension = ['jpg','jpeg','jpe','jif','jfif','jfi','gif','webp','tiff','tif','psd','raw','arw','cr2','nrw','k25','bmp','dib','heif','heic','ind','indd','indt','jp2','j2k','jpf','jpx','jpm','mj2','svg','svgz','ai','eps','png'];
        $doc_extension = ['doc','docx','html','htm','odt','pdf','xls','xlsx','ods','ppt','pptx','txt'];
        $audio_extensions = ['aa','aac','aax','act','aiff','alac','amr','ape','au','awb','dss','dvf','flac','gsm','iklax','ivs','m4a','m4b','m4p','mmf','mp3','mpc','msv','nmf','ogg','oga','mogg','opus','org','ra','rm','raw','rf64','sln','tta','voc','vox','wav','wma','wv','webm','8svx','cda'];
        $video_extension = ['mkv','flv','vob','ogv','ogg','drc','gifv','mng','avi','mts','m2ts','ts','mov','qt','wmv','yuv','rm','rmvb','viv','asf','amv','mp4','m4p','m4v','mpg','mp2','mpeg','mpe','mpv','mpg','mpeg','m2v','m4v','svi','3gp','3g2','mxf','roq','nsv','f4v','f4p','f4a','f4b','webm'];
        if(in_array($file_extension, $image_extension)){
            return 'image';
        }  else if(in_array($file_extension, $doc_extension)) {
            return 'doc';
        } else if(in_array($file_extension, $audio_extensions)) {
            return 'audio';
        } else if(in_array($file_extension, $video_extension)){
            return 'video';
        } else {
            return false;
        } 
    } else {
        return false;
    }
}

function get_file_type_watermark($file_extension=''){
    if(!empty($file_extension)){
        $file_extension = strtolower($file_extension);
        $image_extension = ['jpg','jpeg','jpe','jif','jfif','jfi','webp','tiff','tif','psd','raw','arw','cr2','nrw','k25','bmp','dib','heif','heic','ind','indd','indt','jp2','j2k','jpf','jpx','jpm','mj2','svg','svgz','ai','eps','png'];
        $doc_extension = ['doc','docx','html','htm','odt','pdf','xls','xlsx','ods','ppt','pptx','txt'];
        $audio_extensions = ['aa','aac','aax','act','aiff','alac','amr','ape','au','awb','dss','dvf','flac','gsm','iklax','ivs','m4a','m4b','m4p','mmf','mp3','mpc','msv','nmf','ogg','oga','mogg','opus','org','ra','rm','raw','rf64','sln','tta','voc','vox','wav','wma','wv','webm','8svx','cda'];
        $video_extension = ['mkv','flv','vob','gif','ogv','ogg','drc','gifv','mng','avi','mts','m2ts','ts','mov','qt','wmv','yuv','rm','rmvb','viv','asf','amv','mp4','m4p','m4v','mpg','mp2','mpeg','mpe','mpv','mpg','mpeg','m2v','m4v','svi','3gp','3g2','mxf','roq','nsv','f4v','f4p','f4a','f4b','webm'];
        if(in_array($file_extension, $image_extension)){
            return 'image';
        }  else if(in_array($file_extension, $doc_extension)) {
            return 'doc';
        } else if(in_array($file_extension, $audio_extensions)) {
            return 'audio';
        } else if(in_array($file_extension, $video_extension)){
            return 'video';
        } else {
            return false;
        } 
    } else {
        return false;
    }
}


    // function resizeImage($filename,$watermark=''){
    //     $CI = get_instance();
    //     $return= array();
    //     $ext = pathinfo($filename, PATHINFO_EXTENSION);
    //     $file_type = get_file_type($ext);
    //     $require_thumbnail = true;
    //     if (strpos(@$filename,'noproductimg') !== false) {
    //         $require_thumbnail = false;
    //     } else {
    //         $require_thumbnail = true;
    //     }

    //     if($file_type=='image' && $require_thumbnail){
    //         $source_path = FCPATH.'uploads/items/'.$filename;
    //         $target_path = FCPATH.'uploads/items/items_thumbnail/';
    //         $config_manip = array(
    //             'image_library' => 'gd2',
    //             'source_image' => $source_path,
    //             'new_image' => $target_path,
    //             'maintain_ratio' => TRUE,
    //             'create_thumb' => TRUE,
    //             'width' => 'auto',
    //             'height' => 300
    //         );
    //         $CI->image_lib->initialize($config_manip);
    //         if (!$CI->image_lib->resize()) {
    //             $return['status'] = false;
    //             $return['error'] = $CI->image_lib->display_errors();
    //         } else {
    //             if($watermark){
    //                 $image_info_explode = explode(".",$filename);
    //                 $image_name = $image_info_explode[0];
    //                 $thumb_image_name = $image_name."_thumb";
    //                 $thumb_image_name_1 = $image_name."_thumb_thumb";
    //                 $thumb_filename = $thumb_image_name.".".$image_info_explode[1];
    //                 $thumb_filename_1 = $thumb_image_name_1.".".$image_info_explode[1];
    //                 $source_image = FCPATH. 'uploads/items/items_thumbnail/'.$thumb_filename;
    //                 $source_image_1 = FCPATH. 'uploads/items/items_thumbnail/'.$thumb_filename_1;
    //                 $config['image_library'] = 'gd2';
    //                 $config['source_image'] = $source_image;
    //                 $config['wm_type'] = 'overlay';
    //                 $config['wm_overlay_path'] = FCPATH.'assets/img/Watermark.png'; //the overlay image
    //                 $config['wm_opacity'] = 50;
    //                 $config['wm_vrt_alignment'] = 'middle';
    //                 $config['wm_hor_alignment'] = 'center';
    //                 $CI->image_lib->initialize($config);
    //                 if (!$CI->image_lib->watermark()) {
    //                     $return['status'] = false;
    //                     $return['error'] = $CI->image_lib->display_errors();
    //                 } else{
    //                     unlink($source_image);
    //                     rename($source_image_1,$source_image);
    //                     $return['status'] = true; 
    //                 } 
    //             } else {
    //                 $return['status'] = true;
    //             }
    //         }
    //         $CI->image_lib->clear();
    //     } else if($file_type=='video' && $require_thumbnail){
    //         $file_info = $CI->video_formatter->video_format_one($filename);
    //         if($file_info){
    //             unlink($file_info);
    //             $return['status'] = true; 
    //         } else {
    //             $return['status'] = false; 
    //         }
    //     } else {
    //         $return['status'] = true;
    //     }
    //     return $return;
    // }

    function resizeImage($filename,$watermark_type='',$watermark=''){
        $CI = get_instance();
        $return= array();
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $file_type = get_file_type_watermark($ext);
        $require_thumbnail = true;
        if (strpos(@$filename,'noproductimg') !== false) {
            $require_thumbnail = false;
        } else {
            $require_thumbnail = true;
        }

        if($file_type=='image' && $require_thumbnail){
            $file_info = convert_to_png($filename);
            $image_info_explode_1 = explode(".",$filename);
            $thumb_image_name = $image_info_explode_1[0].".png";
            $temp_filename = $file_info['filename'];
            $temp_target_path = $file_info['temp_target_path'];
            $source_path = FCPATH.'uploads/items/'.$temp_filename;
            $target_path = FCPATH.'uploads/items/items_thumbnail/'.$thumb_image_name;
            $config_manip = array(
                'image_library' => 'gd2',
                'source_image' => $source_path,
                'new_image' => $target_path,
                'maintain_ratio' => TRUE,
                'create_thumb' => TRUE,
                'width' => 'auto',
                'height' => 300
            );
            $CI->image_lib->initialize($config_manip);
            if (!$CI->image_lib->resize()) {
                $return['status'] = false;
                $return['error'] = $CI->image_lib->display_errors();
            } else {
                $image_info_explode = explode(".",$filename);
                $image_name = $image_info_explode[0];
                $image_info_explode[1] = 'png';
                $thumb_image_name = $image_name."_thumb";
                $destination_copy_path = FCPATH.'uploads/items/items_thumbnail_wowt/'.$thumb_image_name.'.'.$image_info_explode[1];
                $source_copy_path = FCPATH.'uploads/items/items_thumbnail/'.$thumb_image_name.'.'.$image_info_explode[1];
                copy($source_copy_path, $destination_copy_path);
                if($watermark){
                    
                    $wm_overlay_path = FCPATH.'assets/img/Watermark.png';
                    if($watermark_type==2){
                        $wm_overlay_path = FCPATH.'assets/img/WaterMark_Dark.png';
                    }
                    
                    $thumb_image_name_1 = $image_name."_thumb_thumb";
                    $thumb_filename = $thumb_image_name.".".$image_info_explode[1];
                    $thumb_filename_1 = $thumb_image_name_1.".".$image_info_explode[1];
                    $source_image = FCPATH. 'uploads/items/items_thumbnail/'.$thumb_filename;
                    $source_image_1 = FCPATH. 'uploads/items/items_thumbnail/'.$thumb_filename_1;
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $source_image;
                    $config['wm_type'] = 'overlay';
                    $config['wm_overlay_path'] = $wm_overlay_path; //the overlay image
                    $config['wm_opacity'] = 50;
                    $config['wm_vrt_alignment'] = 'middle';
                    $config['wm_hor_alignment'] = 'center';
                    $CI->image_lib->initialize($config);
                    if (!$CI->image_lib->watermark()) {
                        $return['status'] = false;
                        $return['error'] = $CI->image_lib->display_errors();
                    } else{
                        // unlink($source_image);
                        unlink($temp_target_path);
                        // rename($source_image_1,$source_image);
                        $return['status'] = true; 
                    } 
                } else {
                    $return['status'] = true;
                }
            }
            $CI->image_lib->clear();
        } else if($file_type=='video' && $require_thumbnail){
            $file_info = $CI->video_formatter->video_format_one($filename,$watermark_type);
            if($file_info){
                unlink($file_info);
                $return['status'] = true; 
            } else {
                $return['status'] = false; 
            }
        } else {
            $return['status'] = true;
        }
        return $return;
    }

    function temp_resizeImage($filename=''){
        $CI = get_instance();
        $return= array();
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $file_type = get_file_type_watermark($ext);
        $require_thumbnail = true;
        if (strpos(@$filename,'noproductimg') !== false) {
            $require_thumbnail = false;
        } else {
            $require_thumbnail = true;
        }

        if($file_type=='image'){
            $file_info = convert_to_png($filename);
            $image_info_explode_1 = explode(".",$filename);
            $thumb_image_name = $image_info_explode_1[0].".png";
            $temp_filename = $file_info['filename'];
            $temp_target_path = $file_info['temp_target_path'];
            $source_path = FCPATH.'uploads/items/'.$temp_filename;
            $target_path = FCPATH.'uploads/items/items_thumbnail_wowt/'.$thumb_image_name;
            $config_manip = array(
                'image_library' => 'gd2',
                'source_image' => $source_path,
                'new_image' => $target_path,
                'maintain_ratio' => TRUE,
                'create_thumb' => TRUE,
                'width' => 'auto',
                'height' => 300
            );
            $CI->image_lib->initialize($config_manip);
            if (!$CI->image_lib->resize()) {
                $return['status'] = false;
                $return['error'] = $CI->image_lib->display_errors();
            } else {
                $return['status'] = true; 
            }
        } else if($file_type=='video' && $require_thumbnail){
            $file_info = $CI->video_formatter->video_format_two($filename);
            if($file_info){
                unlink($file_info);
                $return['status'] = true; 
            } else {
                $return['status'] = false; 
            }
        } else {
            $return['status'] = true;
        }
        return $return;
    }

    function convert_to_png($filename=''){
        $target_path = FCPATH.'uploads/items/output.png';
        // $target_path_1 = FCPATH.'uploads/items/myUpdateImage.png';
        $temp_filename = 'output.png';
        $path = FCPATH.'uploads/items/'.$filename;
        $img = imagepng(imagecreatefromstring(file_get_contents($path)), $target_path);
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        $extension_1 = strtolower($extension);
        if($extension_1 != 'png'){
            $exif = exif_read_data(FCPATH.'uploads/items/'.$filename);
            if ($img && $exif && isset($exif['Orientation']))
            {
                $ort = $exif['Orientation'];
                $source = imagecreatefrompng($target_path);
                if ($ort == 6 || $ort == 5){
                    $rotate = imagerotate($source, 270, null);
                    imagepng($rotate, $target_path);
                }
                if ($ort == 3 || $ort == 4){
                    $rotate = imagerotate($source, 180, null);
                    imagepng($rotate, $target_path);
                }
                if ($ort == 8 || $ort == 7){
                    $rotate = imagerotate($source, 90, null);
                    imagepng($rotate, $target_path);
                }
                if ($ort == 5 || $ort == 4 || $ort == 7){
                    imageflip($source, IMG_FLIP_HORIZONTAL);
                }
            }
        }
        $file_info['filename'] = $temp_filename;
        $file_info['temp_target_path'] = $target_path;
        return $file_info;
    }

    function rotate_image($filename=''){
        $target_path = FCPATH.'uploads/items/output.png';
        $temp_filename = 'output.png';
        imagepng(imagecreatefromstring(file_get_contents(FCPATH.'uploads/items/'.$filename)), $target_path);
        
        // $fileName = "Df7731542705507.png";
        $degrees = 90;
        $source = imagecreatefrompng($target_path);
        $rotate = imagerotate($source, $degrees, 0);
        imagepng($rotate, "myUpdateImage.png");
        return true;
    }

    // function convert_to_png($filename){
    //     $img = imagepng(imagecreatefromstring(file_get_contents(FCPATH.'uploads/items/'.$filename)));
    //     $exif = exif_read_data($filename);
    //     if ($img && $exif && isset($exif['Orientation']))
    //     {
    //         $ort = $exif['Orientation'];

    //         if ($ort == 6 || $ort == 5)
    //             $img = imagerotate($img, 270, null);
    //         if ($ort == 3 || $ort == 4)
    //             $img = imagerotate($img, 180, null);
    //         if ($ort == 8 || $ort == 7)
    //             $img = imagerotate($img, 90, null);

    //         if ($ort == 5 || $ort == 4 || $ort == 7)
    //             imageflip($img, IMG_FLIP_HORIZONTAL);
    //     }
    //     return $img;
    // }

    function resizeImage_1($filename,$watermark=''){
        $CI = get_instance();
        $return= array();
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $file_type = get_file_type($ext);
        $require_thumbnail = true;
        $my_url = 'https://bchlx.com';
        $filename_explode = explode($my_url,$filename);
        if(sizeof($filename_explode)==2){
            $filename_1 = $filename_explode[1];
        } else {
            $filename_explode = explode(base_url(),$filename);
        }
        $filename_1 = $filename_explode[1];
        $filename_explode_1 = explode("/",$filename_1);
        $filename_2 = $filename_explode_1[2];
        if (strpos(@$unlink_path_info['1'],'noproductimg') !== false) {
            $require_thumbnail = false;
        } else {
            $require_thumbnail = true;
        }
        if($file_type=='image' && $require_thumbnail){
            $source_path = FCPATH.$filename_1;
            $target_path = FCPATH.'uploads/items/items_thumbnail/';
            $config_manip = array(
                'image_library' => 'gd2',
                'source_image' => $source_path,
                'new_image' => $target_path,
                'maintain_ratio' => TRUE,
                'create_thumb' => TRUE,
                'width' => 300,
                'height' => 300
            );
            $CI->image_lib->initialize($config_manip);
            if (!$CI->image_lib->resize()) {
                $return['status'] = false;
                $return['error'] = $CI->image_lib->display_errors();
            } else {
                if($watermark){
                    $image_info_explode = explode(".",$filename_2);
                    $image_name = $image_info_explode[0];
                    $thumb_image_name = $image_name."_thumb";
                    $thumb_image_name_1 = $image_name."_thumb_thumb";
                    $thumb_filename = $thumb_image_name.".".$image_info_explode[1];
                    $thumb_filename_1 = $thumb_image_name_1.".".$image_info_explode[1];
                    $source_image = FCPATH. 'uploads/items/items_thumbnail/'.$thumb_filename;
                    $source_image_1 = FCPATH. 'uploads/items/items_thumbnail/'.$thumb_filename_1;
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $source_image;
                    $config['wm_type'] = 'overlay';
                    $config['wm_overlay_path'] = FCPATH.'assets/img/Watermark.png'; //the overlay image
                    $config['wm_opacity'] = 50;
                    $config['wm_vrt_alignment'] = 'middle';
                    $config['wm_hor_alignment'] = 'center';
                    $CI->image_lib->initialize($config);
                    if (!$CI->image_lib->watermark()) {
                        $return['status'] = false;
                        $return['error'] = $CI->image_lib->display_errors();
                    } else{
                        unlink($source_image);
                        rename($source_image_1,$source_image);
                        $return['status'] = true; 
                        $return['thumb_image_name'] = base_url().'uploads/items/items_thumbnail/'.$thumb_filename;
                    } 
                } else {
                    $image_info_explode = explode(".",$filename_1);
                    $image_name = $image_info_explode[0];
                    $thumb_image_name = $image_name."_thumb";
                    $thumb_image_full_name = $image_name."_thumb.".$image_info_explode[1];
                    $return['status'] = true;
                    $return['thumb_image_name'] = $thumb_image_full_name;
                }
            }
            $CI->image_lib->clear();
        } else {
            $return['status'] = true;
            $return['thumb_image_name'] = $filename;
        }
        return $return;
    }

    function RemoveSpecialChar($str) {
        $res = str_replace( array( '\'', '$',','), '', $str);
        return trim($res);
    }

    function MaskCreditCard($cc){
        $cc_length = strlen($cc);
          // Replace all characters of credit card except the last four and dashes
        for ($i=0; $i<$cc_length-4; $i++) {
            if ($cc[$i] == '-') {
                  continue;
            }
            // $cc[$i] = 'X';
        }
        return $cc;
    }
    function FormatCreditCard($cc)
  {

      // Clean out extra data that might be in the cc

      $cc = str_replace(array('-',' '), '', $cc);

      // Get the CC Length

      $cc_length = strlen($cc);

      // Initialize the new credit card to contian the last four digits

      $newCreditCard = substr($cc, -4);

      // Walk backwards through the credit card number and add a dash after every fourth digit

      for ($i=$cc_length-5;$i>=0;$i--) {

          // If on the fourth character add a dash

          if ((($i+1)-$cc_length)%4 == 0) {
              $newCreditCard = '-'.$newCreditCard;
          }

          // Add the current character to the new credit card

          $newCreditCard = $cc[$i].$newCreditCard;
      }

      // Return the formatted credit card number

      return $newCreditCard;
  }

    function get_allowed_file_type(){
        $allowed_file_type = 'jpg|jpeg|jpe|gif|webp|bmp|gd2|png|doc|docx|html|htm|odt|pdf|xls|xlsx|ods|ppt|pptx|txt|aa|aac|aax|act|aiff|alac||amr|ape|au|awb|dss|dvf|flac|gsm|iklax|ivs|m4a|m4b|m4p|mmf|mp3|mpc|msv|nmf|ogg|oga|mogg|opus|org|ra|rm|raw|rf64|sln|tta|voc|vox|wav|wma|wv|webm|8svx|cda|mkv|flv|vob|ogv|ogg|drc|gifv|mng|avi|mts|m2ts|ts|mov|qt|wmv|yuv|rm|rmvb|viv|asf|amv|mp4|m4p|m4v|mpg|mp2|mpeg|mpe|mpv|mpg|mpeg|m2v|m4v|svi|3gp|3g2|mxf|roq|nsv|f4v|f4p|f4a|f4b|webm';
         return $allowed_file_type;
    }

    if (!function_exists('check_audio_file_format')){
        function check_audio_file_format($file_extension=''){
            $audio_format_array = ['mp3'];
            $accepted_audio_format = implode(",",$audio_format_array);
            if(in_array($file_extension, $audio_format_array)){
                return false;
            } else {
                return $accepted_audio_format;
            }
        }
    }

    if (!function_exists('check_video_file_format')){
        function check_video_file_format($file_extension=''){
            $video_format_array = ['mp4','avi','mkv','mov','mpeg','f4v','flv','wmv','m4v'];
            $accepted_video_format = implode(",",$video_format_array);
            if(in_array($file_extension, $video_format_array)){
                return false;
            } else {
                return $accepted_video_format;
            }
        }
    }
?>