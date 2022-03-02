<?php
bay_value_condo();
function bay_value_condo(){
    $data['area'] = $_POST['area'];
    $data['dtf'] = $_POST['dtf'];
    $data['dtt'] = $_POST['dtt'];
    $data['bds'] = $_POST['bds'];
    $data['bdsp'] = $_POST['bdsp'];
    $data['pr'] = $_POST['pr'];
    $data['tp'] = $_POST['tp'];
    $data['lv'] = $_POST['lv']; 

    //can add parameters validate here
    $fetched_data =  curl_get($data);
    //var_dump(json_decode($fetched_data));
    visualize_data(json_decode($fetched_data));
}

function curl_get($data){
    $ch = @curl_init();
    $url="http://xx.xx.xx.xx:8000/bay_value_condo";
    $args = "";
    foreach($data as $key => $value){
        if(!empty($value)){
            $args .= $key . "=" . rawurlencode($value) ."&";
        }
    }

    if(!empty($args)) {
        $args = substr($args,0,strlen($args)-1);
        $url .= "?" . $args;
    }

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_HEADER,0);
    curl_setopt($ch, CURLOPT_REFERER, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    $fetched_data = curl_exec($ch);
 
    if (curl_error($ch)) {
        print "Error: " . curl_error($ch);
    } else {
        // 打印返回的内容
        curl_close($ch);
        return $fetched_data;
    }
}

function visualize_data($data){
    if(is_object($data)){
        $data = (array) $data;
    }
    $html = '<html><div style="color:red">This is simple visualized results only for test!</div>';
    $html .= '<div>results: </div>';
    foreach($data['results'] as $key => $value){
        $html .= '<span>'.$value.'</span> ';
    }
    $html .= '<div>recent: '.$data['recent'].'</div>';
    $html .= '<div>rec2: '.$data['rec2'].'</div>';
    $html .= '<div>eval: '.$data['eval'].'</div>';
    $html .= '<hr/><canvas id="canvas"></canvas>';
    $html .= '<div>yvs: </div><div id="yvs-chart">';
    foreach($data['yvs'] as $key => $value){
        $html .= $value.' ';
    }
    $html .= '</div><div>xvs: </div><div id="xvs-chart">';
    foreach($data['xvs'] as $key => $value){
        $html .= $value.' ';
    }
    $html .= '</div><hr/><div>frm: '.$data['frm'].'</div>';
    $html .= '<div>to: '.$data['to'].'</div>';
    $html .= '<div>avg: '.$data['avg'].'</div>';
    $html .= '</div>';
    $html .= '<script src="/test/draw.js"></script>';
    echo $html;
}
