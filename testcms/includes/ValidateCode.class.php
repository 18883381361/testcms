<?php 
class ValidateCode{
    public $charset="abcdefghjkmnpqrstwxyzABCDEFGHJKLMNPQRSTWXYZ23456789";
    public $codelength=4;//验证码长度
    public $code;//验证码
    public $img;//画布
    public $width=68;
    public $height=24;
    //生成随机验证码
    public function createCode(){
        $length=strlen($this->charset);
        for($i=0;$i<$this->codelength;$i++){
            $this->code.=$this->charset[mt_rand(0,$length-1)];
        }
        return $this->code;
    }
  
    //创建画布
    public function createBg(){
        header('Content-Type:image/png');
        $this->img=imagecreatetruecolor($this->width,$this->height);
        $white=imagecolorallocate($this->img, 255, 255, 255);        
        imagefill($this->img, 0, 0, $white);
        for($i=0;$i<6;$i++){
            $linecolor=imagecolorallocate($this->img, rand(50, 200), rand(100, 200), rand(150, 200));
            imageline($this->img, rand(1, 60), rand(1, 20), rand(1, 60), rand(1, 20), $linecolor);
        }
        for($i=0;$i<100;$i++){
            $charcolor=imagecolorallocate($this->img, rand(200, 250), rand(200, 250), rand(200, 250));
            imagechar($this->img, 1, rand(0,68), rand(0,24), '*', $charcolor);
        }
        for($i=0;$i<$this->codelength;$i++){
            imagestring($this->img, 5, $i*$this->width/$this->codelength+mt_rand(0, 10),mt_rand(1, $this->height)/2, $this->code[$i], imagecolorallocate($this->img, rand(0, 100), rand(0, 150), rand(0, 200)));
        }
        imagepng($this->img);
        imagedestroy($this->img);
    }
    public function getCode(){
        $this->createCode();
        return $this->code;
    }
    //验证函数
    public function checkCode(){
        $this->createCode();
        $this->createBg();
    }
    
}

?>