<?php
// PHP cURL 모듈은 다양한 종류의 프로토콜을 사용하여 서버와 통신할 수 있도록 도와주는 모듈로 외부 사이트의 정보를 취득할 수 있다.
// 서버에 PHP CURL 모듈이 설치되어 있어야 한다.
$url = "http://newsapi.org/v2/top-headlines?country=kr&apiKey=";
// curl이 설치 되었는지 확인
if (function_exists('curl_init')) {
    
    $ch = curl_init(); // curl 리소스 초기화
    curl_setopt($ch, CURLOPT_URL, $url); // url 설정    
    curl_setopt($ch, CURLOPT_HEADER, 0); // 헤더는 제외하고 content 만 받음    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // 응답 값을 브라우저에 표시하지 말고 값을 리턴

    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_VERBOSE, true);

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); //true로 설정시 일부 https 사이트는 안 열림
    curl_setopt($ch, CURLOPT_SSLVERSION,1); //ssl 셋팅

    $content = curl_exec($ch);    
    curl_close($ch); // 리소스 해제

    $R = json_decode($content,TRUE); // JSON to Array
    echo json_encode($R); // JSON

} else {
    // curl 라이브러리가 설치 되지 않음. 다른 방법 알아볼 것
    echo "This website not installed PHP's curl function.";
}
?>
