<?php

class WebServiceResult {

    private $result = Array();

    public function __construct() {
        $this->result["result"] = "true";
        $this->result["errormsg"] = "";
        $this->result["param"] = "";
        $this->result["errortype"] = "0";
        $this->result["errorcode"] = 0; //自定义异常错误编码 add jin 20141011
    }

    /**
     * 添加返回参数
     * @param type $key 参数键
     * @param type $value 参数值
     */
    public function SetParam($key, $value) {
        $this->result["param"][$key] = $value;
    }

    public function GetParam($key) {
        return $this->result["param"][$key];
    }

    /**
     *
     */
    public function UnSetParam($key) {
        if (isset($this->result["param"][$key])) {
            unset($this->result["param"][$key]);
        }
    }

    /*     * 设置返回参数
     * @param type $value 参数值
     */

    public function SetParamByValue($value) {
        $this->result["param"] = $value;
    }

    /*     * 获取返回参数
     * @param type $value 参数值
     */

    public function GetParamByValue() {
        return $this->result["param"];
    }

    /**
     * 设置结果 默认"true"
     * @param type $boolResult
     */
    public function SetResult($boolResult) {
        $this->result["result"] = $boolResult ? "true" : "false";
    }

    /* 获取结果 */

    public function GetResult() {
        return $this->result["result"];
    }

    /**
     * 设置错误类型
     * @param type $errortype 1是显示给用户,0不显示给用户
     */
    public function SetErrorType($errortype) {
        $this->result["errortype"] = $errortype;
    }

    /**
     * 设置错误信息
     * @param type $msg 字符串 错误信息内容
     */
    public function SetErrorMsg($msg) {
        $this->result["errormsg"] = $msg;
    }

    /* 返回错误信息 */

    public function GetErrorMsg() {
        if (isset($this->result["errormsg"])) {
            return $this->result["errormsg"];
        } else {
            return "";
        }
    }

    /*     * 返回格式化结果
     * @return type 数组
     */

    public function GetFormart() {
        return $this->result;
    }

    /**
     * 返回格式化结果 数组
     * @return type 数组
     */
    public function ToArray() {
        return $this->result;
    }

    /**
     * 返回格式化结果
     * @return type 格式化为json结构的数据
     */
    public function GetFormatByEncodeJson($is_echo = true) {
        if ($this->result["result"] == "false" && $this->result["errorcode"] > 0) {
            //获取错误码对应的显示信息
        }
        if ($is_echo) {
            echo \yii\helpers\Json::encode($this->result);
        }
        return \yii\helpers\Json::encode($this->result);
    }

    /**
     * 打印格式化结果
     * @return type 格式化为json结构的数据
     */
    public function PrintFormatByEncodeJson() {

        echo \yii\helpers\Json::encode($this->result);
    }

    /**
     * 设置错误编码
     * @param type $errorcode
     */
    public function SetErrorCode($errorcode) {
        $this->result["errorcode"] = $errorcode;
    }

    /* 获取错误编码 */

    public function GetErrorCode() {
        return $this->result["errorcode"];
    }

}

?>