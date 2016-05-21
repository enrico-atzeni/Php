<?php 
$your_serialized_string = 'a:5:{s:5:"width";i:600;s:6:"height";i:344;s:4:"file";s:21:"2015/11/18/caffe1.jpg";s:5:"sizes";a:9:{s:9:"thumbnail";a:4:{s:4:"file";s:17:"caffe1-75x43.jpg";s:5:"width";i:75;s:6:"height";i:43;s:9:"mime-type";s:10:"image/jpeg";}s:6:"medium";a:4:{s:4:"file";s:19:"caffe1-300x172.jpg";s:5:"width";i:300;s:6:"height";i:172;s:9:"mime-type";s:10:"image/jpeg";}s:15:"small-thumbnail";a:4:{s:4:"file";s:19:"caffe1-186x146.jpg";s:5:"width";i:186;s:6:"height";i:146;s:9:"mime-type";s:10:"image/jpeg";}s:16:"medium-thumbnail";a:4:{s:4:"file";s:19:"caffe1-292x154.jpg";s:5:"width";i:292;s:6:"height";i:154;s:9:"mime-type";s:10:"image/jpeg";}s:13:"big-thumbnail";a:4:{s:4:"file";s:19:"caffe1-600x270.jpg";s:5:"width";i:600;s:6:"height";i:270;s:9:"mime-type";s:10:"image/jpeg";}s:8:"hp-thumb";a:4:{s:4:"file";s:17:"caffe1-75x75.jpg";s:5:"width";i:75;s:6:"height";i:75;s:9:"mime-type";s:10:"image/jpeg";}s:9:"hp-medium";a:4:{s:4:"file";s:19:"caffe1-150x120.jpg";s:5:"width";i:150;s:6:"height";i:120;s:9:"mime-type";s:10:"image/jpeg";}s:10:"single-big";a:4:{s:4:"file";s:19:"caffe1-600x330.jpg";s:5:"width";i:600;s:6:"height";i:330;s:9:"mime-type";s:10:"image/jpeg";}s:9:"BMgallery";a:4:{s:4:"file";s:19:"caffe1-200x200.jpg";s:5:"width";i:200;s:6:"height";i:200;s:9:"mime-type";s:10:"image/jpeg";}}s:10:"image_meta";a:11:{s:8:"aperture";i:0;s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";i:0;s:9:"copyright";s:0:"";s:12:"focal_length";i:0;s:3:"iso";i:0;s:13:"shutter_speed";i:0;s:5:"title";s:0:"";s:11:"orientation";i:1;}}';

@$result = unserialize($your_serialized_string);
if(!$result){
    // UNSERIALIZE OFFSET ERROR
    $result_temp = preg_replace_callback('!s:(\d+):"(.*?)";!', 
    function($match){
        return ($match[1] == strlen($match[2])) ? $match[0] : 's:' . strlen($match[2]) . ':"' . $match[2] . '";';
    },
    $your_serialized_string);
    $result = unserialize($result_temp);
}
echo 'old string: <br>';
echo $your_serialized_string.'<br><br>';

echo 'new string: <br>';
echo $result_temp.'<br><br>';

echo 'object: <br>';
var_dump($result);
?>