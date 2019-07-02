<?php

class util
{
    /**
     * 过滤参数
     * @param $value
     * @return string
     */
    public static function filterParams($value)
    {
        $value = trim($value);
        $value = htmlspecialchars($value);
        $value = addslashes($value);

        return $value;
    }

    /**
     * 提取数据
     * @return string
     */
    public static function extractVal($array, $key, $default = null)
    {
        if (is_array($array) && isset($array[$key])) {
            return self::filterParams($array[$key]);
        }

        return $default;
    }

    /**
     * 返回响应
     * @param int    $status
     * @param string $message
     * @param array  $data
     */
    public static function response($status = 200, $message = '成功', $data = [])
    {
        $response = [
            'status'  => $status,
            'message' => $message,
            'data'    => $data,
        ];

        echo json_encode($response);
        exit;
    }

    public static function checkPwd($password)
    {
        preg_match("/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{8,16}$/", $password, $match);

        if (empty($match)) {
            self::response('301', "密码必须是8-16位的数字和字母组合");
        }
    }
}
