<?php
//�������ó����ִ��ʱ��Ϊ������
set_time_limit(0);
//����Ƿ������CURL��չ�����δ�������˳�
!extension_loaded('curl') && exit('CURL��չδ���أ�������ֹ����');

//���õ�¼У�ڵ��û���
define('email','xxxxx@xxxxx');
//��������
define('password','xxxxx');
//��¼ҳ��
define('LOGIN_PAGE','http://www.renren.com/PLogin.do');
//��ҳ
define('INDEX_PAGE','http://www.renren.com/SysHome.do');
//����ҳ��
define('SEARCH_PAGE','http://www.renren.com/275424829');

/**
*
* ��ָ����$url�ύ$request���󣬲�����$cookie
*
* @param string $url 
* @param string $request 
* @param string $cookie 
* @return void
*
**/

function makeRequert($url,$request=false,$cookie){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
        if($request)curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
        $content = curl_exec($ch);
        curl_close($ch);
        return $content;
}

//��¼У��

if(@ !$_COOKIE['cookie_jar']||!is_file($_COOKIE['cookie_jar'])){
                //����COOKIE�ļ�
                $cookie_jar = tempnam('./tmp','cookie');
                //����COOKIE
                setcookie('cookie_jar',$cookie_jar);
                //�齨����,��У�ڵĵ�¼ҳ��鿴Դ���룬�ᷢ����Ҫ�ύemail��password����
                $request = 'email='.urlencode(email).'&password='.urlencode(password);
                //�����¼����
                makeRequert(LOGIN_PAGE,$request,$cookie_jar);
}else{
                $cookie_jar = $_COOKIE['cookie_jar'];
}


//������ҳ
print makeRequert(INDEX_PAGE,false,$cookie_jar);

/*

//��������,��У�ں󣬲鿴Դ���룬�����������ѵĹ��������Ҫ�ύһ������q
//���ò���q,ֵΪtest
$request = 'q=test';
print makeRequert(SEARCH_PAGE,$request,$cookie_jar);

*/

//OK,��˵������ɣ�ʣ�µĴ�����ɷ��Ӱɡ�